<?php

namespace App\Services;

use App\Models\currency;
use App\Models\Earnings;
use App\Models\Fees;
use App\Models\Wallets;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WalletService
{
    public function getUserWallet($account_number = null, $currency = null)
    {
        // If currency is provided, return wallet of the authenticated user with the given currency
        if ($currency != null) {
            return DB::table('users')
                ->join('wallets', 'users.id', '=', 'wallets.user_id')
                ->join('currencies', 'wallets.currency_id', '=', 'currencies.id')
                ->where('currencies.code', '=', $currency)
                ->where('users.id', Auth::id())
                ->select('wallets.id as sender_wallet_id','users.name','users.id','currencies.id as sender_currency_id') // Ensure the wallet belongs to the authenticated user
                ->first(); // Return the first match (should be a single record)
                #this will return SENDER DATA
        }
    
        // If account number is provided, return wallet associated with that account number
        if ($account_number != null) {
            return Wallets::where('account_number', $account_number)->first(); // Single wallet match
        }
    
        // If no account number or currency is provided, return all wallets of the authenticated user
        return Wallets::where('user_id', Auth::id())->get(); // Return all wallets for the authenticated user
    }
    /**
     * Get User Wallets | using Auth::id() |USERS ONLY
     * @return Object | ['id-wallet_id,user_id,account_number,balance,currency_id,code,name,symbol']
     */
    public function userWallet(string $currency) : ?object{
       $query = DB::table('wallets')
                ->join('currencies','wallets.currency_id','=','currencies.id')
                ->where('wallets.user_id',Auth::id())
                ->where('currencies.code',$currency)
                ->selectRaw('wallets.id,wallets.user_id,wallets.account_number,wallets.balance,currencies.id as currency_id,currencies.code,currencies.name,currencies.symbol')
                ->first();
        if(!$query){
           return null;
        }
        return $query;
    }
    public function getReceiverWalletCurrency($account){
        if(empty($account)){
            return false;
        }

        $Currency = DB::table('wallets')
        ->join('currencies','wallets.currency_id','=','currencies.id')
        ->where('wallets.account_number','=',$account)     
        ->select('currencies.code')
        ->first();

        if(empty($Currency)){
            return false;
        }

        return $Currency->code ; #return Currency "USD,PHP" if the account number is exist
    }

    public function getSenderBalance($curr){
        if(empty($curr)){
            return false;
        }
        $bal = DB::table('wallets')
            ->join('currencies','wallets.currency_id','=','currencies.id')
            ->where('wallets.user_id','=',Auth::id())
            ->where('currencies.code',$curr)
            ->select('wallets.balance')
            ->first();

        if(empty($bal)){
            return false; #no data found!
        }

        return $bal->balance;
    }

    public function storeInEarnings($transaction_id,$user_id,$amount){

        $earning = Earnings::create([
            'transaction_id' => $transaction_id,
            'user_id' => $user_id,
            'amount' => $amount,
            'earned_at' => now()
        ]);
        if(!$earning){
            return false;
        }

        return true;
        
    }
    /**
     * Get user Fee
     * @param transaction type 'external api ,send_money
     * @return int
     * 
     */
    public function getFee($transactionType,$currency = 'PHP'){
          
        $fee = DB::table('fees')
            ->where('transaction_type', $transactionType)
            ->where('currency', $currency)
            ->value('amount');

        return $fee ?? 0; // Default to 0 if no fee is found

    }

    #Generate Transaction ID usign random Numbers and String
    public function generateTransactionID(){
        return 'TXN-' . time() . '-' . Str::random(8);

    }

    #Generate transction id usign UUID for every Transaction
    public function genUUID(){

      return  Str::uuid();
    }

    #generate client_ref every Transactions for API purposes
    public function genClient_ref(){
       return 'REF-' . Auth::id() . '-' . time();
    }

    #show Users All wallets Currencies
    public function userWalletCurrencies(){

        return  DB::table('users')
            ->join('wallets','users.id','=','wallets.user_id')
            ->join('currencies','wallets.currency_id','=','currencies.id')
            ->where('users.id',Auth::id())
            ->select('currencies.id as currency_id','currencies.code','currencies.name','currencies.symbol')
            ->get();

       
    }

    public function generateUniqueAccountNumber(){
        do {
            // Generate a random 11-digit number
            $accountNumber = str_pad(rand(10000000000, 99999999999), 11, '0', STR_PAD_LEFT); // Ensures 11 digits
        } while ($this->accountNumberExists($accountNumber));

        return $accountNumber;
    }
   
   public function accountNumberExists($accountNumber){
       // Check if the generated account number already exists in the 'wallets' table
       return \App\Models\Wallets::where('account_number', $accountNumber)->exists();
   }
   public function availableCurrencyByUser(){
    $user_id = Auth::id();
        // Get currencies that are not already associated with the user's wallets
        $availableCurrencies = currency::whereNotIn('id', function ($query) use ($user_id) {
            $query->select('currency_id')
                ->from('wallets')
                ->where('user_id', $user_id);
        })->get();

    return $availableCurrencies;
   }
   public function availableCurrency(int $user_id){
    
        // Get currencies that are not already associated with the user's wallets
        $availableCurrencies = currency::whereNotIn('id', function ($query) use ($user_id) {
            $query->select('currency_id')
                ->from('wallets')
                ->where('user_id', $user_id);
        })->get();

    return $availableCurrencies;
   }



   
   
}
