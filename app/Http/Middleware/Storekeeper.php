<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Storekeeper
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // http://127.0.0.1:8000/ledger/create

        if (!Auth::check()) {

            $prevData = [
                'message' => 'Warning',
                'description' => 'You cannot access this page without login.',
            ];

            return redirect()->route('login')->with('warning', $prevData);
        }

        if (Auth::user()->hasRole('storekeeper')) {

            return $next($request);

        } 

        Auth::logout();

        $request->session()->invalidate();
    
        $request->session()->regenerateToken();

        $prevData = [
            'message' => 'Warning',
            'description' => 'You cannot access this page without Storekeeper role.',
        ];

        return redirect()->route('login')->with('warning', $prevData);
    }
}
