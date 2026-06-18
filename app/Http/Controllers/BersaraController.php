<?php

namespace App\Http\Controllers;

use Session;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;




use App\Models\Biodata;
use App\Models\Employment;
use App\Models\User;
use App\Models\Bersara;
// use App\Models\PeruntukanBersara;
use App\Models\Terminationtype;
use App\Models\Retirementposition;

// use App\Models\Employment;
use App\Models\Department;


use Log;
use Carbon\Carbon;

class BersaraController extends Controller
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
    $bersaras= Bersara::select('bersaras.*')->orderBy('created_at', 'DESC')->get();

    return view('bersaras.index', compact('bersaras'));
}

public function indexP()
{
    $ic = Auth::user()->ic_no;

    $bersaras= Bersara::select('bersaras.*')->where('ic_no', $ic )->orderBy('created_at', 'DESC')->get();

    return view('bersaras.indexP', compact('bersaras'));
}

public function create()
{
    // return view('bersaras.create');
    // $icNos = Auth::user()->ic_no;

    $terminationtype = Terminationtype::pluck('label','id')->all();
    $retirementposition = Retirementposition::pluck('label','id')->all();
    $retirementposition1 = Retirementposition::pluck('label','id')->all();

    // $departments = Department::pluck('label','id')->all();

    return view('bersaras.create', compact('terminationtype','retirementposition', 'retirementposition1'));
  
}

public function store(Request $request)
{
 
    $request->validate([
        'name' => 'required',
        'ic_no' => 'required',
       



    
    ]);

    $icNos = Auth::user()->ic_no;

        $bersara = new Bersara;
        $bersara-> name = $request->name;
        $bersara-> ic_no = $request->ic_no;
        $bersara-> bersara_post = $request->bersara_post;
        $bersara-> penamatan = $request->penamatan;
        $bersara-> peruntukanbersara=$request->peruntukanbersara;
        $bersara-> end_date_bersara = $request->end_date_bersara;
        $bersara-> date_cuti_bersara = $request->date_cuti_bersara;
        $bersara-> date_bersara = $request->date_bersara;
        $bersara-> ulasan = $request->ulasan;
        $bersara-> created_by_ic_no = $icNos;

    

    // Save 'acting' data
   $bersara-> save();

    return redirect()->route('bersaras.bersara.index')
        ->with('success_message', 'New Bersara record was successfully added!');


}

public function edit($id)
{
    
    $bersaras= Bersara::all()
                ->where('id', '=', $id);
                
    $terminationtype = Terminationtype::pluck('label','id')->all();
    $retirementposition = Retirementposition::pluck('label','id')->all();
    $retirementposition1 = Retirementposition::pluck('label','id')->all();
    return view('bersaras.edit', compact('bersaras', 'terminationtype' ,'retirementposition','retirementposition1') );
  
}

public function editP($id)
{
    
    $bersaras= Bersara::all()
                ->where('id', '=', $id);   
    $terminationtype = Terminationtype::pluck('label','id')->all();    
    $retirementposition = Retirementposition::pluck('label','id')->all(); 
    $retirementposition1 = Retirementposition::pluck('label','id')->all();              
    return view('bersaras.editP', compact('bersaras', 'terminationtype' ,'retirementposition1') );
  
}

public function search(Request $request)
{
    $id = $request->ic_search;

    $biodatas= Biodata::all()
                ->where('ic_no', '=', $id);

    $employment= Employment::all()
                ->where('ic_no', '=', $id);

    $terminationtype = Terminationtype::pluck('label','id')->all();
    $retirementposition = Retirementposition::pluck('label','id')->all();   
    
    $retirementposition1 = Retirementposition::pluck('label','id')->all();   

    return view('bersaras.createSearch', compact('biodatas' , 'id', 'employment', 'terminationtype','retirementposition','retirementposition1') );
  
}



public function searchIC(Request $request)
{
    $id = $request->ic_no;
    

    $bersaras= Bersara::where('ic_no', '=', $id)
                ->orWhere('ic_no', 'like', '%' . $id . '%')
                ->orWhere('name', 'like', '%' . $id . '%')
                // ->orWhere('name', 'like', '%' . $id . '%')
                ->get();
            
    return view('bersaras.index', compact('bersaras') );
  
}

public function update(Request $request)
{
    $request->validate([
        'name' => 'required',
        'ic_no' => 'required',
      
    ]);

    $now = Carbon::now();
    
    $bersara =  Bersara::select('bersaras.*')
    ->where('id', $request->id)
     ->update([
            'bersara_post'         =>      $request->bersara_post,
            'penamatan'      =>      $request->penamatan,
            'peruntukanbersara'      =>      $request->peruntukanbersara,
            'end_date_bersara'      =>      $request->end_date_bersara,
            'date_cuti_bersara'      =>      $request->date_cuti_bersara,
            'date_bersara' => $request->date_bersara,
            'ulasan' => $request->ulasan,
            'updated_at' => $now

            ]);
    

    return redirect()->route('bersaras.bersara.index')
        ->with('success_message', 'Bersara record was successfully updated!');

    
      
}

public function updateP(Request $request)
{
    $request->validate([
        'name' => 'required',
        'ic_no' => 'required',
     
    ]);

    $now = Carbon::now();

    $bersara =  Bersara::select('bersaras.*')
            ->where('id', $request->id)
                ->update([
                    'bersara_post'         => $request->bersara_post,
                    'penamatan'      =>      $request->penamatan,
                    'peruntukanbersara'      =>      $request->peruntukanbersara,
                    'end_date_bersara'      =>      $request->end_date_bersara,
                    'date_cuti_bersara'      =>      $request->date_cuti_bersara,
                    'date_bersara' => $request->date_bersara,
                    'ulasan' => $request->ulasan,
                    'updated_at' => $now
                ]);

     

    return redirect()->route('bersaras.bersara.indexP')
        ->with('success_message', 'Bersara record was successfully updated!');

    
      
}

public function destroy($id)
{
    try {

        
      

        $bersara = Bersara::where('id', $id)->delete();

        return redirect()->route('bersaras.bersara.index')
                         ->with('success_message', 'Bersara was successfully deleted!');

        

    } catch (Exception $exception) {

        return back()->withInput()
                     ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
    }
}


}
