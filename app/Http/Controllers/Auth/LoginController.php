<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

Use Log;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


	protected $maxAttempts = 3;
    protected $decayMinutes = 5;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        // Validate the input for IC number and password
        $request->validate([
            'ic_no' => 'required',
            'password' => 'required',
        ]);

        // Find user by IC number
        $user = \App\Models\User::where('ic_no', $request->ic_no)->first();

        
        if ($user) {
            // Check if both approval responses are satisfied
            if ($user->approval_response === 'Accept Registration' && $user->approval_response2 === 'Approve') {
                // Check if the password matches
                if (Hash::check($request->password, $user->password)) {
                    // Login the user
                    auth()->login($user);
                    return redirect('/home');
                } else {
                    // Incorrect password
                    return redirect('/login')->with('verification_message', 'Wrong password.');
                }
            } elseif (empty($user->approval_response)) {
                // The account needs verification from the verifier
                return redirect('/login')->with('verification_message', 'Your account needs verification from your verifier.');
            } elseif ($user->approval_response === 'Accept Registration') {
                // The account is pending approval from the MESH TEAM
                return redirect('/login')->with('verification_message', 'Your account is pending approval from the MESH TEAM.');
            } else {
                // The account is not approved yet
                return redirect('/login')->with('verification_message', 'Your account needs approval.');
            }
        } else {
            // User not found
            return redirect('/login')->with('verification_message', 'No user exists with this IC number.');
        }


}

    //     if ($user) {
    //         // Check if the user is approved
    //         if (empty($user->approval_response)) {
    //             // User has not been approved
    //             return redirect('/login')->with('verification_message', 'Your account needs approval from the approver before login.');
    //         }

    //         // Check if the password matches
    //         if (Hash::check($request->password, $user->password)) {
    //             // Login the user
    //             auth()->login($user);
    //             return redirect('/home');
    //         } else {
    //             // Incorrect password
    //             return redirect('/login')->with('verification_message', 'Wrong password.');
    //         }


    //     } else {
    //         // User not found
    //         return redirect('/login')->with('verification_message', 'IC number does not exist.');
    //     }
    // }






}

