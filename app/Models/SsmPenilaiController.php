<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SsmPenilai;
use Illuminate\Support\Facades\Auth;

class SsmPenilaiController extends Controller
{

    public function index(){

        $icNos = Auth::user()->ic_no;
        
        $ssmpsb = SsmPenilai::select('ssm_penilai.*')
            ->where('correlation','Main')
            ->where('status','Submitted')
            ->get();

        $ssmpsi = SsmPenilai::select('ssm_penilai.*')
            ->where('correlation','Main')
            ->where('status','Selesai')
            ->get();

        return view('ssmpenilai.index',compact('ssmpsb','ssmpsi'));
    }

    public function form(){

        return view('ssmpenilai.form');
    }

    public function store(Request $request){

        $now = now();

        $ssmpen = new SsmPenilai;
        $ssmpen->name = $request->name;
        $ssmpen->ic_no = $request->ic_no;
        $ssmpen->email = $request->email;
        $ssmpen->phone_number = $request->phone_number;
        $ssmpen->correlation = 'Main';
        $ssmpen->save();

        // Grab the ID of the recently saved record
        $mainRecordId = $ssmpen->id;
        
        $namaPegawai = $request->input('nama_pegawai');
        $jawatan = $request->input('jawatan');
        $noKadPengenalan = $request->input('no_kad_pengenalan');
        $namaPegawaiPenilai = $request->input('nama_pegawai_penilai');
        $noKadPengenalanPenilai = $request->input('no_kad_pengenalan_penilai');

        for ($i = 0; $i < count($namaPegawai); $i++) {
            $spc = new SsmPenilai;
            $spc->name_peg = $namaPegawai[$i];
            $spc->jawatan_peg = $jawatan[$i];
            $spc->ic_no_peg = $noKadPengenalan[$i];
            $spc->name_pen = $namaPegawaiPenilai[$i];
            $spc->ic_no_pen = $noKadPengenalanPenilai[$i];
            $spc->correlation = $mainRecordId;
            $spc->created_at = $now;
            $spc->save();
        }

        return back()->with('success_message','Borang berjaya di hantar!');
    }

    public function update(Request $request){

        $now = now();

        $ssmp =  SsmPenilai::select('ssm_penilai.*')
            ->where('id', $request->id)
            ->update([
                'status' => 'Selesai',
                'updated_at' => $now
            ]);

        $ssmone =  SsmPenilai::select('ssm_penilai.*')
            ->where('id', $request->id)
            ->first();

        $ssmall = SsmPenilai::select('ssm_penilai.*')
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
}
  