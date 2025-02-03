<?php

namespace App\Http\Controllers;

use App\Models\Wallets;
use App\Services\WalletService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Transactions extends Controller
{   
    private $walletService;

    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
    }
  
    public function index(){
       
        return view('transaction.index');
    }

    public function sendMoneyToUser(Request $request)
    {
        $request->validate([
            'account_number' => 'required|string|digits:11', // Ensures exactly 11-digit string
            'currency'       => 'required|string|max:3', // Assuming 3-letter currency codes (e.g., "PHP", "USD")
            'amount'         => 'required|numeric|min:1', // Allows decimals, e.g., 100.50
        ]);
    
        $receiverWalletCurrency = $this->getReceiverWalletCurrency($request->account_number); // Get the Receiver wallet currency
    
        if (!$receiverWalletCurrency) {
            return json_message(EXIT_FORM_NULL, 'Invalid Account number');
        }
        if ($receiverWalletCurrency !== $request->currency) {
            return json_message(EXIT_FORM_NULL, 'The selected wallet currency (' . $request->currency . ') does not match the receiver\'s wallet currency (' . $receiverWalletCurrency . '). Please ensure the currencies match before sending.');
        }
    
        $senderBal = $this->getSenderBalance($request->account_number); // Get wallet Balance
        if (!$senderBal) {
            return json_message(EXIT_FORM_NULL, 'Wallet not Found!');
        }
    
        if ($senderBal < $request->amount) {
            return json_message(EXIT_FORM_NULL, 'Insufficient Wallet Balance!');
        }
    
        try {
            DB::transaction(function () use ($request) {
                // Get Wallet Information
                $senderWallet = $this->walletService->getUserWallet(null,$request->currency);
                $receiverWallet = $this->walletService->getUserWallet($request->account_number,null);
    
                if (empty($senderWallet) || empty($receiverWallet)) {
                    throw new \Exception('Wallet not found!');
                }
    
                // Create the Transaction for the Sender (Debit)
                $transactionIdSender = $this->walletService->generateTransactionID();
                $clientRefIdSender = $this->walletService->genClient_ref();
                DB::table('transactions')->insert([
                    'wallet_id' => $senderWallet->sender_wallet_id,
                    'receiver_wallet_id' => $receiverWallet->id, // Pass the receiver wallet ID
                    'transaction_id' => $transactionIdSender,
                    'client_ref_id' => $clientRefIdSender,
                    'type' => 'Debit',
                    'amount' => $request->amount,
                    'fee' => 1,
                    'status' => 'success',
                    'description' => 'Transfer Money',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
    
                // Update Sender Wallet Balance (Deduct the amount + fee)
                $deductAmount = $request->amount + 1; // 1 is for the fee
                Wallets::where('id', $senderWallet->sender_wallet_id)->decrement('balance', $deductAmount);
    
                // Create the Transaction for the Receiver (Credit)
                $transactionIdReceiver = $this->walletService->generateTransactionID();
                $clientRefIdReceiver = $this->walletService->genClient_ref();
                DB::table('transactions')->insert([
                    'wallet_id' => $receiverWallet->id, // Pass the receiver wallet ID
                    'receiver_wallet_id' => null, // No receiver wallet ID for the receiver's own wallet
                    'transaction_id' => $transactionIdReceiver,
                    'client_ref_id' => $clientRefIdReceiver,
                    'type' => 'Credit', // 'Credit' instead of 'Debit' for the receiver
                    'amount' => $request->amount,
                    'fee' => 0, // No fee for the receiver
                    'status' => 'success',
                    'description' => 'Received Money',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
    
                // Update Receiver Wallet Balance (Add the amount to the current balance)
                Wallets::where('id', $receiverWallet->id)->increment('balance', $request->amount);
            });

            // Success Response
            return json_message(EXIT_SUCCESS, 'Transaction completed successfully.');
        } catch (\Throwable $th) {
            // Error Response
            return json_message(EXIT_BE_ERROR, 'Transaction failed!', $th->getMessage());
        }
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
            ->select('wallets.balance')
            ->first();

        if(empty($bal)){
            return false; #no data found!
        }

        return $bal->balance;
    }

    public function checkAccount(Request $request){
        $validator = Validator::make($request->all(),[
            'account_number' => 'required|max:11'
        ]);

        if($validator->fails()){
            return json_message(EXIT_FORM_NULL,'Validation errors',$validator->errors());
        }

        try {
            $find = DB::table('wallets')
            ->join('currencies', 'wallets.currency_id', '=', 'currencies.id')
            ->join('users', 'wallets.user_id', '=', 'users.id')
            ->where('wallets.account_number', $request->account_number)           
            ->select('users.name as user_name', 'currencies.id as currency_id', 'currencies.code as currency_code')
            ->first(); // Use first() if expecting only one result

            if(empty($find)){
                return json_message(EXIT_SUCCESS,'Invalid-acct');
            }

            return json_message(EXIT_SUCCESS,'ok',$find);
        } catch (\Throwable $th) {
            \Log::error('Registration failed', ['error' => $th->getMessage()]);
        }

    }
}
