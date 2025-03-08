<?php

namespace App\Services;

use App\Models\Api_keys;
use App\Models\currency;
use App\Models\Transactions;
use App\Models\Wallets;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ApiKeysServices{

    private $walletService;
    private $transactionService;
    public function __construct(WalletService $walletServices, TransactionServices $transactionServices)
    {
        $this->walletService = $walletServices;
        $this->transactionService = $transactionServices;
    }

/**
 * Generate random string
 * 
 * @return String apikey
 */
public function generateApiKey(){

    $apiKey = Str::random(50);

    // Api_keys::updateOrCreate([
    //     'user_id' => $user_id,
    //     'api_key' => hash('sha256',$apiKey)
    // ]);
    return $apiKey;
}

/**
 * @return array Users api keys Data
 */
public function showUserApiKey(){
    return Api_keys::where('user_id', Auth::id())
    ->where('status', 'active')
    ->whereDate('expires_at', '>', Carbon::today()) // Check for non-expired keys
    ->get();
}

/**
 *  Get the User Data by using APi Key
 * 
 * @param string $apikey
 * @return array 'user_id,api_id'
 * 
 * */ 
 public function getUserByApiKey($apiKey){
    if(!$apiKey){
        return false;
    }
    $hash_api = hash('sha256', $apiKey);
    $data = Api_keys::where('api_key',$hash_api)
        ->where('status','active')
        ->first();
    return [
        'user_id'=>$data->user_id,
        'api_id' => $data->id,
      
    ];
 }

/**
 * Get the user's wallet balance for a specific currency.
 *
 * @param array $data An array containing the user ID and currency details.
 * @return float The user's wallet balance as a numeric value.
 * @throws Exception If the user's wallet balance is not found.
 */
 public function getUserBalance($data){

    $this->validateBalanceInquiry($data);

    try {
      //get the validated User ID
      $user_id = $data['user_id']; 
      $currency = $data['currency'];

      #convert currency code into currency id
      $currencyObj = $this->convertCurrencyCodeIntoId($currency);
      if(!$currency){
        throw new Exception('Invalid Currency Code');
      }
     
      $walletBalance = Wallets::where('user_id',$user_id)
            ->where('currency_id',$currencyObj->id)
            ->first();

      if(!$walletBalance){
        throw new Exception('User wallet Balance not Found!');
      }
      return $walletBalance->balance;

    } catch (\Throwable $th) {
        //throw $th;
        be_logs('Failed to get User Balance : ',$th);
    }

 }
/**
 * Validate the balance inquiry request data.
 *
 * This function checks if the required fields (`user_id` and `currency`) are present in the input data.
 * If any of the required fields are missing, an exception is thrown.
 *
 * @param array $data The input data containing `user_id` and `currency`.
 * @return void
 * @throws Exception If `user_id` or `currency` is missing.
 */
 protected function validateBalanceInquiry( array $data) {
    if(empty($data['user_id'])){
        throw new Exception('user id is required!');
    }
    if(empty($data['currency'])){
        throw new Exception('currency is required!');
    }
 }

 /**
  * Convert Currency Code 'PHP' to its ID
  * @param string Currency Code  ex : PHP
  * @return Object currencies table [id,code,name,symbols,img]
  */
 public function convertCurrencyCodeIntoId( string $currency_code){
    if(empty($currency_code)){
        throw new Exception('currency id is required');
    }

    return currency::where('code',$currency_code)
        ->first();

 }
 /**
  * Validate Credit Data
  *@param array currency id,amount,user id, client ref
  *@return void
  *@throws Exceptions if validation fails
  */

 protected function validateCredit(array $data) {
     /**
     * Expects payload
     * user id
     * currency id
     * amount
     * Client Ref
     * api id for recordings
     */
       
    if(empty($data['user_id'])){
        throw new Exception('Id is required');
    }
    if(empty($data['client_ref'])){
        throw new Exception('Client Ref is required!');
    }
    if(empty($data['amount'])){
        throw new Exception('Currency is required!');
    }
    if(empty($data['api_key_id'])){
        throw new Exception('api key id is required!');
    }
    if(empty($data['wallet_id'])){
        throw new Exception('Wallet id is required!');
    }
    if(empty($data['fee'])){
        throw new Exception('Fee is required!');
    }
    if(empty($data['description'])){
        throw new Exception('Description is required!');
    }
 }

 /**
  * Create Transactions Credit by api request
  *@param array data
  *@return array 'transaction,amount,transaction_type,fee,status,
  */
 public function createCredit(array $data){
   $fee = '0';
   $transactionType = 'Credit, Transaction made via External Api';

    try {
        //Generate Transaction Code
        $transaction_code = $this->walletService->generateTransactionID();

       return  DB::transaction(function() use($data,$transaction_code,$fee,$transactionType){

          $transactions =  Transactions::create([
                'wallet_id' => $data['wallet_id'],
                'api_key_id' => $data['api_key_id'],
                'transaction_id' => $transaction_code,
                'client_ref_id'     => $data['client_ref'],
                'type'              => 'credit',
                'amount'          => $data['amount'],
                'fee'             => $fee,
                'description'     => $transactionType,
                'currency_id'     => $data['currency_id'],
                'status'          => 'success'
            ]);

            #add credit to user wallets
            $this->updateWalletBalance($data['wallet_id'],$data['amount']);
            #fetch new User wallet Balance
            $newUserWalletBalance =   $this->getUserWalletBalance($data['currency_id'],$data['user_id']);

            $userWalletBalance = [
                'user_id' => $newUserWalletBalance->user_id,
                'account_number'=> $newUserWalletBalance->account_number,
                'newBalance' => $newUserWalletBalance->balance,
                'transaction_date' => $newUserWalletBalance->updated_at
            ];
            $responseData = [
                'transaction_id' => $transactions->transaction_id,
                'currency'       => $data['currency_code'],
                'client_ref_id'  => $transactions->client_ref_id,
                'type'           => 'credit',
                'fee'            => $transactions->fee,
                'description'    => $transactions->description,
                'amount'         => $transactions->amount,
                'updatedBalance' => $userWalletBalance,
                'status'         => $transactions->status
            ];
         

            return $responseData;
         });

       
    } catch (\Throwable $th) {      
        handleException($th,'Failed to create Credit Transactions');
    }

 }

 /**
  * Create Debit
  *@param array Data
  *@return array response data [transaction_id,client_ref,currency,type,fee,description,amount,updateBalance,status]
  *@throws Exception failed to create debit
  */
 public function createDebit(array $data){
    //validate data
    $this->validateDebitData($data);
   
    try {
       return DB::transaction(function() use($data){
         //Generate Transaction Code
         $transaction_code = $this->walletService->generateTransactionID();

         $transactions =  Transactions::create([
            'wallet_id' => $data['wallet_id'],
            'api_key_id' => $data['api_key_id'],
            'transaction_id' => $transaction_code,
            'client_ref_id'     => $data['client_ref'],
            'type'              => 'debit',
            'amount'          => $data['amount'],
            'fee'             => $data['fee'],
            'description'     => 'Debit, Transaction made via External Api',
            'currency_id'     => $data['currency_id'],
            'status'          => 'success'
        ]);
        #update balance
        $this->updateWalletBalance($data['wallet_id'],-($data['amount'] + $data['fee']));
        #Store Earnings
        $this->transactionService->storeEarnings($transactions->id,$data['user_id'],$data['fee']);
        #fetch new User wallet Balance
        $newUserWalletBalance =   $this->getUserWalletBalance($data['currency_id'],$data['user_id']);

        $userWalletBalance = [
            'user_id' => $newUserWalletBalance->user_id,
            'account_number'=> $newUserWalletBalance->account_number,
            'newBalance' => $newUserWalletBalance->balance,
            'transaction_date' => $newUserWalletBalance->updated_at
        ];
        $responseData = [
            'transaction_id' => $transactions->transaction_id,
            'currency'       => $data['currency_code'],
            'client_ref_id'  => $transactions->client_ref_id,
            'type'           => 'debit',
            'fee'            => $transactions->fee,
            'description'    => $transactions->description,
            'currentBalance' => $data['currentBalance'],
            'amount'         => $transactions->amount,
            'amount_to_be_deducted' => $data['amount'] + $data['fee'],
            'updatedBalance' => $userWalletBalance,
            'status'         => $transactions->status
        ];

        return $responseData;
       });
    } catch (\Throwable $th) {
        return handleException($th,'Failed to create Debit');
    }

 }

 /**
  * validate Debit array Data
  * @param array
  * @return void
  * @throws Exception if fail
  */
 private function validateDebitData(array $data): void{

    if(empty($data['wallet_id'])){
        throw new Exception('wallet id not found!');
    }
    if(empty($data['api_key_id'])){
        throw new Exception('api id not found!');
    }
    if(empty($data['client_ref'])){
        throw new Exception('client ref required');
    }
    if(empty($data['amount']) || !is_numeric($data['amount'])){
        throw new Exception('amount required or not Numeric');
    }
    if(empty($data['user_id'])){
        throw new Exception('user id is required');
    }
    if(empty($data['fee'])){
        throw new Exception('fee is required');
    }
    if(empty($data['currency_id'])){
        throw new Exception('currency id is required!');
    }
    if(empty($data['currency_code'])){
        throw new Exception('currency code is required');
    }
    if(empty($data['currentBalance'])){
        throw new Exception('Current Balance is required');
    }
 }

 /**
  * Get api id by using api key provided
  *@param String Api key from X-API-KEY not hash
  *@return object ['id,user_id,api_key,status,expires_at']
  *@throws Exception if no api key found! and null
  */
 public function getApiId(string $apiKey){
    if(empty($apiKey)){
        //throw new Exception('api key not found!');
        return null;
    }
    $hash_api_key = hash('sha256',$apiKey);
    $api =  Api_keys::where('api_key',$hash_api_key)->first();
    if(!$api){
        //throw new Exception('api key id not found!');
        return null;
    }

    return $api;

 }
/**
 * Get User Wallet Balance
 * @param int currency_id, user_id
 * @return object ['id,user_id,currency_id,account_number,balance']
 * @throws Exception if no user wallet found
 */
 public function getUserWalletBalance(int $currency_id, int $user_id){
    $walletBalance = Wallets::where('user_id',$user_id)
    ->where('currency_id',$currency_id)
    ->first();
    if(!$walletBalance){
        //throw new Exception('Failed to fetch User Wallet Balance!');
        return null;
    }
    return $walletBalance;
 }
  /**
     * Update wallet balance.
     *
     * @param int $walletId
     * @param float $amount
     */
    protected function updateWalletBalance(int $walletId, float $amount): void
    {
        Wallets::where('id', $walletId)->increment('balance', $amount);
    }

    /**
     * Checks Transaction if Exist using Client Ref
     * @return boolean true false
     */
    public function isTransactionExist(int $wallet_id, string $client_ref): bool{
        if (empty($wallet_id) || empty($client_ref)) {
            throw new Exception('wallet id or client ref is required');
            return true;
        }

        $check = Transactions::where('wallet_id',$wallet_id)
            ->where('client_ref_id',$client_ref)
            ->exists();
        if(!$check){
            return false;
        }
        return true;
    }

    /**
     * User Transactions
     * @throws Exception if empty params user id & null
     * @return array or collection 
     */
    public function userTransactions(int $user_id) {
    
        if(empty($user_id)){
            throw new Exception('user id is empty or Invalid');
            return null;           
        }

        $query = DB::table('transactions')
        ->join('wallets', 'transactions.wallet_id', '=', 'wallets.id')
        ->join('users', 'wallets.user_id', '=', 'users.id')
        ->join('currencies', 'transactions.currency_id', '=', 'currencies.id')
        ->where('users.id', $user_id) 
        ->select(
            'transactions.transaction_id',
            'transactions.description',
            'transactions.status',
            'transactions.amount',
            'transactions.fee',
            'transactions.created_at',
            'currencies.code',
            'transactions.client_ref_id'
        )
        ->orderBy('transactions.created_at', 'DESC')
        ->get()
        ->map(function ($data) {
            $data->date_created = Carbon::parse($data->created_at)->format('F j, Y g:i A');
            return $data;
        });

        return $query;

    }

}


