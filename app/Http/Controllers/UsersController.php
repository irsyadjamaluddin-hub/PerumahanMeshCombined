<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\URL;



use App\Models\User;
use App\Models\Biodata;
use App\Models\Department;
use App\Models\Userdepartment;
use App\Models\Employment;
use App\Models\Salary;
use App\Models\Contact;
use App\Models\DevopsSupportAdmin;

use App\Models\EmploymentStatus;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role; //add on 220222

use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerifiedAccount;
use App\Mail\EmailAccountApproved;
use App\Mail\EmailApprover2Register;
use Carbon\Carbon;


class UsersController extends Controller
{

  public function maintenance(){
        return view('maintenancepage');
    }


    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('role:ROLE_ADMIN');
    }
    /**
     * Display a listing of the users.
     *
     * @return Illuminate\View\View
     */
    public function index()

    {

        if (Auth::user()->hasRole('ROLE_SUPERADMIN')) {

            $users = User::get();

            $userdepartmentapproval = User::leftJoin('emp_employment_infos', 'users.ic_no', '=', 'emp_employment_infos.ic_no')
            ->leftJoin('departments', 'emp_employment_infos.department_id', '=', 'departments.id')
            ->where('users.approval_response','Accept Registration')
            ->whereNull('users.approval_response2')
            ->select('users.*', 'departments.label')
            ->paginate(2000);


            $userdepartmentpending = User::leftJoin('emp_employment_infos', 'users.ic_no', '=', 'emp_employment_infos.ic_no')
                ->leftJoin('departments', 'emp_employment_infos.department_id', '=', 'departments.id')
                ->where(function($query){
                    $query->where('users.approval_response','='.'')
                          ->orWhereNull('users.approval_response');
                })
                ->orWhere('users.approval_response','Decline Registration')
                ->select('users.*', 'departments.label')
                ->paginate(2000);

            $userdepartment = User::leftJoin('emp_employment_infos', 'users.ic_no', '=', 'emp_employment_infos.ic_no')
                ->leftJoin('departments', 'emp_employment_infos.department_id', '=', 'departments.id')
                ->where('users.approval_response','Accept Registration')
                ->select('users.*', 'departments.label')
                ->paginate(2000);


            return view('users.index', compact('users', 'userdepartment','userdepartmentpending','userdepartmentapproval'));
        }

        if (Auth::user()->hasRole('ROLE_ART_FOCAL')) {

            $users = User::paginate(2000);

            $icNos = Auth::user()->ic_no;

            $employments = Employment::select('emp_employment_infos.*')
                ->where('ic_no', '=', $icNos)->first();

            $id = $employments->department_id;

            $emps = Employment::select('emp_employment_infos.*')
                ->orderBy('created_at', 'DESC')
                ->where('department_id', '=', $id)
                ->get();


                $userdepartmentapproval = User::leftJoin('emp_employment_infos', 'users.ic_no', '=', 'emp_employment_infos.ic_no')
                ->leftJoin('departments', 'emp_employment_infos.department_id', '=', 'departments.id')
                ->where('users.approval_response','Accept Registration')
                ->whereNull('users.approval_response2')
                ->select('users.*', 'departments.label')
                ->paginate(2000);
    
    
                $userdepartmentpending = User::leftJoin('emp_employment_infos', 'users.ic_no', '=', 'emp_employment_infos.ic_no')
                    ->leftJoin('departments', 'emp_employment_infos.department_id', '=', 'departments.id')
                    ->where(function($query){
                        $query->where('users.approval_response','='.'')
                              ->orWhereNull('users.approval_response');
                    })
                    ->orWhere('users.approval_response','Decline Registration')
                    ->select('users.*', 'departments.label')
                    ->paginate(2000);
            $userdepartment = User::leftJoin('emp_employment_infos', 'users.ic_no', '=', 'emp_employment_infos.ic_no')
                ->leftJoin('departments', 'emp_employment_infos.department_id', '=', 'departments.id')
                ->where('users.approval_response','Accept Registration')
                ->select('users.*', 'departments.label')
                ->paginate(2000);


            return view('users.index', compact('users', 'userdepartment','userdepartmentpending','userdepartmentapproval'));
        }
    }

    // public function approve($id)
    // {
    //     $user = User::findOrFail($id);
    //     $user->update([
    //         'email_verified_at' => now(),
    //         'approval_response' => 'Accept Registration',
    //         'approve_at' => now(),



    // ]);
    // $notf_userEmail = $user->email;
    // $notf_Nama = $user->name;
    // $departmentId = $user->department_id;

    // $notf_jabatan = Department::where('id', $departmentId)->pluck('label')->first();
    // Mail::to($notf_userEmail)->send(new EmailVerifiedAccount($notf_Nama, $notf_jabatan));



    //     return redirect()->route('users.user.index')
    //         ->with('success_message', 'User verified successfully');
    // }

    public function approve($id)
    {
        $user = User::findOrFail($id);

        // 🔒 Prevent duplicate approval & emails
    if ($user->approval_response === 'Accept Registration') {
        return redirect()->route('users.user.index')
            ->with('warning_message', 'User already approved.');
    }
        $user->update([
            'email_verified_at' => now(),
            'approval_response' => 'Accept Registration',
            'approve_at' => now(),

    ]);
    $notf_userEmail = $user->email;
    $notf_Nama = $user->name;
    $departmentId = $user->department_id;

    $notf_jabatan = Department::join('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
    ->where('emp_employment_infos.ic_no', $user->ic_no)
    ->pluck('departments.label')
    ->first() ?? '';

    $devopsRows = DevopsSupportAdmin::join('users', 'devops_support_admin.ic_no', '=', 'users.ic_no')
        ->orderByDesc('devops_support_admin.created_at')
        ->select('devops_support_admin.email as email', 'users.name as approver_name')
        ->get();

    $devopsRows = $devopsRows->unique('email')->values();

    $notf_id   = (string) $user->id;

    $notf_NamaApprover2 = DevopsSupportAdmin::join('users', 'devops_support_admin.ic_no', '=', 'users.ic_no')
    ->pluck('users.name')
    ->first();

    Mail::to($notf_userEmail)->send(new EmailVerifiedAccount($notf_Nama, $notf_jabatan,$notf_id));

    foreach ($devopsRows as $i => $row) {
        $email = $row->email;
        $approverName = $row->approver_name ?? 'Yang Berkenaan';

        Log::info('Queueing EmailApprover2Register', [
            'to' => $email,
            'approverName' => $approverName,
            'delay_seconds' => 20 + ($i * 15),
        ]);

        Mail::to($email)
            ->queue((new \App\Mail\EmailApprover2Register(
                $approverName,   // dynamic per-recipient
                $notf_Nama,
                $notf_jabatan,
                $notf_id
            ))->delay(now()->addSeconds(20 + ($i * 15))));
    }

        return redirect()->route('users.user.index')
            ->with('success_message', 'User verified successfully');
    }

    
    // public function approvemeshteam($id)
    // {
    //     $user = User::findOrFail($id);
    //     $user->update([
    //         'email_verified_at' => now(),
    //         'approval_response2' => 'Approve',
    //         'approval_at2' => now(),

    //     ]);

    //     $notf_userEmail = $user->email;
    //     $notf_Nama = $user->name;
    //     $departmentId = $user->department_id;

    //     $notf_jabatan = Department::where('id', $departmentId)->pluck('label')->first();
    //     Mail::to($notf_userEmail)->send(new EmailAccountApproved($notf_Nama, $notf_jabatan));

    //     return redirect()->route('users.user.index')
    //         ->with('success_message', 'User verified and email sent successfully');
    // }

    public function approvemeshteam(Request $request)
    {
        Log::warning('DEBUG-ENTRY approvemeshteam() called', [
            'request_id' => $request->id ?? null,
            'timestamp' => now()->toDateTimeString(),
        ]);
    
        // validate request
        $data = $request->validate([
            'id' => 'required|integer|exists:users,id',
            'approval_response2' => 'required|string',
        ]);
    
        $now = Carbon::now();
    
        // Update user
        User::where('id', $data['id'])->update([
            'approval_response2' => $data['approval_response2'],
        ]);
    
        $updatedUser = User::find($data['id']);
        if (! $updatedUser) {
            return back()->withErrors('User not found');
        }
    
        $successMessage = '';
    
        if ($updatedUser->approval_response2 === 'Approve') {
            $user = $updatedUser;
            $notf_userEmail = $user->email;
            $notf_Nama = $user->name;
            $departmentId = $user->department_id;
    
            $notf_jabatan = Department::join('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
                ->where('emp_employment_infos.ic_no', $user->ic_no)
                ->pluck('departments.label')
                ->first() ?? '';
    
            $devopsRows = DevopsSupportAdmin::join('users', 'devops_support_admin.ic_no', '=', 'users.ic_no')
                ->orderByDesc('devops_support_admin.created_at')
                ->select('devops_support_admin.email as email', 'users.name as approver_name')
                ->get()
                ->unique('email')
                ->values();
    
            // snapshot latest user (if you need the newly created user — but be explicit)
            $data1 = User::select('users.*')->orderBy('created_at', 'DESC')->first();
    
            // encrypt ID now (encryptString is preferred)
            $notf_id = $data1->id;
    
            $notf_NamaApprover2 = DevopsSupportAdmin::join('users', 'devops_support_admin.ic_no', '=', 'users.ic_no')
                ->pluck('users.name')
                ->first();
    
            // Send notification to the user (synchronously or queue as you prefer)
            // Mail::to($notf_userEmail)->send(new EmailAccountApproved($notf_Nama, $notf_jabatan));
                    Mail::to($notf_userEmail)
                ->queue((new EmailAccountApproved($notf_Nama, $notf_jabatan))
                    ->delay(now()->addSeconds(10))); // 10-second delay
    
            // Queue emails to devops admins and use per-recipient delay
            // foreach ($devopsRows as $i => $row) {
            //     $email = $row->email;
            //     $approverName = $row->approver_name ?? 'Yang Berkenaan';
    
            //     Log::info('Queueing EmailApprover2Register', [
            //         'to' => $email,
            //         'approverName' => $approverName,
            //         'delay_seconds' => 20 + ($i * 15),
            //     ]);
    
            //     // ensure token was created above; if your Mailable builds signed urls, create them here instead
            //     Mail::to($email)
            //         ->queue((new \App\Mail\EmailApprover2Register(
            //             $approverName,
            //             $notf_Nama,
            //             $notf_jabatan,
            //             $notf_id
            //         ))->delay(now()->addSeconds(20 + ($i * 15))));
            // }
    
            $successMessage = 'The requested account has been succesfully verified';
        } else {
            $successMessage = 'The requested account has been succesfully declined';
        }
    
        return back()->with('success_message', $successMessage);
    }

    public function approvedbymesh($encryptedId)
    {

        
        $registerverify = User::all()
            ->where('id', '=', $encryptedId);

            // get the user by id
            $data = User::findorFail($encryptedId);

            $icNo = $data->ic_no;

            $employments = Employment::where('ic_no', $icNo)->get();

        return view('meshverify', compact('registerverify','employments', 'data', 'encryptedId'));
    }

    public function reversereject($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'email_verified_at' => null,
            'approval_response' => null,
            'approve_at' => null,

    ]);
    
        return redirect()->route('users.user.index')
            ->with('success_message', 'User verified successfully');
    }

    public function approvemt($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'email_verified_at' => now(),
            'approval_response2' => 'Approve',
            'approval_at2' => now(),

        ]);
        
            $updatedUser = User::find($user['id']);
    if (! $updatedUser) {
        return back()->withErrors('User not found');
    }

        $notf_userEmail = $user->email;
        $notf_Nama = $user->name;
        $departmentId = $user->department_id;
                $notf_jabatan = Department::join('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
            ->where('emp_employment_infos.ic_no', $user->ic_no)
            ->pluck('departments.label')
            ->first() ?? '';

        $devopsRows = DevopsSupportAdmin::join('users', 'devops_support_admin.ic_no', '=', 'users.ic_no')
            ->orderByDesc('devops_support_admin.created_at')
            ->select('devops_support_admin.email as email', 'users.name as approver_name')
            ->get()
            ->unique('email')
            ->values();

        // snapshot latest user (if you need the newly created user — but be explicit)
    $notf_id   = (string) $updatedUser->id;

        $notf_NamaApprover2 = DevopsSupportAdmin::join('users', 'devops_support_admin.ic_no', '=', 'users.ic_no')
            ->pluck('users.name')
            ->first();

        $notf_jabatan = Department::where('id', $departmentId)->pluck('label')->first();
        Mail::to($notf_userEmail)->send(new EmailAccountApproved($notf_Nama, $notf_jabatan));

        //         foreach ($devopsRows as $i => $row) {
        //     $email = $row->email;
        //     $approverName = $row->approver_name ?? 'Yang Berkenaan';

        //     Log::info('Queueing EmailApprover2Register', [
        //         'to' => $email,
        //         'approverName' => $approverName,
        //         'delay_seconds' => 20 + ($i * 15),
        //     ]);

        //     // ensure token was created above; if your Mailable builds signed urls, create them here instead
        //     Mail::to($email)
        //         ->queue((new \App\Mail\EmailApprover2Register(
        //             $approverName,
        //             $notf_Nama,
        //             $notf_jabatan,
        //             $notf_id
        //         ))->delay(now()->addSeconds(20 + ($i * 15))));
        // }

        return redirect()->route('users.user.index')
            ->with('success_message', 'User verified and email sent successfully');
    }

    /**
     * Show the form for creating a new user.
     *
     * @return Illuminate\View\View
     */

    public function create()
    {

        $departments = Department::pluck('label', 'id')->all();
        $employments = EmploymentStatus::pluck('label', 'id')->all();

        return view('users.create', compact('departments', 'employments'));
    }

    /**
     * Store a new user in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            //User::create($data);

            $user = User::create($data); //add on 220222

            // /** The id of role name ROLE_USER is assigned into new user registering   **/
            $role = Role::select('id')->where('name', 'ROLE_USER')->first(); //add on 220222
            $user->roles()->attach($role);

            $biodata = Biodata::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'ic_no' => $data['ic_no']
            ]);

            $employment = Employment::create([
                'ic_no' => $data['ic_no'],
                'ministry_id' => '1',
                'service_status_id' => '1',
                'department_id' => $data['department_id'],
                'employment_status_id' => $data['employment_status_id'],

            ]);

            if (Auth::user()->hasRole('ROLE_ART_FOCAL')) {
                return redirect()->route('users.user.create')
                    ->with('success_message', 'User was successfully added!');
            }

            if (Auth::user()->hasRole('ROLE_SUPERADMIN')) {

                return redirect()->route('users.user.index')
                    ->with('success_message', 'User was successfully added!');
            }
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Display the specified user.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::findOrFail($id);


        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */


    // public function edit($id)
    // {
    //     $user = User::findOrFail($id);

    //     $icNos = $id;

    //     $users = User::all()
    //         ->where('ic_no', '=', $icNos);

    //     $departments = Department::pluck('label', 'id')->all();
    //     $employments = EmploymentStatus::pluck('label', 'id')->all();

    //     // $userdepartment = Userdepartment:: pluck('label','id')->all();

    //     $department = Employment::select(['emp_employment_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
    //         ->where('ic_no', $icNos)
    //         ->value('department_id');

    //     return view('users.edit', compact('user', 'departments', 'department', 'employments'));
    // }

        public function edit($id)
    {
        $user = User::findOrFail($id);

        $icNos = $id;

        $users = User::all()
            ->where('ic_no', '=', $icNos);

        $employments = Employment::all()
            ->where('ic_no', '=', $user->ic_no);

        // $departments = Department::pluck('label', 'id')->all();
        $employmentstatus = EmploymentStatus::pluck('label', 'id')->all();

        $departmentlabel = Department:: pluck('label','id')->all();

        return view('users.edit', compact('user',  'employments','employmentstatus','departmentlabel'));
    }



    /**
     * Update the specified user in the storage.
     *
     * @param  int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        try {

            $data = $this->getData($request);

            $user = User::findOrFail($id);
            $user->update($data);

            $employments = Employment::updateOrCreate(
                [
                    'ic_no' => $request->input('ic_no'),
                ],

                [
                    'ministry_id' => '1',
                    'department_id' => $request->input('department_id'),
                    'employment_status_id' => $request->input('employment_status_id'),
                ]
            );

            return redirect()->route('users.user.index')
                ->with('success_message', 'User was successfully updated!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Remove the specified user from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $icNo =$user->ic_no;

       

                Biodata::where('ic_no', $icNo)->delete();
                Employment::where('ic_no', $icNo)->delete();
                Contact::where('ic_no', $icNo)->delete();
                Salary::where('ic_no', $icNo)->delete();

                $user->delete();
           
         

            return redirect()->route('users.user.index')
                ->with('success_message', 'User was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }


    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request 
     * @return array
     */
    protected function getData(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|min:4|max:191',
            'email' => 'nullable',
            'ic_no' => 'required|string|min:8|max:8',
            'email_verified_at' => 'nullable',
            'department_id' => 'required',
            'employment_status_id' => 'required',
            'ap1_name' => 'nullable|string|min:4|max:191',
            'ap1_email' => 'nullable|string|min:4|max:191',
            'password' => 'nullable|string|min:12|max:191',
            'remember_token'    => 'nullable',
        ]);


        return $data;
    }



    // public function search(Request $request)
    // {
    //     $id = $request->id;

    //     $userdepartment = User::select('users.*')
    //         ->where('ic_no', 'LIKE', "%{$id}%")->orWhere('name', 'LIKE', "%{$id}%")->get();



    //     return view('users.index', compact('userdepartment'));
    // }

    // -> yang wani tambah 9/5/2024
    public function search(Request $request)
    {
        $query = $request->input('query');

       // Search users by name or IC number and paginate the results
        $userdepartment = User::where('name', 'LIKE', "%{$query}%")
        ->orWhere('ic_no', 'LIKE', "%{$query}%")
        ->paginate(20); // You can adjust the pagination limit as per your requirement

        return view('users.index', compact('userdepartment'));
    }

    public function demail()
    {
        $devopsAdminEmails = DevopsSupportAdmin::orderByDesc('created_at')->get();

        return view('users.demail', [
            'devopsAdminEmails' => $devopsAdminEmails,
        ]);
    }

        // Simpan multiple rows (bulk)
    public function demailstore(Request $request)
    {
        $validated = $request->validate([
            'moreFields'              => ['required', 'array', 'min:1'],
            'moreFields.*.ic_no'      => ['required', 'string', 'max:30'],
            'moreFields.*.email'      => ['required', 'email', 'max:255'],
            'moreFields.*.tel_no'     => ['nullable', 'string', 'max:30'],
        ]);

        $rows = [];
        $now  = now();

        foreach ($validated['moreFields'] as $row) {
            // Skip baris kosong (kalau user tambah tapi tidak isi)
            if (empty($row['ic_no']) && empty($row['email']) && empty($row['tel_no'])) {
                continue;
            }

            $rows[] = [
                'ic_no'      => trim($row['ic_no']),
                'email'      => strtolower(trim($row['email'])),
                'tel_no'     => $row['tel_no'] ? trim($row['tel_no']) : null,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        if (empty($rows)) {
            return back()->with('success_message', 'No rows to save.');
        }

        // Insert with upsert untuk elak duplicate (ikut unique index ic_no+email)
        DB::table('devops_support_admin')->upsert(
            $rows,
            ['ic_no', 'email'],
            ['tel_no', 'updated_at']
        );

        return back()->with('success_message', count($rows).' record(s) saved/updated.');
    }

        public function demaildestroy(DevopsSupportAdmin $adminEmail)
    {
        $adminEmail->delete();

        return back()->with('success_message', 'Record deleted.');
    }
}
