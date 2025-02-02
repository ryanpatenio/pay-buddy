<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next, ...$guards)
    {
        // For web routes (session-based authentication)
        if (in_array('web', $guards)) {
            if (!Auth::check()) {
                return redirect()->route('login');  // Redirect to login page for unauthenticated users
            }
        }
    
        // For API routes (token-based authentication via Sanctum)
        if (in_array('api', $guards)) {
            if (!Auth::guard('api')->check()) {
                return response()->json(['message' => 'Unauthenticated'], 401); // 401 Unauthorized response
            }
        }
    
        return $next($request);
    }
    
}
