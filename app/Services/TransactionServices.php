<?php

namespace App\Services;

use App\Models\BankPartners;
use App\Models\Transactions;
use App\Models\Wallets;
use App\Services\WalletService;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;


class TransactionServices
{
    private $walletService;

    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;   
    }

    public function sendMoneyToBank($senderWalletId, $receiverBankAccount, $amount, $fee, $description = null,$bank,$currency)
    {
        // Retrieve sender wallet
        $senderWallet = Wallets::findOrFail($senderWalletId);

        // Retrieve the bank partner (e.g., BPI)
        $bankPartner = BankPartners::where('name', $bank)->firstOrFail();

        // Generate a unique transaction ID
        $transactionId = $this->walletService->generateTransactionID();

        // Prepare the payload for the bank API
        $payload = [
            'account_number' => $receiverBankAccount,
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
                'wallet_id' => $senderWalletId,
                'receiver_wallet_id' => null, // No receiver wallet for bank transactions
                'api_key_id' => $bankPartner->id,
                'transaction_id' => $transactionId,
                'client_ref_id' => $clientRefId, // Bank's reference ID
                'type' => 'debit', // Deduct from sender's wallet
                'amount' => $amount,
                'fee' => $fee,
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
    protected function storeEarnings(int $transactionId, $user_id, float $fee): void
    {
        // Logic to store earnings (replace with your implementation)
        if (!$this->walletService->storeInEarnings($transactionId, $user_id, $fee)) {
            throw new Exception('Failed to store earning information.');
        }
    }

    
}