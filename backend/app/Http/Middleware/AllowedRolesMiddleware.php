<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AllowedRolesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Ensure user is authenticated
        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized! Please log in first.'], 401);
        }
    
        // If the user is an admin (role 0), let them pass
        if ($user->role == 0) {
            return $next($request);
        }
    
        // If the user role is not in the allowed roles, deny access
        if (!in_array($user->role, $roles)) {
            return response()->json(['message' => 'Unauthorized! You do not have the required permissions.'], 403);
        }
    
        return $next($request);
    }
    
}
