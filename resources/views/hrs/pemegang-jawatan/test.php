public function updateeminit(Request $request, \App\Models\Eminit $eminit)
{
    $validated = $request->validate([
        'jenis'             => 'required|integer|exists:jenis,id',
        'daripada'          => 'required|integer',
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