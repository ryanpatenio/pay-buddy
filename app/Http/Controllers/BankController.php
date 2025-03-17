<?php

namespace App\Http\Controllers;

use App\Models\BankPartners;
use App\Services\TransactionServices;
use App\Services\WalletService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BankController extends Controller
{
    private $walletService;
    private $transactionService;

    public function __construct(WalletService $walletService, TransactionServices $transactionService)
    {
       $this->walletService = $walletService; 
       $this->transactionService = $transactionService;
    }

    public function index_admin(){
        $Banks = $this->showBankPartners();
        return view('admin.bankPartners.index',compact('Banks'));
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

    public function create(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:bank_partners,name',
            'url'  => 'required|url',
            'api_key' => 'required|string|max:256',
            'img_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string|max:255'
        ]);

        $api_key = Crypt::encryptString($validatedData['api_key']);//encrypted api key
        try {
            $file = $request->file('img_url');
            $fileName = 'img/banks/' . Str::random(10) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public', $fileName);

            $insert = BankPartners::create([
                'name' => $validatedData['name'],
                'url'  => $validatedData['url'],
                'api_key' => $api_key,
                'img_url' => $fileName,
                'description' => $validatedData['description']
            ]);
            if(!$insert){
                return json_message(EXIT_BE_ERROR,'failed to create new Bank');
            }

            return json_message(EXIT_SUCCESS,'ok');

        } catch (\Throwable $th) {
            handleException($th,'Failed to create new Banks');
            return json_message(EXIT_BE_ERROR,'Failed to create new Bank');
        }
    }

    public function updateBank(Request $request){

        $bank = BankPartners::find($request->hidden_id);
        if (!$bank) {
            return json_message(EXIT_404, 'The selected ID is invalid.');
        }
        //continue validations
        $validatedData = $request->validate([
            'hidden_id' => 'bail|required|numeric|exists:bank_partners,id',
            'name'      => 'required|string|max:255|unique:bank_partners,name,'.$request->hidden_id,
            'url'       => 'required|url|unique:bank_partners,url,'.$request->hidden_id,
            'description' => 'required|string|max:255',
           
        ],[
            'hidden_id.exists' => 'The selected ID is invalid.',
            'name.unique' => 'The name has already been taken.',
            'url.unique' => 'The URL has already been taken.',
        ]);

        try {   

            $bank->update([
                'name' => $validatedData['name'],
                'url'  => $validatedData['url'],
                'description' => $validatedData['description']
            ]);

            return json_message(EXIT_SUCCESS,'ok');

        } catch (\Throwable $th) {
            handleException($th,'Failed to update  Bank!');
            return json_message(EXIT_BE_ERROR,'Failed to update Bank!');
        }
    }

    public function updateBankApiKey(Request $request){
        $bank = BankPartners::find($request->b_id);
        if(!$bank){
            return json_message(EXIT_401,'Bank not found!');
        }

        $validatedData = $request->validate([
            'b_id' => 'required|numeric',
            'api_key' => 'required|string|max:255'
        ]);

        $encrypted_api_key = Crypt::encryptString($validatedData['api_key']);//encrypt new api key
        try {
            $bank->update([
                'api_key' => $encrypted_api_key
            ]);

            return json_message(EXIT_SUCCESS,'ok');//return success message

        } catch (\Throwable $th) {
            handleException($th,'failed to update Bank api key');
            return json_message(EXIT_BE_ERROR,'Failed to update bank api key');
        }
    }

    public function updateImage(Request $r){
        $bank = BankPartners::find($r->id);
        if(!$bank){
            return json_message(EXIT_401,'Bank Not found1');
        }

        $validatedData = $r->validate([
            'id' => 'required|numeric',
            'new_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            # Delete the old image if it exists
            if ($bank->img_url) {
                Storage::disk('public')->delete($bank->img_url);
            }

            $file = $r->file('new_img');
            $filename = 'img/banks/' . Str::random(10) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public', $filename);

            $bank->update([
                'img_url' => $filename
            ]);

            return json_message(EXIT_SUCCESS,'ok');

        } catch (\Throwable $th) {
           handleException($th,'Failed to update Bank Image');
           return json_message(EXIT_BE_ERROR,'Failed to update Bank Image');
        }
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
            ->select('id','name', 'url', 'img_url', 'description','created_at')
            ->get();
    }

    public function getBank(int $id){
        if(empty($id) || !is_numeric($id)){
            return json_message(EXIT_FORM_NULL,'Invalid Id');
        }

        try {

            $bank = BankPartners::where('id',$id)
                ->select('id','name','url','img_url','description')
                ->first();
            return json_message(EXIT_SUCCESS,'ok',$bank);

        } catch (\Throwable $th) {
            handleException($th,'Failed to fetch bank');
            return json_message(EXIT_BE_ERROR,'Failed to fetch Bank');
        }
    }
}
