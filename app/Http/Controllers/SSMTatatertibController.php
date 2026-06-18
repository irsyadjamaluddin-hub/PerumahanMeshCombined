<?php

namespace App\Http\Controllers;

use Session;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

use App\Http\Controllers\Controller;

use App\Models\Day;
use App\Models\Biodata;
use App\Models\Contact;
use App\Models\Gender;
use App\Models\Race;
use App\Models\Religion;
use App\Models\Citizenship;
use App\Models\User;
use App\Models\MaritalStatus;
use App\Models\ICColor;
use App\Models\Department;
use App\Models\Ministry;
use App\Models\Bahagian;
use App\Models\Unit;
use App\Models\Country;
use App\Models\EmploymentStatus;
use App\Models\MileageStatus;
use App\Models\AllowanceCategory;
use App\Models\Division;
use App\Models\EducationLevel;
use App\Models\Education;
use App\Models\Employment;
use App\Models\Designation;
use App\Models\District;
use App\Models\SkimPerkhidmatan;
use App\Models\SalaryScale;
use App\Models\RolePeranan;
use App\Models\Cluster;
use App\Models\ServiceStatus;
use App\Models\Salary;
use App\Models\Performance;
use App\Models\Medal;
use App\Models\Grade;
use App\Models\Certificate;
use App\Models\Exam;
use App\Models\ExamList;
use App\Models\Programme;
use App\Models\ProgrammeList;
use App\Models\Paperwork;
use App\Models\Course;
use App\Models\VaccinationInfo;
use App\Models\VaccinationDose;
use App\Models\VaccinationBooster;
use App\Models\Vulnerable;
use App\Models\EmergencyRelationship;
use App\Models\ART;
use App\Models\File;
use App\Models\SSM;
use App\Models\Bersara;
use App\Models\SSMRequest;

//Ekma Touch
use App\Models\Jawatanlist;
use App\Models\SSMApproval;
use App\Models\SSMDc;
use App\Models\SSMOthers;
use App\Models\SSMPassword;
use App\Models\SSMPeranan;
use App\Models\SSMPermohonan;
use App\Models\SSMBakicuti;
use App\Models\SSMPertukaranic;
use App\Models\SSMKod;
use App\Models\SSMPermohonanicno;
use App\Models\SSMJenisPermohonan;
use App\Models\SSMPermohonanSalinan;
use App\Models\SSMPermohonanSalinanicno;

// Add by Fira ************************************************************************************************************************
use App\Models\SSMTatatertib;
use App\Models\SSMTatatertibicno;
use App\Models\SSMTatatertibCatatan;


use Log;
use Carbon\Carbon;

class SSMTatatertibController extends Controller
{
    // SSM Tatatertib - Fira (24/1)*******************************************************************************************************
    public function indextatatertib()
    {
        $ssmtatatertib = SSMTatatertib::select('ssm_tatatertib.*')
            ->orderBy('id', 'DESC')
            ->get();

        $catatanEntries = SSMTatatertibCatatan::all();

        return view('ssmtatatertib.indextatatertib', compact('ssmtatatertib', 'catatanEntries'));
    }

    public function createtatatertib(Request $request)
    { 
        if ($request->ajax()) {
            $icNo = $request->input('tt_icno');
            
            $existingRecord = SSMTatatertib::where('tt_icno', $icNo)->exists();
            
            return response()->json(['exists' => $existingRecord]);
        }
        
        $icNos = Auth::user()->ic_no;
        $jawatanlist = Jawatanlist::pluck('label','id')->all();
        $ssmtatatertib = SSMTatatertib::where('tt_icno', $icNos)->get();

        return view('ssmtatatertib.createtatatertib', compact('ssmtatatertib', 'jawatanlist'));
    }

    public function storetatatertib(Request $request)
    {
        $request->validate([
        ]);
    
            $icNos = Auth::user()->ic_no;
    
            $ssmtatatertib = new SSMTatatertib();
    
            $ssmtatatertib->tt_name = $request->tt_name;
            $ssmtatatertib->tt_icno = $request->tt_icno;
            $ssmtatatertib->tt_surat_rujukan = $request->tt_surat_rujukan;
            $ssmtatatertib->tt_perkara = $request->tt_perkara;
            $ssmtatatertib->tt_jawatan = $request->tt_jawatan;
            $ssmtatatertib->tt_tempat_bertugas = $request->tt_tempat_bertugas;
            $ssmtatatertib->tt_email = $request->tt_email;
            $ssmtatatertib->tt_notel = $request->tt_notel;
            $ssmtatatertib->created_at = now();
            $ssmtatatertib->created_by = $icNos;
    
            if ($request->hasFile('tt_file')) {
                $uploadedFiles = [];
    
                foreach ($request->file('tt_file') as $file) {
                    $filename = $file->getClientOriginalName();
                    $path = $file->storeAs('public/ssmtatatertib', $filename);
    
                    $uploadedFiles[] = $filename;
                }
    
                $ssmtatatertib->tt_file = $uploadedFiles;
            }

            if (SSMTatatertib::where('tt_icno', $request->tt_icno)->exists()) {
                return redirect()->back()->with('error_message', 'The IC number is already in record.');
            }
    
            $ssmtatatertib->save();
    
            if ($request->filled('tt_catatan')) {
                foreach ($request->tt_catatan as $key => $catatan) {
                    $ssmTatatertibCatatan = new SSMTatatertibCatatan();
                    $ssmTatatertibCatatan->tt_id = $ssmtatatertib->id;
                    $ssmTatatertibCatatan->tt_no_catatan = $key + 1;
                    $ssmTatatertibCatatan->tt_catatan = $catatan;
                    $ssmTatatertibCatatan->tt_catatan_date = now();
                    $ssmTatatertibCatatan->save();
                }
            }
    
            return redirect()->route('ssmtatatertib.ssmrequest.indextatatertib')
                ->with('success', 'Tatatertib record has been saved successfully.');
    }
    
    public function checkIcNo(Request $request)
    {
        if ($request->ajax()) {
            $tt_icno = $request->input('tt_icno');
            
            $existingRecord = SSMTatatertib::where('tt_icno', $tt_icno)->exists();
            
            return response()->json(['exists' => $existingRecord]);
        }
    }
    
    
    public function destroytatatertib($id)
    {
        try {
            $ssmtatatertib = SSMTatatertib::where('id', $id)->delete();
            $ssmtatatertibicno = SSMTatatertibicno::where('tt_icno', $id)->delete();
            return back()->withInput()->with('success_message', 'Data Tatatertib deleted!');
        } catch (Exception $exception) {
            return back()->withInput()->withErrors(['error_message' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function editadmintatatertib($id)
    {
        $icNos = Auth::user()->ic_no;

        $ssmtatatertib = SSMTatatertib::with(['ssmkod', 'selesaikod'])->where('id', $id)->get();

        $ssmtatatertibcatatan = SSMTatatertibCatatan::where('tt_id', $id)->get();

        $ssmtatatertibicno = SSMTatatertibicno::with('ssmkod')->where('tt_id', '=', $id)->get();
        $jawatanlist = Jawatanlist::pluck('label', 'label')->all();

        return view('ssmtatatertib.editadmintatatertib', compact('ssmtatatertib', 'ssmtatatertibcatatan', 'ssmtatatertibicno', 'jawatanlist'));
    }

    public function updateadmintatatertib(Request $request)
    {
        $icNos = Auth::user()->ic_no;
        $now = Carbon::now();
    
        try {
            $ssmtatatertib = SSMTatatertib::findOrFail($request->id);
    
            $ssmtatatertib->update([
                'tt_name' => $request->tt_name,
                'tt_icno' => $request->tt_icno,
                'tt_surat_rujukan' => $request->tt_surat_rujukan,
                'tt_perkara' => $request->tt_perkara,
                'tt_jawatan' => $request->tt_jawatan,
                'tt_tempat_bertugas' => $request->tt_tempat_bertugas,
                'tt_email' => $request->tt_email,
                'tt_notel' => $request->tt_notel,
                'updated_at' => $now,
                'updated_by' => $icNos,
            ]);
    
            if ($request->status == 'dikemaskini/diteliti' || $request->status == 'selesai') {
                $statusData = [
                    'status' => $request->status,
                    'kt_at' => null,
                    'kt_by' => null,
                    'selesai_at' => null,
                    'selesai_by' => null,
                ];
    
                if ($request->status == 'dikemaskini/diteliti') {
                    $statusData['kt_at'] = $now;
                    $statusData['kt_by'] = $icNos;
                } elseif ($request->status == 'selesai') {
                    $statusData['selesai_at'] = $now;
                    $statusData['selesai_by'] = $icNos;
                }
    
                $ssmtatatertib->update($statusData);
            }
    
                if ($request->filled('tt_catatan')) {
                    $max_tt_no_catatan = SSMTatatertibCatatan::where('tt_id', $ssmtatatertib->id)->max('tt_no_catatan');

                    foreach ($request->tt_catatan as $index => $catatan) {
                        if (isset($request->catatan_id[$index])) {
                            $existingCatatan = SSMTatatertibCatatan::findOrFail($request->catatan_id[$index]);

                            if ($existingCatatan->tt_catatan !== $catatan) {
                                $existingCatatan->update([
                                    'tt_catatan' => $catatan,
                                    'catatan_updated_at' => now(),
                                ]);
                            }
                        } else {
                            $new_tt_no_catatan = $max_tt_no_catatan !== null ? $max_tt_no_catatan + 1 : 1;

                            $newCatatan = new SSMTatatertibCatatan([
                                'tt_catatan' => $catatan,
                                'tt_id' => $ssmtatatertib->id, 
                                'tt_no_catatan' => $new_tt_no_catatan,
                                'catatan_created_at' => now(),
                            ]);

                            $newCatatan->save();

                            $max_tt_no_catatan = $new_tt_no_catatan;
                    }
                }
            }

            if ($request->has('remove_file')) {
            $this->removetatatertibFiles($ssmtatatertib, $request->input('remove_file'));
            }
    
            if ($request->hasFile('tt_file')) {
                $this->handletatatertibUploadedFiles($ssmtatatertib, $request->file('tt_file'), $request);
            }
    
            return redirect()->route('ssmtatatertib.ssmrequest.indextatatertib')
                ->with('success_message', 'Tatatertib record updated successfully.');
        } catch (Exception $exception) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }
    

    private function removetatatertibFiles($ssmtatatertib, $removeIndexes)
    {
        $existingFiles = $ssmtatatertib->tt_file;

        foreach ($removeIndexes as $index) {
            if (isset($existingFiles[$index])) {
                Storage::delete('public/ssmtatatertib/' . $existingFiles[$index]);

                unset($existingFiles[$index]);
            }
        }

        $existingFiles = array_values($existingFiles);

        $ssmtatatertib->tt_file = $existingFiles;

        $ssmtatatertib->save();
    }

    private function handletatatertibUploadedFiles($ssmtatatertib, $files, $request)
    {
        $existingFiles = $ssmtatatertib->tt_file ?: []; 
        foreach ($files as $file) {
            try {
                $filename = $file->getClientOriginalName();
                $path = $file->storeAs('public/ssmtatatertib', $filename);

                $existingFiles[] = $filename;
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }

        $ssmtatatertib->tt_file = $existingFiles;
        $ssmtatatertib->save();
    }

    public function updatestatusadmintatatertib(Request $request)
    {
        $icNos = Auth::user()->ic_no;
        $now = now(); 

        try {
            $ssmtatatertib = SSMTatatertib::findOrFail($request->id);

            $statusData = [
                'status' => $request->status,
                'selesai_at' => null,
                'selesai_by' => null,
                'ut_at' => null,
                'ut_by' => null,
                'kt_at' => null,
                'kt_by' => null,
            ];

            switch ($request->status) {
                case 'selesai':
                    $statusData['selesai_at'] = $now;
                    $statusData['selesai_by'] = $icNos;
                    break;
                case 'untuktindakan':
                    $statusData['ut_at'] = $now;
                    $statusData['ut_by'] = $icNos;
                    break;
                case 'dikemaskini/diteliti':
                    $statusData['kt_at'] = $now;
                    $statusData['kt_by'] = $icNos;
                    break;
                default:
                    break;
            }

            $ssmtatatertib->update($statusData);

            return redirect()->route('ssmtatatertib.ssmrequest.indextatatertib')
                ->with('success_message', 'Status Admin Updated!');
        } catch (Exception $exception) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

        // Catatan
        public function updateCatatan(Request $request)
        {
            $user = Auth::user()->name;
        
            $id = $request->input('id');
        
            $catatan = SSMTatatertibCatatan::find($id);
        
            if (!$catatan) {
                return redirect()->back()->with('error', 'Catatan not found');
            }
        
            $catatan->tt_catatan = $request->input('tt_catatan');
            $catatan->catatan_updated_at = now();
            
            if ($catatan->save()) {
                return redirect()->back()->with('success_message', 'Catatan updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to update Catatan');
            }
        }
               

        public function destroyCatatan(Request $request, $id)
        {
            try {
                $catatan = SSMTatatertibCatatan::findOrFail($id);
                $tt_id = $catatan->tt_id;
        
                $catatan->delete();
        
                $remainingCatatans = SSMTatatertibCatatan::where('tt_id', $tt_id)->get();
                foreach ($remainingCatatans as $index => $remainingCatatan) {
                    $remainingCatatan->update([
                        'tt_no_catatan' => $index + 1
                    ]);
                }
        
                return redirect()->back()->with('success_message', 'Catatan deleted successfully.');
            } catch (Exception $exception) {
                return back()->withInput()->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
            }
        }        
    
}
