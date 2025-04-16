<?php

namespace App\Services;

use App\Exceptions\BankTransferException;
use App\Models\BankPartners;
use App\Models\bankTransactionDetails;
use App\Models\Transactions;
use App\Models\Wallets;
use App\Services\WalletService;
use App\Services\NotificationServices;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransactionServices
{
    private $walletService;
    private $notificationService;

    public function __construct(WalletService $walletService,NotificationServices $notificationServices)
    {
        $this->walletService = $walletService;
        $this->notificationService = $notificationServices;   
    }

    private function validateBankTransferData(array $data) :void{
        if(empty($data['wallet_id'])){
            throw new Exception('wallet id is required');
        }
        if(empty($data['receiverBankNumber'])){
            throw new Exception('receiver bank number is required');
        }
        if(empty($data['amount'])){
            throw new Exception('amount is required');
        }
        if(empty($data['currency'])){
            throw new Exception('currency is required');
        }
        if(empty($data['bank'])){
            throw new Exception('Bank is required');
        }
        if(empty($data['account_name'])){
            throw new Exception('account name is required');
        }
        if(empty($data['fee'])){
            throw new Exception('Fee is required');
        }
        if(empty($data['description'])){
            throw new Exception('Description is required');
        }
    }

    public function sendMoneyToBank(array $data)
    {
        // Validate input data first
        $this->validateBankTransferData($data);
        
        // Retrieve bank partner
        $bankPartner = BankPartners::where('name', $data['bank'])->first();
        if (!$bankPartner) {
            throw new Exception('Bank partner not found or not supported');
        }
    
        // Generate unique reference
        $clientRef = $this->walletService->genClient_ref();
    
        try {
            DB::beginTransaction();

            // Retrieve sender wallet with lock to prevent concurrent modifications
            $senderWallet = Wallets::lockForUpdate()->find($data['wallet_id']);
            if (!$senderWallet) {
                throw new Exception('No wallet found!');
            }
        
            // Check sufficient balance (amount + fee)
            if ($senderWallet->balance < ($data['amount'] + $data['fee'])) {
                throw new Exception('Insufficient balance for transfer');
            }
    
            // 1. First deduct from wallet (including fee)
            $this->updateWalletBalance(
                $data['wallet_id'],
                -($data['amount'] + $data['fee'])
            );
           
            // 2. Call bank API
            $apiResponse = $this->callBankApi($bankPartner, $clientRef, $data);
            $responseData = $apiResponse->json();
    
            // 3. Record transaction only if API succeeds
            $transaction = $this->createBankTransaction([
                'wallet_id' => $data['wallet_id'],
                'transaction_id' => $responseData['data']['transaction_id'],
                'client_ref_id' => $clientRef,
                'type' => 'debit',
                'amount' => $data['amount'],
                'fee' => $data['fee'],
                'status' => 'success',
                'description' => $data['description'],
                'currency_id' => $senderWallet->currency_id
            ]);
            $transactionDetails = $this->createBankTransactionDetails([
                'transaction_id' => $transaction->id,
                'bank_id'    =>  $bankPartner->id,
                'receiver_name' => $data['account_name'],
                'receiver_account_number' => $data['receiverBankNumber'],
                'sender_balance_before'   => $responseData['data']['old_balance'],
                'sender_balance_after'    => $responseData['data']['new_balance'],
                'api_response'            => $apiResponse
            ]);

            //store Earnings
            $this->storeEarnings($transaction->id,$senderWallet->user_id,$data['fee']);

            //create Notification
            $msg = 'You have sent PHP '.$data['amount'].' to Account Number : '.$data['receiverBankNumber'].' on'.Carbon::now();
            $this->notificationService->createNotifications([
                'user_id' => $senderWallet->user_id,
                'title'   => 'Bank Transfer',
                'message' => $msg
            ]);
            DB::commit();
    
            return $apiResponse;
    
        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('Bank transfer failed', [
                'error' => $e->getMessage(),
                'request' => $data
            ]);
           throw $e;
        }
    }

    protected function callBankApi($bankPartner, string $clientRef, array $data){
        $payload = [
            'account_number' => $data['receiverBankNumber'],
            'amount' => $data['amount'],
            'currency' => $data['currency'], 
            'client_ref' => $clientRef
        ];
        
        $hashApiKey = Crypt::decryptString($bankPartner->api_key);

        $response = Http::bankApi()
            ->withHeaders(['X-API-Key' => $hashApiKey])
            ->post($bankPartner->url.'process-credit', $payload);

        // logger('Bank API Response:', [
        //     'status' => $response->status(),
        //     'headers' => $response->headers(),
        //     'body' => $response->json() // or ->body() if not JSON
        // ]);

        if (!$response->successful()) {
            return json_message(EXIT_BE_ERROR,'error',$response->json());
        }

        return $response;
    }
     /**
     * Send money from one user to another.
     *
     * @param array $requestData
     * @return array
     * @throws Exception
     */
    public function sendMoneyToUser(array $requestData)
    {
        // Validate input data
        $this->validateRequest($requestData);
       

        // Get sender and receiver wallets
        $senderWallet = $this->walletService->getUserWallet(null, $requestData['currency']);
        $receiverWallet = $this->walletService->getUserWallet($requestData['account_number'], null);
        $receiverWalletCurrenncy = $this->walletService->getReceiverWalletCurrency($requestData['account_number']);
        $senderWalletBalance = $this->walletService->getSenderBalance($requestData['currency']);

        // return json_message(EXIT_SUCCESS,'ok',$senderWallet);

        #Validate wallets and currencies
        $this->validateWallets($senderWallet, $receiverWallet,$receiverWalletCurrenncy, $requestData['currency']);

        #Check sender balance
         $this->validateSenderBalance($senderWalletBalance, $requestData['amount'], $requestData['fee']);

        // Perform the transaction
        return DB::transaction(function () use ($senderWallet, $receiverWallet, $requestData) {
            // Create sender transaction (Debit)
            $senderTransaction = $this->createTransaction([
                'wallet_id' => $senderWallet->sender_wallet_id,
                'receiver_wallet_id' => $receiverWallet->id,
                'type' => 'debit',
                'amount' => $requestData['amount'],
                'fee' => $requestData['fee'],
                'description' => 'Transfer Money',
                'currency_id' => $senderWallet->sender_currency_id,
            ]);
           
            #create Notifications Data
            $dateTimeNow = Carbon::now()->toDateTimeString(); // Output: 2025-02-09 14:30:45
            $sendMoneyNotif = [
                'title' =>'Send Money',
                'message' =>'You have Sent '.$requestData['currency'].' '.$requestData['amount'].' to Account Number : '.$requestData['account_number'].' on '.$dateTimeNow.'.',
                'user_id' => $senderWallet->id
            ];
            $receiveMoneyNotif = [
                'title' =>'Received Money',
                'message' =>'You have received '.$requestData['currency'].' '.$requestData['amount'].' from : '.$senderWallet->name.' on '.$dateTimeNow.'.',
                'user_id' => $receiverWallet->id
            ];

            // Deduct amount from sender's wallet
            $this->updateWalletBalance($senderWallet->sender_wallet_id, -($requestData['amount'] + $requestData['fee']));

            // Create receiver transaction (Credit)
            $this->createTransaction([
                'wallet_id' => $receiverWallet->id,
                'receiver_wallet_id' => null,
                'type' => 'credit',
                'amount' => $requestData['amount'],
                'fee' => 0,
                'description' => 'Received Money',
                'currency_id' => $senderWallet->sender_currency_id,
            ]);

            // Add amount to receiver's wallet
            $this->updateWalletBalance($receiverWallet->id, $requestData['amount']);

            // Store earnings (if applicable)
            $this->storeEarnings($senderTransaction->id, $senderWallet->id, $requestData['fee']);
            #logs Notifications
            $send =  $this->notificationService->createNotifications($sendMoneyNotif);
            $received =  $this->notificationService->createNotifications($receiveMoneyNotif);

            if(!$send){
                be_logs('failed to create send Notifications');
            }
            if(!$received){
                be_logs('failed to create received Notifications');
            }

            return [
                'message' => 'Transaction successful!',
                'transaction_id' => $senderTransaction->transaction_id,
            ];
        });
    }

    /**
     * Validate the request data.
     *
     * @param array $requestData
     * @throws Exception
     */
    protected function validateRequest(array $requestData): void
    {
        if (empty($requestData['account_number']) || strlen($requestData['account_number']) !== 11) {
            throw new Exception('Invalid account number.');
        }

        if (empty($requestData['currency']) || strlen($requestData['currency']) !== 3) {
            throw new Exception('Invalid currency.');
        }

        if (empty($requestData['amount']) || $requestData['amount'] <= 0) {
            throw new Exception('Invalid amount.');
        }

        if (empty($requestData['fee']) || $requestData['fee'] < 0) {
            throw new Exception('Invalid fee.');
        }
    }

    /**
     * Validate sender and receiver wallets.
     *
     * @param Wallet|null $senderWallet
     * @param Wallet|null $receiverWallet
     * @param string $currency
     * @throws Exception
     */
    protected function validateWallets($senderWallet,$receiverWallet,$receiverWalletCurrency, string $currency): void
    {
        if (!$senderWallet || !$receiverWallet) {
            throw new Exception('Wallet not found.');
        }
        if(!$receiverWalletCurrency){
            throw new Exception('Invalid Account Number.');
        }

        if ($senderWallet->id === $receiverWallet->user_id) {
            throw new Exception('You cannot send money to your own wallet.');
        }

        if ($receiverWalletCurrency !== $currency) {
            throw new Exception('Currency mismatch between sender and receiver wallets.');
        }
    }

    /**
     * Validate sender's balance.
     *
     * @param Wallet $senderWallet
     * @param float $amount
     * @param float $fee
     * @throws Exception
     */
    protected function validateSenderBalance($senderWalletBalance, float $amount, float $fee): void
    {
        if ($senderWalletBalance < ($amount + $fee)) {
            throw new Exception('Insufficient wallet balance.');
        }
    }

    /**
     * Create a new transaction.
     *
     * @param array $data
     * @return Transaction
     */
    protected function createTransaction(array $data): ?Transactions
    {
        return Transactions::create([
            'wallet_id' => $data['wallet_id'],
            'receiver_wallet_id' => $data['receiver_wallet_id'],
            'transaction_id' => $this->walletService->generateTransactionID(),
            'client_ref_id' => $this->walletService->genClient_ref(),
            'type' => $data['type'],
            'amount' => $data['amount'],
            'fee' => $data['fee'],
            'status' => 'success',
            'description' => $data['description'],
            'currency_id' => $data['currency_id'],
        ]);
    }

    protected function createBankTransaction(array $data) : object {
        $transactions = Transactions::create([

            'wallet_id' => $data['wallet_id'],
            'receiver_wallet_id' => null,//no receiver wallet for bank transaction using API
            'transaction_id'     => $data['transaction_id'],
            'client_ref_id'      => $data['client_ref_id'],
            'type'               => $data['type'],
            'amount'             => $data['amount'],
            'fee'                => $data['fee'],
            'status'             => $data['status'],
            'description'        => $data['description'],
            'currency_id'        => $data['currency_id']
        ]);

        return $transactions;
    }

    protected function createBankTransactionDetails(array $data) : void {
        bankTransactionDetails::create([
            'transaction_id' => $data['transaction_id'],
            'bank_id'       => $data['bank_id'],
            'receiver_name' => $data['receiver_name'],
            'receiver_account_number' => $data['receiver_account_number'],
            'sender_balance_before'   => $data['sender_balance_before'],
            'sender_balance_after'    => $data['sender_balance_after'],
            'api_response'            => $data['api_response']
        ]); 
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
     * Store earnings in the database.
     *
     * @param int $transactionId
     * @param int $walletId
     * @param float $fee
     * @throws Exception
     */
    public function storeEarnings(int $transactionId, $user_id, float $fee): void
    {
        // Logic to store earnings
        if (!$this->walletService->storeInEarnings($transactionId, $user_id, $fee)) {
            throw new Exception('Failed to store earning information.');
            
        }
    }

    #returns recent Transactions Of Authenticated USER
    public function showUserTransactions($status = null){

       /**
        * @param status if !null return recent Transaction or this Day! ELSE returns all transactions of USERS
        */
 
       // Start the query builder
        $query = DB::table('transactions')
            ->join('wallets', 'transactions.wallet_id', '=', 'wallets.id')
            ->join('users', 'wallets.user_id', '=', 'users.id')
            ->join('currencies','transactions.currency_id','=','currencies.id')
            ->where('users.id', Auth::id()) // Filter by authenticated user
            ->select(
                'transactions.transaction_id',
                'transactions.description',
                'transactions.status',
                'transactions.amount',
                'transactions.fee',
                'transactions.created_at',
                'currencies.code'
        );

        // If status is provided, filter transactions of the current day
        if (!is_null($status)) {
            $query->whereDate('transactions.created_at', Carbon::today());
        }

        // Get transactions sorted by most recent first
        $recentTransactions = $query->orderBy('transactions.created_at', 'DESC')->get();

        // Format the created_at date using Carbon
        foreach ($recentTransactions as $recent) {
            $recent->date_created = Carbon::parse($recent->created_at)->format('F j, Y g:i A'); // Example: January 1, 2025 10:30 AM
        }

        return $recentTransactions;
    }

    #returns all Transactions | recent
    public function showTransactions($status = null){

        /**
         * @param status if !null return recent Transction or this Day! ELSE returns all transactions of USERS
         */
  
        // Start the query builder
         $query = DB::table('transactions')
             ->join('wallets', 'transactions.wallet_id', '=', 'wallets.id')
             ->join('users', 'wallets.user_id', '=', 'users.id')
             ->join('currencies','transactions.currency_id','=','currencies.id')            
             ->select(
                 'transactions.transaction_id',
                 'transactions.description',
                 'transactions.status',
                 'transactions.amount',
                 'transactions.fee',
                 'transactions.created_at',
                 'currencies.code'
         );
 
         // If status is provided, filter transactions of the current day
         if (!is_null($status)) {
             $query->whereDate('transactions.created_at', Carbon::today());
         }
 
         // Get transactions sorted by most recent first
         $recentTransactions = $query->orderBy('transactions.created_at', 'DESC')->get();
 
         // Format the created_at date using Carbon
         foreach ($recentTransactions as $recent) {
             $recent->date_created = Carbon::parse($recent->created_at)->format('F j, Y g:i A'); // Example: January 1, 2025 10:30 AM
         }
 
         return $recentTransactions;
    }

   
  
}