<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class check_is_president
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::User();
    
        // Check if the user has the required access level
        
        if ($user->type===0) {
            return $next($request);
        }
    
        // Redirect or return an appropriate response if the access level is not allowed
        return response()->json(['message' => 'you are not the president'], 401);
    }
}
