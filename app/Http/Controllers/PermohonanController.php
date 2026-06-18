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

use App\Http\Controllers\Controller;

use App\Models\Day;
use App\Models\Biodata;
use App\Models\Grade;
use App\Models\Contact;
use App\Models\Performance;

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
use App\Models\Exam;
use App\Models\ART;
use App\Models\QO;
use App\Models\TempatBertugas;
use App\Models\Permohonan;
use Log;
use Carbon\Carbon;

class PermohonanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $icNos = Auth::user()->ic_no;

        $permohonans = Permohonan::select('permohonans.*')
            ->orderBy('created_at', 'DESC')
            ->where([['ic_no', '=', $icNos]])
            ->get();

        $biodatas = Biodata::all()
            ->where('ic_no', '=', $icNos);



        return view('permohonans.index', compact('permohonans', 'biodatas'));
    }

    public function indexadmin()
    {

        $permohonans = Permohonan::select('permohonans.*')->orderBy('created_at', 'DESC')->get();



        return view('permohonans.indexadmin', compact('permohonans'));
    }

    public function create()
    {
        $icNos = Auth::user()->ic_no;

        $biodatas = Biodata::all()
            ->where('ic_no', '=', $icNos);

        $grades = Grade::pluck('label', 'id')->all();
        $examgradId = Exam::select(['emp_exam_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('grade_id');

        $employments = Employment::all()
            ->where('ic_no', '=', $icNos);

        $contacts = Contact::all()
            ->where('ic_no', '=', $icNos);

        $permohonans = Permohonan::all()
            ->where('ic_no', '=', $icNos);

        //get last record
        $performances1 = Performance::latest()->take(1)->get()
            ->where('ic_no', '=', $icNos);

        //get second last record
        $performances2 = Performance::latest()->skip(1)->take(1)->get()
            ->where('ic_no', '=', $icNos);

        // get third last record
        $performances3 = Performance::latest()->skip(2)->take(1)->get()
            ->where('ic_no', '=', $icNos);

        // get fourth last record

        $performances4 = Performance::latest()->skip(3)->take(1)->get()
            ->where('ic_no', '=', $icNos);


        return view('permohonans.create', compact('biodatas', 'contacts', 'employments', 'permohonans', 'performances1', 'performances2', 'performances3', 'performances4', 'grades', 'examgradId'));
    }


    public function store(Request $request)
    {
         $request->validate([
            'file' => 'required'
        ]);

        $icNos = Auth::user()->ic_no;

        if ($request->year1 != '' || $request->percentage1 != '' || $request->grade_id1 != '' || $request->file_1 != '') {

            $request->validate([]);

            $perf1 = new Performance;
            $perf1->ic_no = $icNos;
            $perf1->year = $request->year1;
            $perf1->percentage = $request->percentage1;
            $perf1->grade_id = $request->grade_id1;
            $perf1->file_name = $request->file_1->getClientOriginalName();
            $perf1->file_1 = $request->file('file_1')->store('performance', 'public');
            $perf1->save();
        }

        if ($request->year2 != '' || $request->percentage2 != '' || $request->grade_id2 != '' || $request->file_2 != '') {

            $request->validate([]);

            $perf2 = new Performance;
            $perf2->ic_no = $icNos;
            $perf2->year = $request->year2;
            $perf2->percentage = $request->percentage2;
            $perf2->grade_id = $request->grade_id2;
            $perf2->file_name = $request->file_2->getClientOriginalName();
            $perf2->file_1 = $request->file('file_2')->store('performance', 'public');
            $perf2->save();
        }

        if ($request->year3 != '' || $request->percentage3 != '' || $request->grade_id3 != '' || $request->file_3 != '') {

            $request->validate([]);

            $perf3 = new Performance;
            $perf3->ic_no = $icNos;
            $perf3->year = $request->year3;
            $perf3->percentage = $request->percentage3;
            $perf3->grade_id = $request->grade_id3;
            $perf3->file_name = $request->file_3->getClientOriginalName();
            $perf3->file_1 = $request->file('file_3')->store('performance', 'public');
            $perf3->save();
        }

        if ($request->year4 != '' || $request->percentage4 != '' || $request->grade_id4 != '' || $request->file_4 != '') {

            $request->validate([]);

            $perf4 = new Performance;
            $perf4->ic_no = $icNos;
            $perf4->year = $request->year4;
            $perf4->percentage = $request->percentage4;
            $perf4->grade_id = $request->grade_id4;
            $perf4->file_name = $request->file_4->getClientOriginalName();
            $perf4->file_1 = $request->file('file_4')->store('performance', 'public');
            $perf4->save();
        }

        $permohonans = new Permohonan;
        $permohonans->ic_no = $icNos;
        $permohonans->name = $request->name;
        $permohonans->email = $request->email;
        $permohonans->place = $request->place;
        $permohonans->nama_jawatan = $request->nama_jawatan;
        $permohonans->tarikh_tutup = $request->tarikh_tutup;
        $permohonans->jabatan_kementerian = $request->jabatan_kementerian;
        $permohonans->filename = $request->file->getClientOriginalName();
        $permohonans->file = $request->file('file')->store('permohonan', 'public');
        // Save 'Permohonan' data
        $permohonans->save();

        return redirect()->route('permohonans.permohonan.index')
            ->with('success_message', 'New Permohonan Jawatan Kosong record was successfully added!');
    }


    public function edit($id)
    {


        // $icNos = Auth::user()->ic_no;


        $permohonans = Permohonan::all()
            ->where('id', '=', $id);

        $icNos = Auth::user()->ic_no;

        $biodatas = Biodata::all()
            ->where('ic_no', '=',  $icNos);

        $employments = Employment::all()
            ->where('ic_no', '=', $icNos);

        $contacts = Contact::all()
            ->where('ic_no', '=', $icNos);


        $address = Contact::select(['emp_contact_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('address');

        $grades = Grade::pluck('label', 'id')->all();
        $examgradId = Exam::select(['emp_exam_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('grade_id');

         //get last record
        $performances4 = Performance::orderBy('id', 'desc')->take(1)->get()
            ->where('ic_no', '=', $icNos);

        //get second last record
        $performances3 = Performance::orderBy('id', 'desc')->skip(1)->take(1)->get()
            ->where('ic_no', '=', $icNos);

        // get third last record
        $performances2 = Performance::orderBy('id', 'desc')->skip(2)->take(1)->get()
            ->where('ic_no', '=', $icNos);

        // get fourth last record

        $performances1 = Performance::orderBy('id', 'desc')->skip(3)->take(1)->get()
            ->where('ic_no', '=', $icNos);






        return view('permohonans.edit', compact('permohonans', 'biodatas', 'employments', 'contacts', 'address', 'performances1', 'performances2', 'performances3', 'performances4', 'grades', 'examgradId'));
    }

    public function update(Request $request)
    {
        // $request->validate([



        // ]);

        $now = Carbon::now();

        $icNos = Auth::user()->ic_no;



        $permohonans =  Permohonan::select('permohonans.*')
            ->where('id', $request->id)
            ->update([

                'place' => $request->place,
                'nama_jawatan'         =>      $request->nama_jawatan,
                'tarikh_tutup'         =>      $request->tarikh_tutup,
                'jabatan_kementerian'         =>      $request->jabatan_kementerian,
                'updated_at' => $now
            ]);


        if ($request->year1 != '' || $request->percentage1 != '' || $request->grade_id1 != '' || $request->file_1 != '') {

            $request->validate([]);

            $perf1 = new Performance;
            $perf1->ic_no = $icNos;
            $perf1->year = $request->year1;
            $perf1->percentage = $request->percentage1;
            $perf1->grade_id = $request->grade_id1;
            $perf1->file_name = $request->file_1->getClientOriginalName();
            $perf1->file_1 = $request->file('file_1')->store('performance', 'public');
            $perf1->save();
        }

        if ($request->year2 != '' || $request->percentage2 != '' || $request->grade_id2 != '' || $request->file_2 != '') {

            $request->validate([]);

            $perf2 = new Performance;
            $perf2->ic_no = $icNos;
            $perf2->year = $request->year2;
            $perf2->percentage = $request->percentage2;
            $perf2->grade_id = $request->grade_id2;
            $perf2->file_name = $request->file_2->getClientOriginalName();
            $perf2->file_1 = $request->file('file_2')->store('performance', 'public');
            $perf2->save();
        }

        if ($request->year3 != '' || $request->percentage3 != '' || $request->grade_id3 != '' || $request->file_3 != '') {

            $request->validate([]);

            $perf3 = new Performance;
            $perf3->ic_no = $icNos;
            $perf3->year = $request->year3;
            $perf3->percentage = $request->percentage3;
            $perf3->grade_id = $request->grade_id3;
            $perf3->file_name = $request->file_3->getClientOriginalName();
            $perf3->file_1 = $request->file('file_3')->store('performance', 'public');
            $perf3->save();
        }

        if ($request->year4 != '' || $request->percentage4 != '' || $request->grade_id4 != '' || $request->file_4 != '') {

            $request->validate([]);

            $perf4 = new Performance;
            $perf4->ic_no = $icNos;
            $perf4->year = $request->year4;
            $perf4->percentage = $request->percentage4;
            $perf4->grade_id = $request->grade_id4;
            $perf4->file_name = $request->file_4->getClientOriginalName();
            $perf4->file_1 = $request->file('file_4')->store('performance', 'public');
            $perf4->save();
        }


        return redirect()->route('permohonans.permohonan.index')
            ->with('success_message', 'PJK record was successfully updated!');
    }




    public function editadmin($id)
    {


         $permohonans = Permohonan::all()->where('id', '=', $id)->first();

        $icNos = $permohonans->ic_no;


        $permohonans = Permohonan::all()
            ->where('ic_no', '=', $icNos);

        $permohonans = Permohonan::all()->where('id', '=', $id);


        $biodatas = Biodata::all()
            ->where('ic_no', '=', $icNos);

        $employments = Employment::all()
            ->where('ic_no', '=', $icNos);

        $contacts = Contact::all()
            ->where('ic_no', '=', $icNos);


        $address = Contact::select(['emp_contact_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('address');

        $grades = Grade::pluck('label', 'id')->all();
        $examgradId = Exam::select(['emp_exam_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('grade_id');

        // $performances = Performance::all()
        //     ->where('ic_no', '=', $icNos)
        //     ->latest()->take(4)->get();

         //get last record
        $performances4 = Performance::orderBy('id', 'desc')->take(1)->get()
            ->where('ic_no', '=', $icNos);

        //get second last record
        $performances3 = Performance::orderBy('id', 'desc')->skip(1)->take(1)->get()
            ->where('ic_no', '=', $icNos);

        // get third last record
        $performances2 = Performance::orderBy('id', 'desc')->skip(2)->take(1)->get()
            ->where('ic_no', '=', $icNos);

        // get fourth last record

        $performances1 = Performance::orderBy('id', 'desc')->skip(3)->take(1)->get()
            ->where('ic_no', '=', $icNos);










        return view('permohonans.editadmin', compact('biodatas', 'employments', 'contacts', 'address', 'permohonans', 'performances1', 'performances2', 'performances3', 'performances4', 'grades', 'examgradId'));
    }


    public function updateadmin(Request $request)
    {


        $request->validate([]);

        $now = Carbon::now();


        $permohonans = Permohonan::all()->where('id', '=', $request->id)->first();

        $icNos = $permohonans->ic_no;


        if ($request->year1 != '' || $request->percentage1 != '' || $request->grade_id1 != '' || $request->file_1 != '') {

            $request->validate([]);

            $perf1 = new Performance;
            $perf1->ic_no = $icNos;
            $perf1->year = $request->year1;
            $perf1->percentage = $request->percentage1;
            $perf1->grade_id = $request->grade_id1;
            $perf1->file_name = $request->file_1->getClientOriginalName();
            $perf1->file_1 = $request->file('file_1')->store('performance', 'public');
            $perf1->save();
        }

        if ($request->year2 != '' || $request->percentage2 != '' || $request->grade_id2 != '' || $request->file_2 != '') {

            $request->validate([]);

            $perf2 = new Performance;
            $perf2->ic_no = $icNos;
            $perf2->year = $request->year2;
            $perf2->percentage = $request->percentage2;
            $perf2->grade_id = $request->grade_id2;
            $perf2->file_name = $request->file_2->getClientOriginalName();
            $perf2->file_1 = $request->file('file_2')->store('performance', 'public');
            $perf2->save();
        }

        if ($request->year3 != '' || $request->percentage3 != '' || $request->grade_id3 != '' || $request->file_3 != '') {

            $request->validate([]);

            $perf3 = new Performance;
            $perf3->ic_no = $icNos;
            $perf3->year = $request->year3;
            $perf3->percentage = $request->percentage3;
            $perf3->grade_id = $request->grade_id3;
            $perf3->file_name = $request->file_3->getClientOriginalName();
            $perf3->file_1 = $request->file('file_3')->store('performance', 'public');
            $perf3->save();
        }

        if ($request->year4 != '' || $request->percentage4 != '' || $request->grade_id4 != '' || $request->file_4 != '') {

            $request->validate([]);

            $perf4 = new Performance;
            $perf4->ic_no = $icNos;
            $perf4->year = $request->year4;
            $perf4->percentage = $request->percentage4;
            $perf4->grade_id = $request->grade_id4;
            $perf4->file_name = $request->file_4->getClientOriginalName();
            $perf4->file_1 = $request->file('file_4')->store('performance', 'public');
            $perf4->save();
        }


        $permohonans =  Permohonan::select('permohonans.*')
            ->where('id', $request->id)
            ->update([
                'place' => $request->place,
                'nama_jawatan'         =>      $request->nama_jawatan,
                'tarikh_tutup'         =>      $request->tarikh_tutup,
                'tarikh_sah'         =>      $request->tarikh_sah,
                'jabatan_kementerian'         =>      $request->jabatan_kementerian,
                'tindakan'         =>      $request->tindakan,
                'updated_at' => $now
            ]);

        return redirect()->route('permohonans.permohonan.indexadmin')
            ->with('success_message', 'PJK record was successfully updated!');
    }


    public function showadmin(Request $request, $id)
    {

        // $icNos = Auth::user()->ic_no;]


          $permohonans = Permohonan::all()->where('id', '=', $id)->first();

        $icNos = $permohonans->ic_no;


        $permohonans = Permohonan::all()
            ->where('ic_no', '=', $icNos);

        $permohonans = Permohonan::all()->where('id', '=', $id);




        $biodatas = Biodata::all()
            ->where('ic_no', '=', $icNos);


        $biodata = Biodata::select('biodatas.*')
            ->where('ic_no', $icNos);


        $employments = Employment::all()
            ->where('ic_no', '=', $icNos);

        $contacts = Contact::all()
            ->where('ic_no', '=', $icNos);

      //get last record
        $performances4 = Performance::orderBy('id', 'desc')->take(1)->get()
            ->where('ic_no', '=', $icNos);

        //get second last record
        $performances3 = Performance::orderBy('id', 'desc')->skip(1)->take(1)->get()
            ->where('ic_no', '=', $icNos);

        // get third last record
        $performances2 = Performance::orderBy('id', 'desc')->skip(2)->take(1)->get()
            ->where('ic_no', '=', $icNos);

        // get fourth last record

        $performances1 = Performance::orderBy('id', 'desc')->skip(3)->take(1)->get()
            ->where('ic_no', '=', $icNos);



        return view('permohonans.showadmin', compact('biodatas', 'employments', 'contacts', 'permohonans', 'performances1', 'performances2', 'performances3', 'performances4'));
    }





    public function destroy($id)
    {
        try {


            $permohonans = Permohonan::where('id', $id)->delete();

            return redirect()->route('permohonans.permohonan.index')
                ->with('success_message', 'PJK was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

        public function destroyadmin($id)
    {
        try {


            $permohonans = Permohonan::where('id', $id)->delete();

            return redirect()->route('permohonans.permohonan.indexadmin')
                ->with('success_message', 'PJK was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }
}
