<?php

namespace App\Http\Controllers;

//Non-Teaching
use App\Models\SPJ;
use App\Models\Prestasi;
use App\Models\TempatBertugas;
use App\Models\UlasanBersara;
use App\Models\KenaikanGaji;
use App\Models\CutiPJawatan;
use App\Models\AnugerahPJawatan;

// export excel for non teaching
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SpjExport;

//Teaching 
use App\Models\PemegangJawatanTeach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; 
use Illuminate\Support\Facades\Log;

class PemegangJawatanController extends Controller
{
   // Non-teaching export Excel (export for teaching is in teachercontroller)
// FIXED VERSION - Corrects tarikh bersara filter, status display, and umur filter
// Replace your existing export() method with this

// Shared by export() and the dashboard report: applies the same
// standardization + filters to the non-teaching SPJ dataset.

// Shared by export() and the dashboard report: applies the same
// standardization + filters to the non-teaching SPJ dataset.
private function getFilteredSpjs(Request $request)
{
    $jawatan = $request->get('jawatan');
    $jantina = $request->get('jantina');
    $divisyen = $request->get('divisyen');
    $jenisTanggagaji = $request->get('jenisTanggagaji');
    $tanggagajiSebenar = $request->get('tanggagajiSebenar');
    $umurMin = $request->get('umurMin');
    $umurMax = $request->get('umurMax');
    $tarikhBersaraFrom = $request->get('tarikhBersaraFrom');
    $cawanganDaerah = $request->get('cawanganDaerah');
    $kelulusan = $request->get('kelulusan');
    $jabatan = $request->get('jabatan');
    $status = $request->get('status');

    $spjs = DB::table('spjs')
        ->select(
            'nama',
            'noKadPintar',
            'kodSJ',
            'noMobile',
            'noTelefon',
            'emel',
            DB::raw("LTRIM(RTRIM(REPLACE([Text167], 'Jawatan Sekarang:', ''))) as jawatan"),
            'jantina',
            'jawatanBahagian as divisyen',
            'jenisTanggagaji',
            'tanggagajiSebenar',
            'tarikhLahir',
            'tatatertib',
            'tarikhBersara',
            'daerah as cawanganDaerah',
            'kelulusanTertinggi as kelulusan',
            'text322 as jabatan',
            DB::raw("DATEDIFF(YEAR, tarikhLahir, GETDATE()) as umur")
        )->get()
        ->map(function($item) {

            // ---------- Standardize kelulusan ----------
            $kelStd = strtolower(trim($item->kelulusan ?? ''));
            if (preg_match('/\b(phd|doctor of|doktor falsafah)\b/', $kelStd)) $item->kelulusan_std = 'PhD';
            elseif (preg_match('/\b(pgce|pgde|postgraduate certificate in education)\b/', $kelStd)) $item->kelulusan_std = 'PGCE';
            elseif (preg_match('/\b(master|ma\b|m\.sc\b|m\.ed\b|msc\b|med\b|master of|sarjana(?!\s*muda))\b/', $kelStd)) $item->kelulusan_std = 'Master';
            elseif (preg_match('/\b(bachelor|b\.a\b|b\.ed\b|b\.eng\b|b\.sc\b|ba\b|bsc\b|bed\b|beng\b|btech|degree|sarjana muda|b\.ac\b)\b/', $kelStd)) $item->kelulusan_std = 'Degree';
            elseif (preg_match('/\b(higher\s*diploma|higher\s*national\s*diploma|hnd|bdtvec)\b/', $kelStd)) $item->kelulusan_std = 'Higher Diploma';
            elseif (preg_match('/\bbtec\b/', $kelStd)) $item->kelulusan_std = 'BTEC';
            elseif (preg_match('/\b(diploma|dip(?!loma))\b/', $kelStd)) $item->kelulusan_std = 'Diploma';
            elseif (preg_match('/\b(nd|national diploma)\b/', $kelStd)) $item->kelulusan_std = 'ND';
            elseif (preg_match('/\b(sijil|certificate)\b/', $kelStd)) $item->kelulusan_std = 'Certificate';
            elseif (preg_match('/\b(o[-\s]?level|gce o)\b/', $kelStd)) $item->kelulusan_std = 'O Level';
            elseif (preg_match('/\b(a[-\s]?level|gce a)\b/', $kelStd)) $item->kelulusan_std = 'A Level';
            else $item->kelulusan_std = null;

            // Store the DB tarikhBersara first (tatatertib override)
            $item->tarikhBersaraOverride = $item->tarikhBersara ?? null;

            if ($item->tarikhLahir) {
                try {
                    $birthDate = \Carbon\Carbon::parse($item->tarikhLahir);
                    $item->umur = $birthDate->age;
                    $item->tarikhBersara_carbon = $birthDate->copy()->addYears(60);

                    // Calculate default retirement date (birth + 60)
                    $item->tarikhBersaraDefault = $item->tarikhBersara_carbon->format('Y-m-d');

                    // Use override if exists, otherwise use default
                    $item->tarikhBersara = $item->tarikhBersaraOverride ?? $item->tarikhBersaraDefault;

                } catch (\Exception $e) {
                    $item->umur = null;
                    $item->tarikhBersara = $item->tarikhBersaraOverride;
                    $item->tarikhBersaraDefault = null;
                    $item->tarikhBersara_carbon = null;
                }
            } else {
                $item->umur = null;
                $item->tarikhBersara = $item->tarikhBersaraOverride;
                $item->tarikhBersaraDefault = null;
                $item->tarikhBersara_carbon = null;
            }

            // ---------- Standardize divisyen ----------
            if ($item->divisyen) {
                $val = strtolower(trim($item->divisyen));
                if (str_contains($val, 'i') && !str_contains($val, 'ii')) $item->divisyen = 'I';
                elseif (str_contains($val, 'ii') && !str_contains($val, 'iii')) $item->divisyen = 'II';
                elseif (str_contains($val, 'iii') && !str_contains($val, 'iv')) $item->divisyen = 'III';
                elseif (str_contains($val, 'iv') && !str_contains($val, 'v')) $item->divisyen = 'IV';
                elseif (str_contains($val, 'v')) $item->divisyen = 'V';
                else $item->divisyen = null;
            }

            // ---------- Standardize jawatan ----------
            if ($item->jawatan) {
                $val = strtolower(trim($item->jawatan));

                // Separate special case first
                if (str_contains($val, 'ketua tukang masak')) $item->jawatan_std = 'Ketua Tukang Masak';
                else {
                    $mapping = [
                        'guru' => 'Guru',
                        'pegawai' => 'Pegawai',
                        'kerani' => 'Kerani',
                        'buruh' => 'Buruh',
                        'juru ukur bahan' => 'Juru Ukur Bahan',
                        'pembantu' => 'Pembantu',
                        'pengajar' => 'Pengajar',
                        'penolong' => 'Penolong',
                        'penolog' => 'Penolong',
                        'tukang kayu' => 'Tukang Kayu',
                        'tukang kebun' => 'Tukang Kebun',
                        'jurutera' => 'Jurutera',
                        'open vote' => 'Open Vote',
                        'operator telefon' => 'Operator Telefon',
                        'penjaga keselamatan' => 'Penjaga Keselamatan',
                        'sebulan ke sebulan' => 'Sebulan Ke Sebulan',
                        'pengawas' => 'Pengawas',
                        'pemandu' => 'Pemandu',
                        'pengarah' => 'Pengarah',
                        'pengetua' => 'Pengetua',
                        'penyelenggara' => 'Penyelenggara',
                        'timbalan pengetua' => 'Timbalan Pengetua',
                        'setiausaha' => 'Setiausaha',
                        'penyelia' => 'Penyelia',
                        'tukang masak' => 'Tukang Masak',
                    ];

                    $found = false;
                    foreach ($mapping as $keyword => $standard) {
                        if (str_contains($val, $keyword)) {
                            $item->jawatan_std = $standard;
                            $found = true;
                            break;
                        }
                    }

                    if (!$found) $item->jawatan_std = ucwords($val);
                }
            } else $item->jawatan_std = null;

            return $item;
        });

    // ---------- Apply filters (skip if value is 'all') ----------
    if ($kelulusan && $kelulusan !== 'all') {
        $spjs = $spjs->filter(fn($i) => trim(strtolower($i->kelulusan_std)) === trim(strtolower($kelulusan)));
    }
    if ($jawatan && $jawatan !== 'all') {
        $spjs = $spjs->filter(fn($i) => $i->jawatan_std && stripos($i->jawatan_std, $jawatan) !== false);
    }
    if ($jantina && $jantina !== 'all') {
        $spjs = $spjs->filter(fn($i) => trim(strtolower($i->jantina)) === trim(strtolower($jantina)));
    }
    if ($divisyen && $divisyen !== 'all') {
        $spjs = $spjs->filter(fn($i) => trim(strtoupper($i->divisyen)) === trim(strtoupper($divisyen)));
    }
    if ($jenisTanggagaji && $jenisTanggagaji !== 'all') {
        $spjs = $spjs->filter(fn($i) => stripos($i->jenisTanggagaji, $jenisTanggagaji) !== false);
    }
    if ($tanggagajiSebenar && $tanggagajiSebenar !== 'all') {
        $spjs = $spjs->filter(fn($i) => stripos($i->tanggagajiSebenar, $tanggagajiSebenar) !== false);
    }
    if ($cawanganDaerah && $cawanganDaerah !== 'all') {
        $spjs = $spjs->filter(fn($i) => stripos($i->cawanganDaerah, $cawanganDaerah) !== false);
    }
    if ($jabatan && $jabatan !== 'all') {
        $spjs = $spjs->filter(fn($i) => trim(strtolower($i->jabatan)) === trim(strtolower($jabatan)));
    }

    // ✅ FIX #3: Umur range filtering - Store umurMin/Max for Excel display
    if ($umurMin || $umurMax) {
        $spjs = $spjs->filter(function($i) use ($umurMin, $umurMax) {
            if (!$i->umur) return false;
            if ($umurMin && $i->umur < $umurMin) return false;
            if ($umurMax && $i->umur > $umurMax) return false;
            return true;
        });
    }

    // ✅ FIX #1: Tarikh bersara filtering - Use date comparison, not isSameDay
    if ($tarikhBersaraFrom) {
        $fromDate = \Carbon\Carbon::parse($tarikhBersaraFrom);
        $spjs = $spjs->filter(function($i) use ($fromDate) {
            if (!$i->tarikhBersara) return false;
            try {
                $itemDate = \Carbon\Carbon::parse($i->tarikhBersara);
                // Match year, month, and day
                return $itemDate->year === $fromDate->year
                    && $itemDate->month === $fromDate->month
                    && $itemDate->day === $fromDate->day;
            } catch (\Exception $e) {
                return false;
            }
        });
    }

    // Status filtering (skip if value is 'all')
    if ($status && $status !== 'all') {
        $spjs = $spjs->filter(function($item) use ($status) {
            $umur = $item->umur ?? null;
            $tatatertib = $item->tatatertib ?? 0;
            $tarikhBersara = $item->tarikhBersara ?? null;

            if ($umur === null) {
                return false;
            }

            if ($status === 'Active') {
                if ($umur >= 60) {
                    return false;
                }

                if ($tatatertib == 1 && $tarikhBersara) {
                    try {
                        $bersaraDate = \Carbon\Carbon::parse($tarikhBersara);
                        $today = \Carbon\Carbon::now();

                        if ($bersaraDate->isPast()) {
                            return false;
                        }
                    } catch (\Exception $e) {
                        // ignore
                    }
                }

                return true;

            } elseif ($status === 'Retired') {
                if ($umur < 60) {
                    return false;
                }

                if ($tatatertib == 1 && $tarikhBersara) {
                    try {
                        $bersaraDate = \Carbon\Carbon::parse($tarikhBersara);
                        $today = \Carbon\Carbon::now();

                        if ($bersaraDate->isPast()) {
                            return false;
                        }
                    } catch (\Exception $e) {
                        // ignore
                    }
                }

                return true;

            } elseif ($status === 'Inactive') {
                if ($tatatertib != 1 || !$tarikhBersara) {
                    return false;
                }

                try {
                    $bersaraDate = \Carbon\Carbon::parse($tarikhBersara);
                    $today = \Carbon\Carbon::now();

                    return $bersaraDate->isPast();
                } catch (\Exception $e) {
                    return false;
                }
            }

            return true;
        });
    }

    return $spjs;
}

public function export(Request $request)
{
    $jawatan = $request->get('jawatan');
    $jantina = $request->get('jantina');
    $divisyen = $request->get('divisyen');
    $jenisTanggagaji = $request->get('jenisTanggagaji');
    $tanggagajiSebenar = $request->get('tanggagajiSebenar');
    $umurMin = $request->get('umurMin');
    $umurMax = $request->get('umurMax');
    $tarikhBersaraFrom = $request->get('tarikhBersaraFrom');
    $cawanganDaerah = $request->get('cawanganDaerah');
    $kelulusan = $request->get('kelulusan');
    $jabatan = $request->get('jabatan');
    $status = $request->get('status');

    $spjs = $this->getFilteredSpjs($request);

    // ---------- Generate filename with "all" options ----------
    $filename = 'non-teaching-staff';
    
    if ($jawatan) {
        $filename .= ($jawatan === 'all') ? '-all-jawatan' : '-' . str_replace(['/', '\\', ' '], '-', strtolower($jawatan));
    }
    if ($jantina) {
        $filename .= ($jantina === 'all') ? '-all-jantina' : '-' . str_replace(['/', '\\', ' '], '-', strtolower($jantina));
    }
    if ($divisyen) {
        $filename .= ($divisyen === 'all') ? '-all-divisyen' : '-' . str_replace(['/', '\\', ' '], '-', strtolower($divisyen));
    }
    if ($jenisTanggagaji) {
        $filename .= ($jenisTanggagaji === 'all') ? '-all-jenis-tanggagaji' : '-' . str_replace(['/', '\\', ' '], '-', strtolower($jenisTanggagaji));
    }
    if ($tanggagajiSebenar) {
        $filename .= ($tanggagajiSebenar === 'all') ? '-all-tanggagaji-sebenar' : '-' . str_replace(['/', '\\', ' '], '-', strtolower($tanggagajiSebenar));
    }
    if ($cawanganDaerah) {
        $filename .= ($cawanganDaerah === 'all') ? '-all-cawangan-daerah' : '-' . str_replace(['/', '\\', ' '], '-', strtolower($cawanganDaerah));
    }
    if ($kelulusan) {
        $filename .= ($kelulusan === 'all') ? '-all-kelulusan' : '-' . str_replace(['/', '\\', ' '], '-', strtolower($kelulusan));
    }
    if ($jabatan) {
        $filename .= ($jabatan === 'all') ? '-all-jabatan' : '-' . str_replace(['/', '\\', ' '], '-', strtolower($jabatan));
    }
    if ($status) {
        $filename .= ($status === 'all') ? '-all-status' : '-' . str_replace(['/', '\\', ' '], '-', strtolower($status));
    }
    
    if ($umurMin || $umurMax) {
        $filename .= '-umur' . ($umurMin ? '-min'.$umurMin : '') . ($umurMax ? '-max'.$umurMax : '');
    }
    if ($tarikhBersaraFrom) {
        $filename .= '-bersara-from' . str_replace('-', '', $tarikhBersaraFrom);
    }
    
    $filename .= '.xlsx';
    
    // ✅ FIX #2 & #3: Pass umur and tarikhBersara filters to Excel so Status/Umur/Tarikh Bersara columns appear
    return Excel::download(
        new SpjExport(
            $spjs,
            $jawatan,
            $jantina,
            $divisyen,
            $jenisTanggagaji,
            $tanggagajiSebenar,
            $cawanganDaerah,
            $kelulusan,
            $jabatan,
            $status,
            $umurMin,
            $umurMax,
            $tarikhBersaraFrom
        ),
        $filename
    );
}

// ---------------------------------------------------------------
// Non-Teaching Dashboard Report (same filters as the Export Excel
// modal, rendered as summary counts + charts instead of a download)
// ---------------------------------------------------------------
public function nonTeachingReport()
{
    $jawatanOptions = SPJ::select('Text167')->distinct()->whereNotNull('Text167')->where('Text167', '!=', '')->pluck('Text167')->map(fn($v) => ucwords(strtolower(trim($v))))->unique()->sort()->values();
    $divisyenOptions = SPJ::select('jawatanBahagian')->distinct()->whereNotNull('jawatanBahagian')->where('jawatanBahagian', '!=', '')->pluck('jawatanBahagian')->map(fn($v) => ucwords(strtolower(trim($v))))->unique()->sort()->values();
    $jenisTanggagajiOptions = SPJ::select('jenisTanggagaji')->distinct()->whereNotNull('jenisTanggagaji')->where('jenisTanggagaji', '!=', '')->pluck('jenisTanggagaji')->map(fn($v) => trim($v))->unique()->sort()->values();
    $tanggagajiSebenarOptions = SPJ::select('tanggagajiSebenar')->distinct()->whereNotNull('tanggagajiSebenar')->where('tanggagajiSebenar', '!=', '')->pluck('tanggagajiSebenar')->map(fn($v) => trim($v))->unique()->sort()->values();
    $daerahOptions = ['Brunei Muara', 'Tutong', 'Temburong', 'Kuala-Belait'];
    $kelulusanOptions = ['PhD', 'PGCE', 'Master', 'Degree', 'Higher Diploma', 'BTEC', 'Diploma', 'ND', 'Certificate', 'O Level', 'A Level'];
    $jabatanOptions = SPJ::select('text322')->distinct()->whereNotNull('text322')->where('text322', '!=', '')->pluck('text322')->map(fn($v) => ucwords(strtolower(trim($v))))->unique()->sort()->values();

    return view('hrs.pemegang-jawatan.report', compact(
        'jawatanOptions',
        'divisyenOptions',
        'jenisTanggagajiOptions',
        'tanggagajiSebenarOptions',
        'daerahOptions',
        'kelulusanOptions',
        'jabatanOptions'
    ));
}

public function nonTeachingReportData(Request $request)
{
    $spjs = $this->getFilteredSpjs($request);

    $total = $spjs->count();
    $avgAge = $total ? round($spjs->pluck('umur')->filter(fn($v) => $v !== null)->avg(), 1) : 0;

    $countBy = function (string $field, ?int $limit = null) use ($spjs) {
        $counts = $spjs
            ->groupBy(fn($i) => trim((string) ($i->{$field} ?? '')) !== '' ? $i->{$field} : 'Unknown')
            ->map->count()
            ->sortDesc();

        return $limit ? $counts->take($limit) : $counts;
    };

    $statusCounts = ['Active' => 0, 'Retired' => 0, 'Inactive' => 0, 'Unknown' => 0];
    $ageBuckets = ['<30' => 0, '30-39' => 0, '40-49' => 0, '50-59' => 0, '60+' => 0, 'Unknown' => 0];
    $retireBuckets = ['Within 1 year' => 0, '1-2 years' => 0, '2-5 years' => 0, '5+ years' => 0, 'Unknown' => 0];
    $now = Carbon::now();

    foreach ($spjs as $item) {
        $umur = $item->umur ?? null;
        $tatatertib = $item->tatatertib ?? 0;
        $tarikhBersara = $item->tarikhBersara ?? null;

        // ---- Status ----
        if ($umur === null) {
            $statusCounts['Unknown']++;
        } elseif ($tatatertib == 1 && $tarikhBersara && $this->isPastDate($tarikhBersara)) {
            $statusCounts['Inactive']++;
        } elseif ($umur >= 60) {
            $statusCounts['Retired']++;
        } else {
            $statusCounts['Active']++;
        }

        // ---- Age bucket ----
        if ($umur === null) $ageBuckets['Unknown']++;
        elseif ($umur < 30) $ageBuckets['<30']++;
        elseif ($umur < 40) $ageBuckets['30-39']++;
        elseif ($umur < 50) $ageBuckets['40-49']++;
        elseif ($umur < 60) $ageBuckets['50-59']++;
        else $ageBuckets['60+']++;

        // ---- Upcoming retirement timeline ----
        if (!$tarikhBersara) {
            $retireBuckets['Unknown']++;
            continue;
        }
        try {
            $months = $now->diffInMonths(Carbon::parse($tarikhBersara), false);
            if ($months < 0) $retireBuckets['Unknown']++;
            elseif ($months <= 12) $retireBuckets['Within 1 year']++;
            elseif ($months <= 24) $retireBuckets['1-2 years']++;
            elseif ($months <= 60) $retireBuckets['2-5 years']++;
            else $retireBuckets['5+ years']++;
        } catch (\Exception $e) {
            $retireBuckets['Unknown']++;
        }
    }

    return response()->json([
        'total' => $total,
        'avgAge' => $avgAge,
        'statusCounts' => $statusCounts,
        'ageBuckets' => $ageBuckets,
        'retireBuckets' => $retireBuckets,
        'byJantina' => $countBy('jantina'),
        'byDivisyen' => $countBy('divisyen'),
        'byJawatan' => $countBy('jawatan_std', 10),
        'byKelulusan' => $countBy('kelulusan_std'),
        'byJabatan' => $countBy('jabatan', 10),
        'byCawangan' => $countBy('cawanganDaerah'),
    ]);
}

private function isPastDate($date): bool
{
    try {
        return Carbon::parse($date)->isPast();
    } catch (\Exception $e) {
        return false;
    }
}

// Middleware for HRIDS
public function __construct()
{
    $this->middleware(['auth', 'role:ROLE_HRIDS,ROLE_HRIDS_NONTEACHING']);
}


// Landing page with search
 public function landingpage()
{
    // Teaching staff - SQL Server syntax
    $teachers = PemegangJawatanTeach::select(
        'Nama',
        DB::raw('[No Kad Pintar] as noKadPintar'),
        DB::raw("COALESCE(NULLIF(LTRIM(RTRIM([No Telefon])), ''), NULLIF(LTRIM(RTRIM([No Mobile])), '')) as noTelefon"),
        DB::raw("COALESCE(NULLIF(LTRIM(RTRIM([Email])), ''), NULLIF(LTRIM(RTRIM([Personal Email])), '')) as email"),
        DB::raw('[Jawatan di Sekolah] as jawatan'),
        DB::raw('Jantina as jantina')
    )->get()->map(function($t) {
        return [
            'noKadPintar' => $t->noKadPintar,
            'nama' => $t->Nama,
            'noTelefon' => $t->noTelefon,
            'email' => $t->email,
            'jawatan' => $t->jawatan,
            'jantina' => $t->jantina,
            'source' => 'teach',
        ];
    });

    // Non-teaching staff (SPJ)  
    $spjs = SPJ::select(
        'id',
        'nama',
        'noKadPintar',
        'kodSJ',
        DB::raw("COALESCE(NULLIF(LTRIM(RTRIM(noTelefon)), ''), NULLIF(LTRIM(RTRIM(noMobile)), '')) as noTelefon"),
        'emel as email'
    )->get()->map(function($s) {
        return [
            'id' => $s->id,
            'noKadPintar' => $s->noKadPintar,
            'nama' => $s->nama,
            'noTelefon' => $s->noTelefon,
            'email' => $s->email,
            'kodSJ' => $s->kodSJ,
            'source' => 'spjs',
        ];
    });

    // Merge both tables
    $datas = $teachers->concat($spjs);

    return view('hrs.pemegang-jawatan.landing', compact('datas'));
}

 // Teaching staff list
// Teaching staff list
public function teachingList()
{
    Log::info('=== TEACHING LIST METHOD STARTED ===');
    
    // Fetch teachers data for display WITH TATATERTIB FIELDS
    $teachers = PemegangJawatanTeach::select(
        'Nama',
        DB::raw('[No Kad Pintar] as noKadPintar'),
        DB::raw("COALESCE(NULLIF(LTRIM(RTRIM(CAST([No Telefon] AS NVARCHAR(MAX)))), ''), NULLIF(LTRIM(RTRIM(CAST([No Mobile] AS NVARCHAR(MAX)))), '')) as noTelefon"),
        DB::raw("COALESCE(NULLIF(LTRIM(RTRIM(CAST([Email] AS NVARCHAR(MAX)))), ''), NULLIF(LTRIM(RTRIM(CAST([Personal Email] AS NVARCHAR(MAX)))), '')) as email"),
        DB::raw('LTRIM(RTRIM(CAST([Jantina] AS NVARCHAR(50)))) as jantina'),
        DB::raw('[Sekolah Tempat Bertugas] as tempatBertugas'),
        'Daerah as daerah',
        DB::raw('[Kelulusan Tertnggi] as kelulusan'),
        DB::raw('[Tarikh Lahir] as tarikhLahir'),
        'tatatertib',                    // ✅ ADDED
        'tarikhBersaraOverride',         // ✅ ADDED
        'catatan_tatatertib',            // ✅ ADDED
        DB::raw("
            CASE 
                WHEN [Jawatan di Sekolah] IS NULL OR LTRIM(RTRIM(CAST([Jawatan di Sekolah] AS NVARCHAR(MAX)))) = '' THEN NULL
                WHEN LOWER(LTRIM(RTRIM(CAST([Jawatan di Sekolah] AS NVARCHAR(MAX))))) = 'gb' OR LOWER(LTRIM(RTRIM(CAST([Jawatan di Sekolah] AS NVARCHAR(MAX))))) LIKE '%guru besar%' THEN 'Guru Besar'
                WHEN LOWER(LTRIM(RTRIM(CAST([Jawatan di Sekolah] AS NVARCHAR(MAX))))) = 'pgb' 
                     OR LOWER(LTRIM(RTRIM(CAST([Jawatan di Sekolah] AS NVARCHAR(MAX))))) LIKE '%penolong gb%' 
                     OR LOWER(LTRIM(RTRIM(CAST([Jawatan di Sekolah] AS NVARCHAR(MAX))))) LIKE '%penolong guru besar%' THEN 'Penolong Guru Besar'
                ELSE LTRIM(RTRIM(CAST([Jawatan di Sekolah] AS NVARCHAR(MAX))))
            END as jawatan
        ")
    )->get()->map(function($teacher) {
        
        // Calculate age from Tarikh Lahir
        if ($teacher->tarikhLahir) {
            try {
                $birthDate = \Carbon\Carbon::parse($teacher->tarikhLahir);
                $teacher->umur = $birthDate->age;
                $teacher->tarikhBersara = $birthDate->copy()->addYears(60)->format('Y-m-d');
            } catch (\Exception $e) {
                $teacher->umur = null;
                $teacher->tarikhBersara = null;
            }
        } else {
            $teacher->umur = null;
            $teacher->tarikhBersara = null;
        }

        // 🔍 Log the specific Abdul we're looking for
        if ($teacher->noKadPintar === '00-260807(K)') {
            Log::info('=== 🎯 TARGET ABDUL (00-260807) FOUND ===', [
                'Nama' => $teacher->Nama,
                'noKadPintar' => $teacher->noKadPintar,
                'tatatertib' => $teacher->tatatertib,
                'tatatertib_type' => gettype($teacher->tatatertib),
                'tarikhBersaraOverride' => $teacher->tarikhBersaraOverride,
                'umur' => $teacher->umur,
                'tarikhLahir' => $teacher->tarikhLahir,
            ]);
        }

        return $teacher;
    });

    Log::info('=== LOADED ' . $teachers->count() . ' TEACHERS ===');

    // Fetch distinct options for dropdowns using direct DB queries
    $jawatanOptions = DB::table('pemegangjawatanteach')
        ->selectRaw("CASE 
            WHEN LOWER(LTRIM(RTRIM(CAST([Jawatan di Sekolah] AS NVARCHAR(MAX))))) LIKE '%guru besar%' 
                 OR LOWER(LTRIM(RTRIM(CAST([Jawatan di Sekolah] AS NVARCHAR(MAX))))) = 'gb'
            THEN 'Guru Besar'
            WHEN LOWER(LTRIM(RTRIM(CAST([Jawatan di Sekolah] AS NVARCHAR(MAX))))) LIKE '%penolong guru besar%' 
                 OR LOWER(LTRIM(RTRIM(CAST([Jawatan di Sekolah] AS NVARCHAR(MAX))))) LIKE '%penolong gb%' 
                 OR LOWER(LTRIM(RTRIM(CAST([Jawatan di Sekolah] AS NVARCHAR(MAX))))) = 'pgb'
            THEN 'Penolong Guru Besar'
            ELSE LTRIM(RTRIM(CAST([Jawatan di Sekolah] AS NVARCHAR(MAX))))
        END as jawatan")
        ->whereNotNull('Jawatan di Sekolah')
        ->where('Jawatan di Sekolah', '!=', '')
        ->distinct()
        ->orderBy('jawatan')
        ->pluck('jawatan')
        ->map(function ($val) {
            $val = preg_replace('/[^\PC\s]/u', '', $val);
            $val = trim(preg_replace('/\s+/', ' ', $val));
            $lower = strtolower($val);

            if ($lower === 'gb' || str_contains($lower, 'guru besar')) {
                return 'Guru Besar';
            }

            if ($lower === 'pgb' || str_contains($lower, 'penolong guru besar') || str_contains($lower, 'penolong gb')) {
                return 'Penolong Guru Besar';
            }

            return $val;
        })
        ->unique()
        ->sort()
        ->values();

    $jantinaOptions = DB::table('pemegangjawatanteach')
        ->whereNotNull('Jantina')
        ->where('Jantina', '!=', '')
        ->distinct()
        ->orderBy('Jantina')
        ->pluck('Jantina')
        ->unique()
        ->values();

    $tempatBertugasOptions = DB::table('pemegangjawatanteach')
        ->whereNotNull('Sekolah Tempat Bertugas')
        ->where('Sekolah Tempat Bertugas', '!=', '')
        ->distinct()
        ->orderBy('Sekolah Tempat Bertugas')
        ->pluck('Sekolah Tempat Bertugas')
        ->unique()
        ->values();

    $daerahOptions = DB::table('pemegangjawatanteach')
        ->whereNotNull('Daerah')
        ->where('Daerah', '!=', '')
        ->distinct()
        ->orderBy('Daerah')
        ->pluck('Daerah')
        ->unique()
        ->values();

    $kelulusanOptions = DB::table('pemegangjawatanteach')
        ->whereNotNull('Kelulusan Tertnggi')
        ->where('Kelulusan Tertnggi', '!=', '')
        ->distinct()
        ->orderBy('Kelulusan Tertnggi')
        ->pluck('Kelulusan Tertnggi')
        ->unique()
        ->values();

    return view('hrs.pemegang-jawatan.indexteach', compact(
        'teachers', 
        'jawatanOptions', 
        'jantinaOptions', 
        'tempatBertugasOptions', 
        'daerahOptions', 
        'kelulusanOptions'
    ));
}
    

// Non teaching staff list
public function index(Request $request)
{
    // Fetch all SPJ records WITH TATATERTIB FIELDS ADDED
    $spjs = SPJ::select(
        'id',
        'nama',
        'noKadPintar',
        'kodSJ',
        'noTelefon',
        'noMobile',
        'emel',
        'Text167 as jawatan',
        'jantina',
        'jawatanBahagian as divisyen',
        'jenisTanggagaji',
        'tanggagajiSebenar',
        'tarikhLahir',  // YOUR EXISTING LINE
        'tatatertib',              // ✅ ONLY ADDED THIS
        'tarikhBersara',           // ✅ ONLY ADDED THIS (used for override when tatatertib=1)
        'catatanTatatertib',       // ✅ ONLY ADDED THIS
        'daerah as cawanganDaerah',
        'kelulusanTertinggi as kelulusan',
        'text322 as jabatan'
    )->get()->map(function($spj) {

        // YOUR EXISTING LOGIC - COMPLETELY UNTOUCHED
        // Calculate age and retirement
        if ($spj->tarikhLahir) {
            $birthDate = \Carbon\Carbon::parse($spj->tarikhLahir);
            $spj->umur = $birthDate->age;
            
            // ✅ ONLY MODIFIED THIS LINE - Calculate default retirement (not override)
            $spj->defaultTarikhBersara = $birthDate->copy()->addYears(60)->format('Y-m-d');
        } else {
            $spj->umur = null;
            $spj->defaultTarikhBersara = null;  // ✅ Changed from tarikhBersara to defaultTarikhBersara
        }

        // YOUR EXISTING KELULUSAN LOGIC - COMPLETELY UNTOUCHED
        // Standardize kelulusan
        $kel = strtolower(trim($spj->kelulusan ?? ''));

        if (preg_match('/\b(phd|doctor of|doktor falsafah)\b/', $kel)) {
            $spj->kelulusan_std = 'PhD';
        } elseif (preg_match('/\b(pgce|pgde|postgraduate certificate in education)\b/', $kel)) {
            $spj->kelulusan_std = 'PGCE';
        } elseif (preg_match('/\b(master|ma\b|m\.sc\b|m\.ed\b|msc\b|med\b|master of|sarjana(?!\s*muda))\b/', $kel)) {
            $spj->kelulusan_std = 'Master';
        } elseif (preg_match('/\b(bachelor|b\.a\b|b\.ed\b|b\.eng\b|b\.sc\b|ba\b|bsc\b|bed\b|beng\b|btech|degree|sarjana muda|b\.ac\b)\b/', $kel)) {
            $spj->kelulusan_std = 'Degree';
        } elseif (preg_match('/\b(higher\s*diploma|higher\s*national\s*diploma|hnd|bdtvec)\b/', $kel)) {
            $spj->kelulusan_std = 'Higher Diploma';
        } elseif (preg_match('/\bbtec\b/', $kel)) {
            $spj->kelulusan_std = 'BTEC';
        } elseif (preg_match('/\b(diploma|dip(?!loma))\b/', $kel)) {
            $spj->kelulusan_std = 'Diploma';
        } elseif (preg_match('/\b(nd|national diploma)\b/', $kel)) {
            $spj->kelulusan_std = 'ND';
        } elseif (preg_match('/\b(sijil|certificate)\b/', $kel)) {
            $spj->kelulusan_std = 'Certificate';
        } elseif (preg_match('/\b(o[-\s]?level|gce o)\b/', $kel)) {
            $spj->kelulusan_std = 'O Level';
        } elseif (preg_match('/\b(a[-\s]?level|gce a)\b/', $kel)) {
            $spj->kelulusan_std = 'A Level';
        } else {
            $spj->kelulusan_std = null;
        }

        return $spj;
    });

    // YOUR EXISTING DROPDOWN LOGIC - COMPLETELY UNTOUCHED
    // Build kelulusan dropdown dynamically based on actual data
    $kelulusanOptions = $spjs->pluck('kelulusan_std')->filter()->unique()->sort()->values();

    // Dropdowns
    $jawatanOptions = SPJ::select('Text167')->distinct()->whereNotNull('Text167')->where('Text167','!=','')->pluck('Text167')->map(fn($v) => ucwords(strtolower(trim($v))))->unique()->sort()->values();
    $divisyenOptions = SPJ::select('jawatanBahagian')->distinct()->whereNotNull('jawatanBahagian')->where('jawatanBahagian','!=','')->pluck('jawatanBahagian')->map(fn($v) => ucwords(strtolower(trim($v))))->unique()->sort()->values();
    $jenisTanggagajiOptions = SPJ::select('jenisTanggagaji')->distinct()->whereNotNull('jenisTanggagaji')->where('jenisTanggagaji','!=','')->pluck('jenisTanggagaji')->map(fn($v) => trim($v))->unique()->sort()->values();
    $tanggagajiSebenarOptions = SPJ::select('tanggagajiSebenar')->distinct()->whereNotNull('tanggagajiSebenar')->where('tanggagajiSebenar','!=','')->pluck('tanggagajiSebenar')->map(fn($v) => trim($v))->unique()->sort()->values();

    // Only 4 regions
    $daerahOptions = ['Brunei Muara','Tutong','Temburong','Kuala-Belait'];

    $jabatanOptions = SPJ::select('text322')->distinct()->whereNotNull('text322')->where('text322','!=','')->pluck('text322')->map(fn($v) => ucwords(strtolower(trim($v))))->unique()->sort()->values();

    return view('hrs.pemegang-jawatan.index', compact(
        'spjs',
        'jawatanOptions',
        'divisyenOptions',
        'jenisTanggagajiOptions',
        'tanggagajiSebenarOptions',
        'daerahOptions',
        'kelulusanOptions',
        'jabatanOptions'
    ));
}







// Teaching staff show
public function showTeaching($ic)
{
    try {
        $teacher = PemegangJawatanTeach::whereRaw("[No Kad Pintar] = ?", [$ic])->firstOrFail();

        // Default: Tarikh Lahir + 60 years (ignore DB Tarikh Tamat Kontrak column)
        $defaultTarikhTamat = '';

        if (!empty($teacher->{'Tarikh Lahir'})) {
            // Try d/m/Y like "9/8/2033" first, then fallback to generic parse
            try {
                $born = \Carbon\Carbon::createFromFormat('j/n/Y', $teacher->{'Tarikh Lahir'});
            } catch (\Exception $e) {
                try {
                    $born = \Carbon\Carbon::parse($teacher->{'Tarikh Lahir'});
                } catch (\Exception $e2) {
                    $born = null;
                }
            }

            if ($born) {
                $defaultTarikhTamat = $born->copy()->addYears(60)->format('Y-m-d'); // ISO for date inputs
            }
        }

        $teacher->defaultTarikhTamat = $defaultTarikhTamat;

        return view('hrs.pemegang-jawatan.showteaching', compact('teacher'));

    } catch (\Exception $e) {
        \Log::error('Teacher not found: ' . $e->getMessage());
        return redirect()->route('pj.teaching.list')->with('error', 'Teacher profile not found.');
    }
}

   // Add this helper method to your controller class (at the top, after class declaration)
private function formatDateForFlatpickr($date)
{
    // Return empty for null/empty values
    if (empty($date) || $date === null || $date === '' || trim($date) === '') {
        return '';
    }
    
    try {
        // Remove any extra whitespace and weird characters
        $date = trim(preg_replace('/[^\x20-\x7E]/', '', $date));
        
        // If date is already in Y-m-d format, return as-is
        if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            return $date;
        }
        
        // Try strtotime first (most forgiving)
        $timestamp = @strtotime($date);
        if ($timestamp !== false && $timestamp > 0) {
            return date('Y-m-d', $timestamp);
        }
        
        // If strtotime fails, return empty
        return '';
        
    } catch (\Throwable $e) {
        // Catch ANY error and return empty silently
        \Log::debug("formatDateForFlatpickr silent fail for: '$date'");
        return '';
    }
}
// Non teaching staff show
public function show($id)
{
    try {
        $spj = SPJ::findOrFail($id);

        // FORMAT ALL DATES FOR FLATPICKR - COMPREHENSIVE LIST
        $spj->tarikhMinjamFail_formatted = $this->formatDateForFlatpickr($spj->tarikhMinjamFail ?? '');
        $spj->tarikhMulaBerkhidmat_formatted = $this->formatDateForFlatpickr($spj->tarikhMulaBerkhidmat ?? '');
        $spj->tarikhJawatanSekarang_formatted = $this->formatDateForFlatpickr($spj->tarikhJawatanSekarang ?? '');
        $spj->tarikhLantikanKBT_formatted = $this->formatDateForFlatpickr($spj->tarikhLantikanKBT ?? '');
        $spj->tarikhDiaturBertugasSekarang_formatted = $this->formatDateForFlatpickr($spj->tarikhDiaturBertugasSekarang ?? '');
        $spj->tarikhLahir_formatted = $this->formatDateForFlatpickr($spj->tarikhLahir ?? '');
        $spj->tarikhBukuBankActive_formatted = $this->formatDateForFlatpickr($spj->tarikhBukuBankActive ?? '');
        
        $spj->tarikhTamatKontrak_formatted = $this->formatDateForFlatpickr($spj->tarikhTamatKontrak ?? '');
        $spj->tarikhUpdate_formatted = $this->formatDateForFlatpickr($spj->tarikhUpdate ?? '');

       // CALCULATE TARIKH BERSARA (Tarikh Lahir + 60 years) - only if not manually set
if (!empty($spj->tarikhBersara)) {
    // Use the manually saved tarikhBersara (from tatatertib override)
    $spj->tarikhBersara_formatted = $spj->tarikhBersara;
} elseif (!empty($spj->tarikhLahir_formatted)) {
    // Calculate from birth date + 60 years
    try {
        $birthDate = new \DateTime($spj->tarikhLahir_formatted);
        $birthDate->modify('+60 years');
        $spj->tarikhBersara_formatted = $birthDate->format('Y-m-d');
    } catch (\Exception $e) {
        \Log::error("Error calculating tarikhBersara for ID {$id}: " . $e->getMessage());
        $spj->tarikhBersara_formatted = '';
    }
} else {
    $spj->tarikhBersara_formatted = '';
}

        $totalPost = SPJ::where('kodSJ', $spj->kodSJ)->count();
        
        $jawatanSebenar = SPJ::where('noKadPintar', $spj->noKadPintar)
            ->distinct()
            ->pluck('Text242')
            ->filter()
            ->implode(', ');

        $jawatanOptions = SPJ::where('noKadPintar', $spj->noKadPintar)
            ->distinct()->pluck('Text224')->filter()->implode(', ');

        $failRujukan = SPJ::where('noKadPintar', $spj->noKadPintar)
            ->distinct()->pluck('rujukanFile')->filter()->implode(', ');

        $tarikhMinjamFail = SPJ::where('noKadPintar', $spj->noKadPintar)
            ->distinct()->pluck('tarikhMinjamFail')->filter()->implode(', ');

        $divisyen = SPJ::where('noKadPintar', $spj->noKadPintar)
            ->distinct()->pluck('Text236')->filter()->implode(', ');

        $jenisTanggagaji = SPJ::where('noKadPintar', $spj->noKadPintar)
            ->distinct()->pluck('jenisTanggagaji')->filter()->implode(', ');

        $tanggagajiSebenar = SPJ::where('noKadPintar', $spj->noKadPintar)
            ->distinct()->pluck('tanggagajiSebenar')->filter()->implode(', ');

        $Text228 = SPJ::where('noKadPintar', $spj->noKadPintar)
            ->distinct()->pluck('Text228')->filter()->implode(', ');

        $daerah = SPJ::where('noKadPintar', $spj->noKadPintar)
            ->distinct()->pluck('daerah')->filter()->implode(', ');

        $jenisSekolahOptions = SPJ::distinct()->pluck('Combo317')->filter();
        $sekolahOptions = SPJ::select('Combo244')->distinct()->pluck('Combo244')->filter();
        $jabatanOptions = SPJ::distinct()->pluck('jabatanTempatBertugas')->filter();
        $bahagianOptions = SPJ::distinct()->pluck('bahagianTempatBertugas')->filter();
        $unitOptions = SPJ::whereNotNull('unitTempatBertugas')
                  ->distinct()
                  ->pluck('unitTempatBertugas')
                  ->filter()
                  ->sort()
                  ->values();
        $jenisPerkhidmatanOptions = SPJ::select('Combo230')->distinct()->pluck('Combo230');
        $summarizeYesNo = SPJ::select('Text260')->distinct()->pluck('Text260');
        $edpmmo = SPJ::distinct()->pluck('teach')->filter();
        $cep = SPJ::distinct()->pluck('GO')->filter();

        $tarikhMemangku = !empty($spj->mulaiActing) 
            ? $this->formatDateForFlatpickr($spj->mulaiActing)
            : '';

        $filterBersaraOptions = SPJ::select('Combo251')->distinct()->pluck('Combo251')->filter();

        $kursus = DB::table('kursus')->get();

        $prestasiRows = DB::table('prestasi_nonteaching as p')
        ->join('spjs as s', 'p.Text163', '=', 's.Text163')  // ✅ Use Text163, not id_prestasi
        ->where('s.noKadPintar', $spj->noKadPintar)
        ->select('p.Tahun as tahun', 'p.Gred as gred', 'p.Percentage as percentage')
        ->get();

        $anugerahRows = AnugerahPJawatan::where('pemegang_jawatan_id', $id)
        ->orderBy('id', 'asc')
        ->get();

       $kursusRows = DB::table('Kursus')
        ->where('Code_kursus', $spj->Text163)
        ->select(
            'Code_kursus as code',
            'NamaKursus as nama',
            'TempatKursus as tempat',
            'Mulai as mulai',
            'Hingga as hingga'
        )
        ->get()
        ->map(function($row) {
        // Try to format dates - handle both m/d/Y and Y-m-d formats
        if (!empty($row->mulai) && $row->mulai !== null) {
            $mulaiTrimmed = trim($row->mulai);
            try {
                // Try m/d/Y format first (old data)
                if (strpos($mulaiTrimmed, '/') !== false) {
                    $row->mulai = \Carbon\Carbon::createFromFormat('m/d/Y', $mulaiTrimmed)->format('Y-m-d');
                } 
                // Try Y-m-d format (new data)
                else if (strpos($mulaiTrimmed, '-') !== false) {
                    $row->mulai = \Carbon\Carbon::createFromFormat('Y-m-d', $mulaiTrimmed)->format('Y-m-d');
                } else {
                    $row->mulai = '';
                }
            } catch (\Exception $e) {
                $row->mulai = '';
            }
        } else {
            $row->mulai = '';
        }
        
        if (!empty($row->hingga) && $row->hingga !== null) {
            $hinggaTrimmed = trim($row->hingga);
            try {
                // Try m/d/Y format first (old data)
                if (strpos($hinggaTrimmed, '/') !== false) {
                    $row->hingga = \Carbon\Carbon::createFromFormat('m/d/Y', $hinggaTrimmed)->format('Y-m-d');
                } 
                // Try Y-m-d format (new data)
                else if (strpos($hinggaTrimmed, '-') !== false) {
                    $row->hingga = \Carbon\Carbon::createFromFormat('Y-m-d', $hinggaTrimmed)->format('Y-m-d');
                } else {
                    $row->hingga = '';
                }
            } catch (\Exception $e) {
                $row->hingga = '';
            }
        } else {
            $row->hingga = '';
        }
        
        return $row;
    });

        $gaji2019 = DB::table('gaji2019 as g')
            ->join('spjs as s', 'g.ID', '=', 's.Text163')
            ->where('s.noKadPintar', $spj->noKadPintar)
            ->select('g.Tahun as tahun','g.Gaji as gaji')
            ->get();
            
        // Load matrix jawatan data
        $matrixRows = DB::table('matrix_jawatan')
            ->where('spj_id', $id)
            ->orderBy('id')
            ->get();

        // Load kenaikan gaji records
        $kenaikanGajiRows = KenaikanGaji::where('pemegang_jawatan_id', $id)
            ->orderBy('tahun', 'asc')
            ->get();

        // Load cuti khas records
        $cutiKhasRows = CutiPJawatan::where('pemegang_jawatan_id', $id)
            ->where('jenis_cuti', 'khas')
            ->orderBy('id')
            ->get();

        // Load cuti tanpa gaji records
        $cutiTanpaGajiRows = CutiPJawatan::where('pemegang_jawatan_id', $id)
            ->where('jenis_cuti', 'tanpa_gaji')
            ->orderBy('id')
            ->get();
            
        // Load tempat bertugas records
        $tempatBertugasRows = TempatBertugas::where('spj_id', $id)->orderBy('id')->get();
            
        // Load ulasan bersara records
        $ulasanBersaraRows = UlasanBersara::where('spj_id', $id)->orderBy('id')->get();
        return view('hrs.pemegang-jawatan.show', compact(
            'spj','id','totalPost','jawatanOptions','failRujukan','tarikhMinjamFail',
            'divisyen','jenisTanggagaji','Text228','tanggagajiSebenar','daerah',
            'jenisSekolahOptions','sekolahOptions','jabatanOptions','bahagianOptions',
            'unitOptions','jenisPerkhidmatanOptions','summarizeYesNo','edpmmo','cep',
            'tarikhMemangku','filterBersaraOptions','kursus','prestasiRows','kursusRows',
            'gaji2019','jawatanSebenar','matrixRows','tempatBertugasRows','ulasanBersaraRows',
            'kenaikanGajiRows','cutiKhasRows','cutiTanpaGajiRows','anugerahRows'
        ));
        
    } catch (\Throwable $e) {
        \Log::error('Error in show() method: ' . $e->getMessage());
        \Log::error('Stack trace: ' . $e->getTraceAsString());
        
          // Temporarily show the error instead of redirecting
    dd([
        'error' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine(),
        'trace' => $e->getTraceAsString()
    ]);
    
    // return redirect()
    //     ->route('pj.index')
    //     ->with('failure', 'Ralat berlaku semasa memuatkan profil.');
    }
}

// Save teaching profile (top section of show teaching)
public function saveTeachingProfile(Request $request, $no_kad_pintar)
{
    // Validate input
    $request->validate([
        'Nama' => 'required|string|max:255',
        'No Kad Pintar' => 'nullable|string|max:255',
        'Kod Tempat Bertugas' => 'nullable|string|max:255',
        'Tanggagaji Sebenar' => 'nullable|string|max:255',
        'tarikhLahir' => 'nullable|string',
        'tarikhTamatKontrak' => 'nullable|string',
        'tarikh_mula_berkhidmat' => 'nullable|string',
        'tarikh_jawatan_sekarang' => 'nullable|string',
        'Tarikh diatur bertugas sekarang' => 'nullable|string',
        'Sekolah Tempat Bertugas' => 'nullable|string|max:255',
        'jabatan' => 'nullable|string|max:255',
        'Gaji Sekarang' => 'nullable|string|max:255',
        'Tarikh Gaji Bulan' => 'nullable|string|max:255',
        'tarikhpenetapan' => 'nullable|string|max:255',
        'TarikhKenaikan' => 'nullable|string|max:255',
        'Jenis Perkhidmatan' => 'nullable|string|max:255',
    ]);

    // Find teacher by No Kad Pintar
    $teacher = PemegangJawatanTeach::where('No Kad Pintar', $no_kad_pintar)->firstOrFail();

    // Update fields
    $teacher->Nama = $request->input('Nama');
    $teacher->{'No Kad Pintar'} = $request->input('No Kad Pintar');
    $teacher->{'Kod Tempat Bertugas'} = $request->input('Kod Tempat Bertugas');
    $teacher->{'Tanggagaji Sebenar'} = $request->input('Tanggagaji Sebenar');
    $teacher->{'Tarikh Lahir'} = $request->input('tarikhLahir');
    $teacher->{'Tarikh Tamat Kontrak'} = $request->input('tarikhTamatKontrak');
    $teacher->{'Tarikh Mula Berkhidmat'} = $request->input('tarikh_mula_berkhidmat');
    $teacher->{'Tarikh Jawatan Sekarang'} = $request->input('tarikh_jawatan_sekarang');
    $teacher->{'Tarikh diatur bertugas sekarang'} = $request->input('Tarikh diatur bertugas sekarang');
    $teacher->{'Sekolah Tempat Bertugas'} = $request->input('Sekolah Tempat Bertugas');
    $teacher->{'Jabatan Tempat Bertugas'} = $request->input('jabatan');
    $teacher->{'Gaji Sekarang'} = $request->input('Gaji Sekarang');
    $teacher->{'Tarikh Gaji Bulan'} = $request->input('Tarikh Gaji Bulan');
    $teacher->{'tarikhpenetapan'} = $request->input('tarikhpenetapan');
    $teacher->{'TarikhKenaikan'} = $request->input('TarikhKenaikan');
    $teacher->{'Jenis Perkhidmatan'} = $request->input('Jenis Perkhidmatan');

    // Save changes
    $teacher->save();

    // Redirect back with success
    return redirect()->back()->with('success', 'Profil berjaya dikemaskini.');
}


    
//    Save functions for NON-TEACHING

// Save peribadi tab (non-teaching)
   public function savePeribadi(Request $request, $id)
{
    // Validate inputs
    $request->validate([
        'nama' => 'required|string|max:255',
        'noKadPintar' => 'required|string|max:255',
        'jantina' => 'required|string|max:255',
        'tarikhLahir' => 'nullable|string',
        'alamat' => 'nullable|string|max:500',
        'emel' => 'nullable|email|max:255',
        'emelPeribadi' => 'nullable|email|max:255',
        'noTelefon' => 'nullable|string|max:50',
        'noMobile' => 'nullable|string|max:50',
        'namaBank' => 'nullable|string|max:255',
        'noAkaunBukuBank' => 'nullable|string|max:255',
        'cawanganBank' => 'nullable|string|max:255',
        'tarikhMulaBerkhidmat' => 'nullable|string',
        'tarikhBukuBankActive' => 'nullable|string',
        'tap' => 'nullable|string|max:50',
        'scp' => 'nullable|string|max:50',
    ]);

    // Get only the fields we want to update
    $data = $request->only([
        'nama','noKadPintar','jantina','tarikhLahir','alamat','emel','emelPeribadi',
        'noTelefon','noMobile','namaBank','noAkaunBukuBank','cawanganBank',
        'tarikhMulaBerkhidmat','tarikhBukuBankActive','tap','scp'
    ]);

    // Convert date fields to Y-m-d
    $dateFields = ['tarikhLahir','tarikhMulaBerkhidmat','tarikhBukuBankActive'];
    foreach ($dateFields as $field) {
        if (!empty($data[$field])) {
            try {
                $data[$field] = \Carbon\Carbon::parse($data[$field])->format('Y-m-d');
            } catch (\Exception $e) {
                $data[$field] = null;
            }
        }
    }

    // Direct DB update to bypass fillable issues
   // Update the SPJ record directly
   SPJ::where('id', $id)->update($data);

    return redirect()
    ->route('pj.show', $id)
    ->with('success', 'Maklumat peribadi berjaya dikemaskini!');    
}


// Save peribadi tab (teaching)
public function savePeribadiTeach(Request $request, $no_kad_pintar)
    {
        // Validate inputs
        $request->validate([
            'nama' => 'required|string|max:255',
            'noKadPintar' => 'required|string|max:255',
            'jantina' => 'required|string|max:255',
            'tarikhLahir' => 'nullable|date',
            'alamat' => 'nullable|string|max:500',
            'emel' => 'nullable|email|max:255',
            'emelPeribadi' => 'nullable|email|max:255',
            'noTelefon' => 'nullable|string|max:50',
            'noMobile' => 'nullable|string|max:50',
        ]);

        // Lookup teacher using the actual column 'No Kad Pintar'
        $teacher = PemegangJawatanTeach::where('No Kad Pintar', $no_kad_pintar)->firstOrFail();

        // Prepare update data
        $data = [
            'Nama' => $request->nama,
            'No Kad Pintar' => $request->noKadPintar,
            'Jantina' => $request->jantina,
            'Tarikh Lahir' => $request->tarikhLahir ? Carbon::parse($request->tarikhLahir)->format('Y-m-d') : null,
            'Alamat' => $request->alamat,
            'Email' => $request->emel,
            'PersonalEmail' => $request->emelPeribadi,
            'No Telefon' => $request->noTelefon,
            'No mobile' => $request->noMobile,
        ];

        // Update the record
        $teacher->update($data);

        return redirect()
    ->route('pj.teaching.show', $teacher->{'No Kad Pintar'})
    ->with('success', 'Maklumat peribadi berjaya dikemaskini!');

    }

// Save pekerjaan tab (non-teaching)
public function savePekerjaan(Request $request, $id)
{
    // Validate all inputs
    $request->validate([
        'failRujukan' => 'nullable|string|max:255',
        'tarikhMeminjamFail' => 'nullable|string',
        'jawatanoption' => 'nullable|string|max:255',
        'jawatanSebenar' => 'nullable|string|max:255',
        'tanggagajiSebenar' => 'nullable|string|max:255',
        'divisyen' => 'nullable|string|max:255',
        'Text228' => 'nullable|string|max:255',
        'jenisTanggagaji' => 'nullable|string|max:255',
        'tarikhMulaBerkhidmat' => 'nullable|string',
        'tap' => 'nullable',
        'scp' => 'nullable',
        'tarikhJawatanSekarang' => 'nullable|string',
        'tarikhLantikanKBT' => 'nullable|string',
        'jenisPerkhidmatan' => 'nullable|string|max:255',
        'jawatanSekolah' => 'nullable|string|max:255',
        'tarikhDiaturBertugasSekarang' => 'nullable|string',
        'daerah' => 'nullable|string|max:255',
        'sekolahMaktab' => 'nullable|string|max:255',
        'jenisSekolah' => 'nullable|string|max:255',
        'jabatan' => 'nullable|string|max:255',
        'sectionCode' => 'nullable|string|max:255',
        'bahagian' => 'nullable|string|max:255',
        'unit' => 'nullable|string|max:255',
    ]);

    try {
        // Prepare all data for update
        $updateData = [
            // Text fields
            'rujukanFile' => $request->input('failRujukan'),
            'Text224' => $request->input('jawatanoption'),
            'Text242' => $request->input('jawatanSebenar'),
            'tanggagajiSebenar' => $request->input('tanggagajiSebenar'),
            'Text236' => $request->input('divisyen'),
            'Text228' => $request->input('Text228'),
            'jenisTanggagaji' => $request->input('jenisTanggagaji'),
            'Combo230' => $request->input('jenisPerkhidmatan'),
            'jawatanDiSekolah' => $request->input('jawatanSekolah'),
            'daerah' => $request->input('daerah'),
            'lainLainHal' => $request->input('sekolahMaktab'),
            'Combo317' => $request->input('jenisSekolah'),
            'jabatanTempatBertugas' => $request->input('jabatan'),
            'sectionCode' => $request->input('sectionCode'),
            'bahagianTempatBertugas' => $request->input('bahagian'),
            'unitTempatBertugas' => $request->input('unit'),
            
            // Checkboxes
            'tap' => $request->has('tap') ? 'TRUE' : 'FALSE',
            'scp' => $request->has('scp') ? 'TRUE' : 'FALSE',
        ];

        // Handle dates with comprehensive error handling
        // tarikhMeminjamFail -> d-M-y format (e.g., 15-Jan-24)
        if ($request->filled('tarikhMeminjamFail')) {
            try {
                $date = trim($request->tarikhMeminjamFail);
                $timestamp = @strtotime($date);
                if ($timestamp !== false && $timestamp > 0) {
                    $updateData['tarikhMinjamFail'] = date('d-M-y', $timestamp);
                } else {
                    \Log::warning("Could not parse tarikhMeminjamFail: $date");
                }
            } catch (\Throwable $e) {
                \Log::error('Error parsing tarikhMeminjamFail: ' . $e->getMessage());
            }
        }

        // tarikhMulaBerkhidmat -> Y-m-d format
        if ($request->filled('tarikhMulaBerkhidmat')) {
            try {
                $date = trim($request->tarikhMulaBerkhidmat);
                $timestamp = @strtotime($date);
                if ($timestamp !== false && $timestamp > 0) {
                    $updateData['tarikhMulaBerkhidmat'] = date('Y-m-d', $timestamp);
                } else {
                    \Log::warning("Could not parse tarikhMulaBerkhidmat: $date");
                }
            } catch (\Throwable $e) {
                \Log::error('Error parsing tarikhMulaBerkhidmat: ' . $e->getMessage());
            }
        }

        // tarikhJawatanSekarang -> d-M-y format
        if ($request->filled('tarikhJawatanSekarang')) {
            try {
                $date = trim($request->tarikhJawatanSekarang);
                $timestamp = @strtotime($date);
                if ($timestamp !== false && $timestamp > 0) {
                    $updateData['tarikhJawatanSekarang'] = date('d-M-y', $timestamp);
                } else {
                    \Log::warning("Could not parse tarikhJawatanSekarang: $date");
                }
            } catch (\Throwable $e) {
                \Log::error('Error parsing tarikhJawatanSekarang: ' . $e->getMessage());
            }
        }

        // tarikhLantikanKBT -> Y-m-d format
        if ($request->filled('tarikhLantikanKBT')) {
            try {
                $date = trim($request->tarikhLantikanKBT);
                $timestamp = @strtotime($date);
                if ($timestamp !== false && $timestamp > 0) {
                    $updateData['tarikhLantikanKBT'] = date('Y-m-d', $timestamp);
                } else {
                    \Log::warning("Could not parse tarikhLantikanKBT: $date");
                }
            } catch (\Throwable $e) {
                \Log::error('Error parsing tarikhLantikanKBT: ' . $e->getMessage());
            }
        }

        // tarikhDiaturBertugasSekarang -> d-M-y format
        if ($request->filled('tarikhDiaturBertugasSekarang')) {
            try {
                $date = trim($request->tarikhDiaturBertugasSekarang);
                $timestamp = @strtotime($date);
                if ($timestamp !== false && $timestamp > 0) {
                    $updateData['tarikhDiaturBertugasSekarang'] = date('d-M-y', $timestamp);
                } else {
                    \Log::warning("Could not parse tarikhDiaturBertugasSekarang: $date");
                }
            } catch (\Throwable $e) {
                \Log::error('Error parsing tarikhDiaturBertugasSekarang: ' . $e->getMessage());
            }
        }

        // Log the data being updated for debugging
        \Log::info('Pekerjaan Update Data:', $updateData);

        // Use DB update to bypass fillable restrictions
        $affected = DB::table('spjs')
            ->where('id', $id)
            ->update($updateData);

        \Log::info("Rows affected: $affected");

        return redirect()
            ->route('pj.show', $id)
            ->with('success', 'Maklumat pekerjaan berjaya dikemaskini!');

    } catch (\Throwable $e) {
        \Log::error('Error saving Pekerjaan: ' . $e->getMessage());
        \Log::error('Stack trace: ' . $e->getTraceAsString());
        \Log::error('Request data: ' . json_encode($request->all()));
        
        return redirect()
            ->back()
            ->withInput()
            ->with('failure', 'Ralat berlaku semasa menyimpan. Sila cuba lagi.');
    }
}

// Save kursus tab (non-teaching)
public function store(Request $request, $id)
{
    $request->validate([
        'kursus' => 'nullable|array',
        'kursus.*.Code Kursus' => 'nullable|string|max:255',
        'kursus.*.Nama Kursus' => 'nullable|string|max:255',
        'kursus.*.Mulai' => 'nullable|date',
        'kursus.*.Hingga' => 'nullable|date',
        'kursus.*.Tempat Kursus' => 'nullable|string|max:255',
    ]);
    
    try {
        $spj = SPJ::findOrFail($id);
        
        $kursusData = $request->input('kursus', []);
        
        $submittedKursusNames = collect($kursusData)
            ->pluck('Nama Kursus')
            ->filter()
            ->toArray();
        
        \Log::info('Submitted kursus names', ['names' => $submittedKursusNames]);
        
        DB::table('Kursus')
            ->where('Code_kursus', $spj->Text163)
            ->whereNotIn('NamaKursus', $submittedKursusNames)
            ->delete();
        
        foreach ($kursusData as $kursus) {
            if (!empty($kursus['Nama Kursus'])) {
                
                $data = [
                    'Code_kursus'   => $spj->Text163,
                    'NamaKursus'    => trim($kursus['Nama Kursus']),
                    'Mulai'         => $kursus['Mulai'] ?? null,
                    'Hingga'        => $kursus['Hingga'] ?? null,
                    'TempatKursus'  => !empty($kursus['Tempat Kursus']) ? trim($kursus['Tempat Kursus']) : null,
                ];
                
                $existing = DB::table('Kursus')
                    ->where('Code_kursus', $spj->Text163)
                    ->where('NamaKursus', trim($kursus['Nama Kursus']))
                    ->first();
                
                if ($existing) {
                    DB::table('Kursus')
                        ->where('Code_kursus', $spj->Text163)
                        ->where('NamaKursus', trim($kursus['Nama Kursus']))
                        ->update($data);
                } else {
                    DB::table('Kursus')->insert($data);
                }
            }
        }
        
        return redirect()->route('pj.show', $id)
            ->with('success', 'Maklumat kursus berjaya dikemaskini!'); // Changed message
            
    } catch (\Exception $e) {
        \Log::error('Error saving kursus data', [
            'id' => $id,
            'error' => $e->getMessage()
        ]);
        
        return redirect()->route('pj.show', $id)
            ->with('error', 'Ralat berlaku semasa menyimpan data kursus.');
    }
}



// Delete kursus rows (non-teaching)
public function destroy(Request $request, $id)
{
    try {
        \Log::info('Delete request received', [
            'spj_id' => $id,
            'request_data' => $request->all()
        ]);

        $spj = SPJ::findOrFail($id);

        $deleted = DB::table('Kursus')
            ->where('Code_kursus', $spj->Text163)
            ->where('NamaKursus', $request->nama_kursus)
            ->delete();

        \Log::info('Deletion result', [
            'deleted' => $deleted,
            'code_kursus' => $spj->Text163,
            'nama_kursus' => $request->nama_kursus
        ]);

        if ($deleted) {
            return response()->json([
                'success' => true,
                'message' => 'Kursus berjaya dipadamkan!'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Kursus tidak dijumpai.'
        ], 404);

    } catch (\Exception $e) {
        \Log::error('Error deleting kursus', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);

        return response()->json([
            'success' => false,
            'message' => 'Ralat berlaku semasa memadam data.'
        ], 500);
    }
}

// Save jawatan utama (non-teaching)
public function saveJawatan(Request $request, $id)
{
    $request->validate([
        'summarize_bahagian1' => 'nullable|string',
        'tarikhMulaiMemangku' => 'nullable|string',
        'keputusanEDPMMO' => 'nullable|string',
        'keputusanCEP' => 'nullable|string',
        'duaKertasKerjaProjek' => 'nullable|string',
        'gambar' => 'nullable|file|image|max:2048',
        'remove_gambar' => 'nullable|string',
        'matrix_rows' => 'nullable|array',
        'matrix_rows.*.id' => 'nullable|integer',
        'matrix_rows.*.jawatan' => 'nullable|string',
        'matrix_rows.*.peruntukan' => 'nullable|string',
        'matrix_rows.*.sebab' => 'nullable|string',
        'matrix_rows.*.mulai' => 'nullable|date',
        'matrix_rows.*.hingga' => 'nullable|date',
        'deleted_ids' => 'nullable|array',
        'deleted_ids.*' => 'integer',
    ]);

    try {
        // Find the SPJ record
        $spj = Spj::findOrFail($id);
        
        // Update duaKertasKerjaProjek
        $spj->duaKertasKerjaProjek = $request->input('duaKertasKerjaProjek');
        $spj->save();

        $data = $request->only([
            'summarize_bahagian1',
            'tarikhMulaiMemangku',
            'keputusanEDPMMO',
            'keputusanCEP',
            'duaKertasKerjaProjek'
        ]);
        
        // Initialize gambar key to null
        $data['gambar'] = null;
        
        // Handle image upload
        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($spj->gambar) {
                \Storage::disk('public')->delete($spj->gambar);
            }
            // Store new image
            $data['gambar'] = $request->file('gambar')->store('gambar', 'public');
        }

        // Handle remove image
        if ($request->input('remove_gambar') === '1') {
            if ($spj->gambar) {
                \Storage::disk('public')->delete($spj->gambar);
            }
            $data['gambar'] = null;
        }
        
        // Parse date
        if (!empty($data['tarikhMulaiMemangku'])) {
            try {
                $data['tarikhMulaiMemangku'] = \Carbon\Carbon::parse($data['tarikhMulaiMemangku'])->format('Y-m-d');
            } catch (\Exception $e) {
                $data['tarikhMulaiMemangku'] = null;
            }
        }

        // Direct DB update
        Spj::where('id', $id)->update([
            'Text260' => $data['summarize_bahagian1'] ?? null,
            'mulaiActing' => $data['tarikhMulaiMemangku'] ?? null,
            'teach' => $data['keputusanEDPMMO'] ?? null,
            'GO' => $data['keputusanCEP'] ?? null,
            'duaKertasKerjaProjek' => $data['duaKertasKerjaProjek'] ?? null,
            'gambar' => $data['gambar']
        ]);

        // Handle Matrix Jawatan rows - SMART UPDATE with explicit deletion
        if ($request->has('matrix_rows')) {
            $submittedIds = [];
            
            foreach ($request->matrix_rows as $row) {
                // Skip empty rows
                if (empty($row['jawatan']) && empty($row['peruntukan']) && empty($row['sebab']) && empty($row['mulai']) && empty($row['hingga'])) {
                    continue;
                }
                
                $rowData = [
                    'spj_id' => $id,
                    'jawatan' => $row['jawatan'] ?? null,
                    'peruntukan' => $row['peruntukan'] ?? null,
                    'sebab' => $row['sebab'] ?? null,
                    'mulai' => !empty($row['mulai']) ? $row['mulai'] : null,
                    'hingga' => !empty($row['hingga']) ? $row['hingga'] : null,
                    'updated_at' => now(),
                ];
                
                // If row has ID, update existing record
                if (!empty($row['id'])) {
                    DB::table('matrix_jawatan')
                        ->where('id', $row['id'])
                        ->where('spj_id', $id) // Security check
                        ->update($rowData);
                    
                    $submittedIds[] = $row['id'];
                } else {
                    // Insert new record
                    $rowData['created_at'] = now();
                    $newId = DB::table('matrix_jawatan')->insertGetId($rowData);
                    $submittedIds[] = $newId;
                }
            }
            
            // Handle explicitly deleted rows tracked by Alpine.js
            if ($request->has('deleted_ids') && is_array($request->deleted_ids)) {
                DB::table('matrix_jawatan')
                    ->where('spj_id', $id)
                    ->whereIn('id', $request->deleted_ids)
                    ->delete();
                
                \Log::info("Deleted matrix rows with IDs: " . implode(', ', $request->deleted_ids));
            }
            
            // Also delete any orphaned rows not in submitted list and not explicitly deleted
            if (!empty($submittedIds)) {
                $deletedIds = $request->deleted_ids ?? [];
                $allTrackedIds = array_merge($submittedIds, $deletedIds);
                
                DB::table('matrix_jawatan')
                    ->where('spj_id', $id)
                    ->whereNotIn('id', $allTrackedIds)
                    ->delete();
            }
        } else {
            // If no matrix_rows submitted but we have deleted_ids, delete them
            if ($request->has('deleted_ids') && is_array($request->deleted_ids)) {
                DB::table('matrix_jawatan')
                    ->where('spj_id', $id)
                    ->whereIn('id', $request->deleted_ids)
                    ->delete();
            }
        }

        return back()->with('success', 'Maklumat jawatan utama berjaya dikemaskini!');
        
    } catch (\Exception $e) {
        \Log::error('Error saving Jawatan Utama: ' . $e->getMessage());
        \Log::error('Stack trace: ' . $e->getTraceAsString());
        return back()->with('failure', 'Ralat berlaku: ' . $e->getMessage());
    }
}

// Save melapor non-teaching
public function saveMelapor(Request $request, $id)
{
    // Validate inputs
    $request->validate([
        'tempatBertugasSekarang' => 'nullable|string|max:255',
        'tarikhMulaDiatur' => 'nullable|array',
        'tarikhMulaDiatur.*' => 'nullable|string',
        'tempatBertugas' => 'nullable|array',
        'tempatBertugas.*' => 'nullable|string|max:255',
        'tarikhHingga' => 'nullable|array',
        'tarikhHingga.*' => 'nullable|string',
        'tarikhHinggaSingle' => 'nullable|string',
    ]);

    // Verify record exists
    $spj = SPJ::findOrFail($id);

    // Prepare data to update SPJ main fields
    $updateData = [];
    
    // Update Text171 (Tempat Bertugas Sekarang)
    $tempatBertugasValue = $request->input('tempatBertugasSekarang');
    $updateData['Text171'] = 'Tempat Bertugas Sekarang:' . ($tempatBertugasValue ?? '');
    
    // Update Text170 (Tempat Bertugas) from FIRST row
    if ($request->has('tempatBertugas') && 
        is_array($request->tempatBertugas) && 
        isset($request->tempatBertugas[0]) && 
        !empty(trim($request->tempatBertugas[0]))) {
        $updateData['Text170'] = 'Tempat Bertugas:' . trim($request->tempatBertugas[0]);
    }
    
    // Update Text172 (Tarikh Diatur) from FIRST row with date formatting
    if ($request->has('tarikhMulaDiatur') && 
        is_array($request->tarikhMulaDiatur) && 
        isset($request->tarikhMulaDiatur[0]) && 
        !empty($request->tarikhMulaDiatur[0])) {
        
        try {
            $parsedDate = \Carbon\Carbon::parse($request->tarikhMulaDiatur[0]);
            $dateFormatted = $parsedDate->format('m/d/Y');
            $updateData['Text172'] = 'Tarikh Diatur Tempat Bertugas Sekarang:' . $dateFormatted;
        } catch (\Exception $e) {
            $updateData['Text172'] = 'Tarikh Diatur Tempat Bertugas Sekarang:' . $request->tarikhMulaDiatur[0];
            \Log::warning('Date parsing failed for tarikhMulaDiatur', [
                'value' => $request->tarikhMulaDiatur[0],
                'error' => $e->getMessage()
            ]);
        }
    }

    // Update tarikhJawatanSekarang from FIRST row OR bottom single field
    $dateToSave = null;
    
    if ($request->has('tarikhHingga') && 
        is_array($request->tarikhHingga) && 
        isset($request->tarikhHingga[0]) && 
        !empty($request->tarikhHingga[0])) {
        $dateToSave = $request->tarikhHingga[0];
    }
    elseif ($request->has('tarikhHinggaSingle') && !empty($request->tarikhHinggaSingle)) {
        $dateToSave = $request->tarikhHinggaSingle;
    }
    
    if ($dateToSave) {
        try {
            $parsedDate = \Carbon\Carbon::parse($dateToSave);
            $updateData['tarikhJawatanSekarang'] = $parsedDate->format('d-M-y');
        } catch (\Exception $e) {
            $updateData['tarikhJawatanSekarang'] = $dateToSave;
            \Log::warning('Date parsing failed for tarikhHingga', [
                'value' => $dateToSave,
                'error' => $e->getMessage()
            ]);
        }
    }

    // Perform the SPJ update
    try {
        SPJ::where('id', $id)->update($updateData);
        
        // DELETE all existing records for this SPJ
        TempatBertugas::where('spj_id', $id)->delete();
        
        // Now save ALL rows to tempat_bertugas table
        $tarikhMulaArray = $request->input('tarikhMulaDiatur', []);
        $tempatArray = $request->input('tempatBertugas', []);
        $tarikhHinggaArray = $request->input('tarikhHingga', []);
        
        $maxCount = max(count($tarikhMulaArray), count($tempatArray), count($tarikhHinggaArray));
        
        \Log::info('Saving tempat bertugas rows', ['total_rows' => $maxCount]);
        
        for ($i = 0; $i < $maxCount; $i++) {
            // Only save if at least one field has data
            $hasMula = !empty($tarikhMulaArray[$i] ?? '');
            $hasTempat = !empty($tempatArray[$i] ?? '');
            $hasHingga = !empty($tarikhHinggaArray[$i] ?? '');
            
            if ($hasMula || $hasTempat || $hasHingga) {
                $created = TempatBertugas::create([
                    'spj_id' => $id,
                    'tarikh_mula_diatur' => $hasMula ? $tarikhMulaArray[$i] : null,
                    'tempat_bertugas' => $hasTempat ? trim($tempatArray[$i]) : null,
                    'tarikh_hingga' => $hasHingga ? $tarikhHinggaArray[$i] : null,
                ]);
                
                \Log::info('Created row', ['id' => $created->id, 'data' => $created->toArray()]);
            }
        }
        
        return redirect()->route('pj.show', $id)
            ->with('success', 'Maklumat melapor berjaya dikemaskini!');
            
    } catch (\Exception $e) {
        \Log::error('Error saving melapor data', [
            'id' => $id,
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        
        return redirect()->route('pj.show', $id)
            ->with('error', 'Ralat berlaku semasa menyimpan data: ' . $e->getMessage());
    }
}


// Save kelulusan (non-teaching)
public function saveKelulusan(Request $request, $id)
{
    // Validate inputs
    $request->validate([
        'kelulusanTertinggi' => 'nullable|string|max:255',
        'sijilGuru' => 'nullable|string|max:255',
        'sijilKerani' => 'nullable|string|max:255',
        'kursusIPA' => 'nullable|string|max:255',
        'GO' => 'nullable|string|max:255',
        'FR' => 'nullable|string|max:255',
    ]);

    // Get only the fields we want to update
    $data = $request->only([
        'kelulusanTertinggi',
        'sijilGuru',
        'sijilKerani',
        'kursusIPA',
        'GO',
        'FR'
    ]);
    
    // Update the SPJ record directly
    SPJ::where('id', $id)->update($data);

    return redirect()
        ->route('pj.show', $id)
        ->with('success', 'Maklumat kelulusan berjaya dikemaskini!');    
}

// Save budget tab (non-teaching)
public function saveBudget(Request $request, $id)
{
    $request->validate([
        'gaji_sekarang' => 'nullable|string|max:255',
        'tarikhUpdate' => 'nullable|string',
        'program' => 'nullable|string|max:255',
        'kod_program' => 'nullable|string|max:255',
        'aktiviti' => 'nullable|string|max:255',
        'kod_aktiviti' => 'nullable|string|max:255',
        'fungsi_jawatan' => 'nullable|string|max:255',
        'jabatan' => 'nullable|string|max:255',
        'bahagian' => 'nullable|string|max:255',
    ]);

    $data = $request->only([
        'gaji_sekarang', 'tarikhUpdate', 'program', 'kod_program',
        'aktiviti', 'kod_aktiviti', 'fungsi_jawatan', 'jabatan', 'bahagian'
    ]);

    // Handle date conversion
    if (!empty($data['tarikhUpdate'])) {
        try {
            $data['tarikhUpdate'] = \Carbon\Carbon::parse($data['tarikhUpdate'])->format('Y-m-d');
        } catch (\Exception $e) {
            $data['tarikhUpdate'] = null;
        }
    }

    // Map to database columns
    $updateData = [
        'gajiSekarang' => $data['gaji_sekarang'] ?? null,
        'tarikhUpdate' => $data['tarikhUpdate'] ?? null,
        'program' => $data['program'] ?? null,
        'kodProgram' => $data['kod_program'] ?? null,
        'aktivitiJabatanJawatan' => $data['aktiviti'] ?? null,
        'kodAktivitiJabatanJawatan' => $data['kod_aktiviti'] ?? null,
        'fungsiJawatan' => $data['fungsi_jawatan'] ?? null,
        'text322' => $data['jabatan'] ?? null,
        'bahagianTempatBertugas' => $data['bahagian'] ?? null,
    ];

    SPJ::where('id', $id)->update($updateData);

    // Handle Gaji2019 table data if provided
    if ($request->has('gaji_rows')) {
        $spj = SPJ::findOrFail($id);
        
        // Delete existing gaji records for this user
        DB::table('gaji2019')->where('ID', $spj->Text163)->delete();
        
        // Insert new records
        foreach ($request->gaji_rows as $row) {
            if (!empty($row['tahun']) || !empty($row['gaji'])) {
                DB::table('gaji2019')->insert([
                    'ID' => $spj->Text163,
                    'Tahun' => $row['tahun'],
                    'Gaji' => $row['gaji'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    return redirect()->route('pj.show', $id)
        ->with('success', 'Maklumat budget berjaya dikemaskini!');
}

public function saveKenaikan(Request $request, $id)
{
    $request->validate([
        'tahun.*' => 'nullable|integer',
        'tarikhKenaikan.*' => 'nullable|date',
    ]);

    // Step 1: DELETE existing rows (clean sync approach)
    KenaikanGaji::where('pemegang_jawatan_id', $id)->delete();

    // Step 2: rebuild from request
    foreach ($request->tahun ?? [] as $i => $tahun) {

        $tarikh = $request->tarikhKenaikan[$i] ?? null;

        $gaji = $request->gaji[$i] ?? null;

        // skip completely empty rows
        if (empty($tahun) && empty($gaji) && empty($tarikh)) {
            continue;
        }

        KenaikanGaji::create([
            'pemegang_jawatan_id' => $id,
            'tahun' => $tahun,
            'tarikh_kenaikan' => $tarikh,
            'gaji' => $gaji,
            'markah_prestasi' => $request->markahPrestasi[$i] ?? null,
            'gred_prestasi' => $request->gredPrestasi[$i] ?? null,
            'lain_lain' => $request->lainLain[$i] ?? null,
            'catatan' => $request->catatan[$i] ?? null,
        ]);
    }

    return redirect()->back()->with('success', 'Maklumat kenaikan gaji berjaya dikemaskini!');
}

public function saveCuti(Request $request, $id)
{
    // Validate (basic)
    $request->validate([
        'ck_tarikh_mula.*' => 'nullable|date',
        'ctg_tarikh_mula.*' => 'nullable|date',
    ]);

    // Delete old records first
    CutiPJawatan::where('pemegang_jawatan_id', $id)->delete();

    /*
    |--------------------------------------------------------------------------
    | 1. SAVE CUTI KHAS
    |--------------------------------------------------------------------------
    */
    foreach ($request->ck_tarikh_mula ?? [] as $i => $mula) {

        // skip empty row
        if (
            empty($mula) &&
            empty($request->ck_sebab[$i])
        ) {
            continue;
        }

        CutiPJawatan::create([
            'pemegang_jawatan_id' => $id,
            'jenis_cuti' => 'khas',

            'tarikh_mula' => $mula,
            'tarikh_tamat' => $request->ck_tarikh_tamat[$i] ?? null,
            'jumlah' => $request->ck_jumlah[$i] ?? null,
            'sebab' => $request->ck_sebab[$i] ?? null,
            'kategori' => $request->ck_kategori[$i] ?? null,
            'catatan' => $request->ck_catatan[$i] ?? null,
            'tarikh_lapor' => $request->ck_tarikh_lapor[$i] ?? null,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | 2. SAVE CUTI TANPA GAJI
    |--------------------------------------------------------------------------
    */
    foreach ($request->ctg_tarikh_mula ?? [] as $i => $mula) {

        if (
            empty($mula) &&
            empty($request->ctg_sebab[$i])
        ) {
            continue;
        }

        CutiPJawatan::create([
            'pemegang_jawatan_id' => $id,
            'jenis_cuti' => 'tanpa_gaji',

            'tarikh_mula' => $mula,
            'tarikh_tamat' => $request->ctg_tarikh_tamat[$i] ?? null,
            'jumlah' => $request->ctg_jumlah[$i] ?? null,
            'sebab' => $request->ctg_sebab[$i] ?? null,
            'kategori' => $request->ctg_kategori[$i] ?? null,
            'catatan' => $request->ctg_catatan[$i] ?? null,
            'tarikh_lapor' => $request->ctg_tarikh_lapor[$i] ?? null,
        ]);
    }

    return back()->with('success', 'Maklumat cuti berjaya dikemaskini!');
}

// Save bersara/menamatkan tab (non-teaching)
public function saveBersara(Request $request, $id)
{
    $request->validate([
        'peruntukan' => 'nullable|string|max:255',
        'jawatan' => 'nullable|string|max:255',
        'filter_bersara' => 'nullable|string|max:255',
        'peruntukan_bersara' => 'nullable|string|max:255',
        'jawatan_bersara' => 'nullable|string|max:255',
        'tarikhBersara' => 'nullable|string',
        'tarikhBersaraOverride' => 'nullable|date',
        'tatatertib' => 'nullable',
        'catatanTatatertib' => 'nullable|string',
        'tarikh_cuti' => 'nullable|string',
        'tarikh_tamat' => 'nullable|date',
        'ulasan_text' => 'nullable|array',
        'ulasan_text.*' => 'nullable|string',
        'ulasan_date' => 'nullable|array',
        'ulasan_date.*' => 'nullable|date',
    ]);

    try {
        // Prepare update data
        $updateData = [];
        
        // Peruntukan
        $updateData['Text169'] = 'Peruntukan:' . ($request->input('peruntukan') ?? '');
        
        // Jawatan
        if ($request->filled('jawatan')) {
            $updateData['Text242'] = trim($request->input('jawatan'));
        }
        
        // Filter Bersara
        if ($request->filled('filter_bersara')) {
            $updateData['Combo251'] = $request->input('filter_bersara');
        }
        
        // Peruntukan Bersara
        if ($request->filled('peruntukan_bersara')) {
            $updateData['peruntukanBersara'] = trim($request->input('peruntukan_bersara'));
        }
        
        // Jawatan Bersara
        if ($request->filled('jawatan_bersara')) {
            $updateData['jawatanBersara'] = trim($request->input('jawatan_bersara'));
        }
        
        // Tarikh Bersara - use override if tatatertib is checked
        if ($request->filled('tatatertib') && $request->filled('tarikhBersaraOverride')) {
            try {
                $updateData['tarikhBersara'] = \Carbon\Carbon::parse($request->input('tarikhBersaraOverride'))->format('Y-m-d');
            } catch (\Exception $e) {
                \Log::warning('Failed to parse tarikhBersaraOverride', ['error' => $e->getMessage()]);
            }
        } elseif ($request->filled('tarikhBersara')) {
            $updateData['tarikhBersara'] = $request->input('tarikhBersara');
        }
        
        // Tatatertib checkbox
        $updateData['tatatertib'] = $request->filled('tatatertib') ? 1 : 0;
        
        // Catatan Tatatertib
        if ($request->filled('catatanTatatertib')) {
            $updateData['catatanTatatertib'] = $request->input('catatanTatatertib');
        }
        
        // Tarikh Cuti Bersara (range) - keep the format flatpickr uses
if ($request->filled('tarikh_cuti')) {
    $updateData['tarikhCutiBersara'] = $request->input('tarikh_cuti');
}
        
        // Tarikh Tamat Kontrak
        if ($request->filled('tarikh_tamat')) {
            try {
                $updateData['tarikhTamatKontrak'] = \Carbon\Carbon::parse($request->input('tarikh_tamat'))->format('Y-m-d');
            } catch (\Exception $e) {
                \Log::warning('Failed to parse tarikh_tamat', ['error' => $e->getMessage()]);
            }
        }
        
        // Perform SPJ update
        SPJ::where('id', $id)->update($updateData);
        
        // Ulasan - save ALL rows to ulasan_bersara table
        $ulasanText = $request->input('ulasan_text', []);
        $ulasanDate = $request->input('ulasan_date', []);
        
        // Delete existing ulasan for this SPJ
        UlasanBersara::where('spj_id', $id)->delete();
        
        // Insert all new ulasan rows
        $maxCount = max(count($ulasanText), count($ulasanDate));
        for ($i = 0; $i < $maxCount; $i++) {
            if (!empty($ulasanText[$i]) || !empty($ulasanDate[$i])) {
                UlasanBersara::create([
                    'spj_id' => $id,
                    'tarikh' => !empty($ulasanDate[$i]) ? $ulasanDate[$i] : null,
                    'ulasan_text' => !empty($ulasanText[$i]) ? trim($ulasanText[$i]) : null,
                ]);
            }
        }
        
        return redirect()->route('pj.show', $id)
            ->with('success', 'Maklumat bersara/menamatkan berjaya dikemaskini!');
            
    } catch (\Exception $e) {
        \Log::error('Error saving bersara data', [
            'id' => $id,
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        
        return redirect()->route('pj.show', $id)
            ->with('error', 'Ralat berlaku semasa menyimpan data: ' . $e->getMessage());
    }
}

// Save spg (non-teaching)
public function saveSPG(Request $request, $id)
{
    $request->validate([
        'tarikh_mula' => 'nullable|string',
        'tarikh_jawatan' => 'nullable|string',
        'jenisPerkhidmatan' => 'nullable|string|max:255',
        'sekolah_maktab' => 'nullable|string|max:255',
        'tap' => 'nullable|boolean',
        'berpencen' => 'nullable|boolean',
        'gaji_spg' => 'nullable|string|max:255',
        'memo_ds_spg' => 'nullable|string|max:255',
    ]);

    $data = $request->only([
        'tarikh_mula', 'tarikh_jawatan', 'jenisPerkhidmatan', 
        'sekolah_maktab', 'gaji_spg', 'memo_ds_spg'
    ]);

    // ✅ Handle missing checkboxes safely
    $data['tap'] = $request->has('tap');
    $data['berpencen'] = $request->has('berpencen');

    // Handle date conversions
    $dateFields = ['tarikh_mula', 'tarikh_jawatan'];
    foreach ($dateFields as $field) {
        if (!empty($data[$field])) {
            try {
                $data[$field] = \Carbon\Carbon::parse($data[$field])->format('d-M-y');
            } catch (\Exception $e) {
                $data[$field] = null;
            }
        }
    }

    // Map to database columns
    $updateData = [
        'tarikhMulaBerkhidmat' => $data['tarikh_mula'] ?? null,
        'tarikhJawatanSekarang' => $data['tarikh_jawatan'] ?? null,
        'jenisPerkhidmatan' => $data['jenisPerkhidmatan'] ?? null,
        'Combo244' => $data['sekolah_maktab'] ?? null,
        'tap' => $data['tap'] ? 'TRUE' : 'FALSE',
        'Berpencen' => $data['berpencen'] ? 'TRUE' : 'FALSE',
        'Text186' => $data['gaji_spg'] ?? null,
        'Memo DS SPG' => $data['memo_ds_spg'] ?? null,
    ];

    SPJ::where('id', $id)->update($updateData);

    return redirect()->route('pj.show', $id)
        ->with('success', 'Maklumat SPG berjaya dikemaskini!');
}

// Teaching index list page
public function indexJawatanTeach()
{
    // You can pass data if needed, e.g., $positions = Jawatan::all();
    return view('hrs.pemegang-jawatan.teaching.indexjawatanteach');
}


// Save kursus (non-teaching)
public function saveKursus(Request $request, $id)
{ dd([
        'reached' => 'YES, saveKursus called',
        'id' => $id,
        'all_data' => $request->all(),
        'code' => $request->input('code'),
        'nama' => $request->input('nama'),
    ]);
    $request->validate([
        'code' => 'nullable|array',
        'code.*' => 'nullable|string|max:255',
        'nama' => 'nullable|array',
        'nama.*' => 'nullable|string|max:255',
        'mulai' => 'nullable|array',
        'mulai.*' => 'nullable|date',
        'hingga' => 'nullable|array',
        'hingga.*' => 'nullable|date',
        'tempat' => 'nullable|array',
        'tempat.*' => 'nullable|string|max:255',
    ]);

    try {
        $spj = SPJ::findOrFail($id);

        // Delete existing kursus records linked to this SPJ's Text163
        DB::table('Kursus')
            ->where('Code_kursus', $spj->Text163)
            ->delete();

        // Get arrays
        $codeArray = $request->input('code', []);
        $namaArray = $request->input('nama', []);
        $mulaiArray = $request->input('mulai', []);
        $hinggaArray = $request->input('hingga', []);
        $tempatArray = $request->input('tempat', []);

        $maxCount = max(
            count($codeArray), 
            count($namaArray), 
            count($mulaiArray), 
            count($hinggaArray), 
            count($tempatArray)
        );

        // Insert new kursus records
        for ($i =0; $i < $maxCount; $i++) {
            // Only insert if at least code or nama has data
            if (!empty($codeArray[$i] ?? '') || !empty($namaArray[$i] ?? '')) {
                DB::table('Kursus')->insert([
                    'Code_kursus' => $spj->Text163,
                    'NamaKursus' => !empty($namaArray[$i]) ? trim($namaArray[$i]) : null,
                    'Mulai' => !empty($mulaiArray[$i]) ? $mulaiArray[$i] : null,
                    'Hingga' => !empty($hinggaArray[$i]) ? $hinggaArray[$i] : null,
                    'TempatKursus' => !empty($tempatArray[$i]) ? trim($tempatArray[$i]) : null,
                ]);
            }
        }

        return redirect()->route('pj.show', $id)
            ->with('success', 'Maklumat kursus berjaya dikemaskini!');
            
    } catch (\Exception $e) {
        \Log::error('Error saving kursus data', [
            'id' => $id,
            'error' => $e->getMessage()
        ]);
        
        return redirect()->route('pj.show', $id)
            ->with('error', 'Ralat berlaku semasa menyimpan data.');
    }
}

// Save prestasi (non-teaching)
public function savePrestasi(Request $request, $id)
{ 
    try {
        $spj = SPJ::findOrFail($id);

        // Delete existing prestasi records linked to this SPJ's Text163
        DB::table('prestasi_nonteaching')  // ✅ Changed here
            ->where('Text163', $spj->Text163)
            ->delete();

        // Check if prestasi data exists in request
        if ($request->has('prestasi')) {
            foreach ($request->prestasi as $row) {
                // Only insert if at least one field has data
                if (!empty($row['Tahun']) || !empty($row['Gred']) || !empty($row['Percentage'])) {
                    DB::table('prestasi_nonteaching')->insert([  // ✅ Changed here
                        'Text163' => $spj->Text163,
                        'Tahun' => !empty($row['Tahun']) ? trim($row['Tahun']) : null,
                        'Gred' => !empty($row['Gred']) ? trim($row['Gred']) : null,
                        'Percentage' => !empty($row['Percentage']) ? trim($row['Percentage']) : null,
                    ]);
                }
            }
        }

        return redirect()->route('pj.show', $id)
            ->with('success', 'Maklumat prestasi berjaya dikemaskini!');
            
    } catch (\Exception $e) {
        \Log::error('Error saving prestasi data', [
            'id' => $id,
            'error' => $e->getMessage()
        ]);
        
        return redirect()->route('pj.show', $id)
            ->with('error', 'Ralat berlaku semasa menyimpan data.');
    }
}


// Save anugerah (non-teaching)
public function saveAnugerah(Request $request, $id)
{ 
    try {
        $spj = SPJ::findOrFail($id);

        // Delete existing records (NEW structure)
        AnugerahPJawatan::where('pemegang_jawatan_id', $id)->delete();

        // Insert new records
        if ($request->has('anugerah')) {
            foreach ($request->anugerah as $row) {

                // Skip empty row
                if (
                    empty($row['tahun']) &&
                    empty($row['nama_anugerah']) &&
                    empty($row['peringkat']) &&
                    empty($row['penganjur']) &&
                    empty($row['catatan'])
                ) {
                    continue;
                }

                AnugerahPJawatan::create([
                    'pemegang_jawatan_id' => $id,
                    'tahun' => !empty($row['tahun']) ? trim($row['tahun']) : null,
                    'nama_anugerah' => !empty($row['nama_anugerah']) ? trim($row['nama_anugerah']) : null,
                    'peringkat' => !empty($row['peringkat']) ? trim($row['peringkat']) : null,
                    'penganjur' => !empty($row['penganjur']) ? trim($row['penganjur']) : null,
                    'catatan' => !empty($row['catatan']) ? trim($row['catatan']) : null,
                ]);
            }
        }

        return redirect()->route('pj.show', $id)
            ->with('success', 'Maklumat anugerah berjaya dikemaskini!');

    } catch (\Exception $e) {
        \Log::error('Error saving anugerah data', [
            'id' => $id,
            'error' => $e->getMessage()
        ]);

        return redirect()->route('pj.show', $id)
            ->with('error', 'Ralat berlaku semasa menyimpan data.');
    }
}

// STATUS JAWATAN METHODS (added by shakila 24/12/25)

/**
 * Display non-teaching staff positions listing with filters
 * Route: GET /pemegang-jawatan/non-teaching/jawatan
 */
public function indexJawatan(Request $request)
{
    // Get all unique Kod_Jawatan values ordered
    // ✅ FIX: CAST text column for SQL Server compatibility
    $allKodJawatan = DB::table('status_jawatan_form')
        ->selectRaw('CAST(Kod_Jawatan AS NVARCHAR(MAX)) as Kod_Jawatan')
        ->whereNotNull('Kod_Jawatan')
        ->whereRaw("LEN(CAST(Kod_Jawatan AS NVARCHAR(MAX))) > 0")
        ->distinct()
        ->orderByRaw('CAST(Kod_Jawatan AS NVARCHAR(MAX))')
        ->pluck('Kod_Jawatan')
        ->toArray();

    $totalRecords = count($allKodJawatan);
    
    // Initialize variables
    $positionInfo = null;
    $staffList = collect();
    $currentPosition = 0;
    $kodJawatan = null;
    
    // Initialize dropdown options
    $jabatanOptions = collect();
    $bahagianOptions = collect();
    $unitOptions = collect();

    // Handle navigation
    $recordParam = $request->input('record');
    $positionParam = $request->input('position');
    $kodJawatanParam = $request->input('kod_jawatan');
    $currentParam = $request->input('current', 1);

    if ($totalRecords > 0) {
        // Determine which Kod_Jawatan to display
        if ($recordParam) {
            // Navigation button clicked
            switch ($recordParam) {
                case 'first':
                    $currentPosition = 1;
                    break;
                case 'last':
                    $currentPosition = $totalRecords;
                    break;
                case 'next':
                    $currentPosition = min($totalRecords, intval($currentParam) + 1);
                    break;
                case 'prev':
                    $currentPosition = max(1, intval($currentParam) - 1);
                    break;
                default:
                    $currentPosition = 1;
            }
            $kodJawatan = $allKodJawatan[$currentPosition - 1];
            
        } elseif ($positionParam) {
            // Direct position number entered
            $currentPosition = max(1, min($totalRecords, intval($positionParam)));
            $kodJawatan = $allKodJawatan[$currentPosition - 1];
            
        } elseif ($kodJawatanParam) {
            // Search by Kod_Jawatan
            $kodJawatan = $kodJawatanParam;
            $position = array_search($kodJawatan, $allKodJawatan);
            $currentPosition = $position !== false ? $position + 1 : 0;
            
        } else {
            // Default: show first record
            $currentPosition = 1;
            $kodJawatan = $allKodJawatan[0];
        }

        // Get position information
        if ($kodJawatan) {
            $positionInfo = DB::table('status_jawatan_form')
                ->where('Kod_Jawatan', $kodJawatan)
                ->first();

            // ✅ Get staff list - MAKE SURE TO SELECT 'id' column!
            $staffList = DB::table('spjs')
                ->select(
                    'id',  // ✅ CRITICAL: Must select id for buttons to work
                    'noKadPintar as No_Kad_Pintar',
                    'nama as Nama',
                    'tarikhJawatanSekarang as Tarikh_Jawatan_Sekarang',
                    'lainLainHal as Sekolah_Tempat_Bertugas',
                    'jabatanTempatBertugas as Jabatan_Tempat_Bertugas',
                    'kodSJ as Kod_Jawatan'
                )
                ->whereRaw("CAST(kodSJ AS NVARCHAR(50)) = ?", [$kodJawatan])
                ->orderBy('nama')
                ->get();
                
            // ✅ FIX: Get dropdown options with CAST for SQL Server text columns
            $jabatanOptions = DB::table('jabatan_jawatannonteaching')
                ->selectRaw('CAST(Jabatan AS NVARCHAR(MAX)) as Jabatan')
                ->whereNotNull('Jabatan')
                ->whereRaw("LEN(CAST(Jabatan AS NVARCHAR(MAX))) > 0")
                ->distinct()
                ->orderByRaw('CAST(Jabatan AS NVARCHAR(MAX))')
                ->pluck('Jabatan');
            
            $bahagianOptions = DB::table('jabatan_jawatannonteaching')
                ->selectRaw('CAST([Jabatan Bahagian] AS NVARCHAR(MAX)) as Bahagian')
                ->whereNotNull(DB::raw('[Jabatan Bahagian]'))
                ->whereRaw("LEN(CAST([Jabatan Bahagian] AS NVARCHAR(MAX))) > 0")
                ->distinct()
                ->orderByRaw('CAST([Jabatan Bahagian] AS NVARCHAR(MAX))')
                ->pluck('Bahagian');
            
            $unitOptions = DB::table('jabatan_jawatannonteaching')
                ->selectRaw('CAST(Unit AS NVARCHAR(MAX)) as Unit')
                ->whereNotNull('Unit')
                ->whereRaw("LEN(CAST(Unit AS NVARCHAR(MAX))) > 0")
                ->distinct()
                ->orderByRaw('CAST(Unit AS NVARCHAR(MAX))')
                ->pluck('Unit');
        }
    }

    return view('hrs.jawatan.jabatan_jawatan_page', compact(
        'staffList',
        'positionInfo',
        'currentPosition',
        'totalRecords',
        'jabatanOptions',
        'bahagianOptions',
        'unitOptions'
    ));
}


/**
 * Show form to create a new blank status jawatan record
 * Route: GET /pemegang-jawatan/non-teaching/jawatan/create
 */
public function createJawatanRecord()
{
    \Log::info('=== CREATE JAWATAN RECORD PAGE LOADED ===');
    
    // Initialize empty variables for a blank form
    $positionInfo = null;
    $staffList = collect();
    $currentPosition = 0;
    $totalRecords = DB::table('status_jawatan_form')->count();
    
    // Get dropdown options - FIX: CAST in both SELECT and ORDER BY
    $jabatanOptions = DB::table('jabatan_jawatannonteaching')
        ->selectRaw('CAST(Jabatan AS NVARCHAR(MAX)) as Jabatan')
        ->whereNotNull('Jabatan')
        ->whereRaw("LEN(CAST(Jabatan AS NVARCHAR(MAX))) > 0")
        ->distinct()
        ->orderByRaw('CAST(Jabatan AS NVARCHAR(MAX))')
        ->pluck('Jabatan');
    
    $bahagianOptions = DB::table('jabatan_jawatannonteaching')
        ->selectRaw('CAST([Jabatan Bahagian] AS NVARCHAR(MAX)) as Bahagian')
        ->whereNotNull(DB::raw('[Jabatan Bahagian]'))
        ->whereRaw("LEN(CAST([Jabatan Bahagian] AS NVARCHAR(MAX))) > 0")
        ->distinct()
        ->orderByRaw('CAST([Jabatan Bahagian] AS NVARCHAR(MAX))')
        ->pluck('Bahagian');
    
    $unitOptions = DB::table('jabatan_jawatannonteaching')
        ->selectRaw('CAST(Unit AS NVARCHAR(MAX)) as Unit')
        ->whereNotNull('Unit')
        ->whereRaw("LEN(CAST(Unit AS NVARCHAR(MAX))) > 0")
        ->distinct()
        ->orderByRaw('CAST(Unit AS NVARCHAR(MAX))')
        ->pluck('Unit');
    
    return view('hrs.jawatan.jabatan_jawatan_page', compact(
        'staffList',
        'positionInfo',
        'currentPosition',
        'totalRecords',
        'jabatanOptions',
        'bahagianOptions',
        'unitOptions'
    ))->with('isCreateMode', true);
}

/**
 * Store a new status jawatan record
 * Route: POST /pemegang-jawatan/non-teaching/jawatan/create
 */
public function storeJawatanRecord(Request $request)
{
    \Log::info('=== STORE NEW JAWATAN RECORD CALLED ===');
    \Log::info('Request data:', $request->all());
    
    // Validate the input
    $validated = $request->validate([
        'kod_jawatan' => 'required|string|max:255|unique:status_jawatan_form,Kod_Jawatan',
        'kod_jabatan' => 'nullable|string|max:255',
        'jabatan' => 'nullable|string|max:255',
        'bahagian' => 'nullable|string|max:255',
        'unit' => 'nullable|string|max:255',
        'jawatan' => 'nullable|string|max:255',
        'tanggagaji' => 'nullable|string|max:255',
        'peruntukan_baru' => 'nullable|integer',
        'kosong' => 'nullable|integer',
        'penuh' => 'nullable|integer',
        'nota' => 'nullable|string|max:255',
        'jenis_jawatan' => 'nullable|string|max:255',
        'peniadaan' => 'nullable|string|max:255',
    ]);
    
    try {
        \Log::info('Validated data:', $validated);
        \Log::info('Unit value from validated:', ['unit' => $validated['unit'] ?? 'NOT SET']);
        
        // Prepare insert data
        $insertData = [
            'Kod_Jawatan' => $validated['kod_jawatan'],
            'Kod_Jabatan' => $validated['kod_jabatan'] ?? null,
            'Text183' => $validated['jabatan'] ?? null,
            'Jawatan_Bahagian' => $validated['bahagian'] ?? null,
            'Unit' => $validated['unit'] ?? null,
            'Jawatan' => $validated['jawatan'] ?? null,
            'Tanggagaji' => $validated['tanggagaji'] ?? null,
            'Peruntukan_Baru' => $validated['peruntukan_baru'] ?? 0,
            'Kosong' => $validated['kosong'] ?? 0,
            'Penuh' => $validated['penuh'] ?? 0,
            'Nota' => $validated['nota'] ?? null,
            'Jenis_Jawatan' => $validated['jenis_jawatan'] ?? null,
            'Peniadaan' => $validated['peniadaan'] ?? null,
        ];
        
        \Log::info('Data to be inserted:', $insertData);
        
        // Insert new record into status_jawatan_form
        DB::table('status_jawatan_form')->insert($insertData);
        
        \Log::info("New status jawatan record created: {$validated['kod_jawatan']}");
        
        return redirect()
            ->route('pj.nonteaching.jawatan', ['kod_jawatan' => $validated['kod_jawatan']])
            ->with('success', "Rekod baru Kod Jawatan {$validated['kod_jawatan']} berjaya ditambah!");
            
    } catch (\Exception $e) {
        \Log::error('Error creating new jawatan record: ' . $e->getMessage());
        \Log::error('Stack trace: ' . $e->getTraceAsString());
        
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Ralat berlaku: ' . $e->getMessage());
    }
}

/**
 * Store new non-teaching staff entries
 * Route: POST /pemegang-jawatan/non-teaching/jawatan/store
 */
public function storeJawatanStaff(Request $request)
{
    \Log::info('=== STORE JAWATAN STAFF CALLED ===');
    \Log::info('Request data:', $request->all());
    
    // Validate the input
    $validated = $request->validate([
        'kod_jawatan' => 'required|string',
        'new_staff' => 'required|array|min:1',
        'new_staff.*.kod_jawatan' => 'required|string|max:255',
        'new_staff.*.no_kad_pintar' => 'required|string|max:255',
        'new_staff.*.nama' => 'required|string|max:255',
        'new_staff.*.tarikh_jawatan' => 'nullable|date',
        'new_staff.*.sekolah' => 'nullable|string|max:255',
        'new_staff.*.jabatan' => 'nullable|string|max:255',
    ]);

    \Log::info('Validation passed');

    try {
        $kodJawatan = $request->input('kod_jawatan');
        $newStaffList = $request->input('new_staff');
        $successCount = 0;

        \Log::info("Processing " . count($newStaffList) . " new staff for Kod Jawatan: {$kodJawatan}");

        foreach ($newStaffList as $index => $staffData) {
            \Log::info("Inserting staff {$index}:", $staffData);
            
            // ✅ FIX: Get the next available ID manually
            $maxId = DB::table('spjs')->max('id');
            $nextId = ($maxId ?? 0) + 1;
            
            \Log::info("Next ID will be: {$nextId}");
            
            // Create SPJ instance
            $spj = new SPJ();
            
            // ✅ MANUALLY SET THE ID
            $spj->id = $nextId;
            
            // Set other required fields
            $spj->noKadPintar = $staffData['no_kad_pintar'];
            $spj->nama = $staffData['nama'];
            $spj->kodSJ = $staffData['kod_jawatan'];
            
            // Optional fields - only set if not empty
            if (!empty($staffData['tarikh_jawatan'])) {
                $spj->tarikhJawatanSekarang = $staffData['tarikh_jawatan'];
            }
            
            if (!empty($staffData['sekolah'])) {
                $spj->lainLainHal = $staffData['sekolah'];
            }
            
            if (!empty($staffData['jabatan'])) {
                $spj->jabatanTempatBertugas = $staffData['jabatan'];
            }
            
            // Try to save
            try {
                $saved = $spj->save();
                
                if ($saved) {
                    $successCount++;
                    \Log::info("Staff {$index} inserted successfully with ID: {$nextId}");
                } else {
                    \Log::error("Failed to save staff {$index}");
                }
            } catch (\Exception $e) {
                \Log::error("Error saving staff {$index}: " . $e->getMessage());
                // Continue with other staff members
            }
        }

        \Log::info("Total inserted: {$successCount} out of " . count($newStaffList));

        if ($successCount > 0) {
            return redirect()
                ->route('pj.nonteaching.jawatan', ['kod_jawatan' => $kodJawatan])
                ->with('success', "{$successCount} staff berjaya ditambah ke Kod Jawatan {$kodJawatan}!");
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Tiada staff berjaya ditambah. Sila semak log untuk maklumat lanjut.');
        }

    } catch (\Illuminate\Validation\ValidationException $e) {
        \Log::error('Validation failed:', ['errors' => $e->errors()]);
        
        return redirect()
            ->back()
            ->withInput()
            ->withErrors($e->errors())
            ->with('error', 'Validation error. Please check the form.');
            
    } catch (\Exception $e) {
        \Log::error('Error in storeJawatanStaff: ' . $e->getMessage());
        \Log::error('Stack trace: ' . $e->getTraceAsString());
        \Log::error('Request data:', $request->all());
        
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Ralat berlaku: ' . $e->getMessage());
    }
}

/**
 * Delete a non-teaching staff entry
 * Route: DELETE /pemegang-jawatan/non-teaching/jawatan/delete/{id}
 */
public function deleteJawatanStaff($id)
{
    \Log::info("=== DELETE STAFF CALLED for ID: {$id} ===");
    
    try {
        // Get staff info first
        $staff = DB::table('spjs')->where('id', $id)->first();
        
        if (!$staff) {
            \Log::error("Staff not found with ID: {$id}");
            return redirect()
                ->back()
                ->with('error', 'Staff tidak dijumpai.');
        }
        
        $kodJawatan = $staff->kodSJ;
        $staffName = $staff->nama;
        
        \Log::info("Deleting staff: {$staffName} (ID: {$id}, Kod Jawatan: {$kodJawatan})");
        
        // Delete the staff using DB query builder (permanent deletion)
        $deleted = DB::table('spjs')->where('id', $id)->delete();
        
        if ($deleted) {
            \Log::info("Staff {$staffName} permanently deleted from database");
            
            return redirect()
                ->route('pj.nonteaching.jawatan', [
                    'kod_jawatan' => $kodJawatan,
                    '_t' => time() // Force fresh page load
                ])
                ->with('success', "Staff '{$staffName}' berjaya dipadam!");
        } else {
            \Log::error("Failed to delete staff {$staffName}");
            
            return redirect()
                ->back()
                ->with('error', 'Ralat berlaku semasa memadam staff.');
        }
        
    } catch (\Exception $e) {
        \Log::error('Error deleting staff: ' . $e->getMessage());
        \Log::error('Stack trace: ' . $e->getTraceAsString());
        
        return redirect()
            ->back()
            ->with('error', 'Ralat berlaku: ' . $e->getMessage());
    }
}

/**
 * Delete an entire status jawatan record
 * Route: DELETE /pemegang-jawatan/non-teaching/jawatan/delete/record/{kod_jawatan}
 */
public function deleteJawatanRecord($kodJawatan)
{
    \Log::info("=== DELETE JAWATAN RECORD CALLED for Kod Jawatan: {$kodJawatan} ===");
    
    try {
        // Check if the record exists
        $record = DB::table('status_jawatan_form')
            ->where('Kod_Jawatan', $kodJawatan)
            ->first();
        
        if (!$record) {
            \Log::error("Record not found with Kod Jawatan: {$kodJawatan}");
            return redirect()
                ->route('pj.nonteaching.jawatan')
                ->with('error', 'Rekod tidak dijumpai.');
        }
        
        \Log::info("Deleting record: Kod Jawatan {$kodJawatan}, Jawatan: {$record->Jawatan}");
        
        // ✅ FIX: Use CAST for kodSJ to count staff
        $staffCount = DB::table('spjs')
            ->whereRaw("CAST(kodSJ AS NVARCHAR(50)) = ?", [$kodJawatan])
            ->count();
        
        if ($staffCount > 0) {
            \Log::info("Deleting {$staffCount} staff members associated with Kod Jawatan {$kodJawatan}");
            
            // ✅ FIX: Use CAST for kodSJ to delete staff
            DB::table('spjs')
                ->whereRaw("CAST(kodSJ AS NVARCHAR(50)) = ?", [$kodJawatan])
                ->delete();
        }
        
        // Then delete the position record itself
        $deleted = DB::table('status_jawatan_form')
            ->where('Kod_Jawatan', $kodJawatan)
            ->delete();
        
        if ($deleted) {
            \Log::info("Record Kod Jawatan {$kodJawatan} and {$staffCount} staff deleted successfully");
            
            return redirect()
                ->route('pj.nonteaching.jawatan')
                ->with('success', "Rekod Kod Jawatan {$kodJawatan} dan {$staffCount} staff berjaya dipadam!");
        } else {
            \Log::error("Failed to delete record Kod Jawatan {$kodJawatan}");
            
            return redirect()
                ->back()
                ->with('error', 'Ralat berlaku semasa memadam rekod.');
        }
        
    } catch (\Exception $e) {
        \Log::error('Error deleting jawatan record: ' . $e->getMessage());
        \Log::error('Stack trace: ' . $e->getTraceAsString());
        
        return redirect()
            ->back()
            ->with('error', 'Ralat berlaku: ' . $e->getMessage());
    }
}

/**
 * Show edit form for a jawatan record
 * Route: GET /pemegang-jawatan/non-teaching/jawatan/edit/{kod_jawatan}
 */
public function editJawatanRecord($kodJawatan)
{
    \Log::info("=== EDIT JAWATAN RECORD PAGE LOADED for Kod Jawatan: {$kodJawatan} ===");
    
    // Get the position info
    $positionInfo = DB::table('status_jawatan_form')
        ->where('Kod_Jawatan', $kodJawatan)
        ->first();
    
    if (!$positionInfo) {
        return redirect()
            ->route('pj.nonteaching.jawatan')
            ->with('error', 'Rekod tidak dijumpai.');
    }
    
    // ✅ FIX: Use CAST for kodSJ in staff query
    $staffList = DB::table('spjs')
        ->select(
            'id',
            'noKadPintar as No_Kad_Pintar',
            'nama as Nama',
            'tarikhJawatanSekarang as Tarikh_Jawatan_Sekarang',
            'lainLainHal as Sekolah_Tempat_Bertugas',
            'jabatanTempatBertugas as Jabatan_Tempat_Bertugas',
            'kodSJ as Kod_Jawatan'
        )
        ->whereRaw("CAST(kodSJ AS NVARCHAR(50)) = ?", [$kodJawatan])
        ->orderBy('nama')
        ->get();
    
    // Get all records for navigation
    $totalRecords = DB::table('status_jawatan_form')->count();
    
    // Get current position index
    $allKodJawatan = DB::table('status_jawatan_form')
        ->selectRaw('CAST(Kod_Jawatan AS NVARCHAR(MAX)) as Kod_Jawatan')
        ->whereNotNull('Kod_Jawatan')
        ->whereRaw("LEN(CAST(Kod_Jawatan AS NVARCHAR(MAX))) > 0")
        ->distinct()
        ->orderByRaw('CAST(Kod_Jawatan AS NVARCHAR(MAX))')
        ->pluck('Kod_Jawatan')
        ->toArray();
    
    $position = array_search($kodJawatan, $allKodJawatan);
    $currentPosition = $position !== false ? $position + 1 : 0;
    
    // Get dropdown options
    $jabatanOptions = DB::table('jabatan_jawatannonteaching')
        ->selectRaw('CAST(Jabatan AS NVARCHAR(MAX)) as Jabatan')
        ->whereNotNull('Jabatan')
        ->whereRaw("LEN(CAST(Jabatan AS NVARCHAR(MAX))) > 0")
        ->distinct()
        ->orderByRaw('CAST(Jabatan AS NVARCHAR(MAX))')
        ->pluck('Jabatan');
    
    $bahagianOptions = DB::table('jabatan_jawatannonteaching')
        ->selectRaw('CAST([Jabatan Bahagian] AS NVARCHAR(MAX)) as Bahagian')
        ->whereNotNull(DB::raw('[Jabatan Bahagian]'))
        ->whereRaw("LEN(CAST([Jabatan Bahagian] AS NVARCHAR(MAX))) > 0")
        ->distinct()
        ->orderByRaw('CAST([Jabatan Bahagian] AS NVARCHAR(MAX))')
        ->pluck('Bahagian');
    
    $unitOptions = DB::table('jabatan_jawatannonteaching')
        ->selectRaw('CAST(Unit AS NVARCHAR(MAX)) as Unit')
        ->whereNotNull('Unit')
        ->whereRaw("LEN(CAST(Unit AS NVARCHAR(MAX))) > 0")
        ->distinct()
        ->orderByRaw('CAST(Unit AS NVARCHAR(MAX))')
        ->pluck('Unit');
    
    return view('hrs.jawatan.jabatan_jawatan_page', compact(
        'staffList',
        'positionInfo',
        'currentPosition',
        'totalRecords',
        'jabatanOptions',
        'bahagianOptions',
        'unitOptions'
    ))->with('isEditMode', true);
}

/**
 * Update a jawatan record
 * Route: PUT /pemegang-jawatan/non-teaching/jawatan/update/{kod_jawatan}
 */
public function updateJawatanRecord(Request $request, $kodJawatan)
{
    \Log::info("=== UPDATE JAWATAN RECORD CALLED for Kod Jawatan: {$kodJawatan} ===");
    \Log::info('Request data:', $request->all());
    
    // Validate the input
    $validated = $request->validate([
        'kod_jawatan' => 'required|string|max:255',
        'kod_jabatan' => 'nullable|string|max:255',
        'jabatan' => 'nullable|string|max:255',
        'bahagian' => 'nullable|string|max:255',
        'unit' => 'nullable|string|max:255',
        'jawatan' => 'nullable|string|max:255',
        'tanggagaji' => 'nullable|string|max:255',
        'peruntukan_baru' => 'nullable|integer',
        'kosong' => 'nullable|integer',
        'penuh' => 'nullable|integer',
        'nota' => 'nullable|string|max:255',
        'jenis_jawatan' => 'nullable|string|max:255',
        'peniadaan' => 'nullable|string|max:255',
    ]);
    
    try {
        $updateData = [
            'Kod_Jawatan' => $validated['kod_jawatan'],
            'Kod_Jabatan' => $validated['kod_jabatan'] ?? null,
            'Text183' => $validated['jabatan'] ?? null,
            'Jawatan_Bahagian' => $validated['bahagian'] ?? null,
            'Unit' => $validated['unit'] ?? null,
            'Jawatan' => $validated['jawatan'] ?? null,
            'Tanggagaji' => $validated['tanggagaji'] ?? null,
            'Peruntukan_Baru' => $validated['peruntukan_baru'] ?? 0,
            'Kosong' => $validated['kosong'] ?? 0,
            'Penuh' => $validated['penuh'] ?? 0,
            'Nota' => $validated['nota'] ?? null,
            'Jenis_Jawatan' => $validated['jenis_jawatan'] ?? null,
            'Peniadaan' => $validated['peniadaan'] ?? null,
        ];
        
        \Log::info('Data to be updated:', $updateData);
        
        // Update the record
        $updated = DB::table('status_jawatan_form')
            ->where('Kod_Jawatan', $kodJawatan)
            ->update($updateData);
        
        // If Kod_Jawatan changed, also update all staff records
        // ✅ FIX: Use CAST for kodSJ comparison
        if ($validated['kod_jawatan'] !== $kodJawatan) {
            \Log::info("Kod_Jawatan changed from {$kodJawatan} to {$validated['kod_jawatan']}, updating staff records");
            DB::table('spjs')
                ->whereRaw("CAST(kodSJ AS NVARCHAR(50)) = ?", [$kodJawatan])
                ->update(['kodSJ' => $validated['kod_jawatan']]);
        }
        
        \Log::info("Record updated successfully");
        
        return redirect()
            ->route('pj.nonteaching.jawatan', ['kod_jawatan' => $validated['kod_jawatan']])
            ->with('success', "Rekod Kod Jawatan {$validated['kod_jawatan']} berjaya dikemaskini!");
            
    } catch (\Exception $e) {
        \Log::error('Error updating jawatan record: ' . $e->getMessage());
        \Log::error('Stack trace: ' . $e->getTraceAsString());
        
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Ralat berlaku: ' . $e->getMessage());
    }
}


/**
 * Show Status Jawatan - Lama report
 * Route: GET /pemegang-jawatan/non-teaching/jawatan/status-lama
 */
public function statusJawatanLama(Request $request)
{
    \Log::info('=== STATUS JAWATAN LAMA REPORT CALLED ===');
    \Log::info('Request:', $request->all());
    
    $jawatan = $request->input('jawatan');
    
    if (!$jawatan) {
        return redirect()
            ->route('pj.nonteaching.jawatan')
            ->with('error', 'Sila masukkan nama jawatan.');
    }
    
    // Get all records with this jawatan name
    // ✅ FIX: CAST text columns in ORDER BY for SQL Server
    $allRecords = DB::table('status_jawatan_form')
        ->where('Jawatan', 'LIKE', '%' . $jawatan . '%')
        ->orderByRaw('CAST(Text183 AS NVARCHAR(MAX))')
        ->orderByRaw('CAST(Kod_Jawatan AS NVARCHAR(MAX))')
        ->get();
    
    $totalRecords = $allRecords->count();
    
    if ($totalRecords === 0) {
        return redirect()
            ->route('pj.nonteaching.jawatan')
            ->with('error', "Tiada rekod dijumpai untuk jawatan '{$jawatan}'.");
    }
    
    \Log::info("Found {$totalRecords} records for jawatan: {$jawatan}");
    
    // Handle navigation
    $recordParam = $request->input('record');
    $currentParam = $request->input('current', 1);
    $currentPosition = 1;
    
    if ($recordParam) {
        switch ($recordParam) {
            case 'first':
                $currentPosition = 1;
                break;
            case 'last':
                $currentPosition = $totalRecords;
                break;
            case 'next':
                $currentPosition = min($totalRecords, intval($currentParam) + 1);
                break;
            case 'prev':
                $currentPosition = max(1, intval($currentParam) - 1);
                break;
            default:
                $currentPosition = 1;
        }
    }
    
    // Get the specific record to display
    $record = $allRecords[$currentPosition - 1];
    
    \Log::info("Displaying record {$currentPosition} of {$totalRecords}");
    \Log::info("Record details:", (array)$record);
    
    return view('hrs.jawatan.status_jawatan_lama', compact(
        'jawatan',
        'record',
        'currentPosition',
        'totalRecords'
    ));
}



}