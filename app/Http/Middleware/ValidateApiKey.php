<?php

namespace App\Http\Middleware;

use App\Models\Api_keys;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ValidateApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $apiKey = $request->header('api_key'); // Retrieve the API key from the request header

        if (!$apiKey) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        // Hash the API key
        $hashedApiKey = hash('sha256', $apiKey);
        
        // Fetch API key details in one query
        $key = Api_keys::where('api_key', $hashedApiKey)
            ->where('status', 'active')
            ->first();
        
        if (!$key) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid or inactive API key'
            ], 403);
        }
     
        return $next($request); // Proceed to the next middleware or controller
    }
}
