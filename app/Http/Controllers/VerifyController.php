<?php

namespace App\Http\Controllers;

use Session;
use DB;
use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;

// use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use App\Models\VaccinationDose;
use Illuminate\Support\Facades\Crypt;

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
use App\Models\Employment;
use App\Models\ART;
use App\Models\QO;
use App\Models\TempatBertugas;
use Log;
use Carbon\Carbon;

class VerifyController extends Controller
{
    
    public function verify($id)
    {

	$ID = Crypt::decrypt($id);

	$qo1 = QO::all()->where('emp_qo_infos_id', '=', $ID)->first();

        $icNos = $qo1->ic_no;

        $biodatas = Biodata::all()
            ->where('ic_no', '=', $icNos);
	
	$qo = QO::all()->where('emp_qo_infos_id', '=', $ID);


      
        
	return view('verify', compact('qo', 'biodatas'));
    }

}
