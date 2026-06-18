<?php
namespace App\Http\Controllers;
use App\Models\Kepada;
use App\Models\EminitJenis;
use App\Models\Daripada;
use App\Models\Eminit_Tindakandiperlukan;
use App\Models\EminitAdminPushNotif;
use App\Models\Employment;
use App\Models\Eminit_Untukperhatian;
use App\Models\Department;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\MecuserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewMecuserNotification;
use App\Models\Tindakanlist;

class AdminSettingsController extends Controller{

    public function adminsettingsdashboard()
    {
        return view('adminsettings.adminsettingsdashboard');
    }

    public function editjenis()
    {
        $icNos = Auth::user()->ic_no;

        $Sjenis = EminitJenis::pluck('label', 'id')->all();

        return view('adminsettings.editjenis', compact(
            'icNos',
            'Sjenis'
        ));
    }
    // public function store1(Request $request)
    // {

    //     foreach ($request->moreFields as $key => $value) {
    //         EminitJenis::create($value);
    //     }

    //     return redirect()->route('adminsettings.editjenis')
    //         ->with('success_message', 'New Data record was successfully added!');
    // }
    public function store1(Request $request)
    {
        $request->validate([
            'moreFields' => ['required','array','min:1'],
            'moreFields.*.label' => ['required','string','max:255','distinct'], // add 'unique:jenis,label' if needed
        ]);

        foreach ($request->moreFields as $row) {
            EminitJenis::create([
                'label' => $row['label'],
            ]);
        }

        return redirect()->route('adminsettings.editjenis')
            ->with('success_message', 'New Data record was successfully added!');
    }
        public function destroyeditjenis($id)
    {
        try {

            $mecusers = EminitJenis::where('id', $id)->delete();

            return redirect()->route('adminsettings.editjenis')
                ->with('success_message', 'Data was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function editjenistindakan()
    {
        $icNos = Auth::user()->ic_no;

        $Stindakanlist = Tindakanlist::orderBy('id', 'asc')->get();

        return view('adminsettings.editjenistindakan', compact('Stindakanlist', 'icNos'));
    }
    public function store2(Request $request)
    {
        $request->validate([
            'moreFields' => ['required','array','min:1'],
            'moreFields.*.label' => ['required','string','max:255','distinct'], // add 'unique:tindakanlists,label' if needed
        ]);

        foreach ($request->moreFields as $row) {
            Tindakanlist::create(['label' => $row['label']]);
        }

        return redirect()->route('adminsettings.editjenistindakan')
            ->with('success_message', 'New Data record was successfully added!');
    }
        public function destroyeditjenistindakan($id)
        {
            try {
                Tindakanlist::where('id', $id)->delete();

                return redirect()->route('adminsettings.editjenistindakan')
                    ->with('success_message', 'Data was successfully deleted!');
            } catch (\Throwable $e) {
                return back()->withInput()
                    ->withErrors(['unexpected_error' => 'Unexpected error: '.$e->getMessage()]);
            }
        }
        public function edittindakandiperlukan()
    {
        $icNos = Auth::user()->ic_no;
        $kepada = Kepada::pluck('label', 'label')->all();

        $jenis = EminitJenis::pluck('label', 'id')->all();

      

        $department = Department::pluck('label', 'id')->all();



        $departmentId = Employment::where('ic_no', $icNos)->value('department_id');

        $eminittindakandiperlukans = Eminit_Tindakandiperlukan::with(['department:id,label'])
            ->where('department_id', $departmentId)
            ->latest('created_at')
            ->get();

        // $Eminit_Untukperhatians = Eminit_Untukperhatian::get();
        $Eminit_Untukperhatians = Eminit_Untukperhatian::with('department')->get();

        return view('adminsettings.edittindakandiperlukan', compact(
            'icNos',
            'kepada',
            'jenis',
            'department',
            'eminittindakandiperlukans',
            'departmentId',
            'Eminit_Untukperhatians',
        ));
    }
        public function store3(Request $request)
        {
            $validated = $request->validate([
                'moreFields.*.ic_no' => 'required|digits_between:8,12', // adjust as needed
                'moreFields.*.email' => 'required|email',
                'moreFields.*.department_id' => 'required|integer|exists:departments,id',
                'moreFields.*.kod' => 'required|string|max:50',
                'moreFields.*.label' => 'required|in:Pengarah,Pegawai Tindakan,Kakitangan PT',
            ], [
                'moreFields.*.ic_no.required' => 'IC No wajib diisi.',
                'moreFields.*.ic_no.digits_between' => 'IC No mesti antara 8 hingga 12 digit.',
                'moreFields.*.email.required' => 'Email wajib diisi.',
                'moreFields.*.email.email' => 'Format email tidak sah.',
                'moreFields.*.department_id.required' => 'Jabatan wajib dipilih.',
                'moreFields.*.kod.required' => 'Kod wajib diisi.',
                'moreFields.*.label.required' => 'Peranan wajib dipilih.',
            ]);

            foreach ($validated['moreFields'] as $row) {
                Eminit_Tindakandiperlukan::create($row);
            }

            return redirect()->back()->with('success', 'Records saved successfully!');
        }

        public function destroyedittindakandiperlukan($id)
    {
        try {

            $mecusers = Eminit_Tindakandiperlukan::where('id', $id)->delete();

            return redirect()->route('adminsettings.edittindakandiperlukan')
                ->with('success_message', 'Data was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    // adminnotificationpush.blade.php
    public function adminnotificationpush()
    {
        $icNos = Auth::user()->ic_no;
        $kepada = Kepada::pluck('label', 'label')->all();

        $department = Department::pluck('label', 'id')->all();

        $departmentId = Employment::where('ic_no', $icNos)->value('department_id');

        $EminitAdminPushNotifs = EminitAdminPushNotif::with(['department:id,label'])
            ->where('department_id', $departmentId)
            ->latest('created_at')
            ->get();

        // $Eminit_Untukperhatians = Eminit_Untukperhatian::get();
        $Eminit_Untukperhatians = Eminit_Untukperhatian::with('department')->get();

        return view('adminsettings.adminnotificationpush', compact(
            'icNos',
            'kepada',
        
            'department',
            'EminitAdminPushNotifs',
            'departmentId',
            'Eminit_Untukperhatians',
        ));
    }
        public function storeadminnotificationpush(Request $request)
        {
            $validated = $request->validate([
                'moreFields.*.ic_no' => 'required|digits_between:8,12', // adjust as needed
                'moreFields.*.email' => 'required|email',
                'moreFields.*.department_id' => 'required|integer|exists:departments,id',
                'moreFields.*.no_tel' => 'required|string|max:50',
                
            ], [
                'moreFields.*.ic_no.required' => 'IC No wajib diisi.',
                'moreFields.*.ic_no.digits_between' => 'IC No mesti antara 8 hingga 12 digit.',
                'moreFields.*.email.required' => 'Email wajib diisi.',
                'moreFields.*.email.email' => 'Format email tidak sah.',
                'moreFields.*.department_id.required' => 'Jabatan wajib dipilih.',
                'moreFields.*.no_tel.required' => 'No Tel wajib diisi.',
               
            ]);

            foreach ($validated['moreFields'] as $row) {
                EminitAdminPushNotif::create($row);
            }

            return redirect()->back()->with('success', 'Records saved successfully!');
        }

        public function destroyadminnotificationpush($id)
    {
        try {

            $mecusers = EminitAdminPushNotif::where('id', $id)->delete();

            return redirect()->route('adminsettings.edittindakandiperlukan')
                ->with('success_message', 'Data was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    // endadminnotificationpush


    public function edituntukperhatian()
    {
        $icNos = Auth::user()->ic_no;
        $departmentId = Employment::where('ic_no', $icNos)->value('department_id');
        $kepada = Kepada::pluck('label', 'id')->all();

        $jenis = EminitJenis::pluck('label', 'id')->all();

        $department = Department::pluck('label', 'id')->all();

        $Eminit_Untukperhatians = Eminit_Untukperhatian::select('eminit_untukperhatian.*')
            ->where('jabatan',$departmentId)
            ->orderBy('created_at', 'DESC')
            ->get();


        return view('adminsettings.edituntukperhatian', compact('kepada', 'jenis', 'department', 'Eminit_Untukperhatians','icNos','departmentId'));
    }

    public function store4(Request $request)
    {

        foreach ($request->moreFields as $key => $value) {
            Eminit_Untukperhatian::create($value);
        }

        return redirect()->route('adminsettings.edituntukperhatian')
            ->with('success_message', 'New Data record was successfully added!');
    }

    public function destroyedituntukperhatian($id)
    {
        try {

            $Eminit_Untukperhatians = Eminit_Untukperhatian::where('id', $id)->delete();

            return redirect()->route('adminsettings.edituntukperhatian')
                ->with('success_message', 'Data was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

}