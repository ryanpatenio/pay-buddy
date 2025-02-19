<?php

namespace App\Http\Controllers;

use App\Models\Api_keys;
use App\Services\ApiKeysServices;
use Illuminate\Http\Request;

class ApiRequestController extends Controller
{
    //for API REQUEST
    private $apiServices;

    public function __construct(ApiKeysServices $apikeyServices)
    {
        $this->apiServices = $apikeyServices;
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

    

 }

}
