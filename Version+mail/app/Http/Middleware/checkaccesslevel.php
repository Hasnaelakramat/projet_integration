<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAccessLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if ($user && in_array($user->type, [0,1,2,3])) {
            return $next($request);
        }

        // If the user's access level is not 1 or 2, you can return a response or redirect them to a different page
        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
