<?php

namespace App\Http\Controllers;

use Session;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;

use App\Models\Course;

use Log;
use Carbon\Carbon;

class CoursesController extends Controller
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
            $courseimg = Course::select(['emp_course_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('id', $id)
            ->value('file_1');

            Storage::disk('public')->delete($courseimg);

            $course = Course::where('id', $id)->delete();

            return redirect()->route('biodatas.biodata.edit', $id)
                             ->with('success_message', 'Kursus was successfully deleted!');

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
            'course_name' => 'required',
            'course_startdate' => 'required',
            'course_enddate' => 'required',
            'course_venue' => 'required',
            'course_duration' => 'required'
        ]);

        $icNos = Auth::user()->ic_no;

        if($request-> course_file == ''){
        //add Courses
        $course = new Course;
        $course-> ic_no = $icNos;
        $course-> name = $request->course_name;
        $course-> start_date = $request->course_startdate;
        $course-> end_date = $request->course_enddate;
        $course-> venue = $request->course_venue;
        $course-> duration = $request->course_duration;

        // Save 'courses' data
        $course-> save();
        }
        else{
        //add Courses
        $course = new Course;
        $course-> ic_no = $icNos;
        $course-> name = $request->course_name;
        $course-> start_date = $request->course_startdate;
        $course-> end_date = $request->course_enddate;
        $course-> venue = $request->course_venue;
        $course-> duration = $request->course_duration;
        $course-> file_name = $request->course_file->getClientOriginalName();
        $course-> file_1 = $request->file('course_file')->store('paperwork', 'public');

        // Save 'courses' data
        $course-> save();
        }

        return redirect()->route('biodatas.biodata.edit', $id)
        ->with('success_message', 'Kursus was successfully updated!');
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

    