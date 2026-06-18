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
use App\Models\Performance;
use App\Models\Medal;
use App\Models\Cluster;
use App\Models\ServiceStatus;
use App\Models\Salary;
use App\Models\ART;


use Log;
use Carbon\Carbon;

class ARTController extends Controller
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

        $arts= ART::select('emp_art_infos.*')
                        ->orderBy('created_at', 'DESC')
                        ->where([
                        ['ic_no', '=', $icNos]
                        ])
                        ->get();

        $countAll = ART::where('ic_no', $icNos)->count();
        $countPositive = ART::where('ic_no', $icNos)->where('art_result', '+ve')->count();
        $countNegative = ART::where('ic_no', $icNos)->where('art_result', '-ve')->count();

        $departments = Department::pluck('label','id')->all();
        

        return view('arts.index', compact('arts', 'countAll', 'countPositive', 'countNegative', 'departments') );
                       
    }

    public function indexAll()
    {

      if (Auth::user()->hasRole('ROLE_SUPERADMIN')){

             $arts= ART::leftJoin('biodatas', 'emp_art_infos.ic_no', '=', 'biodatas.ic_no' )
            ->select('emp_art_infos.*', 'biodatas.name')
            ->orderBy('emp_art_infos.created_at', 'DESC')
            ->paginate(50);
		
            $countAll = ART::count();
            $countPositive = ART::where('art_result', '+ve')->count();
            $countNegative = ART::where('art_result', '-ve')->count();

            $departments = Department::pluck('label','id')->all();
        
            return view('arts.indexAll', compact('arts', 'countAll', 'countPositive', 'countNegative', 'departments') );
        }

        if (Auth::user()->hasRole('ROLE_ART_FOCAL')){

            $icNos = Auth::user()->ic_no;

            $employments = Employment::select('emp_employment_infos.*')
						->where('ic_no', '=', $icNos)->first();

            $id = $employments->department_id;


            $arts= ART::leftJoin('biodatas', 'emp_art_infos.ic_no', '=', 'biodatas.ic_no' )
            ->select('emp_art_infos.*', 'biodatas.name')
            ->orderBy('created_at', 'DESC')
            ->where('department_id', '=', $id)
            ->get();

          

            $countAll = ART::where('department_id', '=', $id)->count();
            $countPositive = ART::where([['art_result', '+ve'], ['department_id', '=', $id]])->count();
            $countNegative = ART::where([['art_result', '-ve'], ['department_id', '=', $id]])->count();

            $departments = Department::pluck('label','id')->all();
        
            return view('arts.indexAllFocal', compact('arts', 'countAll', 'countPositive', 'countNegative', 'departments') );
        }


                       
    }

    public function create()
    {
        $icNos = Auth::user()->ic_no;

        $biodatas = Biodata::all()
						->where('ic_no', '=', $icNos);
		
	    $employments = Employment::all()
						->where('ic_no', '=', $icNos);

        $departments = Department::pluck('label','id')->all();
        

        return view('arts.create', compact('biodatas', 'employments', 'departments') );
    }

    public function createAll()
    {
        $icNos = Auth::user()->ic_no;

        $biodatas = Biodata::all()
						->where('ic_no', '=', $icNos);
		
	    $employments = Employment::all()
						->where('ic_no', '=', $icNos);

        $departments = Department::pluck('label','id')->all();
        

        return view('arts.createAll', compact('biodatas', 'employments', 'departments') );
    }

    public function edit($id)
    {
    
        $icNos = Auth::user()->ic_no;

        $biodatas = Biodata::all()
						->where('ic_no', '=', $icNos);
		
	    $employments = Employment::all()
						->where('ic_no', '=', $icNos);

        $arts = ART::all()->where('emp_art_infos_id', '=', $id);

      

        return view('arts.edit', compact('biodatas', 'employments', 'arts' ) );
    
        
    }

    public function editAll($id)
    {
    
        $arts = ART::all()->where('emp_art_infos_id', '=', $id);

        $arts1 = ART::all()->where('emp_art_infos_id', '=', $id)->first();

        $biodatas = Biodata::all()
        ->where('ic_no', '=', $arts1->ic_no);

        $employments = Employment::all()
        ->where('ic_no', '=', $arts1->ic_no);

        return view('arts.editAll', compact('biodatas', 'employments', 'arts' ) );
    
        
    }

    public function update(Request $request)
    {
        $request->validate([
            'department_id' => 'required',
            'place' => 'required',
            'date_test' => 'required',
            'result_id' => 'required'
        ]);

        $now = Carbon::now();

        if($request->art_file == ''){


        $art =  ART::select('emp_art_infos.*')
        ->where('emp_art_infos_id', $request->id)
            ->update([
                'work_place'         =>      $request->place,
                'date_test'      =>      $request->date_test,
                'art_result'      =>      $request->result_id,
                'remark'      =>      $request->remark,
                'updated_at' => $now
            ]);

        }
        else{

            $art1 = ART::select(['emp_art_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('emp_art_infos_id', $request->id)
							->value('art_image');

            Storage::disk('public')->delete($art1);

            $art =  ART::select('emp_art_infos.*')
            ->where('emp_art_infos_id', $request->id)
                ->update([
                    'work_place'         =>      $request->place,
                    'date_test'      =>      $request->date_test,
                    'art_result'      =>      $request->result_id,
                    'remark'      =>      $request->remark,
                    'art_filename' => $request->art_file->getClientOriginalName(),
                    'art_image' => $request->file('art_file')->store('art', 'public'),
                    'updated_at' => $now
                ]);

        }

        return redirect()->route('arts.art.index')
            ->with('success_message', 'ART record was successfully updated!');

        
          
    }

    public function updateAll(Request $request)
    {
        $request->validate([
            'department_id' => 'required',
            'place' => 'required',
            'date_test' => 'required',
            'result_id' => 'required'
        ]);

        $now = Carbon::now();

        if($request->art_file == ''){


        $art =  ART::select('emp_art_infos.*')
        ->where('emp_art_infos_id', $request->id)
            ->update([
                'work_place'         =>      $request->place,
                'date_test'      =>      $request->date_test,
                'art_result'      =>      $request->result_id,
                'remark'      =>      $request->remark,
                'updated_at' => $now
            ]);

        }
        else{

            $art1 = ART::select(['emp_art_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('emp_art_infos_id', $request->id)
							->value('art_image');

            Storage::disk('public')->delete($art1);

            $art =  ART::select('emp_art_infos.*')
            ->where('emp_art_infos_id', $request->id)
                ->update([
                    'work_place'         =>      $request->place,
                    'date_test'      =>      $request->date_test,
                    'art_result'      =>      $request->result_id,
                    'remark'      =>      $request->remark,
                    'art_filename' => $request->art_file->getClientOriginalName(),
                    'art_image' => $request->file('art_file')->store('art', 'public'),
                    'updated_at' => $now
                ]);

        }

        return redirect()->route('arts.art.indexAll')
            ->with('success_message', 'ART record was successfully updated!');

          
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_id' => 'required',
            'place' => 'required',
            'date_test' => 'required',
            'result_id' => 'required',
            'art_file' => 'required|mimes:jpg,jpeg,bmp,png,pdf'
        ]);

        $icNos = Auth::user()->ic_no;

	

        $art = new ART;
        $art-> ic_no = $icNos;
        $art-> art_result = $request->result_id;
	    $art-> date_test = $request->date_test;
        $art-> department_id = $request->department_id;
        $art-> work_place = $request->place;
        $art-> remark = $request->remark;
        $art-> art_filename = $request->art_file->getClientOriginalName();
        $art-> art_image = $request->file('art_file')->store('art', 'public');
        

        // Save 'art' data
        $art-> save();

        return redirect()->route('arts.art.index')
            ->with('success_message', 'New ART record was successfully added!');


    }

    public function storeAll(Request $request)
    {
        $request->validate([
            'department_id' => 'required',
            'place' => 'required',
            'date_test' => 'required',
            'result_id' => 'required',
            'art_file' => 'required|mimes:jpg,jpeg,bmp,png,pdf'
        ]);


        $art = new ART;
        $art-> ic_no = $request->ic_no;
        $art-> art_result = $request->result_id;
	    $art-> date_test = $request->date_test;
        $art-> department_id = $request->department_id;
        $art-> work_place = $request->place;
        $art-> remark = $request->remark;
        $art-> art_filename = $request->art_file->getClientOriginalName();
        $art-> art_image = $request->file('art_file')->store('art', 'public');
        

        // Save 'art' data
        $art-> save();

        return redirect()->route('arts.art.indexAll')
            ->with('success_message', 'New ART record was successfully added!');


    }

    public function search(Request $request)
    {
        $id = $request->department_id;

        // $arts= ART::select('emp_art_infos.*')
        //                 ->orderBy('created_at', 'DESC')
        //                 ->where('department_id', $id)
        //                 ->get();

          $arts= ART::leftJoin('biodatas', 'emp_art_infos.ic_no', '=', 'biodatas.ic_no' )
            ->select('emp_art_infos.*', 'biodatas.name')
            ->where('department_id', '=', $id)   // update server 250122    
            ->orderBy('created_at', 'DESC')
            ->get();

                        
        $countAll = ART::where('department_id', $id)->count();
        $countPositive = ART::where('department_id', $id)->where('art_result', '+ve')->count();
        $countNegative = ART::where('department_id', $id)->where('art_result', '-ve')->count();
                
        $departments = Department::pluck('label','id')->all();
                
        return view('arts.indexAll', compact('arts', 'countAll', 'countPositive', 'countNegative', 'departments') );

       

    }

    public function searchDept(Request $request)
    {
        $search = $request->search;
     
        $icNos = Auth::user()->ic_no;

        $employments = Employment::select('emp_employment_infos.*')
                                    ->where('ic_no', '=', $icNos)->first();
            
        $id = $employments->department_id;
            
            
        $arts= ART::leftJoin('biodatas', 'emp_art_infos.ic_no', '=', 'biodatas.ic_no' )
                ->select('emp_art_infos.*', 'biodatas.name')    
                ->where('department_id', '=', $id)      
                ->where('work_place', 'LIKE', "%{$search}%")
                ->orwhere('emp_art_infos.ic_no', 'LIKE', "%{$search}%")
                ->orWhere('name', 'LIKE', "%{$search}%")
                ->orderBy('created_at', 'DESC')
                ->get();

            
        $countAll = ART::leftjoin('users', 'users.ic_no', '=', 'emp_art_infos.ic_no')->where('department_id', '=', $id)
        ->where('work_place', 'LIKE', "%{$search}%")
        ->orwhere('emp_art_infos.ic_no', 'LIKE', "%{$search}%")
        ->orWhere('name', 'LIKE', "%{$search}%")
        ->count();

        $countPositive = ART::leftjoin('users', 'users.ic_no', '=', 'emp_art_infos.ic_no')->where([['art_result', '+ve'], ['department_id', '=', $id]]) 
                ->where('work_place', 'LIKE', "%{$search}%")
                ->orwhere('emp_art_infos.ic_no', 'LIKE', "%{$search}%")
                ->orWhere('name', 'LIKE', "%{$search}%")
                ->count();

        $countNegative = ART::leftjoin('users', 'users.ic_no', '=', 'emp_art_infos.ic_no')->where([['art_result', '-ve'], ['department_id', '=', $id]]) 
                ->where('work_place', 'LIKE', "%{$search}%")
                ->orwhere('emp_art_infos.ic_no', 'LIKE', "%{$search}%")
                ->orWhere('name', 'LIKE', "%{$search}%")
                ->count();
            
                
        return view('arts.indexAll', compact('arts', 'countAll', 'countPositive', 'countNegative') );

       

    }

    public function destroy($id)
    {
        try {

            $art1 = ART::select(['emp_art_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('emp_art_infos_id', $id)
            ->value('art_image');

            Storage::disk('public')->delete($art1);

            $art = ART::where('emp_art_infos_id', $id)->delete();

          

            return redirect()->route('arts.art.index')
                             ->with('success_message', 'ART was successfully deleted!');

            

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function destroyAll($id)
    {
        try {

            $art1 = ART::select(['emp_art_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('emp_art_infos_id', $id)
            ->value('art_image');

            Storage::disk('public')->delete($art1);

            $art = ART::where('emp_art_infos_id', $id)->delete();

           
            return redirect()->route('arts.art.indexAll')
                             ->with('success_message', 'ART was successfully deleted!');


            

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    //Laila Added 26/01/2022
    public function searchIC(Request $request)
    {
        $id = $request->ic_search;

        $biodatas= Biodata::all()
                    ->where('ic_no', '=', $id);
                               
        $employments = Employment::all()
                    ->where('ic_no', '=', $id);

        $departments = Department::pluck('label','id')->all();
    

        return view('arts.createSearch', compact('biodatas', 'employments', 'departments') );
      
    }

    //Laila Added 20/04/2022
    public function viewAll($id)
    {
    
        $icNos = Auth::user()->ic_no;

        $biodatas = Biodata::all()
						->where('ic_no', '=', $icNos);
		
	    $employments = Employment::all()
						->where('ic_no', '=', $icNos);

        $arts = ART::all()->where('emp_art_infos_id', '=', $id);

      

        return view('arts.viewAll', compact('biodatas', 'employments', 'arts' ) );
    
        
    }

//Laila added on 210422
    public function searchName(Request $request)
    {
        $search = $request->search;
          
            
        $arts= ART::leftJoin('biodatas', 'emp_art_infos.ic_no', '=', 'biodatas.ic_no' )
                ->select('emp_art_infos.*', 'biodatas.name')         
                ->Where('name', 'LIKE', "%{$search}%")
                ->orderBy('created_at', 'DESC')
                ->paginate(50);

        $countAll = ART::leftJoin('biodatas', 'emp_art_infos.ic_no', '=', 'biodatas.ic_no' )->select('emp_art_infos.*', 'biodatas.name') 
        ->where('name', 'LIKE', "%{$search}%")->count();

        $countPositive = ART::leftJoin('biodatas', 'emp_art_infos.ic_no', '=', 'biodatas.ic_no' )->select('emp_art_infos.*', 'biodatas.name')
        ->where('name', 'LIKE', "%{$search}%")->where('art_result', '+ve')->count();

        $countNegative = ART::leftJoin('biodatas', 'emp_art_infos.ic_no', '=', 'biodatas.ic_no' )->select('emp_art_infos.*', 'biodatas.name')
        ->where('name', 'LIKE', "%{$search}%")->where('art_result', '-ve')->count();

        $departments = Department::pluck('label','id')->all();
            
                
        return view('arts.indexAll', compact('arts', 'countAll', 'countPositive', 'countNegative', 'departments') );

       

    }

    public function searchICNo(Request $request)
    {
        $search = $request->search;
          
            
        $arts= ART::leftJoin('biodatas', 'emp_art_infos.ic_no', '=', 'biodatas.ic_no' )
                ->select('emp_art_infos.*', 'biodatas.name')         
                ->Where('emp_art_infos.ic_no', 'LIKE', "%{$search}%")
                ->orderBy('created_at', 'DESC')
                ->paginate(50);

        $countAll = ART::leftJoin('biodatas', 'emp_art_infos.ic_no', '=', 'biodatas.ic_no' )->select('emp_art_infos.*', 'biodatas.name') 
        ->where('emp_art_infos.ic_no', 'LIKE', "%{$search}%")->count();

        $countPositive = ART::leftJoin('biodatas', 'emp_art_infos.ic_no', '=', 'biodatas.ic_no' )->select('emp_art_infos.*', 'biodatas.name')
        ->where('emp_art_infos.ic_no', 'LIKE', "%{$search}%")->where('art_result', '+ve')->count();

        $countNegative = ART::leftJoin('biodatas', 'emp_art_infos.ic_no', '=', 'biodatas.ic_no' )->select('emp_art_infos.*', 'biodatas.name')
        ->where('emp_art_infos.ic_no', 'LIKE', "%{$search}%")->where('art_result', '-ve')->count();

        $departments = Department::pluck('label','id')->all();
            
                
        return view('arts.indexAll', compact('arts', 'countAll', 'countPositive', 'countNegative', 'departments') );

       

    }

    public function searchPlace(Request $request)
    {
        $search = $request->search;
          
            
        $arts= ART::leftJoin('biodatas', 'emp_art_infos.ic_no', '=', 'biodatas.ic_no' )
                ->select('emp_art_infos.*', 'biodatas.name')         
                ->Where('work_place', 'LIKE', "%{$search}%")
                ->orderBy('created_at', 'DESC')
                ->paginate(50);

        $countAll = ART::leftJoin('biodatas', 'emp_art_infos.ic_no', '=', 'biodatas.ic_no' )->select('emp_art_infos.*', 'biodatas.name') 
        ->where('work_place', 'LIKE', "%{$search}%")->count();

        $countPositive = ART::leftJoin('biodatas', 'emp_art_infos.ic_no', '=', 'biodatas.ic_no' )->select('emp_art_infos.*', 'biodatas.name')
        ->where('work_place', 'LIKE', "%{$search}%")->where('art_result', '+ve')->count();

        $countNegative = ART::leftJoin('biodatas', 'emp_art_infos.ic_no', '=', 'biodatas.ic_no' )->select('emp_art_infos.*', 'biodatas.name')
        ->where('work_place', 'LIKE', "%{$search}%")->where('art_result', '-ve')->count();

        $departments = Department::pluck('label','id')->all();
            
                
        return view('arts.indexAll', compact('arts', 'countAll', 'countPositive', 'countNegative', 'departments') );

       

    }

    public function searchResult(Request $request)
    {
        $search = $request->search;
          
        
        if($search == "-ve"){

            $arts= ART::leftJoin('biodatas', 'emp_art_infos.ic_no', '=', 'biodatas.ic_no' )
                ->select('emp_art_infos.*', 'biodatas.name')         
                ->Where('art_result', '-ve')
                ->orderBy('created_at', 'DESC')
                ->paginate(50);

        } else{

            $arts= ART::leftJoin('biodatas', 'emp_art_infos.ic_no', '=', 'biodatas.ic_no' )
                ->select('emp_art_infos.*', 'biodatas.name')         
                ->Where('art_result', '+ve')
                ->orderBy('created_at', 'DESC')
                ->paginate(50);
        }
    

        $countAll = ART::leftJoin('biodatas', 'emp_art_infos.ic_no', '=', 'biodatas.ic_no' )->select('emp_art_infos.*', 'biodatas.name') ->count();

        $countPositive = ART::leftJoin('biodatas', 'emp_art_infos.ic_no', '=', 'biodatas.ic_no' )->select('emp_art_infos.*', 'biodatas.name')->where('art_result', '+ve')->count();

        $countNegative = ART::leftJoin('biodatas', 'emp_art_infos.ic_no', '=', 'biodatas.ic_no' )->select('emp_art_infos.*', 'biodatas.name')->where('art_result', '-ve')->count();

        $departments = Department::pluck('label','id')->all();
            
                
        return view('arts.indexAll', compact('arts', 'countAll', 'countPositive', 'countNegative', 'departments') );

       

    }

    public function searchDate(Request $request)
    {
        $search = $request->search;
          
            
        $arts= ART::leftJoin('biodatas', 'emp_art_infos.ic_no', '=', 'biodatas.ic_no' )
                ->select('emp_art_infos.*', 'biodatas.name')         
                ->Where('date_test', 'LIKE', "%{$search}%")
                ->orderBy('created_at', 'DESC')
                ->paginate(50);

        $countAll = ART::leftJoin('biodatas', 'emp_art_infos.ic_no', '=', 'biodatas.ic_no' )->select('emp_art_infos.*', 'biodatas.name') 
        ->where('date_test', 'LIKE', "%{$search}%")->count();

        $countPositive = ART::leftJoin('biodatas', 'emp_art_infos.ic_no', '=', 'biodatas.ic_no' )->select('emp_art_infos.*', 'biodatas.name')
        ->where('date_test', 'LIKE', "%{$search}%")->where('art_result', '+ve')->count();

        $countNegative = ART::leftJoin('biodatas', 'emp_art_infos.ic_no', '=', 'biodatas.ic_no' )->select('emp_art_infos.*', 'biodatas.name')
        ->where('date_test', 'LIKE', "%{$search}%")->where('art_result', '-ve')->count();

        $departments = Department::pluck('label','id')->all();
            
                
        return view('arts.indexAll', compact('arts', 'countAll', 'countPositive', 'countNegative', 'departments') );

       

    }

	public function searchDeptAdmin(Request $request)
    	{
        $search =  $request->department_id;
          
            
        $arts= ART::leftJoin('biodatas', 'emp_art_infos.ic_no', '=', 'biodatas.ic_no' )
                ->select('emp_art_infos.*', 'biodatas.name')         
                ->Where('department_id', "$search")
                ->orderBy('created_at', 'DESC')
                ->paginate(50);

        $countAll = ART::leftJoin('biodatas', 'emp_art_infos.ic_no', '=', 'biodatas.ic_no' )->select('emp_art_infos.*', 'biodatas.name') 
         ->Where('department_id', $search)->count();

        $countPositive = ART::leftJoin('biodatas', 'emp_art_infos.ic_no', '=', 'biodatas.ic_no' )->select('emp_art_infos.*', 'biodatas.name')
         ->Where('department_id', $search)->where('art_result', '+ve')->count();

        $countNegative = ART::leftJoin('biodatas', 'emp_art_infos.ic_no', '=', 'biodatas.ic_no' )->select('emp_art_infos.*', 'biodatas.name')
         ->Where('department_id', $search)->where('art_result', '-ve')->count();

        $departments = Department::pluck('label','id')->all();
            
                
        return view('arts.indexAll', compact('arts', 'countAll', 'countPositive', 'countNegative', 'departments') );

       

    }



}
