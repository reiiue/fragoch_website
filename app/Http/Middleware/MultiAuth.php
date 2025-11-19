<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class MultiAuth
{
    public function handle($request, Closure $next)
    {
        // Allow user (web guard)
        if (Auth::guard('web')->check()) {
            return $next($request);
        }

        // Allow admin
        if (Auth::guard('admin')->check()) {
            return $next($request);
        }

        // Not logged in → redirect
        return redirect()->route('login');
    }
}
