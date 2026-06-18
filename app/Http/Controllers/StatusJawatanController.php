<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatusJawatanController extends Controller
{
    /**
     * Show the form for creating a new record
     */
    public function create()
    {
        // Initialize empty record
        $record = null;
        $currentPosition = 0;
        $totalRecords = 0;
        $prevKodJawatan = null;
        $nextKodJawatan = null;
        $firstKodJawatan = null;
        $lastKodJawatan = null;
        $allKodJawatan = [];

        return view('hrs.jawatan.status_jawatan_form', compact(
            'record',
            'currentPosition',
            'totalRecords',
            'prevKodJawatan',
            'nextKodJawatan',
            'firstKodJawatan',
            'lastKodJawatan',
            'allKodJawatan'
        ));
    }

    /**
     * Display the form for a specific record
     */
    public function show($kod_jawatan = null)
{
    // Get all unique Kod_Jawatan values ordered DESC numerically (SQL Server syntax)
    $allKodJawatan = DB::table('status_jawatan_form')
        ->selectRaw('Kod_Jawatan, CAST(Kod_Jawatan AS INT) AS Kod_Jawatan_Int')
        ->whereNotNull('Kod_Jawatan')
        ->where('Kod_Jawatan', '!=', '')
        ->distinct()
        ->orderBy('Kod_Jawatan_Int', 'desc')
        ->pluck('Kod_Jawatan')
        ->toArray();

    // Initialize default values
    $record = null;
    $currentPosition = 0;
    $totalRecords = count($allKodJawatan);
    $prevKodJawatan = null;
    $nextKodJawatan = null;
    $firstKodJawatan = null;
    $lastKodJawatan = null;

    // Check if there are any records
    if ($totalRecords === 0) {
        // No records in database
        return view('hrs.jawatan.status_jawatan_form', compact(
            'record',
            'currentPosition',
            'totalRecords',
            'prevKodJawatan',
            'nextKodJawatan',
            'firstKodJawatan',
            'lastKodJawatan',
            'allKodJawatan'
        ));
    }

    // If no kod_jawatan specified, get the first one
    if (!$kod_jawatan) {
        $kod_jawatan = $allKodJawatan[0];
    }

    // Get the current record
    $record = DB::table('status_jawatan_form')
        ->where('Kod_Jawatan', $kod_jawatan)
        ->first();

    // If record not found, redirect to first record
    if (!$record) {
        return redirect()->route('status-jawatan.show', ['kod_jawatan' => $allKodJawatan[0]]);
    }

    // Get current position
    $currentIndex = array_search($kod_jawatan, $allKodJawatan);
    $currentPosition = $currentIndex !== false ? $currentIndex + 1 : 1;

    // Get previous and next Kod_Jawatan
    $prevKodJawatan = ($currentIndex > 0) ? $allKodJawatan[$currentIndex - 1] : null;
    $nextKodJawatan = ($currentIndex < $totalRecords - 1) ? $allKodJawatan[$currentIndex + 1] : null;
    $firstKodJawatan = $allKodJawatan[0];
    $lastKodJawatan = $allKodJawatan[$totalRecords - 1];

    return view('hrs.jawatan.status_jawatan_form', compact(
        'record',
        'currentPosition',
        'totalRecords',
        'prevKodJawatan',
        'nextKodJawatan',
        'firstKodJawatan',
        'lastKodJawatan',
        'allKodJawatan'
    ));
}

    /**
     * Store a new record
     */
    public function store(Request $request)
    {
        try {
            // Prepare data for insertion
            $data = [
                'Kod_Jawatan' => $request->input('kod_jawatan_kod'),
                'Jawatan' => $request->input('jawatan'),
                'Budget' => $request->input('peruntukan'),
                'Kod_Jabatan' => $request->input('kod_jabatan'),
                'Jabatan_Bahagian' => $request->input('bahagian'),
                'Tanggagaji' => $request->input('tangggaji'),
                'Jawatan_Bahagian' => $request->input('divisyen'),
                'Nota' => $request->input('status_jawatan'),
                'Jenis_Jawatan' => $request->input('jenis_jawatan'),
                'Jumlah_Gaji' => $request->input('starting_gaji'),
                'Peruntukan_Lama' => $request->input('peruntukan_lama'),
                'Peruntukan_Baru' => $request->input('peruntukan_baru'),
                'Kosong' => $request->input('kosong'),
                'Penuh' => $request->input('penuh'),
                'Text155' => $request->input('program'),
                'Text183' => $request->input('jabatan'),
                'Keterangan' => $request->input('status_content'),
                'Sebab_Kekosongan' => $request->input('kekosongan_content'),
                'Kod_JPA' => $request->input('kod_jpa'),
                'Status_JPA' => $request->input('summarize'),
                'Tarikh_mulai_kosong' => $request->input('tarikh_mulai_kosong'),
                'Aktiviti' => $request->input('aktiviti'),
                'Fungsi_Jawatan' => $request->input('fungsi_jawatan'),
                'Kod_Aktiviti' => $request->input('kod_aktiviti'),
                'Kod_Program' => $request->input('kod_program'),
                'Link_SPA' => $request->input('link_spa'),
                'Tarikh_DA_ke_SPA' => $request->input('tarikh_da_spa'),
                'Tarikh_Tutup_Iklan' => $request->input('tarikh_tutup_iklan'),
                'Tarikh_Ujian_Bertulis' => $request->input('tarikh_ujian'),
                'Tarikh_Temuduga' => $request->input('tarikh_temuduga'),
                'Tarikh_Jawatan_Disikan' => $request->input('tarikh_disikan'),
                'Lain_Lain_Hal_SF01' => $request->input('status_buku_budget'),
                'Tindakan_Lama' => $request->input('tindakan_lama'),
            ];

            // Remove null values (SQL Server handles them better this way)
            $data = array_filter($data, function($value) {
                return $value !== null;
            });

            // Insert into database
            DB::table('status_jawatan_form')->insert($data);

            // Redirect to the newly created record
            $kodJawatan = $request->input('kod_jawatan_kod');
            return redirect()->route('status-jawatan.show', ['kod_jawatan' => $kodJawatan])
                ->with('success', 'Data berjaya disimpan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Ralat semasa menyimpan data: ' . $e->getMessage()]);
        }
    }

    /**
     * Update an existing record
     */
    public function update(Request $request, $kod_jawatan)
    {
        try {
            // Prepare data for update
            $data = [
                'Jawatan' => $request->input('jawatan'),
                'Budget' => $request->input('peruntukan'),
                'Kod_Jabatan' => $request->input('kod_jabatan'),
                'Jabatan_Bahagian' => $request->input('bahagian'),
                'Tanggagaji' => $request->input('tangggaji'),
                'Jawatan_Bahagian' => $request->input('divisyen'),
                'Nota' => $request->input('status_jawatan'),
                'Jenis_Jawatan' => $request->input('jenis_jawatan'),
                'Jumlah_Gaji' => $request->input('starting_gaji'),
                'Peruntukan_Lama' => $request->input('peruntukan_lama'),
                'Peruntukan_Baru' => $request->input('peruntukan_baru'),
                'Kosong' => $request->input('kosong'),
                'Penuh' => $request->input('penuh'),
                'Text155' => $request->input('program'),
                'Text183' => $request->input('jabatan'),
                'Keterangan' => $request->input('status_content'),
                'Sebab_Kekosongan' => $request->input('kekosongan_content'),
                'Kod_JPA' => $request->input('kod_jpa'),
                'Status_JPA' => $request->input('summarize'),
                'Tarikh_mulai_kosong' => $request->input('tarikh_mulai_kosong'),
                'Aktiviti' => $request->input('aktiviti'),
                'Fungsi_Jawatan' => $request->input('fungsi_jawatan'),
                'Kod_Aktiviti' => $request->input('kod_aktiviti'),
                'Kod_Program' => $request->input('kod_program'),
                'Link_SPA' => $request->input('link_spa'),
                'Tarikh_DA_ke_SPA' => $request->input('tarikh_da_spa'),
                'Tarikh_Tutup_Iklan' => $request->input('tarikh_tutup_iklan'),
                'Tarikh_Ujian_Bertulis' => $request->input('tarikh_ujian'),
                'Tarikh_Temuduga' => $request->input('tarikh_temuduga'),
                'Tarikh_Jawatan_Disikan' => $request->input('tarikh_disikan'),
                'Lain_Lain_Hal_SF01' => $request->input('status_buku_budget'),
                'Tindakan_Lama' => $request->input('tindakan_lama'),
            ];

            // Remove null values
            $data = array_filter($data, function($value) {
                return $value !== null;
            });

            // Update database
            DB::table('status_jawatan_form')
                ->where('Kod_Jawatan', $kod_jawatan)
                ->update($data);

            return redirect()->route('status-jawatan.show', ['kod_jawatan' => $kod_jawatan])
                ->with('success', 'Data berjaya dikemaskini!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Ralat semasa mengemas kini data: ' . $e->getMessage()]);
        }
    }

/**
 * Delete a record
 */
public function destroy($kod_jawatan)
{
    try {
        // Check if record exists
        $record = DB::table('status_jawatan_form')
            ->where('Kod_Jawatan', $kod_jawatan)
            ->first();

        if (!$record) {
            return redirect()->route('status-jawatan.show')
                ->withErrors(['error' => 'Rekod tidak dijumpai.']);
        }

        // Delete the record
        DB::table('status_jawatan_form')
            ->where('Kod_Jawatan', $kod_jawatan)
            ->delete();

        return redirect()->route('status-jawatan.show')
            ->with('success', 'Rekod berjaya dipadam!');
    } catch (\Exception $e) {
        return redirect()->back()
            ->withErrors(['error' => 'Ralat semasa memadam rekod: ' . $e->getMessage()]);
    }
}

    /**
     * Search for records
     */
    public function search(Request $request)
    {
        $searchQuery = $request->input('search_query');

        // SQL Server uses different wildcard syntax
        $record = DB::table('status_jawatan_form')
            ->where('Kod_Jawatan', 'LIKE', "%{$searchQuery}%")
            ->orWhere('Jawatan', 'LIKE', "%{$searchQuery}%")
            ->orWhere('Jabatan_Bahagian', 'LIKE', "%{$searchQuery}%")
            ->first();

        if ($record) {
            return redirect()->route('status-jawatan.show', ['kod_jawatan' => $record->Kod_Jawatan]);
        }

        return redirect()->back()->withErrors(['error' => 'Tiada rekod dijumpai.']);
    }
}