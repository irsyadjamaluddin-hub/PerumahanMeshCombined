<?php

namespace App\Http\Controllers;

use App\Models\Employment;
use App\Models\Department;
use App\Models\User;
use App\Models\Biodata;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class EmovementController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the users.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $employment = Employment::leftJoin('departments','emp_employment_infos.department_id' , '=', 'departments.id')
          ->leftJoin('biodatas', 'emp_employment_infos.ic_no', '=', 'biodatas.ic_no')
          ->select('emp_employment_infos.*', 'departments.label','biodatas.name','biodatas.ic_no')
          ->get();
          
        $employinfo = Employment::select('emp_employment_infos.*')
          ->orderBy('updated_at', 'DESC') 
          ->get();

        $countAll = Employment::leftJoin('departments','emp_employment_infos.department_id' , '=', 'departments.id')->count();

    
    
        return view('emovement.index', compact('employment','countAll','employinfo'));	
    }

    /**
     * Display a listing of the users.
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
      
      $employment = Employment::leftJoin('departments','emp_employment_infos.department_id' , '=', 'departments.id')
        ->leftJoin('users','emp_employment_infos.ic_no','=','users.ic_no')
        ->where('emp_employment_infos.id', '=', $id)
        ->select('emp_employment_infos.*', 'departments.label')
        ->get();

        $employment2 = Employment::leftJoin('departments','emp_employment_infos.department_other' , '=', 'departments.id')
        ->leftJoin('users','emp_employment_infos.ic_no','=','users.ic_no')
        ->where('emp_employment_infos.id', '=', $id)
        ->select('emp_employment_infos.*', 'departments.label')
        ->get();
      
      $users = Biodata::leftJoin('emp_employment_infos', 'biodatas.ic_no', '=', 'emp_employment_infos.ic_no')
        ->select('biodatas.name','biodatas.ic_no')
        ->where('emp_employment_infos.id', '=', $id)
        ->get();
   
      $department = Department::pluck('label','id')->all();

      $employmentdetails = Employment::all()
          ->where('id', '=', $id);

      return view('emovement.edit', compact('employment','employmentdetails', 'department','users','employment2'));
    }

/**
     * Display a listing of the users.
     *
     * @return Illuminate\View\View
     */
    public function view($id)
    {
      $employmentview = Employment::leftJoin('departments','emp_employment_infos.department_id' , '=', 'departments.id')
          ->where('emp_employment_infos.id', '=', $id)
          ->select('emp_employment_infos.*', 'departments.label')
          ->get();
      
      $users = Biodata::leftJoin('emp_employment_infos', 'biodatas.ic_no', '=', 'emp_employment_infos.ic_no')
          ->select('biodatas.name','biodatas.ic_no')
          ->where('emp_employment_infos.id', '=', $id)
          ->get();
          
      $department = Department::pluck('label','id')->all();

      $employmentdetails = Employment::all()
          ->where('id', '=', $id);

      return view('emovement.view', compact('employmentview','employmentdetails', 'department','users'));
    }

    public function updateEM(Request $request)
    {

        $currentdate = Carbon::today();

        $employeeupdate =  Employment::select('emp_employment_infos.*')
        ->where('id', $request->id)
        ->update([
            'ic_no' => $request ->ic_no,
            'department_id' => $request->department_id,
            'department_other' => $request->department_other,
            'unit_id' => $request->unit_id,
            'bahagian_id' => $request->bahagian_id,
            'status_penempatan' => $request->status_penempatan,
            'updated_at' => $request->$currentdate
        ]);

        return redirect()->route('emovements.emovement.index')
        ->with('success_message', 'Data has successfully updated!');
    }

    
    
    
}