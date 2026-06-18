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

use Log;
use Carbon\Carbon;

class PerformancesController extends Controller
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
        $request->validate([
            'perf_file' => 'required|mimes:jpg,jpeg,bmp,png,pdf|max:2048',
            'perf_year' => 'required',
            'perf_grade' => 'required',
            'perf_markah' => 'required'
        ]);

        $icNos = Auth::user()->ic_no;
        
        //add Performances
        $perf = new Performance;
        $perf-> ic_no = $icNos;
        $perf-> year = $request->perf_year;
        $perf-> grade_id = $request->perf_grade;
        $perf-> percentage = $request->perf_markah;
        $perf-> file_name = $request->perf_file->getClientOriginalName();
        $perf-> file_1 = $request->file('perf_file')->store('performance', 'public');

        // Save 'performances' data
        $perf-> save();

        return redirect()->route('biodatas.biodata.edit', $id)
        ->with('success_message', 'Prestasi was successfully updated!');
    }
	

    public function destroy($id)
    {
        try {
            $perfimg = Performance::select(['performances.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('id', $id)
            ->value('file_1');

            Storage::disk('public')->delete($perfimg);

            $perf = Performance::where('id', $id)->delete();

            // dd($perf);

            // $perf = Performance::findOrFail($id);
            // $perf->delete();
            
            return redirect()->route('biodatas.biodata.edit', $id)
                             ->with('success_message', 'Prestasi was successfully deleted!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

}

    