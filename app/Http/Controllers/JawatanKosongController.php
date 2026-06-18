<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departmentonly;
use App\Models\JawtanKosong;
use App\Models\SalaryScale;
use App\Models\Division;
use App\Models\Department;
use App\Models\Employment;
use App\Models\Jawatanlist;




use Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class JawatankosongController extends Controller
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
	
	public function indexadmin()
    {
        $jawatankosongs= JawtanKosong::select('jawatankosong.*')
        ->whereNotNull('dept_label')
        ->get();

    

        // $sum = JawtanKosong::where('dept_id', $id)
        // ->sum('jum_kosong');

        $sum = JawtanKosong::select('dept_id', \DB::raw('SUM(jum_kosong) as total_jum_kosong'))
        ->where('status', '!=', 'Diisikan')
        ->groupBy('dept_id')
        ->get();
    

        return view('jawatankosong.indexadmin', compact('jawatankosongs','sum'));
    }

    public function indexdept($id, Request $request)
    {
        $jawatankosongdept = JawtanKosong::where('dept_id', $id)
        ->whereNotNull('jawatan')->get();

        $jawatanlist =Jawatanlist::pluck('tanggagaji','id')->all();

        $jawatanlist =Jawatanlist::pluck('label','id')->all();

    
        return view('jawatankosong.indexdept', compact('jawatankosongdept', 'id','jawatanlist'));
    }

    public function index( Request $request)
    {
       
        $icNos = Auth::user()->ic_no;

        $jawatankosongdept = JawtanKosong::select('jawatankosong.*')
        ->where(function($query) use ($icNos) {
            $query->where('ic_no1', '=', $icNos);
               
        })
        ->get();
    
        return view('jawatankosong.index', compact('jawatankosongdept'));
    }
    
    

    public function createadmin($id)
    {

        $jawatankosongs= JawtanKosong::select('jawatankosong.*')->get();
        $tanggagaji =SalaryScale::pluck('label','id')->all();
        $bahagian =Division::pluck('label','id')->all();
        $jawatankosongdept = JawtanKosong::where('dept_id', $id)->get();
        $jawatanlist = Jawatanlist::orderBy('label', 'asc')->pluck('label', 'id')->all();
     
        return view('jawatankosong.createadmin',compact('jawatankosongs','tanggagaji','bahagian', 'jawatankosongdept','jawatanlist'));
    }

    public function create()
    {
        $icNos = Auth::user()->ic_no;

        $jawatankosongs= JawtanKosong::select('jawatankosong.*')->get();
        $tanggagaji =SalaryScale::pluck('label','id')->all();
        $bahagian =Division::pluck('label','id')->all();
        $department = Department::pluck('id','id')->all();
        $employment= Employment::all()
        ->where('ic_no', '=', $icNos);
    
     
        return view('jawatankosong.create',compact('jawatankosongs','tanggagaji','bahagian', 'department','employment'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'jawatan' => 'required',
           
            
        ]);

        $id = $request->dept_id; // Assign the value of dept_id to $id
    
        // storing data
        $now = Carbon::now();
        
        $jawatan = $request->jawatan;
        $deptid=$request->dept_id;
        // $tanggagaji = $request->tanggagaji;
        $bahagian = $request->bhg;
        $jum_kosong = $request->jum_kosong;
        $catatan = $request->catatan;
      

        if (!empty($request->jawatan) && is_array($jawatan) || !empty($request->dept_id) && is_array($deptid)
        || !empty($request->tanggagaji) && is_array($tanggagaji)|| !empty($request->bhg) && is_array($bhg)
        || !empty($request->jum_kosong) && is_array($jum_kosong)|| !empty($request->catatan) && is_array($catatan)
) {

            $insert_data_1 = []; // Initialize the array before the loop
        
            for ($count_1 = 0; $count_1 < count($jawatan); $count_1++) {
        
                $data_1 = array(
                    'dept_id' => $deptid,
                    'jawatan' => $jawatan[$count_1],
                    // 'tanggagaji' => $tanggagaji[$count_1],
                    'bhg' => $bahagian[$count_1],
                    'jum_kosong' => $jum_kosong[$count_1],
                    'catatan' => $catatan[$count_1],
                 
                    'created_at' => $now,
                    'updated_at' => $now
                );
        
                $insert_data_1[] = $data_1;
            }
        
            // Save 'jawatankosong' data
            JawtanKosong::insert($insert_data_1);
        }

        return redirect()->route('jawatankosong.indexdept', ['id' => $id])
            ->with('success_message', 'Data record was successfully updated!');
    }

    public function storecreate(Request $request)
    {

        $request->validate([
            'jawatan' => 'required',
           
        ]);

        $icNos = Auth::user()->ic_no;

    
        // storing data
        $now = Carbon::now();
        
        $jawatan = $request->jawatan;
        $deptid=$request->dept_id;
        // $tanggagaji = $request->tanggagaji;
        $bahagian = $request->bhg;
        $jum_kosong = $request->jum_kosong;
        $catatan = $request->catatan;
      


        if (!empty($request->jawatan) && is_array($jawatan) || !empty($request->dept_id) && is_array($deptid)
        || !empty($request->tanggagaji) && is_array($tanggagaji)|| !empty($request->bhg) && is_array($bhg)
        || !empty($request->jum_kosong) && is_array($jum_kosong)|| !empty($request->catatan) && is_array($catatan)
) {

            $insert_data_1 = []; // Initialize the array before the loop
        
            for ($count_1 = 0; $count_1 < count($jawatan); $count_1++) {
        
                $data_1 = array(
                    'dept_id' => $deptid,
                    'jawatan' => $jawatan[$count_1],
                    // 'tanggagaji' => $tanggagaji[$count_1],
                    'bhg' => $bahagian[$count_1],
                    'jum_kosong' => $jum_kosong[$count_1],
                    'catatan' => $catatan[$count_1],
                    'ic_no1' => $icNos,
                    'created_at' => $now,
                    'updated_at' => $now
                );
        
                $insert_data_1[] = $data_1;
            }
        
            // Save 'jawatankosong' data
            JawtanKosong::insert($insert_data_1);
        }

        return redirect()->route('jawatankosong.jawatankosong.index')
        ->with('success_message', 'Data record was successfully updated!');
    }


    public function editdept($id)
    {

     
        $jawatankosongs= JawtanKosong::all()
        ->where('id', '=', $id);
        $tanggagaji =SalaryScale::pluck('label','id')->all();
        $bahagian =Division::pluck('label','id')->all();
      

    
     
        return view('jawatankosong.editdept',compact('jawatankosongs','tanggagaji','bahagian'));
    }

    public function edit($id)
    {

     
        $jawatankosongs= JawtanKosong::all()
        ->where('id', '=', $id);
        $tanggagaji =SalaryScale::pluck('label','id')->all();
        $bahagian =Division::pluck('label','id')->all();
      

    
     
        return view('jawatankosong.edit',compact('jawatankosongs','tanggagaji','bahagian'));
    }

    public function updatedept(Request $request)
    {
     

        $now = Carbon::now();

                $jawatankosong =  JawtanKosong::select('jawatankosong.*')
                ->where('id', $request->id)
                ->update([
                    
                   
                    'bhg' => $request->bhg,
                    'jum_kosong' => $request->jum_kosong,
                    'catatan' => $request->catatan,
                    'status' => $request->status,
                    'name1' => $request->name1,
                    'ic_no1' => $request->ic_no1,
                    'name2' => $request->name2,
                    'ic_no2' => $request->ic_no2,
                    'name3' => $request->name3,
                    'ic_no3' => $request->ic_no3,
                    'updated_at' => $now

                ]);

        
            $id = $request->dept_id; // Assign the value of dept_id to $id

            return redirect()->route('jawatankosong.indexdept', ['id' => $id])
            ->with('success_message', 'Record was successfully updated!');


        
          
    }

    public function update(Request $request)
    {
     

        $now = Carbon::now();

                $jawatankosong =  JawtanKosong::select('jawatankosong.*')
                ->where('id', $request->id)
                ->update([
                  
                    'bhg' => $request->bhg,
                    'jum_kosong' => $request->jum_kosong,
                    'catatan' => $request->catatan,
                    'updated_at' => $now

                ]);

           

            return redirect()->route('jawatankosong.jawatankosong.index')
            ->with('success_message', 'Record was successfully updated!');


        
          
    }

    // method for senarai jawatan

    public function senaraijawatan()
{
    
    $jawatanlist = Jawatanlist::select('jawatansenarais.*')->orderBy('id', 'DESC')->get();

    return view('jawatankosong.senaraijawatan', compact('jawatanlist'));
}

public function storejawatan(Request $request){

    $jawatanlist = new Jawatanlist;

    $jawatanlist-> label = $request->label;
    $jawatanlist-> tanggagaji = $request->tanggagaji;


    $jawatanlist->save();

    return redirect()->route('jawatankosong.jawatankosong.senaraijawatan')
            ->with('success_message', 'Senarai Jawatan was updated!');

}

public function destroyjawatan($id)
{
    try {

      $jawatanlist= Jawatanlist::where('id', $id)->delete();

        return redirect()->route('jawatankosong.jawatankosong.senaraijawatan')
            ->with('success_message', 'Data was successfully deleted!');
    } catch (Exception $exception) {

        return back()->withInput()
            ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
    }
}

public function editSenaraiJawatan($id)
{
    $jawatanlist = Jawatanlist::findOrFail($id);
    return view('jawatankosong.editsenaraijawatan', compact('jawatanlist'));
}

public function updateSenaraiJawatan(Request $request, $id)
{
    $jawatanlist = Jawatanlist::findOrFail($id);
    $jawatanlist->label = $request->label;
    $jawatanlist->tanggagaji = $request->tanggagaji;
    $jawatanlist->save();

    return redirect()->route('jawatankosong.jawatankosong.senaraijawatan')
        ->with('success_message', 'Senarai Jawatan was updated!');
}


  


}
