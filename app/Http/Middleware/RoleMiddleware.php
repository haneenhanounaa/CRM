<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$role): Response
    {
        
        // Check if the authenticated user's role matches the required role
        if (auth()->user() && auth()->user()->role !== $role) {
        
             abort(403, 'Unauthorized action.'); // Deny access
        }
        return $next($request); // Allow access
    }
}
