<?php

namespace App\Http\Controllers;

use App\Models\BankPartners;
use App\Services\TransactionServices;
use App\Services\WalletService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BankController extends Controller
{
    private $walletService;
    private $transactionService;

    public function __construct(WalletService $walletService, TransactionServices $transactionService)
    {
       $this->walletService = $walletService; 
       $this->transactionService = $transactionService;
    }

    
    public function bank_option_index(){

        $bankPartners = $this->showBankPartners();

        return view('users.bankTransfer.bankOptions',compact('bankPartners'));
    }

    public function bankTransfer_index(){
       
        $userWalletBalance = $this->walletService->getSenderBalance('PHP');#boolean return false nor true return balance
        $transactionFee = $this->walletService->getFee('external_api');
       

        return view('users.bankTransfer.bankTransfer',compact('userWalletBalance','transactionFee'));
    }

    public function processBankTransfer(Request $request){
       
        $data = $request->validate([
            'account_number' => 'required|digits:12',
            'account_name'   => 'required|string|max:255',
            'amount'         => 'required|numeric|min:0',
            'fee'            => 'required|numeric|min:0',
            'bankName'       => 'required|string|max:255'
        ], [
            'account_number.required' => 'The account number is required.',
            'account_number.digits'   => 'The account number must be exactly 12 digits.',
            'account_name.required'   => 'The account name is required.',
            'amount.required'         => 'The amount is required.',
            'amount.numeric'          => 'The amount must be a number.',
            'amount.min'              => 'The amount must be at least 0.',
            'fee.required'            => 'The fee is required.',
            'fee.numeric'             => 'The fee must be a number.',
            'fee.min'                 => 'The fee must be at least 0.',
            'bankName.required'       => 'The bank name is required.',
        ]);
       
        #payload
        $account_number = $data['account_number'];
        $account_name = $data['account_name'];
        $amount = $data['amount'];
        $fee = $data['fee'];
        $bankName = $data['bankName'];
        $currency = 'PHP';#default | app features only PHP currency
        $description = 'BankTransfer';

        #get the Sender Wallet ID
        $senderWalletId = $this->walletService->getUserWallet(null,'PHP');#return data of the authenticated User wallet ID 

        try {
            $transferMoney = $this->transactionService->sendMoneyToBank($senderWalletId->sender_wallet_id,$account_number,$amount,$fee,$description,$bankName,$currency);
            return $transferMoney;

        } catch (\Throwable $th) {
            handleException($th,'transaction Error');
            return response()->json(['error' => $th->getMessage()], 500);
        }

    }

    public function bankSelected(Request $request){
        $data = $request->validate([
            'bankName'=>'required|string'
        ]);
        
        $bankData = $this->showBankPartners($data['bankName']);
        if(empty($bankData)){
            return json_message(EXIT_FORM_NULL,'No Banks found!');
        }

        return json_message(EXIT_SUCCESS,'ok',$bankData);

    }

    public function showBankPartners(?string $bankName = null){
        // If a bank name is provided, return a single row
        if (!empty($bankName)) {
            $bankData = DB::table('bank_partners')
                ->where('name', $bankName)
                ->select('name', 'img_url', 'description')
                ->first();

            // Return the bank data or an empty array if no record is found
            return $bankData ?: [];
        }

        // If no bank name is provided, return all rows
        return DB::table('bank_partners')
            ->select('name', 'url', 'img_url', 'description')
            ->get();
    }
}
