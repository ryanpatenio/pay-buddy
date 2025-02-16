<?php

namespace App\Services;

use App\Models\Api_keys;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ApiKeysServices{

    public function generateApiKey(){
    
        $apiKey = Str::random(50);

        // Api_keys::updateOrCreate([
        //     'user_id' => $user_id,
        //     'api_key' => hash('sha256',$apiKey)
        // ]);
       return $apiKey;
    }

    public function showUserApiKey(){
        return Api_keys::where('user_id', Auth::id())
        ->where('status', 'active')
        ->whereDate('expires_at', '>', Carbon::today()) // Check for non-expired keys
        ->get();
    }
}