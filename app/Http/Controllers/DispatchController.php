<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use App\Models\VaccinationDose;

use App\Models\Dispatch;
use Illuminate\Http\Request;
use App\Models\Dispatchfile;
use App\Models\Mecuser;

use App\Models\DispatchPassMec;
use App\Models\Untukperhatian;
use App\Models\Kakitanganlist;
use App\Models\Tindakanlist;
use App\Models\Employment;


use App\Models\Kepada;
use App\Models\Jenis;
use App\Models\Action;
use App\Models\Daripada;
use App\Models\Correspondence;

use App\Mail\DispatchEmail;
use App\Mail\CorrespondenceEmail;

use Log;
use Carbon\Carbon;

class DispatchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

           $ic = Auth::user()->ic_no;

           $dispatchs= Dispatch::select('dispatch_infos.*')->where('ic_no', $ic )->orderBy('created_at', 'DESC')->get();





        return view('dispatchs.index', compact('dispatchs'));
    }

     public function indexup( Request $request)
    {
        
        
         if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_DESPATCH')){

        $icNos = Auth::user()->ic_no;

        $employments = Employment::leftJoin('departments', 'emp_employment_infos.department_id', '=', 'departments.id')
        ->select('emp_employment_infos.*', 'departments.label')
        ->where('ic_no', '=', $icNos)->first();

        $employments->label;

        // $dispatchs = Dispatch::select('dispatch_infos.*')
        // ->orderBy('created_at', 'DESC')
        // ->get();

        // $kpd->dispatchs->implode('kpd', ', ');

        $dispatchs = Dispatch::leftJoin('biodatas', 'dispatch_infos.ic_no', '=', 'biodatas.ic_no')
        ->select('dispatch_infos.*', 'biodatas.name')
        ->orderBy('created_at', 'DESC')
        ->where('kpd','like', '%'.$employments->label.'%' )
        ->get();
        
        return view('dispatchs.indexup', compact('dispatchs','employments'));}
    }

    public function indexadmin()
    {

        if (Auth::user()->hasRole('ROLE_SUPERADMIN')){

            $dispatchs = Dispatch::select('dispatch_infos.*')
            ->whereNotNull('kpd')
            ->whereNull('tindakan')
            ->orderBy('created_at', 'DESC')
            ->get();

             $icNos = Auth::user()->ic_no;

    
             $employments = Employment::all()
                            ->where('ic_no', '=', $icNos);


        return view('dispatchs.indexadmin', compact('dispatchs','employments'));
       }


       
       if (Auth::user()->hasRole('ROLE_DESPATCH')){

        $icNos = Auth::user()->ic_no;


        $employments = Employment::leftJoin('departments', 'emp_employment_infos.department_id', '=', 'departments.id')
        ->select('emp_employment_infos.*', 'departments.label')
        ->where('ic_no', '=', $icNos)->first();

        $employments->label;


       $dispatchs = Dispatch::leftJoin('biodatas', 'dispatch_infos.ic_no', '=', 'biodatas.ic_no')
        ->select('dispatch_infos.*', 'biodatas.name')
        ->orderBy('created_at', 'DESC')
        ->where('kpd','like', '%'.$employments->label.'%' )
        ->WhereNull('sender')
        ->whereNull('tindakan') //to draw out the mec records from displaying as of mec will filled in the tindakan
        ->WhereNull('up')
        ->get();

        
        $employments = Employment::all()
        ->where('ic_no', '=', $icNos);


    return view('dispatchs.indexadmin', compact('dispatchs','employments'));
   }

        return view('dispatchs.indexadmin', compact('dispatchs'));
    }


       public function indextindakan(Request $request)
    {
        $icNos = Auth::user()->ic_no;

        // For IN index
        $dispatchpassmecs = DispatchPassMec::leftJoin('dispatch_infos', 'dispatch_pass_mecs.dispatch_infos_id', '=', 'dispatch_infos.id')
        ->select('dispatch_pass_mecs.*', 'dispatch_infos.perkara','dispatch_infos.date_admin_submit')
         ->whereJsonContains('tindakan_pass', $icNos)
        ->orderBy('created_at', 'DESC')
        ->get();

     // For OUT index
        $dispatchpassmecsenders = Dispatch::select('dispatch_infos.*')
        ->where('ic_no', $icNos)
        ->whereNotNull('tindakan')
        ->whereNull('admin_id')
        ->whereNull('admin_dept') 
        ->orderBy('created_at', 'DESC')
        ->get();

    

        $kakitanganlist = Kakitanganlist::pluck('label', 'label')->all();

        $tindakanlist = Tindakanlist::pluck('label', 'label')->all();



        return view('dispatchs.indextindakan', compact(  'dispatchpassmecs', 'dispatchpassmecsenders','kakitanganlist','tindakanlist'));
    }

     public function indexcorrespondence(Request $request)
    {
        if (Auth::user()->hasRole('ROLE_SUPERADMIN')){

            $dispatchs = Dispatch::select('dispatch_infos.*')
            ->whereNull('admin_id')
            ->whereNull('admin_dept')
            ->whereNotNull('tindakan')
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('dispatchs.indexcorrespondence', compact('dispatchs'));
       }


       
       if (Auth::user()->hasRole('ROLE_DESPATCH')){

        $icNos = Auth::user()->ic_no;


        $employments = Employment::leftJoin('departments', 'emp_employment_infos.department_id', '=', 'departments.id')
        ->select('emp_employment_infos.*', 'departments.label')
        ->where('ic_no', '=', $icNos)->first();

        $employments->label;

       $dispatchs = Dispatch::leftJoin('biodatas', 'dispatch_infos.ic_no', '=', 'biodatas.ic_no')
        ->select('dispatch_infos.*', 'biodatas.name')
        ->orderBy('created_at', 'DESC')
        ->where('kpd','like', '%'.$employments->label.'%' )
        ->whereNull('admin_id')
        ->whereNull('admin_dept')
        ->whereNotNull('tindakan')
        ->WhereNull('sender')
        ->WhereNull('up')
        ->get();


    return view('dispatchs.indexcorrespondence', compact('dispatchs','employments'));
   }

        return view('dispatchs.indexcorrespondence', compact('dispatchs'));
    
        
    }


    public function terima($id)
    {
        $dispatchs = Dispatch::findOrFail($id);
        $dispatchs->update(['dispatch_recieved_at' => now()]);

        return redirect()->route('dispatchs.dis.indexadmin')
            ->with('success_message', 'Dispatch Recieved successfully');
    }

        public function terimaup($id)
    {
        $dispatchs = Dispatch::findOrFail($id);
        $dispatchs->update(['dispatch_recieved_at' => now()]);

        return redirect()->route('dispatchs.dis.indexup')
            ->with('success_message', 'Dispatch Recieved successfully');
    }

    // 15/06/2023 Upload

    public function terimamemo($id)
{
    // Get the selected value from the query parameters
    $selectedValue = request()->query('selected_value');

    // Fetch the dispatch_info record for the specified ID
    $dispatchInfo = DB::table('dispatch_infos')->where('id', $id)->first();

    // Get the kpd array from the fetched record
    $kpdArray = json_decode($dispatchInfo->salinankpd);
    $statusmemoArray = json_decode($dispatchInfo->statusmemo);

    // If the statusmemo array is null, initialize it as an empty array
    if (is_null($statusmemoArray)) {
        $statusmemoArray = [];
    }

    // Check if the selected value is not already present in the statusmemo array
    if (!in_array($selectedValue, $statusmemoArray)) {
        // Add the selected value to the statusmemo array
        $statusmemoArray[] = $selectedValue;

        // Update the statusmemo for the specified ID
        $result = DB::table('dispatch_infos')->where('id', $id)->update(['statusmemo' => json_encode($statusmemoArray)]);
    } else {
        // The selected value is already present in the statusmemo array, no update needed
        $result = true;
    }

    if ($result) {
        // Update successful
        return redirect()->route('dispatchs.dis.indexadmin')
            ->with('success_message', 'Statusmemo updated successfully');
    } else {
        // Update failed
        return redirect()->route('dispatchs.dis.indexadmin')
            ->with('error_message', 'Failed to update statusmemo');
    }
}


public function terimamemo1($id)
{
    // Get the selected value from the query parameters
    $selectedValue = request()->query('selected_value');

    // Fetch the dispatch_info record for the specified ID
    $dispatchInfo = DB::table('dispatch_infos')->where('id', $id)->first();

    // Get the kpd array from the fetched record
    $kpdArray = json_decode($dispatchInfo->kpd);
    $statusmemoArray1 = json_decode($dispatchInfo->statusmemo1);
    $dispatchReceivedArray = json_decode($dispatchInfo->dispatch_recieved_at);

    // If the statusmemo array is null, initialize it as an empty array
    if (is_null($statusmemoArray1)) {
        $statusmemoArray1 = [];
    }

    // If the dispatch_received_array is null, initialize it with null values
    if (is_null($dispatchReceivedArray)) {
        $dispatchReceivedArray = array_fill(0, count($kpdArray), null);
    }

    // Check if the selected value is not already present in the statusmemo array
    if (!in_array($selectedValue, $statusmemoArray1)) {
        // Add the selected value to the statusmemo array
        $statusmemoArray1[] = $selectedValue;

        // Get the current statusmemo count
        $statusmemoCount = count($statusmemoArray1);

        // Update the dispatch_received_array based on the statusmemo count
        for ($i = 0; $i < count($dispatchReceivedArray); $i++) {
            if ($i < $statusmemoCount && is_null($dispatchReceivedArray[$i])) {
                $dispatchReceivedArray[$i] = Carbon::now();
            }
        }

        // Save the updated dispatch_recieved_at and statusmemo1 arrays
        $result = DB::table('dispatch_infos')->where('id', $id)->update([
            'statusmemo1' => json_encode($statusmemoArray1),
            'dispatch_recieved_at' => json_encode($dispatchReceivedArray)
        ]);
    } else {
        // The selected value is already present in the statusmemo array, no update needed
        $result = true;
    }

    if ($result) {
        // Update successful
        return redirect()->route('dispatchs.dis.indexadmin')
            ->with('success_message', 'Statusmemo updated successfully');
    } else {
        // Update failed
        return redirect()->route('dispatchs.dis.indexadmin')
            ->with('error_message', 'Failed to update statusmemo');
    }
}







    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $icNos = Auth::user()->ic_no;

   
        $employments = Employment::all()
                        ->where('ic_no', '=', $icNos);


        $kepada = Kepada::pluck('label', 'label')->all();

        $Skepada = Kepada::pluck('label', 'label')->all();

        $jenis = Jenis::pluck('label', 'id')->all();

        $daripada = Daripada::pluck('label', 'id')->all();

          $untukperhatians = untukperhatian::pluck('kod', 'id')->all();

        return view('dispatchs.create', compact('employments','kepada', 'jenis', 'daripada','untukperhatians','Skepada'));
    }

 public function createmec()
    {
        $icNos = Auth::user()->ic_no;

   
	    $employments = Employment::all()
						->where('ic_no', '=', $icNos);

        $kepada = Kepada::pluck('label', 'label')->all();

        $jenis = Jenis::pluck('label', 'id')->all();

        $daripada = Daripada::pluck('label', 'id')->all();

        $tindakan = Mecuser::pluck('kod', 'ic_no')->all();


        return view('dispatchs.createmec', compact('employments','kepada', 'jenis', 'daripada', 'tindakan'));
    }





    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


          // Validate the request data
    $validatedData = $request->validate([
      
        'kpd' => 'required' // Make 'kpd' field required
        
    ]);
        $icNos = Auth::user()->ic_no;
        $Dispatch = new Dispatch;
        
        $Dispatch->ic_no = $icNos;
        $Dispatch->jns = $request->jns;
        $Dispatch->daripada = $request->daripada;
        
        $Dispatch->kpd = json_encode($validatedData['kpd']);
        $Dispatch->up = $request->up;
        $Dispatch->perkara = $request->perkara;
        $Dispatch->rp = $request->rp;
        $Dispatch->rm = $request->rm;
        $Dispatch->dpl = $request->dpl;
        $Dispatch->spl = $request->spl;

        $Dispatch->salinankpd = ($request->salinankpd !== null) ? json_encode($request->salinankpd) : null;


      // Handle uploaded images
        if ($request->hasFile('lamp')) {
            $files = $request->file('lamp');
            $mecmedFileNames = $Dispatch->lamp ?? []; // Retrieve existing image filenames or initialize an empty array
            $mecmedFilePaths = $Dispatch->dis_filename ?? []; // Retrieve existing image file paths or initialize an empty array

            foreach ($files as $file) {
                // Check the file size
                $fileSize = $file->getSize();
                $maxFileSize = 7 * 1024 * 1024; // 7MB in bytes

                if ($fileSize > $maxFileSize) {
                    return redirect()->back()->withErrors(['file_size' => 'Please use an image size up to 7MB.']);
                }

                // Validate the file
                $validatedData = $request->validate([
                    'lamp.*' => 'file|mimes:pdf,jpg,jpeg,png|max:7168',
                ]);

                // Retrieve the original filename
                $originalFilename = $file->getClientOriginalName();
            
                // Store the file in the desired disk and directory
                $path = $file->storeAs('public/Dispatch', $originalFilename);

                // Store the file name and path in the respective arrays
                $mecmedFileNames[] = $originalFilename;
                $mecmedFilePaths[] = $path;
            }

            // Save the updated file names and paths in the Postup model
            $Dispatch->setAttribute('dis_filename', array_values($mecmedFileNames));
            $Dispatch->setAttribute('lamp', array_values($mecmedFilePaths));
        }

        // Handle salinan File Upload
        if ($request->hasFile('lamp1')) {
            $lampfiles = $request->file('lamp1');
            $mecmedlampFileNames = $Dispatch->lamp1 ?? []; // Retrieve existing image filenames or initialize an empty array
            $mecmedlampFilePaths = $Dispatch->dis_filename1 ?? []; // Retrieve existing image file paths or initialize an empty array

            foreach ($lampfiles as $lampfile) {
                // Check the file size
                $lampfileSize = $lampfile->getSize();
                $maxFileSize = 7 * 1024 * 1024; // 7MB in bytes

                if ($lampfileSize > $maxFileSize) {
                    return redirect()->back()->withErrors(['file_size' => 'Please use an image size up to 7MB.']);
                }

                // Validate the file
                $validatedData = $request->validate([
                    'lamp1.*' => 'file|mimes:pdf,jpg,jpeg,png|max:7168',
                ]);

                // Retrieve the original filename for lamp1
                $lamporiginalFilename = $lampfile->getClientOriginalName();
            
                // Store the file in the desired disk and directory
                $path = $lampfile->storeAs('public/Dispatch', $lamporiginalFilename);

                // Store the file name and path in the respective arrays for lamp1
                $mecmedlampFileNames[] = $lamporiginalFilename;
                $mecmedlampFilePaths[] = $path;
            }

            // Save the updated file names and paths in the Postup model for lamp1
            $Dispatch->setAttribute('dis_filename1', array_values($mecmedlampFileNames));
            $Dispatch->setAttribute('lamp1', array_values($mecmedlampFilePaths));
        }

        $Dispatch->catt = $request->catt;

        // Save 'Dispatch' data
        $Dispatch->save();

        return redirect()->route('dispatchs.dis.index')
            ->with('success_message', 'New dispatch record was successfully added!');
    }

    public function store2(Request $request)
    {

        foreach ($request->moreFields as $key => $value) {
            Mecuser::create($value);
        }

        return redirect()->route('dispatchs.dis.mecuser')
            ->with('success_message', 'New Data record was successfully added!');
    }

        public function storeuntukperhatian(Request $request)
    {

        foreach ($request->moreFields as $key => $value) {
            Untukperhatian::create($value);
        }

        return redirect()->route('dispatchs.dis.untukperhatian')
            ->with('success_message', 'New Data record was successfully added!');
    }

   public function storemec(Request $request)
    {
        $icNos = Auth::user()->ic_no;
        $now = Carbon::now();

    $validatedData = $request->validate([
      
        'kpd' => 'required', // Make 'kpd' field required
        'no_folio' => 'required' // Make 'kpd' field required

        
    ]);

        $Dispatch = new Dispatch;

        $Dispatch->ic_no = $icNos;
        $Dispatch->jns = $request->jns;
        $Dispatch->daripada = $request->daripada;
        $Dispatch->kpd = json_encode($validatedData['kpd']);
        $Dispatch->up = $request->up;
        $Dispatch->perkara = $request->perkara;
        $Dispatch->rp = $request->no_folio; //initially rp, based on request by tn AO & tn Hj Akbar off this fields and make it populate from no_folio
        $Dispatch->rm = $request->rm;
        $Dispatch->salinankpd = ($request->salinankpd !== null) ? json_encode($request->salinankpd) : null;
        $Dispatch->dpl = $request->dpl;
        $Dispatch->spl = $request->spl;
        $Dispatch->catt = $request->catt;

         // Handle uploaded images
         if ($request->hasFile('lamp')) {
            $files = $request->file('lamp');
            $mecmedFileNames = $Dispatch->lamp ?? []; // Retrieve existing image filenames or initialize an empty array
            $mecmedFilePaths = $Dispatch->dis_filename ?? []; // Retrieve existing image file paths or initialize an empty array

            foreach ($files as $file) {
                // Check the file size
                $fileSize = $file->getSize();
                $maxFileSize = 7 * 1024 * 1024; // 7MB in bytes

                if ($fileSize > $maxFileSize) {
                    return redirect()->back()->withErrors(['file_size' => 'Please use an image size up to 7MB.']);
                }

                // Validate the file
                $validatedData = $request->validate([
                    'lamp.*' => 'file|mimes:pdf,jpg,jpeg,png|max:7168',
                ]);

                // Retrieve the original filename
                $originalFilename = $file->getClientOriginalName();
            
                // Store the file in the desired disk and directory
                $path = $file->storeAs('public/Dispatch', $originalFilename);

                // Store the file name and path in the respective arrays
                $mecmedFileNames[] = $originalFilename;
                $mecmedFilePaths[] = $path;
            }

            // Save the updated file names and paths in the Postup model
            $Dispatch->setAttribute('dis_filename', array_values($mecmedFileNames));
            $Dispatch->setAttribute('lamp', array_values($mecmedFilePaths));
        }

        // Handle salinan File Upload
        if ($request->hasFile('lamp1')) {
            $lampfiles = $request->file('lamp1');
            $mecmedlampFileNames = $Dispatch->lamp1 ?? []; // Retrieve existing image filenames or initialize an empty array
            $mecmedlampFilePaths = $Dispatch->dis_filename1 ?? []; // Retrieve existing image file paths or initialize an empty array

            foreach ($lampfiles as $lampfile) {
                // Check the file size
                $lampfileSize = $lampfile->getSize();
                $maxFileSize = 7 * 1024 * 1024; // 7MB in bytes

                if ($lampfileSize > $maxFileSize) {
                    return redirect()->back()->withErrors(['file_size' => 'Please use an image size up to 7MB.']);
                }

                // Validate the file
                $validatedData = $request->validate([
                    'lamp1.*' => 'file|mimes:pdf,jpg,jpeg,png|max:7168',
                ]);

                // Retrieve the original filename for lamp1
                $lamporiginalFilename = $lampfile->getClientOriginalName();
            
                // Store the file in the desired disk and directory
                $path = $lampfile->storeAs('public/Dispatch', $lamporiginalFilename);

                // Store the file name and path in the respective arrays for lamp1
                $mecmedlampFileNames[] = $lamporiginalFilename;
                $mecmedlampFilePaths[] = $path;
            }

            // Save the updated file names and paths in the Postup model for lamp1
            $Dispatch->setAttribute('dis_filename1', array_values($mecmedlampFileNames));
            $Dispatch->setAttribute('lamp1', array_values($mecmedlampFilePaths));
        }

        $Dispatch->date_process = $now;
        $Dispatch->no_folio = $request->no_folio;
        $Dispatch->catatan_admin = $request->catatan_admin;
        // $Dispatch->tindakan = $request->tindakan;
        $Dispatch->tindakan = json_encode($request->tindakan); // Convert the array to a JSON string
        
        // Save 'Dispatch' data
        $Dispatch->save();

        // method to retrieve the last data
        $data1 = Dispatch::select('dispatch_infos.*')
        ->orderBy('created_at', 'DESC')
        ->first();

         $data2 = $data1->id;


        $dispatchpassmecs = DispatchPassMec::create([
            'dispatch_infos_id' => $data2, // Assuming $Dispatch has an 'id' property.
            'ulasan_pass' => $Dispatch->catatan_admin,
            'tindakan_pass' => $Dispatch->tindakan,
            'no_folio' => $Dispatch->no_folio,
            'created_by' => $icNos,
            'updated_at' => $now,
            'created_at' => $now,
        ]);
        

        return redirect()->route('dispatchs.dis.indextindakan')
            ->with('success_message', 'New dispatch record was successfully added!');
    }
    public function edit($id)
    {

        $dispatchs = Dispatch::all()
            ->where('id', '=', $id);

        $kepada = Kepada::pluck('label', 'label')->all();

        $Skepada = Kepada::pluck('label', 'label')->all();

        $jenis = Jenis::pluck('label', 'id')->all();

        $daripada = Daripada::pluck('label', 'id')->all();
        
        $untukperhatians = Untukperhatian::pluck('kod', 'id')->all();

        return view('dispatchs.edit', compact('dispatchs', 'kepada', 'jenis', 'daripada', 'untukperhatians', 'Skepada'));
    }

     public function editcorrespondence($id)
    {

        $dispatchs = Dispatch::all()
            ->where('id', '=', $id);

        $kepada = Kepada::pluck('label', 'label')->all();

        $Skepada = Kepada::pluck('label', 'label')->all();
        

        $jenis = Jenis::pluck('label', 'id')->all();

        $daripada = Daripada::pluck('label', 'id')->all();
        
        $untukperhatians = Untukperhatian::pluck('kod', 'id')->all();
        $tindakan = Mecuser::pluck('kod', 'ic_no')->all();

        return view('dispatchs.editcorrespondence', compact('dispatchs', 'kepada', 'jenis', 'daripada', 'untukperhatians','Skepada','tindakan'));
    }


    public function editadmin($id)
    {
        $kepada = Kepada::pluck('label', 'label')->all();

        $jenis = Jenis::pluck('label', 'id')->all();

        $daripada = Daripada::pluck('label', 'id')->all();

        $tindakan = Mecuser::pluck('kod', 'ic_no')->all();


     // this method to let display main data saja (rujukan)
        $dispatchs = Dispatch::all()
            ->where('id', '=', $id);

        $icNos = Auth::user()->ic_no;


        $employments = Employment::leftJoin('departments', 'emp_employment_infos.department_id', '=', 'departments.id')
        ->select('emp_employment_infos.*', 'departments.label')
        ->where('ic_no', '=', $icNos)->first();

        $employments->label;

        $dispatchsadmin = Dispatch::where('admin_id', $id)
            ->where('admin_dept',$employments->label)
            ->latest()
            ->get();



        $dispatchfiles = Dispatchfile::select('dispatch_files.*')
            ->orderBy('created_at', 'DESC')
            ->where([
                ['dispatch_infos_id', '=', $id]
            ])
            ->get();

        $icNos = Auth::user()->ic_no;

    
        $employments = Employment::all()
                            ->where('ic_no', '=', $icNos);

        return view('dispatchs.editadmin', compact('tindakan', 'kepada', 'jenis', 'daripada', 'dispatchs','dispatchsadmin','employments', 'dispatchfiles'));
    }

      public function editflowmec($id)
    {

        // Tindakan Admin
        $extractid = DispatchPassMec::select('dispatch_pass_mecs.*')
        ->where('id', '=', $id)
        ->orderBy('created_at', 'DESC')
        ->first();

          $tindakan = Mecuser::pluck('kod','ic_no')->all();

          $extractid->dispatch_infos_id;

          $dispatchpassmecs= DispatchPassMec::leftJoin('dispatch_mecusers', 'dispatch_pass_mecs.created_by', '=', 'dispatch_mecusers.ic_no' )
            ->select('dispatch_pass_mecs.*','dispatch_mecusers.kod')
            ->where('dispatch_infos_id','=',$extractid->dispatch_infos_id)
            ->orderBy('dispatch_pass_mecs.created_at','DESC')
            ->paginate(50);

            //  method retrieving tindakan
            $dispatchmecusers = Mecuser::select('dispatch_mecusers.*')
            ->orderBy('created_at', 'DESC')
            ->get();

           // start - untuk display KOD arah editflowmecblade
            $dispatchpassmecstindakanpasss = DispatchPassMec::where('id', $id)->orderBy('created_at', 'DESC')->paginate(50);

            $dispatchpassmecstindakanpasss->each(function ($item) {
                $tindakanPassArray = json_decode($item->tindakan_pass);
                $kodValues = [];
            
                foreach ($tindakanPassArray as $icNo) {
                    $dispatchMecUser = Mecuser::where('ic_no', $icNo)->first();
            
                    if ($dispatchMecUser) {
                        $kodValues[] = $dispatchMecUser->kod;
                    }
                }
            
                $item->kod = implode(', ', $kodValues);
            });
            

            // end 

         


        return view('dispatchs.editflowmec', compact('dispatchpassmecs','dispatchmecusers','dispatchpassmecstindakanpasss','tindakan'));
    }

      public function editflowcorrespondence($id)
    {

      
        

        $tindakan = Mecuser::pluck('kod','ic_no')->all();

          $dispatchpassmecs= DispatchPassMec::leftJoin('dispatch_mecusers', 'dispatch_pass_mecs.created_by', '=', 'dispatch_mecusers.ic_no' )
            ->select('dispatch_pass_mecs.*','dispatch_mecusers.kod')
            ->where('dispatch_infos_id','=',$id)
            ->orderBy('dispatch_pass_mecs.created_at','DESC')
            ->paginate(50);

            //  method retrieving tindakan
            $dispatchmecusers = Mecuser::select('dispatch_mecusers.*')
            ->orderBy('created_at', 'DESC')
            ->get();



      

   

         


        return view('dispatchs.editflowcorrespondence', compact('dispatchpassmecs','dispatchmecusers','tindakan'));
    }



    public function show($id)
    {

        // $dispatchs = Dispatch::all()->where('id', '=', $id)->first();




        $dispatchs = Dispatch::all()->where('id', '=', $id);



        $kepada = Kepada::pluck('label', 'label')->all();

        $jenis = Jenis::pluck('label', 'id')->all();

        $daripada = Daripada::pluck('label', 'id')->all();

        $dispatchfiles = Dispatchfile::select('dispatch_files.*')
            ->orderBy('created_at', 'DESC')
            ->where([
                ['dispatch_infos_id', '=', $id]
            ])
            ->get();




        return view('dispatchs.show', compact('dispatchs', 'kepada', 'jenis', 'daripada', 'dispatchfiles'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dispatch  $dispatch
     * @return \Illuminate\Http\Response
     */
    

   

    public function showtindakan($id)
    {

        // $dispatchs = Dispatch::all()->where('id', '=', $id)->first();


        //  $dispatchs = Dispatch::select('dispatch_infos.*')
        //  ->where([['id', '=', $id]]) 
        //  ->orderBy('created_at', 'DESC')
        //  ->get();

             // untuk keluarkan rujukan(admin)
             $dispatchs = DispatchPassMec::leftJoin('dispatch_infos', 'dispatch_pass_mecs.dispatch_infos_id', '=', 'dispatch_infos.id')
             ->select('dispatch_pass_mecs.*', 'dispatch_infos.dispatch_recieved_at',
             'dispatch_infos.jns',
             'dispatch_infos.daripada',
             'dispatch_infos.kpd',
             'dispatch_infos.up',
             'dispatch_infos.perkara',
              'dispatch_infos.rp',
              'dispatch_infos.rm',
              'dispatch_infos.lamp',
              'dispatch_infos.catt',
              'dispatch_infos.date_process',
              'dispatch_infos.date_close',
         
                'dispatch_infos.no_folio',
                'dispatch_infos.catatan_admin',
                 'dispatch_infos.tindakan'
            )
            ->where('dispatch_pass_mecs.id', '=', $id)
             
              ->orderBy('created_at', 'DESC')
 
             ->get();

         $dispatchmecusers1 = Mecuser::select('dispatch_mecusers.*')
         ->orderBy('created_at', 'DESC')
         ->first();


        $kepada = Kepada::pluck('label', 'id')->all();

        $jenis = Jenis::pluck('label', 'id')->all();

        $daripada = Daripada::pluck('label', 'id')->all();

        $tindakan = Mecuser::pluck('kod','ic_no')->all();


        $dispatchfiles = Dispatchfile::select('dispatch_files.*')
            ->orderBy('created_at', 'DESC')
            ->where([
                ['dispatch_infos_id', '=', $id]
            ])
            ->get();

       
        // $dispatchpassmecs = DispatchPassMec::select('dispatch_pass_mecs.*')
        //     ->orderBy('created_at', 'DESC')
        //     ->where([
        //         ['dispatch_infos_id', '=', $id]
        //     ])
        //     ->get();

        // $extractid = DispatchPassMec::leftJoin('dispatch_infos', 'dispatch_pass_mecs.dispatch_infos_id', '=', 'dispatch_infos.id')
        // ->select('dispatch_pass_mecs.*', 'dispatch_infos.id' )
        // ->where('dispatch_pass_mecs.id', '=', $id);


           // Tindakan Admin
        $extractid = DispatchPassMec::select('dispatch_pass_mecs.*')
        ->where('id', '=', $id)
        ->orderBy('created_at', 'DESC')
        ->first();

        $extractid->dispatch_infos_id;



    
          $dispatchpassmecs= DispatchPassMec::leftJoin('dispatch_mecusers', 'dispatch_pass_mecs.created_by', '=', 'dispatch_mecusers.ic_no' )
            ->select('dispatch_pass_mecs.*', 'dispatch_mecusers.kod')
            ->where('dispatch_infos_id','=',$extractid->dispatch_infos_id)
            ->orderBy('dispatch_pass_mecs.created_at', 'DESC')
            ->paginate(50);



            // $dispatchpassmecs = DispatchPassMec::leftJoin('dispatch_infos', 'dispatch_pass_mecs.dispatch_infos_id', '=', 'dispatch_infos.id')
            // ->select('dispatch_pass_mecs.*', 'dispatch_infos.ic_no')
            // ->where($extractid->dispatch_infos_id,'=','dispatch_pass_mecs.dispatch_infos_id')
            // ->orderBy('created_at', 'DESC')
            // ->get();

            // $dispatchpassmecs = Dispatch::leftJoin('dispatch_pass_mecs', 'dispatch_infos.id', '=', 'dispatch_pass_mecs.dispatch_infos_id')
            // ->select('dispatch_infos.*', 'dispatch_pass_mecs.tindakan_action_pass','dispatch_pass_mecs.ulasan_pass')
            // ->where()
            // ->orderBy('created_at', 'DESC')
            // ->get();

            // $dispatchpassmecs= DispatchPassMec::leftJoin('dispatch_mecusers', 'dispatch_pass_mecs.created_by', '=', 'dispatch_mecusers.ic_no' )
            // ->select('dispatch_pass_mecs.*', 'dispatch_mecusers.kod')
            // ->orderBy('dispatch_pass_mecs.created_at', 'DESC')
            // ->paginate(50);

      

            //  method retrieving tindakan
            $dispatchmecusers = Mecuser::select('dispatch_mecusers.*')
            ->orderBy('created_at', 'DESC')
            ->get();

    $dispatchpassmecstindakanpasss = DispatchPassMec::leftJoin('dispatch_mecusers', 'dispatch_pass_mecs.tindakan_pass','=', 'dispatch_mecusers.ic_no' )
        ->select('dispatch_pass_mecs.*', 'dispatch_mecusers.kod')
        ->where('dispatch_pass_mecs.id', '=', $id)
        ->orderBy('dispatch_pass_mecs.created_at', 'DESC')
        ->paginate(50);



        return view('dispatchs.showtindakan', compact('dispatchs', 'tindakan','kepada', 'jenis', 'daripada', 'dispatchfiles', 'dispatchpassmecs', 'dispatchmecusers','dispatchmecusers1','dispatchpassmecstindakanpasss'));
    }

    public function showcorrespondence($id)
    {

        $displaydispatchs = Dispatch::select('dispatch_infos.*')
            ->orderBy('created_at', 'DESC')
            ->where([
                ['id', '=', $id]
            ])
            ->get();


           // untuk keluarkan rujukan(admin)
             $dispatchs = DispatchPassMec::leftJoin('dispatch_infos', 'dispatch_pass_mecs.dispatch_infos_id', '=', 'dispatch_infos.id')
             ->select('dispatch_pass_mecs.*', 'dispatch_infos.dispatch_recieved_at',
             'dispatch_infos.jns',
             'dispatch_infos.daripada',
             'dispatch_infos.kpd',
             'dispatch_infos.up',
             'dispatch_infos.perkara',
              'dispatch_infos.rp',
              'dispatch_infos.rm',
              'dispatch_infos.lamp',
              'dispatch_infos.catt',
              'dispatch_infos.date_process',
              'dispatch_infos.date_close',
              'dispatch_infos.no_folio',
              'dispatch_infos.catatan_admin',
              'dispatch_infos.tindakan')
            ->where('dispatch_pass_mecs.dispatch_infos_id', '=', $id)
            ->orderBy('created_at', 'DESC')
            ->get();

 





        $kepada = Kepada::pluck('label', 'id')->all();

        $jenis = Jenis::pluck('label', 'id')->all();

        $daripada = Daripada::pluck('label', 'id')->all();

        $tindakan = Mecuser::pluck('kod','ic_no')->all();

    // calling the dokumen
        $dispatchfiles = Dispatchfile::select('dispatch_files.*')
            ->orderBy('created_at', 'DESC')
            ->where([
                ['dispatch_infos_id', '=', $id]
            ])
            ->get();


        // Tindakan Admin
        $extractid = DispatchPassMec::select('dispatch_pass_mecs.*')
        ->where('dispatch_infos_id', '=', $id)
        ->orderBy('created_at', 'DESC')
        ->first();

        $extractid->dispatch_infos_id;

     
        $dispatchpassmecs= DispatchPassMec::leftJoin('dispatch_mecusers', 'dispatch_pass_mecs.created_by', '=', 'dispatch_mecusers.ic_no' )
            ->select('dispatch_pass_mecs.*', 'dispatch_mecusers.kod')
            ->where('dispatch_infos_id','=',$extractid->dispatch_infos_id)
            ->orderBy('dispatch_pass_mecs.created_at', 'DESC')
            ->paginate(50);

        //  method retrieving tindakan
        $dispatchmecusers = Mecuser::select('dispatch_mecusers.*')
        ->orderBy('created_at', 'DESC')
        ->get();

            
           // start - untuk display KOD arah editflowmecblade
            $dispatchpassmecstindakanpasss = DispatchPassMec::where('id', $id)->orderBy('created_at', 'DESC')->paginate(50);

            $dispatchpassmecstindakanpasss->each(function ($item) {
                $tindakanPassArray = json_decode($item->tindakan_pass);
                $kodValues = [];
            
                foreach ($tindakanPassArray as $icNo) {
                    $dispatchMecUser = Mecuser::where('ic_no', $icNo)->first();
            
                    if ($dispatchMecUser) {
                        $kodValues[] = $dispatchMecUser->kod;
                    }
                }
            
                $item->kod = implode(', ', $kodValues);
            });
            

            // end 



        return view('dispatchs.showcorrespondence', compact('displaydispatchs','dispatchs', 'tindakan','kepada', 'jenis', 'daripada', 'dispatchfiles', 'dispatchpassmecs', 'dispatchmecusers','dispatchpassmecstindakanpasss'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dispatch  $dispatch
     * @return \Illuminate\Http\Response
     */


public function showadmin($id)
    {

        // $dispatchs = Dispatch::all()->where('id', '=', $id)->first();




        $dispatchs = Dispatch::all()->where('id', '=', $id);

        $dispatchsadmin = Dispatch::all()->where('admin_id', '=', $id);



        $kepada = Kepada::pluck('label', 'label')->all();

        $jenis = Jenis::pluck('label', 'id')->all();

        $daripada = Daripada::pluck('label', 'id')->all();

        $tindakan = Mecuser::pluck('kod','ic_no')->all();



        $dispatchfiles = Dispatchfile::select('dispatch_files.*')
            ->orderBy('created_at', 'DESC')
            ->where([
                ['dispatch_infos_id', '=', $id]
            ])
            ->get();



        return view('dispatchs.showadmin', compact('dispatchs', 'dispatchsadmin', 'kepada', 'jenis', 'daripada','tindakan', 'dispatchfiles'));
    }


 public function edittindakan($id)
    {

        $dispatchpassmecs = DispatchPassMec::select('dispatch_pass_mecs.*')
        ->where([['id', '=', $id]]) 
        ->orderBy('created_at', 'DESC')
        ->get();

        // untuk keluarkan rujukan(admin)
        $dispatchs = DispatchPassMec::leftJoin('dispatch_infos', 'dispatch_pass_mecs.dispatch_infos_id', '=', 'dispatch_infos.id')
            ->select('dispatch_pass_mecs.*', 'dispatch_infos.dispatch_recieved_at',
            'dispatch_infos.date_process',
             'dispatch_infos.date_close',
              'dispatch_infos.lamp',
               'dispatch_infos.no_folio',
               'dispatch_infos.catatan_admin',
                'dispatch_infos.tindakan'
           )
           ->where('dispatch_pass_mecs.id', '=', $id)
            
             ->orderBy('created_at', 'DESC')

            ->get();

      

        $dispatchpassmecskods = DispatchPassMec::leftJoin('dispatch_mecusers', 'dispatch_pass_mecs.created_by','=', 'dispatch_mecusers.ic_no' )
        ->select('dispatch_pass_mecs.*', 'dispatch_mecusers.kod')
        ->where('dispatch_pass_mecs.id', '=', $id)
        ->orderBy('dispatch_pass_mecs.created_at', 'DESC')
        ->paginate(50);

        $dispatchpassmecstindakanpasss = DispatchPassMec::leftJoin('dispatch_mecusers', 'dispatch_pass_mecs.tindakan_pass','=', 'dispatch_mecusers.ic_no' )
        ->select('dispatch_pass_mecs.*', 'dispatch_mecusers.kod')
        ->where('dispatch_pass_mecs.id', '=', $id)
        ->orderBy('dispatch_pass_mecs.created_at', 'DESC')
        ->paginate(50);
        
        $kepada = Kepada::pluck('label', 'id')->all();

        $jenis = Jenis::pluck('label', 'id')->all();

        $kakitanganlist = Kakitanganlist::pluck('label', 'label')->all();

        $tindakanlist = Tindakanlist::pluck('label', 'label')->all();

        $daripada = Daripada::pluck('label', 'id')->all();
        

        $tindakan = Mecuser::pluck('kod','ic_no')->all();

        $tindakanpass = Mecuser::pluck('kod','ic_no')->all();




         $dispatchpassmecsfile = DispatchPassMec::select('dispatch_pass_mecs.*')
        ->where([['id', '=', $id]]) 
        ->orderBy('created_at', 'DESC')
        ->first();

       
        $iddispathpassmecs = $dispatchpassmecsfile->dispatch_infos_id;


        $dispatchfiles = Dispatchfile::select('dispatch_files.*')
            ->orderBy('created_at', 'DESC')
            ->where([
                ['dispatch_infos_id', '=', $iddispathpassmecs]
            ])
            ->get();

        $ic = Auth::user()->ic_no;


        
        $tindakanics = DispatchPassMec::leftJoin('dispatch_mecusers', 'dispatch_pass_mecs.tindakan_pass', '=', 'dispatch_mecusers.id')
            ->select('dispatch_pass_mecs.*', 'dispatch_mecusers.ic_no')
            ->orderBy('created_at', 'DESC')
            ->get();


        // $dispatchpassmecreverses = DispatchPassMec::all()
        //     ->where($id, '=', 'dispatch_pass_mecs_id');

        $icNos = Auth::user()->ic_no;


        $dispatchpassmecreverses = DispatchPassMec::all()
            ->where('dispatch_pass_mecs_id', '=', $id)
            ->where('created_by', '=', $icNos); //baru add 4/09/23
            


            
        $dispatchpassmecreversestindakan = DispatchPassMec::leftJoin('dispatch_mecusers', 'dispatch_pass_mecs.tindakan_pass','=', 'dispatch_mecusers.ic_no' )
        ->select('dispatch_pass_mecs.*', 'dispatch_mecusers.kod')
        ->where('dispatch_pass_mecs.dispatch_pass_mecs_id', '=', $id)
        ->where('created_by', '=', $icNos) //baru add 4/09/23
        ->orderBy('dispatch_pass_mecs.created_at', 'DESC')
        ->paginate(50);

        return view('dispatchs.edittindakan', compact('dispatchs', 'kepada', 'jenis','kakitanganlist','tindakanlist', 'daripada', 'dispatchfiles', 'tindakan','tindakanpass', 'dispatchpassmecs','dispatchpassmecskods','dispatchpassmecstindakanpasss','tindakanics','dispatchpassmecreverses','dispatchpassmecreversestindakan'));
     }

    public function PegawaiT(Dispatch $dispatch)
    {
        $kepada = Kepada::pluck('label', 'label')->all();

        $jenis = Jenis::pluck('label', 'id')->all();

        $daripada = Daripada::pluck('label', 'id')->all();


        return view('dispatchs.pegawaiT', compact('kepada', 'jenis', 'daripada'));
    }

    public function kakitangan(Dispatch $dispatch)
    {
        $kepada = Kepada::pluck('label', 'label')->all();

        $jenis = Jenis::pluck('label', 'id')->all();

        $daripada = Daripada::pluck('label', 'id')->all();


        return view('dispatchs.kakitangan', compact('kepada', 'jenis', 'daripada'));
    }

    public function mecuser()
    {
        $kepada = Kepada::pluck('label', 'label')->all();

        $jenis = Jenis::pluck('label', 'id')->all();

        $daripada = Daripada::pluck('label', 'id')->all();

        $mecusers = Mecuser::select('dispatch_mecusers.*')
            ->orderBy('created_at', 'DESC')
            ->get();


        return view('dispatchs.mecuser', compact('kepada', 'jenis', 'daripada', 'mecusers'));
    }

        public function untukperhatian()
    {
        $kepada = Kepada::pluck('label', 'id')->all();

        $jenis = Jenis::pluck('label', 'id')->all();

        $daripada = Daripada::pluck('label', 'id')->all();

        $untukperhatians = Untukperhatian::select('dispatch_untukperhatian.*')
            ->orderBy('created_at', 'DESC')
            ->get();


        return view('dispatchs.untukperhatian', compact('kepada', 'jenis', 'daripada', 'untukperhatians'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dispatch  $dispatch
     * @return \Illuminate\Http\Response
     */
public function update(Request $request,$id)
    {
        $request->validate([]);

        $now = Carbon::now();

    

            try {
                $Dispatch = Dispatch::findOrFail($id);
                $Dispatch->jns= $request->input('jns');
                $Dispatch->kpd= $request->input('kpd');
                $Dispatch->up= $request->input('up');
                $Dispatch->perkara= $request->input('perkara');
                $Dispatch->rp= $request->input('rp');
                $Dispatch->rm= $request->input('rm');
                $Dispatch->catt= $request->input('catt');
              


                $Dispatch->updated_at= $now;

            // Part 1: Upload Document
                
            // Check if the "Remove file" for pdf checkboxes are checked
            if ($request->has('remove_file')) {
                $removeImageIndexes = $request->input('remove_file');
                $mecmedFileCount = count($Dispatch->lamp);
                $mecmedFileNames = $Dispatch->lamp ?? []; // Retrieve existing image filenames or initialize an empty array
                $mecmedFilePaths = $Dispatch->dis_filename ?? []; // Retrieve existing image file paths or initialize an empty array

                foreach ($removeImageIndexes as $index) {
                    // Ensure the index is within the range of the pdf_file array
                    if ($index >= 0 && $index < $mecmedFileCount) {
                        if (in_array($index, $removeImageIndexes)) {
                            // Delete the image file and path
                            $filePath = $Dispatch->dis_filename[$index];
                            if ($filePath) {
                                Storage::delete($filePath);
                            }

                            // Remove the image from the arrays
                            unset($mecmedFileNames[$index]);
                            unset($mecmedFilePaths[$index]);
                        }
                    }
                }

                // Reindex the arrays after removing elements
                $reindexedFileNames = array_values($mecmedFileNames);
                $reindexedFilePaths = array_values($mecmedFilePaths);

                // Save the updated result pdf file names and paths in the Announcement model
                $Dispatch->setAttribute('lamp', $reindexedFileNames);
                $Dispatch->setAttribute('dis_filename', $reindexedFilePaths);
            }

                        // Handle uploaded images
                        if ($request->hasFile('lamp')) {
                            $files = $request->file('lamp');
                            $mecmedFileNames = $Dispatch->lamp ?? []; // Retrieve existing image filenames or initialize an empty array
                            $mecmedFilePaths = $Dispatch->dis_filename ?? []; // Retrieve existing image file paths or initialize an empty array

                            foreach ($files as $file) {
                                // Check the file size
                                $fileSize = $file->getSize();
                                $maxFileSize = 2 * 1024 * 1024; // 2MB in bytes

                                if ($fileSize > $maxFileSize) {
                                    return redirect()->back()->withErrors(['file_size' => 'Please use a file size up to 2MB.']);
                                }

                                // Validate the file
                                $validatedData = $request->validate([
                                    'lamp.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
                                ]);

                                // Get the original filename and extension
                                $originalFilename = $file->getClientOriginalName();
                                $extension = strtolower($file->getClientOriginalExtension());

                    
                                // Store the file in the desired disk and directory
                                $path = $file->storeAs('public/Dispatch', $originalFilename);

                                // Store the file name and path in the respective arrays
                                $mecmedFileNames[] = $originalFilename;
                                $mecmedFilePaths[] = $path;
                            }

                        // Save the updated file names and paths in the SrNews model
                        $Dispatch->setAttribute('lamp', array_values($mecmedFileNames));
                        $Dispatch->setAttribute('dis_filename', array_values($mecmedFilePaths));

                        }
                        // End Part 1: Upload Document

                        // Part 2: Salinan Document upload

                // Check if the "Remove file" for pdf checkboxes are checked
                if ($request->has('remove_file1')) {
                    $lampremoveImageIndexes = $request->input('remove_file1');
                    $mecmedlampFileCount = count($Dispatch->lamp1);
                    $mecmedlampFileNames = $Dispatch->lamp1 ?? []; // Retrieve existing image filenames or initialize an empty array
                    $mecmedlampFilePaths = $Dispatch->dis_filename1 ?? []; // Retrieve existing image file paths or initialize an empty array

                    foreach ($lampremoveImageIndexes as $index) {
                        // Ensure the index is within the range of the pdf_file array
                        if ($index >= 0 && $index < $mecmedlampFileCount) {
                            if (in_array($index, $lampremoveImageIndexes)) {
                                // Delete the image file and path
                                $lampfilePath = $Dispatch->dis_filename1[$index];
                                if ($lampfilePath) {
                                    Storage::delete($lampfilePath);
                                }

                                // Remove the image from the arrays
                                unset($mecmedlampFileNames[$index]);
                                unset($mecmedlampFilePaths[$index]);
                            }
                        }
                    }

                    // Reindex the arrays after removing elements
                    $reindexedlampFileNames = array_values($mecmedlampFileNames);
                    $reindexedlampFilePaths = array_values($mecmedlampFilePaths);

                    // Save the updated result pdf file names and paths in the Announcement model
                    $Dispatch->setAttribute('lamp1', $reindexedlampFileNames);
                    $Dispatch->setAttribute('dis_filename1', $reindexedlampFilePaths);
                }

                // Handle uploaded images for "Salinan Document"
                if ($request->hasFile('lamp1')) {
                    $lampfiles = $request->file('lamp1');
                    $mecmedlampFileNames = $Dispatch->lamp1 ?? []; // Retrieve existing image filenames or initialize an empty array
                    $mecmedlampFilePaths = $Dispatch->dis_filename1 ?? []; // Retrieve existing image file paths or initialize an empty array

                    foreach ($lampfiles as $lampfile) {
                        // Check the file size
                        $lampfileSize = $lampfile->getSize();
                        $maxFileSize = 2 * 1024 * 1024; // 2MB in bytes

                        if ($lampfileSize > $maxFileSize) {
                            return redirect()->back()->withErrors(['file_size' => 'Please use a file size up to 2MB.']);
                        }

                        // Validate the file
                        $validatedData = $request->validate([
                            'lamp1.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
                        ]);

                        // Get the original filename and extension for "Salinan Document"
                        $lamporiginalFilename = $lampfile->getClientOriginalName();
                        $lampextension = strtolower($lampfile->getClientOriginalExtension());

                        // Store the file in the desired disk and directory
                        $path = $lampfile->storeAs('public/Dispatch', $lamporiginalFilename);

                        // Store the file name and path in the respective arrays for "Salinan Document"
                        $mecmedlampFileNames[] = $lamporiginalFilename;
                        $mecmedlampFilePaths[] = $path;
                    }

                    // Save the updated file names and paths for "Salinan Document" in the SrNews model
                    $Dispatch->setAttribute('lamp1', array_values($mecmedlampFileNames));
                    $Dispatch->setAttribute('dis_filename1', array_values($mecmedlampFilePaths));
                }

                // End Part 2: Salinan Document Upload

                $Dispatch->save();



            return redirect()->route('dispatchs.dis.index')
                ->with('success_message', 'Dispatch updated successfully.');
        } catch (Exception $exception) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function updateflowmec(Request $request)
    {
        $catatan = $request->input('catatanmec');
        $ids = $request->input('id');
    
        if (!empty($catatan) && !empty($ids)) {
            // Assuming 'DispatchPassMec' is an Eloquent model
            DispatchPassMec::whereIn('id', $ids)->update(['catatanmec' => $catatan]);
        }
    
        return redirect()->back()->with('success_message', 'Records were successfully updated!');
    }
    



    public function updateadmin(Request $request)
    {
        // storing data for dokumen file
        $now = Carbon::now();
        $id = $request->id;
        $filename = $request->mec_file;
        $file = $request->file('mec_file');
        $no_folio_dokumen = $request->no_folio_dokumen;
        $despatch = $request->despatch;
        $daripada = $request->daripada;
        $tarikh_surat = $request->tarikh_surat;
        $tindakan = $request->tindakanfile;
        $icNos = Auth::user()->ic_no;
        
        if ($request->mec_file != '' || $request->filename != '' || $request->no_folio_dokumen != '' || $request->despatch != '') {
            $insert_data_1 = [];
        
            for ($count_1 = 0; $count_1 < count($file); $count_1++) {
                $data_1 = [
                    'dispatch_infos_id' => $id,
                    'no_folio_dokumen' => $no_folio_dokumen[$count_1],
                    'despatch' => $despatch[$count_1],
                    'daripada' => $daripada[$count_1],
                    'tarikh_surat' => $tarikh_surat[$count_1],
                    'tindakanfile' => $tindakan[$count_1],
                    'filename' => $filename[0]->getClientOriginalName(),
                    'mec_file' => $file[$count_1]->store('dispatch', 'public'),
                    'created_by_ic_no' => $icNos[$count_1],
                    'created_at' => $now,
                ];
        
                $insert_data_1[] = $data_1;
            }

            Dispatchfile::insert($insert_data_1);
        }

           $tindakan = json_encode($request->tindakan); // Convert the array to a JSON string


           // start admin give tindakan based on their dept & based on either form pernah submit or inda

            $admin_id = $request->admin_id;
            $idadmin = $request->id;
            $admin_dept = $request->admin_dept;

            if ($admin_id != '') {
                // Update the existing record
                $dispatch = Dispatch::where('admin_id', $admin_id)
                ->where('admin_dept', $admin_dept)
                ->first();
            
                if ($dispatch) {
                    $dispatch->date_process = $request->$now;
                    $dispatch->no_folio = $request->no_folio;
                    $dispatch->catatan_admin = $request->catatan_admin;
                    $dispatch->tindakan = $tindakan; // Use the converted JSON string
                    $dispatch->admin_dept = $request->admin_dept;
                    $dispatch->date_admin_submit = $now;
                    $dispatch->updated_at = $now;
                    $dispatch->save();
                } 
            } 
            else 
            {
                // Create a new record
                $dispatchs = Dispatch::findOrFail($request->id);
            
                $newDispatch = new Dispatch();
                $newDispatch->admin_id = $dispatchs->id;
                $newDispatch->date_process = $request->$now;
                $newDispatch->no_folio = $request->no_folio;
                $newDispatch->catatan_admin = $request->catatan_admin;
                $newDispatch->tindakan = $tindakan; // Use the converted JSON string
                $newDispatch->admin_dept = $request->admin_dept;
                $newDispatch->date_admin_submit = $now;
                $newDispatch->updated_at = $now;
                $newDispatch->save();
            }

           // end updateadmin based on dept & admin_id
    

        // start email

            // Retrieve the updated dispatch record with the joined 'daripada' relationship
            $dispatchs = Dispatch::select('dispatch_infos.rp', 'dispatch_infos.tindakan', 'dispatch_infos.perkara', 'dispatch_infos.daripada', 'dispatch_infos.catt', 'daripada.label as daripada_label')
                ->leftJoin('daripada', 'dispatch_infos.daripada', '=', 'daripada.code')
                ->where('dispatch_infos.id', $request->id)
                ->first();

            // Check if the dispatch record was found
            if ($dispatchs) {
                // Retrieve selected users' IDs
                $selectedUserIds = $request->input('tindakan');

                // Retrieve user email addresses
                $selectedUsers = Mecuser::whereIn('ic_no', $selectedUserIds)->get();

                // Send emails to selected users
                foreach ($selectedUsers as $user) {
                    // Access the label attribute from the related Daripada model
                    $label = optional($dispatchs)->daripada_label;
                    Mail::to($user->email)->send(new DispatchEmail(
                        'Despatch',
                        $label,
                        $dispatchs->perkara,
                        $user->kod,
                        $dispatchs->rp,
                        $dispatchs->catt
                    ));
                }

            } else {}

         // end email

        $dispatchpassmecs = DispatchPassMec::updateOrCreate(
            [
                'dispatch_infos_id' => $request->input('id'),
            ],
            [
                'ulasan_pass' => $request->input('catatan_admin'),
                'tindakan_pass' => $tindakan,
                'no_folio' => $request->input('no_folio'),
                'created_by' => $icNos,
                'updated_at' => $now,
            ]
        );

        return redirect()->route('dispatchs.dis.indexadmin')
            ->with('success_message', 'Data record was successfully updated!');
    }

    public function updatecorrespondence(Request $request,$id)
    {
        $request->validate([]);
        $icNos = Auth::user()->ic_no;


        $now = Carbon::now();


            try {
                $Dispatch = Dispatch::findOrFail($id);
                $Dispatch->jns= $request->input('jns');
                $Dispatch->kpd= $request->input('kpd');
                $Dispatch->up= $request->input('up');
                $Dispatch->perkara= $request->input('perkara');
                $Dispatch->rp= $request->input('rp');
                $Dispatch->rm= $request->input('rm');
                $Dispatch->catt= $request->input('catt');
                $Dispatch->updated_at= $now;

            // Part 1: Upload Document
                
            // Check if the "Remove file" for pdf checkboxes are checked
            if ($request->has('remove_file')) {
                $removeImageIndexes = $request->input('remove_file');
                $mecmedFileCount = count($Dispatch->lamp);
                $mecmedFileNames = $Dispatch->lamp ?? []; // Retrieve existing image filenames or initialize an empty array
                $mecmedFilePaths = $Dispatch->dis_filename ?? []; // Retrieve existing image file paths or initialize an empty array

                foreach ($removeImageIndexes as $index) {
                    // Ensure the index is within the range of the pdf_file array
                    if ($index >= 0 && $index < $mecmedFileCount) {
                        if (in_array($index, $removeImageIndexes)) {
                            // Delete the image file and path
                            $filePath = $Dispatch->dis_filename[$index];
                            if ($filePath) {
                                Storage::delete($filePath);
                            }

                            // Remove the image from the arrays
                            unset($mecmedFileNames[$index]);
                            unset($mecmedFilePaths[$index]);
                        }
                    }
                }

                // Reindex the arrays after removing elements
                $reindexedFileNames = array_values($mecmedFileNames);
                $reindexedFilePaths = array_values($mecmedFilePaths);

                // Save the updated result pdf file names and paths in the Announcement model
                $Dispatch->setAttribute('lamp', $reindexedFileNames);
                $Dispatch->setAttribute('dis_filename', $reindexedFilePaths);
            }

        // Handle uploaded images
        if ($request->hasFile('lamp')) {
            $files = $request->file('lamp');
            $mecmedFileNames = $Dispatch->lamp ?? []; // Retrieve existing image filenames or initialize an empty array
            $mecmedFilePaths = $Dispatch->dis_filename ?? []; // Retrieve existing image file paths or initialize an empty array

            foreach ($files as $file) {
                // Check the file size
                $fileSize = $file->getSize();
                $maxFileSize = 2 * 1024 * 1024; // 2MB in bytes

                if ($fileSize > $maxFileSize) {
                    return redirect()->back()->withErrors(['file_size' => 'Please use a file size up to 2MB.']);
                }

                // Validate the file
                $validatedData = $request->validate([
                    'lamp.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
                ]);

                // Get the original filename and extension
                $originalFilename = $file->getClientOriginalName();
                $extension = strtolower($file->getClientOriginalExtension());

    
                // Store the file in the desired disk and directory
                $path = $file->storeAs('Dispatch', $originalFilename);

                // Store the file name and path in the respective arrays
                $mecmedFileNames[] = $originalFilename;
                $mecmedFilePaths[] = $path;
            }

        // Save the updated file names and paths in the SrNews model
        $Dispatch->setAttribute('lamp', array_values($mecmedFileNames));
        $Dispatch->setAttribute('dis_filename', array_values($mecmedFilePaths));

        }
        // End Part 1: Upload Document

        // Part 2: Salinan Document upload

// Check if the "Remove file" for pdf checkboxes are checked
if ($request->has('remove_file1')) {
    $lampremoveImageIndexes = $request->input('remove_file1');
    $mecmedlampFileCount = count($Dispatch->lamp1);
    $mecmedlampFileNames = $Dispatch->lamp1 ?? []; // Retrieve existing image filenames or initialize an empty array
    $mecmedlampFilePaths = $Dispatch->dis_filename1 ?? []; // Retrieve existing image file paths or initialize an empty array

    foreach ($lampremoveImageIndexes as $index) {
        // Ensure the index is within the range of the pdf_file array
        if ($index >= 0 && $index < $mecmedlampFileCount) {
            if (in_array($index, $lampremoveImageIndexes)) {
                // Delete the image file and path
                $lampfilePath = $Dispatch->dis_filename1[$index];
                if ($lampfilePath) {
                    Storage::delete($lampfilePath);
                }

                // Remove the image from the arrays
                unset($mecmedlampFileNames[$index]);
                unset($mecmedlampFilePaths[$index]);
            }
        }
    }

    // Reindex the arrays after removing elements
    $reindexedlampFileNames = array_values($mecmedlampFileNames);
    $reindexedlampFilePaths = array_values($mecmedlampFilePaths);

    // Save the updated result pdf file names and paths in the Announcement model
    $Dispatch->setAttribute('lamp1', $reindexedlampFileNames);
    $Dispatch->setAttribute('dis_filename1', $reindexedlampFilePaths);
}

// Handle uploaded images for "Salinan Document"
if ($request->hasFile('lamp1')) {
    $lampfiles = $request->file('lamp1');
    $mecmedlampFileNames = $Dispatch->lamp1 ?? []; // Retrieve existing image filenames or initialize an empty array
    $mecmedlampFilePaths = $Dispatch->dis_filename1 ?? []; // Retrieve existing image file paths or initialize an empty array

    foreach ($lampfiles as $lampfile) {
        // Check the file size
        $lampfileSize = $lampfile->getSize();
        $maxFileSize = 2 * 1024 * 1024; // 2MB in bytes

        if ($lampfileSize > $maxFileSize) {
            return redirect()->back()->withErrors(['file_size' => 'Please use a file size up to 2MB.']);
        }

        // Validate the file
        $validatedData = $request->validate([
            'lamp1.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Get the original filename and extension for "Salinan Document"
        $lamporiginalFilename = $lampfile->getClientOriginalName();
        $lampextension = strtolower($lampfile->getClientOriginalExtension());

        // Store the file in the desired disk and directory
        $path = $lampfile->storeAs('Dispatch', $lamporiginalFilename);

        // Store the file name and path in the respective arrays for "Salinan Document"
        $mecmedlampFileNames[] = $lamporiginalFilename;
        $mecmedlampFilePaths[] = $path;
    }

    // Save the updated file names and paths for "Salinan Document" in the SrNews model
    $Dispatch->setAttribute('lamp1', array_values($mecmedlampFileNames));
    $Dispatch->setAttribute('dis_filename1', array_values($mecmedlampFilePaths));
}

// End Part 2: Salinan Document Upload


            $Dispatch->date_process = $now;
            $Dispatch->no_folio = $request->no_folio;
            $Dispatch->catatan_admin = $request->catatan_admin;
            $Dispatch->tindakan = json_encode($request->tindakan); // Convert the array to a JSON string

            // Save 'Dispatch' data
            $Dispatch->save();

    // Update the related DispatchPassMec model
        DispatchPassMec::where('dispatch_infos_id', $id)->update([
            'ulasan_pass' => $request->input('catatan_admin'),
            'tindakan_pass' => json_encode($request->tindakan), // Make sure $tindakan is defined
            'no_folio' => $request->input('no_folio'),
            'created_by' => $icNos, // Make sure $icNos is defined
            'updated_at' => $now,
        ]);




            return redirect()->route('dispatchs.dis.indextindakan')
                ->with('success_message', 'Dispatch updated successfully.');
        } catch (Exception $exception) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }



    public function updatetindakan(Request $request)
    {
        // storing data for dokumen file
        $now = Carbon::now();
        $id = $request->id;
        $filename = $request->mec_file;
        $file = $request->file('mec_file');
        $no_folio_dokumen = $request->no_folio_dokumen;
        $despatch = $request->despatch;
        $daripada = $request->daripada;
        $tarikh_surat = $request->tarikh_surat;
        $tindakan = $request->tindakanfile;
        $icNos = Auth::user()->ic_no;
        
        if ($request->mec_file != '' || $request->filename != '' || $request->no_folio_dokumen != '' || $request->despatch != '') {
            $insert_data_1 = [];
        
            for ($count_1 = 0; $count_1 < count($file); $count_1++) {
                $data_1 = [
                    'dispatch_infos_id' => $id,
                    'no_folio_dokumen' => $no_folio_dokumen[$count_1],
                    'despatch' => $despatch[$count_1],
                    'daripada' => $daripada[$count_1],
                    'tarikh_surat' => $tarikh_surat[$count_1],
                    'tindakanfile' => $tindakan[$count_1],
                    'filename' => $filename[0]->getClientOriginalName(),
                    'mec_file' => $file[$count_1]->store('dispatch', 'public'),
                    'created_by_ic_no' => $icNos[$count_1],
                    'created_at' => $now,
                ];
        
                $insert_data_1[] = $data_1;
            }

            Dispatchfile::insert($insert_data_1);
        }

    $dispatchPassMecs = DispatchPassMec::where([
        'dispatch_pass_mecs_id' => $request->input('dispatch_pass_mecs_id'),
        'created_by' => $icNos,
        ])->first();

    if ($dispatchPassMecs) {
        // If the record exists, update it
        $dispatchPassMecs->update([
            'dispatch_infos_id' => $request->input('dispatch_infos_id'),
            'tindakan_action_pass' => json_encode($request->input('tindakan_action_pass')) ?? null,
            'status' => $request->input('dispatch_infos_id'),
            'ulasan_pass' => $request->input('ulasan_pass'),
            'tindakan_pass' => json_encode($request->input('tindakan_pass')),
            'no_folio' => $request->input('no_folio'),
            'updated_at' => $now,
        ]);
    } else {
        // If the record doesn't exist, create a new one
        DispatchPassMec::create([
            'dispatch_infos_id' => $request->input('dispatch_infos_id'),
            'tindakan_action_pass' => json_encode($request->input('tindakan_action_pass')) ?? null,
            'status' => $request->input('dispatch_infos_id'),
            'ulasan_pass' => $request->input('ulasan_pass'),
            'tindakan_pass' => json_encode($request->input('tindakan_pass')),
            'no_folio' => $request->input('no_folio'),
            'created_by' => $icNos,
            'dispatch_pass_mecs_id' => $request->input('dispatch_pass_mecs_id'),
            'updated_at' => $now,
        ]);
    }

    //Email Start

    // Retrieve the updated dispatch record with the joined 'daripada' relationship
    $dispatchs = Dispatch::select('dispatch_infos.no_folio')
        ->leftJoin('daripada', 'dispatch_infos.daripada', '=', 'daripada.code')
        ->where('dispatch_infos.id', $request->id)
        ->first();

    $dispatchpassmecs = DispatchPassMec::select('dispatch_pass_mecs.*')
        ->where('dispatch_pass_mecs.dispatch_infos_id', $request->id)
        ->first();

    $dispatchpassmecskods = DispatchPassMec::leftJoin('dispatch_mecusers', 'dispatch_pass_mecs.created_by','=', 'dispatch_mecusers.ic_no' )
        ->select('dispatch_pass_mecs.*', 'dispatch_mecusers.kod')
        ->where('dispatch_pass_mecs.id', '=', $request->input('dispatch_pass_mecs_id'))
        ->orderBy('dispatch_pass_mecs.created_at', 'DESC')
        ->get();

    $dispatchpassmecstindakanpass = DispatchPassMec::leftJoin('dispatch_mecusers', function ($join) {
        $join->on('dispatch_pass_mecs.tindakan_pass', 'like', DB::raw("CONCAT('%', dispatch_mecusers.ic_no, '%')"));
    })
    ->select('dispatch_pass_mecs.*', 'dispatch_mecusers.kod')
    ->where('dispatch_pass_mecs.id', $request->input('dispatch_pass_mecs_id'))
    ->orderBy('dispatch_pass_mecs.created_at', 'DESC')
    ->get();

    // Check if the dispatch record was found
    if ($dispatchs) {
        // Retrieve selected users' IDs
        $selectedUserIds = $request->input('tindakan_pass');

        // Retrieve user email addresses
        $selectedUsers = Mecuser::whereIn('ic_no', $selectedUserIds)->get();

        // Send emails to selected users
        foreach ($selectedUsers as $user) {
            // Access the label attribute from the related Daripada model
            $label = optional($dispatchs)->daripada_label;
            
            // Loop through each $dispatchpassmecskod in the collection
            foreach ($dispatchpassmecskods as $dispatchpassmecskod) {
                // Access the 'kod' property for each item
                $kod = $dispatchpassmecskod->kod;

                // Access the 'tindakan_pass' property for each item
                $tindakanPass = $dispatchpassmecstindakanpass->pluck('kod')->implode(', ');

                // Access the 'ulasan_pass' property for each item
                $ulasanPass = $dispatchpassmecs->ulasan_pass;

                // Now, you can use $kod in your email
                Mail::to($user->email)->send(new CorrespondenceEmail(
                    'Correspondence',
                    $dispatchs->no_folio,
                    $kod,
                    $ulasanPass,
                    $tindakanPass
                ));
            }
        }

    } else {}

    //Email End

        return redirect()->route('dispatchs.dis.indextindakan')
            ->with('success_message', 'Data record was successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dispatch  $dispatch
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $dispatchs = Dispatch::where('id', $id)->delete();

            return redirect()->route('dispatchs.dis.index')
                ->with('success_message', 'Data was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function destroyadmin($id)
    {
        try {

            $dispatchs = Dispatch::where('id', $id)->delete();

            return redirect()->route('dispatchs.dis.indexadmin')
                ->with('success_message', 'Data was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function destroyfile($id)
    {
        try {

            $dispatchfiles = Dispatchfile::where('id', $id)->delete();

            return redirect()->route('dispatchs.dis.indexadmin')
                ->with('success_message', 'Data was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function destroymecuser($id)
    {
        try {

            $mecusers = Mecuser::where('id', $id)->delete();

            return redirect()->route('dispatchs.dis.mecuser')
                ->with('success_message', 'Data was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

 public function destroytindakan($id)
    {
        try {
            $dispatchs = Dispatch::where('id', $id)->delete();

            return redirect()->route('dispatchs.dis.indextindakan')
                ->with('success_message', 'Data was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }


        public function destroyuntukperhatian($id)
    {
        try {

            $untukperhatians = Untukperhatian::where('id', $id)->delete();

            return redirect()->route('dispatchs.dis.untukperhatian')
                ->with('success_message', 'Data was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    
    public function destroycorrespondence($id)
    {
        try {
            $dispatchs = Dispatch::where('id', $id)->delete();

            return redirect()->route('dispatchs.dis.indexcorrespondence')
                ->with('success_message', 'Data was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }




    public function verify($id)
    {

        return view('verify');
    }
}
