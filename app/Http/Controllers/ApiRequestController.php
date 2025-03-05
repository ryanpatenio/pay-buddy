<?php

namespace App\Http\Controllers;

use App\Models\Api_keys;
use App\Services\ApiKeysServices;
use App\Services\ApiLogsServices;
use App\Services\WalletService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiRequestController extends Controller
{
    //for API REQUEST
    private $apiServices;
    private $walletService;
    private $apiLogService;

    public function __construct(ApiKeysServices $apikeyServices,WalletService $walletServices,ApiLogsServices $apiLogServices)
    {
        $this->apiServices = $apikeyServices;
        $this->walletService = $walletServices;
        $this->apiLogService = $apiLogServices;
    }


 public function checkBalance(Request $request){
    $apiKey = $request->header('X-API-Key');
    $currency = $request->only('currency')['currency'];
    if (!$apiKey) {
        return response()->json(['error' => 'API key is required'], 400);
    }

    // Retrieve the user associated with the API key
    $user = $this->apiServices->getUserByApiKey($apiKey);
    if(!$user){
        return json_message(EXIT_401,'Invalid Api Key!');
    }

    #data
    $data = [
        'user_id' => $user['user_id'],
        'currency'=> $currency
    ];

    try {
      $balance = $this->apiServices->getUserBalance($data);

      return json_message(EXIT_SUCCESS,'ok',['balance'=>$balance]);

    } catch (\Throwable $th) {
       handleException($th,'Failed to fetch user Balance');
       return json_message(EXIT_BE_ERROR,'Failed to fetch User Balance');
    }

 }
/**
 * Add to user wallet Balance
 * @param Request 
 * @return array
 * 
 */
 public function credit(Request $request){

    $apiKey = $request->header('X-API-Key');
    if(!$apiKey){
        return json_message(EXIT_401,'Invalid Api Key');
    }
    /**
     * Expects payload
     * api key
     * currency PHP,USD,EUR
     * amount
     * Client Ref
     * 
     */

     $validator = Validator::make($request->all(),[
        'currency'=> 'required|string',
        'amount'  => 'required|numeric',
        'client_ref' => 'required'
        
     ]);  

     if($validator->fails()){
        return json_message(EXIT_FORM_NULL,'validation error',$validator->errors());
     }
    
    $user = $this->apiServices->getUserByApiKey($apiKey);
    if(!$user){
        return json_message(EXIT_401,'Invalid Api Key!');
    }
    $apiObj = $this->apiServices->getApiId($apiKey);
    if(!$apiObj){
        return json_message(EXIT_401,'Invalid Api');
    }
    $currencyObj = $this->apiServices->convertCurrencyCodeIntoId($request['currency']);
    if(!$currencyObj){
        return json_message(EXIT_401,'Invalid Currency');
    }
    
    $currency_id = $currencyObj->id;
    $user_id = $user['user_id'];

    $walletObj = $this->apiServices->getUserWalletBalance($currency_id,$user_id);
    if(!$walletObj){
        return json_message(EXIT_401,'No wallet Balance Found!');
    }
    $fee = $this->walletService->getFee('external_api',$request['currency']); #for debit only
    
    $wallet_id = $walletObj->id;

    //check if the transactions client ref is exist
    $isExistClientRef = $this->apiServices->isTransactionExist($walletObj->id,$request['client_ref']);
    if($isExistClientRef){
        //exist
        return json_message(EXIT_FORM_NULL,'Duplicate transaction: client_ref already exists.');
    }

    $data = [
        'wallet_id' => $wallet_id,
        'api_key_id'    => $apiObj->id,
        'client_ref' => $request['client_ref'],
        'amount'     => $request['amount'],
        'user_id'  => $user_id,
        'description' => $request['description'],
        'fee'         => $fee,
        'currency_id' => $currency_id,
        'currency_code' => $request['currency']
    ];

    try {
        $response =  $this->apiServices->createCredit($data);

        $useLogs = [
           'api_key_id' => $apiObj->id,
           'request_data' => $request->all(),
           'response_data' => $response
       ];
       //api logs
       $this->apiLogService->createLogs($useLogs,$response);
       //return response
       return json_message(EXIT_SUCCESS,'ok',$response);

    } catch (\Throwable $th) {
       // handleException($th,'Failed to create Transaction');
        return json_message(EXIT_BE_ERROR,'error');
    }


 }

 public function debit(Request $request){
    $apiKey = $request->header('X-API-Key');
    if(!$apiKey){
        return json_message(EXIT_401,'Invalid Api Key');
    }

    $validator = Validator::make($request->all(),[
        'currency'=> 'required|string',
        'amount'  => 'required|numeric',
        'client_ref' => 'required'
        
     ]);  

     if($validator->fails()){
        return json_message(EXIT_FORM_NULL,'validation error',$validator->errors());
     }

         
    $user = $this->apiServices->getUserByApiKey($apiKey);
    if(!$user){
        return json_message(EXIT_401,'Invalid Api Key!');
    }
    $apiObj = $this->apiServices->getApiId($apiKey);
    if(!$apiObj){
        return json_message(EXIT_401,'Invalid Api');
    }
    $currencyObj = $this->apiServices->convertCurrencyCodeIntoId($request['currency']);
    if(!$currencyObj){
        return json_message(EXIT_401,'Invalid Currency');
    }
    
    $currency_id = $currencyObj->id;
    $user_id = $user['user_id'];

    $walletObj = $this->apiServices->getUserWalletBalance($currency_id,$user_id);
    if(!$walletObj){
        return json_message(EXIT_401,'No wallet Balance Found!');
    }
    $fee = $this->walletService->getFee('external_api',$request['currency']); #for debit only
    
    $wallet_id = $walletObj->id;
    $creditAmount = $request['amount'];

    if($creditAmount > $walletObj->balance){
        return json_message(EXIT_401,'Insufficient Balance');
    }

    //check if the transactions client ref is exist
    $isExistClientRef = $this->apiServices->isTransactionExist($walletObj->id,$request['client_ref']);
    if($isExistClientRef){
        //exist
        return json_message(EXIT_FORM_NULL,'Duplicate transaction: client_ref already exists.');
    }


    $data = [
        'wallet_id' => $wallet_id,
        'api_key_id'    => $apiObj->id,
        'client_ref' => $request['client_ref'],
        'currentBalance'=> $walletObj->balance,
        'amount'     => $request['amount'],
        'user_id'  => $user_id,
        'fee'         => $fee,
        'currency_id' => $currency_id,
        'currency_code' => $request['currency']
        
    ];

    try {
        $response = $this->apiServices->createDebit($data);
        
        $useLogs = [
            'api_key_id' => $apiObj->id,
            'request_data' => $request->all(),
            'response_data' => $response
        ];
        //api logs
        $this->apiLogService->createLogs($useLogs,$response);
        //return response
        return json_message(EXIT_SUCCESS,'ok',$response);
        
    } catch (\Throwable $th) {
        return json_message(EXIT_BE_ERROR,'error');
    }
    

 }

}
