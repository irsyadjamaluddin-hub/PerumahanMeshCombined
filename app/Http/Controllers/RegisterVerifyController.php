<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Biodata;
use App\Models\Department;
use App\Models\Employment;
use App\Models\EmploymentStatus;
use App\Models\Salary;
use App\Models\Contact;
use App\Models\DevopsSupportAdmin;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Mail\MailtrapExample;
use Illuminate\Support\Facades\Mail;
use DateTime;
use Carbon\Carbon;
use Log;
use Flash;
use Session;

use App\Mail\EmailRegister;
use App\Mail\EmailApproverRegister;
use App\Mail\EmailApprover2Register;
use App\Mail\EmailVerifiedAccount;
use App\Mail\EmailApprovedAccount;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\URL;








class RegisterVerifyController extends Controller
{


    public function registerlink()
    {

        return view('register');
    }




    public function store(Request $request)
    {

        // Comments @ 21/10/2024:
        // 1. Check if IC and Email already exists in DB.
        // Fixed: Added through validation.

        // Validate incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'ic_no' => ['required', 'string', 'max:20','regex:/^\\d+$/', 'unique:users,ic_no'], //only digits
            'password' => [
                'required',
                'string',
                'min:13', // Ensure at least 15 characters
                'regex:/[a-z]/', // Ensure at least one lowercase letter
                'regex:/[A-Z]/', // Ensure at least one uppercase letter
                'regex:/[0-9]/', // Ensure at least one number
                'regex:/[\W_]/', // Ensure at least one special character
                'confirmed' // Ensure the password confirmation matches
            ],
            'employment_status_id' => 'required',
            'department_id' => 'required',
            'bahagian_id' => 'required',
            'division_id' => 'required|integer',
            'telephone_mobile' => 'required|string|max:20',
            'ap1_name' => 'required|string|max:255', // Add validation for ap1_name
            // 'ap1_email' => ['required', 'string', 'email', 'max:100', 'regex:/^[a-zA-Z0-9._%+-]+@(moe\.gov\.bn|edu\.moe\.bn|moe\.edu\.bn)$/']
            'ap1_email' => [
                    'required',
                    'string',
                    'email',
                    'max:100',
                    'regex:/^[a-zA-Z0-9._%+-]+@([a-zA-Z0-9.-]+\.)?(moe\.gov\.bn|moe\.edu\.bn|edu\.moe\.bn|student\.pb\.edu\.bn)$/'
            ],


        ], [
            'department_id.required' => 'This field is required.',
            'employment_status_id.required' => 'This field is required.',
            'bahagian_id.required' => 'This field is required.',
            'division_id.required' => 'This field is required.',
            'telephone_mobile.required' => 'This field is required.',

            'ap1_name.required' => 'This field is required.',
            'ap1_email.required' => 'This field is required.',
            'ap1_email.email' => 'You need to use a valid email address.',
            'password.regex' => 'The password must be at least 13 characters long, contain an uppercase letter, a lowercase letter, a number, and a special character.',
            'ap1_email.regex' => "The approver's email format is invalid.",
            'ap2_email.regex' => 'The approver 2 email format is invalid.',
            'ic_no.regex'=> 'The IC number must contain only digits'
        ]);

        $validatedData = $request->all(); // Get all input data

        // / Log the password hash for debugging purposes


        // Create User
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'ic_no' => $validatedData['ic_no'],
            'password' => $validatedData['password'], // Ensure password is hashed
            'bahagian_id' => $validatedData['bahagian_id'],
            'division_id' => $validatedData['division_id'],
            'telephone_mobile' => $validatedData['telephone_mobile'],
            'ap1_name' => $validatedData['ap1_name'],
            'ap1_email' => $validatedData['ap1_email'],
            'remember_token' => Str::random(50),
        ]);


        // Assign ROLE_USER to the new user
        $role = Role::select('id')->where('name', 'ROLE_USER')->first();
        $user->roles()->attach($role);

        // Create Biodata
        $biodata = Biodata::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'ic_no' => $validatedData['ic_no'],
            'bahagian_id' => $validatedData['bahagian_id'],
        ]);

        // Create Employment
        $employment = Employment::create([
            'ic_no' => $validatedData['ic_no'],
            'ministry_id' => '1',
            'service_status_id' => '1',
            'department_id' => $validatedData['department_id'],
            'employment_status_id' => $validatedData['employment_status_id'],
            'bahagian_id' => $validatedData['bahagian_id'],
            'division_id' => $validatedData['division_id'],
        ]);

        // Create Salary
        $salary = Salary::create([
            'ic_no' => $validatedData['ic_no'],
            'division_id' => $validatedData['division_id'],
        ]);

        // Create Contacts
        $contacts = Contact::create([
            'ic_no' => $validatedData['ic_no'],
            'telephone_mobile' => $validatedData['telephone_mobile'],
        ]);

        // Prepare email data
        $email_data = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ];

        $notf_userEmail = $request->email;
        $notf_Nama = $request->name;

        $notf_approverEmail = $request->ap1_email;
        $notf_NamaApprover = $request->ap1_name;

        // $notf_approverEmail2 = $request->ap2_email;
        // $notf_NamaApprover2 = $request->ap2_name;

       $data1 = User::select('users.*')
       ->orderBy('created_at', 'DESC')
       ->first();

       
       $notf_id = $data1->id;


       $departmentId = $request->department_id;
       $notf_jabatan = Department::where('id', $departmentId)->pluck('label')->first();

       Mail::to($notf_userEmail)->send(new EmailRegister($notf_Nama, $notf_jabatan));

       Mail::to($notf_approverEmail)->send(new EmailApproverRegister($notf_NamaApprover,$notf_Nama, $notf_jabatan, $notf_id));

       // Mail::to($notf_approverEmail2)->send(new EmailApprover2Register($notf_NamaApprover2,$notf_Nama, $notf_jabatan, $notf_id));

      return redirect()->route('registerform')
       ->with('success_message', 'Registration submitted! ');
    }


//     public function approveverify($encryptedId)
// {
    
//     try{
//         //decrypt the incoming ID

//         $id =Crypt::decrypt($encryptedId);
//     } catch (DecryptException $e){
//         \Log::error('Decryption failed: '. $e->getMessage());
//         return abort(404);
//     }
//     $registerverify = User::all()
//         ->where('id', '=', $id);

//         // get the user by id
//         $data = User::findorFail($id);

//         $icNo = $data->ic_no;

//         $employments = Employment::where('ic_no', $icNo)->get();

//     return view('approververify', compact('registerverify','employments'));
// }

public function approveverify($encryptedId)
{
    \Log::info('approververify hit', ['path' => request()->path(), 'param' => $encryptedId ?? request()->segment(2)]);
    
    $registerverify = User::all()
        ->where('id', '=', $encryptedId);

        // get the user by id
        $data = User::findorFail($encryptedId);

        $icNo = $data->ic_no;

        $employments = Employment::where('ic_no', $icNo)->get();

    return view('approververify', compact('registerverify','employments', 'data', 'encryptedId'));
}

// public function update(Request $request)
// {
//     \Log::warning('DEBUG-ENTRY update() called', [
//     'request_id' => $request->id ?? null,
//     'timestamp' => now()->toDateTimeString(),
// ]);
//     $now = Carbon::now();


//     // Find the user by ID and update
//     User::where('id', $request->id)->update([
//         'approval_response' => $request->input('approval_response'),
//         'approve_at' => $now,
//         'email_verified_at' => $now,

    

//     ]);


//      // Get the updated user details
//      $updatedUser = User::find($request->id);
// if (! $updatedUser) {
//     return back()->withErrors('User not found');
// }

//     //  initialize success message
//     $successMessage= '';

//     if($updatedUser->approval_response === 'Accept Registration'){

//     $user = $updatedUser;

//     $notf_userEmail = $user->email;
//     $notf_Nama = $user->name;
//     $departmentId = $user->department_id;

//     $notf_jabatan = Department::join('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
//     ->where('emp_employment_infos.ic_no', $user->ic_no)
//     ->pluck('departments.label')
//     ->first() ?? '';

//     $devopsRows = DevopsSupportAdmin::join('users', 'devops_support_admin.ic_no', '=', 'users.ic_no')
//         ->orderByDesc('devops_support_admin.created_at')
//         ->select('devops_support_admin.email as email', 'users.name as approver_name')
//         ->get();

//     $devopsRows = $devopsRows->unique('email')->values();

//         // $data1 = User::select('users.*')
//         // ->orderBy('created_at', 'DESC')
//         // ->first();
        
//         $notf_id = $updatedUser->id;

//     $notf_NamaApprover2 = DevopsSupportAdmin::join('users', 'devops_support_admin.ic_no', '=', 'users.ic_no')
//     ->pluck('users.name')
//     ->first();

//     Mail::to($notf_userEmail)->send(new EmailVerifiedAccount($notf_Nama, $notf_jabatan,$notf_id));

//     foreach ($devopsRows as $i => $row) {
//         $email = $row->email;
//         $approverName = $row->approver_name ?? 'Yang Berkenaan';

//         Log::info('Queueing EmailApprover2Register', [
//             'to' => $email,
//             'approverName' => $approverName,
//             'delay_seconds' => 20 + ($i * 15),
//         ]);

//         Mail::to($email)
//             ->queue((new \App\Mail\EmailApprover2Register(
//                 $approverName,   // dynamic per-recipient
//                 $notf_Nama,
//                 $notf_jabatan,
//                 $notf_id
//             ))->delay(now()->addSeconds(20 + ($i * 15))));
//     }

//        $successMessage= 'The requested account has been succesfully verified';
//     } else {
//        $successMessage= 'The requested account has been succesfully declined';

//     }


//     return redirect()->back()
//     ->with('success_message', $successMessage);
// }

public function update(Request $request)
{
    \Log::warning('DEBUG-ENTRY update() called', [
        'request_id' => $request->id ?? null,
        'timestamp' => now()->toDateTimeString(),
    ]);

    $now = Carbon::now();

    // 🔍 Find user first
    $user = User::find($request->id);
    if (! $user) {
        return back()->withErrors('User not found');
    }

    // 🔒 Prevent duplicate approval & duplicate emails
    if (
        $user->email_verified_at &&
        $request->input('approval_response') === 'Accept Registration'
    ) {
        return redirect()->back()
            ->with('warning_message', 'User already approved.');
    }

    // ✅ Update user
    $user->update([
        'approval_response' => $request->input('approval_response'),
        'approve_at' => $now,
        'email_verified_at' => $now,
    ]);

    // Initialize success message
    $successMessage = '';

    if ($user->approval_response === 'Accept Registration') {

        $notf_userEmail = $user->email;
        $notf_Nama = $user->name;

        $notf_jabatan = Department::join(
                'emp_employment_infos',
                'departments.id',
                '=',
                'emp_employment_infos.department_id'
            )
            ->where('emp_employment_infos.ic_no', $user->ic_no)
            ->pluck('departments.label')
            ->first() ?? '';

        $devopsRows = DevopsSupportAdmin::join(
                'users',
                'devops_support_admin.ic_no',
                '=',
                'users.ic_no'
            )
            ->orderByDesc('devops_support_admin.created_at')
            ->select(
                'devops_support_admin.email as email',
                'users.name as approver_name'
            )
            ->get()
            ->unique('email')
            ->values();

        $notf_id = $user->id;

        Mail::to($notf_userEmail)
            ->send(new EmailVerifiedAccount(
                $notf_Nama,
                $notf_jabatan,
                $notf_id
            ));

        foreach ($devopsRows as $i => $row) {
            $email = $row->email;
            $approverName = $row->approver_name ?? 'Yang Berkenaan';

            Log::info('Queueing EmailApprover2Register', [
                'to' => $email,
                'approverName' => $approverName,
                'delay_seconds' => 20 + ($i * 15),
            ]);

            Mail::to($email)->queue(
                (new \App\Mail\EmailApprover2Register(
                    $approverName,
                    $notf_Nama,
                    $notf_jabatan,
                    $notf_id
                ))->delay(now()->addSeconds(20 + ($i * 15)))
            );
        }

        $successMessage = 'The requested account has been successfully verified';

    } else {
        $successMessage = 'The requested account has been successfully declined';
    }

    return redirect()->back()
        ->with('success_message', $successMessage);
}


}




