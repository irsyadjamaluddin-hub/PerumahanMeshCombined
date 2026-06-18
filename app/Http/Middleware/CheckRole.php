<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {

        if(!$request->user()){

            return redirect()->route('login');
        }
        
        $roles = is_array($roles) ? $roles : explode('|', $roles);

        foreach ($roles as $role) {
            if ($request->user()->hasRole(trim($role))) {
                return $next($request);
            }
        }

        abort(401, 'This action is unauthorized.');
    }
}
