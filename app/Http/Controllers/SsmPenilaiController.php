<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Models\SsmPenilai;
use App\Models\SsmPenilaiPeg;
use Illuminate\Support\Facades\Auth;

class SsmPenilaiController extends Controller
{

    public function index(){

        $icNos = Auth::user()->ic_no;
        
        $ssmpsb = SsmPenilai::select('ssm_penilai.*')
            ->where('status','Submitted')
            ->get();

        $ssmpsi = SsmPenilai::select('ssm_penilai.*')
            ->where('status','Selesai')
            ->get();
        
        $ssmpg = SsmPenilaiPeg::all();

        return view('ssmpenilai.index',compact('ssmpg','ssmpsb','ssmpsi'));
    }

    public function form(){

        return view('ssmpenilai.form');
    }

    public function store(Request $request){

        // Check if 'sections' is provided and is not empty
        if (!$request->has('sections') || empty($request->input('sections'))) {
            return back()->with('error_message', 'Maklumat pegawai perlu di isi!'); // Return error message if no sections are provided
        }

        $now = Carbon::now();

        // Saving the main record
        $ssmpen = new SsmPenilai;
        $ssmpen->name = $request->name;
        $ssmpen->ic_no = $request->ic_no;
        $ssmpen->email = $request->email;
        $ssmpen->phone_number = $request->phone_number;
        $ssmpen->status = 'Submitted';
        $ssmpen->save();

        $latestId = $ssmpen->getConnection()->getPdo()->lastInsertId();

        // Whatsapp API Start
        $data = [
            'phone' => "+673" . $request->phone_number, // Receiver's phone
            'template' => 'ssm_pp', // Template name
            'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8', // Namespace of template
            'language' => ['code' => 'en', 'policy' => 'deterministic'], // Language parameters
            'params' => [['type' => 'body', 'parameters' => [
                ['type' => 'text', 'text' => $latestId]
            ]]]
        ];


        $json = json_encode($data); // Encode data to JSON
        // URL for request POST /message
        $token = '7hpe9bwi2bl1k5ja';
        $instanceId = '448643';
        $url = 'http://moe.proxy.mesh/' . $instanceId . '/sendTemplate?token=' . $token;

        // Make a POST request
        $options = stream_context_create(['http' => [
            'method' => 'POST',
            'header' => 'Content-type: application/json',
            'content' => $json
        ]]);

        // Send a request
        $result = file_get_contents($url, false, $options);
        // Whatsapp API End
    
        $sections = $request->input('sections'); // Array of sections
    
        foreach ($sections as $section) {
            // Grab the ID of the recently saved record
            $mainRecordId = $ssmpen->id;
            
            // Get the name and IC number of the penilai (evaluator)
            $namaPenilai = $section['nama_pegawai_penilai'];
            $icPenilai = $section['no_kad_pengenalan_penilai'];
            
            // Check if 'rows' exists and is an array
            if (isset($section['rows']) && is_array($section['rows'])) {
                foreach ($section['rows'] as $row) {
                    $spc = new SsmPenilaiPeg;
                    $spc->name_peg = $row['nama_pegawai'];
                    $spc->jawatan_peg = $row['jawatan'];
                    $spc->ic_no_peg = $row['no_kad_pengenalan'];
                    $spc->name_pen = $namaPenilai; // Assign the penilai's name
                    $spc->ic_no_pen = $icPenilai; // Assign the penilai's IC number
                    $spc->correlation = $mainRecordId;
                    $spc->status = 'Submitted';
                    $spc->created_at = $now;
                    $spc->save();
                }
            }
        }

        return back()->with('success_message','Borang berjaya di hantar!');
    }

    public function update(Request $request){

        $now = Carbon::now();

        $ssmp =  SsmPenilaiPeg::select('ssm_penilai_peg.*')
            ->where('id', $request->id)
            ->update([
                'status' => 'Selesai',
                'updated_at' => $now
            ]);

        $ssmone =  SsmPenilaiPeg::select('ssm_penilai_peg.*')
            ->where('id', $request->id)
            ->first();

        $ssmall = SsmPenilaiPeg::select('ssm_penilai_peg.*')
            ->where('correlation', $ssmone->correlation)
            ->get();

        // Get the status of the first record
        $firstStatus = $ssmall->first()->status;
        
        // Check if all records have the same status
        $allSameStatus = $ssmall->every(function($item) use ($firstStatus) {
            return $item->status == $firstStatus;
        });
        
        if ($allSameStatus) {
            
            $ssmmain = SsmPenilai::select('ssm_penilai.*')
                ->where('id', $ssmone->correlation)
                ->update([
                    'status' => 'Selesai',
                    'updated_at' => $now
                ]);

            return back()->with('success_message','Borang berjaya di update!');
        } else {
            return back()->with('success_message','Borang berjaya di update!');
        }
    }

    public function status(Request $request){

        $now = Carbon::now();

        $ssmps =  SsmPenilai::select('ssm_penilai.*')
            ->where('id', $request->id)
            ->get();

        if ($ssmps->isEmpty()) {

            return back()->with('error_message','There is no submitted form with that reference!');
        } else {
            
            $ssmp = SsmPenilai::select('ssm_penilai.*')
                ->where('id', $request->id)
                ->first();

            $ssmpp = SsmPenilaiPeg::select('ssm_penilai_peg.*')
                ->where('correlation', $request->id)
                ->get();

            return view('ssmpenilai.status',compact('ssmp','ssmpp'))->with('success_message','Form has been successfully found!');
        }
        
    }
}
  