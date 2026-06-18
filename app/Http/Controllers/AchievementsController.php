<?php

namespace App\Http\Controllers;

use Session;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;

use App\Models\Performance;
use App\Models\Course;
use App\Models\Medal;
use App\Models\Certificate;
use App\Models\Exam;
use App\Models\Programme;
use App\Models\Paperwork;

use Log;
use Carbon\Carbon;

class AchievementsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function attributes()
    {
        return [
            'perf_year' => 'email address',
        ];
    }

    public function store($id, Request $request)
    {
    
        // ---------------- Performances ----------------
        // For 'Add More' fields
        $request->validate([
            'perf_file.*' => 'required|mimes:jpg,jpeg,bmp,png,pdf|max:2048',
            'perf_year.*' => 'required',
            'perf_grade.*' => 'required',
            'perf_markah.*' => 'required'
        ]);
        
        $icNos = Auth::user()->ic_no;
        $year = $request->perf_year;
        $grade_id = $request->perf_grade;
        $percentage = $request->perf_markah;
        $file_name = $request->perf_file;
        $file_1 = $request->file('perf_file');

        //condition to activate for () loops
        if( !empty($year) || !empty($grade_id) || !empty($percentage) || isset($file_name)){

            for($count_1 = 0; $count_1 < count($year); $count_1++){
                
                $data_1 = array(

                    'ic_no' => $icNos,
                    'year' => $year[$count_1],
                    'grade_id' => $grade_id[$count_1],
                    'percentage' => $percentage[$count_1],
                    'file_name' => $file_name[$count_1]->getClientOriginalName(),
                    'file_1' => $file_1[$count_1]->store('performance', 'public'),
                );

                $insert_data_1[] = $data_1;
            }
            
            // Save 'Performance' data
            Performance::insert($insert_data_1);
        }

        // ---------------- Courses ----------------
        // For 'Add More' fields
        $request->validate([
            'course_name.*' => 'required',
            'course_startdate.*' => 'required',
            'course_enddate.*' => 'required',
            'course_venue.*' => 'required',
            'course_duration.*' => 'required'
        ]);
        
        $icNos = Auth::user()->ic_no;
        $name_2 = $request->course_name;
        $start_date = $request->course_startdate;
        $end_date = $request->course_enddate;
        $venue = $request->course_venue;
        $duration = $request->course_duration;

       //condition to activate for () loops
       if( !empty($name_2) || !empty($start_date) || !empty($end_date) || !empty($venue) || !empty($duration)){

            for($count_2 = 0; $count_2 < count($name_2); $count_2++){
                
                $data_2 = array(

                    'ic_no' => $icNos,
                    'name' => $name_2[$count_2],
                    'start_date' => $start_date[$count_2],
                    'end_date' => $end_date[$count_2],
                    'venue' => $venue[$count_2],
                    'duration' => $duration[$count_2],
                );

                $insert_data_2[] = $data_2;
            }
            
            // Save 'Course' data
            Course::insert($insert_data_2);
            // return $data_2;
        }

        // ---------------- Medals ----------------
        // For 'Add More' fields
        $request->validate([
            'medal_year.*' => 'required',
            'medal_name.*' => 'required'
        ]);
        
        $icNos = Auth::user()->ic_no;
        $year_3 = $request->medal_year;
        $name_3 = $request->medal_name;

       //condition to activate for () loops
       if( !empty($year_3) || !empty($name_3)){

            for($count_3 = 0; $count_3 < count($name_3); $count_3++){
                
                $data_3 = array(

                    'ic_no' => $icNos,
                    'year' => $year_3[$count_3],
                    'name' => $name_3[$count_3],
                );

                $insert_data_3[] = $data_3;
            }
            
            // Save data
            Medal::insert($insert_data_3);
        }

        // ---------------- Certificates ----------------
        // For 'Add More' fields
        $request->validate([
            'cert_year.*' => 'required',
            'cert_name.*' => 'required'
        ]);
        
        $icNos = Auth::user()->ic_no;
        $year_4 = $request->cert_year;
        $name_4 = $request->cert_name;

       //condition to activate for () loops
       if( !empty($name_4) || !empty($year_4)){

            for($count_4 = 0; $count_4 < count($name_4); $count_4++){
                
                $data_4 = array(

                    'ic_no' => $icNos,
                    'name' => $name_4[$count_4],
                    'year' => $year_4[$count_4],
                );

                $insert_data_4[] = $data_4;
            }
            
            // Save data
            Certificate::insert($insert_data_4);
        }

        // ---------------- Exams ----------------
        // For 'Add More' fields
        $request->validate([
            'exam_year.*' => 'required',
            'exam_name.*' => 'required',
            'exam_grade.*' => 'required'
        ]);
        
        $icNos = Auth::user()->ic_no;
        $year_5 = $request->exam_year;
        $name_5 = $request->exam_name;
        $grade_id = $request->exam_grade;

       //condition to activate for () loops
       if( !empty($name_5) || !empty($year_5) || !empty($grade_id)){

            for($count_5 = 0; $count_5 < count($name_5); $count_5++){
                
                $data_5 = array(

                    'ic_no' => $icNos,
                    'year' => $year_5[$count_5],
                    'name' => $name_5[$count_5],
                    'grade_id' => $grade_id[$count_5],
                );

                $insert_data_5[] = $data_5;
            }
            
            // Save data
            Exam::insert($insert_data_5);
        }

        // ---------------- Programmes ----------------
        // For 'Add More' fields
        $request->validate([
            'program_year.*' => 'required',
            'program_name.*' => 'required',
            'program_cohort.*' => 'required'
        ]);
        
        $icNos = Auth::user()->ic_no;
        $year_6 = $request->program_year;
        $name_6 = $request->program_name;
        $cohort = $request->program_cohort;

       //condition to activate for () loops
       if( !empty($year_6) || !empty($name_6) || !empty($cohort)){

            for($count_6 = 0; $count_6 < count($name_6); $count_6++){
                
                $data_6 = array(

                    'ic_no' => $icNos,
                    'year' => $year_6[$count_6],
                    'name' => $name_6[$count_6],
                    'cohort' => $cohort[$count_6],
                );

                $insert_data_6[] = $data_6;
            }
            
            // Save data
            Programme::insert($insert_data_6);
        }

        // ---------------- Paperworks ----------------
        // For 'Add More' fields
        $request->validate([
            'paperwork_year.*' => 'required',
            'paperwork_name.*' => 'required'
        ]);
        
        $icNos = Auth::user()->ic_no;
        $approved_date = $request->paperwork_year;
        $name_7 = $request->paperwork_name;

       //condition to activate for () loops
       if( !empty($approved_date) || !empty($name_7)){

            for($count_7 = 0; $count_7 < count($name_7); $count_7++){
                
                $data_7 = array(

                    'ic_no' => $icNos,
                    'approved_date' => $approved_date[$count_7],
                    'name' => $name_7[$count_7],
                );

                $insert_data_7[] = $data_7;
            }
            
            // Save data
            Paperwork::insert($insert_data_7);
        }
        
        return redirect()->route('biodatas.biodata.edit', $id)
        ->with('success_message', 'Achievement was successfully updated!');
    }
}