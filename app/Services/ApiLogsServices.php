<?php

namespace App\Services;

use App\Models\api_logs;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class ApiLogsServices{

    /**
     * @param array data ['api_id','request_data','response_data','status']
     * @return boolean
     */

public function createLogs( array $data){

    $this->validateData($data);

    try {
     api_logs::create([
        'api_key_id' => $data['api_key_id'],
        'request_data' => json_encode($data['request_data']),
        'response_data' => json_encode($data['response_data']),
        'status'       => $data['response_data']['status']
     ]);
     return true;

    } catch (\Throwable $th) {
        handleException($th,'Failed to create Logs for APi');
        return false;
    }
}
/**
 * Validate Data
 * @param data
 * @return void
 */

private function validateData(array $data) :void {
    if(empty($data['api_key_id'])){
        throw new Exception('api id required');
    }
    if(empty($data['request_data'])){
        throw new Exception('request data required');
    }
    if(empty($data['response_data'])){
        throw new Exception('response data required');
    }
}

/**
 * @return Collection|Object ['created_at, name, api_key, status, user_id']
 */
public function showAllLogs(){
    $query = DB::table('api_logs')
    ->join('api_keys', 'api_logs.api_key_id', '=', 'api_keys.id')
    ->join('users', 'api_keys.user_id', '=', 'users.id')
    ->selectRaw('MAX(api_logs.created_at) as created_at, users.name, api_keys.api_key, api_logs.status, users.id as user_id')
    ->groupBy('users.name', 'api_keys.api_key', 'api_logs.status','users.id')
    ->orderByDesc('created_at')
    ->get()
    ->map(function($logs){
        $logs->created_at = Carbon::parse($logs->created_at)->format('F j, Y,  h : i A');;
        return $logs;
    });

    return $query;
}
public function showUserApiLogs(int $user_id){
    $query = DB::table('api_logs')
            ->join('api_keys', 'api_logs.api_key_id', '=', 'api_keys.id')
            ->join('users', 'api_keys.user_id', '=', 'users.id')
            ->where('users.id',$user_id)
            ->selectRaw('
                users.name,api_keys.api_key,api_logs.created_at,api_logs.status,api_logs.id
            ')
            ->orderByDesc('created_at')
            ->get()
            ->map(function($logs){
                $logs->created_at = Carbon::parse($logs->created_at)->format('F j, Y,  h : i A');;
                return $logs;
            });
    return $query;
}
#example on how to create logs
// ApiLog::create([
//     'api_key_id' => $apiKeyRecord ? $apiKeyRecord->id : null, // Associate with the API key if it exists
//     'request_data' => json_encode($request->all()), // Log the request payload
//     'response_data' => json_encode($response), // Log the response payload
//     'status' => $status, // Log the status (default is 'success')
// ]);

}