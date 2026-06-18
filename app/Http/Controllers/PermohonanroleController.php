<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;


use App\Models\Department;
use App\Models\Peranan;
use App\Models\Permohonanrole;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;




use Log;
use Carbon\Carbon;

use Illuminate\Http\Request;

class PermohonanroleController extends Controller
{
    public function permohonanroleform()
{
    $departments = Department::pluck('label', 'id')->all();
    $peranan = Peranan::all();

    return view('permohonanrole', compact('departments','peranan'));
}

public function indexadmin()
{
    $departments = Department::pluck('id', 'label')->all();
    $permohonanroles = Permohonanrole::select('permohonanrole.*')->orderBy('created_at', 'DESC')->get();
    $permohonanperanan = Peranan::select('permohonanperanan.*')->orderBy('id', 'DESC')->get();
    $peranandropdown = Peranan::pluck('label', 'label')->all();



    return view('permohonanrole.indexadmin', compact('departments','permohonanroles','permohonanperanan','peranandropdown'));
}


public function store(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'jabatan' => 'required',
        'icno' => 'required',
        'peranan' => 'required'
      
]);
$now = Carbon::now();

    $permohonanrole = new Permohonanrole;

        $permohonanrole->nama = $request->nama;
        $permohonanrole->jabatan = $request->jabatan;
        $permohonanrole->icno = $request->icno;
        $permohonanrole->no_tel = $request->no_tel;
        $permohonanrole->peranan = $request->peranan;
        $permohonanrole->catatan = $request->catatan;
        $permohonanrole->created_at =$now ;
        $permohonanrole->save();

        return redirect()->route('permohonanrole')
            ->with('success_message', 'Borang permohonan telah berjaya dihantar');
}


public function storeperanan(Request $request){

    $permohonanperanan = new Peranan;

    $permohonanperanan-> label = $request->label;
    $permohonanperanan-> desc = $request->desc;


    $permohonanperanan->save();

    return redirect()->route('permohonanrole.permohonanrole.indexadmin')
            ->with('success_message', 'Peranan was succesfully updated!');

}

public function editadmin($id)
{
    
    $permohonanrole = Permohonanrole::all()
        ->where('id', '=', $id);  
        


    return view('permohonanrole.editadmin', compact('permohonanrole'));
}


public function updateadmin(Request $request)
{
   

    $now = Carbon::now();

    $icNos = Auth::user()->ic_no;

        $permohonanrole =  Permohonanrole::select('permohonanrole.*')
            ->where('id', $request->id)
            ->update([
                'status'         =>      $request->status,
                'admin_icno'=>$icNos,
                'updated_at' => $now

            ]);
    

    return redirect()->route('permohonanrole.permohonanrole.indexadmin')
        ->with('success_message', 'Data record was successfully updated!');
}


public function destroy($id)
{
    try {


      $permohonanrole = Permohonanrole::where('id', $id)->delete();

        return redirect()->route('permohonanrole.permohonanrole.indexadmin')
            ->with('success_message', 'Data was successfully deleted!');
    } catch (Exception $exception) {

        return back()->withInput()
            ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
    }
}



public function destroyperanan($id)
{
    try {


      $permohonanperanan = Peranan::where('id', $id)->delete();

        return redirect()->route('permohonanrole.permohonanrole.indexadmin')
            ->with('success_message', 'Data was successfully deleted!');
    } catch (Exception $exception) {

        return back()->withInput()
            ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
    }
}

public function approve($id)
{
   

    $now = Carbon::now();

    $icNos = Auth::user()->ic_no;

    $permohonan = Permohonanrole::findOrFail($id);
 
    $roleId = Role::where('name', $permohonan->peranan)
    ->value('id');

    $userId = User::where('ic_no', $permohonan->icno)
    ->value('id');

    $roleuser = RoleUser::create([
        'role_id' => $roleId ,
        'user_id' => $userId,
        'created_at' => $now,
        'updated_at' => $now

    ]);

    $permohonanrole = Permohonanrole::findOrFail($id);
    $permohonanrole->update([
        'status' => 'approve',
        'admin_icno' => $icNos,
        'updated_at' => now()
    ]);
    

    return redirect()->route('permohonanrole.permohonanrole.indexadmin')
        ->with('success_message', 'Data record was successfully updated!');
}

public function reject( $id)
{
   

    $now = Carbon::now();

    $icNos = Auth::user()->ic_no;

    $permohonanrole = Permohonanrole::findOrFail($id);
    $permohonanrole->update([
        'status' => 'reject',
        'admin_icno' => $icNos,
        'updated_at' => now()
    ]);
    

    return redirect()->route('permohonanrole.permohonanrole.indexadmin')
        ->with('success_message', 'Data record was successfully updated!');
}




}
