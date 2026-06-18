<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;   // <-- if you use Storage::
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;

use App\Models\Eminit;
use App\Models\Employment;
use App\Models\Department;

use App\Models\EminitJenis;
use App\Models\Eminit_Untukperhatian;
use App\Models\Kepada;
use App\Models\Eminit_Tindakandiperlukan;
use App\Models\Tindakanlist;
use App\Models\EminitAdmin;
use App\Models\EminitAction;
use App\Models\Dispatch;
use Carbon\Carbon;

use App\Mail\EmailEmemoAdmin;
use App\Models\EminitAdminPushNotif;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailEmemoTindakan;
use App\Mail\EmailEmemoTindakanRepeat;






class EminitController extends Controller
{
    
     public function indexeminit()
    {

        // $eminits = Eminit::orderBy('id', 'desc')->get();

        $eminits = Eminit::with('latestAdminEntry')
        ->orderByDesc('id')
        ->get();

        $allIds = $eminits->flatMap(fn ($e) => (array) ($e->kpd ?? []))
            ->filter()->unique()->values();

        // fetch id => label once
        $labelsById = Kepada::whereIn('id', $allIds)
                ->pluck('label', 'id')   // change 'label' if your column name differs (e.g., 'nama')
                ->toArray();
    
        $jenisMap  = EminitJenis::pluck('label', 'id')->toArray(); // id => label

        $eminitAdminIds = \App\Models\EminitAdmin::distinct()->pluck('eminit_id')->toArray();

        $eminitAdminDates = EminitAdmin::pluck('updated_at');

        $eminitdate = EminitAdmin::pluck('created_at')->toArray();

        return view('eminit.indexeminit', compact('eminits', 'labelsById', 'allIds', 'jenisMap', 'eminitAdminIds', 'eminitAdminDates', 'eminitdate'));
    }

        public function destroy($id)
    {
        try {
            $eminits = Eminit::where('id', $id)->delete();

            return redirect()->route('eminit.eminit.indexeminit')
                ->with('success_message', 'Data was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function createeminit()
    {
        $icNos = Auth::user()->ic_no;

        $jenis = EminitJenis::pluck('label', 'id')->toArray();
   
        $employments = Employment::all()
                        ->where('ic_no', '=', $icNos);

        $kepada = Kepada::pluck('label', 'id')->toArray();
        $departments = Department::all(); // 

        $Eminit_Untukperhatian = Eminit_Untukperhatian::pluck('kod', 'id')->toArray();

        return view('eminit.createeminit', compact('employments', 'jenis', 'icNos', 'kepada', 'Eminit_Untukperhatian', 'departments'));
    }

    public function storeeminit(Request $request)
{
    $now = \Carbon\Carbon::now();

    // 1) Allow empty rows for eminit_file[] / salinan_dokumen[] (nullable),
    //    then we’ll enforce “at least one real file” manually.
    $validated = $request->validate([
        'jenis'             => 'required|integer|exists:eminit_jenis,id',
        'daripada'          => 'required|integer',
        'memo_daripada'     => 'required|integer', 
        'kpd'               => 'required|array|min:1',
        'kpd.*'             => 'integer',
        'untukperhatian'    => 'nullable|string',
        'perkara'           => 'required|string|max:500',
        'rujukan_tp'        => 'nullable|string|max:255',

        'eminit_file'       => 'required|array',            // array is required
        'eminit_file.*'     => 'nullable|file|max:10240',   // individual rows may be empty

        'catatan'           => 'required|string',
        'salinan_kepada'    => 'nullable|array',
        'salinan_kepada.*'  => 'nullable|integer',
        'salinan'           => 'nullable|string|max:500',

        'salinan_dokumen'   => 'nullable|array',
        'salinan_dokumen.*' => 'nullable|file|max:10240',

        'no_rujukan'        => 'required|string|max:255',
        'ic_no'             => 'required|string|max:25',
    
    ],[
    'jenis.required' => 'Sila pilih jenis.',
    'kpd.required'  => 'Sila pilih sekurang-kurangnya satu Kepada.',
    'kpd.min'       => 'Sila pilih sekurang-kurangnya satu Kepada.',
    'perkara.required' => 'Perkara wajib diisi.',
    
    ]);

    // 2) Filter out empty file inputs (rows the user didn’t pick a file for)
    $eminitFiles = array_values(array_filter(
        $request->file('eminit_file', []),
        fn ($f) => $f instanceof \Illuminate\Http\UploadedFile
    ));
    if (count($eminitFiles) === 0) {
    return back()->withErrors(['eminit_file' => 'Sila muat naik sekurang-kurangnya satu dokumen e-Minit.'])->withInput();
}
    $salinanFiles = array_values(array_filter(
        $request->file('salinan_dokumen', []),
        fn ($f) => $f instanceof \Illuminate\Http\UploadedFile
    ));

    // 3) Enforce: at least ONE real e-Minit file must be uploaded
    if (count($eminitFiles) === 0) {
        return back()
            ->withErrors(['eminit_file' => 'Sila muat naik sekurang-kurangnya satu dokumen e-Minit.'])
            ->withInput();
    }

    // 4) Proceed with storage
    $eminitStoredFiles  = [];
    $salinanStoredFiles = [];

    \DB::beginTransaction();
    try {
        // Save e-Minit files
        foreach ($eminitFiles as $file) {
            $name = \Illuminate\Support\Str::uuid()->toString() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('eminit', $name, 'public');
            $eminitStoredFiles[] = [
                'original' => $file->getClientOriginalName(),
                'stored'   => $name,
                'path'     => $path,
                'url'      => \Storage::disk('public')->url($path),
            ];
        }

        // Save Salinan Dokumen files (optional)
        foreach ($salinanFiles as $file) {
            $name = \Illuminate\Support\Str::uuid()->toString() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('eminit_salinan', $name, 'public');
            $salinanStoredFiles[] = [
                'original' => $file->getClientOriginalName(),
                'stored'   => $name,
                'path'     => $path,
                'url'      => \Storage::disk('public')->url($path),
            ];
        }

        $jenis    = (int) $validated['jenis'];
        $daripada = (int) $validated['daripada'];

        $eminit = \App\Models\Eminit::create([
            'jenis'           => $jenis,
            'daripada'        => $daripada,
            'memo_daripada'   => $validated['memo_daripada'],
            'kpd'             => array_values($validated['kpd']),
            'untukperhatian'  => $validated['untukperhatian'] ?? null,
            'perkara'         => $validated['perkara'],
            'rujukan_tp'      => $validated['rujukan_tp'] ?? null,

            // arrays from our loops
            'eminit_file'     => $eminitStoredFiles,
            'salinan_dokumen' => $salinanStoredFiles,

            'catatan'         => $validated['catatan'],
            'salinan_kepada'  => $validated['salinan_kepada'] ?? [],
            'salinan'         => $validated['salinan'] ?? null,

            'no_rujukan'      => $validated['no_rujukan'],
            'ic_no'           => $validated['ic_no'],
            'created_at'      => $now,
            'updated_at'      => $now,
        ]);

        // for email push to admin

           /**
         * 2️⃣ DATA EMAIL ASAS (DARIPADA EMINIT)
         */
        $jenisMap = \App\Models\EminitJenis::pluck('label','id')->toArray();
        $notf_Jenis = $jenisMap[(int)($eminit->jenis ?? 0)] ?? '-';

        $notf_MemoDaripada = $eminit->memoDepartment->label ?? '-';

        $notf_Perkara = $eminit->perkara;

        $notf_Tarikh = Carbon::parse($eminit->created_at)->format('d/m/Y');

        $notf_Icno = optional(
            User::where('ic_no', $eminit->ic_no)->first()
        )->name ?? $eminit->ic_no;

        /**
         * 3️⃣ PADANKAN KPD DENGAN eminit_adminpushnotif
         */
        $kpdDepartments = is_array($eminit->kpd)
            ? $eminit->kpd
            : json_decode($eminit->kpd, true);

        $admins = EminitAdminPushNotif::whereIn('department_id', $kpdDepartments)
            ->whereNotNull('email')
            ->get();

        /**
         * 4️⃣ HANTAR EMAIL KEPADA ADMIN YANG PADAN
         */
        foreach ($admins as $admin) {

            // Nama Admin: padan ic_no → users
            $notf_Nama = optional(
                User::where('ic_no', $admin->ic_no)->first()
            )->name ?? $admin->ic_no;

            // Jabatan: terus dari eminit_adminpushnotif
            $notf_jabatan = optional(
                Department::find($admin->department_id)
            )->label ?? $admin->department_id;

            Mail::to($admin->email)->send(
                new EmailEmemoAdmin(
                    $notf_Nama,
                    $notf_jabatan,
                    $notf_Jenis,
                    $notf_MemoDaripada,
                    $notf_Perkara,
                    $notf_Tarikh,
                    $notf_Icno
                )
            );
        }

      
        \DB::commit();

        return redirect()
            ->route('eminit.eminit.indexeminit')
            ->with('success_message', 'Rekod e-Minit berjaya dihantar.');
    } catch (\Throwable $e) {
        \DB::rollBack();
        \Log::error('Eminit store failed: '.$e->getMessage(), ['trace' => $e->getTraceAsString()]);
        return back()->withErrors(['submit' => $e->getMessage()])->withInput();
    }
}


    public function editeminit($id)
    {

        $eminits = Eminit::all()
            ->where('id', '=', $id);

        $jenis = EminitJenis::pluck('label', 'id')->toArray();
        $kepada = Kepada::pluck('label', 'id')->toArray();
        $departments = Department::all();
        $Eminit_Untukperhatian = Eminit_Untukperhatian::pluck('kod', 'id')->toArray();
        $icNos = Auth::user()->ic_no;
        $employments = Employment::all()
            ->where('ic_no', '=', $icNos);
        $eminitAdminDates = EminitAdmin::pluck('updated_at');
        $eminitadmin = EminitAdmin::pluck('jenis_tindakan')->toArray();
        return view('eminit.editeminit', compact('eminits', 'jenis', 'departments', 'kepada', 'Eminit_Untukperhatian', 'icNos', 'employments', 'eminitAdminDates', 'eminitadmin'));
    }

    public function updateeminit(Request $request, \App\Models\Eminit $eminit)
{
    $validated = $request->validate([
        'jenis'             => 'required|integer|exists:jenis,id',
        'daripada'          => 'required|integer',
        'memo_daripada'     => 'required|integer',
        'kpd'               => 'required|array|min:1',
        'kpd.*'             => 'integer',
        'untukperhatian'    => 'nullable|string',
        'perkara'           => 'required|string|max:500',
        'rujukan_tp'        => 'nullable|string|max:255',

        // allow empty rows in the one-by-one UI
        'eminit_file'       => 'nullable|array',
        'eminit_file.*'     => 'nullable|file|max:10240',

        'delete_existing'   => 'nullable|array',
        'delete_existing.*' => 'string',

        'catatan'           => 'nullable|string',
        'salinan_kepada'    => 'nullable|array',
        'salinan_kepada.*'  => 'integer',
        'salinan'           => 'nullable|string|max:500',

        'salinan_dokumen'   => 'nullable|array',
        'salinan_dokumen.*' => 'nullable|file|max:10240',

        'no_rujukan'        => 'nullable|string|max:255',
        'ic_no'             => 'required|string|max:25',
    ]);

    // --- 1) EXISTING e-Minit files: delete what was ticked ---
    $existing = (array) ($eminit->eminit_file ?? []);
    $toDelete = (array) $request->input('delete_existing', []);

    // index existing by a stable key (prefer 'stored', fallback to basename(path))
    $indexByKey = [];
    foreach ($existing as $f) {
        $key = $f['stored'] ?? (isset($f['path']) ? basename($f['path']) : null);
        if ($key) $indexByKey[$key] = $f;
    }

    // keep those NOT marked for deletion
    $kept = array_values(array_filter($existing, function ($f) use ($toDelete) {
        $key = $f['stored'] ?? (isset($f['path']) ? basename($f['path']) : null);
        return !$key || !in_array($key, $toDelete, true);
    }));

    // (optional) delete removed files from disk
    foreach ($toDelete as $key) {
        if (isset($indexByKey[$key])) {
            $path = $indexByKey[$key]['path'] ?? null;
            if ($path && \Storage::disk('public')->exists($path)) {
                \Storage::disk('public')->delete($path);
            }
        }
    }

    // --- 2) NEW e-Minit files: ignore empty rows, store the rest ---
    $newFiles = array_values(array_filter(
        $request->file('eminit_file', []),
        fn ($f) => $f instanceof \Illuminate\Http\UploadedFile
    ));

    $newStored = [];
    foreach ($newFiles as $file) {
        $name = \Illuminate\Support\Str::uuid()->toString() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('eminit', $name, 'public');
        $newStored[] = [
            'original' => $file->getClientOriginalName(),
            'stored'   => $name,
            'path'     => $path,
            'url'      => \Storage::disk('public')->url($path),
        ];
    }

    // --- 3) MERGE and ENFORCE ≥ 1 total e-Minit doc ---
    $mergedEminitFiles = array_values(array_merge($kept, $newStored));
    if (count($mergedEminitFiles) === 0) {
        return back()
            ->withErrors(['eminit_file' => 'Sekurang-kurangnya satu dokumen e-Minit diperlukan (kekalkan sedia ada atau tambah baharu).'])
            ->withInput();
    }

    // --- 4) Salinan dokumen: append (no minimum requirement) ---
    $newSalinan = array_values(array_filter(
        $request->file('salinan_dokumen', []),
        fn ($f) => $f instanceof \Illuminate\Http\UploadedFile
    ));
    $newSalinanFiles = [];
    foreach ($newSalinan as $file) {
        $name = \Illuminate\Support\Str::uuid()->toString() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('eminit_salinan', $name, 'public');
        $newSalinanFiles[] = [
            'original' => $file->getClientOriginalName(),
            'stored'   => $name,
            'path'     => $path,
            'url'      => \Storage::disk('public')->url($path),
        ];
    }
    $mergedSalinan = array_values(array_merge((array) ($eminit->salinan_dokumen ?? []), $newSalinanFiles));

    // --- 5) Update record ---
    $eminit->update([
        'jenis'           => $validated['jenis'],
        'daripada'        => $validated['daripada'],
        'memo_daripada'   => $validated['memo_daripada'],
        'kpd'             => array_values($validated['kpd']),
        'untukperhatian'  => $validated['untukperhatian'] ?? null,
        'perkara'         => $validated['perkara'],
        'rujukan_tp'      => $validated['rujukan_tp'] ?? null,
        'catatan'         => $validated['catatan'] ?? null,
        'salinan_kepada'  => $validated['salinan_kepada'] ?? [],
        'salinan'         => $validated['salinan'] ?? null,
        'no_rujukan'      => $validated['no_rujukan'] ?? null,
        'ic_no'           => $validated['ic_no'],

        'eminit_file'     => $mergedEminitFiles,   // <- kept + new, ensured ≥ 1
        'salinan_dokumen' => $mergedSalinan,
    ]);

    return redirect()
        ->route('eminit.eminit.indexeminit')
        ->with('success_message', 'e-Minit berjaya dikemaskini.');
}



    public function indexeminitadmin()
    {
        $eminits = Eminit::with(['latestAdminEntry.latestActionEntry'])
        ->orderByDesc('id')
        ->get();// Sort by created_at in descending order

        $admins = EminitAdmin::with('latestAdminEntry')
        ->orderByDesc('id')
        ->get();

            // Fetch all eminit_actions grouped by eminit_admin_id
            $actionsByAdmin = \DB::table('eminit_action')
                ->select('eminit_admin_id', 'jenis_tindakan')
                ->get()
                ->groupBy('eminit_admin_id');

            // Map latest status for each eminit
            $latestStatuses = $admins->mapWithKeys(function($admin) use ($actionsByAdmin) {
                // 1. Already selesai?
                if($admin->status === 'selesai') {
                    return [$admin->eminit_id => 'selesai'];
                }

                // 2. Check actions for this admin
                $actions = $actionsByAdmin[$admin->id] ?? collect();

                $inProgress = $actions->contains(function($a) {
                    $jenis = json_decode($a->jenis_tindakan, true);
                    return !empty($jenis);
                });

                if($inProgress) {
                    return [$admin->eminit_id => 'in-progress'];
                }

                // 3. Else, belum diterima
                return [$admin->eminit_id => 'belum diterima'];
            });


        $catatan = EminitAdmin::with('eminit')
        ->orderByDesc('id')
        ->get();

        $adminnotes = DB::table('eminit_action as a')
    ->join(DB::raw('(SELECT eminit_admin_id, MAX(id) AS max_id
                     FROM eminit_action
                     GROUP BY eminit_admin_id) AS last'),
           function ($j) { $j->on('last.max_id', '=', 'a.id'); })
    ->pluck('a.catatan', 'a.eminit_admin_id');

        $admindates = EminitAdmin::orderByDesc('created_at')
        ->pluck('created_at', 'eminit_id');


        $allIds = $eminits->flatMap(fn ($e) => (array) ($e->kpd ?? []))
        ->filter()->unique()->values();
        $catatan = EminitAdmin::with('latestAdminEntry')
        ->orderByDesc('id')
        ->value('catatan');
        $labelsById = Kepada::whereIn('id', $allIds)
                ->pluck('label', 'id')   // change 'label' if your column name differs (e.g., 'nama')
                ->toArray();
        $jenisMap  = EminitJenis::pluck('label', 'id')->toArray(); // id => label
        $eminitdate = EminitAdmin::pluck('created_at')->toArray();

    // 🔹 Get current user's department ID via Employment
    $icNo = Auth::user()->ic_no;
    $departmentId = Employment::where('ic_no', $icNo)->value('department_id');

    // 🔹 Filter only those eminits where user's department appears in 'kpd'
    $eminits = $eminits->filter(function ($eminit) use ($departmentId) {
        $kpdList = is_string($eminit->kpd)
            ? json_decode($eminit->kpd, true)
            : (array) $eminit->kpd;

        return in_array($departmentId, $kpdList);
    })->values();


        return view('eminit.indexeminitadmin', compact('eminits', 'catatan', 'labelsById', 'allIds', 'jenisMap',  'eminitdate',  'admindates','catatan','admins', 'adminnotes','latestStatuses'));
    }
    public function editeminitadmin(Eminit $eminit)
    {
        $icNos = Auth::user()->ic_no;
        $eminits = Eminit::where('id',$eminit->id)
        ->orderByDesc('id')
        ->get();
        $departmentId = Employment::where('ic_no', $icNos)->value('department_id');
        $jenis = EminitJenis::pluck('label', 'id')->toArray();
        $kepada = Kepada::pluck('label', 'id')->toArray();
        $Eminit_Untukperhatian = Eminit_Untukperhatian::where('jabatan', $departmentId)->pluck('kod', 'id')->toArray();
        
        $employments = Employment::all()
            ->where('ic_no', '=', $icNos);

        $tindakan = Tindakanlist::pluck('label', 'id')->toArray();
        $eminit_Tindakandiperlukan = Eminit_Tindakandiperlukan::where('department_id', $departmentId)->pluck('kod', 'id')->toArray();

        $prefill = EminitAdmin::where('eminit_id', $eminit->id)
        ->latest('id')
        ->first();

        $departments = Department::all();

        return view('eminit.editeminitadmin', compact('eminit','eminits', 'jenis', 'kepada', 'Eminit_Untukperhatian', 'icNos', 'employments', 'tindakan', 'eminit_Tindakandiperlukan','prefill','departmentId', 'departments'));
    }

public function storeeminitadmin(Request $request, Eminit $eminit)
{
    $data = $request->validate([
        'no_rujukan'          => 'nullable|string|max:255',
        'catatan'             => 'nullable|string',
        'tindakan_diperlukan' => 'nullable',
        'jenis_tindakan'      => 'nullable',
        'admin_id'            => 'integer',
    ]);

    $payload = [
        'no_rujukan'          => $data['no_rujukan'] ?? null,
        'catatan'             => $data['catatan'] ?? null,
        'tindakan_diperlukan' => $this->normalizeMulti($data['tindakan_diperlukan'] ?? null),
        'jenis_tindakan'      => $this->normalizeMulti($data['jenis_tindakan'] ?? null),
    ];

    if (!empty($data['admin_id'])) {
        $eminit->adminEntries()->whereKey($data['admin_id'])->update($payload);
    } else {
        $eminit->adminEntries()->create($payload + ['eminit_id' => $eminit->id]);
    }

    return redirect()->route('eminit.eminit.indexeminitadmin')
        ->with('success_message', 'Maklumat tindakan berjaya dikemas kini.');
}

public function updateeminitadmin(Request $request, Eminit $eminit)
{
    $now = Carbon::now();

    // 1️⃣ Validate request
    $data = $request->validate([
        'eminit_admin_id'      => 'nullable|integer|exists:eminit_admin,id',
        'no_rujukan'           => 'nullable|string|max:255',
        'catatan'              => 'nullable|string',
        'tindakan_diperlukan'  => 'nullable|array',
        'tindakan_diperlukan.*'=> 'integer',
        'jenis_tindakan'       => 'nullable|array',
        'jenis_tindakan.*'     => 'integer',
    ]);

    $data['created_by'] = auth()->user()->ic_no;

    // 2️⃣ Check if updating existing admin or creating new
    if (!empty($data['eminit_admin_id'])) {
        // Update existing row
        $adminEntry = EminitAdmin::where('id', $data['eminit_admin_id'])
            ->where('eminit_id', $eminit->id)
            ->firstOrFail();

        $adminEntry->update([
            'no_rujukan'          => $data['no_rujukan'] ?? null,
            'catatan'             => $data['catatan'] ?? null,
            'tindakan_diperlukan' => $data['tindakan_diperlukan'] ?? [],
            'jenis_tindakan'      => $data['jenis_tindakan'] ?? [],
            'created_by'          => $data['created_by'],
            'updated_at'          => $now,
        ]);
    } else {
        // Create new row
        $adminEntry = $eminit->adminEntries()->create([
            'no_rujukan'          => $data['no_rujukan'] ?? null,
            'catatan'             => $data['catatan'] ?? null,
            'tindakan_diperlukan' => $data['tindakan_diperlukan'] ?? [],
            'jenis_tindakan'      => $data['jenis_tindakan'] ?? [],
            'created_by'          => $data['created_by'],
            'created_at'          => $now,
            'updated_at'          => $now,
        ]);
    }

    // 3️⃣ Smart sync eminit_action
    $newTindakan = $data['tindakan_diperlukan'] ?? [];

    // Existing tindakan in DB
    $existingTindakan = EminitAction::where('eminit_admin_id', $adminEntry->id)
        ->pluck('tindakanby_diperlukan')
        ->toArray();

    // Add ONLY new tindakan
    $toInsert = array_diff($newTindakan, $existingTindakan);
    foreach ($toInsert as $tindakanId) {
        EminitAction::create([
            'eminit_admin_id'       => $adminEntry->id,
            'tindakanby_diperlukan' => $tindakanId,
            'created_at'            => $now,
        ]);
    }

    /**
 * 📧 EMAIL PUSH – UNTUK TINDAKAN
 */
if (!empty($toInsert)) {

    // 🔹 Get eminit once (linked via eminit_id)
    $eminitData = $eminit; // already injected in controller

    // 🔹 Jenis mapping
    $jenisMap = EminitJenis::pluck('label', 'id')->toArray();
    $notf_Jenis = $jenisMap[(int)($eminitData->jenis ?? 0)] ?? '-';

    // 🔹 Memo Daripada
    $notf_MemoDaripada = optional($eminitData->memoDepartment)->label ?? '-';

    // 🔹 Perkara
    $notf_Perkara = $eminitData->perkara;

    // 🔹 Tarikh Admin Terima
    $notf_TarikhAdmin = Carbon::parse($adminEntry->created_at)->format('d/m/Y');

    // 🔹 Status Tindakan (array → label)
    $jenisTindakanMap = [
        1 => 'Makluman',
        2 => 'Perhatian',
        3 => 'Untuk Tindakan',
    ];

    $jenisTindakanArr = is_array($adminEntry->jenis_tindakan)
        ? $adminEntry->jenis_tindakan
        : json_decode($adminEntry->jenis_tindakan, true);

    $notf_StatusTindakan = collect($jenisTindakanArr)
        ->map(fn ($id) => $jenisTindakanMap[$id] ?? 'Untuk Tindakan')
        ->implode(', ');

    // 🔹 Get tindakan recipients
    $recipients = Eminit_Tindakandiperlukan::whereIn('id', $toInsert)->get();

    foreach ($recipients as $recipient) {

        // Nama penerima
        $notf_Nama = optional(
            User::where('ic_no', $recipient->ic_no)->first()
        )->name ?? $recipient->ic_no;

        // Jabatan penerima
        $notf_jabatan = optional(
            Department::find($recipient->department_id)
        )->label ?? '-';

        // Send Email
        if (!empty($recipient->email)) {
            Mail::to($recipient->email)->send(
                new \App\Mail\EmailEmemoTindakan(
                    $notf_Nama,
                    $notf_jabatan,
                    $notf_Jenis,
                    $notf_MemoDaripada,
                    $notf_Perkara,
                    $notf_TarikhAdmin,
                    $notf_StatusTindakan
                )
            );
        }
    }
}

    // Optional: remove tindakan that were removed in the form
    $toDelete = array_diff($existingTindakan, $newTindakan);
    if (!empty($toDelete)) {
        EminitAction::where('eminit_admin_id', $adminEntry->id)
            ->whereIn('tindakanby_diperlukan', $toDelete)
            ->delete();
    }

    return redirect()
        ->route('eminit.eminit.indexeminitadmin')
        ->with('success_message', 'Tindakan berjaya dikemaskini.');
}



    public function vieweminitadmin(Eminit $eminit)
    {
        $icNos = Auth::user()->ic_no;
        $jenis = EminitJenis::pluck('label', 'id')->toArray();
        $kepada = Kepada::pluck('label', 'id')->toArray();
        $Eminit_Untukperhatian = Eminit_Untukperhatian::pluck('kod', 'id')->toArray();
        $employments = Employment::all()
        ->where('ic_no', '=', $icNos);
        $tindakan = Tindakanlist::pluck('label', 'id')
        ->mapWithKeys(fn($label, $id) => [(string)$id => $label]) // make keys strings to match JSON-cast
        ->all();
        $eminit_TindakandiperlukanMap = Eminit_Tindakandiperlukan::pluck('kod', 'id')   // [id => kod]
        ->mapWithKeys(fn($kod, $id) => [(string)$id => $kod]) // make keys strings to match JSON-cast
        ->all();
        $jenisTindakanMap = Tindakanlist::pluck('label', 'id')   // [id => label]
        ->mapWithKeys(fn($label, $id) => [(string)$id => $label]) // make keys strings to match JSON-cast
        ->all();
        $eminitdate = EminitAdmin::value('created_at','id');
        $tindakandiperlukan = EminitAdmin::pluck('tindakan_diperlukan', 'id')->toArray();
        $jenisTindakan = EminitAdmin::pluck('jenis_tindakan');
        $eminitrujukan = EminitAdmin::pluck('no_rujukan')->toArray();
        $eminitcatatan = EminitAdmin::pluck('catatan')->toArray();
        $admins = EminitAdmin::
        where('eminit_id',$eminit->id)
        ->orderByDesc('id')
        ->get();

    // ====================================================
    // to display the eminit_action info
   // Step 0: Create maps
        $usersMapById = DB::table('eminit_tindakandiperlukan')
            ->pluck('kod', 'id') // [id => kod] for tindakanby_diperlukan
            ->all();

        $usersMapByIc = DB::table('eminit_tindakandiperlukan')
            ->pluck('kod', 'ic_no') // [ic_no => kod] for created_by
            ->all();

        // Step 1: Initialize collection
        $eminitActions = collect();

        // old 
        // Step 2: get ALL related eminit_admin records
        // $adminIds = EminitAdmin::where('eminit_id', $eminit->id)->pluck('id');

        // if ($adminIds->isNotEmpty()) {
        //     // Step 3: get all related eminit_action records
        //     $eminitActions = EminitAction::whereIn('eminit_admin_id', $adminIds)->get();

        //     // Step 4: add display fields
        //     foreach($eminitActions as $action) {
        //         // Tindakan Diperlukan (from tindakanby_diperlukan ID)
        //         $action->display_tindakanby_kod = $usersMapById[$action->tindakanby_diperlukan] ?? $action->tindakanby_diperlukan;

        //         // Tindakan Daripada (from created_by IC number)
        //         $action->display_tindakan_daripada = $action->created_by 
        //             ? ($usersMapByIc[$action->created_by] ?? $action->created_by)
        //             : null; // null means nothing displayed if empty
        //     }
        // }

        // Step 2: get ALL related eminit_admin records
        $eminitAdmins = EminitAdmin::where('eminit_id', $eminit->id)->get();

        $adminIds = $eminitAdmins->pluck('id');

        if ($adminIds->isNotEmpty()) {

            // Create admin map by id
            $adminMap = $eminitAdmins->keyBy('id');

            // Step 3: get all related eminit_action records
            $eminitActions = EminitAction::whereIn('eminit_admin_id', $adminIds)->get();

            // Step 4: add display fields
            foreach ($eminitActions as $action) {

                // Tindakan Diperlukan
                $action->display_tindakanby_kod =
                    $usersMapById[$action->tindakanby_diperlukan]
                    ?? $action->tindakanby_diperlukan;

                // Get related admin
                $admin = $adminMap[$action->eminit_admin_id] ?? null;

                // If created_by exists, use it
                // else fallback to EminitAdmin created_by
                $createdByIc = $action->created_by
                    ?? optional($admin)->created_by;

                // Final display
                $action->display_tindakan_daripada = $createdByIc
                    ? ($usersMapByIc[$createdByIc] ?? $createdByIc)
                    : null;
            }
        }



      

        return view('eminit.vieweminitadmin', compact('icNos','eminit','admins', 'jenis', 'kepada',
        'Eminit_Untukperhatian',  'employments', 'tindakan','eminit_TindakandiperlukanMap', 'jenisTindakanMap',
        'eminitdate','tindakandiperlukan', 'jenisTindakan',  'eminitrujukan','eminitcatatan',
        'jenisTindakan','eminitActions'));
    }

public function indexeminitaction()
{
    $icNo = Auth::user()->ic_no ?? null;

    if (!$icNo) {
        $actions = collect(); // No IC, return empty
    } else {
        // Get tindakan IDs that belong to this user
        $tindakanIds = DB::table('eminit_tindakandiperlukan')
            ->where('ic_no', $icNo)
            ->pluck('id')
            ->toArray();

            $actions = DB::table('eminit_action as ea')
    ->join('eminit_admin as eadmin', 'ea.eminit_admin_id', '=', 'eadmin.id')
    ->join('eminit as e', 'eadmin.eminit_id', '=', 'e.id')
    ->select(
        'ea.id as action_id',
        'ea.eminit_admin_id as eminit_admin_id',
        'ea.catatan as action_catatan',
        'ea.jenis_tindakan',
        'ea.created_at as action_created_at',
        'eadmin.id as admin_id',
        'eadmin.catatan as admin_catatan',
        'eadmin.created_at as admin_created_at',
        'eadmin.tindakan_diperlukan as admin_tindakan',
        'eadmin.jenis_tindakan as admin_jenis',
        'eadmin.status as memo_status',  // <-- add this
        'e.id as eminit_id',
        'e.jenis as eminit_jenis',
        'e.perkara as eminit_perkara',
        'e.rujukan_tp',
        'e.eminit_file',
        'ea.tindakanby_diperlukan'
    )
    ->whereIn('ea.tindakanby_diperlukan', $tindakanIds)
    ->orderByDesc('ea.id')
    ->get();


     
    }

    $actions->transform(function ($item) {
        // Decode jenis_tindakan
        $jenis = [];
        if ($item->jenis_tindakan) {
            $decoded = json_decode($item->jenis_tindakan, true);
            if (is_string($decoded)) {
                $decoded = json_decode($decoded, true);
            }
            if (is_array($decoded)) {
                $jenis = array_filter($decoded); // remove empty values
            }
        }
    
        // Determine memo status
        if (strtolower($item->memo_status) === 'selesai') {
            $item->memo_status_display = 'Selesai';
        } elseif (empty($jenis)) {
            $item->memo_status_display = 'Untuk Tindakan';
        } else {
            $item->memo_status_display = 'In-Progress';
        }
    
        return $item;
    });

    // Map jenis labels if needed
    $jenisMap = DB::table('jenis')->pluck('label', 'id')->toArray();

    $tindakanMap = DB::table('eminit_tindakandiperlukan')->pluck('kod', 'id')->toArray();

    $actions->transform(function ($item) use ($tindakanMap) {

        $ids = [];

        if ($item->admin_tindakan) {
            $decoded = json_decode($item->admin_tindakan, true);

            if (is_string($decoded)) {
                $decoded = json_decode($decoded, true);
            }

            if (is_array($decoded)) {
                $ids = array_map('intval', $decoded);
            }
        }

        $item->tindakan_labels = collect($ids)
            ->map(fn ($id) => $tindakanMap[$id] ?? null)
            ->filter()
            ->values()
            ->toArray();

        return $item;
    });

    // Get tindakan labels map
    $tindakanMap = DB::table('dispatch_tindakanlist')
    ->pluck('label', 'id')
    ->toArray();

    $actions->transform(function ($item) use ($tindakanMap) {

    $ids = [];

    if ($item->jenis_tindakan) {
        $decoded = json_decode($item->jenis_tindakan, true);

        // handle double-encoded JSON
        if (is_string($decoded)) {
            $decoded = json_decode($decoded, true);
        }

        if (is_array($decoded)) {
            $ids = array_map('intval', $decoded);
        }
    }

    // Map IDs → labels
    $item->jenis_tindakan_labels = collect($ids)
        ->map(fn ($id) => $tindakanMap[$id] ?? null)
        ->filter()
        ->values()
        ->toArray();

    return $item;
    });

    return view('eminit.indexeminitaction', compact('actions', 'jenisMap'));
}





    public function indexeminitactionold()
    {
        $icNos = Auth::user()->ic_no ?? null;

        $viewer = $icNos ? Eminit_Tindakandiperlukan::firstWhere('ic_no', $icNos) : null;

        $userId = auth()->id();

        $eminits = Eminit::with(['latestAdminEntry', 'latestAction'])
            ->where(function ($outer) use ($viewer, $userId) {

                if ($viewer) {
                    $idStr = (string) $viewer->id;

                    // 1) ADMIN recipient match (JSON or scalar)
                    $outer->whereHas('admins', function ($q) use ($idStr) {
                        $col = 'eminit_admin.tindakan_diperlukan';
                        $q->where(function ($qq) use ($col, $idStr) {
                            // JSON array: ["1","89",...]
                            $qq->where(function ($x) use ($col, $idStr) {
                                $x->whereRaw("ISJSON($col) = 1")
                                ->whereJsonContains($col, $idStr);
                            })
                            // Scalar string: '1'
                            ->orWhere(function ($x) use ($col, $idStr) {
                                $x->whereRaw("ISJSON($col) = 0")
                                ->whereRaw("LTRIM(RTRIM($col)) = ?", [$idStr]);
                            });
                        });
                    })

                    // 2) OR ACTION recipient match (JSON or scalar)
                    ->orWhereHas('actions', function ($q) use ($idStr) {
                        $col = 'eminit_action.tindakan_diperlukan';
                        $q->where(function ($qq) use ($col, $idStr) {
                            // JSON array (normal case for actions)
                            $qq->where(function ($x) use ($col, $idStr) {
                                $x->whereRaw("ISJSON($col) = 1")
                                ->whereJsonContains($col, $idStr);
                            })
                            // Fallback if some old rows stored scalar
                            ->orWhere(function ($x) use ($col, $idStr) {
                                $x->whereRaw("ISJSON($col) = 0")
                                ->whereRaw("LTRIM(RTRIM($col)) = ?", [$idStr]);
                            });
                        });
                    });
                }

                // 3) OR creator of any related action
                if ($userId) {
                    $outer->orWhereHas('actions', function ($q) use ($userId) {
                        $q->where('eminit_action.created_by', $userId);
                    });
                }
            })
            ->orderByDesc('id')
            ->get();


      

        $actions = EminitAction::with(['admin.eminit'])
        ->orderByDesc('id')
        ->get();

    

        $jenisMap  = EminitJenis::pluck('label', 'id')->toArray(); // id => label

        $lastActionPerAdmin = DB::table('eminit_action')
        ->select('eminit_admin_id', DB::raw('MAX(id) as max_id'))
        ->groupBy('eminit_admin_id');

        $latestActionByEminit = DB::table('eminit_admin as ea')
            ->leftJoinSub($lastActionPerAdmin, 'last', function ($j) {
                $j->on('ea.id', '=', 'last.eminit_admin_id');
            })
            ->leftJoin('eminit_action as a', 'a.id', '=', 'last.max_id')
            ->select([
                'ea.eminit_id',
                'a.id as action_id',
                'a.created_at',
                'a.catatan',
            ])
            ->get()
            ->keyBy('eminit_id');   // => [eminit_id => row]

        $tarikhByEminit = DB::table('eminit_action as a')
        ->join('eminit_admin as ea', 'ea.id', '=', 'a.eminit_admin_id')
        ->select('ea.eminit_id', DB::raw('MAX(a.created_at) as latest_created_at'))
        ->groupBy('ea.eminit_id')
        ->pluck('latest_created_at', 'ea.eminit_id')   // key: eminit_id → value: latest action time
        ->all();

        $catatanByEminit = $eminits->mapWithKeys(function ($e) {
        $v = optional($e->latestAction)->catatan;

        // normalize: array / JSON string / plain string
        if (is_array($v)) {
            $v = implode(', ', array_filter($v, 'strlen'));
        } elseif (is_string($v) && strlen($v) && $v[0] === '[') {
            $arr = json_decode($v, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($arr)) {
                $v = implode(', ', array_filter($arr, 'strlen'));
            }
        }
        return [$e->id => $v];
    });

        $statusByEminit = $latestActionByEminit->map(fn ($r) => $r->action_id ? 'Diterima' : null);



        return view('eminit.indexeminitaction', compact('eminits', 'jenisMap', 'tarikhByEminit',
        'catatanByEminit', 'statusByEminit','actions','viewer','icNos','userId'));
    }

    public function editeminitaction($eminitaction)
{
    $eminitaction = EminitAction::findOrFail($eminitaction);

    // Fetch the related eminit_admin based on eminit_admin_id
    $eminitadmin = EminitAdmin::find($eminitaction->eminit_admin_id);

   
    // Tindakan Diperlukan
    // Get tindakan_diperlukan IDs (already an array)
    $tindakan_ids = is_array($eminitadmin->tindakan_diperlukan) 
                    ? $eminitadmin->tindakan_diperlukan 
                    : [];

    

    // Fetch the 'kod' from eminit_tindakandiperlukan
    $tindakan_labels = DB::table('eminit_tindakandiperlukan')
                        ->whereIn('id', $tindakan_ids)
                        ->pluck('kod')
                        ->toArray();

    // ------------------------
    // Jenis Tindakan
 
    $jenis_ids = is_array($eminitadmin->jenis_tindakan) 
                 ? $eminitadmin->jenis_tindakan 
                 : [];

    $jenis_labels = Tindakanlist::whereIn('id', $jenis_ids)
                    ->pluck('label')
                    ->toArray();

    $eminit = Eminit::find($eminitadmin->eminit_id);

    // Map 'jenis' to label
    $eminit_jenis = $eminit && $eminit->jenis 
                 ? EminitJenis::where('id', $eminit->jenis)->value('label') 
                 : '-';

  // Map 'daripada' to department label
    $eminit_daripada = $eminit && $eminit->daripada
                    ? Department::where('id', $eminit->daripada)->value('label')
                    : '-';

// Map 'kepada' to labels from table kepada
   $kepada_ids = $eminit && !empty($eminit->kpd) ? $eminit->kpd : [];

    $eminit_kepada = !empty($kepada_ids)
        ? Kepada::whereIn('id', $kepada_ids)->pluck('label')->toArray()
        : [];

  // Fetch all tindakan for the current user's department (optional)
  $deptIds = is_array($eminit->kpd) ? $eminit->kpd : [$eminit->kpd];

  $tindakans = Eminit_tindakandiperlukan::whereIn('department_id', $deptIds)
      ->orderBy('label')
      ->get();
                     // Jenis Tindakan
    $jenistindakans = Tindakanlist::orderBy('kod')->get();

     // -----------------------------
    // Show Action Info Logic
    $userIC = auth()->user()->ic_no; // current logged-in user IC
    $allEminitActions = EminitAction::where('eminit_admin_id', $eminitadmin->id)->get();

    $showActionInfo = false;
    $relatedAction = null;
    $relatedTindakanLabels = [];
    $relatedJenisLabels = [];

    foreach ($allEminitActions as $action) {
        $tindakanIds = $action->tindakan_diperlukan;

        // Ensure it's an array
        if (is_string($tindakanIds)) {
            $tindakanIds = json_decode($tindakanIds, true) ?? [];
        } elseif (!is_array($tindakanIds)) {
            $tindakanIds = [];
        }

        if (!empty($tindakanIds)) {
            $icNumbers = Eminit_tindakandiperlukan::whereIn('id', $tindakanIds)
                            ->pluck('ic_no')
                            ->toArray();

            if (in_array($userIC, $icNumbers)) {
                $showActionInfo = true;
                $relatedAction = $action;

                // Fetch tindakan_diperlukan labels from this action
                $relatedTindakanLabels = Eminit_tindakandiperlukan::whereIn('id', $tindakanIds)
                                        ->pluck('kod')->toArray();

                // Fetch jenis_tindakan labels from this action
                $jenisIds = $action->jenis_tindakan;
                if (is_string($jenisIds)) {
                    $jenisIds = json_decode($jenisIds, true) ?? [];
                } elseif (!is_array($jenisIds)) {
                    $jenisIds = [];
                }
                $relatedJenisLabels = Tindakanlist::whereIn('id', $jenisIds)
                                        ->pluck('label')->toArray();

                break; // Stop after first matching action
            }
        }
    }

    



   
   
    return view('eminit.editeminitaction', compact('eminitaction','eminitadmin', 'tindakan_labels', 'jenis_labels','eminit','eminit_jenis','eminit_daripada','eminit_kepada','tindakans','jenistindakans','showActionInfo', 'relatedAction', 'relatedTindakanLabels', 'relatedJenisLabels'));
}

    



public function storeeminitaction(Request $request, Eminit $eminit, EminitAdmin $admin)
{
    $icNos = Auth::user()->ic_no;
    $data = $request->validate([
        'no_rujukan'          => 'nullable|string|max:255',
        'catatan'             => 'nullable|string',
        'tindakan_diperlukan' => 'nullable',
        'jenis_tindakan'      => 'nullable',
        'action_id'           => 'nullable|integer',
    ]);

    $payload = [
        'no_rujukan'          => $data['no_rujukan'] ?? null,
        'catatan'             => $data['catatan'] ?? null,
        'tindakan_diperlukan' => $this->normalizeMulti($data['tindakan_diperlukan'] ?? null),
        'jenis_tindakan'      => $this->normalizeMulti($data['jenis_tindakan'] ?? null),
    ];

    if (!empty($data['action_id'])) {
        // EDIT: don't change creator
        $admin->actions()->whereKey($data['action_id'])->update($payload);
    } else {
        // CREATE: stamp IC number
        $admin->actions()->create($payload + [
            'eminit_admin_id' => $admin->id,
            'created_by'      => $icNos,
        ]);
    }

    return redirect()->route('eminit.eminit.indexeminitaction')
        ->with('success_message', 'Tindakan berjaya direkodkan pada EminitAction.');
}

public function updateeminitaction(Request $request, $id)
{
    $eminitAction = EminitAction::findOrFail($id);

    // Validate only if you want, but these fields are optional
    $request->validate([
        'no_rujukan' => 'nullable|string|max:255',
        'catatan' => 'nullable|string',
        'tindakan_diperlukan' => 'nullable|array',
        'jenis_tindakan' => 'nullable|array',
        'tindakan_file' => 'nullable|array',           // optional array of files
        'tindakan_file.*' => 'nullable|file|max:10240', // individual files max 10MB
    ]);

  $now = Carbon::now();
  $icNos = Auth::user()->ic_no;

    // 1️⃣ Handle uploaded tindakan_file (optional)
    $uploadedFiles = array_values(array_filter(
        $request->file('tindakan_file', []),
        fn($f) => $f instanceof \Illuminate\Http\UploadedFile
    ));

    $storedFiles = $eminitAction->tindakan_file ?? []; // existing files

    foreach ($uploadedFiles as $file) {
        $name = \Illuminate\Support\Str::uuid()->toString() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('tindakan', $name, 'public');

        $storedFiles[] = [
            'original' => $file->getClientOriginalName(),
            'stored'   => $name,
            'path'     => $path,
            'url'      => \Storage::disk('public')->url($path),
        ];
    }


    //2️⃣ Update the current EminitAction record
    $eminitAction->update([
        'no_rujukan' => $request->no_rujukan,
        'catatan' => $request->catatan,
        'tindakan_diperlukan' => $request->tindakan_diperlukan ? json_encode($request->tindakan_diperlukan) : json_encode([]),
        'jenis_tindakan' => $request->jenis_tindakan ? json_encode($request->jenis_tindakan) : json_encode([]),
        'tindakan_file' => $storedFiles, // merge existing + new files
    ]);

   // 2️⃣ If there are new 'tindakan_diperlukan', create new rows + send email

   if (!empty($request->tindakan_diperlukan)) {

    $eminitAdmin = EminitAdmin::find($eminitAction->eminit_admin_id);
    $eminit = \App\Models\Eminit::find($eminitAdmin->eminit_id);

    foreach ($request->tindakan_diperlukan as $tindakanId) {

        // ✅ Create the action
        EminitAction::create([
            'eminit_admin_id'        => $eminitAction->eminit_admin_id,
            'tindakanby_diperlukan' => $tindakanId,
            'created_at'             => $now,
            'created_by'             => $icNos,
        ]);

        // 🔹 Get tindakan recipient
        $tindakan = \App\Models\Eminit_Tindakandiperlukan::find($tindakanId);
        if (!$tindakan) {
            \Log::warning("E-Memo Tindakan: ID $tindakanId not found in eminit_tindakandiperlukan");
            continue;
        }

        if (empty($tindakan->email)) {
            \Log::warning("E-Memo Tindakan: ID $tindakanId has empty email");
            continue;
        }

        // 🔹 Get recipient name from User table via ic_no
        $recipientName = optional(\App\Models\User::where('ic_no', $tindakan->ic_no)->first())->name ?? $tindakan->ic_no;

        // 🔹 Get department label
        $departmentLabel = optional(\App\Models\Department::find($tindakan->department_id))->label ?? '-';

        // 🔹 Jenis mapping
        $jenisMap = \App\Models\EminitJenis::pluck('label', 'id')->toArray();
        $notf_Jenis = $jenisMap[(int)($eminit->jenis ?? 0)] ?? '-';

        // 🔹 Memo Daripada mapping
        $notf_MemoDaripada = optional($eminit->memoDepartment)->label ?? '-';

        $notf_Perkara     = $eminit->perkara ?? '-';
        $notf_TarikhAdmin = \Carbon\Carbon::parse($eminitAdmin->created_at)->format('d/m/Y');

        // 🔹 Send email
        try {
            \Mail::to($tindakan->email)->send(
                new \App\Mail\EmailEmemoTindakanRepeat(
                    $recipientName,
                    $departmentLabel,
                    $notf_Jenis,
                    $notf_MemoDaripada,
                    $notf_Perkara,
                    $notf_TarikhAdmin
                )
            );
            \Log::info("E-Memo Tindakan: Email sent to {$tindakan->email}");
        } catch (\Exception $e) {
            \Log::error('E-Memo Tindakan Email Error: ' . $e->getMessage());
        }
    }
}


// 3️⃣ If status is 'selesai', update the related EminitAdmin record
if ($request->status === 'selesai') {
    $eminitAdmin = EminitAdmin::find($eminitAction->eminit_admin_id);
    if ($eminitAdmin) {

        // Update status
        $eminitAdmin->update([
            'status' => 'selesai',
        ]);

        // 🔹 Get main eminit
        $eminit = \App\Models\Eminit::find($eminitAdmin->eminit_id);

        // 🔹 DATA EMAIL ASAS (DARIPADA EMINIT)
        $jenisMap = \App\Models\EminitJenis::pluck('label','id')->toArray();
        $notf_Jenis        = $jenisMap[(int)($eminit->jenis ?? 0)] ?? '-';
        $notf_MemoDaripada = optional($eminit->memoDepartment)->label ?? '-';
        $notf_Perkara      = $eminit->perkara ?? '-';
        $notf_Tarikh       = Carbon::parse($eminit->created_at)->format('d/m/Y');
        $notf_Icno         = optional(User::where('ic_no', $eminit->ic_no)->first())->name ?? $eminit->ic_no;

        // 🔹 PADANKAN KEPADA ADMIN YANG TERLIBAT
        $kpdDepartments = is_array($eminit->kpd) ? $eminit->kpd : json_decode($eminit->kpd, true);

        $admins = \App\Models\EminitAdminPushNotif::whereIn('department_id', $kpdDepartments)
            ->whereNotNull('email')
            ->get();

        // 🔹 HANTAR EMAIL KEPADA ADMIN YANG PADAN
        foreach ($admins as $admin) {

            // Nama Admin dari ic_no → users
            $notf_Nama = optional(User::where('ic_no', $admin->ic_no)->first())->name ?? $admin->ic_no;

            // Jabatan dari eminit_adminpushnotif
            $notf_jabatan = optional(\App\Models\Department::find($admin->department_id))->label ?? $admin->department_id;

            try {
                \Mail::to($admin->email)->send(
                    new \App\Mail\EmailEmemoAdminCompleted(
                        $notf_Nama,
                        $notf_jabatan,
                        $notf_Jenis,
                        $notf_MemoDaripada,
                        $notf_Perkara,
                        $notf_Tarikh
                    )
                );
                \Log::info("E-Memo Completed: Email sent to {$admin->email}");
            } catch (\Exception $e) {
                \Log::error('E-Memo Completed Email Error: ' . $e->getMessage());
            }
        }
    }
}


    return redirect()->route('eminit.eminit.indexeminitaction')->with('success', 'Action updated successfully.');
}
public function updateeminitactionold(Request $request, Eminit $eminit)
{
    $admin = EminitAdmin::where('eminit_id', $eminit->id)->first();
    $icNos = Auth::user()->ic_no;
    $recipientIds = Eminit_Tindakandiperlukan::whereIn('kod', $request->input('tindakan_diperlukan', []))
    ->pluck('id')->map(fn($id) => (string)$id)->values()->all();
    $jenis = collect($request->input('jenis_tindakan', []))
        ->map(fn($v) => (string)$v)->values()->all();

    if (!$admin) {
        return back()->withErrors(['eminit_admin_id' => 'Tiada rekod admin untuk eminit ini.']);
    }

    $data = $request->validate([
        'no_rujukan'            => 'nullable|string|max:255',
        'catatan'               => 'nullable|string',
        'tindakan_diperlukan'   => 'nullable|array',
        'tindakan_diperlukan.*' => 'integer',
        'jenis_tindakan'        => 'nullable|array',
        'jenis_tindakan.*'      => 'integer',
    ]);

    $admin->actions()->create([
        'no_rujukan'          => $data['no_rujukan'] ?? null,
        'catatan'             => $data['catatan'] ?? null,
        'tindakan_diperlukan' => $data['tindakan_diperlukan'] ?? [],
        'jenis_tindakan'      => $data['jenis_tindakan'] ?? [],
        'eminit_admin_id'     => $admin->id,
        'created_by'          => $icNos, // <-- IC number
    ]);

    return redirect()->route('eminit.eminit.indexeminitaction')
        ->with('success_message', 'Tindakan baharu direkodkan.');
}

public function vieweminitaction($eminitactionId)
{
    // Fetch current action
    $eminitaction = EminitAction::findOrFail($eminitactionId);

    // Fetch related admin
    $eminitadmin = EminitAdmin::find($eminitaction->eminit_admin_id);

    // ------------------------
    // E-minit Info
    $eminit = Eminit::find($eminitadmin->eminit_id);

    $eminit_jenis = $eminit && $eminit->jenis 
        ? EminitJenis::where('id', $eminit->jenis)->value('label') 
        : '-';

    $eminit_daripada = $eminit && $eminit->daripada
        ? Department::where('id', $eminit->daripada)->value('label')
        : '-';

    $kepada_ids = $eminit && !empty($eminit->kpd) ? $eminit->kpd : [];
    $eminit_kepada = !empty($kepada_ids)
        ? Kepada::whereIn('id', $kepada_ids)->pluck('label')->toArray()
        : [];

    // ------------------------
    // Admin Info Labels
    $tindakan_ids = is_array($eminitadmin->tindakan_diperlukan) 
        ? $eminitadmin->tindakan_diperlukan 
        : (is_string($eminitadmin->tindakan_diperlukan) ? json_decode($eminitadmin->tindakan_diperlukan, true) : []);

    $tindakan_labels = !empty($tindakan_ids)
        ? Eminit_tindakandiperlukan::whereIn('id', $tindakan_ids)->pluck('kod')->toArray()
        : [];

    $jenis_ids = is_array($eminitadmin->jenis_tindakan)
        ? $eminitadmin->jenis_tindakan
        : (is_string($eminitadmin->jenis_tindakan) ? json_decode($eminitadmin->jenis_tindakan, true) : []);

    $jenis_labels = !empty($jenis_ids)
        ? Tindakanlist::whereIn('id', $jenis_ids)->pluck('label')->toArray()
        : [];

    // ------------------------
    // Tindakans for dropdowns if needed
    $tindakans = Eminit_tindakandiperlukan::where('department_id', auth()->user()->department_id)
                    ->orderBy('label')->get();

    $jenistindakans = Tindakanlist::orderBy('kod')->get();

    // ------------------------
    // Related Actions Logic
    $tindakanIds = is_string($eminitaction->tindakan_diperlukan) 
        ? json_decode($eminitaction->tindakan_diperlukan, true) ?? [] 
        : (is_array($eminitaction->tindakan_diperlukan) ? $eminitaction->tindakan_diperlukan : []);

    $relatedActions = collect();

    // Include current action
    $relatedActions->push($eminitaction);

    // Fetch other actions of the same admin
    $otherActions = EminitAction::where('eminit_admin_id', $eminitaction->eminit_admin_id)
        ->where('id', '!=', $eminitaction->id)
        ->get();

    foreach($otherActions as $action) {
        $actionTindakan = is_string($action->tindakan_diperlukan)
            ? json_decode($action->tindakan_diperlukan, true) ?? []
            : (is_array($action->tindakan_diperlukan) ? $action->tindakan_diperlukan : []);

        // Case 1: current action has tindakan_diperlukan → match other action's tindakanby_diperlukan
        if(!empty($tindakanIds) && in_array($action->tindakanby_diperlukan, $tindakanIds)) {
            // Add Tindakan Daripada (kod)
            $action->tindakan_daripada_kod = $action->created_by
                ? Eminit_tindakandiperlukan::where('ic_no', $action->created_by)->value('kod')
                : '-';

            $relatedActions->push($action);
        }

        // Case 2: current action has empty tindakan_diperlukan → match current action's tindakanby_diperlukan
        if(empty($tindakanIds) && !empty($actionTindakan) && in_array($eminitaction->tindakanby_diperlukan, $actionTindakan)) {
            // Add Tindakan Daripada (kod)
            $action->tindakan_daripada_kod = $action->created_by
                ? Eminit_tindakandiperlukan::where('ic_no', $action->created_by)->value('kod')
                : '-';

            $relatedActions->push($action);
        }
    }


    // Sort all actions by ID ascending
    $relatedActions = $relatedActions->sortBy('id')->values();

  // Add labels for each related action
foreach($relatedActions as $action) {
     // Decode tindakan_diperlukan IDs
    $actionTindakanIds = is_string($action->tindakan_diperlukan)
        ? json_decode($action->tindakan_diperlukan, true) ?? []
        : (is_array($action->tindakan_diperlukan) ? $action->tindakan_diperlukan : []);

    // Fetch actual labels from Eminit_tindakandiperlukan
    $action->tindakan_labels = !empty($actionTindakanIds)
        ? Eminit_tindakandiperlukan::whereIn('id', $actionTindakanIds)->pluck('kod')->toArray()
        : [];

    // Fetch jenis labels
    $jenisIdsAction = is_string($action->jenis_tindakan) 
        ? json_decode($action->jenis_tindakan, true) ?? []
        : (is_array($action->jenis_tindakan) ? $action->jenis_tindakan : []);

    $action->jenis_labels = Tindakanlist::whereIn('id', $jenisIdsAction)->pluck('label')->toArray();

    // ----------------- Add Tindakan Daripada (kod) -----------------
    $action->tindakan_daripada_kod = $action->created_by
        ? Eminit_tindakandiperlukan::where('ic_no', $action->created_by)->value('kod')
        : '-';
}

    // ------------------------
    return view('eminit.vieweminitaction', compact(
        'eminitaction',
        'eminitadmin',
        'tindakan_labels',
        'jenis_labels',
        'eminit',
        'eminit_jenis',
        'eminit_daripada',
        'eminit_kepada',
        'tindakans',
        'jenistindakans',
        'relatedActions'
    ));
}




    public function vieweminitactionold(Eminit $eminit, EminitAdmin $eminitadmin,EminitAction $eminitaction)
    {
        $icNos = Auth::user()->ic_no;
        $jenis = EminitJenis::pluck('label', 'id')->toArray();
        $kepada = Kepada::pluck('label', 'id')->toArray();
        $Eminit_Untukperhatian = Eminit_Untukperhatian::pluck('kod', 'id')->toArray();
        $employments = Employment::all()
        ->where('ic_no', '=', $icNos);
        $tindakan = Tindakanlist::pluck('label', 'id')
        ->mapWithKeys(fn($label, $id) => [(string)$id => $label]) // make keys strings to match JSON-cast
        ->all();
        $eminit_TindakandiperlukanMap = Eminit_Tindakandiperlukan::pluck('kod', 'id')   // [id => kod]
        ->mapWithKeys(fn($kod, $id) => [(string)$id => $kod]) // make keys strings to match JSON-cast
        ->all();
        $jenisTindakanMap = Tindakanlist::pluck('label', 'id')   // [id => label]
        ->mapWithKeys(fn($label, $id) => [(string)$id => $label]) // make keys strings to match JSON-cast
        ->all();
        $eminitdate = EminitAdmin::value('created_at','id');
        $tindakandiperlukan = EminitAdmin::pluck('tindakan_diperlukan', 'id')->toArray();
        $jenisTindakan = EminitAdmin::pluck('jenis_tindakan');
        $eminitrujukan = EminitAdmin::pluck('no_rujukan')->toArray();
        $eminitcatatan = EminitAdmin::pluck('catatan')->toArray();
        $admins = EminitAdmin::
        where('eminit_id',$eminit->id)
        ->orderByDesc('id')
        ->get();

        $actions = EminitAction::with('admin')
        ->whereHas('admin', fn($q) => $q->where('eminit_id', $eminit->id))
        ->latest('id')
        ->get();
        
        $namesByIc = DB::connection('sqlsrv')
    ->table('users')                 // dbo.user
    ->whereNotNull('ic_no')
    ->pluck('name', 'ic_no')        // [ic_no => user]
    ->mapWithKeys(fn($name, $ic) => [(string)$ic => $name]) // ensure string keys
    ->all();

        return view('eminit.vieweminitaction', compact('icNos','eminit','eminitadmin','admins','actions',
        'eminitaction', 'jenis', 'kepada', 'Eminit_Untukperhatian',  'employments',
        'tindakan','eminit_TindakandiperlukanMap', 'jenisTindakanMap','eminitdate','tindakandiperlukan',
        'jenisTindakan',  'eminitrujukan','eminitcatatan','jenisTindakan','namesByIc'));
    }
    private function normalizeMulti($value): array
{
    if (is_array($value)) {
        return array_values(array_filter($value, fn($v) => $v !== null && $v !== ''));
    }
    if (is_string($value)) {
        $decoded = json_decode($value, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return array_values(array_filter($decoded,static fn($v) => $v !== null && $v !== ''));
        }
        return array_values(array_filter(array_map('trim', explode(',', $value)), 'strlen'));
    }
    return [];
}

public function viewDocument($filename)
{
    $path = storage_path('app/public/eminit/' . $filename); // matches your storage path

    if (!file_exists($path)) {
        abort(404, 'Dokumen tidak dijumpai');
    }

    // Inline forces browser to open instead of downloading
    return response()->file($path, [
        'Content-Disposition' => 'inline; filename="' . $filename . '"'
    ]);
}

public function viewFile($filename)
{
    $path = storage_path('app/public/eminit/' . $filename);

    if (!file_exists($path)) {
        abort(404, 'Dokumen tidak dijumpai');
    }

    return response()->file($path, [
        'Content-Disposition' => 'inline; filename="' . $filename . '"'
    ]);
}

public function viewTindakanFile($filename)
{
    $path = storage_path('app/public/eminit/' . $filename);

    if (!file_exists($path)) {
        abort(404, 'Dokumen tidak dijumpai');
    }

    return response()->file($path, [
        'Content-Disposition' => 'inline; filename="' . $filename . '"'
    ]);
}
}
