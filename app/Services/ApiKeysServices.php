<?php

namespace App\Services;

use App\Models\Api_keys;
use App\Models\currency;
use App\Models\Wallets;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ApiKeysServices{

/**
 * Generate random string
 * 
 * @return String $apikey
 */
public function generateApiKey(){

    $apiKey = Str::random(50);

    // Api_keys::updateOrCreate([
    //     'user_id' => $user_id,
    //     'api_key' => hash('sha256',$apiKey)
    // ]);
    return $apiKey;
}

/**
 * @return array Users api keys Data
 */
public function showUserApiKey(){
    return Api_keys::where('user_id', Auth::id())
    ->where('status', 'active')
    ->whereDate('expires_at', '>', Carbon::today()) // Check for non-expired keys
    ->get();
}

/**
 *  Get the User Data by using APi Key
 * 
 * @param string $apikey
 * @return array 'user_id,api_id'
 * 
 * */ 
 public function getUserByApiKey($apiKey){
    if(!$apiKey){
        return false;
    }
    $hash_api = hash('sha256', $apiKey);
    $data = Api_keys::where('api_key',$hash_api)
        ->where('status','active')
        ->first();
    return [
        'user_id'=>$data->user_id,
        'api_id' => $data->id,
      
    ];
 }

/**
 * Get the user's wallet balance for a specific currency.
 *
 * @param array $data An array containing the user ID and currency details.
 * @return float The user's wallet balance as a numeric value.
 * @throws Exception If the user's wallet balance is not found.
 */
 public function getUserBalance($data){

    $this->validateBalanceInquiry($data);

    try {
      //get the validated User ID
      $user_id = $data['user_id']; 
      $currency = $data['currency'];

      #convert currency code into currency id
      $currencyObj = $this->convertCurrencyCodeIntoId($currency);
      if(!$currency){
        throw new Exception('Invalid Currency Code');
      }
     
      $walletBalance = Wallets::where('user_id',$user_id)
            ->where('currency_id',$currencyObj->id)
            ->first();

      if(!$walletBalance){
        throw new Exception('User wallet Balance not Found!');
      }
      return $walletBalance->balance;

    } catch (\Throwable $th) {
        //throw $th;
        be_logs('Failed to get User Balance : ',$th);
    }

 }
/**
 * Validate the balance inquiry request data.
 *
 * This function checks if the required fields (`user_id` and `currency`) are present in the input data.
 * If any of the required fields are missing, an exception is thrown.
 *
 * @param array $data The input data containing `user_id` and `currency`.
 * @return void
 * @throws Exception If `user_id` or `currency` is missing.
 */
 protected function validateBalanceInquiry( array $data) {
    if(empty($data['user_id'])){
        throw new Exception('user id is required!');
    }
    if(empty($data['currency'])){
        throw new Exception('currency is required!');
    }
 }

 /**
  * Convert Currency Code 'PHP' to its ID
  * @param string Currency Code  ex : PHP
  * @return Object currencies table [id,code,name,symbols,img]
  */
 protected function convertCurrencyCodeIntoId( string $currency_code){
    if(empty($currency_code)){
        throw new Exception('currency id is required');
    }

    return currency::where('code',$currency_code)
        ->first();

 }

 protected function validateCredit(array $data){
    if(empty($data[''])){
        throw new Exception('');
    }
 }

}


