<?php

namespace App\Exceptions;

use Exception;

class BankTransferException extends Exception
{
    protected string $errorCode;
    
    public function __construct(
        string $message, 
        string $errorCode = 'GENERAL_ERROR', 
        int $statusCode = 422
    ) {
        parent::__construct($message, $statusCode);
        $this->errorCode = $errorCode;
    }
    
    public function getErrorCode(): string
    {
        return $this->errorCode;
    }
    
    public function render($request)
    {
        return response()->json([
            'status' => 'error',
            'code' => $this->errorCode,
            'message' => $this->getMessage(),
            'data' => []
        ], $this->getCode());
    }
}
