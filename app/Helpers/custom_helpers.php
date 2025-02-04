<?php

/**
 * constant && custom helpers with Handle Exceptions
 */

use Illuminate\Database\Eloquent\ModelNotFoundException;
// Success
if (!defined('EXIT_SUCCESS')) {
    define('EXIT_SUCCESS', 'EXIT_SUCCESS'); // Maps to HTTP 200
}

// Backend Error
if (!defined('EXIT_BE_ERROR')) {
    define('EXIT_BE_ERROR', 'EXIT_BE_ERROR'); // Maps to HTTP 500
}

// Form Validation Error (Missing Fields)
if (!defined('EXIT_FORM_NULL')) {
    define('EXIT_FORM_NULL', 'EXIT_FORM_NULL'); // Maps to HTTP 422
}

// Default/Fallback (Generic Error)
if (!defined('EXIT_DEFAULT')) {
    define('EXIT_DEFAULT', 'EXIT_DEFAULT'); // Maps to HTTP 400
}


if (!function_exists('json_message')) {
    /**
     * Return a formatted JSON response.
     *
     * @param string $message
     * @param int $status
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    function json_message($code, $message, $data = [])
    {
        // Default status code (500 for server error)
        $statusCode = 500;
    
        // Define the status code based on the $code parameter
        switch ($code) {
            case 'EXIT_SUCCESS':
                $statusCode = 200; // OK
                break;
    
            case 'EXIT_FORM_NULL':
                $statusCode = 422; // Unprocessable Entity (suitable for form validation errors)
                break;
    
            case 'EXIT_BE_ERROR':
                $statusCode = 500; // Internal Server Error (suitable for backend errors)
                break;
    
            default:
                $statusCode = 400; // Bad Request (used as a generic default error for unexpected cases)
                break;
        }
    
        return response()->json([
            'code'    => $code,
            'message' => $message,
            'data'    => $data,
        ], $statusCode);
    }
    
    
}

if (!function_exists('be_logs')) {
    function be_logs($message, \Throwable $exception = null) {
        if ($exception) {
            // Log error with exception details
            \Log::error($message, [
                'error' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
            ]);
        } else {
            // Log as an informational message
            \Log::info($message);
        }
    }
}


if (!function_exists('handleException')) {
    /**
     * Handle exceptions by logging and returning a formatted error response.
     *
     * @param \Throwable $exception
     * @param string $customMessage Custom error message to return
     * @param int $statusCode HTTP status code (default: 500)
     * @param int $exitCode Custom exit code for the application
     * @return \Illuminate\Http\JsonResponse
     */
    function handleException(\Throwable $exception, $defaultMessage = 'An error occurred.')
{
    // Only log detailed trace information in local or development environment
    if (app()->environment('local')) {
        \Log::error($exception->getMessage(), ['trace' => $exception->getTraceAsString()]);
    } else {
        \Log::error($exception->getMessage());  // Log only the message in production
    }

    // Handle specific exceptions, for example ModelNotFoundException
    if ($exception instanceof ModelNotFoundException) {
        // Log the specific exception but don't expose it to the user
        return response()->json([
            'status' => 404,
            'message' => 'Resource not found',
        ], 404);
    }

    // Handle other exceptions and return a generic error message
    // Do not expose the exception details in production
    $errorMessage = app()->environment('local') ? $exception->getMessage() : 'An unexpected error occurred.';

    // Return a generic error response
    return response()->json([
        'status' => 500,
        'message' => $defaultMessage,
        'error' => $errorMessage,  // In production, only send a generic message
    ], 500);
}

    
}

