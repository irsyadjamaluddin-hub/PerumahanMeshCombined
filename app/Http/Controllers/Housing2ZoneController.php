<?php

namespace App\Http\Controllers;

use App\Models\Housing2Staff;
use App\Models\Housing2Zone;
use App\Models\Housing2ZoneMukim;
use Illuminate\Http\Request;

class Housing2ZoneController extends Controller
{
    /** Zone overview: each zone with its mukim/staff assignments (matches the source flowchart layout). */
    public function index()
    {
        $zones = Housing2Zone::with(['ketuaStaff', 'mukims.rsStaff', 'mukims.iqStaff'])
            ->orderBy('nama')
            ->get();

        return view('housing2.zon.index', compact('zones'));
    }

    public function mukimCreate()
    {
        return view('housing2.zon.mukim-form', [
            'zoneMukim' => new Housing2ZoneMukim(),
            'zones' => Housing2Zone::orderBy('nama')->get(),
            'staff' => Housing2Staff::orderBy('kod')->get(),
        ]);
    }

    public function mukimStore(Request $request)
    {
        Housing2ZoneMukim::create($this->mukimPayload($request));

        return redirect()->route('housing2.zon.index')->with('berjaya', 'Rekod Berjaya Disimpan');
    }

    public function mukimEdit(Housing2ZoneMukim $mukim)
    {
        return view('housing2.zon.mukim-form', [
            'zoneMukim' => $mukim,
            'zones' => Housing2Zone::orderBy('nama')->get(),
            'staff' => Housing2Staff::orderBy('kod')->get(),
        ]);
    }

    public function mukimUpdate(Request $request, Housing2ZoneMukim $mukim)
    {
        $mukim->update($this->mukimPayload($request));

        return redirect()->route('housing2.zon.index')->with('berjaya', 'Rekod Berjaya Disimpan');
    }

    public function mukimDestroy(Housing2ZoneMukim $mukim)
    {
        $mukim->delete();

        return redirect()->route('housing2.zon.index')->with('berjaya', 'Rekod telah dihapuskan');
    }

    protected function mukimPayload(Request $request): array
    {
        return $request->validate([
            'zone_id' => ['required', 'exists:housing2_zones,id'],
            'daerah' => ['required', 'string', 'max:80'],
            'mukim' => ['required', 'string', 'max:120'],
            'rs_staff_id' => ['nullable', 'exists:housing2_staff,id'],
            'iq_staff_id' => ['nullable', 'exists:housing2_staff,id'],
        ]);
    }

    /** Senarai Kakitangan: staff list. */
    public function staffIndex(Request $request)
    {
        $staff = Housing2Staff::when($request->filled('q'), fn ($query) => $query
                ->where('nama', 'like', '%'.$request->query('q').'%')
                ->orWhere('kod', 'like', '%'.$request->query('q').'%'))
            ->orderBy('kod')
            ->paginate(20)
            ->withQueryString();

        return view('housing2.staff.index', ['staff' => $staff, 'q' => $request->query('q', '')]);
    }

    public function staffCreate()
    {
        return view('housing2.staff.form', ['staffMember' => new Housing2Staff()]);
    }

    public function staffStore(Request $request)
    {
        Housing2Staff::create($this->staffPayload($request));

        return redirect()->route('housing2.staff.index')->with('berjaya', 'Rekod Berjaya Disimpan');
    }

    public function staffEdit(Housing2Staff $staffMember)
    {
        return view('housing2.staff.form', compact('staffMember'));
    }

    public function staffUpdate(Request $request, Housing2Staff $staffMember)
    {
        $staffMember->update($this->staffPayload($request, $staffMember));

        return redirect()->route('housing2.staff.index')->with('berjaya', 'Rekod Berjaya Disimpan');
    }

    public function staffDestroy(Housing2Staff $staffMember)
    {
        try {
            $staffMember->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with('ralat', 'Kakitangan ini masih ditugaskan kepada satu atau lebih zon/mukim. Sila kemaskini tugasan tersebut dahulu.');
        }

        return redirect()->route('housing2.staff.index')->with('berjaya', 'Rekod telah dihapuskan');
    }

    protected function staffPayload(Request $request, ?Housing2Staff $staffMember = null): array
    {
        return $request->validate([
            'kod' => ['required', 'string', 'max:20', 'unique:housing2_staff,kod'.($staffMember ? ','.$staffMember->id : '')],
            'nama' => ['required', 'string', 'max:150'],
            'no_kpp' => ['nullable', 'string', 'max:20'],
            'tugas' => ['nullable', 'string', 'max:500'],
        ]);
    }
}
