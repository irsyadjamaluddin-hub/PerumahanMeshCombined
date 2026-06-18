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
	
	
    public function update($id, Request $request)
    {
        $now = Carbon::now();
        $icNos = Auth::user()->ic_no;

        $exam =  Exam::select('emp_exam_infos.*')
        ->where('id', $request->peperiksaanId)
            ->update([
                'file_name' => $request->exam_file->getClientOriginalName(),
                'file_1' => $request->file('exam_file')->store('exam', 'public'),
                'updated_at' => $now
            ]);

        return redirect()->route('biodatas.biodata.edit', $id)
        ->with('success_message', 'Peperiksaan Perkhidmatan Awam was successfully updated!');  
    }

}

    