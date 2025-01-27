<?php

namespace App\Http\Middleware;

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
            return response()->json([
                'status' => 'error',
                'message' => 'API key is required'
            ], 401);
        }
        $key = DB::table('api_keys')
            ->where('api_key', $apiKey)
            ->where('status', 'active')
            ->first();

        if (!$key) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid or inactive API key'
            ], 403);
        }

        # Add user ID or any related information to the request
        $request->merge(['user_id' => $key->user_id]);

        return $next($request); // Proceed to the next middleware or controller
    }
}
