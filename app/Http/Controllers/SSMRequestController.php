<?php

namespace App\Http\Controllers;

use Session;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;

use App\Models\Day;
use App\Models\Biodata;
use App\Models\Contact;
use App\Models\Gender;
use App\Models\Race;
use App\Models\Religion;
use App\Models\Citizenship;
use App\Models\User;
use App\Models\MaritalStatus;
use App\Models\ICColor;
use App\Models\Department;
use App\Models\Ministry;
use App\Models\Bahagian;
use App\Models\Unit;
use App\Models\Country;
use App\Models\EmploymentStatus;
use App\Models\MileageStatus;
use App\Models\AllowanceCategory;
use App\Models\Division;
use App\Models\EducationLevel;
use App\Models\Education;
use App\Models\Employment;
use App\Models\Designation;
use App\Models\District;
use App\Models\SkimPerkhidmatan;
use App\Models\SalaryScale;
use App\Models\RolePeranan;
use App\Models\Cluster;
use App\Models\ServiceStatus;
use App\Models\Salary;
use App\Models\Performance;
use App\Models\Medal;
use App\Models\Grade;
use App\Models\Certificate;
use App\Models\Exam;
use App\Models\ExamList;
use App\Models\Programme;
use App\Models\ProgrammeList;
use App\Models\Paperwork;
use App\Models\Course;
use App\Models\VaccinationInfo;
use App\Models\VaccinationDose;
use App\Models\VaccinationBooster;
use App\Models\Vulnerable;
use App\Models\EmergencyRelationship;
use App\Models\ART;
use App\Models\File;
use App\Models\SSM;
use App\Models\Bersara;
use App\Models\SSMRequest;

//Ekma Touch
use App\Models\Jawatanlist;
use App\Models\SSMApproval;
use App\Models\SSMDc;
use App\Models\SSMOthers;
use App\Models\SSMPassword;
use App\Models\SSMPeranan;
use App\Models\SSMPermohonan;
use App\Models\SSMBakicuti;
use App\Models\SSMPertukaranic;
use App\Models\SSMKod;
use App\Models\SSMPermohonanicno;
use App\Models\SSMJenisPermohonan;
use App\Models\SSMPermohonanSalinan;
use App\Models\SSMPermohonanSalinanicno;

use App\Mail\EmailSSMApproval;
use App\Mail\EmailSSMBakiCuti;
use App\Mail\EmailSSMDeleteCuti;
use App\Mail\EmailSSMPertukaranIC;
use App\Mail\EmailSSMPeranan;
use App\Mail\EmailSSMResetPassword;

use App\Mail\EmailSSMApprovalSelesai;
use App\Mail\EmailSSMBakiCutiSelesai;
use App\Mail\EmailSSMPertukaranICSelesai;
use App\Mail\EmailSSMPerananSelesai;
use App\Mail\EmailSSMResetPasswordSelesai;

use Mail;
use Log;
use Carbon\Carbon;


class SSMRequestController extends Controller
{
    public function openform()
    {
    
        $jawatanlist =Jawatanlist::pluck('label','id')->all();
            // Generate a random number for the question
            $correctAnswer = rand(6,10);
                        
            // Create a set of random numbers for the grid
            $numbers = range(6,10);
            shuffle($numbers); // Shuffle to randomize the display

            // Create a question
            $captchaQuestion = "Please select the number: " . $correctAnswer;

               // Pertukaran Kad NO Pengenalan
               $pi_correctAnswer = rand(6,10);
               $pi_numbers = range(6,10);
               shuffle($pi_numbers); 
               // Create a question
               $pi_captchaQuestion = "Please select the number: " . $pi_correctAnswer;
   
               // approval/pindahtempat
               $ap_correctAnswer = rand(6,10);
               $ap_numbers = range(6,10);
               shuffle($ap_numbers); 
               $ap_captchaQuestion = "Please select the number: " . $ap_correctAnswer;
   
   
               // delete cuti
               $dc_correctAnswer = rand(6,10);
               $dc_numbers = range(6,10);
               shuffle($dc_numbers); 
               $dc_captchaQuestion = "Please select the number: " . $dc_correctAnswer;
   
               // peranan
               $peranan_correctAnswer = rand(6,10);
               $peranan_numbers = range(6,10);
               shuffle($peranan_numbers); 
               $peranan_captchaQuestion = "Please select the number: " . $peranan_correctAnswer;
   
           // reset password form
               $rp_correctAnswer = rand(6,10);
               $rp_numbers = range(6,10);
               shuffle($rp_numbers); 
               $rp_captchaQuestion = "Please select the number: " . $rp_correctAnswer;
   
                      
               //others
               $ot_correctAnswer = rand(6,10);
               $ot_numbers = range(6,10);
               shuffle($ot_numbers); 
               $ot_captchaQuestion = "Please select the number: " . $ot_correctAnswer;
   
        

        return view('ssmrequest', compact('jawatanlist','numbers', 'captchaQuestion', 'correctAnswer',
        'pi_numbers', 'pi_captchaQuestion', 'pi_correctAnswer',
        'ap_numbers', 'ap_captchaQuestion', 'ap_correctAnswer',
        'dc_numbers', 'dc_captchaQuestion', 'dc_correctAnswer',
        'peranan_numbers', 'peranan_captchaQuestion', 'peranan_correctAnswer',
        'rp_numbers', 'rp_captchaQuestion', 'rp_correctAnswer',
        'ot_numbers', 'ot_captchaQuestion', 'ot_correctAnswer'
    ));
        }
        

    public function statusopenform(Request $request)
    {
        $prefix = $request->input('prefix');
        $id = $request->input('rujukan');

        if ($prefix == 'BC') {
            $ssm = SSMBakicuti::where('id', $id)->first();

            if ($ssm) {
                $id = $ssm->id;
                $status = $ssm->bc_status ?? 'Aduan Diterima';

                $successMessage = "No. Rujukan: <b>BC$id</b><br>Status: <b>$status</b>";

                return redirect()->route('ssmrequest')->with('success_message', $successMessage);
            } else {
                return redirect()->route('ssmrequest')->with('error_message', 'Rujukan not found');
            }
        }
        elseif ($prefix == 'PKP') {
            $ssm = SSMPertukaranic::where('id', $id)->first();

            if ($ssm) {
                $id = $ssm->id;
                $status = $ssm->pi_status ?? 'Aduan Diterima';

                $successMessage = "No. Rujukan: <b>PKP$id</b><br>Status: <b>$status</b>";

                return redirect()->route('ssmrequest')->with('success_message', $successMessage);
            } else {
                return redirect()->route('ssmrequest')->with('error_message', 'Rujukan not found');
            }
        }
        elseif ($prefix == 'AP') {
            $ssm = SSMApproval::where('id', $id)->first();

            if ($ssm) {
                $id = $ssm->id;
                $status = $ssm->ap_status ?? 'Aduan Diterima';

                $successMessage = "No. Rujukan: <b>AP$id</b><br>Status: <b>$status</b>";

                return redirect()->route('ssmrequest')->with('success_message', $successMessage);
            } else {
                return redirect()->route('ssmrequest')->with('error_message', 'Rujukan not found');
            }
        }
        elseif ($prefix == 'DC') {
            $ssm = SSMDC::where('id', $id)->first();

            if ($ssm) {
                $id = $ssm->id;
                $status = $ssm->dc_status ?? 'Aduan Diterima';

                $successMessage = "No. Rujukan: <b>DC$id</b><br>Status: <b>$status</b>";

                return redirect()->route('ssmrequest')->with('success_message', $successMessage);
            } else {
                return redirect()->route('ssmrequest')->with('error_message', 'Rujukan not found');
            }
        }
        elseif ($prefix == 'PE') {
            $ssm = SSMPeranan::where('id', $id)->first();

            if ($ssm) {
                $id = $ssm->id;
                $status = $ssm->pe_status ?? 'Aduan Diterima';

                $successMessage = "No. Rujukan: <b>PE$id</b><br>Status: <b>$status</b>";

                return redirect()->route('ssmrequest')->with('success_message', $successMessage);
            } else {
                return redirect()->route('ssmrequest')->with('error_message', 'Rujukan not found');
            }
        }
        elseif ($prefix == 'PS') {
            $ssm = SSMPassword::where('id', $id)->first();

            if ($ssm) {
                $id = $ssm->id;
                $status = $ssm->ps_status ?? 'Aduan Diterima';

                $successMessage = "No. Rujukan: <b>PS$id</b><br>Status: <b>$status</b>";

                return redirect()->route('ssmrequest')->with('success_message', $successMessage);
            } else {
                return redirect()->route('ssmrequest')->with('error_message', 'Rujukan not found');
            }
        }
        elseif ($prefix == 'LL') {
            $ssm = SSMOthers::where('id', $id)->first();

            if ($ssm) {
                $name = $ssm->ot_name;
                $id = $ssm->id;
                $status = $ssm->ot_status ?? 'Aduan Diterima';

                $successMessage = "No. Rujukan: <b>LL$id</b><br>Status: <b>$status</b>";

                return redirect()->route('ssmrequest')->with('success_message', $successMessage);
            } else {
                return redirect()->route('ssmrequest')->with('error_message', 'Rujukan not found');
            }
        }
        else {
            return redirect()->route('ssmrequest')->with('error_message', 'Invalid prefix');
        }
    }

    public function index()
    {

        $icNos = Auth::user()->id;

        $ssms = SSMRequest::select('ssmsrequest.*')
            ->orderBy('created_at', 'DESC')
            ->where([
                ['user_id', '=', $icNos]
            ])
            ->get();
            
      


        $departments = Department::pluck('label', 'id')->all();
        return view('ssmrequests.index', compact('ssms', 'departments'));
    }

    //add28dec23
    public function indexpermohonan()
    {
        $ssmpermohonan = SSMPermohonan::select('ssm_permohonan.*')
        ->orderBy('created_at', 'DESC')
        ->get();

        $jenispermohonans = SSMJenisPermohonan::select('ssm_jenispermohonan.*')
        ->orderBy('created_at', 'DESC')
        ->get();

        // Retrieve SSMPermohonanicno records for each SSMPermohonan record
        $ssmpermohonanicno = [];
    
        foreach ($ssmpermohonan as $permohonan) {
            $icnoRecords = SSMPermohonanicno::with('ssmkodindex')
            ->where('permohonan_id', $permohonan->id)
            ->get();

            $ssmpermohonanicno[$permohonan->id] = $icnoRecords;
        }

        return view('ssmrequests.indexpermohonan', compact('ssmpermohonan','ssmpermohonanicno','jenispermohonans'));
    }

    //add28may24
    public function indexstafftasks()
    {

        $ssmkods = SSMKod::with(['permohonanicno' => function($query) {
            $query->orderBy('submitted_at', 'desc');
        }])->withCount(['permohonanicno', 'permohonanicnoSelesai'])
        ->orderBy('kod', 'ASC')
        ->get();

        return view('ssmrequests.indexstafftasks', compact('ssmkods'));
    }

    public function indexstaffpermohonan()
    {

        $icNos = Auth::user()->ic_no;

        $ssmpermohonan = DB::table('ssm_permohonanicno')
            ->join('ssm_permohonan', 'ssm_permohonanicno.permohonan_id', '=', 'ssm_permohonan.id')
            ->where('ssm_permohonanicno.kod', '=', $icNos)
            ->where(function ($query) {
                $query->where('ssm_permohonanicno.status', '!=', 'selesai')
                    ->orWhereNull('ssm_permohonanicno.status')
                    ->orWhere('ssm_permohonanicno.status', '=', 'kiv')
                    ->orWhere('ssm_permohonanicno.status', '=', 'dalam proses');
            })
            ->orderBy('ssm_permohonan.created_at', 'DESC')
            ->get(['ssm_permohonan.*',
            'ssm_permohonanicno.id',
            'ssm_permohonanicno.created_at',
            'ssm_permohonanicno.permohonan_id',
            'ssm_permohonanicno.icno_pemohon',
            'ssm_permohonanicno.status']); //extract two more data
            
        $ssmpermohonanselesai = DB::table('ssm_permohonanicno')
            ->join('ssm_permohonan', 'ssm_permohonanicno.permohonan_id', '=', 'ssm_permohonan.id')
            ->where('ssm_permohonanicno.kod', '=', $icNos)
            ->where('ssm_permohonanicno.status', '=', 'selesai') // Add this line to filter by status
            ->orderBy('ssm_permohonan.created_at', 'DESC')
            ->get(['ssm_permohonan.*',
            'ssm_permohonanicno.id',
            'ssm_permohonanicno.permohonan_id',
            'ssm_permohonanicno.icno_pemohon',
            'ssm_permohonanicno.status']); //extract two more data

            $ssmpermohonansalinans = SSMPermohonanSalinan::select('ssm_permohonansalinan.*')
            ->where('created_by', '=', $icNos)
            ->orderBy('created_at', 'DESC')
            ->get();
        
            // Retrieve SSMPermohonanSalinanicno records for each SSMPermohonanSalinan record
            $ssmpermohonansalinanicno = [];
        
            foreach ($ssmpermohonansalinans as $permohonan) {
                $icnoRecords = SSMPermohonanSalinanicno::with('ssmkodindex')
                ->where('permohonan_id', $permohonan->id)
                ->orderBy('created_at','DESC')
                ->get();

                $ssmpermohonansalinanicno[$permohonan->id] = $icnoRecords;
            }
            

        return view('ssmrequests.indexstaffpermohonan', compact('ssmpermohonan','ssmpermohonanselesai','ssmpermohonansalinans','ssmpermohonansalinanicno'));
    }

    public function indexall()
{
    $oneMonthAgo = \Carbon\Carbon::now()->subMonth();

    // Active statuses per tab
    $defaultStatuses = ['Aduan Diterima', 'Sedang Dikemaskini / Diteliti', 'Dihadapkan ke Dynamik'];
    $dcStatuses = ['Aduan Diterima', 'Sedang Dikemaskini / Diteliti', 'Dihadapkan ke Dynamik', 'Delete', 'Proses'];
    $bakicutiStatuses = ['Pending', 'In Progress']; 
    $pertukaranicStatuses = ['Pending', 'In Progress']; 

    // Approval tab
    $ssmapproval = SSMApproval::where(function($q) use ($oneMonthAgo, $defaultStatuses) {
        $q->where('ap_created_at', '>=', $oneMonthAgo) // Recent records (<1 month)
          ->orWhere(function($q2) use ($oneMonthAgo, $defaultStatuses) {
              $q2->where('ap_created_at', '<', $oneMonthAgo) // Older than 1 month
                 ->where(function($q3) use ($defaultStatuses) {
                     $q3->whereIn('ap_status', $defaultStatuses) // Only active statuses
                        ->orWhereNull('ap_status'); // Include NULL status
                 });
          });
    })->orderBy('ap_created_at', 'DESC')->paginate(1000);

    // Delete Cuti tab
    $ssmdc = SSMDc::where(function($q) use ($oneMonthAgo, $dcStatuses) {
        $q->where('dc_created_at', '>=', $oneMonthAgo)
          ->orWhere(function($q2) use ($oneMonthAgo, $dcStatuses) {
              $q2->where('dc_created_at', '<', $oneMonthAgo)
                 ->where(function($q3) use ($dcStatuses) {
                     $q3->whereIn('dc_status', $dcStatuses)
                        ->orWhereNull('dc_status'); // Include NULL status
                 });
          });
    })->orderBy('dc_created_at', 'DESC')->paginate(1000);

    // Peranan tab
    $ssmperanan = SSMPeranan::where(function($q) use ($oneMonthAgo, $defaultStatuses) {
        $q->where('pe_created_at', '>=', $oneMonthAgo)
          ->orWhere(function($q2) use ($oneMonthAgo, $defaultStatuses) {
              $q2->where('pe_created_at', '<', $oneMonthAgo)
                 ->whereIn('pe_status', $defaultStatuses);
          })
          ->orWhereNull('pe_status'); // Include NULL status
    })->orderBy('pe_created_at', 'DESC')->paginate(1000);

    // Password tab
    $ssmpassword = SSMPassword::where(function($q) use ($oneMonthAgo, $defaultStatuses) {
        $q->where('ps_created_at', '>=', $oneMonthAgo)
          ->orWhere(function($q2) use ($oneMonthAgo, $defaultStatuses) {
              $q2->where('ps_created_at', '<', $oneMonthAgo)
                 ->whereIn('ps_status', $defaultStatuses);
          })
          ->orWhere('ps_status', 'Dihadapkan ke HD') // Include Dihadapkan ke HD
          ->orWhereNull('ps_status'); // Include NULL status
    })->orderBy('ps_created_at', 'DESC')->paginate(1000);

    // Baki Cuti tab
    $ssmbakicuti = SSMBakicuti::where(function($q) use ($oneMonthAgo, $bakicutiStatuses) {
        $q->where('bc_created_at', '>=', $oneMonthAgo)
          ->orWhere(function($q2) use ($oneMonthAgo, $bakicutiStatuses) {
              $q2->where('bc_created_at', '<', $oneMonthAgo)
                 ->whereIn('bc_status', $bakicutiStatuses)
                 ->orWhereNull('bc_status'); // Include NULL status
          });
    })->orderBy('bc_created_at', 'DESC')->paginate(1000);

    // Pertukaran IC tab
    $ssmpertukaranic = SSMPertukaranic::where(function($q) use ($oneMonthAgo, $pertukaranicStatuses) {
        $q->where('pi_created_at', '>=', $oneMonthAgo)
          ->orWhere(function($q2) use ($oneMonthAgo, $pertukaranicStatuses) {
              $q2->where('pi_created_at', '<', $oneMonthAgo)
                 ->where(function($q3) use ($pertukaranicStatuses) {
                     $q3->whereIn('pi_status', $pertukaranicStatuses)
                        ->orWhereNull('pi_status'); // Include NULL status
                 });
          });
    })->orderBy('pi_created_at', 'DESC')->paginate(1000);

    // Others tab
    $ssmother = SSMOthers::where(function($q) use ($oneMonthAgo, $defaultStatuses) {
        $q->where('ot_created_at', '>=', $oneMonthAgo)
          ->orWhere(function($q2) use ($oneMonthAgo, $defaultStatuses) {
              $q2->where('ot_created_at', '<', $oneMonthAgo)
                 ->whereIn('ot_status', $defaultStatuses);
          })
          ->orWhereNull('ot_status'); // Include NULL status
    })->orderBy('ot_created_at', 'DESC')->paginate(1000);

    return view('ssmrequests.indexall', compact(
        'ssmapproval', 'ssmdc', 'ssmperanan', 'ssmpassword', 
        'ssmbakicuti', 'ssmpertukaranic', 'ssmother'
    ));
}

public function archived()
{
    $oneMonthAgo = Carbon::now()->subMonth();

    // Define the models and their corresponding date & status columns
    $tabs = [
        'ssmapprovalArchived'      => ['model' => SSMApproval::class,       'date' => 'ap_created_at', 'status' => 'ap_status'],
        'ssmdeletecutiArchived'    => ['model' => SSMDc::class,            'date' => 'dc_created_at', 'status' => 'dc_status'],
        'ssmperananArchived'       => ['model' => SSMPeranan::class,       'date' => 'pe_created_at', 'status' => 'pe_status'],
        'ssmpasswordArchived'      => ['model' => SSMPassword::class,      'date' => 'ps_created_at', 'status' => 'ps_status'],
        'ssmbakicutiArchived'      => ['model' => SSMBakicuti::class,      'date' => 'bc_created_at', 'status' => 'bc_status'],
        'ssmpertukaranicArchived'  => ['model' => SSMPertukaranic::class,  'date' => 'pi_created_at', 'status' => 'pi_status'],
        'ssmotherArchived'         => ['model' => SSMOthers::class,        'date' => 'ot_created_at', 'status' => 'ot_status'],
    ];

    $archivedData = [];

    foreach ($tabs as $key => $tab) {
        $archivedData[$key] = $tab['model']::where($tab['date'], '<', $oneMonthAgo)
            ->where($tab['status'], 'Selesai')
            ->orderBy($tab['date'], 'DESC')
            ->paginate(1000);
    }

    return view('ssmrequests.archived', array_merge($archivedData, [
        'pagename' => 'Archived SSM Records'
    ]));
}
    
    public function indexallsearch(Request $request)
    {
        $query = $request->input('query');
    
        // Define the columns you want to search in for each table
        $tables = [
            'ssm_approval' => ['id', 'ap_name', 'ap_icno', 'ap_approvername', 'ap_approvericno', 'ap_catatan', 'ap_created_at', 'ap_status'],
            'ssm_others' => ['ot_name', 'ot_icno', 'ot_jawatan', 'ot_notel', 'ot_created_at', 'ot_catatan', 'ot_status'],
            'ssm_dc' => ['dc_name', 'dc_icno', 'dc_jawatan', 'dc_datedelete', 'dc_dateaduan', 'dc_catatan', 'dc_status'],
            'ssm_password' => ['ps_name', 'ps_icno', 'ps_jawatan', 'ps_otp', 'ps_created_at', 'ps_catatan', 'ps_status'],
            'ssm_peranan' => ['pe_name', 'pe_icno', 'pe_jawatan', 'pe_email', 'pe_created_by', 'pe_catatan', 'pe_status'],
            'ssm_pertukaranic' => ['pi_name', 'pi_icno_old', 'pi_jawatan', 'pi_created_at', 'pi_catatanuser', 'pi_catatanadmin', 'pi_status'],
            'ssm_bakicuti' => ['bc_name', 'bc_icno', 'bc_jawatan', 'bc_workplace', 'bc_created_at', 'bc_catatanuser', 'bc_catatanadmin', 'bc_status']
        ];
    // Declare individual variables for each table's search results
    $resultsssmapproval = collect();
    $resultsssmother = collect();
    $resultsssmpertukaranic = collect();
    $resultsssmbakicuti = collect();
    $resultsssmpassword = collect();
    $resultsssmperanan = collect();
    $resultsssmdc = collect();

    // Search for ssm_approval
    $resultsssmapproval = DB::table('ssm_approval')->where(function ($queryBuilder) use ($query) {
        $columns = ['ap_name', 'ap_icno', 'ap_approvername', 'ap_approvericno', 'ap_catatan', 'ap_created_at', 'ap_status'];
        foreach ($columns as $column) {
            $queryBuilder->orWhere($column, 'LIKE', '%' . $query . '%');
        }
    })->orderBy('ap_created_at', 'DESC')->paginate(500);

    // Search for ssm_others
    $resultsssmother = DB::table('ssm_others')->where(function ($queryBuilder) use ($query) {
        $columns = ['ot_name', 'ot_icno', 'ot_jawatan', 'ot_notel', 'ot_created_at', 'ot_catatan', 'ot_status'];
        foreach ($columns as $column) {
            $queryBuilder->orWhere($column, 'LIKE', '%' . $query . '%');
        }
    })->orderBy('ot_created_at', 'DESC')->paginate(500);

    // Search for ssm_pertukaranic
    $resultsssmpertukaranic = DB::table('ssm_pertukaranic')->where(function ($queryBuilder) use ($query) {
        $columns = ['pi_name', 'pi_icno_old', 'pi_jawatan', 'pi_created_at', 'pi_catatanuser', 'pi_catatanadmin', 'pi_status'];
        foreach ($columns as $column) {
            $queryBuilder->orWhere($column, 'LIKE', '%' . $query . '%');
        }
    })->orderBy('pi_created_at', 'DESC')->paginate(500);

    // Search for ssm_bakicuti
    $resultsssmbakicuti = DB::table('ssm_bakicuti')->where(function ($queryBuilder) use ($query) {
        $columns = ['bc_name', 'bc_icno', 'bc_jawatan', 'bc_workplace', 'bc_created_at', 'bc_catatanuser', 'bc_catatanadmin', 'bc_status'];
        foreach ($columns as $column) {
            $queryBuilder->orWhere($column, 'LIKE', '%' . $query . '%');
        }
    })->orderBy('bc_created_at', 'DESC')->paginate(500);

    // Search for ssm_password
    $resultsssmpassword = DB::table('ssm_password')->where(function ($queryBuilder) use ($query) {
        $columns = ['ps_name', 'ps_icno', 'ps_jawatan', 'ps_otp', 'ps_created_at', 'ps_catatan', 'ps_status'];
        foreach ($columns as $column) {
            $queryBuilder->orWhere($column, 'LIKE', '%' . $query . '%');
        }
    })->orderBy('ps_created_at', 'DESC')->paginate(500);

    // Search for ssm_peranan
    $resultsssmperanan = DB::table('ssm_peranan')->where(function ($queryBuilder) use ($query) {
        $columns = ['pe_name', 'pe_icno', 'pe_jawatan', 'pe_email', 'pe_created_by', 'pe_catatan', 'pe_status'];
        foreach ($columns as $column) {
            $queryBuilder->orWhere($column, 'LIKE', '%' . $query . '%');
        }
    })->orderBy('pe_created_at', 'DESC')->paginate(500);

    // Search for ssm_deletecuti
    $resultsssmdc = DB::table('ssm_dc')->where(function ($queryBuilder) use ($query) {
        $columns = ['dc_name', 'dc_icno', 'dc_jawatan', 'dc_datedelete', 'dc_dateaduan', 'dc_catatan', 'dc_status'];
        foreach ($columns as $column) {
            $queryBuilder->orWhere($column, 'LIKE', '%' . $query . '%');
        }
    })->orderBy('dc_datedelete', 'DESC')->paginate(500);

    // Return view with the results
    return view('ssmrequests.indexallsearch', [
        'resultsssmapproval' => $resultsssmapproval,
        'resultsssmother' => $resultsssmother,
        'resultsssmpertukaranic' => $resultsssmpertukaranic,
        'resultsssmbakicuti' => $resultsssmbakicuti,
        'resultsssmpassword' => $resultsssmpassword,
        'resultsssmperanan' => $resultsssmperanan,
        'resultsssmdc' => $resultsssmdc
    ]);
}
    

    


    /**
     * Display a listing of the Biodata applications.
     *
     * @return Illuminate\View\View
     */

    public function editadmin($id)
    {
        $icNos = Auth::user()->ic_no;

        $ssmsreq = SSMRequest::all()
        ->where('id', '=', $id);
//         $ssms = SSMRequest::all()->where('id', '=', $id)->first();


        //  $icNos = $ssms->ic;

        $biodata = Biodata::select('biodatas.*')
            ->where('ic_no', $icNos)
            ->first();

        $biodatas = Biodata::all()
            ->where('ic_no', '=', $icNos);
        $contacts = Contact::all()
            ->where('ic_no', '=', $icNos);
        $employments = Employment::all()
            ->where('ic_no', '=', $icNos);
        $educations = Education::all()
            ->where('ic_no', '=', $icNos);
        $performances = Performance::all()
            ->where('ic_no', '=', $icNos);
        $medals = Medal::all()
            ->where('ic_no', '=', $icNos);
        $salarys = Salary::all()
            ->where('ic_no', '=', $icNos);
        $certificates = Certificate::all()
            ->where('ic_no', '=', $icNos);
        $exams = Exam::all()
            ->where('ic_no', '=', $icNos);
        $programmes = Programme::all()
            ->where('ic_no', '=', $icNos);
        $paperworks = Paperwork::all()
            ->where('ic_no', '=', $icNos);
        $courses = Course::all()
            ->where('ic_no', '=', $icNos);

        $files = File::all()
            ->where('ic_no', '=', $icNos);

        $ssms = SSM::all()
            ->where('ic_no', '=', $icNos);

        $bersaras = Bersara::all()
            ->where('ic_no', '=', $icNos);

    
        $school = Employment::leftjoin('departments', 'emp_employment_infos.school_id', '=', 'departments.code')
            ->select('departments.label as school_name')
            ->where('emp_employment_infos.ic_no', $icNos)
            ->first();


        return view('ssmrequests.editadmin', compact('biodata', 'school', 'salarys', 'biodatas', 'contacts', 'employments', 'educations', 'performances', 'medals', 'certificates', 'exams', 'programmes', 'paperworks', 'courses', 'files', 'ssmsreq', 'bersaras'));

        
    }

    public function editadminapproval($id)
    {
        $icNos = Auth::user()->ic_no;

        $ssmapproval = SSMApproval::all()
        ->where('id', '=', $id);

    $jawatanlist =Jawatanlist::pluck('label','id')->all();

        

        return view('ssmrequests.editadminapproval', compact('ssmapproval','jawatanlist'));

    }

    // ekma add28dec23

    public function editadminpermohonan($id)
    {
        $icNos = Auth::user()->ic_no;

    
        $ssmpermohonan = SSMPermohonan::with(['ssmkod', 'selesaikod'])->where('id', $id)->get();

        $ssmpermohonanicno = SSMPermohonanicno::with('ssmkod')
        ->where('permohonan_id', '=', $id)
        ->get();

        //  $ssmpermohonanicno = SSMPermohonanicno::all()
        //  ->where('permohonan_id', '=', $id);

        $ssmkod = SSMKod::select('ssm_kod.*')->orderBy('kod', 'DESC')->get();
        $departments = Department::pluck('label', 'label')->all();
        $jenispermohonans = SSMJenisPermohonan::pluck('label', 'id')->all();

        return view('ssmrequests.editadminpermohonan', compact('ssmpermohonan','ssmpermohonanicno','ssmkod','departments', 'jenispermohonans'));

    }

    // ekma add 28dec23
    public function editstaffpermohonan($id)
    {
        $icNos = Auth::user()->ic_no;

        $ssmpermohonan = SSMPermohonan::all()
        ->where('id', '=', $id);

        $ssmpermohonanicno = SSMPermohonanicno::all()
        ->where('permohonan_id', '=', $id);

        $ssmkod = SSMKod::select('ssm_kod.*')->orderBy('kod', 'DESC')->get();
        
        $departments = Department::pluck('label', 'label')->all();

        $jenispermohonans = SSMJenisPermohonan::pluck('label', 'id')->all();

        return view('ssmrequests.editstaffpermohonan', compact('jenispermohonans', 'ssmpermohonan','ssmpermohonanicno','ssmkod','departments'));

    }


    
    public function editadminpertukaranic($id)
    {
        $icNos = Auth::user()->ic_no;

        $ssmpertukaranic = SSMPertukaranic::all()
        ->where('id', '=', $id);

        $jawatanlist =Jawatanlist::pluck('label','id')->all();



        

        return view('ssmrequests.editadminpertukaranic', compact('ssmpertukaranic','jawatanlist'));

    }


    public function editadminbakicuti($id)
    {

        $ssmbakicuti = SSMBakicuti::all()
        ->where('id', '=', $id);

        $jawatanlist =Jawatanlist::pluck('label','id')->all();


        

        return view('ssmrequests.editadminbakicuti', compact('ssmbakicuti','jawatanlist'));

    }

        public function editadminother($id)
    {
        $icNos = Auth::user()->ic_no;

        $ssmother = SSMOthers::all()
        ->where('id', '=', $id);

        $jawatanlist =Jawatanlist::pluck('label','id')->all();


        return view('ssmrequests.editadminother', compact('ssmother','jawatanlist'));

    }

    public function editadmindc($id)
    {
        $icNos = Auth::user()->ic_no;

        $ssmdc = SSMDc::all()
        ->where('id', '=', $id);

        $jawatanlist =Jawatanlist::pluck('label','id')->all();

        

        return view('ssmrequests.editadmindc', compact('ssmdc','jawatanlist'));

    }

    public function editadminperanan($id)
    {
        $icNos = Auth::user()->ic_no;

        $ssmperanan = SSMPeranan::all()
        ->where('id', '=', $id);

        $jawatanlist =Jawatanlist::pluck('label','id')->all();
        

        return view('ssmrequests.editadminperanan', compact('ssmperanan','jawatanlist'));

    }

        public function editadminpassword($id)
    {
        $icNos = Auth::user()->ic_no;

        $ssmpassword = SSMPassword::all()
        ->where('id', '=', $id);

            $jawatanlist =Jawatanlist::pluck('label','id')->all();

        

        return view('ssmrequests.editadminpassword', compact('ssmpassword','jawatanlist'));

    }


    // public function editadmin($id)
    // {
    //     $icNos = Auth::user()->ic_no;


    //     $ssms = SSMRequest::all()->where('id', '=', $id)->first();

    //     $icNos = $ssms->ic;

    //     $biodata = Biodata::select('biodatas.*')
    //         ->where('ic_no', $icNos)
    //         ->first();

    //     $biodatas = Biodata::all()
    //         ->where('ic_no', '=', $icNos);
    //     $contacts = Contact::all()
    //         ->where('ic_no', '=', $icNos);
    //     $employments = Employment::all()
    //         ->where('ic_no', '=', $icNos);
    //     $educations = Education::all()
    //         ->where('ic_no', '=', $icNos);
    //     $performances = Performance::all()
    //         ->where('ic_no', '=', $icNos);
    //     $medals = Medal::all()
    //         ->where('ic_no', '=', $icNos);
    //     $salarys = Salary::all()
    //         ->where('ic_no', '=', $icNos);
    //     $certificates = Certificate::all()
    //         ->where('ic_no', '=', $icNos);
    //     $exams = Exam::all()
    //         ->where('ic_no', '=', $icNos);
    //     $programmes = Programme::all()
    //         ->where('ic_no', '=', $icNos);
    //     $paperworks = Paperwork::all()
    //         ->where('ic_no', '=', $icNos);
    //     $courses = Course::all()
    //         ->where('ic_no', '=', $icNos);

    //     $files = File::all()
    //         ->where('ic_no', '=', $icNos);

    //     $ssms = SSMRequest::all()
    //         ->where('ic', '=', $icNos);

    //     $bersaras = Bersara::all()
    //         ->where('ic_no', '=', $icNos);

    
    //     $school = Employment::leftjoin('departments', 'emp_employment_infos.school_id', '=', 'departments.code')
    //         ->select('departments.label as school_name')
    //         ->where('emp_employment_infos.ic_no', $icNos)
    //         ->first();

            

            

    //     return view('ssmrequests.editadmin', compact('biodata', 'school', 'salarys', 'biodatas', 'contacts', 'employments', 'educations', 'performances', 'medals', 'certificates', 'exams', 'programmes', 'paperworks', 'courses', 'files', 'ssms', 'bersaras'));

        


    // }
    


    public function show($id)
    {
        $ssmsshow = SSMRequest::all()
        ->where('id', '=', $id);
//         $ssms = SSMRequest::all()->where('id', '=', $id)->first();

        $icNos = Auth::user()->ic_no;

        $biodata = Biodata::select('biodatas.*')
            ->where('ic_no', $icNos)
            ->first();

        $biodatas = Biodata::all()
            ->where('ic_no', '=', $icNos);
        $contacts = Contact::all()
            ->where('ic_no', '=', $icNos);
        $employments = Employment::all()
            ->where('ic_no', '=', $icNos);
        $educations = Education::all()
            ->where('ic_no', '=', $icNos);
        $performances = Performance::all()
            ->where('ic_no', '=', $icNos);
        $medals = Medal::all()
            ->where('ic_no', '=', $icNos);
        $salarys = Salary::all()
            ->where('ic_no', '=', $icNos);
        $certificates = Certificate::all()
            ->where('ic_no', '=', $icNos);
        $exams = Exam::all()
            ->where('ic_no', '=', $icNos);
        $programmes = Programme::all()
            ->where('ic_no', '=', $icNos);
        $paperworks = Paperwork::all()
            ->where('ic_no', '=', $icNos);
        $courses = Course::all()
            ->where('ic_no', '=', $icNos);

        $ssms = SSM::all()
            ->where('ic_no', '=', $icNos);

        $files = File::all()
            ->where('ic_no', '=', $icNos);

        $school = Employment::leftjoin('departments', 'emp_employment_infos.school_id', '=', 'departments.code')
            ->select('departments.label as school_name')
            ->where('emp_employment_infos.ic_no', $icNos)
            ->first();

        return view('ssmrequests.show', compact('ssmsshow', 'biodata', 'school', 'salarys', 'biodatas', 'contacts', 'employments', 'educations', 'performances', 'medals', 'certificates', 'exams', 'programmes', 'paperworks', 'courses', 'ssms', 'files'));
    }


    public function create()
    {
        $id_user = Auth::user()->id;
        $user_id = SSMRequest::leftJoin('users', 'ssmsrequest.user_id' , '=', 'users.id')
        ->where('users.id', '=', $id_user)
        ->select('users.*', 'users.id')
        ->get();

        $departments = Department::pluck('id', 'label')->all();
    

        $jawatanlist =Jawatanlist::pluck('label','id')->all();

        return view('ssmrequests.create', compact('departments','user_id','jawatanlist'));
    }

    public function createpermohonan()
    {
        $jenispermohonans = SSMJenisPermohonan::pluck('label', 'id')->all();
        $jawatanlist =Jawatanlist::pluck('label','id')->all();
        $departments = Department::pluck('label', 'id')->all();
        $ssmkod = SSMKod::select('ssm_kod.*')->orderBy('kod', 'DESC')->get();

        return view('ssmrequests.createpermohonan', compact('jawatanlist','ssmkod','departments','jenispermohonans'));
    }

    public function storeapproval(Request $request)
    {

        $now = Carbon::now();
        $icNos = Auth::user()->ic_no;

        // Store data in ssm_approval database
    
                $ssmapproval = new SSMApproval();
                $ssmapproval->ap_name = $request->ap_name;
                $ssmapproval->ap_icno = $request->ap_icno;
                $ssmapproval->ap_jawatan = $request->ap_jawatan;
                $ssmapproval->ap_email = $request->ap_email;
                $ssmapproval->ap_notel = $request->ap_notel;
                $ssmapproval->ap_workplace = $request->ap_workplace;
                $ssmapproval->ap_approvername = $request->ap_approvername;
                $ssmapproval->ap_approvericno = $request->ap_approvericno;
                $ssmapproval->ap_catatan = $request->ap_catatan;
                $ssmapproval->ap_created_at = $now;
                $ssmapproval->ap_created_by = $icNos; //to track who inserted the data
                $ssmapproval->save();

                // Get the last inserted ID using the database connection
                $latestId = $ssmapproval->getConnection()->getPdo()->lastInsertId();

                //MAIL Function approval
                $notf_userEmail = $request->ap_email;
                $notf_Nama = $request->ap_name;
                $notf_latestID = $latestId;

                Mail::to($notf_userEmail)->send(new EmailSSMApproval($notf_Nama, $notf_latestID));

                // Send WhatsApp message after successful submission
                $this->sendWhatsAppMessagesubapproval($request->ap_notel, $request->ap_name, $latestId);

                return redirect()->route('ssmrequests.ssmrequest.indexall')
                                    ->with('error_message', 'Please fill in the required fields for SSM Approval');

                    }


                // Function to send WhatsApp message
                        private function sendWhatsAppMessagesubapproval($telMobilesubap, $apname, $latestId)
                        {
                            // Adjust the parameters according to your template and use case
                            $data = [
                                'phone' => "+673" . $telMobilesubap,
                                'template' => 'ssm_sub_ap',
                                'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8',
                                'language' => ['code' => 'ms', 'policy' => 'deterministic'],
                                "params" => [["type" => "body", "parameters" => [["type" => "text", "text" => $apname], ["type" => "text", "text" =>$latestId]]]],
                            ];

                            $json = json_encode($data);
                            $token = '7hpe9bwi2bl1k5ja';
                            $instanceId = '448643';
                            $url = 'http://moe.proxy.mesh/' . $instanceId . '/sendTemplate?token=' . $token;
                            $options = stream_context_create(['http' => ['method' => 'POST', 'header' => 'Content-type: application/json', 'content' => $json]]);
                            $result = file_get_contents($url, false, $options);

                            // Handle the result if needed
                            // For example, you can log the result or perform other actions based on the response
                        }
                    

// Added by Amal 'Izzah (PB)

public function storeapprovalopenform(Request $request)
{

    // captcha condition
            // Validate that the captcha and correctAnswer inputs are present
            $request->validate([
                'ap_captcha' => 'required',
                'ap_correctAnswer' => 'required',
            ]);
    
            // Get the user's selected captcha and the correct answer from the form
            $userCaptcha = $request->input('ap_captcha');
            $ap_correctAnswer = $request->input('ap_correctAnswer');
    
            // Check if the user's answer matches the correct answer
            if ($userCaptcha != $ap_correctAnswer) {
                // Return with error if it doesn't match
                return redirect()->back()->withErrors(['ap_captcha' => 'Invalid Approval/Berpindah Tempat Bertugas captcha answer. Please try again.'])->withInput();
            }
         // end captcha conditon
                
    $now = Carbon::now();
                
    // Store data in ssm_approval database
                    
    $ssmapproval = new SSMApproval();
    $ssmapproval->ap_name = $request->ap_name;
    $ssmapproval->ap_icno = $request->ap_icno;
    $ssmapproval->ap_jawatan = $request->ap_jawatan;
    $ssmapproval->ap_email = $request->ap_email;
    $ssmapproval->ap_notel = $request->ap_notel;
    $ssmapproval->ap_workplace = $request->ap_workplace;
    $ssmapproval->ap_approvername = $request->ap_approvername;
    $ssmapproval->ap_approvericno = $request->ap_approvericno;
    $ssmapproval->ap_catatan = $request->ap_catatan;
    $ssmapproval->ap_created_at = $now;
    $ssmapproval->save();

    // Get the last inserted ID using the database connection
    $latestId = $ssmapproval->getConnection()->getPdo()->lastInsertId();

    // Get the last inserted ID using the database connection
    $latestId = $ssmapproval->getConnection()->getPdo()->lastInsertId();

    //MAIL Function approval
    $notf_userEmail = $request->ap_email;
    $notf_Nama = $request->ap_name;
    $notf_latestID = $latestId;

    Mail::to($notf_userEmail)->send(new EmailSSMApproval($notf_Nama, $notf_latestID));

    // Send WhatsApp message after successful submission
    $this->sendWhatsAppMessagesubapproval($request->ap_notel, $request->ap_name, $latestId);

    //For Notification of success message
    $apname = $request -> ap_name;
    $apicno = $request -> ap_icno;
    $apid =  $ssmapproval->getConnection()->getPdo()->lastInsertId();

    $successMessage = "Permohonan telah berjaya dihantar! Sila rujuki Whatsapp/Email untuk maklumat lanjut. </br></br> <center><b>$apname ($apicno)</b> </br> Rujukan: <b>AP$apid</b></center>";

    return redirect()->route('ssmrequest')
    ->with('success_message', $successMessage);

    }
                
                
        // Function to send WhatsApp message
        private function sendWhatsAppMessagesubapprovalopenform($telMobilesubap, $apname, $latestId)
        {
            // Adjust the parameters according to your template and use case
            $data = [
                'phone' => "+673" . $telMobilesubap,
                'template' => 'ssm_sub_ap',
                'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8',
                'language' => ['code' => 'ms', 'policy' => 'deterministic'],
                "params" => [["type" => "body", "parameters" => [["type" => "text", "text" => $apname], ["type" => "text", "text" =>$latestId]]]],
            ];
                
            $json = json_encode($data);
            $token = '7hpe9bwi2bl1k5ja';
            $instanceId = '448643';
            $url = 'http://moe.proxy.mesh/' . $instanceId . '/sendTemplate?token=' . $token;
            $options = stream_context_create(['http' => ['method' => 'POST', 'header' => 'Content-type: application/json', 'content' => $json]]);
            $result = file_get_contents($url, false, $options);
                
            // Handle the result if needed
            // For example, you can log the result or perform other actions based on the response
        }    

    public function storedcopenform(Request $request)
    {

         // captcha condition
            // Validate that the captcha and correctAnswer inputs are present
            $request->validate([
                'dc_captcha' => 'required',
                'dc_correctAnswer' => 'required',
            ]);
    
            // Get the user's selected captcha and the correct answer from the form
            $userCaptcha = $request->input('dc_captcha');
            $dc_correctAnswer = $request->input('dc_correctAnswer');
    
            // Check if the user's answer matches the correct answer
            if ($userCaptcha != $dc_correctAnswer) {
                // Return with error if it doesn't match
                return redirect()->back()->withErrors(['dc_captcha' => 'Invalid Delete Cuti captcha answer. Please try again.'])->withInput();
            }
         // end captcha conditon

    
        $now = Carbon::now();
                    
                // Store data in ssm_dc database
        
                $ssmdc = new SSMDc();
                $ssmdc->dc_name = $request->dc_name;
                $ssmdc->dc_icno = $request->dc_icno;
                $ssmdc->dc_jawatan = $request->dc_jawatan;
                $ssmdc->dc_email = $request->dc_email;
                $ssmdc->dc_notel = $request->dc_notel;
                $ssmdc->dc_datedelete = $request->dc_datedelete;
                $ssmdc->dc_dateaduan = $request->dc_dateaduan;
                $ssmdc->dc_catatan = $request->dc_catatan;
            
                $ssmdc->dc_created_at = $now;
            
        // Handle uploaded images
        if ($request->hasFile('dc_file')) {
            $uploadedFiles = [];
    
            foreach ($request->file('dc_file') as $file) {
                // Validate and store each file
                $filename = $file->getClientOriginalName();
                $path = $file->storeAs('public/ssmdc', $filename);
    
                $uploadedFiles[] = $filename;
            }
    
            // Store $uploadedFiles in your database or perform any other actions
            $ssmdc->dc_file = $uploadedFiles;
        }
    
            $ssmdc->save();

            // Get the last inserted ID using the database connection
            $latestId = $ssmdc->getConnection()->getPdo()->lastInsertId();

            // Send WhatsApp message after successful submission
            $this->sendWhatsAppMessagesubdc($request->dc_notel, $request->dc_name, $latestId);

            //For Notification of success message
            $dcname = $request -> dc_name;
            $dcicno = $request -> dc_icno;
            $dcid =  $ssmdc->getConnection()->getPdo()->lastInsertId();

            $successMessage = "Permohonan telah berjaya dihantar! Sila rujuki Whatsapp/Email untuk maklumat lanjut. </br></br> <center><b>$dcname ($dcicno)</b> </br> Rujukan: <b>DC$dcid</b></center>";

            return redirect()->route('ssmrequest')
            ->with('success_message', $successMessage);
                    }
                
public function storepsopenform(Request $request)
{

    // captcha condition
            // Validate that the captcha and correctAnswer inputs are present
            $request->validate([
                'rp_captcha' => 'required',
                'rp_correctAnswer' => 'required',
            ]);
    
            // Get the user's selected captcha and the correct answer from the form
            $userCaptcha = $request->input('rp_captcha');
            $rp_correctAnswer = $request->input('rp_correctAnswer');
    
            // Check if the user's answer matches the correct answer
            if ($userCaptcha != $rp_correctAnswer) {
                // Return with error if it doesn't match
                return redirect()->back()->withErrors(['rp_captcha' => 'Invalid Reset Password captcha answer. Please try again.'])->withInput();
            }
         // end captcha conditon
                    

    $now = Carbon::now();
                    
        // Store data in ssm_password database
        
            $ssmpassword = new SSMPassword();
            $ssmpassword->ps_name = $request->ps_name;
            $ssmpassword->ps_icno = $request->ps_icno;
            $ssmpassword->ps_jawatan = $request->ps_jawatan;
            $ssmpassword->ps_workplace = $request->ps_workplace;
            $ssmpassword->ps_email = $request->ps_email;
            $ssmpassword->ps_notel = $request->ps_notel;
            $ssmpassword->ps_otp = $request->ps_otp;
            $ssmpassword->ps_catatan = $request->ps_catatan;
            $ssmpassword->ps_created_at = $now;
            $ssmpassword->save();

            // Get the last inserted ID using the database connection
            $latestId = $ssmpassword->getConnection()->getPdo()->lastInsertId();

            //MAIL Function reset password
            $notf_userEmail = $request->ps_email;
            $notf_Nama = $request->ps_name;
            $notf_latestID = $latestId;

            Mail::to($notf_userEmail)->send(new EmailSSMResetPassword($notf_Nama, $notf_latestID));
                
            // Send WhatsApp message after successful submission
            $this->sendWhatsAppMessagesubps($request->ps_notel, $request->ps_name, $latestId);

            //For Notification of success message
            $psname = $request -> ps_name;
            $psicno = $request -> ps_icno;
            $psid =  $ssmpassword->getConnection()->getPdo()->lastInsertId();

            $successMessage = "Permohonan telah berjaya dihantar! Sila rujuki Whatsapp/Email untuk maklumat lanjut. </br></br> <center><b>$psname ($psicno)</b> </br> Rujukan: <b>PS$psid</b></center>";

            return redirect()->route('ssmrequest')
            ->with('success_message', $successMessage);
}

            // Function to send WhatsApp message
        private function sendWhatsAppMessagesubpsopenform($telMobilesubps, $psname, $latestId)
        {
        // Adjust the parameters according to your template and use case
        $data = [
            'phone' => "+673" . $telMobilesubps,
            'template' => 'ssm_sub_pass',
            'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8',
            'language' => ['code' => 'ms', 'policy' => 'deterministic'],
            "params" => [["type" => "body", "parameters" => [["type" => "text", "text" => $psname], ["type" => "text", "text" =>$latestId]]]],
        ];
                            
        $json = json_encode($data);
        $token = '7hpe9bwi2bl1k5ja';
        $instanceId = '448643';
        $url = 'http://moe.proxy.mesh/' . $instanceId . '/sendTemplate?token=' . $token;
        $options = stream_context_create(['http' => ['method' => 'POST', 'header' => 'Content-type: application/json', 'content' => $json]]);
        $result = file_get_contents($url, false, $options);
                            
        // Handle the result if needed
        // For example, you can log the result or perform other actions based on the response
        }              
    
   public function storepeopenform(Request $request)
    {

          // captcha condition
            // Validate that the captcha and correctAnswer inputs are present
            $request->validate([
                'peranan_captcha' => 'required',
                'peranan_correctAnswer' => 'required',
            ]);
    
            // Get the user's selected captcha and the correct answer from the form
            $userCaptcha = $request->input('peranan_captcha');
            $peranan_correctAnswer = $request->input('peranan_correctAnswer');
    
            // Check if the user's answer matches the correct answer
            if ($userCaptcha != $peranan_correctAnswer) {
                // Return with error if it doesn't match
                return redirect()->back()->withErrors(['peranan_captcha' => 'Invalid Peranan captcha answer. Please try again.'])->withInput();
            }
         // end captcha conditon

        $now = Carbon::now();

        foreach ($request->moreDataPe as $key => $data) {
            $data['pe_created_at'] = $now;
            
            $createdRecord= SSMPeranan::create($data);

            $latestId = $createdRecord->getConnection()->getPdo()->lastInsertId();

            Mail::to($data['pe_email'])->send(new EmailSSMPeranan($data['pe_name'], $latestId));
    
            // Send WhatsApp message after successful submission
            $this->sendWhatsAppMessagesubpe($data['pe_notel'], $data['pe_name'], $latestId);
        }
        // // $now = Carbon::now();
    
    
        // //     $pe = new SSMPeranan(); // Assuming "PE" is the model for the "pe" table
        // //     $pe->pe_name = $request->pe_name;
        // //     $pe->pe_icno = $request->pe_icno;
        // //     $pe->pe_jawatan = $request->pe_jawatan;
        // //     $pe->pe_email = $request->pe_email;
        // //     $pe->pe_notel = $request->pe_notel;
        // //     $pe->pe_peranan = $request->pe_peranan; // Adjust according to your database structure
        // //     $pe->pe_catatan = $request->pe_catatan;
        // //     $pe->pe_status = $request->pe_status; // Adjust according to your database structure
        // //     $pe->pe_created_at = $now;
        // //     $pe->save();

        // //     // Get the last inserted ID using the database connection
        // //     $latestId = $pe->getConnection()->getPdo()->lastInsertId();

        // //     //MAIL Function peranan
        // //     $notf_userEmail = $request->pe_email;
        // //     $notf_Nama = $request->pe_name;
        // //     $notf_latestID = $latestId;

        // //     Mail::to($notf_userEmail)->send(new EmailSSMPeranan($notf_Nama, $notf_latestID));
    
        // //     // Send WhatsApp message after successful submission
        // //     $this->sendWhatsAppMessagesubpe($request->pe_notel, $request->pe_name, $latestId);
    
        //     //For Notification of success message
        //     $pename = $request -> pe_name;
        //     $peicno = $request -> pe_icno;
        //     $peid =  $pe->getConnection()->getPdo()->lastInsertId();

            $successMessage = "Permohonan telah berjaya dihantar! Sila rujuki Whatsapp/Email untuk maklumat lanjut. </br></br>";

            return redirect()->route('ssmrequest')
            ->with('success_message', $successMessage);
    
    }
    
    // Function to send WhatsApp message
        private function sendWhatsAppMessagesubpeopenform($telMobilesubpe, $pename, $latestId)
        {
            // Adjust the parameters according to your template and use case
            $data = [
                'phone' => "+673" . $telMobilesubpe,
                'template' => 'ssm_sub_peranan',
                'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8',
                'language' => ['code' => 'ms', 'policy' => 'deterministic'],
                "params" => [["type" => "body", "parameters" => [["type" => "text", "text" => $pename], ["type" => "text", "text" =>$latestId]]]],
            ];
    
            $json = json_encode($data);
            $token = '7hpe9bwi2bl1k5ja';
            $instanceId = '448643';
            $url = 'http://moe.proxy.mesh/' . $instanceId . '/sendTemplate?token=' . $token;
            $options = stream_context_create(['http' => ['method' => 'POST', 'header' => 'Content-type: application/json', 'content' => $json]]);
            $result = file_get_contents($url, false, $options);
    
            // Handle the result if needed
            // For example, you can log the result or perform other actions based on the response
        }

        public function storeotopenform(Request $request)
        {

              // captcha condition
            // Validate that the captcha and correctAnswer inputs are present
            $request->validate([
                'ot_captcha' => 'required',
                'ot_correctAnswer' => 'required',
            ]);
    
            // Get the user's selected captcha and the correct answer from the form
            $userCaptcha = $request->input('ot_captcha');
            $ot_correctAnswer = $request->input('ot_correctAnswer');
    
            // Check if the user's answer matches the correct answer
            if ($userCaptcha != $ot_correctAnswer) {
                // Return with error if it doesn't match
                return redirect()->back()->withErrors(['ot_captcha' => 'Invalid Others captcha answer. Please try again.'])->withInput();
            }
         // end captcha conditon
    
    
            $now = Carbon::now();
    
                // Store data in ssm_others database            
                $ssmothers = new SSMOthers();
                $ssmothers->ot_name = $request->ot_name;
                $ssmothers->ot_icno = $request->ot_icno;
                $ssmothers->ot_jawatan = $request->ot_jawatan;
                $ssmothers->ot_workplace = $request->ot_workplace;
                $ssmothers->ot_email = $request->ot_email;
                $ssmothers->ot_notel = $request->ot_notel;
                $ssmothers->ot_catatan = $request->ot_catatan;
                $ssmothers->ot_created_at = $now;
                $ssmothers->save();

                //For Notification of success message
                $otname = $request -> ot_name;
                $oticno = $request -> ot_icno;
                $otid =  $ssmothers->getConnection()->getPdo()->lastInsertId();

                $successMessage = "Permohonan telah berjaya dihantar!</br></br> <center><b>$otname ($oticno)</b> </br> Rujukan: <b>LL$otid</b></center>";

                return redirect()->route('ssmrequest')
                ->with('success_message', $successMessage);
        }
                                    
    // ====================================================================================================

    public function storepermohonan(Request $request)
    {

    
        $now = Carbon::now();
        $icNos = Auth::user()->ic_no;
                    
                // Store data in ssm_dc database
        
                $ssmpermohonan = new SSMPermohonan();
                $ssmpermohonan->permohonan_type = $request->permohonan_type;
                $ssmpermohonan->permohonan_date = $request->permohonan_date;
                $ssmpermohonan->permohonan_dept = $request->permohonan_dept;
                $ssmpermohonan->permohonan_jabsch = $request->permohonan_jabsch;
                $ssmpermohonan->permohonan_catatan = $request->permohonan_catatan;


                $ssmpermohonan->created_at = $now;
                $ssmpermohonan->created_by = $icNos;
            
            // Handle uploaded images
                    if ($request->hasFile('permohonan_file')) {
                        $uploadedFiles = [];
                
                        foreach ($request->file('permohonan_file') as $file) {
                            // Validate and store each file
                            $filename = $file->getClientOriginalName();
                            $path = $file->storeAs('public/ssmpermohonan', $filename);
                
                            $uploadedFiles[] = $filename;
                        }
                
                        // Store $uploadedFiles in your database or perform any other actions
                        $ssmpermohonan->permohonan_file = $uploadedFiles;
                    }
                
                    $ssmpermohonan->save();

                    // method to take previous ID
                        $data1 = SSMPermohonan::select('ssm_permohonan.*')
                        ->orderBy('created_at', 'DESC')
                        ->first();

                        $data2 = $data1->id;

                    
                        $icno = $request->icno_pemohon;
                        $kod = $request->kod;
                    
                        if (!empty($request->icno) && is_array($icno) || !empty($request->kod) && is_array($kod)) {

                            $insert_data_1 = []; // Initialize the array before the loop
                        
                            for ($count_1 = 0; $count_1 < count($kod); $count_1++) {
                        
                                $data_1 = array(
                                    'permohonan_id' => $data2, //previous ID
                                    'icno_pemohon' => $icno[$count_1],
                                    'kod' => $kod[$count_1],        
                                    'submitted_at' => $now,                             
                                    'created_at' => $now
                                    
                                );
                        
                                $insert_data_1[] = $data_1;
                            }
                        
                            // Save 'Inventorybbk' data
                            SSMPermohonanicno::insert($insert_data_1);
                        }
                    
                        // since placed at indexpermohonan and indexstaffpermohonan 17.10.24
                     

                        // $previousUrl = url()->previous();

                        if(str_contains($request->previous_page, 'indexstaffpermohonan')){
                            return redirect()->route('ssmrequests.ssmrequest.indexstaffpermohonan')
                            ->with('error_message', 'Please fill in the required fields for Permohonan');
                        } else{
                            return redirect()->route('ssmrequests.ssmrequest.indexpermohonan')
                            ->with('error_message', 'Please fill in the required fields for Permohonan');

                        }
                      
                        
                
    }


                public function storebakicuti(Request $request)
                {

                // captcha condition
                      // Validate that the captcha and correctAnswer inputs are present
                      $request->validate([
                        'captcha' => 'required',
                        'correctAnswer' => 'required',
                    ]);

                    // Get the user's selected captcha and the correct answer from the form
                    $userCaptcha = $request->input('captcha');
                    $correctAnswer = $request->input('correctAnswer');

                    // Check if the user's answer matches the correct answer
                    if ($userCaptcha != $correctAnswer) {
                        // Return with error if it doesn't match
                        return redirect()->back()->withErrors(['captcha' => 'Invalid Baki Cuti captcha answer. Please try again.'])->withInput();
                    }
                // end captcha conditon

                    $now = Carbon::now();
                
                    // Store data in ssm_dc database
            
                    $ssmbakicuti = new SSMBakicuti();
                    $ssmbakicuti->bc_name = $request->bc_name;
                    $ssmbakicuti->bc_icno = $request->bc_icno;
                    $ssmbakicuti->bc_jawatan= $request->bc_jawatan;
                    $ssmbakicuti->bc_email= $request->bc_email;
                    $ssmbakicuti->bc_notel = $request->bc_notel;
                    $ssmbakicuti->bc_workplace = $request->bc_workplace;
                    $ssmbakicuti->bc_days= $request->bc_days; 
                    $ssmbakicuti->bc_daysjpp= $request->bc_daysjpp;  
                    $ssmbakicuti->bc_date = $request->bc_date; 
                    $ssmbakicuti->bc_catatanuser = $request->bc_catatanuser; 
                    $ssmbakicuti->bc_created_at = $now;

                    // Handle uploaded images file old
                    if ($request->hasFile('bc_file')) {
                        $uploadedFiles = [];
                
                        foreach ($request->file('bc_file') as $file) {
                            // Validate and store each file
                            $filename = $file->getClientOriginalName();
                            $path = $file->storeAs('public/ssmbakicuti', $filename);
                
                            $uploadedFiles[] = $filename;
                        }
                
                        // Store $uploadedFiles in your database or perform any other actions
                        $ssmbakicuti->bc_file = $uploadedFiles;
                    }

                    $ssmbakicuti->save();

                    // Get the last inserted ID using the database connection
                    $latestId = $ssmbakicuti->getConnection()->getPdo()->lastInsertId();

                    //MAIL Function baki cuti
                    $notf_userEmail = $request->bc_email;
                    $notf_Nama = $request->bc_name;
                    $notf_latestID = $latestId;

                    Mail::to($notf_userEmail)->send(new EmailSSMBakiCuti($notf_Nama, $notf_latestID));

                    // Send WhatsApp message after successful submission
                    $this->sendWhatsAppMessagesubbakicuti($request->bc_notel, $request->bc_name, $latestId);

                    //For Notification of success message
                    $bcname = $request -> bc_name;
                    $bcicno = $request -> bc_icno;
                    $bcid =  $ssmbakicuti->getConnection()->getPdo()->lastInsertId();

                    $successMessage = "Permohonan telah berjaya dihantar! Sila rujuki Whatsapp/Email untuk maklumat lanjut. </br></br> <center><b>$bcname ($bcicno)</b> </br> Rujukan: <b>BC$bcid</b></center>";

                    return redirect()->route('ssmrequest')
                    ->with('success_message', $successMessage);
                }


                // Function to send WhatsApp message
                private function sendWhatsAppMessagesubbakicuti($telMobilesubbc, $bcname, $latestId)
                {
                    // Adjust the parameters according to your template and use case
                    $data = [
                        'phone' => "+673" . $telMobilesubbc,
                        'template' => 'ssm_sub_bc',
                        'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8',
                        'language' => ['code' => 'ms', 'policy' => 'deterministic'],
                        "params" => [["type" => "body", "parameters" => [["type" => "text", "text" => $bcname], ["type" => "text", "text" =>$latestId]]]],
                    ];

                    $json = json_encode($data);
                    $token = '7hpe9bwi2bl1k5ja';
                    $instanceId = '448643';
                    $url = 'http://moe.proxy.mesh/' . $instanceId . '/sendTemplate?token=' . $token;
                    $options = stream_context_create(['http' => ['method' => 'POST', 'header' => 'Content-type: application/json', 'content' => $json]]);
                    $result = file_get_contents($url, false, $options);

                    // Handle the result if needed
                    // For example, you can log the result or perform other actions based on the response
                }
            

            public function storepertukaranic(Request $request)
            {

                 // captcha condition
                      // Validate that the captcha and correctAnswer inputs are present
                      $request->validate([
                        'pi_captcha' => 'required',
                        'pi_correctAnswer' => 'required',
                    ]);

                    // Get the user's selected captcha and the correct answer from the form
                    $userCaptcha = $request->input('pi_captcha');
                    $pi_correctAnswer = $request->input('pi_correctAnswer');

                    // Check if the user's answer matches the correct answer
                    if ($userCaptcha != $pi_correctAnswer) {
                        // Return with error if it doesn't match
                        return redirect()->back()->withErrors(['pi_captcha' => 'Invalid Pertukaran No Kad Pengenalan captcha answer. Please try again.'])->withInput();
                    }
                // end captcha conditon
        
            
                $now = Carbon::now();

                $ssmpertukaranic = new SSMPertukaranic();
                $ssmpertukaranic->pi_name = $request->pi_name;
                $ssmpertukaranic->pi_icno_old = $request->pi_icno_old;
                $ssmpertukaranic->pi_fileold = $request->pi_fileold; //set at model array
                $ssmpertukaranic->pi_icno_new = $request->pi_icno_new;
                $ssmpertukaranic->pi_filenew = $request->pi_filenew; //set at model array
                $ssmpertukaranic->pi_jawatan = $request->pi_jawatan;
                $ssmpertukaranic->pi_email = $request->pi_email;
                $ssmpertukaranic->pi_notel = $request->pi_notel;
                $ssmpertukaranic->pi_workplace = $request->pi_workplace;
                $ssmpertukaranic->pi_catatanuser = $request->pi_catatanuser;
                $ssmpertukaranic->pi_created_at = $now;

                    
                    // Handle uploaded images file old
                            if ($request->hasFile('pi_fileold')) {
                                $uploadedFiles = [];
                        
                                foreach ($request->file('pi_fileold') as $file) {
                                    // Validate and store each file
                                    $filename = $file->getClientOriginalName();
                                    $path = $file->storeAs('public/ssmpertukaranicno', $filename);
                        
                                    $uploadedFiles[] = $filename;
                                }
                        
                                // Store $uploadedFiles in your database or perform any other actions
                                $ssmpertukaranic->pi_fileold = $uploadedFiles;
                            }


                            // Handle uploaded images file new
                            if ($request->hasFile('pi_filenew')) {
                                $uploadedFiles = [];
                        
                                foreach ($request->file('pi_filenew') as $file) {
                                    // Validate and store each file
                                    $filename = $file->getClientOriginalName();
                                    $path = $file->storeAs('public/ssmpertukaranicno', $filename);
                        
                                    $uploadedFiles[] = $filename;
                                }
                        
                                // Store $uploadedFiles in your database or perform any other actions
                                $ssmpertukaranic->pi_filenew = $uploadedFiles;
                            }
                        
                        
                            $ssmpertukaranic->save();

                        // Get the last inserted ID using the database connection
                        $latestId = $ssmpertukaranic->getConnection()->getPdo()->lastInsertId();

                        //MAIL Function pertukaran no Kad pengenalan
                        $notf_userEmail = $request->pi_email;
                        $notf_Nama = $request->pi_name;
                        $notf_latestID = $latestId;

                        Mail::to($notf_userEmail)->send(new EmailSSMPertukaranIC($notf_Nama, $notf_latestID));

                        // Send WhatsApp message after successful submission
                        $this->sendWhatsAppMessagesubpertukaranic($request->pi_notel, $request->pi_name, $latestId);

                        //For Notification of success message
                        $piname = $request -> pi_name;
                        $piicno = $request -> pi_icno;
                        $piid =  $ssmpertukaranic->getConnection()->getPdo()->lastInsertId();

                        $successMessage = "Permohonan telah berjaya dihantar! Sila rujuki Whatsapp/Email untuk maklumat lanjut. </br></br> <center><b>$piname ($piicno)</b> </br> Rujukan: <b>PKP$piid</b></center>";

                        return redirect()->route('ssmrequest')
                        ->with('success_message', $successMessage);
            }


                                    // Function to send WhatsApp message
                                            private function sendWhatsAppMessagesubpertukaranic($telMobilesubdc, $piname, $latestId)
                                            {
                                                // Adjust the parameters according to your template and use case
                                                $data = [
                                                    'phone' => "+673" . $telMobilesubdc,
                                                    'template' => 'ssm_sub_pkp',
                                                    'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8',
                                                    'language' => ['code' => 'ms', 'policy' => 'deterministic'],
                                                    "params" => [["type" => "body", "parameters" => [["type" => "text", "text" => $piname], ["type" => "text", "text" =>$latestId]]]],
                                                ];

                                                $json = json_encode($data);
                                                $token = '7hpe9bwi2bl1k5ja';
                                                $instanceId = '448643';
                                                $url = 'http://moe.proxy.mesh/' . $instanceId . '/sendTemplate?token=' . $token;
                                                $options = stream_context_create(['http' => ['method' => 'POST', 'header' => 'Content-type: application/json', 'content' => $json]]);
                                                $result = file_get_contents($url, false, $options);

                                                // Handle the result if needed
                                                // For example, you can log the result or perform other actions based on the response
                                            }
            




    public function storedc(Request $request)
    {

    
        $now = Carbon::now();
        $icNos = Auth::user()->ic_no;
                    
                // Store data in ssm_dc database
        
                $ssmdc = new SSMDc();
                $ssmdc->dc_name = $request->dc_name;
                $ssmdc->dc_icno = $request->dc_icno;
                $ssmdc->dc_jawatan = $request->dc_jawatan;
                $ssmdc->dc_email = $request->dc_email;
                $ssmdc->dc_notel = $request->dc_notel;
                $ssmdc->dc_datedelete = $request->dc_datedelete;
                $ssmdc->dc_dateaduan = $request->dc_dateaduan;
                $ssmdc->dc_catatan = $request->dc_catatan;
            
                $ssmdc->dc_created_at = $now;
                $ssmdc->dc_created_by = $icNos;
            
        // Handle uploaded images
        if ($request->hasFile('dc_file')) {
            $uploadedFiles = [];
    
            foreach ($request->file('dc_file') as $file) {
                // Validate and store each file
                $filename = $file->getClientOriginalName();
                $path = $file->storeAs('public/ssmdc', $filename);
    
                $uploadedFiles[] = $filename;
            }
    
            // Store $uploadedFiles in your database or perform any other actions
            $ssmdc->dc_file = $uploadedFiles;
        }
    
            $ssmdc->save();

            // Get the last inserted ID using the database connection
            $latestId = $ssmdc->getConnection()->getPdo()->lastInsertId();

            //MAIL Function delete cuti
            $notf_userEmail = $request->dc_email;
            $notf_Nama = $request->dc_name;
            $notf_latestID = $latestId;

            Mail::to($notf_userEmail)->send(new EmailSSMDeleteCuti($notf_Nama, $notf_latestID));

            // Send WhatsApp message after successful submission
            $this->sendWhatsAppMessagesubdc($request->dc_notel, $request->dc_name, $latestId);

            return redirect()->route('ssmrequests.ssmrequest.indexall')
            ->with('error_message', 'Please fill in the required fields for SSM Delete Cuti');

    }


                // Function to send WhatsApp message
                        private function sendWhatsAppMessagesubdc($telMobilesubdc, $dcname, $latestId)
                        {
                            // Adjust the parameters according to your template and use case
                            $data = [
                                'phone' => "+673" . $telMobilesubdc,
                                'template' => 'ssm_sub_dc',
                                'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8',
                                'language' => ['code' => 'ms', 'policy' => 'deterministic'],
                                "params" => [["type" => "body", "parameters" => [["type" => "text", "text" => $dcname], ["type" => "text", "text" =>$latestId]]]],
                            ];

                            $json = json_encode($data);
                            $token = '7hpe9bwi2bl1k5ja';
                            $instanceId = '448643';
                            $url = 'http://moe.proxy.mesh/' . $instanceId . '/sendTemplate?token=' . $token;
                            $options = stream_context_create(['http' => ['method' => 'POST', 'header' => 'Content-type: application/json', 'content' => $json]]);
                            $result = file_get_contents($url, false, $options);

                            // Handle the result if needed
                            // For example, you can log the result or perform other actions based on the response
                        }
                    

// public function storedcnotyet(Request $request)
// {
//     $now = Carbon::now();
//     $icNos = Auth::user()->ic_no;

//     try {
//         // Store data in ssm_dc database
//         $ssmdc = SSMDc::create([
//             'dc_name' => $request->dc_name,
//             'dc_icno' => $request->dc_icno,
//             'dc_jawatan' => $request->dc_jawatan,
//             'dc_email' => $request->dc_email,
//             'dc_notel' => $request->dc_notel,
//             'dc_datedelete' => $request->dc_datedelete,
//             'dc_dateaduan' => $request->dc_dateaduan,
//             'dc_catatan' => $request->dc_catatan,
//             'dc_created_at' => $now,
//             'dc_created_by' => $icNos,
//         ]);

//         $ssmdcId = $ssmdc->id; // Retrieve the ID from the created model instance

//         $telMobilesubdc = $ssmdc->dc_notel;

//         // Send WhatsApp message after successful submission using the obtained ID
//         $this->sendWhatsAppMessagesubdc($telMobilesubdc, $request->dc_name, $ssmdcId);

//         return redirect()->route('ssmrequests.ssmrequest.indexall')
//             ->with('success_message', 'SSM Delete Cuti submitted successfully.');

//     } catch (Exception $exception) {
//         return back()->withInput()->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
//     }
// }


//     private function sendWhatsAppMessagesubdc($telMobilesubdc, $dcName, $dcid)
// {
//     // WhatsApp API code remains the same
//     // ...

//     // Adjust the parameters according to your template and use case
//     $data = [
//         'phone' =>  "+673".$telMobilesubdc,
//         'template' => 'ssm_sub_dc',
//         'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8',
//         'language' => ['code' => 'ms', 'policy' => 'deterministic'],
//         "params" => [["type" => "body", "parameters" => [["type" => "text", "text" => $dcName], ["type" => "text", "text" => $dcid]]]],
//     ];

//     $json = json_encode($data);
//     $token = '7hpe9bwi2bl1k5ja';
//     $instanceId = '448643';
//     $url = 'http://moe.proxy.mesh/' . $instanceId . '/sendTemplate?token=' . $token;
//     $options = stream_context_create(['http' => ['method' => 'POST', 'header' => 'Content-type: application/json', 'content' => $json]]);
//     $result = file_get_contents($url, false, $options);
//     // WhatsApp API End
// }

    public function storeot(Request $request)
    {

        $now = Carbon::now();
        $icNos = Auth::user()->ic_no;

            // Store data in ssm_others database
            
                $ssmothers = new SSMOthers();
                $ssmothers->ot_name = $request->ot_name;
                $ssmothers->ot_icno = $request->ot_icno;
                $ssmothers->ot_jawatan = $request->ot_jawatan;
                $ssmothers->ot_workplace = $request->ot_workplace;
                $ssmothers->ot_email = $request->ot_email;
                $ssmothers->ot_notel = $request->ot_notel;
                $ssmothers->ot_catatan = $request->ot_catatan;
                $ssmothers->ot_created_at = $now;
                $ssmothers->ot_created_by = $icNos;
                $ssmothers->save();
        
                return redirect()->route('ssmrequests.ssmrequest.indexall')
                    ->with('error_message', 'Please fill in the required fields for SSM Others');   
    }

    public function storeps(Request $request)
    {

    
        $now = Carbon::now();
        $icNos = Auth::user()->ic_no;

            // Store data in ssm_password database
            
                $ssmpassword = new SSMPassword();
                $ssmpassword->ps_name = $request->ps_name;
                $ssmpassword->ps_icno = $request->ps_icno;
                $ssmpassword->ps_jawatan = $request->ps_jawatan;
                $ssmpassword->ps_workplace = $request->ps_workplace;
                $ssmpassword->ps_email = $request->ps_email;
                $ssmpassword->ps_notel = $request->ps_notel;
                $ssmpassword->ps_otp = $request->ps_otp;
                $ssmpassword->ps_catatan = $request->ps_catatan;
                $ssmpassword->ps_created_at = $now;
                $ssmpassword->ps_created_by = $icNos;
                $ssmpassword->save();

                // Get the last inserted ID using the database connection
                $latestId = $ssmpassword->getConnection()->getPdo()->lastInsertId();

                //MAIL Function reset password
                $notf_userEmail = $request->ps_email;
                $notf_Nama = $request->ps_name;
                $notf_latestID = $latestId;

                Mail::to($notf_userEmail)->send(new EmailSSMResetPassword($notf_Nama, $notf_latestID));

                // Send WhatsApp message after successful submission
                $this->sendWhatsAppMessagesubps($request->ps_notel, $request->ps_name, $latestId);

                return redirect()->route('ssmrequests.ssmrequest.indexall')
                    ->with('error_message', 'Please fill in the required fields for SSM Password');
    }




                // Function to send WhatsApp message
                        private function sendWhatsAppMessagesubps($telMobilesubps, $psname, $latestId)
                        {
                            // Adjust the parameters according to your template and use case
                            $data = [
                                'phone' => "+673" . $telMobilesubps,
                                'template' => 'ssm_sub_pass',
                                'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8',
                                'language' => ['code' => 'ms', 'policy' => 'deterministic'],
                                "params" => [["type" => "body", "parameters" => [["type" => "text", "text" => $psname], ["type" => "text", "text" =>$latestId]]]],
                            ];

                            $json = json_encode($data);
                            $token = '7hpe9bwi2bl1k5ja';
                            $instanceId = '448643';
                            $url = 'http://moe.proxy.mesh/' . $instanceId . '/sendTemplate?token=' . $token;
                            $options = stream_context_create(['http' => ['method' => 'POST', 'header' => 'Content-type: application/json', 'content' => $json]]);
                            $result = file_get_contents($url, false, $options);

                            // Handle the result if needed
                            // For example, you can log the result or perform other actions based on the response
                        }
            

    

public function storepe(Request $request)
{
    $now = Carbon::now();
    $icNos = Auth::user()->ic_no;

    foreach ($request->moreDataPe as $key => $data) {
        $data['pe_created_at'] = $now;
        $data['pe_created_by'] = $icNos;

        $createdRecord= SSMPeranan::create($data);

        $latestId = $createdRecord->getConnection()->getPdo()->lastInsertId();

        Mail::to($data['pe_email'])->send(new EmailSSMPeranan($data['pe_name'], $latestId));

        // Send WhatsApp message after successful submission
        $this->sendWhatsAppMessagesubpe($data['pe_notel'], $data['pe_name'], $latestId);
    }


        // $pe = new SSMPeranan(); // Assuming "PE" is the model for the "pe" table
        // $pe->pe_name = $request->pe_name;
        // $pe->pe_icno = $request->pe_icno;
        // $pe->pe_jawatan = $request->pe_jawatan;
        // $pe->pe_email = $request->pe_email;
        // $pe->pe_notel = $request->pe_notel;
        // $pe->pe_peranan = $request->pe_peranan; // Adjust according to your database structure
        // $pe->pe_catatan = $request->pe_catatan;
        // $pe->pe_status = $request->pe_status; // Adjust according to your database structure
        // $pe->pe_created_at = $now;
        // $pe->pe_created_by = $icNos;
        // $pe->save();

        // // Get the last inserted ID using the database connection
        // $latestId = $pe->getConnection()->getPdo()->lastInsertId();

        // //MAIL Function reset password
        // $notf_userEmail = $request->pe_email;
        // $notf_Nama = $request->pe_name;
        // $notf_latestID = $latestId;

        // Mail::to($notf_userEmail)->send(new EmailSSMPeranan($notf_Nama, $notf_latestID));

        // // Send WhatsApp message after successful submission
        // $this->sendWhatsAppMessagesubpe($request->pe_notel, $request->pe_name, $latestId);

        return redirect()->route('ssmrequests.ssmrequest.indexall')
            ->with('error_message', 'Please fill in the required fields for PE');

}
//     public function storepe(Request $request)
// {
//     $now = Carbon::now();
//     $icNos = Auth::user()->ic_no;


//         $pe = new SSMPeranan(); // Assuming "PE" is the model for the "pe" table
//         $pe->pe_name = $request->pe_name;
//         $pe->pe_icno = $request->pe_icno;
//         $pe->pe_jawatan = $request->pe_jawatan;
//         $pe->pe_email = $request->pe_email;
//         $pe->pe_notel = $request->pe_notel;
//         $pe->pe_peranan = $request->pe_peranan; // Adjust according to your database structure
//         $pe->pe_catatan = $request->pe_catatan;
//         $pe->pe_status = $request->pe_status; // Adjust according to your database structure
//         $pe->pe_created_at = $now;
//         $pe->pe_created_by = $icNos;
//         $pe->save();

//         // Get the last inserted ID using the database connection
//         $latestId = $pe->getConnection()->getPdo()->lastInsertId();

//         //MAIL Function reset password
//         $notf_userEmail = $request->pe_email;
//         $notf_Nama = $request->pe_name;
//         $notf_latestID = $latestId;

//         Mail::to($notf_userEmail)->send(new EmailSSMPeranan($notf_Nama, $notf_latestID));

//         // Send WhatsApp message after successful submission
//         $this->sendWhatsAppMessagesubpe($request->pe_notel, $request->pe_name, $latestId);

//         return redirect()->route('ssmrequests.ssmrequest.indexall')
//             ->with('error_message', 'Please fill in the required fields for PE');

// }

// Function to send WhatsApp message
                        private function sendWhatsAppMessagesubpe($telMobilesubpe, $pename, $latestId)
                        {
                            // Adjust the parameters according to your template and use case
                            $data = [
                                'phone' => "+673" . $telMobilesubpe,
                                'template' => 'ssm_sub_peranan',
                                'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8',
                                'language' => ['code' => 'ms', 'policy' => 'deterministic'],
                                "params" => [["type" => "body", "parameters" => [["type" => "text", "text" => $pename], ["type" => "text", "text" =>$latestId]]]],
                            ];

                            $json = json_encode($data);
                            $token = '7hpe9bwi2bl1k5ja';
                            $instanceId = '448643';
                            $url = 'http://moe.proxy.mesh/' . $instanceId . '/sendTemplate?token=' . $token;
                            $options = stream_context_create(['http' => ['method' => 'POST', 'header' => 'Content-type: application/json', 'content' => $json]]);
                            $result = file_get_contents($url, false, $options);

                            // Handle the result if needed
                            // For example, you can log the result or perform other actions based on the response
                        }
            





public function ssmkod()
{

    $icNos = Auth::user()->ic_no;

    $ssmkods = SSMKod::select('ssm_kod.*')
    ->orderBy('created_at', 'DESC')
    ->get();

    return view('ssmrequests.ssmkod',compact('ssmkods'));
}

public function storessmkod(Request $request)
{

    foreach ($request->moreFields as $key => $value) {
        SSMKod::create($value);
    }

    return redirect()->route('ssmrequests.ssmrequest.ssmkod')
        ->with('success_message', 'New Data record was successfully added!');
}

public function destroyssmkod($id)
{
    try {

        $ssmkods = SSMKod::where('id', $id)->delete();

        return redirect()->route('ssmrequests.ssmrequest.ssmkod')
            ->with('success_message', 'Data was successfully deleted!');
    } catch (Exception $exception) {

        return back()->withInput()
            ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
    }
}

public function destroypermohonanicno($id)
{
    try {

        $ssmpermohonanicno = SSMPermohonanicno::where('id', $id)->delete();

        return back()
        ->with('success_message', 'Record was successfully deleted!');
    } catch (Exception $exception) {

        return back()->withInput()
            ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
    }
}



public function updateadmin(Request $request)
{
    
    $icNos = Auth::user()->ic;

    $now = Carbon::now();


    $ssm =  SSMRequest::select('ssmsrequest.*')
        ->where('id', $request->id)
        ->update([

            'huraian' => $request->huraian,
            'status' => $request->status,
            'updated_at' => $now
        ]);

        // $telMobile = Contact::select(['emp_contact_infos.*', \DB::raw('DATEDIFF(year,getdate(), created_at) as length')])
        // ->where('ic_no', $icNos)
        // ->value('telephone_mobile');

    return redirect()->route('ssmrequests.ssmrequest.indexall')
        ->with('success_message', 'SSM record was successfully updated!');
}

    public function updatestaffpermohonan(Request $request)
    {
        $now = Carbon::now();
        
        // Loop through the submitted data
        foreach ($request->id as $key => $id) {
            // Retrieve the SSMPermohonanicno model by ID
            $ssmPermohonanicno = SSMPermohonanicno::find($id);
        
            // Check if the user is authorized to update this row
            if (auth()->user()->ic_no == $ssmPermohonanicno->kod) {
                // Check if the data is changed
                if ($ssmPermohonanicno->status != $request->input("status_$id") ||
                    $ssmPermohonanicno->catatantindakan != $request->input("catatantindakan_$id")) {
                    
                    // Update only if the user is authorized and the data is changed
                    $ssmPermohonanicno->status = $request->input("status_$id");
                    $ssmPermohonanicno->catatantindakan = $request->input("catatantindakan_$id");
                    $ssmPermohonanicno->submitted_at = $now;
        
                    // Save the changes
                    $ssmPermohonanicno->save();
                }
            }
        }    
        // Redirect with a success message
        return redirect()->route('ssmrequests.ssmrequest.indexstaffpermohonan')
            ->with('success_message', 'SSM records were successfully updated!');
    }

    public function updatestaffpermohonanstatus(Request $request){

        $icNos = Auth::user()->ic_no;
    
        $now = Carbon::now();
        $idstatus = $request->input('id');
    
        // Find the record to be updated based on kod and icno_pemohon
        $ssmPermohonanicno = SSMPermohonanicno::find($idstatus);
    
        // Update the record with the new data
        $ssmPermohonanicno->status = $request->input('status');
        if ($request->filled('catatantindakan')) {
            $ssmPermohonanicno->catatantindakan = $request->input('catatantindakan');
        }
    
        $ssmPermohonanicno->submitted_at = $now;
        $ssmPermohonanicno->save();
    
        if ($request->filled('catatankivadmin')) {
            $ssmPermohonanicno->catatankivadmin = $request->input('catatankivadmin');
            $ssmPermohonanicno->ic_no_kivadmin = $icNos;
            $ssmPermohonanicno->save();
    
        // Redirect with a success message
        return back()->withInput()
            ->with('success_message', 'SSM records status were successfully changed!');
        }
    
    
        // Redirect with a success message
        return redirect()->route('ssmrequests.ssmrequest.indexstaffpermohonan')
            ->with('success_message', 'SSM records status were successfully changed!');
    }

    //JenisPermohonan

    public function indexjenispermohonan()
    {
        $icNos = Auth::user()->ic_no; 

        $jenispermohonans = SSMJenisPermohonan::select('ssm_jenispermohonan.*')
        ->orderBy('label', 'ASC')
        ->get();

        return view('ssmrequests.indexjenispermohonan', compact('jenispermohonans'));
    }

    public function editjenispermohonan($id)
    {
        $icNos = Auth::user()->ic_no; 

        $jenispermohonans = SSMJenisPermohonan::select('ssm_jenispermohonan.*')
            ->where('id', '=', $id)
            ->first();

        return view('ssmrequests.updatejenispermohonan', compact('jenispermohonans'));
    }

    public function storejenispermohonan(Request $request){

        $jenispermohonans = new SSMJenisPermohonan;
    
        $jenispermohonans-> label = $request->label;
    
        $jenispermohonans->save();
    
        return back()->withInput()
                ->with('success_message', 'Jenis Permohonan Added!');
    }

    public function updatejenispermohonan(Request $request)
    {
        $user = Auth::user()->name;
    
        $id = $request->input('id');
    
        // Find the record to be updated
        $jenispermohonans = SSMJenisPermohonan::where('id', $id)
            ->where('id', $id)
            ->first();
    
        if (!$jenispermohonans) {
            return redirect()->back()->with('error', 'Record not found');
        }
    
        // Update the record with the new data
        $jenispermohonans->label = $request->input('label');
        $jenispermohonans->save();
    
        return redirect()->route('ssmrequests.ssmrequest.indexjenispermohonan')
            ->with('success_message', 'Jenis Permohonan Updated!');
    }
    
    public function destroyjenispermohonan($id)
    {
        try {
        $jenispermohonans= SSMJenisPermohonan::where('id', $id)->delete();
    
            return back()->withInput()
                ->with('success_message', 'Data was successfully deleted!');
        } catch (Exception $exception) {
    
            return back()->withInput()
                ->withErrors(['error_message' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    //EndJenisPermohonan

    //StaffSalinan

    public function createpermohonansalinan(){ 
        $icNos = Auth::user()->ic_no;
        $currenttime = Carbon::now();

        $jenispermohonans = SSMJenisPermohonan::pluck('label', 'id')->all();
        $ssmkod = SSMKod::select('ssm_kod.*')->where('ic_no', $icNos)->get();

        return view('ssmrequests.createpermohonansalinan', compact('ssmkod','jenispermohonans','currenttime'));
    }

    public function storepermohonansalinan(Request $request){

        $now = Carbon::now();
        $icNos = Auth::user()->ic_no;
    
        $ssmpermohonansalinan = new SSMPermohonanSalinan();
        $ssmpermohonansalinan->permohonan_type = $request->permohonan_type;
        $ssmpermohonansalinan->permohonan_catatan = $request->permohonan_catatan;
    
        $ssmpermohonansalinan->created_at = $now;
        $ssmpermohonansalinan->created_by = $icNos;
        
        // Handle uploaded images
            if ($request->hasFile('permohonan_file')) {
                $uploadedFiles = [];
        
                foreach ($request->file('permohonan_file') as $file) {
                    // Validate and store each file
                    $filename = $file->getClientOriginalName();
                    $path = $file->storeAs('public/ssmpermohonan', $filename);
        
                    $uploadedFiles[] = $filename;
                }
        
                // Store $uploadedFiles in your database or perform any other actions
                $ssmpermohonansalinan->permohonan_file = $uploadedFiles;
            }
        
            $ssmpermohonansalinan->save();
    
            $icno = $request->icno_pemohon;
            $kod = $request->kod;
    
            if (!empty($icno) && is_array($icno) && !empty($kod) && is_array($kod)) {
    
                $insert_data_1 = []; // Initialize the array before the loop
    
                for ($count_1 = 0; $count_1 < count($kod); $count_1++) {
    
                    // Check if icno_pemohon is not empty before adding to the array
                    if (!empty($icno[$count_1])) {
    
                        $data_1 = array(
                            'permohonan_id' => $request->id,
                            'icno_pemohon' => $icno[$count_1],
                            'kod' => $kod[$count_1],
                            'created_at' => $now,
                        );
    
                        $insert_data_1[] = $data_1;
                    }
                }
    
                // Insert data only if $insert_data_1 is not empty
                if (!empty($insert_data_1)) {
                    SSMPermohonanSalinanicno::insert($insert_data_1);
                }
            }
    
            return redirect()->route('ssmrequests.ssmrequest.indexstaffpermohonan')
                ->with('success_message', 'Permohonan Salinan Created!');                      
        
    }

    public function editstaffsalinan($id){
        $icNos = Auth::user()->ic_no;

    
        $ssmpermohonansalinans = SSMPermohonanSalinan::with(['ssmkod', 'selesaikod'])->where('id', $id)->get();

        $ssmpermohonansalinanicnos = SSMPermohonanSalinanicno::with('ssmkod')
        ->where('permohonan_id', '=', $id)
        ->get();

        $ssmkod = SSMKod::select('ssm_kod.*')->where('ic_no', $icNos)->get();

        $jenispermohonans = SSMJenisPermohonan::pluck('label', 'id')->all();

        return view('ssmrequests.editstaffsalinan', compact('ssmpermohonansalinans','ssmpermohonansalinanicnos','ssmkod', 'jenispermohonans'));
    }

    public function updatestaffsalinan(Request $request){
    
        $icNos = Auth::user()->ic_no;
        $now = Carbon::now();
    
        try {
                // Retrieve the updated Prestasi model
                $ssmpermohonansalinans = SSMPermohonanSalinan::findOrFail($request->id);
    
        
                // Update the main attributes
                $ssmpermohonansalinans->update([
                    'permohonan_type'         => $request->permohonan_type,
                    'permohonan_catatan'         => $request->permohonan_catatan,
                    'updated_at'   => $now,
                ]);
            
                // Check if 'remove_file' checkbox is selected
                if ($request->has('remove_file')) {
                    // Remove selected files
                    $this->removepermohonanFiles($ssmpermohonansalinans, $request->input('remove_file'));
                }
                    
                // Handle uploaded files
                if ($request->hasFile('permohonan_file')) {
                    $this->handlepermohonanUploadedFiles($ssmpermohonansalinans, $request->file('permohonan_file'), $request);
                }
                
                $icno = $request->icno_pemohon;
                $kod = $request->kod;
    
                if (!empty($icno) && is_array($icno) && !empty($kod) && is_array($kod)) {
    
                    $insert_data_1 = []; // Initialize the array before the loop
    
                    for ($count_1 = 0; $count_1 < count($kod); $count_1++) {
    
                        // Check if icno_pemohon is not empty before adding to the array
                        if (!empty($icno[$count_1])) {
    
                            $data_1 = array(
                                'permohonan_id' => $request->id,
                                'icno_pemohon' => $icno[$count_1],
                                'kod' => $kod[$count_1],
                                'created_at' => $now,
                            );
    
                            $insert_data_1[] = $data_1;
                        }
                    }
    
                    // Insert data only if $insert_data_1 is not empty
                    if (!empty($insert_data_1)) {
                        SSMPermohonanSalinanicno::insert($insert_data_1);
                    }
                }
    
                return back()->withInput()
                        ->with('success_message', 'Updated successfully.');
            } catch (Exception $exception) {
                return back()->withInput()
                    ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
            }
    }

    public function destroypermohonansalinan($id){
        try {
    
        $ssmpermohonansalinans = SSMPermohonanSalinan::where('id', $id)->delete();
    
        $ssmpermohonansalinanicnos = SSMPermohonanSalinanicno::where('permohonan_id', $id)->delete();
    
            return back()->withInput()
                ->with('success_message', 'Data Permohonan deleted!');
        } catch (Exception $exception) {
    
            return back()->withInput()
                ->withErrors(['error_message' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function destroypermohonansalinanicno($id){
        try {
    
            $ssmpermohonansalinanicnos = SSMPermohonanSalinanicno::where('id', $id)->delete();
    
            return back()
            ->with('success_message', 'Record was successfully deleted!');
        } catch (Exception $exception) {
    
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }
    //EndStaffSalinan

    public function updatestatusadminpermohonan(Request $request){

        $icNos = Auth::user()->ic_no;
        $now = Carbon::now();
    
        try {
            // Retrieve the updated Prestasi model
            $ssmpermohonan = SSMPermohonan::findOrFail($request->id);
    
            // Additional conditional updates based on dc_status
            if ($request->permohonan_status == 'kiv') {
                $ssmpermohonan->update([
                    'permohonan_status'         => $request->permohonan_status,
                    'kiv_at' => $now,
                    'kiv_by' => $icNos,
                ]);    
            } elseif ($request->permohonan_status == 'selesai') {
                $ssmpermohonan->update([
                    'permohonan_status'         => $request->permohonan_status,
    
                    'selesai_at' => $now,
                    'selesai_by' => $icNos,
                ]);
            } elseif ($request->permohonan_status == '') {
                $ssmpermohonan->update([
                    'permohonan_status'         => null,
                ]);
            }
    
            return redirect()->route('ssmrequests.ssmrequest.indexpermohonan')
                ->with('success_message', 'Status Admin Updated!');
        }   catch (Exception $exception) {
                return back()->withInput()
                    ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function updatestatusdispatchpermohonan(Request $request){

        $icNos = Auth::user()->ic_no;
        $now = Carbon::now();
    
        try {
            // Retrieve the updated Prestasi model
            $ssmpermohonan = SSMPermohonan::findOrFail($request->id);
    
            // Additional conditional updates
            if ($request->dispatch_status == 'selesai') {
                $ssmpermohonan->update([
                    'dispatch_status'     => $request->dispatch_status,
    
                    'dispatch_updated_at' => $now,
                    'dispatch_updated_by' => $icNos,
                ]);
            } elseif ($request->dispatch_status == '') {
                $ssmpermohonan->update([
                    'dispatch_status'         => null,
                ]);
            }
    
            return redirect()->route('ssmrequests.ssmrequest.indexpermohonan')
                ->with('success_message', 'Status Despatch Updated!');
        }   catch (Exception $exception) {
                return back()->withInput()
                    ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function destroypermohonan($id)
    {
        try {
    
        $ssmpermohonan = SSMPermohonan::where('id', $id)->delete();
    
        $ssmpermohonanicno = SSMPermohonanicno::where('permohonan_id', $id)->delete();
    
            return back()->withInput()
                ->with('success_message', 'Data Permohonan deleted!');
        } catch (Exception $exception) {
    
            return back()->withInput()
                ->withErrors(['error_message' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function updateadminapproval(Request $request)
    {
        
        $icNos = Auth::user()->ic_no;

        $now = Carbon::now();

    // new
    try {
                // Retrieve the updated Prestasi model
                $ssmapproval = SSMApproval::findOrFail($request->id);

    
                // Update the main attributes
                $ssmapproval->update([

                'ap_name' => $request->ap_name,
                'ap_icno' => $request->ap_icno,
                'ap_jawatan' => $request->ap_jawatan,
                'ap_notel' => $request->ap_notel,
                'ap_workplace' => $request->ap_workplace,
                'ap_catatan' => $request->ap_catatan,
                'ap_status' => $request->ap_status,
                'ap_updated_at' => $now,
                'ap_updatedby' => $icNos,
            ]);

                // Additional conditional updates based on dc_status
                if ($request->ap_status == 'Dihadapkan ke Dynamik') {
                    $ssmapproval->update([
                        'dinamik_updatedat' => $now,
                        'dinamik_updatedby' => $icNos,
                    ]);
                } elseif ($request->ap_status == 'Sedang Dikemaskini / Diteliti') {
                    $ssmapproval->update([
                        'diteliti_updatedat' => $now,
                        'diteliti_updatedby' => $icNos,
                    ]);
                } elseif ($request->ap_status == 'Selesai') {
                    $ssmapproval->update([
                        'selesai_updatedat' => $now,
                        'selesai_updatedby' => $icNos,
                    ]);
                }


                $telMobileApproval = SSMApproval::select(['ssm_approval.*', \DB::raw('DATEDIFF(year,getdate(), ap_created_at) as length')])
                                ->where('id', $request->id)
                                ->value('ap_notel');

                if ($request->ap_status == "Selesai") {
                    $this->sendWhatsAppMessageApprovalSelesai($telMobileApproval, $request->ap_name, $request->id);

                    if (!empty($ssmapproval->ap_email)) {
                    //MAIL Function approval
                    $notf_userEmail = $ssmapproval->ap_email;
                    $notf_Nama = $ssmapproval->ap_name;
                    $notf_latestID = $ssmapproval->id;

                    Mail::to($notf_userEmail)->send(new EmailSSMApprovalSelesai($notf_Nama, $notf_latestID));

                    } else{
                    }
                }

    
        
                return redirect()->route('ssmrequests.ssmrequest.indexall')
                    ->with('success_message', 'Updated successfully.');
            } catch (Exception $exception) {
                return back()->withInput()
                    ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
            }
        }

        private function sendWhatsAppMessageApprovalSelesai($telMobileApproval, $apName, $apid)
        {

    

    // Whatsapp API Start
        $data = [
            'phone' =>  "+673".$telMobileApproval, // Receivers phone
            'template' => 'ssm_selesai_ap3', // Template name
            'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8', // Namespace of template
            'language' =>  ['code' => 'ms', 'policy' => 'deterministic'], // Language parameters
            "params"=> [["type"=>"body","parameters"=>[["type"=>"text","text"=> $apName],["type"=>"text","text"=> $apid]]]],
        ];

        $json = json_encode($data); // Encode data to JSON
        // URL for request POST /message
        $token = '7hpe9bwi2bl1k5ja';
        $instanceId = '448643';
        $url = 'http://moe.proxy.mesh/' . $instanceId . '/sendTemplate?token=' . $token;
        // Make a POST request
        $options = stream_context_create(['http' => [
                'method'  => 'POST',
                'header'  => 'Content-type: application/json',
                'content' => $json
            ]
        ]);
        // Send a request
        $result = file_get_contents($url, false, $options);
        //Whatsapp API End

}


    // new




    public function updateadminother(Request $request)
    {
        
        $icNos = Auth::user()->ic_no;

        $now = Carbon::now();


        $ssmother =  SSMOthers::select('ssm_others.*')
            ->where('id', $request->id)
            ->update([

                'ot_name' => $request->ot_name,
                'ot_icno' => $request->ot_icno,
                'ot_jawatan' => $request->ot_jawatan,
                'ot_notel' => $request->ot_notel,
                'ot_workplace' => $request->ot_workplace,
                'ot_catatan' => $request->ot_catatan,
                'ot_status' => $request->ot_status,
                'ot_updated_at' => $now,
                'ot_updatedby' => $icNos,
            ]);

            $ssmother = SSMOthers::findOrFail($request->id);


            // Additional conditional updates based on dc_status
                if ($request->ot_status == 'Dihadapkan ke Dynamik') {
                    $ssmother->update([
                        'dinamik_updatedat' => $now,
                        'dinamik_updatedby' => $icNos,
                    ]);
                } elseif ($request->ot_status == 'Sedang Dikemaskini / Diteliti') {
                    $ssmother->update([
                        'diteliti_updatedat' => $now,
                        'diteliti_updatedby' => $icNos,
                    ]);
                } elseif ($request->ot_status == 'Selesai') {
                    $ssmother->update([
                        'selesai_updatedat' => $now,
                        'selesai_updatedby' => $icNos,
                    ]);
                }
            
        

        

        return redirect()->route('ssmrequests.ssmrequest.indexall')
            ->with('success_message', 'SSM record was successfully updated!');
    }


    // start peranan

public function updateadminperanan(Request $request)
{
    $icNos = Auth::user()->ic_no;
    $now = Carbon::now();

    try {
        // Retrieve the updated SSMPeranan model
        $ssmperanan = SSMPeranan::findOrFail($request->id);

        // Update the main attributes
        $ssmperanan->update([
            'pe_name' => $request->pe_name,
            'pe_icno' => $request->pe_icno,
            'pe_jawatan' => $request->pe_jawatan,
            'pe_email' => $request->pe_email,
            'pe_notel' => $request->pe_notel,
            'pe_peranan' => $request->pe_peranan,
            'pe_catatan' => $request->pe_catatan,
            'pe_status' => $request->pe_status,
            'pe_updated_at' => $now,
            'pe_updatedby' => $icNos,
        ]);

        // Additional conditional updates based on pe_status
        if ($request->pe_status == 'Dihadapkan ke Dynamik') {
            $ssmperanan->update([
                'dinamik_updatedat' => $now,
                'dinamik_updatedby' => $icNos,
            ]);
        } elseif ($request->pe_status == 'Sedang Dikemaskini / Diteliti') {
            $ssmperanan->update([
                'diteliti_updatedat' => $now,
                'diteliti_updatedby' => $icNos,
            ]);
        } elseif ($request->pe_status == 'Selesai') {
            $ssmperanan->update([
                'selesai_updatedat' => $now,
                'selesai_updatedby' => $icNos,
            ]);

            // Send WhatsApp message for 'Selesai' status
            $telMobilePeranan = SSMPeranan::select(['ssm_peranan.*', \DB::raw('DATEDIFF(year,getdate(), pe_created_at) as length')])
                ->where('id', $request->id)
                ->value('pe_notel');

            $this->sendWhatsAppMessagePerananSelesai($telMobilePeranan, $request->pe_name, $request->id);

            if (!empty($ssmperanan->pe_email)) {
            //MAIL Function reset password
            $notf_userEmail = $ssmperanan-> pe_email;
            $notf_Nama = $ssmperanan->pe_name;
            $notf_latestID = $ssmperanan->id;

            Mail::to($notf_userEmail)->send(new EmailSSMPerananSelesai($notf_Nama, $notf_latestID));
            }else{}
        }

        return redirect()->route('ssmrequests.ssmrequest.indexall')->with('success_message', 'SSM record was successfully updated!');
    } catch (Exception $exception) {
        return back()->withInput()->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
    }
}

private function sendWhatsAppMessagePerananSelesai($telMobilePeranan, $peName, $peid)
{
    // WhatsApp API code remains the same
    // ...

    // Adjust the parameters according to your template and use case
    $data = [
        'phone' =>  "+673".$telMobilePeranan,
        'template' => 'ssm_selesai_peranan',
        'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8',
        'language' => ['code' => 'ms', 'policy' => 'deterministic'],
        "params" => [["type" => "body", "parameters" => [["type" => "text", "text" => $peName], ["type" => "text", "text" => $peid]]]],
    ];

    $json = json_encode($data);
    $token = '7hpe9bwi2bl1k5ja';
    $instanceId = '448643';
    $url = 'http://moe.proxy.mesh/' . $instanceId . '/sendTemplate?token=' . $token;
    $options = stream_context_create(['http' => ['method' => 'POST', 'header' => 'Content-type: application/json', 'content' => $json]]);
    $result = file_get_contents($url, false, $options);
    // WhatsApp API End
}

// end peranan

// start password

    public function updateadminpassword(Request $request)
{
    $icNos = Auth::user()->ic_no;
    $now = Carbon::now();

    try {
        // Retrieve the updated SSMPassword model
        $ssmpassword = SSMPassword::findOrFail($request->id);

        // Update the main attributes
        $ssmpassword->update([
            'ps_name' => $request->ps_name,
            'ps_icno' => $request->ps_icno,
            'ps_jawatan' => $request->ps_jawatan,
            'ps_email' => $request->ps_email,
            'ps_notel' => $request->ps_notel,
            'ps_workplace' => $request->ps_workplace,
            'ps_catatan' => $request->ps_catatan,
            'ps_status' => $request->ps_status,
            'ps_otp' => $request->ps_otp,
            'ps_updated_at' => $now,
            'ps_updatedby' => $icNos,
        ]);

        // Additional conditional updates based on ps_status
        if ($request->ps_status == 'Dihadapkan ke HD') {
            $ssmpassword->update([
                'hd_updatedat' => $now,
                'hd_updatedby' => $icNos,
            ]);
        } elseif ($request->ps_status == 'Selesai') {
            $ssmpassword->update([
                'selesai_updatedat' => $now,
                'selesai_updatedby' => $icNos,
            ]);

            // Send WhatsApp message for 'Selesai' status
            $telMobilePassword = SSMPassword::select(['ssm_password.*', \DB::raw('DATEDIFF(year,getdate(), ps_created_at) as length')])
                ->where('id', $request->id)
                ->value('ps_notel');

            $this->sendWhatsAppMessagePasswordSelesai($telMobilePassword, $request->ps_name, $request->id, $request->ps_otp);

            if (!empty($ssmpassword->ps_email)) {
            //MAIL Function reset password
            $notf_userEmail = $ssmpassword-> ps_email;
            $notf_Nama = $ssmpassword->ps_name;
            $notf_latestID = $ssmpassword->id;
            $notf_otp = $ssmpassword->ps_otp;

            Mail::to($notf_userEmail)->send(new EmailSSMResetPasswordSelesai($notf_Nama, $notf_latestID, $notf_otp));
            } else{}
        }

        return redirect()->route('ssmrequests.ssmrequest.indexall')->with('success_message', 'SSM record was successfully updated!');
    } catch (Exception $exception) {
        return back()->withInput()->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
    }
}

private function sendWhatsAppMessagePasswordSelesai($telMobilePassword, $psName, $psid, $psotp)
{
    // WhatsApp API code remains the same
    // ...

    // Adjust the parameters according to your template and use case
    $data = [
        'phone' =>  "+673".$telMobilePassword,
        'template' => 'ssm_selesai_pass',
        'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8',
        'language' => ['code' => 'ms', 'policy' => 'deterministic'],
        "params" => [["type" => "body", "parameters" => [["type" => "text", "text" => $psName], ["type" => "text", "text" => $psid],["type" => "text", "text" => $psotp]]]],
    ];

    $json = json_encode($data);
    $token = '7hpe9bwi2bl1k5ja';
    $instanceId = '448643';
    $url = 'http://moe.proxy.mesh/' . $instanceId . '/sendTemplate?token=' . $token;
    $options = stream_context_create(['http' => ['method' => 'POST', 'header' => 'Content-type: application/json', 'content' => $json]]);
    $result = file_get_contents($url, false, $options);
    // WhatsApp API End
}

// end password







        public function updateadmindc(Request $request)
    {
        
        $icNos = Auth::user()->ic_no;

        $now = Carbon::now();


        try {
                // Retrieve the updated Prestasi model
                $ssmdc = SSMDc::findOrFail($request->id);

        
                // Update the main attributes
                $ssmdc->update([
                    'dc_name'         => $request->dc_name,
                    'dc_icno'         => $request->dc_icno,
                    'dc_jawatan'      => $request->dc_jawatan,
                    'dc_email'        => $request->dc_email,
                    'dc_notel'        => $request->dc_notel,
                    'dc_datedelete'   => $request->dc_datedelete,
                    'dc_dateaduan'    => $request->dc_dateaduan,
                    'dc_catatan'    => $request->dc_catatan,
                    'dc_status'       => $request->dc_status,
                    'dc_updated_at'   => $now,
                    'dc_updatedby'    => $icNos,
                ]);
        
                // Additional conditional updates based on dc_status
                if ($request->dc_status == 'Dihadapkan ke Dynamik') {
                    $ssmdc->update([
                        'dinamik_updatedat' => $now,
                        'dinamik_updatedby' => $icNos,
                    ]);
                } elseif ($request->dc_status == 'Permohonan dipadam & Selesai') {
                    $ssmdc->update([
                        'padamselesai_updatedat' => $now,
                        'padamselesai_updatedby' => $icNos,
                    ]);
                } elseif ($request->dc_status == 'Selesai') {
                    $ssmdc->update([
                        'selesai_updatedat' => $now,
                        'selesai_updatedby' => $icNos,
                    ]);
                }
                elseif ($request->dc_status == 'Proses') {
                    $ssmdc->update([
                        'proses_updatedat' => $now,
                        'proses_updatedby' => $icNos,
                    ]);
                }
        
            // Check if 'remove_file' checkbox is selected
                    if ($request->has('remove_file')) {
                        // Remove selected files
                        $this->removeSelectedFiles($ssmdc, $request->input('remove_file'));
                    }
        
            // Handle uploaded files
                if ($request->hasFile('dc_file')) {
                    $this->handleUploadedFiles($ssmdc, $request->file('dc_file'), $request);
                }

                $telMobile = SSMDc::select(['ssm_dc.*', \DB::raw('DATEDIFF(year,getdate(), dc_created_at) as length')])
                                ->where('id', $request->id)
                                ->value('dc_notel');

                if ($request->dc_status == "Selesai" || $request->dc_status == "Permohonan dipadam & Selesai") {
                    $this->sendWhatsAppMessage($telMobile, $request->dc_name, $request->id);
                            }

    
        
                return redirect()->route('ssmrequests.ssmrequest.indexall')
                    ->with('success_message', 'Updated successfully.');
            } catch (Exception $exception) {
                return back()->withInput()
                    ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
            }
        }
        
    
        
    // Helper method to remove selected files
        private function removeSelectedFiles($ssmdc, $removeIndexes)
        {
            // Create a new array to avoid "Indirect modification" issue
            $existingFiles = $ssmdc->dc_file;
        
            // Remove selected files from the array
            foreach ($removeIndexes as $index) {
                if (isset($existingFiles[$index])) {
                    // Delete the file
                    Storage::delete('public/ssmdc/' . $existingFiles[$index]);
        
                    // Remove the element from the array
                    unset($existingFiles[$index]);
                }
            }
        
            // Reindex the array after removing elements
            $existingFiles = array_values($existingFiles);
        
            // Assign the new array back to the model
            $ssmdc->dc_file = $existingFiles;
        
            // Save the model
            $ssmdc->save();
        }
        
        // Helper method to handle uploaded files
        private function handleUploadedFiles($ssmdc, $files, $request)
        {
            $existingFiles = $ssmdc->dc_file ?: []; // If dc_file is null, default to an empty array
        
            foreach ($files as $file) {
                try {
                    // Validate and store each file
                    $filename = $file->getClientOriginalName();
                    $path = $file->storeAs('public/ssmdc', $filename);
        
                    // Append the new file name to the existing array
                    $existingFiles[] = $filename;
                } catch (\Exception $e) {
                    // Log or display the error
                    dd($e->getMessage());
                }
            }
        
            // Store the updated array in your database or perform any other actions
            $ssmdc->dc_file = $existingFiles;
            $ssmdc->save();
        }
        

        // end of updateadmindc


    private function sendWhatsAppMessage($telMobile, $dcName, $dcid)
{

    

    // Whatsapp API Start
        $data = [
            'phone' =>  "+673".$telMobile, // Receivers phone
            'template' => 'ssmdcstatus', // Template name
            'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8', // Namespace of template
            'language' =>  ['code' => 'ms', 'policy' => 'deterministic'], // Language parameters
            "params"=> [["type"=>"body","parameters"=>[["type"=>"text","text"=> $dcName],["type"=>"text","text"=> $dcid]]]],
        ];

        $json = json_encode($data); // Encode data to JSON
        // URL for request POST /message
        $token = '7hpe9bwi2bl1k5ja';
        $instanceId = '448643';
        $url = 'http://moe.proxy.mesh/' . $instanceId . '/sendTemplate?token=' . $token;
        // Make a POST request
        $options = stream_context_create(['http' => [
                'method'  => 'POST',
                'header'  => 'Content-type: application/json',
                'content' => $json
            ]
        ]);
        // Send a request
        $result = file_get_contents($url, false, $options);
        //Whatsapp API End

}

public function updateadminpermohonan(Request $request)
        {
            
            $icNos = Auth::user()->ic_no;
    
            $now = Carbon::now();
    
    
            try {
                    // Retrieve the updated Prestasi model
                    $ssmpermohonan = SSMPermohonan::findOrFail($request->id);
    
            
                    // Update the main attributes
                    $ssmpermohonan->update([
                        'permohonan_type'         => $request->permohonan_type,
                        'permohonan_date'         => $request->permohonan_date,
                        'permohonan_jabsch' => $request->permohonan_jabsch,
                        'permohonan_dept'=> $request->permohonan_dept,
                        'permohonan_catatan'         => $request->permohonan_catatan,
                        'permohonan_status'         => $request->permohonan_status,
                        'permohonan_icno' => $request->input('permohonan_icno', []),
                        'updated_at'   => $now,
                        'updated_by'    => $icNos,
                    ]);
            
                    // Additional conditional updates based on dc_status
                    if ($request->permohonan_status == 'kiv') {
                        $ssmpermohonan->update([
                        'permohonan_status'         => $request->permohonan_status,

                            'kiv_at' => $now,
                            'kiv_by' => $icNos,
                        ]);
                
                    } elseif ($request->permohonan_status == 'selesai') {
                        $ssmpermohonan->update([
                            'permohonan_status'         => $request->permohonan_status,

                            'selesai_at' => $now,
                            'selesai_by' => $icNos,
                        ]);
                    }
            
                    // Check if 'remove_file' checkbox is selected
                        if ($request->has('remove_file')) {
                            // Remove selected files
                            $this->removepermohonanFiles($ssmpermohonan, $request->input('remove_file'));
                        }
                        
                    // Handle uploaded files
                    if ($request->hasFile('permohonan_file')) {
                        $this->handlepermohonanUploadedFiles($ssmpermohonan, $request->file('permohonan_file'), $request);
                    }

                    
                    $icno = $request->icno_pemohon;
                    $kod = $request->kod;
                
                    if (!empty($request->icno) && is_array($icno) || !empty($request->kod) && is_array($kod)) {

                        $insert_data_1 = []; // Initialize the array before the loop
                    
                        for ($count_1 = 0; $count_1 < count($kod); $count_1++) {
                    
                            $data_1 = array(
                                'permohonan_id' => $request->id, //previous ID
                                'icno_pemohon' => $icno[$count_1],
                                'kod' => $kod[$count_1],   
                                'submitted_at' => $now,                                  
                                'created_at' => $now
                                
                            );
                    
                            $insert_data_1[] = $data_1;
                        }
                    
                        // Save 'Inventorybbk' data
                        SSMPermohonanicno::insert($insert_data_1);
                    }

                    return back()->withInput()
                            ->with('success_message', 'Updated successfully.');
                } catch (Exception $exception) {
                    return back()->withInput()
                        ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
                }
            }
            
        
            
            // Helper method to remove selected files
            private function removepermohonanFiles($ssmpermohonan, $removeIndexes)
            {
                // Create a new array to avoid "Indirect modification" issue
                $existingFiles = $ssmpermohonan->permohonan_file;
            
                // Remove selected files from the array
                foreach ($removeIndexes as $index) {
                    if (isset($existingFiles[$index])) {
                        // Delete the file
                        Storage::delete('public/ssmpermohonan/' . $existingFiles[$index]);
            
                        // Remove the element from the array
                        unset($existingFiles[$index]);
                    }
                }
            
                // Reindex the array after removing elements
                $existingFiles = array_values($existingFiles);
            
                // Assign the new array back to the model
                $ssmpermohonan->permohonan_file = $existingFiles;
            
                // Save the model
                $ssmpermohonan->save();
            }
            
            // Helper method to handle uploaded files
            private function handlepermohonanUploadedFiles($ssmpermohonan, $files, $request)
            {
                $existingFiles = $ssmpermohonan->permohonan_file ?: []; // If dc_file is null, default to an empty array
            
                foreach ($files as $file) {
                    try {
                        // Validate and store each file
                        $filename = $file->getClientOriginalName();
                        $path = $file->storeAs('public/ssmpermohonan', $filename);
            
                        // Append the new file name to the existing array
                        $existingFiles[] = $filename;
                    } catch (\Exception $e) {
                        // Log or display the error
                        dd($e->getMessage());
                    }
                }
            
                // Store the updated array in your database or perform any other actions
                $ssmpermohonan->permohonan_file = $existingFiles;
                $ssmpermohonan->save();
            }

            

            public function updateadminbakicuti(Request $request)
            {
                
                $icNos = Auth::user()->ic_no;
        
                $now = Carbon::now();
        
        
                try {
                        // Retrieve the updated Prestasi model
                        $ssmbakicuti = SSMBakicuti::findOrFail($request->id);
        
                
                        // Update the main attributes
                        $ssmbakicuti->update([
                            'bc_name'         => $request->bc_name,
                            'bc_icno'         => $request->bc_icno,
                            'bc_jawatan'         => $request->bc_jawatan,
                            'bc_workplace'         => $request->bc_workplace,
                            'bc_days'         => $request->bc_days,
                            'bc_daysjpp'         => $request->bc_daysjpp,
                            'bc_date'         => $request->bc_date,
                            'bc_notel'         => $request->bc_notel,
                            'bc_catatanuser'         => $request->bc_catatanuser,
                            'bc_catatanadmin'         => $request->bc_catatanadmin,
                            'bc_updated_at'   => $now,
                            'bc_updated_by'    => $icNos,
                        ]);
                
                        // Additional conditional updates based on dc_status
                        if ($request->bc_status == 'Dihadapkan ke HD') {
                            $ssmbakicuti->update([
                            'bc_status'         => $request->bc_status,
                                'bc_hd_at' => $now,
                                'bc_hd_by' => $icNos,
                            ]);
                    
                        } elseif ($request->bc_status == 'Selesai') {
                            $ssmbakicuti->update([
                                'bc_status'         => $request->bc_status,
                                'bc_selesai_at' => $now,
                                'bc_selesai_by' => $icNos,
                            ]);
                        }
                
                        // Check if 'remove_file' checkbox is selected
                            if ($request->has('remove_file')) {
                                // Remove selected files
                                $this->removebakicutiFiles($ssmbakicuti, $request->input('remove_file'));
                            }
                            
                        // Handle uploaded files
                        if ($request->hasFile('bc_file')) {
                            $this->handlebakicutiUploadedFiles($ssmbakicuti, $request->file('bc_file'), $request);
                        }

                        // whatsapphandle
                            $telMobilebakicuti = SSMBakicuti::select(['ssm_bakicuti.*', \DB::raw('DATEDIFF(year,getdate(), bc_created_at) as length')])
                                ->where('id', $request->id)
                                ->value('bc_notel');

                        if ($request->bc_status == "Selesai") {
                            $this->sendWhatsAppMessageBakiCuti($telMobilebakicuti, $request->bc_name, $request->id);
                        
                            if (!empty($ssmbakicuti->bc_email)) {
                            //MAIL Function baki cuti
                            $notf_userEmail = $ssmbakicuti-> bc_email;
                            $notf_Nama = $ssmbakicuti->bc_name;
                            $notf_latestID = $ssmbakicuti->id;

                            Mail::to($notf_userEmail)->send(new EmailSSMBakiCutiSelesai($notf_Nama, $notf_latestID));
                            } else{}
                        }
        
            
                
                        return redirect()->route('ssmrequests.ssmrequest.indexall')
                            ->with('success_message', 'Updated successfully.');
                    } catch (Exception $exception) {
                        return back()->withInput()
                            ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
                    }
                }
                
            
                
                // Helper method to remove selected files
                private function removebakicutiFiles($ssmbakicuti, $removeIndexes)
                {
                    // Create a new array to avoid "Indirect modification" issue
                    $existingFiles = $ssmbakicuti->bc_file;
                
                    // Remove selected files from the array
                    foreach ($removeIndexes as $index) {
                        if (isset($existingFiles[$index])) {
                            // Delete the file
                            Storage::delete('public/ssmbakicuti/' . $existingFiles[$index]);
                
                            // Remove the element from the array
                            unset($existingFiles[$index]);
                        }
                    }
                
                    // Reindex the array after removing elements
                    $existingFiles = array_values($existingFiles);
                
                    // Assign the new array back to the model
                    $ssmbakicuti->bc_file = $existingFiles;
                
                    // Save the model
                    $ssmbakicuti->save();
                }
                
                // Helper method to handle uploaded files
                private function handlebakicutiUploadedFiles($ssmbakicuti, $files, $request)
                {
                    $existingFiles = $ssmbakicuti->bc_file ?: []; // If dc_file is null, default to an empty array
                
                    foreach ($files as $file) {
                        try {
                            // Validate and store each file
                            $filename = $file->getClientOriginalName();
                            $path = $file->storeAs('public/ssmbakicuti', $filename);
                
                            // Append the new file name to the existing array
                            $existingFiles[] = $filename;
                        } catch (\Exception $e) {
                            // Log or display the error
                            dd($e->getMessage());
                        }
                    }
                
                    // Store the updated array in your database or perform any other actions
                    $ssmbakicuti->bc_file = $existingFiles;
                    $ssmbakicuti->save();
                }

                private function sendWhatsAppMessageBakiCuti($telMobilebakicuti, $bcName, $bcid)
                    {
                    
                        

                        // Whatsapp API Start
                            $data = [
                                'phone' =>  "+673".$telMobilebakicuti, // Receivers phone
                                'template' => 'ssm_selesai_bc3', // Template name
                                'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8', // Namespace of template
                                'language' =>  ['code' => 'ms', 'policy' => 'deterministic'], // Language parameters
                                "params"=> [["type"=>"body","parameters"=>[["type"=>"text","text"=> $bcName],["type"=>"text","text"=> $bcid]]]],
                            ];

                            $json = json_encode($data); // Encode data to JSON
                            // URL for request POST /message
                            $token = '7hpe9bwi2bl1k5ja';
                            $instanceId = '448643';
                            $url = 'http://moe.proxy.mesh/' . $instanceId . '/sendTemplate?token=' . $token;
                            // Make a POST request
                            $options = stream_context_create(['http' => [
                                    'method'  => 'POST',
                                    'header'  => 'Content-type: application/json',
                                    'content' => $json
                                ]
                            ]);
                            // Send a request
                            $result = file_get_contents($url, false, $options);
                            //Whatsapp API End

                    }

            
                    
                    public function updateadminpertukaranic(Request $request)
    {
        $icNos = Auth::user()->ic_no;
        $now = Carbon::now();

        try {
            // Retrieve the updated Prestasi model
            $ssmpertukaranic = SSMPertukaranic::findOrFail($request->id);

            // Update the main attributes
            $ssmpertukaranic->update([
                'pi_name' => $request->pi_name,
                'pi_icno_old' => $request->pi_icno_old,
                'pi_icno_new' => $request->pi_icno_new,
                'pi_jawatan' => $request->pi_jawatan,
                'pi_workplace' => $request->pi_workplace,
                'pi_email' => $request->pi_email,
                'pi_status' => $request->pi_status,
                'pi_otp' => $request->pi_otp,


                'pi_notel' => $request->pi_notel,
                'pi_catatanadmin' => $request->pi_catatanadmin,
                'pi_updated_at' => $now,
                'pi_updated_by' => $icNos,
            ]);

            // Additional conditional updates based on pi_status
            if ($request->pi_status == 'Dihadapkan ke HD') {
                $ssmpertukaranic->update([
                    'pi_status' => $request->pi_status,
                    'pi_hd_at' => $now,
                    'pi_hd_by' => $icNos,
                ]);
            } elseif ($request->pi_status == 'Selesai') {
                $ssmpertukaranic->update([
                    'pi_status' => $request->pi_status,
                    'pi_selesai_at' => $now,
                    'pi_selesai_by' => $icNos,
                ]);
            }

            // Check if 'remove_file' checkbox is selected
            if ($request->has('remove_file')) {
                // Remove selected files
                $this->removepertukaranFiles($ssmpertukaranic, $request->input('remove_file'));
            }

            // Handle uploaded files for pi_fileold
            if ($request->hasFile('pi_fileold')) {
                $this->handlepertukaranicUploadedFiles($ssmpertukaranic, $request->file('pi_fileold'), $request);
            }

            // Check if 'remove_filenew' checkbox is selected
            if ($request->has('remove_filenew')) {
                // Remove selected files
                $this->removepertukarannewFiles($ssmpertukaranic, $request->input('remove_filenew'));
            }

            // Handle uploaded files for pi_filenew
            if ($request->hasFile('pi_filenew')) {
                $this->handlepertukarannewUploadedFiles($ssmpertukaranic, $request->file('pi_filenew'), $request);
            }

            $telMobilepkp = SSMPertukaranic::select(['ssm_pertukaranic.*', \DB::raw('DATEDIFF(year,getdate(), pi_created_at) as length')])
                                ->where('id', $request->id)
                                ->value('pi_notel');

                if ($request->pi_status == "Selesai" ) {
                    $this->sendWhatsAppMessagePkp($telMobilepkp, $request->pi_name, $request->id,$request->pi_otp);

                    if (!empty($ssmpertukaranic->pi_email)) {
                    //MAIL Function reset password
                    $notf_userEmail = $ssmpertukaranic-> pi_email;
                    $notf_Nama = $ssmpertukaranic->pi_name;
                    $notf_latestID = $ssmpertukaranic->id;
                    $notf_otp = $ssmpertukaranic->pi_otp;

                    Mail::to($notf_userEmail)->send(new EmailSSMPertukaranICSelesai($notf_Nama, $notf_latestID, $notf_otp));
                    }else{}
                }

            return redirect()->route('ssmrequests.ssmrequest.indexall')
                ->with('success_message', 'Updated successfully.');
        } catch (Exception $exception) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    // Helper method to remove selected files for pi_fileold
    private function removepertukaranFiles($ssmpertukaranic, $removeIndexes)
    {
        $existingFiles = $ssmpertukaranic->pi_fileold;

        foreach ($removeIndexes as $index) {
            if (isset($existingFiles[$index])) {
                Storage::delete('public/ssmpertukaranic/' . $existingFiles[$index]);
                unset($existingFiles[$index]);
            }
        }

        $existingFiles = array_values($existingFiles);
        $ssmpertukaranic->pi_fileold = $existingFiles;
        $ssmpertukaranic->save();
    }

    // Helper method to handle uploaded files for pi_fileold
    private function handlepertukaranicUploadedFiles($ssmpertukaranic, $files, $request)
    {
        $existingFiles = $ssmpertukaranic->pi_fileold ?: [];

        foreach ($files as $file) {
            try {
                $filename = $file->getClientOriginalName();
                $path = $file->storeAs('public/ssmpertukaranic', $filename);
                $existingFiles[] = $filename;
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }

        $ssmpertukaranic->pi_fileold = $existingFiles;
        $ssmpertukaranic->save();
    }

    // Helper method to remove selected files for pi_filenew
    private function removepertukarannewFiles($ssmpertukaranic, $removeIndexes)
    {
        $existingFiles = $ssmpertukaranic->pi_filenew;

        foreach ($removeIndexes as $index) {
            if (isset($existingFiles[$index])) {
                Storage::delete('public/ssmpertukaranic/' . $existingFiles[$index]);
                unset($existingFiles[$index]);
            }
        }

        $existingFiles = array_values($existingFiles);
        $ssmpertukaranic->pi_filenew = $existingFiles;
        $ssmpertukaranic->save();
    }

    // Helper method to handle uploaded files for pi_filenew
    private function handlepertukarannewUploadedFiles($ssmpertukaranic, $files, $request)
    {
        $existingFiles = $ssmpertukaranic->pi_filenew ?: [];

        foreach ($files as $file) {
            try {
                $filename = $file->getClientOriginalName();
                $path = $file->storeAs('public/ssmpertukaranic', $filename);
                $existingFiles[] = $filename;
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }

        $ssmpertukaranic->pi_filenew = $existingFiles;
        $ssmpertukaranic->save();
    }

    private function sendWhatsAppMessagePkp($telMobilepkp, $piName, $piid,$piotp)
{

    

    // Whatsapp API Start
        $data = [
            'phone' =>  "+673".$telMobilepkp, // Receivers phone
            'template' => 'ssm_selesai_pkp', // Template name
            'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8', // Namespace of template
            'language' =>  ['code' => 'ms', 'policy' => 'deterministic'], // Language parameters
            "params"=> [["type"=>"body","parameters"=>[["type"=>"text","text"=> $piName],["type"=>"text","text"=> $piid],["type"=>"text","text"=> $piotp]]]],
        ];

        $json = json_encode($data); // Encode data to JSON
        // URL for request POST /message
        $token = '7hpe9bwi2bl1k5ja';
        $instanceId = '448643';
        $url = 'http://moe.proxy.mesh/' . $instanceId . '/sendTemplate?token=' . $token;
        // Make a POST request
        $options = stream_context_create(['http' => [
                'method'  => 'POST',
                'header'  => 'Content-type: application/json',
                'content' => $json
            ]
        ]);
        // Send a request
        $result = file_get_contents($url, false, $options);
        //Whatsapp API End

}
        
    
    



    public function showadmin($id)
    {

        $ssm = SSM::all()->where('id', '=', $id)->first();

        $icNos = $ssm->ic_no;


        $ssms = SSM::all()
            ->where('ic_no', '=', $icNos);

        $biodata = Biodata::select('biodatas.*')
            ->where('ic_no', $icNos)
            ->first();

        $biodatas = Biodata::all()
            ->where('ic_no', '=', $icNos);
        $contacts = Contact::all()
            ->where('ic_no', '=', $icNos);
        $employments = Employment::all()
            ->where('ic_no', '=', $icNos);
        $educations = Education::all()
            ->where('ic_no', '=', $icNos);
        $performances = Performance::all()
            ->where('ic_no', '=', $icNos);
        $medals = Medal::all()
            ->where('ic_no', '=', $icNos);
        $salarys = Salary::all()
            ->where('ic_no', '=', $icNos);
        $certificates = Certificate::all()
            ->where('ic_no', '=', $icNos);
        $exams = Exam::all()
            ->where('ic_no', '=', $icNos);
        $programmes = Programme::all()
            ->where('ic_no', '=', $icNos);
        $paperworks = Paperwork::all()
            ->where('ic_no', '=', $icNos);
        $courses = Course::all()
            ->where('ic_no', '=', $icNos);

        $files = File::all()
            ->where('ic_no', '=', $icNos);




        $school = Employment::leftjoin('departments', 'emp_employment_infos.school_id', '=', 'departments.code')
            ->select('departments.label as school_name')
            ->where('emp_employment_infos.ic_no', $icNos)
            ->first();

        return view('ssmrequests.showadmin', compact('biodata', 'school', 'salarys', 'biodatas', 'contacts', 'employments', 'educations', 'performances', 'medals', 'certificates', 'exams', 'programmes', 'paperworks', 'courses', 'files', 'ssm', 'ssms'));
    }

    public function destroyapproval($id)
{
    try {

        $ssmapproval = SSMApproval::where('id', $id)->delete();

        return redirect()->back()
        ->with('success_message', 'Record was successfully deleted!');
    } catch (Exception $exception) {

        return back()->withInput()
            ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
    }
}

    public function destroydc($id)
{
    try {

        $ssmdc = SSMDc::where('id', $id)->delete();

        return redirect()->back()
        ->with('success_message', 'Record was successfully deleted!');
    } catch (Exception $exception) {

        return back()->withInput()
            ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
    }
}

    public function destroyperanan($id)
{
    try {

        $ssmperanan = SSMPeranan::where('id', $id)->delete();

        return redirect()->back()
        ->with('success_message', 'Record was successfully deleted!');
    } catch (Exception $exception) {

        return back()->withInput()
            ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
    }
}

    public function destroypassword($id)
{
    try {

        $ssmpassword = SSMPassword::where('id', $id)->delete();

        return redirect()->back()
        ->with('success_message', 'Record was successfully deleted!');
    } catch (Exception $exception) {

        return back()->withInput()
            ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
    }
}

    public function destroybakicuti($id)
{
    try {

        $ssmbakicuti = SSMBakicuti::where('id', $id)->delete();

        return redirect()->back()
        ->with('success_message', 'Record was successfully deleted!');
    } catch (Exception $exception) {

        return back()->withInput()
            ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
    }
}

    public function destroypertukaranic($id)
{
    try {

        $ssmpertukaranic = SSMPertukaranic::where('id', $id)->delete();

        return redirect()->back()
        ->with('success_message', 'Record was successfully deleted!');
    } catch (Exception $exception) {

        return back()->withInput()
            ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
    }
}

    public function destroyother($id)
{
    try {

        $ssmother = SSMOthers::where('id', $id)->delete();

        return redirect()->back()
        ->with('success_message', 'Record was successfully deleted!');
    } catch (Exception $exception) {

        return back()->withInput()
            ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
    }
}







    public function destroy($id)
    {
        try {

            $ssm = SSM::where('id', $id)->delete();

            return redirect()->route('ssmrequests.ssmrequest.indexall')
                ->with('success_message', 'SSM was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }
}


// log 14nov23
//ekma add storeapproval, storedc, storeot,storeps,storepe
//loh9122023
//ekma add editadminperanan, updateadminperanan
