<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Departmentonly;
use App\Models\SalaryScale;
use App\Models\School;
use App\Models\EmploymentStatus;
use App\Models\Biodata;
use App\Models\Employment;
use App\Models\Perjawatan;
use App\Models\KadarPerjawatan;
use App\Models\JenisKenaikan;
use App\Models\AttachmentPerjawatan;
use App\Models\User;
use Log;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;





class PerjawatanController extends Controller
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
        $jawatans = Perjawatan::select('perjawatans.*')->orderBy('created_at', 'DESC')->get();
        $salary_scale = SalaryScale::pluck('label', 'id')->all();

        return view('perjawatans.index', compact('jawatans', 'salary_scale'));
    }

    // public function indexP()
    // {
    //     $ic = Auth::user()->ic_no;

    //     $acts = Acting::select('actings.*')->where('ic_no', $ic)->orderBy('created_at', 'DESC')->get();

    //     return view('actings.indexP', compact('acts'));
    // }

    public function create()
    {

        $department = Department::pluck('label', 'id')->all();
        $departmentonly = Departmentonly::pluck('label', 'id')->all();
        $salary_scale = SalaryScale::pluck('label', 'id')->all();
        $school = School::pluck('label', 'id')->all();
        $employmentstatuss = EmploymentStatus::pluck('label', 'id')->all();
        $jeniskenaikans = JenisKenaikan::pluck('label', 'id')->all();

        $kadarperjawatans = KadarPerjawatan::select('kadarperjawatans.*')->orderBy('created_at', 'DESC')->get();

        $attachmentperjawatans = AttachmentPerjawatan::select('attachmentperjawatans.*')->orderBy('created_at', 'DESC')->get();

        $icNos = Auth::user()->ic_no;

        $biodatas = Biodata::all()
            ->where('ic_no', '=', $icNos);

        $perjawatans = Biodata::all()
            ->where('ic_no', '=', $icNos);

        return view('perjawatans.create', compact('department', 'departmentonly', 'salary_scale', 'school', 'employmentstatuss',  'jeniskenaikans', 'kadarperjawatans', 'attachmentperjawatans', 'biodatas', 'perjawatans'));
    }


    public function search(Request $request)
    {
        $id = $request->ic_search;

        $department = Department::pluck('label', 'id')->all();
        $salary_scale = SalaryScale::pluck('label', 'id')->all();
        $school = School::pluck('label', 'id')->all();
        $employmentstatuss = EmploymentStatus::pluck('label', 'id')->all();

        $biodatas = Biodata::all()
            ->where('ic_no', '=', $id);

        $employment = Employment::all()
            ->where('ic_no', '=', $id);


        $jeniskenaikans = JenisKenaikan::pluck('label', 'id')->all();

        $kadarperjawatans = KadarPerjawatan::select('kadarperjawatans.*')->orderBy('created_at', 'DESC')->get();

        $attachmentperjawatans = AttachmentPerjawatan::select('attachmentperjawatans.*')->orderBy('created_at', 'DESC')->get();



        return view('perjawatans.createSearch', compact('biodatas', 'id', 'employment', 'school', 'department', 'salary_scale', 'employmentstatuss', 'jeniskenaikans', 'kadarperjawatans', 'attachmentperjawatans'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',

            'ic_no' => 'required'


        ]);

        $icNos = Auth::user()->ic_no;


        $jawatan = new Perjawatan;
        $jawatan->name = $request->name;
        $jawatan->nofolio = $request->nofolio;
        $jawatan->month = $request->month;
        $jawatan->ic_no = $request->ic_no;
        $jawatan->dob = $request->dob;
        $jawatan->department = $request->department;
        $jawatan->school = $request->school;
        $jawatan->salary_scale = $request->salary_scale;
        $jawatan->place = $request->place;
        $jawatan->appt_date = $request->appt_date;
        $jawatan->promoted_date = $request->promoted_date;
        $jawatan->tetap_jawatan_date = $request->tetap_jawatan_date;
        $jawatan->employmentstatuss = $request->employmentstatuss;
        // $jawatan->created_by_ic_no = $icNos;
        $jawatan->save();

        return redirect()->route('perjawatan.perjawatan.createdocs');


        // return view('perjawatans.createdocs');

        // return redirect()->route('perjawatans.perjawatan.index',)
        //     ->with('success_message', 'New Perjawatan record was successfully added!');
    }

    public function edit($id)
    {

        $perjawatans = Perjawatan::all()
            ->where('ic_no', '=', $id);

        $kadarperjawatans = KadarPerjawatan::all()
            ->where('ic_no', '=', $id);

        $biodatas = Biodata::all()
            ->where('ic_no', '=', $id);

        $salary_scale = SalaryScale::pluck('label', 'id')->all();

        $department = Department::pluck('label', 'id')->all();

        $departmentonly = Departmentonly::pluck('label', 'id')->all();

        $school = School::pluck('label', 'id')->all();

        $employmentstatuss = EmploymentStatus::pluck('label', 'id')->all();

        $attachmentperjawatans = AttachmentPerjawatan::all()
            ->where('ic_no', '=', $id);

        $jeniskenaikans = JenisKenaikan::pluck('label', 'id')->all();

        $jeniskenaikan =  KadarPerjawatan::select(['kadarperjawatans.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', '=', $id)
            ->value('jeniskenaikan');



        return view('perjawatans.edit', compact('perjawatans', 'kadarperjawatans', 'biodatas', 'salary_scale', 'department', 'departmentonly', 'school', 'employmentstatuss', 'jeniskenaikans', 'attachmentperjawatans', 'jeniskenaikan'));
    }



    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nofolio' => 'required',

            'ic_no' => 'required',

        ]);

        $now = Carbon::now();


        $jawatan =  Perjawatan::select('perjawatans.*')
            ->where('id', $request->id)
            ->update([
                'nofolio'         =>      $request->nofolio,
                'month' => $request->month,
                'place'      =>      $request->place,
                'dob'      =>      $request->dob,
                'school'      =>      $request->school,
                'appt_date'      =>      $request->appt_date,
                'promoted_date' => $request->promoted_date,
                'tetap_jawatan_date' => $request->tetap_jawatan_date,
                'updated_at' => $now

            ]);


        $kadarjawatan =  KadarPerjawatan::select('kadarperjawatans.*')
            ->where('id', $request->id)
            ->update([
                'year'         =>      $request->year,
                'jeniskenaikan'      =>      $request->jeniskenaikan,
                'promoted_date'      =>      $request->promoted_date,
                'gaji' => $request->gaji,
                'file_1' => $request->file_1,
                'updated_at' => $now

            ]);


        return redirect()->route('perjawatan.perjawatan.index')
            ->with('success_message', 'Perjawatan record was successfully updated!');
    }


    public function show($id)
    {

        $perjawatans = Perjawatan::all()
            ->where('ic_no', '=', $id);


        $kadarperjawatans = KadarPerjawatan::all()
            ->where('ic_no', '=', $id);

        $attachmentperjawatans = AttachmentPerjawatan::all()
            ->where('ic_no', '=', $id);




        return view('perjawatans.show', compact('perjawatans', 'kadarperjawatans', 'attachmentperjawatans'));
    }




    public function destroy($id)
    {
        try {



            $jawatan = Perjawatan::where('id', $id)->delete();

            $kadarjawatan = KadarPerjawatan::where('id', $id)->delete();

            $attachperjawatan = AttachmentPerjawatan::where('id', $id)->delete();




            return redirect()->route('perjawatan.perjawatan.index')
                ->with('success_message', 'Perjawatan was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }
}
