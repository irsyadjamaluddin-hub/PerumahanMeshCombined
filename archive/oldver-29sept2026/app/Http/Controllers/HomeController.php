<?php
/* OLD VERSION (oldver-29sept2026): copy of app/Http/Controllers/HomeController.php taken on 29 Sept 2026, before pdmsindex() was
   given the E-Memo action count. Kept outside app/ so it is never autoloaded. */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\Banner;
use App\Models\Announcement;
use App\Models\News;
/* =============== NISAH =============== */
// Needed for the E-Memo "to act" count shown on the homepage's D Flow service card
use Illuminate\Support\Facades\DB;
/* =============================================== */

class HomeController extends Controller
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
        $banners = Banner::orderBy('created_at', 'DESC')->paginate(4);

        // Check if there are any records in the SrNews table
        $announcementExist = Announcement::exists();

        $announcements = Announcement::orderBy('created_at', 'DESC')->paginate(4);

        $news = News::orderBy('created_at', 'DESC')->paginate(3);

        // Check if there are any records in the SrNews table
        $newsExist = News::exists();

        /* =============== NISAH =============== */
        // New homepage (Sept 2026) shows the services sections, so it needs the same E-Memo action count
        // that ServicesDashboardController@servicesdashboard computes — same query, copied as-is.
        $icNo = Auth::user()->ic_no ?? null;
        $tindakanIds = DB::table('eminit_tindakandiperlukan')
            ->where('ic_no', $icNo)
            ->pluck('id')
            ->toArray();
        $actions = DB::table('eminit_action as ea')
            ->whereIn('ea.tindakanby_diperlukan', $tindakanIds)
            ->get();
        $totalEmemoTindakan = $actions->filter(function ($item) {
            $vals = json_decode($item->jenis_tindakan, true);
            if (!is_array($vals)) {
                $vals = [];
            }
            return empty($vals);
        })->count();

        return view('/home', compact('banners','announcements','announcementExist','news','newsExist','totalEmemoTindakan'));
        /* =============================================== */
    }

    public function pdmsindex()
    {
        $user = Auth::user();
        $banners = Banner::orderBy('created_at', 'DESC')->paginate(4);

        // Check if there are any records in the SrNews table
        $announcementExist = Announcement::exists();

        $announcements = Announcement::orderBy('created_at', 'DESC')->paginate(4);

        $news = News::orderBy('created_at', 'DESC')->paginate(3);

        // Check if there are any records in the SrNews table
        $newsExist = News::exists();

                return view('/pdmshome', compact('banners','announcements','announcementExist','news','newsExist'));
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
