<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TechnicalTeam
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

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->hasRole('technical-team')) {

            return $next($request);

        } 

        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();

        $prevData = [
            'message' => 'Warning',
            'description' => "You need Technical-Team role to perform this action!",
        ];

        return redirect()->route('login')->with('warning', $prevData);
    }
}
