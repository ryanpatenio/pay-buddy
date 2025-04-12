<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    
     private $roleMap = [
        'user' => 0,
        'admin' => 1,
        'super_admin' => 2,
    ];
    
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();
    
        // Redirect to login page for unauthenticated users
        if (!Auth::check()) {
            return redirect()->route('login');
        }
    
        // Split the roles parameter into an array
        $roles = explode('|', $roles[0]);
  
        // Convert role names to their respective numeric values
        $roleIds = array_map(function ($role) {
            return $this->roleMap[$role] ?? null;
        }, $roles);

        // Check if the user has one of the required roles
        if (!$user || !in_array($user->role, $roleIds)) {
            return response()->json([
                'message' => 'Unauthorized '], Response::HTTP_FORBIDDEN);
        }
    
        return $next($request);
    }
    
}
