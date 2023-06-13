<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class TerminateSession
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    public function terminate($request, $response)
    {
        if (Auth::check()) {
            Auth::logout();
        }

        return redirect()->route('inicio');
    }
}