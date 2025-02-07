<?php

namespace App\Http\Controllers;

use App\Models\BankPartners;
use App\Services\WalletService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BankController extends Controller
{
    private $walletService;

    public function __construct(WalletService $walletService)
    {
       $this->walletService = $walletService; 
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
