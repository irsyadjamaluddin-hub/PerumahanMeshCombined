<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailReset;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException; // Import the class here
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;



use App\Models\User;


class ResetpasswordController extends Controller
{
    public function resetpassword()
    {

        return view('resetpassword');
    }

    public function confirmpassword($encryptedId)
    {

        try{
            //decrypt the incoming ID
    
            $id =Crypt::decrypt($encryptedId);
        } catch (DecryptException $e){
            \Log::error('Decryption failed: '. $e->getMessage());
            return abort(404);
        }

        $users = User::all()
        ->where('id', '=', $id);  

        return view('confirmpassword', compact('users'));
    }

    public function sendlink(Request $request)
    {
      // Validate the input fields
    $request->validate([
        'ic_no' => 'required|string',
        'email' => 'required|email',
    ]);

    // Check if the username and email match in the database
    $user = \App\Models\User::where('ic_no', $request->ic_no)
                            ->where('email', $request->email)
                            ->first();

    if (!$user) {
        // If the username and email do not match
        return back()->withErrors([
            'username' => 'Invalid username or email.',
        ]);
    }

    // Generate a random security code
    $notf_securityCode = Str::random(6);

    // Store the security code in the cache with a 3-hour expiration
    Cache::put('security_code_' . $user->id, $notf_securityCode, now()->addHours(3));

    // Alternatively, you can store it in the database with an expiration
    // $user->update([
    //     'security_code' => $securityCode,
    //     'code_expires_at' => now()->addHours(3),
    // ]);

    // Send the password reset link using Laravel's built-in functionality
    $notf_id= Crypt::encrypt($user->id);
    $notf_userEmail = $request->email;
    $notf_Icno = $request->ic_no;
    Mail::to($notf_userEmail)->send(new EmailReset( $notf_userEmail,$notf_Icno,$notf_securityCode,$notf_id));

    return redirect()->route('resetpassword')
    ->with('success', 'You have successfully requested for a reset password! Please check your email.');


    }

    public function updateconfirmpassword(Request $request){

    $now = Carbon::now();
     
    
        $users = User::findOrFail($request->id);

            // Validate incoming request
        $validatedData = $request->validate(
            [
                    'security_code' => ['required', 'string'], // Security code must be provided
                    'password' => [
                    'required',
                    'string',
                    'min:12', // Ensure at least 15 characters
                    'regex:/[a-z]/', // Ensure at least one lowercase letter
                    'regex:/[A-Z]/', // Ensure at least one uppercase letter
                    'regex:/[0-9]/', // Ensure at least one number
                    'regex:/[\W_]/', // Ensure at least one special character
                    'confirmed' // Ensure the password confirmation matches
                ],
            ],
            [
                // Custom error message for regex validation
                'password.regex' => 'The password must be at least 12 characters long, contain an uppercase letter, a lowercase letter, a number, and a special character.',
                'security_code.required' => 'The security code is required.',
            ]
        );



      // Retrieve the cached security code for this user
    $cachedCode = Cache::get('security_code_' . $users->id);

    // Check if the security code matches
    if (!$cachedCode || $cachedCode !== $request->security_code) {
        throw ValidationException::withMessages([
            'security_code' => 'The security code is invalid or has expired.',
        ]);
    }

    // Update the user's password
    $users->update([
        'password' => ($validatedData['password']), // Hash the password before saving
        'updated_at' => $now,
    ]);

    // Optionally clear the cached security code after use
    Cache::forget('security_code_' . $users->id);

    return redirect()->route('login')->with('success', 'Password updated successfully.');

}
}
