<?php

namespace App\Services;

use App\Models\api_logs;
use Exception;

class ApiLogsServices{

public function createLogs( array $data){

    $this->validateData($data);

    try {
     api_logs::create([
        'api_key_id' => $data['api_key_id'],
        'request_data' => json_encode($data['request_data']),
        'response_data' => json_encode($data['response_data']),
        'status'       => $data['response_data']['status']
     ]);

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

#example on how to create logs
// ApiLog::create([
//     'api_key_id' => $apiKeyRecord ? $apiKeyRecord->id : null, // Associate with the API key if it exists
//     'request_data' => json_encode($request->all()), // Log the request payload
//     'response_data' => json_encode($response), // Log the response payload
//     'status' => $status, // Log the status (default is 'success')
// ]);

}