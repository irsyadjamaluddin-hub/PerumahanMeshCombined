<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;

use App\Models\Biodata;
use App\Models\Employment;
use App\Models\User;
use App\Models\Feedback;
// use App\Models\PeruntukanBersara;
use App\Models\Terminationtype;
use App\Models\Retirementposition;

// use App\Models\Employment;
use App\Models\Department;
use App\Models\School;
use App\Models\Gender;
use App\Models\SKPerkara;
// use App\Models\Borang;
use App\Models\SlipKedatangan;
use App\Models\SlipKedatanganRaya2025;

class SKRaya2025Controller extends Controller
{
    public function isiborang()
    {
        // Fetch departments
        $departments = Department::pluck('label', 'id')->all();

        // Fetch Genders
        $genders = Gender::pluck('label','id')->all();

        // Find the index of ID 7
        $index = array_search(7, array_keys($departments));

        if ($index !== false) {
            // Insert the new item before ID 7
            $newDepartments = array_slice($departments, 0, $index, true) +
                            [199 => 'Pejabat Timbalan Setiausaha Tetap (Dasar dan Korporat)'] +
                            array_slice($departments, $index, null, true);
            
            $departments = $newDepartments;
        }

        $schools = School::pluck('label', 'id')->all();

        $jabatan = collect($departments)
                ->merge($schools)
                ->map(function($label, $id) {
                    return ['id' => $id, 'label' => $label];
                })
                ->unique(function($item) {
                    return strtolower($item['label']);
                })
                // ->sortBy('label')
                ->values();

        $perkara = SKPerkara::pluck('label','id')->all();

        return view('slipkedatangan-raya2025', compact('departments','jabatan','perkara', 'genders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jabatan' => 'required',
            'nama' => 'required',
            'nomborIc' => 'required',
            'jawatan' => 'required',
            'gender' => 'required'
            // 'rolelabel' => 'required',
            // 'jawatan' => 'required',
            // 'email' => 'required',
            // 'remark' => 'required',
        ]);
        
        $borang = new SlipKedatanganRaya2025;

        $borang->jabatan = $request->jabatan;
        $borang->nama = $request->nama;
        $borang->jawatan = $request->jawatan;
        $borang->gender = $request->gender;
        $borang->nomborIc = $request->nomborIc;
        $borang->telefon = $request->telefon;
        $borang->remark = $request->remark;
        
        $borang->save();

        return redirect()->route('slipkehadiran.raya2025')
            ->with('success_message', 'Borang telah berjaya dihantar');
    }
}
