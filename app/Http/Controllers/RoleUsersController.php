<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Biodata;
use App\Models\Employment;
use App\Models\Department;
// use App\User;

use App\Models\RoleUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Support\Facades\Crypt;

use Carbon\Carbon;

class RoleUsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkRole:ROLE_SUPERADMIN');
    }
    
    /**
     * Display a listing of the role users.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        // $roleUsers = RoleUser::with('role','user')->latest('id')->get();
        // $roleUsersID = RoleUser::with('role','user')->latest('id')->get();
        //$Usersss = User::get();
        $Users = User::all()->sortByDesc("id");
        $Users = User::where('approval_response','Accept Registration')
		->where('approval_response2','Approve')
        ->orderByDesc('id')
		->get();
        $userrole = RoleUser::with('role','user')->latest('id')->get();

        $roleUsersNew = RoleUser::leftJoin('users', 'role_user.user.id', '=', 'users.id');
        
        return view('role_users.index', compact('Users','userrole'));
        
    }

    /**
     * Show the form for creating a new role user.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::pluck('name','id')->all();
        $users = User::pluck('name','id')->all();
        $usersEmail = Auth::user('id')->email;
                
        return view('role_users.create', compact('roles','users','usersEmail'));
    }

    /**
     * Store a new role user in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        try {
            
            $data = $this->getData($request);
            
            RoleUser::create($data);
            $userEmail = Auth::user()->email;

            return redirect()->route('role_users.role_user.index')
                             ->with('success_message', 'Role User was successfully added!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Display the specified role user.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $roleUser = RoleUser::with('role','user')->findOrFail($id);

        return view('role_users.show', compact('roleUser'));
    }

    /**
     * Show the form for editing the specified role user.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($newroles)
    {
        $decriptid = Crypt::decryptString($newroles);

        $newroles = RoleUser::leftJoin('roles', 'role_user.role_id' , '=', 'roles.id')
        ->leftJoin('users','role_user.user_id','=','users.id')
        ->where('role_user.user_id', '=', $decriptid)
        ->select('role_user.*', 'users.name','roles.name')
        ->get();

        $roles = Role::pluck('name','id')->all();

        $roleid = Role::pluck('name','id')->all();
        $users = User::pluck('name','id')->all();

        return view('role_users.formredesign', compact('roles','users', 'newroles', 'roleid'));
    }

    /**
     * Update the specified role user in the storage.
     *
     * @param  int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {

        // $booking = Booking::findOrFail($id);
        // $booking->update(['end_time' => now()]);
        try {
            
            $data = $this->getData($request);
            
            $roleUser = RoleUser::findOrFail($id);
            $roleUser->update($data);


            //$usersEmail = Auth::user('id')->email;

            $now = Carbon::now();

            $usersEmail =  User::select('users.*')
            ->where('id', $roleUser->user_id)
                ->update([
                    
                        'email' => $request->email,
                        'updated_at' => $now,
                ]);



            return redirect()->route('role_users.role_user.index')
                             ->with('success_message', 'Role User was successfully updated!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }        
    }

    public function updatenew(Request $request)
    {
        $request->validate([]);

        $now = Carbon::now();

        $roleUser =  RoleUser::select('role_user.*')
        ->where('id', $request->id)
        ->update([
           
            'updated_at' => $now

        ]);

        $user_id = $request->user_id;
        // $nama_role = $request->nama_role;
        $role_id = $request->role_id;



        if ($request->user_id != '' || $request->role_id  != '') {

            for ($count_1 = 0; $count_1 < count($role_id); $count_1++) {

                $data_1 = array(

                    'user_id' => $user_id,
                    'role_id' => $role_id[$count_1],

                );

                $insert_data_1[] = $data_1;
            }

            // Save 'kadarkenaikangaji' data
            RoleUser::insert($insert_data_1);
        }
        return redirect()->back()
        // return redirect()->route('role_users.role_user.index')
        ->with('success_message', 'Data has successfully updated!');
               
    }

    /**
     * Remove the specified role user from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $roleUser = RoleUser::where('id', $id)->delete();
           

            return redirect()->back()
                             ->with('success_message', 'Role User was successfully deleted!');

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
            'role_id' => 'required',
            'user_id' => 'required',
                
        ]);




        return $data;
    }

    public function search(Request $request)
    {
        $id = $request->id;
        
        $roleUsers = RoleUser::leftjoin('users', 'users.id', '=', 'role_user.user_id')->select('role_user.*')
        ->where('ic_no', 'LIKE', "%{$id}%")->orWhere('name', 'LIKE', "%{$id}%")->get();

        return view('role_users.index', compact('roleUsers'));
    }


    public function create2()
    {
        $icNos = Auth::user()->ic_no;

        $biodatas = Biodata::all()
						->where('ic_no', '=', $icNos);

        $roleUsers = RoleUser::leftjoin('users', 'users.id', '=', 'role_user.user_id')->select('role_user.*');
		
	    $employments = Employment::all()
						->where('ic_no', '=', $icNos);

        $departments = Department::pluck('label','id')->all();
        

        return view('role_users.indexnew', compact('biodatas', 'employments', 'departments') );
    }
    
    //Zharif add - 21/2/2024 
    //Start New Role
    public function roleindex() {
        $roles = Role::orderBy('name', 'ASC')
            ->get();
        
        return view('role_users.roleindex', compact('roles'));     
    }

    public function roleedit($id) {
        $icNos = Auth::user()->ic_no; 

        $roles = Role::select('roles.*')
            ->where('id', '=', $id)
            ->first();
        
        return view('role_users.roleedit', compact('roles'));     
    }

    public function rolestore(Request $request) {
        $now = Carbon::now();

        $roles = new Role;

        $roles-> name = $request->name;
        $roles-> description = $request->description;

        $roles->created_at = $now;
        $roles->save();

        return redirect()->back()
            ->with('success_message', 'Role were successfully added!');
    }

    public function roleupdate(Request $request){
        $user = Auth::user()->name;
    
        $id = $request->input('id');
    
        // Find the record to be updated
        $roles = Role::where('id', $id)
            ->where('id', $id)
            ->first();
    
        // Update the record with the new data
        $roles->name = $request->input('name');
        $roles->description = $request->input('description');
        $roles->save();
    
        return redirect()->route('role_users.role_user.roleindex')
            ->with('success_message', 'Role Data Updated!');
    }

    public function roledestroy($id) {
        try {
            $role = Role::findOrFail($id);
            $role -> delete();

            return redirect()->back()
                             ->with('success_message', 'Role User was successfully deleted!');

        } catch (Exception $exception) {
            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }    
    //End New Role
}