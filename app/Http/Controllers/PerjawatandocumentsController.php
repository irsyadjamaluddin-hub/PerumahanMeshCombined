<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



use App\Models\Department;
use App\Models\SalaryScale;
use App\Models\EmploymentStatus;
use App\Models\Biodata;
use App\Models\Employment;
use App\Models\Perjawatan;
use App\Models\KadarPerjawatan;
use App\Models\JenisKenaikan;
use App\Models\AttachmentPerjawatan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class PerjawatandocumentsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }



    public function create()
    {

        $department = Department::pluck('label', 'id')->all();
        $salary_scale = SalaryScale::pluck('label', 'id')->all();
        $employmentstatuss = EmploymentStatus::pluck('label', 'id')->all();
        $jeniskenaikans = JenisKenaikan::pluck('label', 'id')->all();

        $kadarperjawatans = KadarPerjawatan::select('kadarperjawatans.*')->orderBy('created_at', 'DESC')->get();

        $attachmentperjawatans = AttachmentPerjawatan::select('attachmentperjawatans.*')->orderBy('created_at', 'DESC')->get();

        $icNos = Auth::user()->ic_no;

        $biodatas = Biodata::all()
            ->where('ic_no', '=', $icNos);

        $perjawatans = Biodata::all()
            ->where('ic_no', '=', $icNos);

        return view('perjawatans.createdocs', compact('department', 'salary_scale', 'employmentstatuss',  'jeniskenaikans', 'kadarperjawatans', 'attachmentperjawatans', 'biodatas', 'perjawatans'));

        // return view('documents.createdocs.create');
    }



    public function store($id, Request $request)
    {
        //condition to activate for () loops

        if ($request->year != '' || $request->ic_no != '' || $request->jeniskenaikan != '' || $request->promoted_date != '' || $request->gaji != '' || $request->file_1 != '') {
            // if (!empty($year) || !empty($jeniskenaikan) || !empty($promoted_date) || !empty($gaji) || isset($filename)) {

            $request->validate([
                // 'file_1.*' => 'required|mimes:jpg,jpeg,bmp,png,pdf|max:2048',
                // 'year.*' => 'required',
                // 'jeniskenaikan.*' => 'required',
                // 'gaji.*' => 'required',
                // 'promoted_date.*' => 'required'
            ]);



            // $icNos = Auth::user()->ic_no;
            // $icNos = $id;
            $ic_no = $request->ic_no;
            $year = $request->year;
            $jeniskenaikan = $request->jeniskenaikan;
            $promoted_date = $request->promoted_date;
            $gaji = $request->gaji;
            $filename = $request->file_1;
            $file_1 = $request->file('file_1');


            for ($count_1 = 0; $count_1 < count($year); $count_1++) {

                $data_1 = array(


                    'ic_no' => $ic_no[$count_1],
                    'year' => $year[$count_1],
                    'jeniskenaikan' => $jeniskenaikan[$count_1],
                    'promoted_date' => $promoted_date[$count_1],
                    'gaji' => $gaji[$count_1],
                    'filename' => $filename[$count_1]->getClientOriginalName(),
                    'file_1' => $file_1[$count_1]->store('perjawatan', 'public'),
                );

                $insert_data_1[] = $data_1;
            }

            // Save 'kadarkenaikangaji' data
            KadarPerjawatan::insert($insert_data_1);
        }


        // ---------------- Attachment table ----------------
        // For 'Add More' fields


        //condition to activate for () loops

        if ($request->name_1 != '' || $request->ic_no_1 != '' || $request->file_2 != '') {
            // if (!empty($name) || isset($filename)) {





            // $icNos = $id;
            // $icNos = $request->ic_no;

            $name_1 = $request->name;
            $ic_no_1 = $request->ic_no;
            $filename = $request->file_2;
            $file_2 = $request->file('file_2');

            for ($count_2 = 0; $count_2 < count($name_1); $count_2++) {

                $data_2 = array(

                    // 'ic_no' => $icNos,

                    'name' => $name_1[$count_2],
                    'ic_no' => $ic_no_1[$count_2],
                    'filename' => $filename[$count_2]->getClientOriginalName(),
                    'file_2' => $file_2[$count_2]->store('perjawatanattachment', 'public'),
                );

                $insert_data_2[] = $data_2;
            }

            // Save 'Course' data
            AttachmentPerjawatan::insert($insert_data_2);
            // return $data_2;
        }

        return redirect()->route('perjawatan.perjawatan.index',)
            ->with('success_message', 'New Perjawatan attachment record was successfully added!');
    }
}
