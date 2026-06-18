<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\AttendanceStudent;
use App\Models\AttendanceStaff;
use App\Models\AttendanceEvent;
use App\Models\AttendanceList;
use App\Models\AttendanceExport;
use App\Models\Department;

use App\Exports\ExportExcel; // Import your export class

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet; // Add this import statement
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use Carbon\Carbon;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class AttendanceController extends Controller
{
   
    /**
     * Display a listing of the users.
     *
     * @return Illuminate\View\View
     */
    public function indexstudent()
    {

        $attendst = AttendanceStudent::select('attendance_student.*')->paginate(500);
        $now = Carbon::now();
    
        return view('attendancestudent.indexstudent', compact('attendst','now'));
    }

    public function editstudent($id)
    {

        $attendst = AttendanceStudent::select('attendance_student.*')
            ->where('id',$id)
            ->first();

        $departments = Department::pluck('label', 'id')->all();
    
        return view('attendancestudent.editstudent', compact('attendst','departments'));
    }

    public function destroystudent($id)
    {
        try {

          $at= AttendanceStudent::where('id', $id)->delete();

            return redirect()->route('attendance.attendances.indexstudent')
                ->with('success_message', 'Data was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function formstudent()
    {
        
        $departments = Department::pluck('label', 'id')->all();

        return view('attendancestudent.formstudent',compact('departments'));    
    }

    public function megibarstudent(Request $request)
    {

        $now = Carbon::now();

        $attendst =  AttendanceStudent::select('attendance_student.*')
            ->where('id', $request->id)
            ->update([
                'event' => $request->event,
                'created_at' => $now
            ]);

        return redirect()->back()
        ->with('success_message', 'Student has successfully been updated!');  
    }

    /**
     * Display a listing of the users.
     *
     * @return Illuminate\View\View
     */
    public function storestudent(Request $request)
    {
        if($request->ic_no != null){
            $attendstdup = AttendanceStudent::where('ic_no',$request->ic_no)->first();
        }else{
            $attendstdup = AttendanceStudent::where('birth_cert',$request->birth_cert)->first();
        }
        

        if($attendstdup == null){
            $attendst = new AttendanceStudent;

            $currentdate = Carbon::now();
            $icNos = Auth::user()->ic_no;
    
            $attendst->name = $request->name;
            $attendst->ic_no = $request->ic_no;
            $attendst->birth_cert = $request->birth_cert;
            $attendst->year = $request->year;
            $attendst->school = $request->school;
            $attendst->district = $request->district;
            $attendst->created_at = $currentdate;
            // Save 'Attendance Student' data
            $attendst->save();
    
            return redirect()->route('attendance.attendances.indexstudent')
            ->with('success_message', 'Student has successfully been submitted!');
        }else{

            return redirect()->back()
            ->with('error_message', 'Duplication of Identification (IC No/ Birth Cert) !');
        }
    }

    public function updatestudent(Request $request)
    {
        $now = Carbon::now();

        $attendst =  AttendanceStudent::select('attendance_student.*')
            ->where('id', $request->id)
            ->update([
                'name' => $request->name,
                'ic_no' => $request->ic_no,
                'birth_cert' => $request->birth_cert,
                'year' => $request->year,
                'school' => $request->school,
                'district' => $request->district,
                'created_at' => $now
            ]);

        return redirect()->route('attendance.attendances.indexstudent')
        ->with('success_message', 'Student has successfully been updated!');
    }

    public function searchstudent(Request $request)
    {
        $query = $request->input('query');
    
        // Define the columns you want to search in
        $columns = ['name', 'ic_no', 'birth_cert', 'year', 'school', 'district'];
    
        // Start building the query
        $attendst = AttendanceStudent::where(function ($queryBuilder) use ($columns, $query) {
            foreach ($columns as $column) {
                $queryBuilder->orWhere($column, 'LIKE', '%' . $query . '%');
            }
        })->orderBy('updated_at', 'DESC');
    
        // Check if the number of results exceeds a threshold
        $threshold = 1000; // Adjust the threshold as needed
        $totalResults = $attendst->count();
    
        if ($totalResults > $threshold) {
            $attendst = $attendst->paginate(5000);
        } else {
            $attendst = $attendst->get();
        }

        $now = Carbon::now();
    
        return view('attendancestudent.indexstudentsearch', ['attendst' => $attendst, 'now' => $now]);
    }

    public function indexstaff()
    {

        $attendsf = AttendanceStaff::select('attendance_staff.*')->paginate(500);
    
        return view('attendancestudent.indexpengawas', compact('attendsf'));
    }

    public function editstaff($id)
    {

        $attendsf = AttendanceStaff::select('attendance_staff.*')
            ->where('id',$id)
            ->first();

        $departments = Department::pluck('label', 'id')->all();
    
        return view('attendancestudent.editpengawas', compact('attendsf','departments'));
    }

    public function destroystaff($id)
    {
        try {

          $af= AttendanceStaff::where('id', $id)->delete();

            return redirect()->route('attendance.attendances.indexstaff')
                ->with('success_message', 'Data was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function formstaff()
    {

        $departments = Department::pluck('label', 'id')->all();

        return view('attendancestudent.formpengawas',compact('departments'));    
    }

    /**
     * Display a listing of the users.
     *
     * @return Illuminate\View\View
     */
    public function storestaff(Request $request)
    {
        $attendstdup = AttendanceStaff::where('ic_no',$request->ic_no)->first();

        if($attendstdup == null){
            $attendst = new AttendanceStaff;

            $currentdate = Carbon::now();
    
            $attendst->name = $request->name;
            $attendst->ic_no = $request->ic_no;
            $attendst->school = $request->school;
            $attendst->district = $request->district;
            $attendst->created_at = $currentdate;
            // Save 'Attendance Staff' data
            $attendst->save();
    
            return redirect()->route('attendance.attendances.indexstaff')
            ->with('success_message', 'Student has successfully been submitted!');
        }else{

            return redirect()->back()
            ->with('error_message', 'Duplication of Identification (IC No/ Birth Cert) !');
        }
    }

    public function updatestaff(Request $request)
    {
        $now = Carbon::now();

        $attendst =  AttendanceStaff::select('attendance_staff.*')
            ->where('id', $request->id)
            ->update([
                'name' => $request->name,
                'ic_no' => $request->ic_no,
                'school' => $request->school,
                'district' => $request->district,
                'created_at' => $now
            ]);

        return redirect()->route('attendance.attendances.indexstaff')
        ->with('success_message', 'Staff has successfully been updated!');
    }

    public function searchstaff(Request $request)
    {
        $query = $request->input('query');
    
        // Define the columns you want to search in
        $columns = ['name', 'ic_no', 'year', 'school', 'district'];
    
        // Start building the query
        $attendsf = AttendanceStaff::where(function ($queryBuilder) use ($columns, $query) {
            foreach ($columns as $column) {
                $queryBuilder->orWhere($column, 'LIKE', '%' . $query . '%');
            }
        })->orderBy('updated_at', 'DESC');
    
        // Check if the number of results exceeds a threshold
        $threshold = 1000; // Adjust the threshold as needed
        $totalResults = $attendsf->count();
    
        if ($totalResults > $threshold) {
            $attendsf = $attendsf->paginate(5000);
        } else {
            $attendsf = $attendsf->get();
        }
    
        return view('attendancestudent.indexpengawassearch', ['attendsf' => $attendsf]);
    }

    //EVENT STARTS

    public function indexevent()
    {

        $event = AttendanceEvent::select('attendance_event.*')->paginate(500);
    
        return view('attendancestudent.indexevent', compact('event'));
    }

    public function destroyevent($id)
    {
        try {

          $ae= AttendanceEvent::where('id', $id)->delete();

            return redirect()->route('attendance.attendances.indexevent')
                ->with('success_message', 'Data was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function downloadQrCodePdf($id)
    {
        $attendanceevent = AttendanceEvent::find($id);

        $qrCodePath = $this->generateQrCode($attendanceevent);
        $pdfPath = $this->generatePdf($attendanceevent, $qrCodePath);

        return response()->file($pdfPath);
    }

    public function generateQrCode(AttendanceEvent $event)
    {
        $qrCode = QrCode::size(350)->generate(route('attendance.attendances.qrcodeevent', ['id' => $event->id]));

        $directory = public_path('qrcodes/');
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $qrCodePath = $directory . $event->id . '.png';

        // Save the QR code to the file path
        file_put_contents($qrCodePath, $qrCode);

        return $qrCodePath;
    }

    public function qrcodeevent($name)
    {
        $event = AttendanceEvent::select('attendance_event.*')
            ->where('name',$name)
            ->first();

        $departments = Department::pluck('label', 'id')->all();
        
        return view('attendancestudent.qrcodevent',compact('event','departments'));
    }

    public function qrcodeeventstore(Request $request)
    {

        // Check for duplication based on ic_no and birth_cert
        $eventlist = AttendanceList::select('attendance_list.*')
            ->where('event', $request->event)
            ->where(function($query) use ($request) {
                if (!is_null($request->ic_no)) {
                    $query->where('ic_no', $request->ic_no);
                }

                if (!is_null($request->birth_cert)) {
                    $query->orWhere(function($query) use ($request) {
                        $query->whereNull('ic_no')
                              ->where('birth_cert', $request->birth_cert);
                    });
                }
            })
            ->first();

        if ($eventlist) {
            return back()->with('error_message', 'Duplicate record found with the same IC No.');
        }

        $currentdate = Carbon::now();
        $attendlist = new AttendanceList;

        $attendlist->name = $request->name;
        $attendlist->ic_no = $request->ic_no;
        $attendlist->birth_cert = $request->birth_cert;        
        $attendlist->year = $request->year;
        $attendlist->classroom_name = $request->classroom_name;
        $attendlist->school = $request->school;
        $attendlist->school_category = $request->school_category;
        $attendlist->district = $request->district;
        $attendlist->category = $request->category;
        $attendlist->event = $request->event;
        $attendlist->created_at = $currentdate;
        
        // Save 'Attendance List' data
        $attendlist->save();
        
        return back()->with('success_message', 'Data was successfully saved!');
    }

    //CHOSEN BLADE

    public function indexchosen($id)
    {
        
        $events = AttendanceEvent::where('id', $id)->first();

        $attenduser = AttendanceList::where('event',$events->name)->paginate(500);

        return view('attendancestudent.indexchosen',compact('events','attenduser'))
            ->with('success_message', 'Data was successfully retrieved!');
     }

     public function editchosen($id)
    {
 
        $attenduser = AttendanceList::select('attendance_list.*')
            ->where('id',$id)
            ->first();

        $departments = Department::pluck('label', 'id')->all();

        $events = AttendanceEvent::where('name', $attenduser->event)->first();
     
        return view('attendancestudent.editchosen', compact('events','attenduser','departments'));
    }

    public function updatechosen(Request $request)
    {

        $now = Carbon::now();

        $attendlist = AttendanceList::select('attendance_list.*')
            ->where('id', $request->id)
            ->update([
                'name' => $request->name,
                'ic_no' => $request->ic_no,
                'birth_cert' => $request->birth_cert,
                'year' => $request->year,
                'classroom_name' => $request->classroom_name,
                'school' => $request->school,
                'school_category' => $request->school_category,
                'district' => $request->district,
                'category' => $request->category,
                'updated_at' => $now
            ]);
 
        $attenduser = AttendanceList::select('attendance_list.*')
            ->where('id',$request->id)
            ->first();

        $departments = Department::pluck('label', 'id')->all();

        $events = AttendanceEvent::where('name', $attenduser->event)->first();
     
        // Redirect to the chosen event page with a success message
        return redirect()->route('attendance.attendances.indexchosen', ['events' => $events->id])
        ->with('success_message', 'The event has successfully been updated!');
    
    }

    public function formchosen($id)
    {
         
        $events = AttendanceEvent::where('id', $id)->first();

        $attendst = AttendanceStudent::select('attendance_student.*')->get();

        $attendsf = AttendanceStaff::select('attendance_staff.*')->get();

        $departments = Department::pluck('label', 'id')->all();

        return view('attendancestudent.formchosen',compact('events','attendst','attendsf','departments'));
    }

    public function formchosenstore(Request $request)
{
    $events = AttendanceEvent::find($request->events);

    $attendst = AttendanceStudent::all();
    $attendsf = AttendanceStaff::all();
    $departments = Department::pluck('label', 'id')->all();
    $attendlist = new AttendanceList;
    $currentdate = Carbon::now();

    if ($request->category == 'Pengawas') {
        $userdata = AttendanceStaff::find($request->idstaff);
    } elseif ($request->category == 'Pelajar') {
        $userdata = AttendanceStudent::find($request->idstudent);
    }

    if ($userdata) {
        $existingRecord = AttendanceList::where('ic_no', $userdata->ic_no)
            ->where('event', $events->name)
            ->first();

        if ($existingRecord) {
            return back()->with('error_message', 'Duplicate record found with the same IC No.');
        }

        $attendlist->name = $userdata->name;
        $attendlist->ic_no = $userdata->ic_no;

        if ($request->category == 'Pelajar') {
            $attendlist->birth_cert = $userdata->birth_cert;
        }

        $attendlist->year = $userdata->year;
        $attendlist->classroom_name = $userdata->classroom_name;
        $attendlist->school = $userdata->school;
        $attendlist->district = $userdata->district;
        $attendlist->category = $request->category;
        $attendlist->event = $events->name;
        $attendlist->created_at = $currentdate;

        $attendlist->save();

        return back()->with('success_message', 'Candidate has been successfully added!');
        //redirect()->route('attendance.attendances.formchosen', compact('events', 'attendst', 'attendsf', 'departments'))
          //  ->with('success_message', 'Candidate has been successfully added!');
    } else {
        return back()->with('error_message', 'No matching record found for the selected category and ID.');
    }
}

    public function destroychosen($id)
    {
        try {

          $al= AttendanceList::where('id', $id)->delete();

            return redirect()->back()
                ->with('success_message', 'Data was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function searchchosen(Request $request)
    {
        $query = $request->input('query');
    
        // Define the columns you want to search in
        $columns = ['name', 'ic_no', 'year', 'school', 'district'];
    
        // Start building the query
        $attenduser = AttendanceList::where(function ($queryBuilder) use ($columns, $query) {
            foreach ($columns as $column) {
                $queryBuilder->orWhere($column, 'LIKE', '%' . $query . '%');
            }
        })->orderBy('created_at', 'DESC');
    
        // Check if the number of results exceeds a threshold
        $threshold = 1000; // Adjust the threshold as needed
        $totalResults = $attenduser->count();
    
        if ($totalResults > $threshold) {
            $attenduser = $attenduser->paginate(5000);
        } else {
            $attenduser = $attenduser->paginate(500);
        }

        $events = AttendanceEvent::where('id', $request->event)->first();

        return view('attendancestudent.indexchosensearch', ['attenduser' => $attenduser , 'events' => $events]);
    }

    /**
     * Display a listing of the users.
     *
     * @return Illuminate\View\View
     */
    public function storeevent(Request $request)
    {
            $attendse = new AttendanceEvent;

            $currentdate = Carbon::now();
    
            $attendse->name = $request->name;
            $attendse->date = $request->date;
            $attendse->created_at = $currentdate;
            // Save 'Attendance Staff' data
            $attendse->save();
    
            return redirect()->route('attendance.attendances.indexevent')
            ->with('success_message', 'TH event has successfully been created!');
    }

    
    //GENERAL STARTS

    public function generallogin(Request $request){

        $input = $request->all();
  
        $this->validate($request, [
            'ic_no' => 'required',
            'password' => 'required',
        ]);
  
        $fieldType = filter_var($request->ic, FILTER_VALIDATE_EMAIL) ? 'email' : 'ic_no';
        if(auth()->attempt(array($fieldType => $input['ic_no'], 'password' => $input['password'])))
        {
            return redirect()->back()->with('success_message', 'Logged in successfully!');
        }else{
			return redirect()->back()->with(['verification_message' => 'Provided Credentials does not match with our records!']);
        }
    }

    public function generalsearch(){

        $departments = Department::pluck('label', 'id')->all();

        $event = AttendanceEvent::select('attendance_event.*')->get();

        return view('attendancestudent.generalsearch',compact('departments','event'));
    }

    public function generalresult(Request $request){

        $attendance =  AttendanceList::select('attendance_list.*')
            ->where('school',$request->school)
            ->where('category',$request->role)
            ->where('event',$request->event)
            ->first();

        if($attendance != null){

            $result = AttendanceList::select('attendance_list.*')
                ->where('school',$request->school)
                ->where('category',$request->role)
                ->where('event',$request->event)
                ->get();

            $roles = $request->role;

            $schools = $request->school;

            $events = $request->event;

            return view('attendancestudent.generalresult',compact('roles','result','schools','events'));

        }else{

            return redirect()->route('attendance.attendances.generalsearch')->with('error_message', 'Tidak ada di dalam senarai');
        }
    }

    public function searchlist(Request $request)
    {
        $query = $request->input('query');
    
        // Define the columns you want to search in
        $columns = ['name', 'ic_no', 'year', 'school', 'district'];
    
        // Start building the query
        $result = AttendanceList::where(function ($queryBuilder) use ($columns, $query) {
            foreach ($columns as $column) {
                $queryBuilder->orWhere($column, 'LIKE', '%' . $query . '%');
            }
        })
        ->where('category',$request->roles)
        ->where('school',$request->schools)
        ->orderBy('created_at', 'DESC');
    
        // Check if the number of results exceeds a threshold
        $threshold = 1000; // Adjust the threshold as needed
        $totalResults = $result->count();
    
        if ($totalResults > $threshold) {
            $result = $result->paginate(5000);
        } else { 
            $result = $result->paginate(500);
        }

        $roles = $request->roles;

        $schools = $request->schools;

        $events = $request->events;

        return view('attendancestudent.generalresult',compact('roles','result','schools','events'))->with('success_message', 'Student has successfully been updated!');
    }

    public function hadirupdate(Request $request){

        $now = Carbon::now();
        $icNos = Auth::user()->ic_no;

        $attendlist = AttendanceList::select('attendance_list.*')
            ->where('id', $request->id)
            ->update([
                'hadir' => 'Ya',
                'hadir_by' => $icNos,
                'hadir_at' => $now
            ]);

        $al = AttendanceList::select('attendance_list.*')
            ->where('id', $request->id)
            ->first();

        $result = AttendanceList::select('attendance_list.*')
            ->where('school',$al->school)
            ->where('event',$al->event)
            ->where('category',$al->category)
            ->get();
            
        $roles = $al->category;
        $events = $al->event;
        $schools = $al->school;

        //return redirect()->back()->with('success_message', 'Data has successfully been updated!');

        return view('attendancestudent.generalresult',compact('roles','result','events','schools'))->with('success_message', 'Student has successfully been updated!');
    }

    public function hadirrefresh(Request $request){

        $now = Carbon::now();
        $icNos = Auth::user()->ic_no;

        $attendlist = AttendanceList::select('attendance_list.*')
            ->where('id', $request->id)
            ->update([
                'hadir' => null,
                'hadir_by' => null,
                'hadir_at' => null
            ]);

        $al = AttendanceList::select('attendance_list.*')
            ->where('id', $request->id)
            ->first();

        $result = AttendanceList::select('attendance_list.*')
            ->where('school',$al->school)
            ->where('event',$al->event)
            ->where('category', $al->category)
            ->get();
            
        $roles = $al->category;
        $events = $al->event;
        $schools = $al->school;

        //return redirect()->back()->with('success_message', 'Data has successfully been updated!');

        return view('attendancestudent.generalresult',compact('roles','result','events','schools'))->with('success_message', 'Student has successfully been updated!');
    }

    public function exportToExcel($id)
    {
        $attendanceList = AttendanceList::leftJoin('attendance_event','attendance_list.event','=','attendance_event.name')
        ->select(
                'attendance_list.name',
                'attendance_list.ic_no',
                'attendance_list.birth_cert',
                'attendance_list.year',
                'attendance_list.classroom_name',
                'attendance_list.school',
                'attendance_list.district',
                'attendance_list.hadir',
                'attendance_list.hadir_by',
                'attendance_list.hadir_at',
                'attendance_list.event',
                'attendance_list.created_at',
            )
            ->where('attendance_event.id', $id)
            ->get();

        return Excel::download(new AttendanceExport($attendanceList), 'Export Excel Attendance.xlsx');
    }

    public function laporanEncrypted($encrypted)
    {
        try {
            $decrypted = Crypt::decrypt($encrypted);

            if ($decrypted === 'Public/Laporan') {
                return $this->laporan();
            } else {
                abort(404);
            }
        } catch (DecryptException $e) {
            abort(404);
        }
    }

    //LAPORAN DASHBOARD

    //public function laporan()
    //{
public function laporan($encryptedPart)
{
    $decryptedUrl = Crypt::decrypt($encryptedPart);
    // Use $decryptedUrl for further processing
        $startOfYear = Carbon::now()->copy()->startOfYear();
        $endOfYear = Carbon::now()->copy()->endOfYear();

        ///////////////////////////
        //jumlah pelajar per school
        ///////////////////////////

        $mdStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Maktab Duli Pengiran Muda Al-Muhtadee Billah')
        ->where('category','Pelajar')
        ->whereNotNull('id')
        ->count();

        $msStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Maktab Sain PSBS')
        ->where('category','Pelajar')
        ->whereNotNull('id')
        ->count();

        $soasStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Maktab Sultan Omar Ali Saifuddien')
        ->where('category','Pelajar')
        ->whereNotNull('id')
        ->count();

        $smasStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Awang Semaun')
        ->where('category','Pelajar')
        ->whereNotNull('id')
        ->count();

        $smbStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Berakas')
        ->where('category','Pelajar')
        ->whereNotNull('id')
        ->count();

        $smmasinStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Masin')
        ->where('category','Pelajar')
        ->whereNotNull('id')
        ->count();

        $smmenglaitStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Menglait')
        ->where('category','Pelajar')
        ->whereNotNull('id')
        ->count();

        $smpihmStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Pengiran Isteri Hajah Mariam, Serasa')
        ->where('category','Pelajar')
        ->whereNotNull('id')
        ->count();

        $smrimbaStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Rimba')
        ->where('category','Pelajar')
        ->whereNotNull('id')
        ->count();

        $smshusainStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Sayyidina Husain')
        ->where('category','Pelajar')
        ->whereNotNull('id')
        ->count();

        $smsuaStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Sayyidina Umar Al-Khattab')
        ->where('category','Pelajar')
        ->whereNotNull('id')
        ->count();

        $smjaStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Sultan Muhammad Jamalul Alam')
        ->where('category','Pelajar')
        ->whereNotNull('id')
        ->count();

        $smssaStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Sultan Sharif Ali')
        ->where('category','Pelajar')
        ->whereNotNull('id')
        ->count();

        $sukanStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Sukan')
        ->where('category','Pelajar')
        ->whereNotNull('id')
        ->count();

        $stpriStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Tinggi Perempuan Raja Isteri')
        ->where('category','Pelajar')
        ->whereNotNull('id')
        ->count();

        $smyayasanStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Yayasan SHHB')
        ->where('category','Pelajar')
        ->whereNotNull('id')
        ->count();

        $stgeorgeStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah St George')
        ->where('category','Pelajar')
        ->whereNotNull('id')
        ->count();

        $nlpjStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Nusa Laila Puteri, Jangsak')
        ->where('category','Pelajar')
        ->whereNotNull('id')
        ->count();

        $chunghwabsbStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Chunghwa BSB')
        ->where('category','Pelajar')
        ->whereNotNull('id')
        ->count();

        $smsarjanaStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Seri Mulia Sarjana')
        ->where('category','Pelajar')
        ->whereNotNull('id')
        ->count();

        $standrewsStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah St Andrew')
        ->where('category','Pelajar')
        ->whereNotNull('id')
        ->count();

        /////////////////////////
        //jumlah kehadiran penuntut
        /////////////////////////

        $mdStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Maktab Duli Pengiran Muda Al-Muhtadee Billah')
        ->where('category','Pelajar')
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $permdStuAtt = number_format(($mdStuAtt / $mdStu) * 100 ? : 0, 2);

        $msStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Maktab Sain PSBS')
        ->where('category','Pelajar')
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $permsStuAtt = number_format(($msStuAtt / $msStu) * 100 ? : 0, 2);

        $soasStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Maktab Sultan Omar Ali Saifuddien')
        ->where('category','Pelajar')
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persoasStuAtt = number_format(($soasStuAtt / $soasStu) * 100 ? : 0, 2);

        $smasStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Awang Semaun')
        ->where('category','Pelajar')
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmasStuAtt = number_format(($smasStuAtt / $smasStu) * 100 ? : 0, 2);

        $smbStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Berakas')
        ->where('category','Pelajar')
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmbStuAtt = number_format(($smbStuAtt / $smbStu) * 100 ? : 0, 2);

        $smmasinStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Masin')
        ->where('category','Pelajar')
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmmasinStuAtt = number_format(($smmasinStuAtt / $smmasinStu) * 100 ? : 0, 2);

        $smmenglaitStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Menglait')
        ->where('category','Pelajar')
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmmenglaitStuAtt = number_format(($smmenglaitStuAtt / $smmenglaitStu) * 100 ? : 0, 2);

        $smpihmStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Pengiran Isteri Hajah Mariam, Serasa')
        ->where('category','Pelajar')
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmpihmStuAtt = number_format(($smpihmStuAtt / $smpihmStu) * 100 ? : 0, 2);

        $smrimbaStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Rimba')
        ->where('category','Pelajar')
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmrimbaStuAtt = number_format(($smrimbaStuAtt / $smrimbaStu) * 100 ? : 0, 2);

        $smshusainStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Sayyidina Husain')
        ->where('category','Pelajar')
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmshusainStuAtt = number_format(($smshusainStuAtt/ $smshusainStu) * 100 ? : 0, 2);

        $smsuaStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Sayyidina Umar Al-Khattab')
        ->where('category','Pelajar')
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmsuaStuAtt = number_format(($smsuaStuAtt/ $smsuaStu) * 100 ? : 0, 2);

        $smjaStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Sultan Muhammad Jamalul Alam')
        ->where('category','Pelajar')
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmjaStuAtt = number_format(($smjaStuAtt/ $smjaStu) * 100 ? : 0, 2);

        $smssaStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Sultan Sharif Ali')
        ->where('category','Pelajar')
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmssaStuAtt= number_format(($smssaStuAtt/ $smssaStu) * 100 ? : 0, 2);

        $sukanStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Sukan')
        ->where('category','Pelajar')
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persukanStuAtt= number_format(($sukanStuAtt/ $sukanStu) * 100 ? : 0, 2);

        $stpriStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Tinggi Perempuan Raja Isteri')
        ->where('category','Pelajar')
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $perstpriStuAtt= number_format(($stpriStuAtt/ $stpriStu) * 100 ? : 0, 2);

        $smyayasanStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Yayasan SHHB')
        ->where('category','Pelajar')
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmyayasanStuAtt= number_format(($smyayasanStuAtt/ $smyayasanStu) * 100 ? : 0, 2);

        $stgeorgeStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah St George')
        ->where('category','Pelajar')
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $perstgeorgeStuAtt= number_format(($stgeorgeStuAtt/ $stgeorgeStu) * 100 ? : 0, 2);

        $nlpjStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Nusa Laila Puteri, Jangsak')
        ->where('category','Pelajar')
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $pernlpjStuAtt= number_format(($nlpjStuAtt/ $nlpjStu) * 100 ? : 0, 2);

        $chunghwabsbStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Chunghwa BSB')
        ->where('category','Pelajar')
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $perchunghwabsbStuAtt= number_format(($chunghwabsbStuAtt/ $chunghwabsbStu) * 100 ? : 0, 2);

        $smsarjanaStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Seri Mulia Sarjana')
        ->where('category','Pelajar')
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmsarjanaStuAtt= number_format(($smsarjanaStuAtt/ $smsarjanaStu) * 100 ? : 0, 2);

        $standrewsStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah St Andrew')
        ->where('category','Pelajar')
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $perstandrewsStuAtt = $standrewsStu != 0 ? number_format(($standrewsStuAtt / $standrewsStu) * 100, 2) : 0;


        //$perstandrewsStuAtt= number_format(($standrewsStuAtt/ $standrewsStu) * 100 ? : 0, 2);


        ////////////////////////////////////////////////////
        //jumlah guru
        ////////////////////////////////////////////////////

        $mdTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Maktab Duli Pengiran Muda Al-Muhtadee Billah')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->whereNotNull('id')
        ->count();

        $msTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Maktab Sain PSBS')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->whereNotNull('id')
        ->count();

        $soasTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Maktab Sultan Omar Ali Saifuddien')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->whereNotNull('id')
        ->count();

        $smasTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Awang Semaun')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->whereNotNull('id')
        ->count();

        $smbTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Berakas')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->whereNotNull('id')
        ->count();

        $smmasinTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Masin')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->whereNotNull('id')
        ->count();

        $smmenglaitTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Menglait')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->whereNotNull('id')
        ->count();

        $smpihmTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Pengiran Isteri Hajah Mariam, Serasa')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->whereNotNull('id')
        ->count();

        $smrimbaTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Rimba')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->whereNotNull('id')
        ->count();
        
        $smshusainTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Sayyidina Husain')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->whereNotNull('id')
        ->count();

        $smsuaTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Sayyidina Umar Al-Khattab')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->whereNotNull('id')
        ->count();

        $smjaTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Sultan Muhammad Jamalul Alam')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->whereNotNull('id')
        ->count();

        $smssaTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Sultan Sharif Ali')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->whereNotNull('id')
        ->count();
        
        $sukanTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Sukan')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->whereNotNull('id')
        ->count();
        
        $stpriTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Tinggi Perempuan Raja Isteri')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->whereNotNull('id')
        ->count();
        
        $smyayasanTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Yayasan SHHB')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->whereNotNull('id')
        ->count();

        $stgeorgeTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah St George')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->whereNotNull('id')
        ->count();

        $nlpjTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Nusa Laila Puteri, Jangsak')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->whereNotNull('id')
        ->count();

        $chunghwabsbTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Chunghwa BSB')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->whereNotNull('id')
        ->count();

        $smsarjanaTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Seri Mulia Sarjana')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->whereNotNull('id')
        ->count();

        $standrewsTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah St Andrew')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->whereNotNull('id')
        ->count();

        /////////////////////////
        //jumlah kehadiran pengawas
        /////////////////////////

        $mdTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Maktab Duli Pengiran Muda Al-Muhtadee Billah')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $permdTeaAtt= number_format(($mdTeaAtt/ $mdTea) * 100 ? : 0, 2);

        $msTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Maktab Sain PSBS')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $permsTeaAtt= number_format(($msTeaAtt/ $msTea) * 100 ? : 0, 2);

        $soasTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Maktab Sultan Omar Ali Saifuddien')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persoasTeaAtt= number_format(($soasTeaAtt/ $soasTea) * 100 ? : 0, 2);

        $smasTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Awang Semaun')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmasTeaAtt= number_format(($smasTeaAtt/ $smasTea) * 100 ? : 0, 2);

        $smbTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Berakas')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmbTeaAtt= number_format(($smbTeaAtt/ $smbTea) * 100 ? : 0, 2);

        $smmasinTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Masin')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmmasinTeaAtt= number_format(($smmasinTeaAtt/ $smmasinTea) * 100 ? : 0, 2);

        $smmenglaitTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Menglait')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmmenglaitTeaAtt= number_format(($smmenglaitTeaAtt/ $smmenglaitTea) * 100 ? : 0, 2);

        $smpihmTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Pengiran Isteri Hajah Mariam, Serasa')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmpihmTeaAtt= number_format(($smpihmTeaAtt/ $smpihmTea) * 100 ? : 0, 2);

        $smrimbaTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Rimba')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmrimbaTeaAtt= number_format(($smrimbaTeaAtt/ $smrimbaTea) * 100 ? : 0, 2);

        $smshusainTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Sayyidina Husain')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmshusainTeaAtt= number_format(($smshusainTeaAtt/ $smshusainTea) * 100 ? : 0, 2);

        $smsuaTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Sayyidina Umar Al-Khattab')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmsuaTeaAtt= number_format(($smsuaTeaAtt/ $smsuaTea) * 100 ? : 0, 2);

        $smjaTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Sultan Muhammad Jamalul Alam')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmjaTeaAtt= number_format(($smjaTeaAtt/ $smjaTea) * 100 ? : 0, 2);

        $smssaTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Sultan Sharif Ali')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmssaTeaAtt= number_format(($smssaTeaAtt/ $smssaTea) * 100 ? : 0, 2);

        $sukanTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Sukan')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persukanTeaAtt= number_format(($sukanTeaAtt/ $sukanTea) * 100 ? : 0, 2);

        $stpriTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Tinggi Perempuan Raja Isteri')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $perstpriTeaAtt= number_format(($stpriTeaAtt/ $stpriTea) * 100 ? : 0, 2);

        $smyayasanTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Yayasan SHHB')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmyayasanTeaAtt= number_format(($smyayasanTeaAtt/ $smyayasanTea) * 100 ? : 0, 2);

        //$persmyayasanTeaAtt = $smyayasanTeaAtt != 0 ? number_format(($smyayasanTeaAtt / $smyayasanTea) * 100, 2) : 0;


        $stgeorgeTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah St George')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $perstgeorgeTeaAtt= number_format(($stgeorgeTeaAtt/ $stgeorgeTea) * 100 ? : 0, 2);

        $nlpjTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Nusa Laila Puteri, Jangsak')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $pernlpjTeaAtt= number_format(($nlpjTeaAtt/ $nlpjTea) * 100 ? : 0, 2);
        
        $chunghwabsbTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Chunghwa BSB')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $perchunghwabsbTeaAtt= number_format(($chunghwabsbTeaAtt/ $chunghwabsbTea) * 100 ? : 0, 2);

        $smsarjanaTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Seri Mulia Sarjana')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmsarjanaTeaAtt= number_format(($smsarjanaTeaAtt/ $smsarjanaTea) * 100 ? : 0, 2);

        $standrewsTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah St Andrew')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $perstandrewsTeaAtt= number_format(($standrewsTeaAtt/ $standrewsTea) * 100 ? : 0, 2);

        //$perstandrewsTeaAtt = $standrewsTeaAtt != 0 ? number_format(($standrewsTeaAtt / $standrewsTea) * 100, 2) : 0;        

        $jssStu = $mdStu+$msStu+$soasStu+$smasStu+$smbStu+$smmasinStu+$smmenglaitStu+$smpihmStu+$smrimbaStu+$smshusainStu+$smsuaStu+$smjaStu+$smssaStu+$sukanStu+$stpriStu;
        $jssStuAtt = $mdStuAtt+$msStuAtt+$soasStuAtt+$smasStuAtt+$smbStuAtt+$smmasinStuAtt+$smmenglaitStuAtt+$smpihmStuAtt+$smrimbaStuAtt+$smshusainStuAtt+$smsuaStuAtt+$smjaStuAtt+$smssaStuAtt+$sukanStuAtt+$stpriStuAtt;
        $perjssStuAtt = number_format(($jssStuAtt/ $jssStu) * 100 ? : 0, 2);
        
        $jpsStu = $smyayasanStu+$stgeorgeStu+$nlpjStu+$chunghwabsbStu+$smsarjanaStu+$standrewsStu;
        $jpsStuAtt = $smyayasanStuAtt+$stgeorgeStuAtt+$nlpjStuAtt+$chunghwabsbStuAtt+$smsarjanaStuAtt+$standrewsStuAtt;
        $perjpsStuAtt = number_format(($jpsStuAtt/ $jpsStu) * 100 ? : 0, 2);

        $jssTea = $mdTea+$msTea+$soasTea+$smasTea+$smbTea+$smmasinTea+$smmenglaitTea+$smpihmTea+$smrimbaTea+$smshusainTea+$smsuaTea+$smjaTea+$smssaTea+$sukanTea+$stpriTea;
        $jssTeaAtt = $mdTeaAtt+$msTeaAtt+$soasTeaAtt+$smasTeaAtt+$smbTeaAtt+$smmasinTeaAtt+$smmenglaitTeaAtt+$smpihmTeaAtt+$smrimbaTeaAtt+$smshusainTeaAtt+$smsuaTeaAtt+$smjaTeaAtt+$smssaTeaAtt+$sukanTeaAtt+$stpriTeaAtt;
        $perjssTeaAtt = number_format(($jssTeaAtt/ $jssTea) * 100 ? : 0, 2);
        
        $jpsTea = $smyayasanTea+$stgeorgeTea+$nlpjTea+$chunghwabsbTea+$smsarjanaTea+$standrewsTea;
        $jpsTeaAtt = $smyayasanTeaAtt+$stgeorgeTeaAtt+$nlpjTeaAtt+$chunghwabsbTeaAtt+$smsarjanaTeaAtt+$standrewsTeaAtt;
        $perjpsTeaAtt = number_format(($jpsTeaAtt/ $jpsTea) * 100 ? : 0, 2);

        $totStu = $jssStu+$jpsStu;
        $totStuAtt = $jssStuAtt+$jpsStuAtt;
        $perStuAtt = number_format(($totStuAtt/ $totStu) * 100 ? : 0, 2);

        $totTea = $jssTea+$jpsTea;
        $totTeaAtt = $jssTeaAtt+$jpsTeaAtt;
        $perTeaAtt = number_format(($totTeaAtt/ $totTea) * 100 ? : 0, 2);

        $totStuAbs = $totStu - $totStuAtt;
        $totTeaAbs = $totTea - $totTeaAtt;

        return view('attendancestudent.laporan', compact(

        'mdStu','msStu','soasStu','smasStu','smbStu','smmasinStu','smmenglaitStu','smpihmStu',
        'smrimbaStu','smshusainStu','smsuaStu','smjaStu','smssaStu','sukanStu','stpriStu',
        'smyayasanStu','stgeorgeStu','nlpjStu','chunghwabsbStu','smsarjanaStu','standrewsStu',

        'mdStuAtt','msStuAtt','soasStuAtt','smasStuAtt','smbStuAtt','smmasinStuAtt','smmenglaitStuAtt','smpihmStuAtt',
        'smrimbaStuAtt','smshusainStuAtt','smsuaStuAtt','smjaStuAtt','smssaStuAtt','sukanStuAtt','stpriStuAtt',
        'smyayasanStuAtt','stgeorgeStuAtt','nlpjStuAtt','chunghwabsbStuAtt','smsarjanaStuAtt','standrewsStuAtt',

        'permdStuAtt','permsStuAtt','persoasStuAtt','persmasStuAtt','persmbStuAtt','persmmasinStuAtt','persmmenglaitStuAtt','persmpihmStuAtt',
        'persmrimbaStuAtt','persmshusainStuAtt','persmsuaStuAtt','persmjaStuAtt','persmssaStuAtt','persukanStuAtt','perstpriStuAtt',
        'persmyayasanStuAtt','perstgeorgeStuAtt','pernlpjStuAtt','perchunghwabsbStuAtt','persmsarjanaStuAtt','perstandrewsStuAtt',

        'mdTea','msTea','soasTea','smasTea','smbTea','smmasinTea','smmenglaitTea','smpihmTea',
        'smrimbaTea','smshusainTea','smsuaTea','smjaTea','smssaTea','sukanTea','stpriTea',
        'smyayasanTea','stgeorgeTea','nlpjTea','chunghwabsbTea','smsarjanaTea','standrewsTea',

        'mdTeaAtt','msTeaAtt','soasTeaAtt','smasTeaAtt','smbTeaAtt','smmasinTeaAtt','smmenglaitTeaAtt','smpihmTeaAtt',
        'smrimbaTeaAtt','smshusainTeaAtt','smsuaTeaAtt','smjaTeaAtt','smssaTeaAtt','sukanTeaAtt','stpriTeaAtt',
        'smyayasanTeaAtt','stgeorgeTeaAtt','nlpjTeaAtt','chunghwabsbTeaAtt','smsarjanaTeaAtt','standrewsTeaAtt',

        'permdTeaAtt','permsTeaAtt','persoasTeaAtt','persmasTeaAtt','persmbTeaAtt','persmmasinTeaAtt','persmmenglaitTeaAtt','persmpihmTeaAtt',
        'persmrimbaTeaAtt','persmshusainTeaAtt','persmsuaTeaAtt','persmjaTeaAtt','persmssaTeaAtt','persukanTeaAtt','perstpriTeaAtt',
        'persmyayasanTeaAtt','perstgeorgeTeaAtt','pernlpjTeaAtt','perchunghwabsbTeaAtt','persmsarjanaTeaAtt','perstandrewsTeaAtt',

        'jssStu','jssStuAtt','perjssStuAtt',
        'jpsStu','jpsStuAtt','perjpsStuAtt',
        'jssTea','jssTeaAtt','perjssTeaAtt',
        'jpsTea','jpsTeaAtt','perjpsTeaAtt',
        
        'totStu','totStuAtt','perStuAtt',
        'totTea','totTeaAtt','perTeaAtt',

        'totStuAbs','totTeaAbs'

        ));
    }

    public function laporanevent($name)
{
    //$decryptedUrl = Crypt::decrypt($encryptedPart);
    // Use $decryptedUrl for further processing
        $startOfYear = Carbon::now()->copy()->startOfYear();
        $endOfYear = Carbon::now()->copy()->endOfYear();

        $attdevent = AttendanceEvent::where('name',$name)
            ->first();

        ///////////////////////////
        //jumlah pelajar per school
        ///////////////////////////

        $mdStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Maktab Duli Pengiran Muda Al-Muhtadee Billah')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();

        $msStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Maktab Sain PSBS')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();

        $soasStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Maktab Sultan Omar Ali Saifuddien')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();

        $smasStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Awang Semaun')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();

        $smbStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Berakas')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();

        $smmasinStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Masin')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();

        $smmenglaitStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Menglait')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();

        $smpihmStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Pengiran Isteri Hajah Mariam, Serasa')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();

        $smrimbaStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Rimba')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();

        $smshusainStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Sayyidina Husain')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();

        $smsuaStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Sayyidina Umar Al-Khattab')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();

        $smjaStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Sultan Muhammad Jamalul Alam')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();

        $smssaStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Sultan Sharif Ali')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();

        $sukanStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Sukan')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();

        $stpriStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Tinggi Perempuan Raja Isteri')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();

        $smyayasanStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Yayasan SHHB')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();

        $stgeorgeStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah St George')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();

        $nlpjStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Nusa Laila Puteri, Jangsak')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();

        $chunghwabsbStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Chunghwa BSB')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();

        $smsarjanaStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Seri Mulia Sarjana')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();

        $standrewsStu = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah St Andrew')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();

        /////////////////////////
        //jumlah kehadiran penuntut
        /////////////////////////

        $mdStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Maktab Duli Pengiran Muda Al-Muhtadee Billah')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $permdStuAtt = $mdStu != 0 ? number_format(($mdStuAtt / $mdStu) * 100, 2) : 0;

        //$permdStuAtt = number_format(($mdStuAtt / $mdStu) * 100 ? : 0, 2);

        $msStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Maktab Sain PSBS')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $permsStuAtt = $msStu != 0 ? number_format(($msStuAtt / $msStu) * 100, 2) : 0;
//        $permsStuAtt = number_format(($msStuAtt / $msStu) * 100 ? : 0, 2);

        $soasStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Maktab Sultan Omar Ali Saifuddien')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persoasStuAtt = $soasStu != 0 ? number_format(($soasStuAtt / $soasStu) * 100, 2) : 0;
//        $persoasStuAtt = number_format(($soasStuAtt / $soasStu) * 100 ? : 0, 2);

        $smasStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Awang Semaun')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmasStuAtt = $smasStu != 0 ? number_format(($smasStuAtt / $smasStu) * 100, 2) : 0;
//        $persmasStuAtt = number_format(($smasStuAtt / $smasStu) * 100 ? : 0, 2);

        $smbStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Berakas')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmbStuAtt = $smbStu != 0 ? number_format(($smbStuAtt / $smbStu) * 100, 2) : 0;
//        $persmbStuAtt = number_format(($smbStuAtt / $smbStu) * 100 ? : 0, 2);

        $smmasinStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Masin')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmmasinStuAtt = $smmasinStu != 0 ? number_format(($smmasinStuAtt / $smmasinStu) * 100, 2) : 0;
        //$persmmasinStuAtt = number_format(($smmasinStuAtt / $smmasinStu) * 100 ? : 0, 2);

        $smmenglaitStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Menglait')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmmenglaitStuAtt = $smmenglaitStu != 0 ? number_format(($smmenglaitStuAtt / $smmenglaitStu) * 100, 2) : 0;
        //$persmmenglaitStuAtt = number_format(($smmenglaitStuAtt / $smmenglaitStu) * 100 ? : 0, 2);

        $smpihmStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Pengiran Isteri Hajah Mariam, Serasa')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmpihmStuAtt = $smpihmStu != 0 ? number_format(($smpihmStuAtt / $smpihmStu) * 100, 2) : 0;
        //$persmpihmStuAtt = number_format(($smpihmStuAtt / $smpihmStu) * 100 ? : 0, 2);

        $smrimbaStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Rimba')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmrimbaStuAtt = $smrimbaStu != 0 ? number_format(($smrimbaStuAtt / $smrimbaStu) * 100, 2) : 0;
        //$persmrimbaStuAtt = number_format(($smrimbaStuAtt / $smrimbaStu) * 100 ? : 0, 2);

        $smshusainStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Sayyidina Husain')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmshusainStuAtt = $smshusainStu != 0 ? number_format(($smshusainStuAtt / $smshusainStu) * 100, 2) : 0;
        //$persmshusainStuAtt = number_format(($smshusainStuAtt/ $smshusainStu) * 100 ? : 0, 2);

        $smsuaStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Sayyidina Umar Al-Khattab')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmsuaStuAtt = $smsuaStu != 0 ? number_format(($smsuaStuAtt / $smsuaStu) * 100, 2) : 0;
        //$persmsuaStuAtt = number_format(($smsuaStuAtt/ $smsuaStu) * 100 ? : 0, 2);

        $smjaStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Sultan Muhammad Jamalul Alam')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmjaStuAtt = $smjaStu != 0 ? number_format(($smjaStuAtt / $smjaStu) * 100, 2) : 0;
//        $persmjaStuAtt = number_format(($smjaStuAtt/ $smjaStu) * 100 ? : 0, 2);

        $smssaStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Sultan Sharif Ali')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmssaStuAtt = $smssaStu != 0 ? number_format(($smssaStuAtt / $smssaStu) * 100, 2) : 0;
        //$persmssaStuAtt= number_format(($smssaStuAtt/ $smssaStu) * 100 ? : 0, 2);

        $sukanStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Sukan')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persukanStuAtt = $sukanStu != 0 ? number_format(($sukanStuAtt / $sukanStu) * 100, 2) : 0;
        //$persukanStuAtt= number_format(($sukanStuAtt/ $sukanStu) * 100 ? : 0, 2);

        $stpriStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Tinggi Perempuan Raja Isteri')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $perstpriStuAtt = $stpriStu != 0 ? number_format(($stpriStuAtt / $stpriStu) * 100, 2) : 0;
        //$perstpriStuAtt= number_format(($stpriStuAtt/ $stpriStu) * 100 ? : 0, 2);

        $smyayasanStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Yayasan SHHB')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmyayasanStuAtt = $smyayasanStu != 0 ? number_format(($smyayasanStuAtt / $smyayasanStu) * 100, 2) : 0;
        //$persmyayasanStuAtt= number_format(($smyayasanStuAtt/ $smyayasanStu) * 100 ? : 0, 2);

        $stgeorgeStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah St George')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $perstgeorgeStuAtt = $stgeorgeStu != 0 ? number_format(($stgeorgeStuAtt / $stgeorgeStu) * 100, 2) : 0;
        //$perstgeorgeStuAtt= number_format(($stgeorgeStuAtt/ $stgeorgeStu) * 100 ? : 0, 2);

        $nlpjStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Nusa Laila Puteri, Jangsak')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $pernlpjStuAtt = $nlpjStu != 0 ? number_format(($nlpjStuAtt / $nlpjStu) * 100, 2) : 0;
        //$pernlpjStuAtt= number_format(($nlpjStuAtt/ $nlpjStu) * 100 ? : 0, 2);

        $chunghwabsbStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Chunghwa BSB')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $perchunghwabsbStuAtt = $chunghwabsbStu != 0 ? number_format(($chunghwabsbStuAtt / $chunghwabsbStu) * 100, 2) : 0;
        //$perchunghwabsbStuAtt= number_format(($chunghwabsbStuAtt/ $chunghwabsbStu) * 100 ? : 0, 2);

        $smsarjanaStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Seri Mulia Sarjana')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmsarjanaStuAtt = $smsarjanaStu != 0 ? number_format(($smsarjanaStuAtt / $smsarjanaStu) * 100, 2) : 0;
        //$persmsarjanaStuAtt= number_format(($smsarjanaStuAtt/ $smsarjanaStu) * 100 ? : 0, 2);

        $standrewsStuAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah St Andrew')
        ->where('category','Pelajar')
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $perstandrewsStuAtt = $standrewsStu != 0 ? number_format(($standrewsStuAtt / $standrewsStu) * 100, 2) : 0;
        //$perstandrewsStuAtt = $standrewsStu != 0 ? number_format(($standrewsStuAtt / $standrewsStu) * 100, 2) : 0;


        //$perstandrewsStuAtt= number_format(($standrewsStuAtt/ $standrewsStu) * 100 ? : 0, 2);


        ////////////////////////////////////////////////////
        //jumlah guru
        ////////////////////////////////////////////////////

        $mdTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Maktab Duli Pengiran Muda Al-Muhtadee Billah')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();

        $msTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Maktab Sain PSBS')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();

        $soasTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Maktab Sultan Omar Ali Saifuddien')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();

        $smasTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Awang Semaun')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();

        $smbTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Berakas')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();

        $smmasinTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Masin')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();

        $smmenglaitTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Menglait')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();

        $smpihmTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Pengiran Isteri Hajah Mariam, Serasa')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();

        $smrimbaTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Rimba')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();
        
        $smshusainTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Sayyidina Husain')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();

        $smsuaTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Sayyidina Umar Al-Khattab')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();

        $smjaTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Sultan Muhammad Jamalul Alam')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();

        $smssaTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Sultan Sharif Ali')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();
        
        $sukanTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Sukan')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();
        
        $stpriTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Tinggi Perempuan Raja Isteri')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();
        
        $smyayasanTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Yayasan SHHB')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();

        $stgeorgeTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah St George')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();

        $nlpjTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Nusa Laila Puteri, Jangsak')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();

        $chunghwabsbTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Chunghwa BSB')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();

        $smsarjanaTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Seri Mulia Sarjana')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();

        $standrewsTea = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah St Andrew')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->whereNotNull('id')
        ->count();

        /////////////////////////
        //jumlah kehadiran pengawas
        /////////////////////////

        $mdTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Maktab Duli Pengiran Muda Al-Muhtadee Billah')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $permdTeaAtt = $mdTea != 0 ? number_format(($mdTeaAtt / $mdTea) * 100, 2) : 0;
        //$permdTeaAtt= number_format(($mdTeaAtt/ $mdTea) * 100 ? : 0, 2);

        $msTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Maktab Sain PSBS')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $permsTeaAtt = $msTea != 0 ? number_format(($msTeaAtt / $msTea) * 100, 2) : 0;
        //$permsTeaAtt= number_format(($msTeaAtt/ $msTea) * 100 ? : 0, 2);

        $soasTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Maktab Sultan Omar Ali Saifuddien')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persoasTeaAtt = $soasTea != 0 ? number_format(($soasTeaAtt / $soasTea) * 100, 2) : 0;
        //$persoasTeaAtt= number_format(($soasTeaAtt/ $soasTea) * 100 ? : 0, 2);

        $smasTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Awang Semaun')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmasTeaAtt = $smasTea != 0 ? number_format(($smasTeaAtt / $smasTea) * 100, 2) : 0;
        //$persmasTeaAtt= number_format(($smasTeaAtt/ $smasTea) * 100 ? : 0, 2);

        $smbTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Berakas')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmbTeaAtt = $smbTea != 0 ? number_format(($smbTeaAtt / $smbTea) * 100, 2) : 0;
        //$persmbTeaAtt= number_format(($smbTeaAtt/ $smbTea) * 100 ? : 0, 2);

        $smmasinTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Masin')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmmasinTeaAtt = $smmasinTea != 0 ? number_format(($smmasinTeaAtt / $smmasinTea) * 100, 2) : 0;
        //$persmmasinTeaAtt= number_format(($smmasinTeaAtt/ $smmasinTea) * 100 ? : 0, 2);

        $smmenglaitTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Menglait')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmmenglaitTeaAtt = $smmenglaitTea != 0 ? number_format(($smmenglaitTeaAtt / $smmenglaitTea) * 100, 2) : 0;
        //$persmmenglaitTeaAtt= number_format(($smmenglaitTeaAtt/ $smmenglaitTea) * 100 ? : 0, 2);

        $smpihmTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Pengiran Isteri Hajah Mariam, Serasa')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmpihmTeaAtt = $smpihmTea != 0 ? number_format(($smpihmTeaAtt / $smpihmTea) * 100, 2) : 0;
        //$persmpihmTeaAtt= number_format(($smpihmTeaAtt/ $smpihmTea) * 100 ? : 0, 2);

        $smrimbaTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Rimba')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmrimbaTeaAtt = $smrimbaTea != 0 ? number_format(($smrimbaTeaAtt / $smrimbaTea) * 100, 2) : 0;
        //$persmrimbaTeaAtt= number_format(($smrimbaTeaAtt/ $smrimbaTea) * 100 ? : 0, 2);

        $smshusainTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Sayyidina Husain')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmshusainTeaAtt = $smshusainTea != 0 ? number_format(($smshusainTeaAtt / $smshusainTea) * 100, 2) : 0;
        //$persmshusainTeaAtt= number_format(($smshusainTeaAtt/ $smshusainTea) * 100 ? : 0, 2);

        $smsuaTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Sayyidina Umar Al-Khattab')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmsuaTeaAtt = $smsuaTea != 0 ? number_format(($smsuaTeaAtt / $smsuaTea) * 100, 2) : 0;
        //$persmsuaTeaAtt= number_format(($smsuaTeaAtt/ $smsuaTea) * 100 ? : 0, 2);

        $smjaTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Sultan Muhammad Jamalul Alam')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmjaTeaAtt = $smjaTea != 0 ? number_format(($smjaTeaAtt / $smjaTea) * 100, 2) : 0;
        //$persmjaTeaAtt= number_format(($smjaTeaAtt/ $smjaTea) * 100 ? : 0, 2);

        $smssaTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Sultan Sharif Ali')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmssaTeaAtt = $smssaTea != 0 ? number_format(($smssaTeaAtt / $smssaTea) * 100, 2) : 0;
        //$persmssaTeaAtt= number_format(($smssaTeaAtt/ $smssaTea) * 100 ? : 0, 2);

        $sukanTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Sukan')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persukanTeaAtt = $sukanTea != 0 ? number_format(($sukanTeaAtt / $sukanTea) * 100, 2) : 0;
        //$persukanTeaAtt= number_format(($sukanTeaAtt/ $sukanTea) * 100 ? : 0, 2);

        $stpriTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Tinggi Perempuan Raja Isteri')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $perstpriTeaAtt = $stpriTea != 0 ? number_format(($stpriTeaAtt / $stpriTea) * 100, 2) : 0;
        //$perstpriTeaAtt= number_format(($stpriTeaAtt/ $stpriTea) * 100 ? : 0, 2);

        $smyayasanTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Yayasan SHHB')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmyayasanTeaAtt = $smyayasanTea != 0 ? number_format(($smyayasanTeaAtt / $smyayasanTea) * 100, 2) : 0;
        //$persmyayasanTeaAtt= number_format(($smyayasanTeaAtt/ $smyayasanTea) * 100 ? : 0, 2);

        $stgeorgeTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah St George')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $perstgeorgeTeaAtt = $stgeorgeTea != 0 ? number_format(($stgeorgeTeaAtt / $stgeorgeTea) * 100, 2) : 0;
        //$perstgeorgeTeaAtt= number_format(($stgeorgeTeaAtt/ $stgeorgeTea) * 100 ? : 0, 2);

        $nlpjTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Nusa Laila Puteri, Jangsak')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $pernlpjTeaAtt = $nlpjTea != 0 ? number_format(($nlpjTeaAtt / $nlpjTea) * 100, 2) : 0;
        //$pernlpjTeaAtt= number_format(($nlpjTeaAtt/ $nlpjTea) * 100 ? : 0, 2);
        
        $chunghwabsbTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Menengah Chunghwa BSB')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $perchunghwabsbTeaAtt = $chunghwabsbTea != 0 ? number_format(($chunghwabsbTeaAtt / $chunghwabsbTea) * 100, 2) : 0;
        //$perchunghwabsbTeaAtt= number_format(($chunghwabsbTeaAtt/ $chunghwabsbTea) * 100 ? : 0, 2);

        $smsarjanaTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah Seri Mulia Sarjana')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $persmsarjanaTeaAtt = $smsarjanaTea != 0 ? number_format(($smsarjanaTeaAtt / $smsarjanaTea) * 100, 2) : 0;
        //$persmsarjanaTeaAtt= number_format(($smsarjanaTeaAtt/ $smsarjanaTea) * 100 ? : 0, 2);

        $standrewsTeaAtt = AttendanceList::selectRaw('count(id)')
        ->whereBetween('updated_at',[$startOfYear,$endOfYear])
        ->where('school','Sekolah St Andrew')
        ->where('category',['Guru Pengawas','Guru Fokal'])
        ->where('event',$attdevent->name)
        ->where('Hadir','Ya')
        ->whereNotNull('id')
        ->count();

        $perstandrewsTeaAtt = $standrewsTea != 0 ? number_format(($standrewsTeaAtt / $standrewsTea) * 100, 2) : 0;
        //$perstandrewsTeaAtt= number_format(($standrewsTeaAtt/ $standrewsTea) * 100 ? : 0, 2);


        $jssStu = $mdStu+$msStu+$soasStu+$smasStu+$smbStu+$smmasinStu+$smmenglaitStu+$smpihmStu+$smrimbaStu+$smshusainStu+$smsuaStu+$smjaStu+$smssaStu+$sukanStu+$stpriStu;
        $jssStuAtt = $mdStuAtt+$msStuAtt+$soasStuAtt+$smasStuAtt+$smbStuAtt+$smmasinStuAtt+$smmenglaitStuAtt+$smpihmStuAtt+$smrimbaStuAtt+$smshusainStuAtt+$smsuaStuAtt+$smjaStuAtt+$smssaStuAtt+$sukanStuAtt+$stpriStuAtt;
        
        $perjssStuAtt = $jssStu != 0 ? number_format(($jssStuAtt / $jssStu) * 100, 2) : 0;
        //$perjssStuAtt = number_format(($jssStuAtt/ $jssStu) * 100 ? : 0, 2);
        
        $jpsStu = $smyayasanStu+$stgeorgeStu+$nlpjStu+$chunghwabsbStu+$smsarjanaStu+$standrewsStu;
        $jpsStuAtt = $smyayasanStuAtt+$stgeorgeStuAtt+$nlpjStuAtt+$chunghwabsbStuAtt+$smsarjanaStuAtt+$standrewsStuAtt;

        $perjpsStuAtt = $jpsStu != 0 ? number_format(($jpsStuAtt / $jpsStu) * 100, 2) : 0;
        //$perjpsStuAtt = number_format(($jpsStuAtt/ $jpsStu) * 100 ? : 0, 2);

        $jssTea = $mdTea+$msTea+$soasTea+$smasTea+$smbTea+$smmasinTea+$smmenglaitTea+$smpihmTea+$smrimbaTea+$smshusainTea+$smsuaTea+$smjaTea+$smssaTea+$sukanTea+$stpriTea;
        $jssTeaAtt = $mdTeaAtt+$msTeaAtt+$soasTeaAtt+$smasTeaAtt+$smbTeaAtt+$smmasinTeaAtt+$smmenglaitTeaAtt+$smpihmTeaAtt+$smrimbaTeaAtt+$smshusainTeaAtt+$smsuaTeaAtt+$smjaTeaAtt+$smssaTeaAtt+$sukanTeaAtt+$stpriTeaAtt;

        $perjssTeaAtt = $jssTea != 0 ? number_format(($jssTeaAtt / $jssTea) * 100, 2) : 0;
        //$perjssTeaAtt = number_format(($jssTeaAtt/ $jssTea) * 100 ? : 0, 2);
        
        $jpsTea = $smyayasanTea+$stgeorgeTea+$nlpjTea+$chunghwabsbTea+$smsarjanaTea+$standrewsTea;
        $jpsTeaAtt = $smyayasanTeaAtt+$stgeorgeTeaAtt+$nlpjTeaAtt+$chunghwabsbTeaAtt+$smsarjanaTeaAtt+$standrewsTeaAtt;

        $perjpsTeaAtt = $jpsTea != 0 ? number_format(($jpsTeaAtt / $jpsTea) * 100, 2) : 0;
        //$perjpsTeaAtt = number_format(($jpsTeaAtt/ $jpsTea) * 100 ? : 0, 2);

        $totStu = $jssStu+$jpsStu;
        $totStuAtt = $jssStuAtt+$jpsStuAtt;

        $perStuAtt = $totStu != 0 ? number_format(($totStuAtt / $totStu) * 100, 2) : 0;
        //$perStuAtt = number_format(($totStuAtt/ $totStu) * 100 ? : 0, 2);

        $totTea = $jssTea+$jpsTea;
        $totTeaAtt = $jssTeaAtt+$jpsTeaAtt;

        $perTeaAtt = $totTea != 0 ? number_format(($totTeaAtt / $totTea) * 100, 2) : 0;
        //$perTeaAtt = number_format(($totTeaAtt/ $totTea) * 100 ? : 0, 2);

        $totStuAbs = $totStu - $totStuAtt;
        $totTeaAbs = $totTea - $totTeaAtt;

        return view('attendancestudent.laporanevent', compact(

        'mdStu','msStu','soasStu','smasStu','smbStu','smmasinStu','smmenglaitStu','smpihmStu',
        'smrimbaStu','smshusainStu','smsuaStu','smjaStu','smssaStu','sukanStu','stpriStu',
        'smyayasanStu','stgeorgeStu','nlpjStu','chunghwabsbStu','smsarjanaStu','standrewsStu',

        'mdStuAtt','msStuAtt','soasStuAtt','smasStuAtt','smbStuAtt','smmasinStuAtt','smmenglaitStuAtt','smpihmStuAtt',
        'smrimbaStuAtt','smshusainStuAtt','smsuaStuAtt','smjaStuAtt','smssaStuAtt','sukanStuAtt','stpriStuAtt',
        'smyayasanStuAtt','stgeorgeStuAtt','nlpjStuAtt','chunghwabsbStuAtt','smsarjanaStuAtt','standrewsStuAtt',

        'permdStuAtt','permsStuAtt','persoasStuAtt','persmasStuAtt','persmbStuAtt','persmmasinStuAtt','persmmenglaitStuAtt','persmpihmStuAtt',
        'persmrimbaStuAtt','persmshusainStuAtt','persmsuaStuAtt','persmjaStuAtt','persmssaStuAtt','persukanStuAtt','perstpriStuAtt',
        'persmyayasanStuAtt','perstgeorgeStuAtt','pernlpjStuAtt','perchunghwabsbStuAtt','persmsarjanaStuAtt','perstandrewsStuAtt',

        'mdTea','msTea','soasTea','smasTea','smbTea','smmasinTea','smmenglaitTea','smpihmTea',
        'smrimbaTea','smshusainTea','smsuaTea','smjaTea','smssaTea','sukanTea','stpriTea',
        'smyayasanTea','stgeorgeTea','nlpjTea','chunghwabsbTea','smsarjanaTea','standrewsTea',

        'mdTeaAtt','msTeaAtt','soasTeaAtt','smasTeaAtt','smbTeaAtt','smmasinTeaAtt','smmenglaitTeaAtt','smpihmTeaAtt',
        'smrimbaTeaAtt','smshusainTeaAtt','smsuaTeaAtt','smjaTeaAtt','smssaTeaAtt','sukanTeaAtt','stpriTeaAtt',
        'smyayasanTeaAtt','stgeorgeTeaAtt','nlpjTeaAtt','chunghwabsbTeaAtt','smsarjanaTeaAtt','standrewsTeaAtt',

        'permdTeaAtt','permsTeaAtt','persoasTeaAtt','persmasTeaAtt','persmbTeaAtt','persmmasinTeaAtt','persmmenglaitTeaAtt','persmpihmTeaAtt',
        'persmrimbaTeaAtt','persmshusainTeaAtt','persmsuaTeaAtt','persmjaTeaAtt','persmssaTeaAtt','persukanTeaAtt','perstpriTeaAtt',
        'persmyayasanTeaAtt','perstgeorgeTeaAtt','pernlpjTeaAtt','perchunghwabsbTeaAtt','persmsarjanaTeaAtt','perstandrewsTeaAtt',

        'jssStu','jssStuAtt','perjssStuAtt',
        'jpsStu','jpsStuAtt','perjpsStuAtt',
        'jssTea','jssTeaAtt','perjssTeaAtt',
        'jpsTea','jpsTeaAtt','perjpsTeaAtt',
        
        'totStu','totStuAtt','perStuAtt',
        'totTea','totTeaAtt','perTeaAtt',

        'totStuAbs','totTeaAbs',

        'attdevent'

        ));
    }

    public function dynamiclaporanevent($name)
    {
        // Get the event name from the request, default to 'Event Malaysia'
        // $eventName = $request->input('event_name', 'Event Malaysia');
        $attdevent = AttendanceEvent::where('name',$name)
                    ->first();

        $totalRecSt = AttendanceList::where('event', $attdevent->name)
            ->where('category','Pelajar')
            ->get();

        $totalRecStH = AttendanceList::where('event', $attdevent->name)
            ->where('category','Pelajar')
            ->where('hadir','Ya')
            ->count();

        $totalRecStTH = AttendanceList::where('event', $attdevent->name)
            ->where('category','Pelajar')
            ->where(function($query) {
                $query->where('hadir', '')
                      ->orWhereNull('hadir');
            })
            ->count();
        
        $totalRecTe = AttendanceList::where('event', $attdevent->name)
            ->whereIn('category',['Guru Pengawas','Guru Fokal'])
            ->get();

        $totalRecTeH = AttendanceList::where('event', $attdevent->name)
            ->whereIn('category',['Guru Pengawas','Guru Fokal'])
            ->where('hadir','Ya')
            ->count();

        $totalRecTeTH = AttendanceList::where('event', $attdevent->name)
            ->whereIn('category',['Guru Pengawas','Guru Fokal'])
            ->where(function($query) {
                $query->where('hadir', '')
                      ->orWhereNull('hadir');
            })
            ->count();

        $totalRecPk = AttendanceList::where('event', $attdevent->name)
            ->whereIn('category',['Persembahan Khas','Hadrah','Choir'])
            ->get();

        $totalRecPkH = AttendanceList::where('event', $attdevent->name)
            ->whereIn('category',['Persembahan Khas','Hadrah','Choir'])
            ->where('hadir','Ya')
            ->count();

        $totalRecPkTH = AttendanceList::where('event', $attdevent->name)
            ->whereIn('category',['Persembahan Khas','Hadrah','Choir'])
            ->where(function($query) {
                $query->where('hadir', '')
                      ->orWhereNull('hadir');
            })
            ->count();  
        // Fetch records based on the event name
        $records = AttendanceList::where('event', $attdevent->name)->get();
    
        // Group records by school
        $groupedSchools = $records->groupBy('school');
    
        // Count total records
        $totalRecords = $records->count();

        $JSSTotal = AttendanceList::where('event', $attdevent->name)
            ->where('school_category','JSS')
            ->groupBy('school')
            ->get(); 

        $JPSTotal = AttendanceList::where('event', $attdevent->name)
            ->where('school_category','JPS')
            ->groupBy('school')
            ->get(); 

        $JPKKTotal = AttendanceList::where('event', $attdevent->name)
            ->where('school_category','JPKK')
            ->groupBy('school')
            ->get(); 

    
        // Pass the grouped records and total count to the view
        return view('attendancestudent.dynamiclaporanevent', compact('records','JPKKTotal','JPSTotal','JSSTotal','totalRecTeTH','totalRecTeH', 'totalRecPkH','totalRecPkTH','totalRecPk','totalRecStH','totalRecStTH','totalRecSt','totalRecTe','groupedSchools', 'totalRecords', 'attdevent'));
    }
}
