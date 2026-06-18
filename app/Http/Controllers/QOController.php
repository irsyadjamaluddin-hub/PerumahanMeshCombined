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

class QOController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the Biodata applications.
     *
     * @return Illuminate\View\View
     */

    public function index()
    {

        $icNos = Auth::user()->ic_no;

        $qos = QO::select('emp_qo_infos.*')
            ->orderBy('created_at', 'DESC')
            ->where([['ic_no', '=', $icNos]])
            ->get();

        return view('skbs.index', compact('qos'));
    }



    public function indexadmin()
    {



        // $icNos = Auth::user()->ic_no;


        $qos = QO::leftJoin('biodatas', 'emp_qo_infos.ic_no', '=', 'biodatas.ic_no')
            ->select('emp_qo_infos.*', 'biodatas.name')
            ->orderBy('created_at', 'DESC')
            ->get();

        // $qos = QO::select('emp_qo_infos.*')
        //     ->orderBy('created_at', 'DESC')
        //     ->where([['ic_no', '=', $icNos]])
        //     ->get();




        return view('skbs.indexadmin', compact('qos'));
    }

    public function create()
    {
        $icNos = Auth::user()->ic_no;

        $biodatas = Biodata::all()
            ->where('ic_no', '=', $icNos);

        $employments = Employment::all()
            ->where('ic_no', '=', $icNos);

        $contacts = Contact::all()
            ->where('ic_no', '=', $icNos);

        $tempatbertugasqo = TempatBertugas::pluck('label', 'id')->all();


        return view('skbs.create', compact('biodatas', 'contacts', 'employments', 'tempatbertugasqo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            // 'current_designation' => 'required',
            // 'bruhealth_img' => 'mimes:jpg,jpeg,bmp,png,pdf|max:2048',
            'qo_work_places' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        $icNos = Auth::user()->ic_no;

        $employment =  Employment::select('emp_employment_infos.*')
            ->where('ic_no', $icNos)
            ->update([
                'current_designation_id'         =>      $request->current_designation,
            ]);

        $contact =  Employment::select('emp_employment_infos.*')
            ->where('ic_no', $icNos)
            ->update([
                'current_designation_id'         =>      $request->current_designation,
            ]);



        $QO = new QO;
        $QO->ic_no = $icNos;
        $QO->dept = $request->department_id;
        // $QO->post = $request->current_designation;
        $QO->qo_work_places = $request->qo_work_places;
        $QO->start_date = $request->start_date;
        $QO->end_date = $request->end_date;
        $QO->qo_filename = $request->bruhealth_img->getClientOriginalName();
        $QO->bruhealth_img = $request->file('bruhealth_img')->store('qo', 'public');


        if ($request->place1 != '' || $request->art_date1 != '' || $request->art_file1 != '') {

            $request->validate([
                'place1' => 'required',
                'art_date1' => 'required',
                'art_file1' => 'required',
                'result_id1' => 'required'
            ]);

            $art1 = new ART;
            $art1->ic_no = $icNos;
            $art1->art_result = $request->result_id1;
            $art1->date_test = $request->art_date1;
            $art1->department_id = $request->department_id;
            $art1->work_place = $request->place1;
            $art1->art_filename = $request->art_file1->getClientOriginalName();
            $art1->art_image = $request->file('art_file1')->store('art', 'public');
            $art1->qo = 'y';
            $art1->day = '1';

            $art1->save();
        }

        if ($request->place2 != '' || $request->art_date2 != '' || $request->art_file2 != '') {

            $request->validate([
                'place2' => 'required',
                'art_date2' => 'required',
                'art_file2' => 'required',
                'result_id2' => 'required'
            ]);

            $art2 = new ART;
            $art2->ic_no = $icNos;
            $art2->art_result = $request->result_id2;
            $art2->date_test = $request->art_date2;
            $art2->department_id = $request->department_id;
            $art2->work_place = $request->place2;
            $art2->art_filename = $request->art_file2->getClientOriginalName();
            $art2->art_image = $request->file('art_file2')->store('art', 'public');
            $art2->qo = 'y';
            $art2->day = '2';

            $art2->save();
        }

        if ($request->place3 != '' || $request->art_date3 != '' || $request->art_file3 != '') {

            $request->validate([
                'place3' => 'required',
                'art_date3' => 'required',
                'art_file3' => 'required',
                'result_id3' => 'required'
            ]);

            $art3 = new ART;
            $art3->ic_no = $icNos;
            $art3->art_result = $request->result_id3;
            $art3->date_test = $request->art_date3;
            $art3->department_id = $request->department_id;
            $art3->work_place = $request->place3;
            $art3->art_filename = $request->art_file3->getClientOriginalName();
            $art3->art_image = $request->file('art_file3')->store('art', 'public');
            $art3->qo = 'y';
            $art3->day = '3';

            $art3->save();
        }

        if ($request->place4 != '' || $request->art_date4 != '' || $request->art_file4 != '') {

            $request->validate([
                'place4' => 'required',
                'art_date4' => 'required',
                'art_file4' => 'required',
                'result_id4' => 'required'
            ]);

            $art4 = new ART;
            $art4->ic_no = $icNos;
            $art4->art_result = $request->result_id4;
            $art4->date_test = $request->art_date4;
            $art4->department_id = $request->department_id;
            $art4->work_place = $request->place4;
            $art4->art_filename = $request->art_file4->getClientOriginalName();
            $art4->art_image = $request->file('art_file4')->store('art', 'public');
            $art4->qo = 'y';
            $art4->day = '4';

            $art4->save();
        }

        if ($request->place5 != '' || $request->art_date5 != '' || $request->art_file5 != '') {

            $request->validate([
                'place5' => 'required',
                'art_date5' => 'required',
                'art_file5' => 'required',
                'result_id5' => 'required'
            ]);

            $art5 = new ART;
            $art5->ic_no = $icNos;
            $art5->art_result = $request->result_id5;
            $art5->date_test = $request->art_date5;
            $art5->department_id = $request->department_id;
            $art5->work_place = $request->place5;
            $art5->art_filename = $request->art_file5->getClientOriginalName();
            $art5->art_image = $request->file('art_file5')->store('art', 'public');
            $art5->qo = 'y';
            $art5->day = '5';

            $art5->save();
        }

        // Save 'QO' data
        $QO->save();

        return redirect()->route('skbs.skb.index')
            ->with('success_message', 'New SKB record was successfully added!');
    }

    public function edit($id)
    {

        $qo = QO::all()
            ->where('id', '=', $id);

        $icNos = Auth::user()->ic_no;

        $biodatas = Biodata::all()
            ->where('ic_no', '=', $icNos);

        $employments = Employment::all()
            ->where('ic_no', '=', $icNos);

        $contacts = Contact::all()
            ->where('ic_no', '=', $icNos);

        $address = Contact::select(['emp_contact_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('address');

        //$qos = QO::all()->where('emp_qo_infos_id', '=', $id);

        $qosDate = QO::all()->where('emp_qo_infos_id', '=', $id)->first();

        $qos = QO::leftJoin('biodatas', 'emp_qo_infos.ic_no', '=', 'biodatas.ic_no')
            ->leftJoin('tempatbertugasqos', 'emp_qo_infos.qo_work_places', '=', 'tempatbertugasqos.id')
            ->select('emp_qo_infos.*', 'biodatas.name', 'tempatbertugasqos.label')
            ->orderBy('created_at', 'DESC')
            ->where('emp_qo_infos_id', '=', $id)
            ->get();



        $artday1 = ART::where([['qo', '=', 'y'], ['day', '=', '1'], ['ic_no', '=', $icNos]])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->get();

        $artday2 = ART::where([['qo', '=', 'y'], ['day', '=', '2'], ['ic_no', '=', $icNos]])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->get();

        $artday3 = ART::where([['qo', '=', 'y'], ['day', '=', '3'], ['ic_no', '=', $icNos]])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->get();

        $artday4 = ART::where([['qo', '=', 'y'], ['day', '=', '4'], ['ic_no', '=', $icNos]])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->get();

        $artday5 = ART::where([['qo', '=', 'y'], ['day', '=', '5'], ['ic_no', '=', $icNos]])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->get();

        $tempatbertugasqo = TempatBertugas::pluck('label', 'id')->all();

        return view('skbs.edit', compact('qo', 'biodatas', 'employments', 'contacts', 'address', 'qos', 'artday1', 'artday2', 'artday3', 'artday4', 'artday5', 'tempatbertugasqo'));
    }


    public function editadmin($id)
    {


        $qo = QO::all()->where('emp_qo_infos_id', '=', $id)->first();

        $icNos = $qo->ic_no;


        $biodatas = Biodata::all()
            ->where('ic_no', '=', $icNos);

        $employments = Employment::all()
            ->where('ic_no', '=', $icNos);

        $contacts = Contact::all()
            ->where('ic_no', '=', $icNos);


        $qos = QO::leftJoin('biodatas', 'emp_qo_infos.ic_no', '=', 'biodatas.ic_no')
            ->select('emp_qo_infos.*', 'biodatas.name')
            ->orderBy('created_at', 'DESC')
            ->get();

        $address = Contact::select(['emp_contact_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('address');



        $qos = QO::all()->where('emp_qo_infos_id', '=', $id);

        $qosDate = QO::all()->where('emp_qo_infos_id', '=', $id)->first();

        $artday1 = ART::where([['qo', '=', 'y'], ['day', '=', '1'], ['ic_no', '=', $icNos]])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->get();

        $artday2 = ART::where([['qo', '=', 'y'], ['day', '=', '2'], ['ic_no', '=', $icNos]])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->get();

        $artday3 = ART::where([['qo', '=', 'y'], ['day', '=', '3'], ['ic_no', '=', $icNos]])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->get();

        $artday4 = ART::where([['qo', '=', 'y'], ['day', '=', '4'], ['ic_no', '=', $icNos]])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->get();

        $artday5 = ART::where([['qo', '=', 'y'], ['day', '=', '5'], ['ic_no', '=', $icNos]])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->get();

        $tempatbertugasqo = TempatBertugas::pluck('label', 'id')->all();


        $art1 = ART::where([['qo', '=', 'y'], ['day', '=', '1']])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->first();

        $art2 = ART::where([['qo', '=', 'y'], ['day', '=', '2']])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->first();

        $art3 = ART::where([['qo', '=', 'y'], ['day', '=', '3']])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->first();

        $art4 = ART::where([['qo', '=', 'y'], ['day', '=', '4']])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->first();

        $art5 = ART::where([['qo', '=', 'y'], ['day', '=', '5']])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->first();


        $qos = QO::leftJoin('biodatas', 'emp_qo_infos.ic_no', '=', 'biodatas.ic_no')
            ->leftJoin('tempatbertugasqos', 'emp_qo_infos.qo_work_places', '=', 'tempatbertugasqos.id')
            ->select('emp_qo_infos.*', 'biodatas.name', 'tempatbertugasqos.label')
            ->orderBy('created_at', 'DESC')
            ->where('emp_qo_infos_id', '=', $id)
            ->get();



        return view('skbs.editadmin', compact('biodatas', 'employments', 'contacts', 'address', 'qos', 'artday1', 'artday2', 'artday3', 'artday4', 'artday5', 'tempatbertugasqo', 'art1', 'art2', 'art3', 'art4', 'art5'));

        //return $icNos;
    }




    public function show(Request $request, $id)
    {

        $icNos = Auth::user()->ic_no;

        $biodatas = Biodata::all()
            ->where('ic_no', '=', $icNos);

        $employments = Employment::all()
            ->where('ic_no', '=', $icNos);

        $contacts = Contact::all()
            ->where('ic_no', '=', $icNos);

        $qos = QO::all()->where('emp_qo_infos_id', '=', $id);

        $qosDate = QO::all()->where('emp_qo_infos_id', '=', $id)->first();


        // $qos = QO::leftJoin('biodatas', 'emp_qo_infos.ic_no', '=', 'biodatas.ic_no')
        //     ->select('emp_qo_infos.*', 'biodatas.name')
        //     ->orderBy('created_at', 'DESC')
        //     ->get();

        //for compact
        if($qosDate){
            $artday1 = ART::where([['qo', '=', 'y'], ['day', '=', '1'], ['ic_no', '=', $icNos]])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->get();

        $artday2 = ART::where([['qo', '=', 'y'], ['day', '=', '2'], ['ic_no', '=', $icNos]])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->get();

        $artday3 = ART::where([['qo', '=', 'y'], ['day', '=', '3'], ['ic_no', '=', $icNos]])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->get();

        $artday4 = ART::where([['qo', '=', 'y'], ['day', '=', '4'], ['ic_no', '=', $icNos]])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->get();

        $artday5 = ART::where([['qo', '=', 'y'], ['day', '=', '5'], ['ic_no', '=', $icNos]])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->get();



        $art1 = ART::where([['qo', '=', 'y'], ['day', '=', '1']])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->first();

        $art2 = ART::where([['qo', '=', 'y'], ['day', '=', '2']])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->first();

        $art3 = ART::where([['qo', '=', 'y'], ['day', '=', '3']])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->first();

        $art4 = ART::where([['qo', '=', 'y'], ['day', '=', '4']])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->first();

        $art5 = ART::where([['qo', '=', 'y'], ['day', '=', '5']])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->first();
        }
       



        if (empty($art1)) {

            return abort(403);
        } else {

            if ($art1->art_result == '+ve') {
                return abort(403);
            } else {

                if (empty($art2)) {

                    return view('skbs.show', compact('biodatas', 'employments', 'contacts', 'qos', 'artday1', 'artday2', 'artday3', 'artday4', 'artday5', 'art1', 'art2', 'art3', 'art4', 'art5'));
                } else {

                    if ($art2->art_result == '+ve') {
                        return abort(403);
                    } else {

                        if (empty($art3)) {

                            return view('skbs.show', compact('biodatas', 'employments', 'contacts', 'qos', 'artday1', 'artday2', 'artday3', 'artday4', 'artday5', 'art1', 'art2', 'art3', 'art4', 'art5'));
                        } else {

                            if ($art3->art_result == '+ve') {
                                return abort(403);
                            } else {

                                if (empty($art4)) {

                                    return view('skbs.show', compact('biodatas', 'employments', 'contacts', 'qos', 'artday1', 'artday2', 'artday3', 'artday4', 'artday5', 'art1', 'art2', 'art3', 'art4', 'art5'));
                                } else {

                                    if ($art4->art_result == '+ve') {
                                        return abort(403);
                                    } else {

                                        if (empty($art5)) {

                                            return view('skbs.show', compact('biodatas', 'employments', 'contacts', 'qos', 'artday1', 'artday2', 'artday3', 'artday4', 'artday5', 'art1', 'art2', 'art3', 'art4', 'art5'));
                                        } else {

                                            if ($art5->art_result == '+ve') {
                                                return abort(403);
                                            } else {

                                                return view('skbs.show', compact('biodatas', 'employments', 'contacts', 'qos', 'artday1', 'artday2', 'artday3', 'artday4', 'artday5', 'art1', 'art2', 'art3', 'art4', 'art5'));
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }



    public function showadmin(Request $request, $id)
    {

        // $icNos = Auth::user()->ic_no;]


        $qo = QO::all()->where('emp_qo_infos_id', '=', $id)->first();

        $icNos = $qo->ic_no;


        // $users = User::all()
        //     ->where('ic_no', '=', $icNos);


        $biodatas = Biodata::all()
            ->where('ic_no', '=', $icNos);


        $biodata = Biodata::select('biodatas.*')
            ->where('ic_no', $icNos);


        $employments = Employment::all()
            ->where('ic_no', '=', $icNos);

        $contacts = Contact::all()
            ->where('ic_no', '=', $icNos);


        $qos = QO::all()->where('emp_qo_infos_id', '=', $id);

        $qo = QO::leftJoin('biodatas', 'emp_qo_infos.ic_no', '=', 'biodatas.ic_no')
            ->select('emp_qo_infos.*', 'biodatas.name')
            ->orderBy('created_at', 'DESC')
            ->get();


        $qosDate = QO::all()->where('emp_qo_infos_id', '=', $id)->first();


        //for compact
        $artday1 = ART::where([['qo', '=', 'y'], ['day', '=', '1'], ['ic_no', '=', $icNos]])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->get();

        $artday2 = ART::where([['qo', '=', 'y'], ['day', '=', '2'], ['ic_no', '=', $icNos]])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->get();

        $artday3 = ART::where([['qo', '=', 'y'], ['day', '=', '3'], ['ic_no', '=', $icNos]])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->get();

        $artday4 = ART::where([['qo', '=', 'y'], ['day', '=', '4'], ['ic_no', '=', $icNos]])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->get();

        $artday5 = ART::where([['qo', '=', 'y'], ['day', '=', '5'], ['ic_no', '=', $icNos]])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->get();



        $art1 = ART::where([['qo', '=', 'y'], ['day', '=', '1']])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->first();

        $art2 = ART::where([['qo', '=', 'y'], ['day', '=', '2']])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->first();

        $art3 = ART::where([['qo', '=', 'y'], ['day', '=', '3']])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->first();

        $art4 = ART::where([['qo', '=', 'y'], ['day', '=', '4']])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->first();

        $art5 = ART::where([['qo', '=', 'y'], ['day', '=', '5']])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->first();



        if (empty($art1)) {

            return abort(403);
        } else {

            if ($art1->art_result == '+ve') {
                return abort(403);
            } else {

                if (empty($art2)) {

                    return view('skbs.showadmin', compact('biodatas', 'employments', 'contacts', 'qo', 'qos', 'artday1', 'artday2', 'artday3', 'artday4', 'artday5', 'art1', 'art2', 'art3', 'art4', 'art5'));
                } else {

                    if ($art2->art_result == '+ve') {
                        return abort(403);
                    } else {

                        if (empty($art3)) {

                            return view('skbs.showadmin', compact('biodatas', 'employments', 'contacts', 'qo', 'qos', 'artday1', 'artday2', 'artday3', 'artday4', 'artday5', 'art1', 'art2', 'art3', 'art4', 'art5'));
                        } else {

                            if ($art3->art_result == '+ve') {
                                return abort(403);
                            } else {

                                if (empty($art4)) {

                                    return view('skbs.showadmin', compact('biodatas', 'employments', 'qo', 'contacts',  'qos', 'artday1', 'artday2', 'artday3', 'artday4', 'artday5', 'art1', 'art2', 'art3', 'art4', 'art5'));
                                } else {

                                    if ($art4->art_result == '+ve') {
                                        return abort(403);
                                    } else {

                                        if (empty($art5)) {

                                            return view('skbs.showadmin', compact('biodatas', 'employments', 'contacts', 'qo',  'qos', 'artday1', 'artday2', 'artday3', 'artday4', 'artday5', 'art1', 'art2', 'art3', 'art4', 'art5'));
                                        } else {

                                            if ($art5->art_result == '+ve') {
                                                return abort(403);
                                            } else {

                                                return view('skbs.showadmin', compact('biodatas', 'employments', 'contacts', 'qo', 'qos', 'artday1', 'artday2', 'artday3', 'artday4', 'artday5', 'art1', 'art2', 'art3', 'art4', 'art5'));
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }





    public function update(Request $request)
    {
        $request->validate([

            'start_date' => 'required',
            'end_date' => 'required',
            // 'bruhealth_img' => 'mimes:jpg,jpeg,bmp,png,pdf|max:2048',

        ]);

        $now = Carbon::now();

        $icNos = Auth::user()->ic_no;

        if ($request->place1 != '' || $request->art_date1 != '' || $request->art_file1 != '') {

            $request->validate([
                'place1' => 'required',
                'art_date1' => 'required',
                'art_file1' => 'required',
                'result_id1' => 'required'
            ]);

            $art1 = new ART;
            $art1->ic_no = $icNos;
            $art1->art_result = $request->result_id1;
            $art1->date_test = $request->art_date1;
            $art1->department_id = $request->department_id;
            $art1->work_place = $request->place1;
            $art1->art_filename = $request->art_file1->getClientOriginalName();
            $art1->art_image = $request->file('art_file1')->store('art', 'public');
            $art1->qo = 'y';
            $art1->day = '1';

            $art1->save();
        }

        if ($request->place2 != '' || $request->art_date2 != '' || $request->art_file2 != '') {

            $request->validate([
                'place2' => 'required',
                'art_date2' => 'required',
                'art_file2' => 'required',
                'result_id2' => 'required'
            ]);

            $art2 = new ART;
            $art2->ic_no = $icNos;
            $art2->art_result = $request->result_id2;
            $art2->date_test = $request->art_date2;
            $art2->department_id = $request->department_id;
            $art2->work_place = $request->place2;
            $art2->art_filename = $request->art_file2->getClientOriginalName();
            $art2->art_image = $request->file('art_file2')->store('art', 'public');
            $art2->qo = 'y';
            $art2->day = '2';

            $art2->save();
        }

        if ($request->place3 != '' || $request->art_date3 != '' || $request->art_file3 != '') {

            $request->validate([
                'place3' => 'required',
                'art_date3' => 'required',
                'art_file3' => 'required',
                'result_id3' => 'required'
            ]);

            $art3 = new ART;
            $art3->ic_no = $icNos;
            $art3->art_result = $request->result_id3;
            $art3->date_test = $request->art_date3;
            $art3->department_id = $request->department_id;
            $art3->work_place = $request->place3;
            $art3->art_filename = $request->art_file3->getClientOriginalName();
            $art3->art_image = $request->file('art_file3')->store('art', 'public');
            $art3->qo = 'y';
            $art3->day = '3';

            $art3->save();
        }

        if ($request->place4 != '' || $request->art_date4 != '' || $request->art_file4 != '') {

            $request->validate([
                'place4' => 'required',
                'art_date4' => 'required',
                'art_file4' => 'required',
                'result_id4' => 'required'
            ]);

            $art4 = new ART;
            $art4->ic_no = $icNos;
            $art4->art_result = $request->result_id4;
            $art4->date_test = $request->art_date4;
            $art4->department_id = $request->department_id;
            $art4->work_place = $request->place4;
            $art4->art_filename = $request->art_file4->getClientOriginalName();
            $art4->art_image = $request->file('art_file4')->store('art', 'public');
            $art4->qo = 'y';
            $art4->day = '4';

            $art4->save();
        }

        if ($request->place5 != '' || $request->art_date5 != '' || $request->art_file5 != '') {

            $request->validate([
                'place5' => 'required',
                'art_date5' => 'required',
                'art_file5' => 'required',
                'result_id5' => 'required'
            ]);

            $art5 = new ART;
            $art5->ic_no = $icNos;
            $art5->art_result = $request->result_id5;
            $art5->date_test = $request->art_date5;
            $art5->department_id = $request->department_id;
            $art5->work_place = $request->place5;
            $art5->art_filename = $request->art_file5->getClientOriginalName();
            $art5->art_image = $request->file('art_file5')->store('art', 'public');
            $art5->qo = 'y';
            $art5->day = '5';

            $art5->save();
        }

        $employment =  Employment::select('emp_employment_infos.*')
            ->where('ic_no', $icNos)
            ->update([
                'current_designation_id'         =>      $request->current_designation,
            ]);


        $contact =  Contact::select('emp_contact_infos.*')
            ->where('ic_no', $icNos)
            ->update([
                'address'         =>      $request->address,
            ]);


        $QO =  QO::select('emp_qo_infos.*')
            ->where('emp_qo_infos_id', $request->id)
            ->update([
                // 'post'         =>      $request->current_designation,
                'qo_work_places' => $request->qo_work_places,
                'start_date'         =>      $request->start_date,
                'end_date'         =>      $request->end_date,
                // 'qo_filename' => $request->bruhealth_img->getClientOriginalName(),
                // 'bruhealth_img' => $request->file('bruhealth_img')->store('qo', 'public'),
                'updated_at' => $now
            ]);

        return redirect()->route('skbs.skb.index')
            ->with('success_message', 'SKB record was successfully updated!');
    }



    public function updateadmin(Request $request)
    {
        $request->validate([

            'start_date' => 'required',
            'end_date' => 'required',
            // 'bruhealth_img' => 'mimes:jpg,jpeg,bmp,png,pdf|max:2048',

        ]);

        $now = Carbon::now();

         $qo = QO::all()->where('emp_qo_infos_id', '=', $request->id)->first();

        $icNos = $qo->ic_no;
        
        if ($request->place1 != '' || $request->art_date1 != '' || $request->art_file1 != '') {

            $request->validate([
                'place1' => 'required',
                'art_date1' => 'required',
                'art_file1' => 'required',
                'result_id1' => 'required'
            ]);

            $art1 = new ART;
            $art1->ic_no = $icNos;
            $art1->art_result = $request->result_id1;
            $art1->date_test = $request->art_date1;
            $art1->department_id = $request->department_id;
            $art1->work_place = $request->place1;
            $art1->art_filename = $request->art_file1->getClientOriginalName();
            $art1->art_image = $request->file('art_file1')->store('art', 'public');
            $art1->qo = 'y';
            $art1->day = '1';

            $art1->save();
        }

        if ($request->place2 != '' || $request->art_date2 != '' || $request->art_file2 != '') {

            $request->validate([
                'place2' => 'required',
                'art_date2' => 'required',
                'art_file2' => 'required',
                'result_id2' => 'required'
            ]);

            $art2 = new ART;
            $art2->ic_no = $icNos;
            $art2->art_result = $request->result_id2;
            $art2->date_test = $request->art_date2;
            $art2->department_id = $request->department_id;
            $art2->work_place = $request->place2;
            $art2->art_filename = $request->art_file2->getClientOriginalName();
            $art2->art_image = $request->file('art_file2')->store('art', 'public');
            $art2->qo = 'y';
            $art2->day = '2';

            $art2->save();
        }

        if ($request->place3 != '' || $request->art_date3 != '' || $request->art_file3 != '') {

            $request->validate([
                'place3' => 'required',
                'art_date3' => 'required',
                'art_file3' => 'required',
                'result_id3' => 'required'
            ]);

            $art3 = new ART;
            $art3->ic_no = $icNos;
            $art3->art_result = $request->result_id3;
            $art3->date_test = $request->art_date3;
            $art3->department_id = $request->department_id;
            $art3->work_place = $request->place3;
            $art3->art_filename = $request->art_file3->getClientOriginalName();
            $art3->art_image = $request->file('art_file3')->store('art', 'public');
            $art3->qo = 'y';
            $art3->day = '3';

            $art3->save();
        }

        if ($request->place4 != '' || $request->art_date4 != '' || $request->art_file4 != '') {

            $request->validate([
                'place4' => 'required',
                'art_date4' => 'required',
                'art_file4' => 'required',
                'result_id4' => 'required'
            ]);

            $art4 = new ART;
            $art4->ic_no = $icNos;
            $art4->art_result = $request->result_id4;
            $art4->date_test = $request->art_date4;
            $art4->department_id = $request->department_id;
            $art4->work_place = $request->place4;
            $art4->art_filename = $request->art_file4->getClientOriginalName();
            $art4->art_image = $request->file('art_file4')->store('art', 'public');
            $art4->qo = 'y';
            $art4->day = '4';

            $art4->save();
        }

        if ($request->place5 != '' || $request->art_date5 != '' || $request->art_file5 != '') {

            $request->validate([
                'place5' => 'required',
                'art_date5' => 'required',
                'art_file5' => 'required',
                'result_id5' => 'required'
            ]);

            $art5 = new ART;
            $art5->ic_no = $icNos;
            $art5->art_result = $request->result_id5;
            $art5->date_test = $request->art_date5;
            $art5->department_id = $request->department_id;
            $art5->work_place = $request->place5;
            $art5->art_filename = $request->art_file5->getClientOriginalName();
            $art5->art_image = $request->file('art_file5')->store('art', 'public');
            $art5->qo = 'y';
            $art5->day = '5';

            $art5->save();
        }

        $employment =  Employment::select('emp_employment_infos.*')
            ->where('ic_no', $icNos)
            ->update([
                'current_designation_id'         =>      $request->current_designation,
            ]);


        $contact =  Contact::select('emp_contact_infos.*')
            ->where('ic_no', $icNos)
            ->update([
                'address'         =>      $request->address,
            ]);


        $QO =  QO::select('emp_qo_infos.*')
            ->where('emp_qo_infos_id', $request->id)
            ->update([
                // 'post'         =>      $request->current_designation,
                'qo_work_places' => $request->qo_work_places,
                'start_date'         =>      $request->start_date,
                'end_date'         =>      $request->end_date,
                // 'qo_filename' => $request->bruhealth_img->getClientOriginalName(),
                // 'bruhealth_img' => $request->file('bruhealth_img')->store('qo', 'public'),
                'updated_at' => $now
            ]);

        return redirect()->route('skbs.skb.indexadmin')
            ->with('success_message', 'SKB record was successfully updated!');
    }


    public function downloadPDF($id)
    {

        $icNos = Auth::user()->ic_no;

        $biodatas = Biodata::all()
            ->where('ic_no', '=', $icNos);

        $employments = Employment::all()
            ->where('ic_no', '=', $icNos);

        $contacts = Contact::all()
            ->where('ic_no', '=', $icNos);

        $qos = QO::all()->where('emp_qo_infos_id', '=', $id);

        $qosDate = QO::all()->where('emp_qo_infos_id', '=', $id)->first();

        $artday1 = ART::where([['qo', '=', 'y'], ['day', '=', '1'], ['ic_no', '=', $icNos]])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->get();

        $artday2 = ART::where([['qo', '=', 'y'], ['day', '=', '2'], ['ic_no', '=', $icNos]])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->get();

        $artday3 = ART::where([['qo', '=', 'y'], ['day', '=', '3'], ['ic_no', '=', $icNos]])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->get();

        $artday4 = ART::where([['qo', '=', 'y'], ['day', '=', '4'], ['ic_no', '=', $icNos]])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->get();

        $artday5 = ART::where([['qo', '=', 'y'], ['day', '=', '5'], ['ic_no', '=', $icNos]])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->get();



        $pdf = PDF::loadView('skbs.viewpdf',  compact('biodatas', 'employments', 'contacts', 'qos', 'artday1', 'artday2', 'artday3', 'artday4', 'artday5',))
            ->setOptions(['defaultFont' => 'sans-serif'], ['setIsRemoteEnabled' => 'true']);




        return $pdf->stream("QoLetter.pdf");
    }




    public function downloadadminPDF($id)
    {

        $qo = QO::all()->where('emp_qo_infos_id', '=', $id)->first();

        $icNos = $qo->ic_no;

        $biodatas = Biodata::all()
            ->where('ic_no', '=', $icNos);

        $employments = Employment::all()
            ->where('ic_no', '=', $icNos);

        $contacts = Contact::all()
            ->where('ic_no', '=', $icNos);

        $qos = QO::all()->where('emp_qo_infos_id', '=', $id);

        $qosDate = QO::all()->where('emp_qo_infos_id', '=', $id)->first();

        $artday1 = ART::where([['qo', '=', 'y'], ['day', '=', '1'], ['ic_no', '=', $icNos]])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->get();

        $artday2 = ART::where([['qo', '=', 'y'], ['day', '=', '2'], ['ic_no', '=', $icNos]])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->get();

        $artday3 = ART::where([['qo', '=', 'y'], ['day', '=', '3'], ['ic_no', '=', $icNos]])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->get();

        $artday4 = ART::where([['qo', '=', 'y'], ['day', '=', '4'], ['ic_no', '=', $icNos]])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->get();

        $artday5 = ART::where([['qo', '=', 'y'], ['day', '=', '5'], ['ic_no', '=', $icNos]])
            ->whereBetween('date_test', [$qosDate->start_date, $qosDate->end_date])->get();



        $pdf = PDF::loadView('skbs.viewpdfadmin',  compact('biodatas', 'employments', 'contacts', 'qos', 'artday1', 'artday2', 'artday3', 'artday4', 'artday5',))
            ->setOptions(['defaultFont' => 'sans-serif'], ['setIsRemoteEnabled' => 'true']);




        return $pdf->stream("QoLetter.pdf");
    }




    public function destroy($id)
    {
        try {


            $qo = QO::where('emp_qo_infos_id', $id)->delete();

            return redirect()->route('skbs.skb.index')
                ->with('success_message', 'SKB was successfully deleted!');
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
