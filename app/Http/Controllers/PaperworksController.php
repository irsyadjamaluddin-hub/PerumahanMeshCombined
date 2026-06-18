<?php

namespace App\Http\Controllers;

use Session;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;

use App\Models\Paperwork;

use Log;
use Carbon\Carbon;

class PaperworksController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
	
    public function destroy($id)
    {
        try {
            $pworkimg = Paperwork::select(['emp_paperwork_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('id', $id)
            ->value('file_1');

            Storage::disk('public')->delete($pworkimg);

            $pwork = Paperwork::where('id', $id)->delete();

            return redirect()->route('biodatas.biodata.edit', $id)
                             ->with('success_message', 'Kertas Kerja was successfully deleted!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }
	


    public function update($id, Request $request)
    {
        $now = Carbon::now();
        $icNos = Auth::user()->ic_no;

        $pwork =  Paperwork::select('emp_paperwork_infos.*')
        ->where('id', $request->kertaskerjaId)
            ->update([
                'file_name' => $request->paperwork_file->getClientOriginalName(),
                'file_1' => $request->file('paperwork_file')->store('paperwork', 'public'),
                'updated_at' => $now
            ]);

        return redirect()->route('biodatas.biodata.edit', $id)
        ->with('success_message', 'Kertas Kerja was successfully updated!');  
    }

}

    