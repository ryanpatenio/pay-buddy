<?php

namespace App\Http\Controllers;

use App\Models\Earnings;
use App\Models\Wallets;
use App\Services\WalletService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Throw_;

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
            'account_name'   => 'required|string',
            'fee'            => 'required|numeric'
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
        #change the + 1 when the fees is implemented
        if ($senderBal < $request->amount + 1) {
            return json_message(EXIT_FORM_NULL, 'Insufficient Wallet Balance!');
        }

        $senderWalletId = $this->walletService->getUserwallet(null,$request->currency);
        $receiverWalletId = $this->walletService->getUserWallet($request->account_number, null);

        if($senderWalletId->id === $receiverWalletId->user_id){
           
            return json_message(EXIT_FORM_NULL, 'You cannot send money to your own wallet!');
        }
    
        try {
            $transactionData = DB::transaction(function () use ($request) {
                // Get Wallet Information
                $senderWallet = $this->walletService->getUserWallet(null, $request->currency);
                $receiverWallet = $this->walletService->getUserWallet($request->account_number, null);
        
                if (empty($senderWallet) || empty($receiverWallet)) {
                    throw new \Exception('Wallet not found!');
                }
        
                // Generate transaction IDs
                $transactionIdSender = $this->walletService->generateTransactionID();
                $clientRefIdSender = $this->walletService->genClient_ref();
        
                // Create the Sender Transaction (Debit)
              $transactionLastInsertedId =  DB::table('transactions')->insertGetId([
                    'wallet_id' => $senderWallet->sender_wallet_id,
                    'receiver_wallet_id' => $receiverWallet->id,
                    'transaction_id' => $transactionIdSender,
                    'client_ref_id' => $clientRefIdSender,
                    'type' => 'Debit',
                    'amount' => $request->amount,
                    'fee' => $request->fee,
                    'status' => 'success',
                    'description' => 'Transfer Money',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'currency_id'=> $senderWallet->sender_currency_id
                ]);
        
                // Deduct from sender's wallet
                $deductAmount = $request->amount + $request->fee; 
                Wallets::where('id', $senderWallet->sender_wallet_id)->decrement('balance', $deductAmount);

                #earning Save in the database  Table Earnings
                $earningSave = $this->storeInEarnings($transactionLastInsertedId,$senderWallet->id,$request->fee);
                if(!$earningSave){
                    throw new \Exception('Failed to store earning information.');
                }
        
                // Generate transaction ID for receiver
                $transactionIdReceiver = $this->walletService->generateTransactionID();
                $clientRefIdReceiver = $this->walletService->genClient_ref();
        
                // Create the Receiver Transaction (Credit)
                DB::table('transactions')->insert([
                    'wallet_id' => $receiverWallet->id,
                    'receiver_wallet_id' => null,
                    'transaction_id' => $transactionIdReceiver,
                    'client_ref_id' => $clientRefIdReceiver,
                    'type' => 'Credit',
                    'amount' => $request->amount,
                    'fee' => 0,
                    'status' => 'success',
                    'description' => 'Received Money',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'currency_id' => $senderWallet->sender_currency_id
                ]);
        
                // Add amount to receiver's wallet
                Wallets::where('id', $receiverWallet->id)->increment('balance', $request->amount);
        
                // 🔹 Retrieve the last transaction of the sender
                return DB::table('transactions')
                    ->where('transaction_id', $transactionIdSender) // Get the sender transaction
                    ->first();
            });
                
            return response()->json([
                'message' => 'Transaction successful!',
                'transaction_id' => $transactionData->transaction_id
            ],200);

        } catch (\Exception $e) {
            handleException($e,'transaction Error');
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
    }

    public function getTransaction($id){

        $transaction = DB::table('transactions as t')
        ->join('wallets as w', 't.receiver_wallet_id', '=', 'w.id')
        ->join('users as u', 'w.user_id', '=', 'u.id')
        ->join('currencies as c', 'w.currency_id', '=', 'c.id')
        ->selectRaw("
            CASE 
                WHEN t.description = 'Transfer Money' THEN '__SEND MONEY__' 
            END AS transaction_type,
            u.name,
            w.account_number,
            t.created_at AS transaction_date,
            t.transaction_id,
            c.code,
            t.amount,
            t.fee,
            t.status
        ")
        ->where('t.transaction_id', $id)
        ->first(); // Using first() to get a single result

        if (!$transaction) {
            return response()->json(['error' => 'Transaction not found'], 404);
        }
    
        return response()->json($transaction);
    
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

    

}

    /*SELECT DATE_FORMAT(earned_at, '%Y-%m') AS month, SUM(amount) AS total_earnings
        FROM earnings
        GROUP BY month
        ORDER BY month DESC;

    $earningsByMonth = DB::table('earnings')
        ->selectRaw("DATE_FORMAT(earned_at, '%Y-%m') as month, SUM(amount) as total_earnings")
        ->groupBy('month')
        ->orderByDesc('month')
        ->get();

        create()	When inserting a single record using mass assignment
        insert()	When inserting multiple records (fast but no timestamps)
        save()	When inserting with additional logic before saving
*/


