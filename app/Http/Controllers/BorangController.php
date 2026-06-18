<?php

namespace App\Http\Controllers;

use Session;

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
use App\Models\Borang;


use Log;
use Carbon\Carbon;

class BorangController extends Controller
{


/**
 * Display a listing of the Biodata applications.
 *
 * @return Illuminate\View\View
 */


public function index()
{             
    $departments = Department::pluck('id', 'label')->all();

    return view('borangs.index', compact('departments'));
}


public function indexadmin()
{
    $departments = Department::pluck('id', 'label')->all();
    $borangs = Borang::select('borang.*')->orderBy('created_at', 'DESC')->get();

    return view('borangs.indexadmin', compact('departments','borangs'));
}

public function isiborang()
{
    $departments = Department::pluck('label', 'id')->all();

    return view('borang', compact('departments'));
}


public function store(Request $request)
{
    $request->validate([
        'jabatan' => 'required',
        'perkhidmatan' => 'required',
        'huraian' => 'required',
        'nama' => 'required',
        'email' => 'required'
]);
 
    if ($request->file_image !=''){

    $borang = new Borang;

        $borang->jabatan = $request->jabatan;
        $borang->bahagian = $request->bahagian;
        $borang->perkhidmatan = $request->perkhidmatan;
        $borang->huraian = $request->huraian;
        $borang->nama = $request->nama;
        $borang->email = $request->email;
        $borang->telefon = $request->telefon;
        $borang->file_name = $request->file_image->getClientOriginalName();
        $borang-> file_image = $request->file('file_image')->store('borang', 'public');

        $borang->save();

    }

    if ($request->file_image ==''){

    $borang = new Borang;

        $borang->jabatan = $request->jabatan;
        $borang->bahagian = $request->bahagian;
        $borang->perkhidmatan = $request->perkhidmatan;
        $borang->huraian = $request->huraian;
        $borang->nama = $request->nama;
        $borang->email = $request->email;
        $borang->telefon = $request->telefon;

        $borang->save();
    }

        return redirect()->route('isiborang')
            ->with('success_message', 'Borang telah berjaya dihantar');
}

public function showadmin(Request $request, $id)
    {
        $borangs = Borang::select('borang.*')
            ->where('id', $id)
            ->first();

        $departments = Department::pluck('id', 'label')->all();

        return view('borangs.showadmin', compact('departments','borangs'));
    }

}
