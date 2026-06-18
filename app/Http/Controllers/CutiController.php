<?php


namespace App\Http\Controllers;

use Session;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;


use App\Models\Biodata;
use App\Models\Employment;
use App\Models\Cuti;
use App\Models\Department;
use App\Models\Jeniscuti;

use App\Models\User;
use App\Models\SalaryScale;
use App\Models\Acting;
use App\Models\ReasonActing;


use Log;
use Carbon\Carbon;

class CutiController extends Controller
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
        $cutis= Cuti::select('cutis.*')->orderBy('created_at', 'DESC')->get();

        return view('cutis.index', compact('cutis'));
    }

    public function indexP()
    {
        $ic = Auth::user()->ic_no;

        $cutis= Cuti::select('cutis.*')->where('ic_no', $ic )->orderBy('created_at', 'DESC')->get();

        return view('cutis.indexP', compact('cutis'));
    }

    public function create()
    {
        $department = Department::pluck('label','id')->all();
        $jeniscuti = Jeniscuti::pluck('label','id')->all();


        return view('cutis.create', compact('department', 'jeniscuti'));
      
    }

    public function store(Request $request)
    {
     
        $request->validate([
            'name' => 'required',
            'ic_no' => 'required',
            // 'department' => 'required',
            // 'start_date_cuti'=>'required',
            // 'end_date_cuti'=>'required',
            // 'jenis_cuti'=>'required',
          
            
        ]);

        $icNos = Auth::user()->ic_no;

            $cuti = new Cuti;
            $cuti-> name = $request->name;
            $cuti-> ic_no = $request->ic_no;
            $cuti-> department = $request->department;
            $cuti-> start_date_cuti = $request->start_date_cuti;
            $cuti-> end_date_cuti = $request->end_date_cuti;
            $cuti-> jenis_cuti = $request->jenis_cuti;
            $cuti-> catatan = $request->catatan;
        
    

        // Save 'acting' data
       $cuti-> save();

        return redirect()->route('cutis.cuti.index')
            ->with('success_message', 'New Cuti record was successfully added!');


    }

    public function edit($id)
    {
        
        $cutis= Cuti::all()
                    ->where('id', '=', $id);

        $department = Department::pluck('label','id')->all();
        $jeniscuti = Jeniscuti::pluck('label','id')->all();
                               
        return view('cutis.edit', compact('cutis' , 'department', 'jeniscuti') );
      
    }

    public function editP($id)
    {
        
        $cutis= Cuti::all()
                    ->where('id', '=', $id);

        $department = Department ::pluck('label','id')->all();
        $jeniscuti = Jeniscuti::pluck('label','id')->all();
                               
        return view('cutis.editP', compact('cutis' , 'department', 'jeniscuti') );
      
    }

    public function search(Request $request)
    {
        $id = $request->ic_search;

        $department = Department::pluck('label','id')->all();
        $jeniscuti = Jeniscuti::pluck('label','id')->all();

        $biodatas= Biodata::all()
                    ->where('ic_no', '=', $id);

        $employment= Employment::all()
                    ->where('ic_no', '=', $id);
                               
        return view('cutis.createSearch', compact('biodatas' , 'id', 'employment','department', 'jeniscuti') );
      
    }

  

    public function searchIC(Request $request)
    {
        $id = $request->ic_no;

        $cutis= Cuti::where('ic_no', '=', $id)
                    ->orWhere('ic_no', 'like', '%' . $id . '%')
                    ->orWhere('name', 'like', '%' . $id . '%')
                    ->get();
                
        return view('cutis.index', compact('cutis') );
      
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'ic_no' => 'required',
            // 'department' => 'required',
            
        ]);

        $now = Carbon::now();

                $cuti =  Cuti::select('cutis.*')
                ->where('id', $request->id)
                ->update([
                    
                    'start_date_cuti'      =>      $request->start_date_cuti,
                    'end_date_cuti'      =>      $request->end_date_cuti,
                    'jenis_cuti' => $request->jenis_cuti,
                    'catatan' => $request->catatan,
                    'updated_at' => $now

                ]);

        

        return redirect()->route('cutis.cuti.index')
            ->with('success_message', 'Cuti record was successfully updated!');

        
          
    }

    public function updateP(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'ic_no' => 'required',
            // 'department' => 'required',
   
        ]);

        $now = Carbon::now();

        $cuti =  Cuti::select('cutis.*')
                ->where('id', $request->id)
                    ->update([
                        'start_date_cuti'      =>      $request->start_date_cuti,
                        'end_date_cuti'      =>      $request->end_date_cuti,
                        'jenis_cuti' => $request->jenis_cuti,
                        'catatan' => $request->catatan,
                        'updated_at' => $now
                    ]);

         

        return redirect()->route('cutis.cuti.indexP')
            ->with('success_message', 'Cuti record was successfully updated!');

        
          
    }

    public function destroy($id)
    {
        try {


            $cuti = Cuti::where('id', $id)->delete();

          

            return redirect()->route('cutis.cuti.index')
                             ->with('success_message', 'Cuti was successfully deleted!');

            

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

}
