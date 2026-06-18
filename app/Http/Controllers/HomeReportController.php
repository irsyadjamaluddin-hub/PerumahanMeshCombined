<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Biodata;

use App\Models\Department;


use Auth;
use Hash;
use DB;


class HomeReportController extends Controller
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
	
    public function homereport(Request $request)
    {
        $countUsers = Biodata::count();

        $countJabatan = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
        ->where([['department_id', '7']])
        ->orWhere([['department_id', '23']])->orWhere([['department_id', '8']])->orWhere([['department_id', '9']])->orWhere([['department_id', '11']])
        ->orWhere([['department_id', '15']])->orWhere([['department_id', '17']])->orWhere([['department_id', '13']])->orWhere([['department_id', '16']])
        ->orWhere([['department_id', '10']])->orWhere([['department_id', '19']])->orWhere([['department_id', '21']])->orWhere([['department_id', '20']])
        ->orWhere([['department_id', '26']])->orWhere([['department_id', '29']])->orWhere([['department_id', '30']])->orWhere([['department_id', '33']])
        ->orWhere([['department_id', '31']])->count();
        

        $count1 = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
        ->where([['department_id', '1']])->count();
        $count2 = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
        ->where([['department_id', '2']])->count();
        $count3 = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
        ->where([['department_id', '3']])->count();
        $count4 = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
        ->where([['department_id', '4']])->count();
        $count5 = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
        ->where([['department_id', '5']])->count();
        $count6 = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
        ->where([['department_id', '6']])->count();
        $count7 = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
        ->where([['department_id', '7']])->count();        
        $count8 = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
        ->where([['department_id', '8']])->count();  
        $count9 = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
        ->where([['department_id', '9']])->count(); 
        $count10 = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
        ->where([['department_id', '10']])->count(); 
        $count11 = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
        ->where([['department_id', '11']])->count(); 
        $count12 = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
        ->where([['department_id', '12']])->count();
        $count13 = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
        ->where([['department_id', '13']])->count();  
        $count14 = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
        ->where([['department_id', '14']])->count();
        $count15 = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
        ->where([['department_id', '15']])->count();
        $count16 = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
        ->where([['department_id', '16']])->count();
        $count17 = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
        ->where([['department_id', '17']])->count();
        $count18 = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
        ->where([['department_id', '18']])->count();
        $count19 = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
        ->where([['department_id', '19']])->count();
        $count20 = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
        ->where([['department_id', '20']])->count();
        $count21 = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
        ->where([['department_id', '21']])->count();
        $count22 = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
        ->where([['department_id', '22']])->count();
        $count23 = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
        ->where([['department_id', '23']])->count();
        $count24 = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
        ->where([['department_id', '24']])->count();
        $count25 = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
        ->where([['department_id', '25']])->count();
        $count26 = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
        ->where([['department_id', '26']])->count();
        $count27 = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
        ->where([['department_id', '27']])->count();
        $count28 = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
        ->where([['department_id', '28']])->count();
        $count29 = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
        ->where([['department_id', '29']])->count();
        $count30 = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
        ->where([['department_id', '30']])->count();
        $count31 = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
        ->where([['department_id', '31']])->count();
        $count32 = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
        ->where([['department_id', '32']])->count();
        $count33 = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
        ->where([['department_id', '33']])->count();
        $count34 = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
        ->where([['department_id', '34']])->count();
        $count35 = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
        ->where([['department_id', '35']])->count();
        $count36 = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
        ->where([['department_id', '36']])->count();


        $countSekolah = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
        ->where([['department_id', '12']])
        ->orWhere([['department_id', '18']])->orWhere([['department_id', '14']])->orWhere([['department_id', '22']])->orWhere([['department_id', '24']])
        ->orWhere([['department_id', '34']])->orWhere([['department_id', '25']])->orWhere([['department_id', '36']])->orWhere([['department_id', '35']])
        // ->orWhere([['department_id', '46']])->orWhere([['department_id', '47']])->orWhere([['department_id', '48']])->orWhere([['department_id', '49']])
        // ->orWhere([['department_id', '50']])->orWhere([['department_id', '51']])->orWhere([['department_id', '52']])->orWhere([['department_id', '53']])
        // ->orWhere([['department_id', '54']])->orWhere([['department_id', '55']])->orWhere([['department_id', '56']])->orWhere([['department_id', '57']])
        // ->orWhere([['department_id', '58']])->orWhere([['department_id', '59']])->orWhere([['department_id', '60']])->orWhere([['department_id', '61']])

        // ->orWhere([['department_id', '62']])->orWhere([['department_id', '63']])->orWhere([['department_id', '64']])->orWhere([['department_id', '65']])
        // ->orWhere([['department_id', '66']])->orWhere([['department_id', '67']])->orWhere([['department_id', '68']])->orWhere([['department_id', '69']])
        // ->orWhere([['department_id', '70']])->orWhere([['department_id', '71']])->orWhere([['department_id', '72']])->orWhere([['department_id', '73']])
        // ->orWhere([['department_id', '74']])->orWhere([['department_id', '75']])->orWhere([['department_id', '76']])->orWhere([['department_id', '77']])
        // ->orWhere([['department_id', '78']])->orWhere([['department_id', '79']])->orWhere([['department_id', '80']])->orWhere([['department_id', '81']])

        // ->orWhere([['department_id', '82']])->orWhere([['department_id', '83']])->orWhere([['department_id', '84']])->orWhere([['department_id', '85']])
        // ->orWhere([['department_id', '86']])->orWhere([['department_id', '87']])->orWhere([['department_id', '88']])->orWhere([['department_id', '89']])
        // ->orWhere([['department_id', '90']])->orWhere([['department_id', '91']])->orWhere([['department_id', '92']])->orWhere([['department_id', '93']])
        // ->orWhere([['department_id', '94']])->orWhere([['department_id', '95']])->orWhere([['department_id', '96']])->orWhere([['department_id', '97']])
        // ->orWhere([['department_id', '98']])->orWhere([['department_id', '99']])->orWhere([['department_id', '100']])->orWhere([['department_id', '101']])

        // ->orWhere([['department_id', '102']])->orWhere([['department_id', '103']])->orWhere([['department_id', '104']])->orWhere([['department_id', '105']])
        // ->orWhere([['department_id', '106']])->orWhere([['department_id', '107']])->orWhere([['department_id', '108']])->orWhere([['department_id', '109']])
        // ->orWhere([['department_id', '110']])->orWhere([['department_id', '111']])->orWhere([['department_id', '112']])->orWhere([['department_id', '113']])
        // ->orWhere([['department_id', '114']])->orWhere([['department_id', '115']])->orWhere([['department_id', '116']])->orWhere([['department_id', '117']])
        // ->orWhere([['department_id', '118']])->orWhere([['department_id', '119']])->orWhere([['department_id', '120']])->orWhere([['department_id', '121']])
        // ->orWhere([['department_id', '122']])->orWhere([['department_id', '123']])->orWhere([['department_id', '124']])->orWhere([['department_id', '125']])

        // ->orWhere([['department_id', '126']])->orWhere([['department_id', '127']])->orWhere([['department_id', '128']])->orWhere([['department_id', '73']])
        // ->orWhere([['department_id', '73']])->orWhere([['department_id', '73']])->orWhere([['department_id', '73']])->orWhere([['department_id', '73']])
        // ->orWhere([['department_id', '73']])->orWhere([['department_id', '73']])->orWhere([['department_id', '73']])->orWhere([['department_id', '73']])
        ->count();

        $currentYear = $request->input('year', date('Y'));

        $monthlyTotalUsers = [];

        for ($month = 1; $month <= 12; $month++) {

            $endOfMonth = \Carbon\Carbon::create($currentYear, $month, 1)->endOfMonth();

            // Total users up to end of that month
            $totalUsers = User::where('created_at', '<=', $endOfMonth)->count();

            $monthlyTotalUsers[] = $totalUsers;
        }

        return view('/homereport', compact('countUsers', 'countJabatan', 'count1', 'count2', 'count3', 'count4', 'count5',
        'count6', 'count7', 'count8', 'count9', 'count10', 'count11', 'count12', 'count13', 'count14', 'count15', 'count16',
        'count17', 'count18', 'count19', 'count20', 'count21', 'count22', 'count23', 'count24', 'count25', 'count26', 'count27',
        'count28', 'count29', 'count30', 'count31', 'count32', 'count33', 'count34', 'count35', 'count36',
        'countSekolah', 'currentYear', 'monthlyTotalUsers',
    ));
 
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
