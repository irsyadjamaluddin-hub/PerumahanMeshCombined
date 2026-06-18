<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class EncryptDecryptId
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
        if($request->has('id')){
            $request->merge([
                'id' => Crypt::decryptString($request->input('id')),
            ]);
        }

        // return $next($request);
        if($request->route('roleUsers') || $request->route('userview') ) {
            try {

                if($request->route('roleUsers')) {
                    $decryptedId = Crypt::decryptString($request->route('roleUsers'));
                    $request->route()->setParameter('roleUsers', $decryptedId);
                }

                if($requet->route('userview')) {
                    $decryptedId = Crypt::decryptString($request->route('userview'));
                    $request->route()->setparameter('userview', $decryptedId);
                }

            } catch (\Exception $e) {
                abort(404);
            }
        }

        return $next($request);
    }
}
