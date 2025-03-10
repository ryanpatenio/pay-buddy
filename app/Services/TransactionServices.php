<?php

namespace App\Services;

use App\Models\BankPartners;
use App\Models\Transactions;
use App\Models\Wallets;
use App\Services\WalletService;
use App\Services\NotificationServices;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;


class TransactionServices
{
    private $walletService;
    private $notificationService;

    public function __construct(WalletService $walletService,NotificationServices $notificationServices)
    {
        $this->walletService = $walletService;
        $this->notificationService = $notificationServices;   
    }

    public function sendMoneyToBank($senderWalletId, $receiverBankNumber, $amount, $fee, $description = null, $bank, $currency)
    {
        // Retrieve sender wallet
        $senderWallet = Wallets::findOrFail($senderWalletId);

        // Retrieve the bank partner (e.g., BPI)s
        $bankPartner = BankPartners::where('name', $bank)->firstOrFail();

        // Generate a unique transaction ID
        $transactionId = $this->walletService->generateTransactionID();

        // Prepare the payload for the bank API
        $payload = [
            'account_number' => $receiverBankNumber,
            'amount' => $amount,
            'currency' => $currency, 
            'reference_id' => $transactionId,
            'timestamp' => now()->toIso8601String(),
        ];

        // Send request to the bank's API
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $bankPartner->api_key,
            'Content-Type' => 'application/json',
        ])->post($bankPartner->url . '/transactions/credit', $payload);

        $clientRefId = $response->json('reference_id') ?? ('fallback-' . uniqid());
        be_logs('Bank Api response : ',$response->json());

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Create a new transaction record
            $transaction = Transactions::create([
                'wallet_id' => $senderWallet->id,
                'receiver_wallet_id' => null, // No receiver wallet for bank transactions
                'api_key_id' => $bankPartner->id,
                'transaction_id' => $transactionId,#generated
                'client_ref_id' => $clientRefId, // Bank's reference ID from api response else generated fail client_ref_id
                'type' => 'debit', // Deduct from sender's wallet
                'amount' => $amount, #amount to send
                'fee' => $fee, #default 15 pesos
                'status' => $response->successful() ? 'success' : 'failed',
                'description' => $description,
            ]);

            // Deduct the amount from the sender's wallet only if the API request is successful
            if ($response->successful()) { // Correct boolean check
                $senderWallet->balance -= ($amount + $fee);
                $senderWallet->save();
            }
        
            // Commit the transaction
            DB::commit();

            return $transaction;
            
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollBack();
            be_logs('Transaction Error Sending Money to Bank',$e);
            throw $e;
        }
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
    protected function createTransaction(array $data): Transactions
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