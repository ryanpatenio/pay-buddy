<?php

namespace App\Http\Controllers;

use App\Models\Earnings;
use App\Models\Wallets;
use App\Services\TransactionServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Throw_;

// use App\Services\TransactionService;

class Transactions extends Controller
{   
   
    private $transactionService;

    public function __construct(TransactionServices $transactionService)
    {
       
        $this->transactionService = $transactionService;
    }
  
    public function index(){
       
        return view('transaction.index');
    }

    public function sendMoneyToUser(Request $request)
    {
        try {
            $response = $this->transactionService->sendMoneyToUser($request->all());
            return response()->json($response, 200);

        } catch (\Throwable $th) {
            handleException($th,'transaction Error');
            return response()->json(['error' => $th->getMessage()], 500);
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


