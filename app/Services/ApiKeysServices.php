<?php

namespace App\Services;

use App\Models\Api_keys;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ApiKeysServices{

    public function generateApiKey(){
    
        $apiKey = Str::random(50);

        // Api_keys::updateOrCreate([
        //     'user_id' => $user_id,
        //     'api_key' => hash('sha256',$apiKey)
        // ]);
       return  hash('sha256',$apiKey);
    }
}