<?php

namespace App\Http\Controllers;

use Session;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;

use App\Models\Programme;

use Log;
use Carbon\Carbon;

class ProgrammesController extends Controller
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
            $progimg = Programme::select(['emp_programme_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('id', $id)
            ->value('file_1');

            Storage::disk('public')->delete($progimg);

            $prog = Programme::where('id', $id)->delete();

            $ic = Auth::user()->ic_no;

            return redirect()->route('biodatas.biodata.edit', $id)
                             ->with('success_message', 'Program Pembangunan Eksekutif was successfully deleted!');

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
            'program_year' => 'required',
            'program_name' => 'required',
            'program_cohort' => 'required'
        ]);

        $icNos = Auth::user()->ic_no;

        if($request->program_file == ''){
        //add Programme
        $prog = new Programme;
        $prog-> ic_no = $icNos;
        $prog-> year = $request->program_year;
        $prog-> name = $request->program_name;
        $prog-> cohort = $request->program_cohort;

        // Save 'programme' data
        $prog-> save();
        }
        else{
        //add Programme
        $prog = new Programme;
        $prog-> ic_no = $icNos;
        $prog-> year = $request->program_year;
        $prog-> name = $request->program_name;
        $prog-> cohort = $request->program_cohort;
        $prog-> file_name = $request->program_file->getClientOriginalName();
        $prog-> file_1 = $request->file('program_file')->store('programme', 'public');

        // Save 'programme' data
        $prog-> save();
        }

        return redirect()->route('biodatas.biodata.edit', $id)
        ->with('success_message', 'Program Pembangunan Eksekutif was successfully updated!');
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

    