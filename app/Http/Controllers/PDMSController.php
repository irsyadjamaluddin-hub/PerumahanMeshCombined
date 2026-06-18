<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Session;
use DB;
use Log;
use Hash;
use Dompdf\Dompdf;
use Dompdf\Options;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rule;

use App\Models\PDMSRecordPerkhidmatan;
use App\Models\PDMSRecordCuti;
use App\Models\PDMSRecordProfile;

use App\Models\Jawatanlist;
use App\Models\Department;


class PDMSController extends Controller {

    // View Functions //
    public function index() {

        $user = Auth::user();

        return view('pdms.index');
    }

    public function serviceindex() {

        $user = Auth::user();

        return view('pdms.serviceindex');
    }

    public function cutiindex() {

        $user = Auth::user();

        return view('pdms.cutiindex');
    }
    
    public function viewall() {
        $user = Auth::user();

        $recordprofiles = PDMSRecordProfile::orderBy('no_ic', 'ASC')
            ->select('no_ic', 'name', 'no_fail_jabatan', 'id')
            ->paginate(1000);

        return view('pdms.viewall', compact('recordprofiles'));
    }

    public function viewpenyata() {
        $user = Auth::user();

        $recordprofilessudah = PDMSRecordProfile::where('penyata_fail', 'LIKE', 'Sudah')
            ->select('no_ic', 'name', 'pemohon', 'penyata_fail', 'tarikh_diserahkan', 'sekolah_maktab')
            ->orderBy('no_ic', 'ASC')
            ->paginate(1000);

        $recordprofilesbelum = PDMSRecordProfile::where('penyata_fail', 'LIKE', 'Belum')
            ->select('no_ic', 'name', 'pemohon', 'penyata_fail', 'tarikh_diserahkan', 'sekolah_maktab')
            ->orderBy('no_ic', 'ASC')
            ->paginate(1000);
        

        return view('pdms.viewpenyata', compact ('recordprofilessudah', 'recordprofilesbelum'));
    }

    public function viewname($name) {
        $user = Auth::user();

        $searchname = $name;

        $recordprofiles = PDMSRecordProfile::where('name', 'LIKE', '%' . $name . '%')
            ->orWhere('name', 'LIKE', '%' . $name . '% COLLATE utf8_general_ci')
            ->get();

        return view('pdms.viewname', compact('recordprofiles', 'searchname'));
    }

    // Profile
    public function indexfilebyic($no_ic) {

        // Replace '|' with '/'
        $no_ic = str_replace('|', '/', $no_ic);

        $recordservices = PDMSRecordPerkhidmatan::where('no_ic', '=', $no_ic)
            ->orderBy('id_rekod', 'DESC')
            ->get();

        $recordcutis = PDMSRecordCuti::where('no_ic', '=', $no_ic)
            ->orderBy('id_rekod', 'DESC')
            ->get();

        $recordprofiles = PDMSRecordProfile::where('no_ic', '=', $no_ic)
            ->get();

        return view('pdms.indexfilebyic', compact ('recordservices','recordcutis','recordprofiles'));
    }

    public function serviceindexfilebyic($no_ic) {

        // Replace '|' with '/'
        $no_ic = str_replace('|', '/', $no_ic);

        $recordservices = PDMSRecordPerkhidmatan::where('no_ic', '=', $no_ic)
            ->orderBy('id_rekod', 'DESC')
            ->get();

        $recordprofiles = PDMSRecordProfile::where('no_ic', '=', $no_ic)
            ->get();

        return view('pdms.serviceindexfilebyic', compact ('recordservices','recordprofiles'));
    }

    public function cutiindexfilebyic($no_ic) {

        // Replace '|' with '/'
        $no_ic = str_replace('|', '/', $no_ic);

        $recordcutis = PDMSRecordCuti::where('no_ic', '=', $no_ic)
            ->orderBy('id_rekod', 'DESC')
            ->get();

        $recordprofiles = PDMSRecordProfile::where('no_ic', '=', $no_ic)
            ->get();

        return view('pdms.cutiindexfilebyic', compact ('recordprofiles','recordcutis'));
    }

    public function indexfilebyname($name) {
        $pdmsname = $name;

        $recordprofiles = PDMSRecordProfile::where('name', 'LIKE', $name)
            ->get(); 

        $recordservices = PDMSRecordPerkhidmatan::join('pdms_rekod_profile', function($join) {
                $join->on('pdms_rekod_perkhidmatan.no_fail_jabatan', '=', 'pdms_rekod_profile.no_fail_jabatan')
                ->where(function($query) {
                    $query->Where('pdms_rekod_profile.no_fail_jabatan', '<>', '');
                });
            })
            ->where('pdms_rekod_profile.name', 'LIKE', $name)
            ->orderBy('id_rekod', 'DESC')
            ->get();


            $recordcutis = PDMSRecordCuti::join('pdms_rekod_profile', function($join) {
                $join->on('pdms_rekod_cuti.no_fail_jabatan', '=', 'pdms_rekod_profile.no_fail_jabatan')
                    ->where(function($query) {
                        $query->Where('pdms_rekod_profile.no_fail_jabatan', '<>', '');
                    });
            })
            ->where('pdms_rekod_profile.name', 'LIKE', $name)
            ->orderBy('id_rekod', 'DESC')
            ->get();
        

        return view('pdms.indexfilebyname', compact ('recordservices', 'recordcutis', 'recordprofiles','pdmsname'));
    }

    public function indexcreateprofile() {

        $user = Auth::user();

        $departments = Department::pluck('label', 'id')->all();
        $jawatanlists = Jawatanlist::pluck('label','id')->all();

        return view('pdms.createprofileform', compact('departments', 'jawatanlists'));
    }

    public function indexeditprofile($no_ic) {
        $user = Auth::user();

        $noic = $no_ic;

        // Replace '|' with '/'
        $no_ic = str_replace('|', '/', $no_ic);

        $recordprofiles = PDMSRecordProfile::where('no_ic', '=', $no_ic)
            ->get();

        $departments = Department::pluck('label', 'id')->all();
        $jawatanlists = Jawatanlist::pluck('label','id')->all();

        return view('pdms.editprofileform', compact('recordprofiles', 'noic', 'departments', 'jawatanlists'));
    }

    public function indexeditprofilebyname($name) {
        $user = Auth::user();

        $name = $name;

        $recordprofiles = PDMSRecordProfile::where('name', '=', $name)
            ->get();

        $departments = Department::pluck('label', 'id')->all();
        $jawatanlists = Jawatanlist::pluck('label','id')->all();

        return view('pdms.editprofileformbyname', compact('recordprofiles', 'name', 'departments', 'jawatanlists'));
    }

    public function storeprofile(Request $request) {
        $user = Auth::user()->name;
        $now = Carbon::now();

        $recordprofiles = new PDMSRecordProfile($request->all());

        // Check if the 'no_ic' already exists in the database
        if (PDMSRecordProfile::where('no_ic', $request->no_ic)->exists()) {
            return redirect()->back()->with('error_message', 'Identification Card Number already exists!');
        }

        // Calculate retirement date (60 years later from the date of birth)
        $dob = new Carbon($request->tarikh_lahir);
        $retirementDate = $dob->copy()->addYears(60);

        // Format the retirement date as YYYY-MM-DD
        $formattedRetirementDate = $retirementDate->toDateString();

        // Set the retirement date in the PDMSRecordProfile instance
        $recordprofiles->tarikh_bersara = $formattedRetirementDate;

        $recordprofiles->created_at = $now;
        $recordprofiles->created_by = $user;


        $recordprofiles->save();

        return redirect()->route('pdms.index')
            ->with('success_message', 'PDMS profile were successfully added!');
    }

    public function updateprofileform(Request $request, $no_ic) {
        $user = Auth::user()->name;

        // Calculate retirement date (60 years later from the date of birth)
        $dob = new Carbon($request->tarikh_lahir);
        $retirementDate = $dob->copy()->addYears(60);

        // Format the retirement date as YYYY-MM-DD
        $formattedRetirementDate = $retirementDate->toDateString();

        // Replace '/' with '|'
        $modified_no_ic = str_replace('|', '/', $no_ic);

        // Find the record to be updated
        $profile = PDMSRecordProfile::where('no_ic', $modified_no_ic)
            ->first();

        if ($request->no_ic !== $profile->no_ic && PDMSRecordProfile::where('no_ic', $request->no_ic)->exists()) {
            return redirect()->back()->with('error_message', 'Identification Card Number already exists!');
        }

        // Update the record with the new data
        $profile->name = $request->input('name');
        $profile->no_ic = $request->input('no_ic');
        $profile->ic_colour = $request->input('ic_colour');
        $profile->no_fail_jabatan = $request->input('no_fail_jabatan');

        $jawatan = $request->input('jawatan_sekarang');
        if ($jawatan !== '' && $jawatan !== null) {
            $profile->jawatan_sekarang = $jawatan;
        }

        $profile->jenis_perkhidmatan = $request->input('jenis_perkhidmatan');
        $profile->bahagian = $request->input('bahagian');
        $profile->tanggagaji = $request->input('tanggagaji');
        $profile->no_fail_jpa = $request->input('no_fail_jpa');

        $profile->jantina = $request->input('jantina');
        $profile->tarikh_lahir = $request->input('tarikh_lahir');
        $profile->tarikh_bersara = $formattedRetirementDate;
        $profile->tempat_lahir = $request->input('tempat_lahir');
        $profile->ugama = $request->input('ugama');
        $profile->bangsa = $request->input('bangsa');
        $profile->kerakyatan = $request->input('kerakyatan');
        $profile->taraf_kelamin = $request->input('taraf_kelamin');
        $profile->tarikh_mula_berkhidmat = $request->input('tarikh_mula_berkhidmat');

        $profile->alamat_rumah = $request->input('alamat_rumah');
        $profile->alamat_lain = $request->input('alamat_lain');
        $profile->telefon_rumah = $request->input('telefon_rumah');
        $profile->telefon_mobile = $request->input('telefon_mobile');

        $profile->tarikh_lantikan_sekarang = $request->input('tarikh_lantikan_sekarang');
        $profile->tempat_bertugas = $request->input('tempat_bertugas');

        $jabatan = $request->input('jabatan');
        if ($jabatan !== '' && $jabatan !== null) {
            $profile->jabatan = $jabatan;
        }

        $profile->kementerian = $request->input('kementerian');
        $profile->tarikh_penepatan_jawatan = $request->input('tarikh_penepatan_jawatan');
        $profile->status = $request->input('status');
        $profile->skim_perkhidmatan = $request->input('skim_perkhidmatan');
        $profile->skim_perguruan = $request->input('skim_perguruan');

        $profile->updated_by = $user;
        $profile->save();

        return redirect()->route('pdms.indexfilebyic', ['no_ic' => $no_ic])
                    ->with('success_message', 'PDMS Profile updated successfully!');
    }

    public function updateprofileformbyname(Request $request, $name) {
        $user = Auth::user()->name;

        // Calculate retirement date (60 years later from the date of birth)
        $dob = new Carbon($request->tarikh_lahir);
        $retirementDate = $dob->copy()->addYears(60);

        // Format the retirement date as YYYY-MM-DD
        $formattedRetirementDate = $retirementDate->toDateString();

        // Find the record to be updated
        $profile = PDMSRecordProfile::where('name', $name)
            ->first();

        if ($request->no_ic !== $profile->no_ic && PDMSRecordProfile::where('no_ic', $request->no_ic)->exists()) {
            return redirect()->back()->with('error_message', 'Identification Card Number already exists!');
        }

        // Update the record with the new data
        $profile->name = $request->input('name');
        $profile->no_ic = $request->input('no_ic');
        $profile->ic_colour = $request->input('ic_colour');
        $profile->no_fail_jabatan = $request->input('no_fail_jabatan');
        $profile->jawatan_sekarang = $request->input('jawatan_sekarang');
        $profile->jenis_perkhidmatan = $request->input('jenis_perkhidmatan');
        $profile->bahagian = $request->input('bahagian');
        $profile->tanggagaji = $request->input('tanggagaji');
        $profile->no_fail_jpa = $request->input('no_fail_jpa');

        $profile->jantina = $request->input('jantina');
        $profile->tarikh_lahir = $request->input('tarikh_lahir');
        $profile->tarikh_bersara = $formattedRetirementDate;
        $profile->tempat_lahir = $request->input('tempat_lahir');
        $profile->ugama = $request->input('ugama');
        $profile->bangsa = $request->input('bangsa');
        $profile->kerakyatan = $request->input('kerakyatan');
        $profile->taraf_kelamin = $request->input('taraf_kelamin');
        $profile->tarikh_mula_berkhidmat = $request->input('tarikh_mula_berkhidmat');

        $profile->alamat_rumah = $request->input('alamat_rumah');
        $profile->alamat_lain = $request->input('alamat_lain');
        $profile->telefon_rumah = $request->input('telefon_rumah');
        $profile->telefon_mobile = $request->input('telefon_mobile');

        $profile->tarikh_lantikan_sekarang = $request->input('tarikh_lantikan_sekarang');
        $profile->tempat_bertugas = $request->input('tempat_bertugas');
        $profile->jabatan = $request->input('jabatan');
        $profile->kementerian = $request->input('kementerian');
        $profile->tarikh_penepatan_jawatan = $request->input('tarikh_penepatan_jawatan');
        $profile->status = $request->input('status');
        $profile->skim_perkhidmatan = $request->input('skim_perkhidmatan');
        $profile->skim_perguruan = $request->input('skim_perguruan');

        $profile->updated_by = $user;
        $profile->save();

        $no_ic = $request->input('no_ic');

        return redirect()->route('pdms.indexfilebyic', ['no_ic' => $no_ic])
                    ->with('success_message', 'PDMS Profile updated successfully!');
    }

    public function destroyprofilerecord($id, $no_ic = null) {
        // Profile
        $recordProfile = PDMSRecordProfile::findOrFail($id);
        $recordProfile->delete();
    
        // Check if no_ic exists
        if ($no_ic) {
            // Service
            $recordService = PDMSRecordPerkhidmatan::where('no_ic', $no_ic)->first();
            if ($recordService) {
                $recordService->delete();
            }
    
            // Cuti
            $recordCuti = PDMSRecordCuti::where('no_ic', $no_ic)->first();
            if ($recordCuti) {
                $recordCuti->delete();
            }
        }
    
        return redirect()->route('pdms.viewall')
            ->with('success_message', 'PDMS Profile successfully deleted');
    }

    // Service Records
    public function indexcreateservice($no_ic) {
        $user = Auth::user();

        $noic = $no_ic;

        // Replace '|' with '/'
        $no_ic = str_replace('|', '/', $no_ic);

        $recordprofiles = PDMSRecordProfile::where('no_ic', '=', $no_ic)
            ->get();

        $recordservices = PDMSRecordPerkhidmatan::where('no_ic', '=', $no_ic)
            ->orderBy('id_rekod', 'ASC')
            ->get();

        $departments = Department::pluck('label', 'id')->all();
        $jawatanlists = Jawatanlist::pluck('label','id')->all();

        return view('pdms.createserviceform', compact('recordprofiles', 'recordservices', 'noic', 'departments', 'jawatanlists'));
    }

    public function serviceindexcreateservice($no_ic) {
        $user = Auth::user();

        $noic = $no_ic;

        // Replace '|' with '/'
        $no_ic = str_replace('|', '/', $no_ic);

        $recordprofiles = PDMSRecordProfile::where('no_ic', '=', $no_ic)
            ->get();

        $recordservices = PDMSRecordPerkhidmatan::where('no_ic', '=', $no_ic)
            ->orderBy('id_rekod', 'ASC')
            ->get();

        $jawatanlists = Jawatanlist::pluck('label','id')->all();

        return view('pdms.servicecreateserviceform', compact('recordprofiles', 'recordservices', 'noic', 'jawatanlists'));
    }

    public function indexeditservice($no_ic, $id_rekod) {
        $user = Auth::user();

        $noic = $no_ic;

        // Replace '|' with '/'
        $no_ic = str_replace('|', '/', $no_ic);

        $recordId = $id_rekod;

        $recordprofiles = PDMSRecordProfile::where('no_ic', '=', $no_ic)
            ->get();

        $recordservices = PDMSRecordPerkhidmatan::where('no_ic', '=', $no_ic)
            ->where('id_rekod', '=', $id_rekod)
            ->get();

        $jawatanlists = Jawatanlist::pluck('label','id')->all();

        return view('pdms.editserviceform', compact('recordprofiles', 'recordservices', 'noic', 'recordId', 'jawatanlists'));
    }

    public function serviceindexeditservice($no_ic, $id_rekod) {
        $user = Auth::user();

        $noic = $no_ic;

        // Replace '|' with '/'
        $no_ic = str_replace('|', '/', $no_ic);

        $recordId = $id_rekod;

        $recordprofiles = PDMSRecordProfile::where('no_ic', '=', $no_ic)
            ->get();

        $recordservices = PDMSRecordPerkhidmatan::where('no_ic', '=', $no_ic)
            ->where('id_rekod', '=', $id_rekod)
            ->get();

        $jawatanlists = Jawatanlist::pluck('label','id')->all();

        return view('pdms.serviceeditserviceform', compact('recordprofiles', 'recordservices', 'noic', 'recordId', 'jawatanlists'));
    }

    public function storeserviceform(Request $request, $no_ic) {
        $user = Auth::user()->name;
        $now = Carbon::now();

        $noic = $no_ic;

        // Replace '/' with '|'
        $modified_no_ic = str_replace('|', '/', $no_ic);

        $recordprofiles = PDMSRecordProfile::where('no_ic', '=', $modified_no_ic)
            ->first();

        if ($recordprofiles) {
            $nofailjabatan = $recordprofiles->no_fail_jabatan;

            // Check if the id_rekod already exists
            $existingIdRekod = PDMSRecordPerkhidmatan::where('no_ic', $modified_no_ic)
            ->where('id_rekod', $request->id_rekod)
            ->exists();

            if ($existingIdRekod) {
                return redirect()->route('pdms.createserviceform', ['no_ic' => $no_ic])
                    ->with('error_message', 'Record ID already exists');
            }

            $recordservices = new PDMSRecordPerkhidmatan($request->all());

            $recordservices->jenis_maklumat = json_encode($request->input('jenis_maklumat'));
            $recordservices->no_fail_jabatan = $nofailjabatan;
            $recordservices->no_ic = $modified_no_ic;
            $recordservices->created_at = $now;

            $recordservices->save();

            return redirect()->route('pdms.indexfilebyic', ['no_ic' => $no_ic])
                ->with('success_message', 'PDMS Record were successfully added!');
        } else {
            return redirect()->route('pdms.indexfilebyic', ['no_ic' => $no_ic])
                ->with('error_message', 'PDMS profile not found');
        }
    }

    public function servicestoreserviceform(Request $request, $no_ic) {
        $user = Auth::user()->name;
        $now = Carbon::now();

        $noic = $no_ic;

        // Replace '/' with '|'
        $modified_no_ic = str_replace('|', '/', $no_ic);

        $recordprofiles = PDMSRecordProfile::where('no_ic', '=', $modified_no_ic)
            ->first();

        if ($recordprofiles) {
            $nofailjabatan = $recordprofiles->no_fail_jabatan;

            // Check if the id_rekod already exists
            $existingIdRekod = PDMSRecordPerkhidmatan::where('no_ic', $modified_no_ic)
            ->where('id_rekod', $request->id_rekod)
            ->exists();

            if ($existingIdRekod) {
                return redirect()->route('pdms.createserviceform', ['no_ic' => $no_ic])
                    ->with('error_message', 'Record ID already exists');
            }

            $recordservices = new PDMSRecordPerkhidmatan($request->all());

            $recordservices->jenis_maklumat = json_encode($request->input('jenis_maklumat'));
            $recordservices->no_fail_jabatan = $nofailjabatan;
            $recordservices->no_ic = $modified_no_ic;
            $recordservices->created_at = $now;

            $recordservices->save();

            return redirect()->route('pdms.serviceindexfilebyic', ['no_ic' => $no_ic])
                ->with('success_message', 'PDMS Record were successfully added!');
        } else {
            return redirect()->route('pdms.serviceindexfilebyic', ['no_ic' => $no_ic])
                ->with('error_message', 'PDMS profile not found');
        }
    }

    public function updateserviceform(Request $request, $no_ic, $id_rekod) {
        $user = Auth::user()->name;
        // Validate the form data
        $request->validate([
            'jawatan' => 'nullable|string',
            'tarikh_mula' => 'nullable|date',
            'tarikh_hingga' => 'nullable|date|after:tarikh_mula',
            'gaji_bulan' => 'nullable|numeric',
            'catitan' => 'nullable|string',
            'jenis_maklumat' => 'nullable|array'
        ]);

        // Replace '/' with '|'
        $modified_no_ic = str_replace('|', '/', $no_ic);

        // Find the record to be updated
        $record = PDMSRecordPerkhidmatan::where('no_ic', $modified_no_ic)
            ->where('id_rekod', $id_rekod)
            ->first();

        if (!$record) {
            return redirect()->back()->with('error', 'Record not found');
        }

        // Update the record with the new data
        $jawatan = $request->input('jawatan');
        if ($jawatan !== '' && $jawatan !== null) {
            $record->jawatan = $jawatan;
        }

        $record->tarikh_mula = $request->input('tarikh_mula');
        $record->tarikh_hingga = $request->input('tarikh_hingga');
        $record->gaji_bulan = $request->input('gaji_bulan');
        $record->catitan = $request->input('catitan');
        $record->jenis_maklumat = $request->input('jenis_maklumat');
        $record->updated_by = $user;
        $record->save();

        return redirect()->route('pdms.indexfilebyic', ['no_ic' => $no_ic])
                    ->with('success_message', 'PDMS Record updated successfully!');
    }

    public function serviceupdateserviceform(Request $request, $no_ic, $id_rekod) {
        $user = Auth::user()->name;
        // Validate the form data
        $request->validate([
            'jawatan' => 'nullable|string',
            'tarikh_mula' => 'nullable|date',
            'tarikh_hingga' => 'nullable|date|after:tarikh_mula',
            'gaji_bulan' => 'nullable|numeric',
            'catitan' => 'nullable|string',
            'jenis_maklumat' => 'nullable|array'
        ]);

        // Replace '/' with '|'
        $modified_no_ic = str_replace('|', '/', $no_ic);

        // Find the record to be updated
        $record = PDMSRecordPerkhidmatan::where('no_ic', $modified_no_ic)
            ->where('id_rekod', $id_rekod)
            ->first();

        if (!$record) {
            return redirect()->back()->with('error', 'Record not found');
        }

        // Update the record with the new data
        $jawatan = $request->input('jawatan');
        if ($jawatan !== '' && $jawatan !== null) {
            $record->jawatan = $jawatan;
        }

        $record->tarikh_mula = $request->input('tarikh_mula');
        $record->tarikh_hingga = $request->input('tarikh_hingga');
        $record->gaji_bulan = $request->input('gaji_bulan');
        $record->catitan = $request->input('catitan');
        $record->jenis_maklumat = $request->input('jenis_maklumat');
        $record->updated_by = $user;
        $record->save();

        return redirect()->route('pdms.serviceindexfilebyic', ['no_ic' => $no_ic])
                    ->with('success_message', 'PDMS Record updated successfully!');
    }

    public function destroyservicerecord($no_ic, $id_rekod) {

        // Replace '/' with '|'
        $modified_no_ic = str_replace('|', '/', $no_ic);

        // Find the record to be deleted
        $record = PDMSRecordPerkhidmatan::where('no_ic', $modified_no_ic)
            ->where('id_rekod', $id_rekod)
            ->first();

        if (!$record) {
            return redirect()->back()->with('error_message', 'Record not found');
        }
        // Delete the record
        $record->delete();

        return redirect()->route('pdms.indexfilebyic', ['no_ic' => $no_ic])
                    ->with('success_message', 'PDMS Service Record successfully deleted');
    }

    public function servicedestroyservicerecord($no_ic, $id_rekod) {
        $modified_no_ic = str_replace('|', '/', $no_ic);

        // Find the record to be deleted
        $record = PDMSRecordPerkhidmatan::where('no_ic', $modified_no_ic)
            ->where('id_rekod', $id_rekod)
            ->first();

        if (!$record) {
            return redirect()->back()->with('error_message', 'Record not found');
        }
        // Delete the record
        $record->delete();

        return redirect()->route('pdms.serviceindexfilebyic', ['no_ic' => $no_ic])
                    ->with('success_message', 'PDMS Service Record successfully deleted');
    }

    // Leave Records
    public function indexcreateleave($no_ic) {
        $user = Auth::user();

        $noic = $no_ic;

        // Replace '|' with '/'
        $no_ic = str_replace('|', '/', $no_ic);

        $recordprofiles = PDMSRecordProfile::where('no_ic', '=', $no_ic)
            ->get();

        $recordcutis = PDMSRecordCuti::where('no_ic', '=', $no_ic)
            ->orderBy('id_rekod', 'ASC')
            ->get();

        return view('pdms.createleaveform', compact('recordprofiles', 'recordcutis', 'noic'));
    }

    public function cutiindexcreateleave($no_ic) {
        $user = Auth::user();

        $noic = $no_ic;

        // Replace '|' with '/'
        $no_ic = str_replace('|', '/', $no_ic);

        $recordprofiles = PDMSRecordProfile::where('no_ic', '=', $no_ic)
            ->get();

        $recordcutis = PDMSRecordCuti::where('no_ic', '=', $no_ic)
            ->orderBy('id_rekod', 'ASC')
            ->get();

        return view('pdms.cuticreateleaveform', compact('recordprofiles', 'recordcutis', 'noic'));
    }

    public function indexeditleave($no_ic, $id_rekod) {
        $user = Auth::user();

        $noic = $no_ic;

        // Replace '|' with '/'
        $no_ic = str_replace('|', '/', $no_ic);

        $recordId = $id_rekod;

        $recordprofiles = PDMSRecordProfile::where('no_ic', '=', $no_ic)
            ->get();

        $recordcutis = PDMSRecordCuti::where('no_ic', '=', $no_ic)
            ->where('id_rekod', '=', $id_rekod)
            ->get();

        return view('pdms.editleaveform', compact('recordprofiles', 'recordcutis', 'noic', 'recordId'));
    }

    public function cutiindexeditleave($no_ic, $id_rekod) {
        $user = Auth::user();

        $noic = $no_ic;

        // Replace '|' with '/'
        $no_ic = str_replace('|', '/', $no_ic);

        $recordId = $id_rekod;

        $recordprofiles = PDMSRecordProfile::where('no_ic', '=', $no_ic)
            ->get();

        $recordcutis = PDMSRecordCuti::where('no_ic', '=', $no_ic)
            ->where('id_rekod', '=', $id_rekod)
            ->get();

        return view('pdms.cutieditleaveform', compact('recordprofiles', 'recordcutis', 'noic', 'recordId'));
    }

    public function storeleaveform(Request $request, $no_ic) {
        $user = Auth::user()->name;
        $now = Carbon::now();

        $noic = $no_ic;

        // Replace '/' with '|'
        $modified_no_ic = str_replace('|', '/', $no_ic);

        $recordprofiles = PDMSRecordProfile::where('no_ic', '=', $modified_no_ic)
            ->first();

        if ($recordprofiles) {
            $nofailjabatan = $recordprofiles->no_fail_jabatan;

            // Check if the id_rekod already exists
            $existingIdRekod = PDMSRecordCuti::where('no_ic', $modified_no_ic)
            ->where('id_rekod', $request->id_rekod)
            ->exists();

            if ($existingIdRekod) {
                return redirect()->route('pdms.createleaveform', ['no_ic' => $no_ic])
                    ->with('error_message', 'Record ID already exists');
            }

            $recordcutis = new PDMSRecordCuti($request->all());

            $recordcutis->no_fail_jabatan = $nofailjabatan;
            $recordcutis->no_ic = $modified_no_ic;
            $recordcutis->created_at = $now;

            $recordcutis->save();

            return redirect()->route('pdms.indexfilebyic', ['no_ic' => $no_ic])
                ->with('success_message', 'PDMS Leave Form were successfully added!');
        } else {
            return redirect()->route('pdms.indexfilebyic', ['no_ic' => $no_ic])
                ->with('error_message', 'PDMS profile not found');
        }
    }

    public function cutistoreleaveform(Request $request, $no_ic) {
        $user = Auth::user()->name;
        $now = Carbon::now();

        $noic = $no_ic;

        // Replace '/' with '|'
        $modified_no_ic = str_replace('|', '/', $no_ic);

        $recordprofiles = PDMSRecordProfile::where('no_ic', '=', $modified_no_ic)
            ->first();

        if ($recordprofiles) {
            $nofailjabatan = $recordprofiles->no_fail_jabatan;

            // Check if the id_rekod already exists
            $existingIdRekod = PDMSRecordCuti::where('no_ic', $modified_no_ic)
            ->where('id_rekod', $request->id_rekod)
            ->exists();

            if ($existingIdRekod) {
                return redirect()->route('pdms.createleaveform', ['no_ic' => $no_ic])
                    ->with('error_message', 'Record ID already exists');
            }

            $recordcutis = new PDMSRecordCuti($request->all());

            $recordcutis->no_fail_jabatan = $nofailjabatan;
            $recordcutis->no_ic = $modified_no_ic;
            $recordcutis->created_at = $now;

            $recordcutis->save();

            return redirect()->route('pdms.cutiindexfilebyic', ['no_ic' => $no_ic])
                ->with('success_message', 'PDMS Leave Form were successfully added!');
        } else {
            return redirect()->route('pdms.cutiindexfilebyic', ['no_ic' => $no_ic])
                ->with('error_message', 'PDMS profile not found');
        }
    }

    public function updateleaveform(Request $request, $no_ic, $id_rekod) {
        $user = Auth::user()->name;
        // Validate the form data
        $request->validate([
            'jenis_cuti' => 'nullable|string',
            'jumlah_hari' => 'nullable|numeric',
            'tarikh_mula' => 'nullable|date',
            'tarikh_akhir' => 'nullable|date|after:tarikh_mula',
            'remark' => 'nullable|string',
        ]);

        // Replace '/' with '|'
        $modified_no_ic = str_replace('|', '/', $no_ic);

        // Find the record to be updated
        $cutis = PDMSRecordCuti::where('no_ic', $modified_no_ic)
            ->where('id_rekod', $id_rekod)
            ->first();

        if (!$cutis) {
            return redirect()->back()->with('error', 'Record not found');
        }

        // Update the record with the new data
        $cutis->jenis_cuti = $request->input('jenis_cuti');
        $cutis->jumlah_hari = $request->input('jumlah_hari');
        $cutis->tarikh_mula = $request->input('tarikh_mula');
        $cutis->tarikh_akhir = $request->input('tarikh_akhir');
        $cutis->remark = $request->input('remark');
        $cutis->updated_by = $user;
        $cutis->save();

        return redirect()->route('pdms.indexfilebyic', ['no_ic' => $no_ic])
                    ->with('success_message', 'PDMS Leave Form updated successfully!');
    }

    public function cutiupdateleaveform(Request $request, $no_ic, $id_rekod) {
        $user = Auth::user()->name;
        // Validate the form data
        $request->validate([
            'jenis_cuti' => 'nullable|string',
            'jumlah_hari' => 'nullable|numeric',
            'tarikh_mula' => 'nullable|date',
            'tarikh_akhir' => 'nullable|date|after:tarikh_mula',
            'remark' => 'nullable|string',
        ]);

        // Replace '/' with '|'
        $modified_no_ic = str_replace('|', '/', $no_ic);

        // Find the record to be updated
        $cutis = PDMSRecordCuti::where('no_ic', $modified_no_ic)
            ->where('id_rekod', $id_rekod)
            ->first();

        if (!$cutis) {
            return redirect()->back()->with('error', 'Record not found');
        }

        // Update the record with the new data
        $cutis->jenis_cuti = $request->input('jenis_cuti');
        $cutis->jumlah_hari = $request->input('jumlah_hari');
        $cutis->tarikh_mula = $request->input('tarikh_mula');
        $cutis->tarikh_akhir = $request->input('tarikh_akhir');
        $cutis->remark = $request->input('remark');
        $cutis->updated_by = $user;
        $cutis->save();

        return redirect()->route('pdms.cutiindexfilebyic', ['no_ic' => $no_ic])
                    ->with('success_message', 'PDMS Leave Form updated successfully!');
    }

    public function destroyleaverecord($no_ic, $id_rekod) {
        $modified_no_ic = str_replace('|', '/', $no_ic);

        // Find the record to be deleted
        $cutis = PDMSRecordCuti::where('no_ic', $modified_no_ic)
            ->where('id_rekod', $id_rekod)
            ->first();

        if (!$cutis) {
            return redirect()->back()->with('error_message', 'Record not found');
        }
        // Delete the record
        $cutis->delete();

        return redirect()->route('pdms.indexfilebyic', ['no_ic' => $no_ic])
                    ->with('success_message', 'PDMS Leave Record successfully deleted');
    }

    public function cutidestroyleaverecord($no_ic, $id_rekod) {
        $modified_no_ic = str_replace('|', '/', $no_ic);

        // Find the record to be deleted
        $cutis = PDMSRecordCuti::where('no_ic', $modified_no_ic)
            ->where('id_rekod', $id_rekod)
            ->first();

        if (!$cutis) {
            return redirect()->back()->with('error_message', 'Record not found');
        }
        // Delete the record
        $cutis->delete();

        return redirect()->route('pdms.cutiindexfilebyic', ['no_ic' => $no_ic])
                    ->with('success_message', 'PDMS Leave Record successfully deleted');
    }

    //File Statement
    public function indexcreatestatement($no_ic) {
        $user = Auth::user();

        $noic = $no_ic;

        // Replace '|' with '/'
        $no_ic = str_replace('|', '/', $no_ic);

        $recordprofiles = PDMSRecordProfile::where('no_ic', '=', $no_ic)
            ->get();

        return view('pdms.createstatementform', compact('recordprofiles', 'noic'));
    }

    public function indexeditstatement ($no_ic) {
        $user = Auth::user();

        $noic = $no_ic;

        // Replace '|' with '/'
        $no_ic = str_replace('|', '/', $no_ic);

        $recordprofiles = PDMSRecordProfile::where('no_ic', '=', $no_ic)
            ->get();

        return view('pdms.editstatementform', compact('recordprofiles', 'noic'));
    }

    public function storestatementform(Request $request, $no_ic) {
        $user = Auth::user()->name;

        // Replace '/' with '|'
        $modified_no_ic = str_replace('|', '/', $no_ic);

        // Find the record to be updated
        $statements = PDMSRecordProfile::where('no_ic', $modified_no_ic)
            ->first();

        if (!$statements) {
            return redirect()->back()->with('error', 'Record not found');
        }

        // Update the record with the new data
        $statements->pemohon = $request->input('pemohon');
        $statements->penyata_fail = $request->input('penyata_fail');
        $statements->tarikh_diserahkan = $request->input('tarikh_diserahkan');
        $statements->sekolah_maktab = $request->input('sekolah_maktab');
        $statements->save();

        return redirect()->route('pdms.indexfilebyic', ['no_ic' => $no_ic])
                    ->with('success_message', 'PDMS Statement Form created successfully!');
    }

    public function updatestatementform(Request $request, $no_ic) {
        $user = Auth::user()->name;

        // Replace '/' with '|'
        $modified_no_ic = str_replace('|', '/', $no_ic);

        // Find the record to be updated
        $statements = PDMSRecordProfile::where('no_ic', $modified_no_ic)
            ->first();

        if (!$statements) {
            return redirect()->back()->with('error', 'Record not found');
        }

        // Update the record with the new data
        $statements->pemohon = $request->input('pemohon');
        $statements->penyata_fail = $request->input('penyata_fail');
        $statements->tarikh_diserahkan = $request->input('tarikh_diserahkan');
        $statements->sekolah_maktab = $request->input('sekolah_maktab');
        $statements->updated_by = $user;
        $statements->save();

        return redirect()->route('pdms.indexfilebyic', ['no_ic' => $no_ic])
                    ->with('success_message', 'PDMS Statement Form updated successfully!');
    }

    public function destroystatementrecord($no_ic) {
        $modified_no_ic = str_replace('|', '/', $no_ic);

        // Find the record to be updated
        $statement = PDMSRecordProfile::where('no_ic', $modified_no_ic)
        ->first();
    
        if (!$statement) {
            return redirect()->back()->with('error_message', 'Record not found');
        }
    
        // Set the fields to null or remove them
        $statement->update([
            'pemohon' => null,
            'penyata_fail' => null,
            'tarikh_diserahkan' => null,
            'sekolah_maktab' => null,
        ]);
    
        return redirect()->route('pdms.indexfilebyic', ['no_ic' => $no_ic])
            ->with('success_message', 'Selected fields in PDMS File Statement successfully deleted');
    } 

    // Search Functions //
    public function searchbyname(Request $request) {

        $name = $request->input('name');

        $request->validate([
            'name' => 'required|string'
        ]);

        $recordprofiles = PDMSRecordProfile::where('name', 'LIKE', '%' . $name . '%')
            ->orWhere('name', 'LIKE', '%' . $name . '% COLLATE utf8_general_ci')
            ->select('name','no_ic')
            ->get();

        // Check if no records are found
        if ($recordprofiles->isEmpty()) {
            return redirect()->route('pdms.index')->with(['error_message' => 'No similar records found for the provided Name.']);
        } else {
            return redirect()->route('pdms.viewname', ['name' => $name]);
        }
    }

    public function searchbyic(Request $request) {
        $no_ic = $request->input('no_ic');

        // Replace '/' with '-'
        $modified_no_ic = str_replace('/', '|', $no_ic);

        $recordservices = PDMSRecordPerkhidmatan::where('no_ic', '=', $no_ic)
            ->orderBy('id_rekod', 'ASC')
            ->get();

        $recordcutis = PDMSRecordCuti::where('no_ic', '=', $no_ic)
            ->orderBy('id_rekod', 'ASC')
            ->get();

        $recordprofiles = PDMSRecordProfile::where('no_ic', '=', $no_ic)
            ->get();

        // Check if no records are found
        if ($recordprofiles->isEmpty()) {
            return redirect()->route('pdms.index')->with(['error_message' => 'No records found for the provided IC number.']);
        } else {
            return redirect()->route('pdms.indexfilebyic', ['no_ic' => $modified_no_ic]);
        }
    }

    public function servicesearchbyic(Request $request) {

        $no_ic = $request->input('no_ic');
        
        // Replace '/' with '-'
        $modified_no_ic = str_replace('/', '|', $no_ic);

        $recordservices = PDMSRecordPerkhidmatan::where('no_ic', '=', $no_ic)
            ->orderBy('id_rekod', 'ASC')
            ->get();

        $recordprofiles = PDMSRecordProfile::where('no_ic', '=', $no_ic)
            ->get();

        // Check if no records are found
        if ($recordprofiles->isEmpty()) {
            return redirect()->route('pdms.serviceindex')->with(['error_message' => 'No records found for the provided IC number.']);
        } else {
            return redirect()->route('pdms.serviceindexfilebyic', ['no_ic' => $modified_no_ic]);
        }
    }

    public function cutisearchbyic(Request $request) {
        $no_ic = $request->input('no_ic');
        
        // Replace '/' with '-'
        $modified_no_ic = str_replace('/', '|', $no_ic);

        $recordcutis = PDMSRecordCuti::where('no_ic', '=', $no_ic)
            ->orderBy('id_rekod', 'ASC')
            ->get();

        $recordprofiles = PDMSRecordProfile::where('no_ic', '=', $no_ic)
            ->get();

        // Check if no records are found
        if ($recordprofiles->isEmpty()) {
            return redirect()->route('pdms.cutiindex')->with(['error_message' => 'No records found for the provided IC number.']);
        } else {
            return redirect()->route('pdms.cutiindexfilebyic', ['no_ic' => $modified_no_ic]);
        }
    }

    public function showbyname(Request $request) {
        $name = $request->input('name');

        $recordprofiles = PDMSRecordProfile::where('name', 'LIKE', $name)
            ->get();

        return redirect()->route('pdms.indexfilebyname', ['name' => $name]);
    }

    //Print Form
    public function printserviceform($no_ic) {
        
        // Replace '|' with '/'
        $no_ic = str_replace('|', '/', $no_ic);

        $recordservices = PDMSRecordPerkhidmatan::where('no_ic', '=', $no_ic)
            ->orderBy('id_rekod', 'DESC')
            ->get();

        $recordprofiles = PDMSRecordProfile::where('no_ic', '=', $no_ic)
            ->get();
        
        // Create a new PDF document
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf = new Dompdf($options);

        // HTML content for the PDF
        $pdfContent = '<html><head><style>
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                border: 1px solid #000;
                padding: 5px;
            }
            .date {
                width: 12.5%;
            }
            .catitan {
                width: 35%;
                text-align: justify;
                text-justify: inter-word;
            }
            .gaji {
                text-align: center;
            }
            .jawatan {
                width: 14%;
            }
        </style></head><body>';

        $pdfContent .= '<div>';
        $pdfContent .= 'Name: ' .'<b>'. $recordprofiles->first()->name .'</b>';
        $pdfContent .= '<br>';
        $pdfContent .= 'File no: ' . $recordprofiles->first()->no_fail_jabatan;
        $pdfContent .= '<br>';
        $pdfContent .= 'Ic no: ' .'<b>'. $recordprofiles->first()->no_ic .'</b>';
        $pdfContent .= '<br>';
        $pdfContent .= 'Ic colour: ' . $recordprofiles->first()->ic_colour;
        $pdfContent .= '<br>';
        $pdfContent .= 'Jawatan Sekarang: ' . $recordprofiles->first()->jawatan_sekarang;
        $pdfContent .= '</div>';

        $pdfContent .= '<br>';

        $pdfContent .= '<table>';
        $pdfContent .= '<thead>';
        $pdfContent .= '<tr><th></th><th>Type of Service</th><th>Position</th><th class="date">Date Start</th><th class="date">Date End</th><th>Monthly Pay (BND)</th><th>Notes</th></tr>';
        $pdfContent .= '</thead>';

        $pdfContent .= '<tbody>';
        foreach ($recordservices as $borang) {
            $pdfContent .= '<tr>';

            $pdfContent .= '<td>' . $borang->id_rekod . '</td>';
            $pdfContent .= '<td>';
            $jenisMaklumatString = '';
            if (!empty($borang->jenis_maklumat)) {
                $jenisMaklumat = json_decode($borang->jenis_maklumat);
                if (is_array($jenisMaklumat)) {
                    // Replace '/' with ', ' in each string of the array
                    $formattedMaklumat = [];
                    foreach ($jenisMaklumat as $item) {
                        $formattedMaklumat[] = str_replace('/', ', ', $item);
                    }
                    $jenisMaklumatString = implode(', ', $formattedMaklumat);
                } else {
                    $jenisMaklumatString = str_replace('/', ', ', $borang->jenis_maklumat);
                }
            }
            $pdfContent .= $jenisMaklumatString;
            $pdfContent .= '</td>';   
            $pdfContent .= '<td class="jawatan">' . $borang->jawatan . '</td>';
            $pdfContent .= '<td>' . ($borang->tarikh_mula ? date('d/m/Y', strtotime($borang->tarikh_mula)) : '') . '</td>';
            $pdfContent .= '<td>' . ($borang->tarikh_hingga ? date('d/m/Y', strtotime($borang->tarikh_hingga)) : '') . '</td>';            
            $pdfContent .= '<td class="gaji">' . ($borang->gaji_bulan != 0 ? '$' . $borang->gaji_bulan : '') . '</td>';
            $pdfContent .= '<td class="catitan">' . $borang->catitan . '</td>';
            $pdfContent .= '</tr>';
        }
        $pdfContent .= '</tbody>';

        $pdfContent .= '</table></body></html>';

        // Load the HTML content into Dompdf
        $dompdf->loadHtml($pdfContent);

        // Set paper size and orientation (e.g., 'A4', 'portrait')
        $dompdf->setPaper('A4', 'portrait');

        // Render the PDF (first step)
        $dompdf->render();

        // Stream the PDF to the client
        return Response::stream(
            function () use ($dompdf, $recordprofiles) {
                $dompdf->stream('Rekod_Perkhidmatan (' .$recordprofiles->first()->name. ').pdf', [
                    'Attachment' => true,
                ]);
            },
            200,
            [
                'Content-Type' => 'application/pdf',
            ]
        );
    }

    public function printserviceformbyname($name) {

        // Replace '|' with '/'
        $no_ic = str_replace('|', '/', $no_ic);

        $recordprofiles = PDMSRecordProfile::where('name', 'LIKE', $name)
            ->get(); 

        $recordservices = PDMSRecordPerkhidmatan::join('pdms_rekod_profile', function($join) {
                $join->on('pdms_rekod_perkhidmatan.no_fail_jabatan', '=', 'pdms_rekod_profile.no_fail_jabatan')
                ->where(function($query) {
                    $query->Where('pdms_rekod_profile.no_fail_jabatan', '<>', '');
                });
            })
            ->where('pdms_rekod_profile.name', 'LIKE', $name)
            ->orderBy('id_rekod', 'DESC')
            ->get();
        
        // Create a new PDF document
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf = new Dompdf($options);

        // HTML content for the PDF
        $pdfContent = '<html><head><style>
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                border: 1px solid #000;
                padding: 5px;
            }
            .date {
                width: 12.5%;
            }
            .catitan {
                width: 35%;
                text-align: justify;
                text-justify: inter-word;
            }
            .gaji {
                text-align: center;
            }
            .jawatan {
                width: 14%;
            }
        </style></head><body>';

        $pdfContent .= '<div>';
        $pdfContent .= 'Name: ' .'<b>'. $recordprofiles->first()->name .'</b>';
        $pdfContent .= '<br>';
        $pdfContent .= 'File no: ' . $recordprofiles->first()->no_fail_jabatan;
        $pdfContent .= '<br>';
        $pdfContent .= 'Ic no: ' .'<b>'. $recordprofiles->first()->no_ic .'</b>';
        $pdfContent .= '<br>';
        $pdfContent .= 'Ic colour: ' . $recordprofiles->first()->ic_colour;
        $pdfContent .= '<br>';
        $pdfContent .= 'Jawatan Sekarang: ' . $recordprofiles->first()->jawatan_sekarang;
        $pdfContent .= '</div>';

        $pdfContent .= '<br>';

        $pdfContent .= '<table>';
        $pdfContent .= '<thead>';
        $pdfContent .= '<tr><th></th><th>Type of Service</th><th>Position</th><th class="date">Date Start</th><th class="date">Date End</th><th>Monthly Pay (BND)</th><th>Notes</th></tr>';
        $pdfContent .= '</thead>';

        $pdfContent .= '<tbody>';
        foreach ($recordservices as $borang) {
            $pdfContent .= '<tr>';

            $pdfContent .= '<td>' . $borang->id_rekod . '</td>';
            $pdfContent .= '<td>';
            $jenisMaklumatString = '';
            if (!empty($borang->jenis_maklumat)) {
                $jenisMaklumat = json_decode($borang->jenis_maklumat);
                if (is_array($jenisMaklumat)) {
                    // Replace '/' with ', ' in each string of the array
                    $formattedMaklumat = [];
                    foreach ($jenisMaklumat as $item) {
                        $formattedMaklumat[] = str_replace('/', ', ', $item);
                    }
                    $jenisMaklumatString = implode(', ', $formattedMaklumat);
                } else {
                    $jenisMaklumatString = str_replace('/', ', ', $borang->jenis_maklumat);
                }
            }
            $pdfContent .= $jenisMaklumatString;
            $pdfContent .= '</td>';   
            $pdfContent .= '<td class="jawatan">' . $borang->jawatan . '</td>';
            $pdfContent .= '<td>' . ($borang->tarikh_mula ? date('d/m/Y', strtotime($borang->tarikh_mula)) : '') . '</td>';
            $pdfContent .= '<td>' . ($borang->tarikh_hingga ? date('d/m/Y', strtotime($borang->tarikh_hingga)) : '') . '</td>';            
            $pdfContent .= '<td class="gaji">' . ($borang->gaji_bulan != 0 ? '$' . $borang->gaji_bulan : '') . '</td>';
            $pdfContent .= '<td class="catitan">' . $borang->catitan . '</td>';
            $pdfContent .= '</tr>';
        }
        $pdfContent .= '</tbody>';

        $pdfContent .= '</table></body></html>';

        // Load the HTML content into Dompdf
        $dompdf->loadHtml($pdfContent);

        // Set paper size and orientation (e.g., 'A4', 'portrait')
        $dompdf->setPaper('A4', 'portrait');

        // Render the PDF (first step)
        $dompdf->render();

        // Stream the PDF to the client
        return Response::stream(
            function () use ($dompdf, $recordprofiles) {
                $dompdf->stream('Rekod_Perkhidmatan (' .$recordprofiles->first()->name. ').pdf', [
                    'Attachment' => true,
                ]);
            },
            200,
            [
                'Content-Type' => 'application/pdf',
            ]
        );
    }

    public function printcutiform($no_ic) {

        // Replace '|' with '/'
        $no_ic = str_replace('|', '/', $no_ic);

        $recordcutis = PDMSRecordCuti::where('no_ic', '=', $no_ic)
            ->orderBy('id_rekod', 'DESC')
            ->get();

        $recordprofiles = PDMSRecordProfile::where('no_ic', '=', $no_ic)
            ->get();
        
        // Create a new PDF document
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf = new Dompdf($options);

        // HTML content for the PDF
        $pdfContent = '<html><head><style>
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                border: 1px solid #000;
                padding: 5px;
            }
            .date {
                width: 12.5%;
            }
            .remarks {
                width: 35%;
                text-align: justify;
                text-justify: inter-word;
            }
            .haricuti {
                text-align: center;
            }
        </style></head><body>';

        $pdfContent .= '<div>';
        $pdfContent .= 'Name: ' .'<b>'. $recordprofiles->first()->name .'</b>';
        $pdfContent .= '<br>';
        $pdfContent .= 'File no: ' . $recordprofiles->first()->no_fail_jabatan;
        $pdfContent .= '<br>';
        $pdfContent .= 'Ic no: ' .'<b>'. $recordprofiles->first()->no_ic .'</b>';
        $pdfContent .= '<br>';
        $pdfContent .= 'Ic colour: ' . $recordprofiles->first()->ic_colour;
        $pdfContent .= '<br>';
        $pdfContent .= 'Jawatan Sekarang: ' . $recordprofiles->first()->jawatan_sekarang;
        $pdfContent .= '</div>';

        $pdfContent .= '<br>';

        $pdfContent .= '<table>';
        $pdfContent .= '<thead>';
        $pdfContent .= '<tr><th></th><th>Type of Leave</th><th>Total Day on Leave</th><th class="date">Date Start</th><th class="date">Date End</th><th>Remarks</th></tr>';
        $pdfContent .= '</thead>';

        $pdfContent .= '<tbody>';
        foreach ($recordcutis as $borang) {
            $pdfContent .= '<tr>';

            $pdfContent .= '<td>' . $borang->id_rekod . '</td>';   
            $pdfContent .= '<td>' . $borang->jenis_cuti . '</td>';
            $pdfContent .= '<td class="haricuti">' . $borang->jumlah_hari . '</td>';
            $pdfContent .= '<td>' . ($borang->tarikh_mula ? date('d/m/Y', strtotime($borang->tarikh_mula)) : '') . '</td>';
            $pdfContent .= '<td>' . ($borang->tarikh_akhir ? date('d/m/Y', strtotime($borang->tarikh_akhir)) : '') . '</td>';            
            $pdfContent .= '<td class="remarks">' . $borang->remark . '</td>';
            $pdfContent .= '</tr>';
        }
        $pdfContent .= '</tbody>';

        $pdfContent .= '</table></body></html>';

        // Load the HTML content into Dompdf
        $dompdf->loadHtml($pdfContent);

        // Set paper size and orientation (e.g., 'A4', 'portrait')
        $dompdf->setPaper('A4', 'portrait');

        // Render the PDF (first step)
        $dompdf->render();

        // Stream the PDF to the client
        return Response::stream(
            function () use ($dompdf, $recordprofiles) {
                $dompdf->stream('Rekod_Cuti (' .$recordprofiles->first()->name. ').pdf', [
                    'Attachment' => true,
                ]);
            },
            200,
            [
                'Content-Type' => 'application/pdf',
            ]
        );
    }

    public function printcutiformbyname($name) {

        // Replace '|' with '/'
        $no_ic = str_replace('|', '/', $no_ic);

        $recordprofiles = PDMSRecordProfile::where('name', 'LIKE', $name)
            ->get(); 

        $recordcutis = PDMSRecordCuti::join('pdms_rekod_profile', function($join) {
                $join->on('pdms_rekod_cuti.no_fail_jabatan', '=', 'pdms_rekod_profile.no_fail_jabatan')
                    ->where(function($query) {
                        $query->Where('pdms_rekod_profile.no_fail_jabatan', '<>', '');
                    });
            })
            ->where('pdms_rekod_profile.name', 'LIKE', $name)
            ->orderBy('id_rekod', 'DESC')
            ->get();
        
        // Create a new PDF document
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf = new Dompdf($options);

        // HTML content for the PDF
        $pdfContent = '<html><head><style>
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                border: 1px solid #000;
                padding: 5px;
            }
            .date {
                width: 12.5%;
            }
            .remarks {
                width: 35%;
                text-align: justify;
                text-justify: inter-word;
            }
            .haricuti {
                text-align: center;
            }
        </style></head><body>';

        $pdfContent .= '<div>';
        $pdfContent .= 'Name: ' .'<b>'. $recordprofiles->first()->name .'</b>';
        $pdfContent .= '<br>';
        $pdfContent .= 'File no: ' . $recordprofiles->first()->no_fail_jabatan;
        $pdfContent .= '<br>';
        $pdfContent .= 'Ic no: ' .'<b>'. $recordprofiles->first()->no_ic .'</b>';
        $pdfContent .= '<br>';
        $pdfContent .= 'Ic colour: ' . $recordprofiles->first()->ic_colour;
        $pdfContent .= '<br>';
        $pdfContent .= 'Jawatan Sekarang: ' . $recordprofiles->first()->jawatan_sekarang;
        $pdfContent .= '</div>';

        $pdfContent .= '<br>';

        $pdfContent .= '<table>';
        $pdfContent .= '<thead>';
        $pdfContent .= '<tr><th></th><th>Type of Leave</th><th>Total Day on Leave</th><th class="date">Date Start</th><th class="date">Date End</th><th>Remarks</th></tr>';
        $pdfContent .= '</thead>';

        $pdfContent .= '<tbody>';
        foreach ($recordcutis as $borang) {
            $pdfContent .= '<tr>';

            $pdfContent .= '<td>' . $borang->id_rekod . '</td>';   
            $pdfContent .= '<td>' . $borang->jenis_cuti . '</td>';
            $pdfContent .= '<td class="haricuti">' . $borang->jumlah_hari . '</td>';
            $pdfContent .= '<td>' . ($borang->tarikh_mula ? date('d/m/Y', strtotime($borang->tarikh_mula)) : '') . '</td>';
            $pdfContent .= '<td>' . ($borang->tarikh_akhir ? date('d/m/Y', strtotime($borang->tarikh_akhir)) : '') . '</td>';            
            $pdfContent .= '<td class="remarks">' . $borang->remark . '</td>';
            $pdfContent .= '</tr>';
        }
        $pdfContent .= '</tbody>';

        $pdfContent .= '</table></body></html>';

        // Load the HTML content into Dompdf
        $dompdf->loadHtml($pdfContent);

        // Set paper size and orientation (e.g., 'A4', 'portrait')
        $dompdf->setPaper('A4', 'portrait');

        // Render the PDF (first step)
        $dompdf->render();

        // Stream the PDF to the client
        return Response::stream(
            function () use ($dompdf, $recordprofiles) {
                $dompdf->stream('Rekod_Cuti (' .$recordprofiles->first()->name. ').pdf', [
                    'Attachment' => true,
                ]);
            },
            200,
            [
                'Content-Type' => 'application/pdf',
            ]
        );
    }

}
