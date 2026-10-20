<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Biodata;

use App\Models\Department;


use Auth;
use Hash;
use DB;


class ServicesDashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('/home');
    }

    public function admindashboard()
    {
        return view('/admindashboard');
    }

    public function servicesdashboard()
    {
        $user = Auth::user();
        $icNo = $user->ic_no ?? null;

        // Get tindakan IDs that belong to this user
        $tindakanIds = DB::table('eminit_tindakandiperlukan')
            ->where('ic_no', $icNo)
            ->pluck('id')
            ->toArray();

        // Get actions for this user
        $actions = DB::table('eminit_action as ea')
            ->whereIn('ea.tindakanby_diperlukan', $tindakanIds)
            ->get();

        // Count only actions where jenis_tindakan is empty
        $totalEmemoTindakan = $actions->filter(function ($item) {
            $vals = json_decode($item->jenis_tindakan, true);

            if (!is_array($vals)) {
                $vals = [];
            }

            return empty($vals);
        })->count();

        return view('/servicesdashboard', compact('totalEmemoTindakan'));
    }

	public function welcome(){
		return view('welcome');
	}
	
	public function showChangePasswordForm(){
        return view('auth.changepassword');
    }

    public function changePassword(Request $request){
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed|regex:/^(?=.*?[a-z])(?=.*?[A-Z])(?=.*?[#?!@$%^&*-]).{6,}$/',
        ]);
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("success","Password changed successfully !");
        // return redirect()->to('home')->with("success","Password changed successfully !");
        
        // to('/')
    }
}
