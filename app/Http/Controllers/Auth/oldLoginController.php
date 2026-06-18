<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
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
        $input = $request->all();
  
        $this->validate($request, [
            'ic_no' => 'required',
            'password' => 'required',
        ]);
  
        $fieldType = filter_var($request->ic, FILTER_VALIDATE_EMAIL) ? 'email' : 'ic_no';
		
		$user = User::where('ic_no',$request->ic_no)->first();
        
		if($user && $user->locked_until != null){
			// if($user->locked_until && $user->locked_until->isFuture()){
			// 	return back()->with('verification_message', 'Your account is locked. Please try again later.');
			// }

			$lockedUntil = \Carbon\Carbon::parse($user->locked_until);

			if($lockedUntil->isFuture()){
				return back()->with('verification_message', 'Your account is locked. Please try again later.');
			}
		}
		
		if(auth()->attempt(array($fieldType => $input['ic_no'], 'password' => $input['password'])))
        {
			$user = Auth::user();
			
			$user->login_attempts = 0;
			$user->locked_until = null;
			$user->save();
			
            return redirect()->route('home');
        }else{
			
			$user = User::where('ic_no', $request->ic_no)->first();
			
			if ($user) {
				
				// if($user->locked_until && $user->locked_until->isFuture()){
				// 	return back()->with('verification_message', 'Your account is locked. Please try again later.');
				// }

				$lockedUntil = \Carbon\Carbon::parse($user->locked_until);

				if($lockedUntil->isFuture()){
					return back()->with('verification_message', 'Your account is locked. Please try again later.');
				}
				
				$user->login_attempts += 1;
				
				if ($user->login_attempts >= 5) {
					$user->locked_until = now()->addMinutes(15);
					$user->save();
					
					return back()->with('verification_message','Your account is locked for 15 minutes due to multiple failed login attempts.');
				}
				
				$user->save();
			}
			
			return redirect('/login')->with(['verification_message' => 'Provided Credentials does not match with our records!']);
        }
          
    }
	
	protected function authenticated($request, $user)
	{
	
	$userID = Auth::user()->id;
	$userEmail = Auth::user()->email;
	$dateTime = Carbon::now();
	Log::info('User ID '.$userID.' has logged in. 
				Email: '.$userEmail.
				'. Date/time: '.$dateTime);

	$userID = Auth::user()->id;
	
	
		if($user->hasVerifiedEmail())
		{
		
			if($user->hasRole('ROLE_SUPERADMIN')) 
			{
				return redirect('/admin');
			}
				elseif($user->hasRole('ROLE_HOD')) 
				{
					return redirect('/hod');
				}
					elseif($user->hasRole('ROLE_CLAIMANT')) 
					{
						return redirect('/claimant');
					}
						elseif($user->hasRole('ROLE_MAW')) 
						{
							return redirect('/maw');
						}
							elseif($user->hasRole('ROLE_MAW_SECOND')) 
							{
								return redirect('/mawSecond');
							}
								elseif($user->hasRole('ROLE_DA')) 
								{
									return redirect('/da');
								}
									elseif($user->hasRole('ROLE_ENDORSER')) 
									{
										return redirect('/endorser');
									}
										elseif($user->hasRole('ROLE_MAW_ENDORSER')) 
										{
											return redirect('/mawendorser');
										}
											else 
											{
												return redirect('/home');
											}
		}
		else
		{
			Auth::logout();
		return redirect('/login')->with(['verification_message' => 'Please verify your email first!']);
		}
	}
}

