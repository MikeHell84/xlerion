<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     * Return 401 JSON for unauthenticated API requests.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            // For API clients return JSON 401
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }

            // Otherwise redirect to login (for web)
            return redirect()->guest('/login');
        }

        return $next($request);
    }
}
