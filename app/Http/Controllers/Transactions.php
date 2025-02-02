<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Transactions extends Controller
{
  
    public function index(){
       
        return view('transaction.index');
    }

    public function sendMoneyToUser(Request $request){

        $request->validate([
          'account_number'=> 'required|integer|max:11',
            'account_name' => 'required|string',
            'currency'=> 'required|string',
            'amount'=>'required|integer'
            
        ]);
        #get Currency
        $exists = DB::table('currencies')
            ->where('code', '=', $request->currency)
            ->exists(); // Returns true or false

        if (!$exists) {
            return response()->json(['error' => 'Currency not found'], 404);
        }
        

        #check account number of the Receiver if exist
        $isExistAcctNumber = DB::table('wallets')
            ->where('account_number',$request->account_number);
            

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
