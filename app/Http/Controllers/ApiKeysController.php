<?php

namespace App\Http\Controllers;

use App\Models\Api_keys;
use App\Services\ApiKeysServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiKeysController extends Controller
{
    private $apiKeyService;
    public function __construct(ApiKeysServices $apiKeysServices)
    {
        $this->apiKeyService = $apiKeysServices;
    }
   
    public function api_index(){

        return view('users.api_keys.api_keys');
    }

    public function generateKey(){
        $generatedKey = $this->apiKeyService->generateApiKey();
        if(empty($generatedKey)){
            return json_message(EXIT_BE_ERROR,'cant Generate Key');
        }
        return json_message(EXIT_SUCCESS,'ok',$generatedKey);
    }

    public function createKey(Request $request){
        $validator = validator($request->all(),[
            'genKey'=>'required|string',
            'name' => 'required|string'
        ]);

        if($validator->fails()){
            return json_message(EXIT_FORM_NULL,'validation Error',$validator->errors());
        }
        $data = $validator->validated();

        $user_id = Auth::id();
        #check if the user is already have a api key in the db
        #user can generate only one key
        $isAlreadyHaveKey = Api_keys::where('user_id',$user_id)->first();
        if(!empty($isAlreadyHaveKey)){
            return json_message(EXIT_FORM_NULL,'You already have Api key Created! User can only generate Api key once!');
        }

        $findKey = Api_keys::where('api_key',$data['genKey'])->where('user_id',$user_id)->first();
        if(!empty($findKey)){
            return json_message(EXIT_FORM_NULL,'Key already exist!');
        }

        try {
            $create = Api_keys::create([
                'name'=>$data['name'],
                'user_id' => $user_id,
                'api_key' => $data['genKey']              
            ]);
            if(!$create){
                return json_message(EXIT_BE_ERROR,'Failed to Create key!');
            }
            return json_message(EXIT_SUCCESS,'ok');
        } catch (\Throwable $th) {
            be_logs('Failed to Create Key',$th);
            return json_message(EXIT_BE_ERROR,'Failed to ceate Key!');
        }

    }
}
