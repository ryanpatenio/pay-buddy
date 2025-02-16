<?php

namespace App\Http\Controllers;

use App\Models\Api_keys;
use App\Services\ApiKeysServices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class ApiKeysController extends Controller
{
    private $apiKeyService;
    public function __construct(ApiKeysServices $apiKeysServices)
    {
        $this->apiKeyService = $apiKeysServices;
    }
   
    public function api_index(){
        $userApiKey = $this->apiKeyService->showUserApiKey();

        return view('users.api_keys.api_keys',compact('userApiKey'));
    }

    public function index_admin(){
        
        return view('admin.user-api-keys');
    }

    public function generateKey(){
        $generatedKey = $this->apiKeyService->generateApiKey();

        if(empty($generatedKey)){
            return json_message(EXIT_BE_ERROR,'cant Generate Key');
        }
        return json_message(EXIT_SUCCESS,'ok',$generatedKey);
    }

    public function createApiKey(Request $request){

        $user_id = Auth::id();
        $apiKey = $this->apiKeyService->generateApiKey();

        #user can generate only one key
        $isAlreadyHaveKey = Api_keys::where('user_id',$user_id) #check if the user is already have a api key in the db
            ->where('status','active')
            ->first();
        if($isAlreadyHaveKey){
            return json_message(EXIT_FORM_NULL,"You already have an active API key. Each user is allowed to have only one active API key at a time. If you'd like to create a new one, go to the actions menu, click the three dots, and select Regenerate");
        }
        
        $hash_api =  hash('sha256',$apiKey);

        $findKey = Api_keys::where('api_key',$hash_api)->where('user_id',$user_id)->first();
        if($findKey){
            return json_message(EXIT_FORM_NULL,'Key already exist!');
        }     
       
        try {
            
            Api_keys::create([
                'user_id' => $user_id,
                'api_key' => $hash_api,
                'expires_at' => Carbon::now()->addDays(30),            
            ]);

            return json_message(EXIT_SUCCESS,'ok',$apiKey);

        } catch (\Throwable $th) {
            be_logs('Failed to Create Key',$th);
            return json_message(EXIT_BE_ERROR,'Failed to ceate Key!');
        }

    }

    public function regenerateNewApiKey(Request $request){
        $request->validate([
            'id' => 'required|numeric|exists:api_keys,id',
            
        ],[
            'id.required'=>'Invalid or Missing ID',
            'id.numeric' => 'expected Integer instead of String',
            'id.exists'  => 'Invalid or Missing ID'
        ]
        );

        try {
            $user_id = Auth::id();
            $this->revokeActiveapiKeys($user_id);#revoke all Actives APi before creating new one
    
            $orig_api = $this->apiKeyService->generateApiKey();
            $hash_api = hash('sha256',$orig_api);

            Api_keys::create([
                'user_id'=> $user_id,
                'api_key'=> $hash_api,
                'expires_at'=> Carbon::now()->addDays(30)
            ]);

            return json_message(EXIT_SUCCESS,'ok',$orig_api);

        } catch (\Throwable $th) {
           handleException($th,'Failed to regenerate new Api Key! ');
           return json_message(EXIT_BE_ERROR,'Failed to regenerate New Api Key!');
        }
  
    }

    public function revokeActiveapiKeys(int $user_id) :void {

            $activeApiKeys = Api_keys::where('user_id', $user_id)
            ->where('status', 'active')
            ->where('expires_at', '>', Carbon::now()) // Check for non-expired keys
            ->get();

        // Revoke the keys if any are found
        if ($activeApiKeys->isNotEmpty()) {
            $activeApiKeys->each(function ($apiKey) {
                $apiKey->update([
                    'status' => 'revoked',
                    'revoked_at' => Carbon::now(),
                ]);
                //events or LOGs
            });
        }
    }
}
