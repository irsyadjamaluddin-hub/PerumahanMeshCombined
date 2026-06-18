<?php

namespace App\Http\Controllers;

use Session;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;

use App\Models\Certificate;

use Log;
use Carbon\Carbon;

class CertificatesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
	
	    public function destroy($id)
    {
        try {
            $certimg = Certificate::select(['emp_certificate_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('id', $id)
            ->value('file_1');

            Storage::disk('public')->delete($certimg);

            $cert = Certificate::where('id', $id)->delete();

            return redirect()->route('biodatas.biodata.edit', $id)
                             ->with('success_message', 'Sijil Profesional was successfully deleted!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }
	
    public function update($id, Request $request)
    {
        $now = Carbon::now();
        $icNos = Auth::user()->ic_no;

        $cert =  Certificate::select('emp_certificate_infos.*')
        ->where('id', $request->sijilId)
            ->update([
                'file_name' => $request->cert_file->getClientOriginalName(),
                'file_1' => $request->file('cert_file')->store('certificate', 'public'),
                'updated_at' => $now
            ]);

        return redirect()->route('biodatas.biodata.edit', $id)
            ->with('success_message', 'Sijil Profesional was successfully updated!');  
    }

}

    