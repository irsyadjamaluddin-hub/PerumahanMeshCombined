<?php

namespace App\Http\Controllers;

use Session;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;

use App\Models\Exam;

use Log;
use Carbon\Carbon;

class ExamsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the Mileage applications.
     *
     * @return Illuminate\View\View
     */
	
	public function index()
    {				
			
	}
	
	public function show($id)
    {

    }
	
	    public function destroy($id)
    {
        try {
            $examimg = Exam::select(['emp_exam_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('id', $id)
            ->value('file_1');

            Storage::disk('public')->delete($examimg);

            // $perf = Performance::where('id', $id)->delete();

            $exam = Exam::findOrFail($id);
            $exam->delete();

            return redirect()->route('biodatas.biodata.edit', $id)
                             ->with('success_message', 'Peperiksaan Perkhidmatan Awam was successfully deleted!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }
	
	    /**
     * Show the form for creating a new Medal Application.
     *
     * @return Illuminate\View\View
     */
    public function create($id, Request $request)
    {

    }

    /**
     * Store a new medal in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store($id, Request $request)
    {
        $request->validate([
            'exam_year' => 'required',
            'exam_name' => 'required',
            'exam_grade' => 'required'
        ]);

        $icNos = Auth::user()->ic_no;

        if($request -> exam_file == ''){
        //add Exams
        $exam = new Exam;
        $exam-> ic_no = $icNos;
        $exam-> year = $request->exam_year;
        $exam-> name = $request->exam_name;
        $exam-> grade_id = $request->exam_grade;

        // Save 'exam' data
        $exam-> save();
        }
        else{
        //add Exams
        $exam = new Exam;
        $exam-> ic_no = $icNos;
        $exam-> year = $request->exam_year;
        $exam-> name = $request->exam_name;
        $exam-> grade_id = $request->exam_grade;
        $exam-> file_name = $request->exam_file->getClientOriginalName();
        $exam-> file_1 = $request->file('exam_file')->store('exam', 'public');

        // Save 'exam' data
        $exam-> save();
        }

        return redirect()->route('biodatas.biodata.edit', $id)
        ->with('success_message', 'Peperiksaan Perkhidmatan Awam was successfully updated!');

        
    }
	
	/**
     * Show the form for editing the specified medal.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {	

    }



    /**
     * Update the specified medal in the storage.
     *
     * @param  int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
     
    }

    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request 
     * @return array
     */
    protected function getData(Request $request)
    {
		
    }

    protected function moveFile($file)
    {

    }

}

    