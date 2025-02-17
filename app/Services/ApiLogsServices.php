<?php

namespace App\Services;

use Exception;

class ApiLogsServices{

public function createLogs( array $data){

    $this->validateData($data);

    try {
       

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
    if(empty($data['response_date'])){
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