<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckQRCodeAccess
{
    public function handle($request, Closure $next)
    {
        // Check if the request is coming from the specified URL
        if ($request->is('moeeventscanqrcode/*')) {
            return $next($request);
        }

        // If the user is authenticated, allow access
        if (auth()->check()) {
            return $next($request);
        }

        // If the request matches the eventqrcode route, redirect to the moeeventlink route
        if ($request->is('eventqrcode/*')) {
            return redirect()->route('moeeventlink');
        }

        // If none of the above conditions are met, allow access
        return $next($request);
    }
}
