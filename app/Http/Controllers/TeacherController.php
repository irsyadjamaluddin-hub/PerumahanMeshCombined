<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TeachersExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\PemegangJawatanTeach;
use App\Models\GajiMatrix; // Add this at the top
use App\Models\Penyambungan; // Add at top with other use statements
use App\Models\TempatBertugasTeaching; // Changed from TempatBertugas
use App\Models\SejarahJawatanTeaching; // Changed from SejarahJawatan
use App\Models\KursusTeach; 
use App\Models\CutiTeach; 
class TeacherController extends Controller
{
    /**
     * Display the index page with all teachers
     */
    public function index()
    {
        // Step 1: Get distinct options using raw DB queries
        $jawatanOptions = DB::table('pemegangjawatanteach')
            ->selectRaw("CASE
                WHEN LOWER(`Jawatan di Sekolah`) LIKE '%guru besar%' THEN 'Guru Besar'
                ELSE `Jawatan di Sekolah`
            END as jawatan")
            ->whereNotNull('Jawatan di Sekolah')
            ->where('Jawatan di Sekolah', '!=', '')
            ->distinct()
            ->orderBy('jawatan')
            ->pluck('jawatan')
            ->unique()
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

        // Step 2: Fetch teachers data for display
        $teachers = DB::table('pemegangjawatanteach')
            ->selectRaw("
                Nama,
                `No Kad Pintar` as noKadPintar,
                COALESCE(NULLIF(TRIM(`No Telefon`), ''), NULLIF(TRIM(`No Mobile`), '')) as noTelefon,
                COALESCE(NULLIF(TRIM(`Email`), ''), NULLIF(TRIM(`Personal Email`), '')) as email,
                CASE
                    WHEN LOWER(`Jawatan di Sekolah`) LIKE '%guru besar%' THEN 'Guru Besar'
                    ELSE `Jawatan di Sekolah`
                END as jawatan,
                Jantina as jantina,
                `Sekolah Tempat Bertugas` as tempatBertugas,
                Daerah as daerah,
                `Kelulusan Tertnggi` as kelulusan,
                tatatertib,
                tarikhBersaraOverride,
                DATEDIFF(YEAR, `Tarikh Lahir`, GETDATE()) as umur
            ")
            ->get();

        return view('teachers.indexteach', compact(
            'teachers',
            'jawatanOptions',
            'jantinaOptions',
            'tempatBertugasOptions',
            'daerahOptions',
            'kelulusanOptions'
        ));
    }

// Shared by export() and the dashboard report: applies the same
// filters used for the teaching staff export to a base query.
private function buildFilteredTeachersQuery(Request $request)
{
    $jawatan = $request->get('jawatan');
    $jantina = $request->get('jantina');
    $tempatBertugas = $request->get('tempat_bertugas');
    $daerah = $request->get('daerah');
    $kelulusan = $request->get('kelulusan');
    $status = $request->get('status');

    $query = PemegangJawatanTeach::select(
        'Nama',
        DB::raw('[No Kad Pintar] as noKadPintar'),
        DB::raw("COALESCE(NULLIF(LTRIM(RTRIM(CAST([No Telefon] AS NVARCHAR(MAX)))), ''), NULLIF(LTRIM(RTRIM(CAST([No Mobile] AS NVARCHAR(MAX)))), '')) as noTelefon"),
        DB::raw("COALESCE(NULLIF(LTRIM(RTRIM(CAST([Email] AS NVARCHAR(MAX)))), ''), NULLIF(LTRIM(RTRIM(CAST([Personal Email] AS NVARCHAR(MAX)))), '')) as email"),
        DB::raw("CASE
            WHEN LOWER([Jawatan di Sekolah]) LIKE '%guru besar%' THEN 'Guru Besar'
            ELSE [Jawatan di Sekolah]
        END as jawatan"),
        'Jantina as jantina',
        DB::raw('[Sekolah Tempat Bertugas] as tempatBertugas'),
        'Daerah as daerah',
        DB::raw('[Kelulusan Tertnggi] as kelulusan'),
        'tatatertib',
        'tarikhBersaraOverride',
        DB::raw('[Tarikh Lahir] as tarikhLahir'),
        DB::raw('DATEDIFF(YEAR, [Tarikh Lahir], GETDATE()) as umur')
    );

    // Apply filters only if NOT "all"
    if ($jawatan && $jawatan !== 'all') {
        if (strtolower($jawatan) === 'guru besar') {
            $query->where(DB::raw('LOWER([Jawatan di Sekolah])'), 'like', '%guru besar%');
        } else {
            $query->where('Jawatan di Sekolah', $jawatan);
        }
    }

    if ($jantina && $jantina !== 'all') {
        $query->where('Jantina', $jantina);
    }

    if ($tempatBertugas && $tempatBertugas !== 'all') {
        $query->where('Sekolah Tempat Bertugas', $tempatBertugas);
    }

    // ✅ DAERAH AUTO-DETECTION FILTER
    if ($daerah && $daerah !== 'all') {
        $daerahLower = strtolower(trim($daerah));
        
        if ($daerahLower === 'brunei muara') {
            // Match: Brunei Muara, Muara, BRUNEI MUARA, Brunei-Muara, etc.
            $query->where(function($q) {
                $q->where(DB::raw('LOWER(Daerah)'), 'like', '%muara%')
                  ->orWhere(DB::raw('LOWER(Daerah)'), 'like', '%brunei%');
            });
        } elseif ($daerahLower === 'kuala belait') {
            // Match: Kuala Belait, Belait, KB, Kuala-Belait, etc.
            $query->where(function($q) {
                $q->where(DB::raw('LOWER(Daerah)'), 'like', '%belait%')
                  ->orWhere(DB::raw('LOWER(Daerah)'), 'like', '%kuala%');
            });
        } elseif ($daerahLower === 'tutong') {
            // Match: Tutong, TUTONG, etc.
            $query->where(DB::raw('LOWER(Daerah)'), 'like', '%tutong%');
        } elseif ($daerahLower === 'temburong') {
            // Match: Temburong, TEMBURONG, etc.
            $query->where(DB::raw('LOWER(Daerah)'), 'like', '%temburong%');
        }
    }

    // ✅ KELULUSAN AUTO-DETECTION FILTER
    if ($kelulusan && $kelulusan !== 'all') {
        $kelulusanLower = strtolower(trim($kelulusan));
        
        if ($kelulusanLower === 'phd') {
            // Match: PhD, Ph.D, Doctor of Philosophy, Doktor Falsafah, DPhil
            $query->where(function($q) {
                $q->where(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%phd%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%ph.d%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%doctor of philosophy%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%doktor falsafah%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%dphil%');
            });
        } elseif ($kelulusanLower === 'pgce') {
            // Match: PGCE, PGDE, Postgraduate Certificate in Education
            $query->where(function($q) {
                $q->where(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%pgce%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%pgde%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%postgraduate certificate%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%post graduate certificate%');
            });
        } elseif ($kelulusanLower === 'master') {
            // Match: Master, M.Ed, M.Sc, MSc, MA, M.A, MPhil, Sarjana (but NOT Sarjana Muda)
            $query->where(function($q) {
                $q->where(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%master%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%m.ed%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%m.sc%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%m.a%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%msc%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%med%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%m sc%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%m ed%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%m a%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%mphil%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%m.phil%');
            })
            // Exclude Sarjana Muda (Bachelor's degree)
            ->where(DB::raw('LOWER([Kelulusan Tertnggi])'), 'not like', '%sarjana muda%');
            
            // Include standalone "Sarjana" (Master's degree)
            $query->orWhere(function($q) {
                $q->where(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%sarjana%')
                  ->where(DB::raw('LOWER([Kelulusan Tertnggi])'), 'not like', '%sarjana muda%');
            });
        } elseif ($kelulusanLower === 'degree') {
            // Match: Bachelor, B.A, B.Ed, B.Sc, BA, BSc, BEd, Degree, Sarjana Muda, B.Eng, BEng, BTech
            $query->where(function($q) {
                $q->where(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%bachelor%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%b.a%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%b.ed%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%b.sc%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%b.eng%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '% ba %')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '% bed %')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '% bsc %')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '% beng %')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%b ed%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%b sc%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%b a%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%b eng%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%btech%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%b.tech%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%degree%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%sarjana muda%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%ijazah%');
            });
        } elseif ($kelulusanLower === 'higher diploma') {
            // Match: Higher Diploma, HND, Higher National Diploma, BDTVEC
            $query->where(function($q) {
                $q->where(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%higher diploma%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%hnd%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%higher national diploma%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%bdtvec%');
            });
        } elseif ($kelulusanLower === 'btec') {
            // Match: BTEC
            $query->where(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%btec%');
        } elseif ($kelulusanLower === 'diploma') {
            // Match: Diploma, Dip (but NOT Higher Diploma or National Diploma)
            $query->where(function($q) {
                $q->where(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%diploma%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%dip%');
            })
            ->where(DB::raw('LOWER([Kelulusan Tertnggi])'), 'not like', '%higher diploma%')
            ->where(DB::raw('LOWER([Kelulusan Tertnggi])'), 'not like', '%national diploma%')
            ->where(DB::raw('LOWER([Kelulusan Tertnggi])'), 'not like', '%hnd%');
        } elseif ($kelulusanLower === 'nd') {
            // Match: ND, National Diploma
            $query->where(function($q) {
                $q->where(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '% nd %')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%national diploma%');
            });
        } elseif ($kelulusanLower === 'certificate') {
            // Match: Certificate, Sijil, Cert
            $query->where(function($q) {
                $q->where(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%certificate%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%sijil%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%cert%');
            });
        } elseif ($kelulusanLower === 'o level') {
            // Match: O Level, O-Level, GCE O
            $query->where(function($q) {
                $q->where(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%o level%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%o-level%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%o/level%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%gce o%');
            });
        } elseif ($kelulusanLower === 'a level') {
            // Match: A Level, A-Level, GCE A
            $query->where(function($q) {
                $q->where(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%a level%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%a-level%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%a/level%')
                  ->orWhere(DB::raw('LOWER([Kelulusan Tertnggi])'), 'like', '%gce a%');
            });
        }
    }
    
    // Apply status filter only if NOT "all"
    if ($status && $status !== 'all') {
        if ($status === 'Active') {
            $query->whereRaw('DATEDIFF(YEAR, [Tarikh Lahir], GETDATE()) < 60')
                ->where(function($q) {
                    $q->where('tatatertib', '!=', 1)
                    ->orWhere('tatatertib', null)
                    ->orWhereRaw('tarikhBersaraOverride > CAST(GETDATE() AS DATE)');
                });
        } elseif ($status === 'Retired') {
            $query->whereRaw('DATEDIFF(YEAR, [Tarikh Lahir], GETDATE()) >= 60')
                ->where(function($q) {
                    $q->where('tatatertib', '!=', 1)
                    ->orWhere('tatatertib', null)
                    ->orWhere('tarikhBersaraOverride', null)
                    ->orWhereRaw('tarikhBersaraOverride > CAST(GETDATE() AS DATE)');
                });
        } elseif ($status === 'Inactive') {
            $query->where('tatatertib', 1)
                ->whereNotNull('tarikhBersaraOverride')
                ->whereRaw('tarikhBersaraOverride <= CAST(GETDATE() AS DATE)');
        }
    }

    return $query;
}

/**
 * Export filtered teachers to Excel
 */
public function export(Request $request)
{
    $jawatan = $request->get('jawatan');
    $jantina = $request->get('jantina');
    $tempatBertugas = $request->get('tempat_bertugas');
    $daerah = $request->get('daerah');
    $kelulusan = $request->get('kelulusan');
    $status = $request->get('status');

    $teachers = $this->buildFilteredTeachersQuery($request)->get();

    $filename = 'teaching-staff';
    $filters = [];

    // Add "All" options to filename too
    if ($jawatan) {
        $filters[] = ($jawatan === 'all') ? 'all-jawatan' : str_replace(' ', '-', strtolower($jawatan));
    }
    if ($jantina) {
        $filters[] = ($jantina === 'all') ? 'all-jantina' : str_replace(' ', '-', strtolower($jantina));
    }
    if ($tempatBertugas) {
        $filters[] = ($tempatBertugas === 'all') ? 'all-tempat-bertugas' : str_replace(' ', '-', strtolower($tempatBertugas));
    }
    if ($daerah) {
        $filters[] = ($daerah === 'all') ? 'all-daerah' : str_replace(' ', '-', strtolower($daerah));
    }
    if ($kelulusan) {
        $filters[] = ($kelulusan === 'all') ? 'all-kelulusan' : str_replace(' ', '-', strtolower($kelulusan));
    }
    if ($status) {
        $filters[] = ($status === 'all') ? 'all-status' : str_replace(' ', '-', strtolower($status));
    }
    
    if (!empty($filters)) $filename .= '-' . implode('-', $filters);
    $filename .= '-' . date('Y-m-d') . '.xlsx';

    return Excel::download(
        new TeachersExport($teachers, $jawatan, $jantina, $tempatBertugas, $daerah, $kelulusan, $status),
        $filename
    );
}

// ---------------------------------------------------------------
// Teaching Dashboard Report (same filters as the Export Excel
// modal, rendered as summary counts + charts instead of a download)
// ---------------------------------------------------------------
public function report()
{
    $jawatanOptions = PemegangJawatanTeach::select(
        DB::raw("CASE
            WHEN LOWER([Jawatan di Sekolah]) LIKE '%guru besar%' THEN 'Guru Besar'
            ELSE [Jawatan di Sekolah]
        END as jawatan")
    )->whereNotNull('Jawatan di Sekolah')->where('Jawatan di Sekolah', '!=', '')
        ->distinct()->pluck('jawatan')->unique()->sort()->values();

    $tempatBertugasOptions = PemegangJawatanTeach::select(DB::raw('[Sekolah Tempat Bertugas] as tempatBertugas'))
        ->whereNotNull('Sekolah Tempat Bertugas')->where('Sekolah Tempat Bertugas', '!=', '')
        ->distinct()->pluck('tempatBertugas')->unique()->sort()->values();

    $daerahOptions = ['Brunei Muara', 'Tutong', 'Kuala Belait', 'Temburong'];
    $kelulusanOptions = ['PhD', 'PGCE', 'Master', 'Degree', 'Higher Diploma', 'BTEC', 'Diploma', 'ND', 'Certificate', 'O Level', 'A Level'];

    return view('hrs.pemegang-jawatan.reportteach', compact(
        'jawatanOptions',
        'tempatBertugasOptions',
        'daerahOptions',
        'kelulusanOptions'
    ));
}

public function reportData(Request $request)
{
    $teachers = $this->buildFilteredTeachersQuery($request)->get();

    $total = $teachers->count();
    $avgAge = $total ? round($teachers->pluck('umur')->filter(fn($v) => $v !== null)->avg(), 1) : 0;

    $countBy = function (string $field, ?int $limit = null) use ($teachers) {
        $counts = $teachers
            ->groupBy(fn($t) => trim((string) ($t->{$field} ?? '')) !== '' ? $t->{$field} : 'Unknown')
            ->map->count()
            ->sortDesc();

        return $limit ? $counts->take($limit) : $counts;
    };

    $statusCounts = ['Active' => 0, 'Retired' => 0, 'Inactive' => 0, 'Unknown' => 0];
    $ageBuckets = ['<30' => 0, '30-39' => 0, '40-49' => 0, '50-59' => 0, '60+' => 0, 'Unknown' => 0];
    $retireBuckets = ['Within 1 year' => 0, '1-2 years' => 0, '2-5 years' => 0, '5+ years' => 0, 'Unknown' => 0];
    $now = \Carbon\Carbon::now();

    foreach ($teachers as $teacher) {
        $umur = $teacher->umur ?? null;
        $tatatertib = $teacher->tatatertib ?? 0;
        $override = $teacher->tarikhBersaraOverride ?? null;

        // Standardize free-text kelulusan into the same buckets used by
        // the non-teaching report, since teacher records don't have a
        // precomputed standardized column.
        $teacher->kelulusan_std = $this->standardizeKelulusan($teacher->kelulusan ?? '');

        // Effective retirement date: tatatertib override if it's still in the
        // future (matches the Active/Retired logic used by export()'s SQL filters),
        // otherwise birth date + 60 years.
        $tarikhBersara = null;
        if ($tatatertib == 1 && $override) {
            $tarikhBersara = $override;
        } elseif ($teacher->tarikhLahir) {
            try {
                $tarikhBersara = \Carbon\Carbon::parse($teacher->tarikhLahir)->addYears(60)->format('Y-m-d');
            } catch (\Exception $e) {
                $tarikhBersara = null;
            }
        }

        // ---- Status ----
        if ($umur === null) {
            $statusCounts['Unknown']++;
        } elseif ($tatatertib == 1 && $override && $this->isPastDate($override)) {
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
            $months = $now->diffInMonths(\Carbon\Carbon::parse($tarikhBersara), false);
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
        'byJawatan' => $countBy('jawatan', 10),
        'byKelulusan' => $countBy('kelulusan_std'),
        'byTempatBertugas' => $countBy('tempatBertugas', 10),
        'byDaerah' => $countBy('daerah'),
    ]);
}

private function standardizeKelulusan(string $kelulusan): string
{
    $kel = strtolower(trim($kelulusan));

    if ($kel === '') return 'Unknown';
    if (preg_match('/\b(phd|doctor of|doktor falsafah|dphil)\b/', $kel)) return 'PhD';
    if (preg_match('/\b(pgce|pgde|postgraduate certificate)\b/', $kel)) return 'PGCE';
    if (preg_match('/\b(master|m\.?ed\b|m\.?sc\b|m\.?a\b|mphil|m\.?phil|sarjana(?!\s*muda))\b/', $kel)) return 'Master';
    if (preg_match('/\b(bachelor|b\.?a\b|b\.?ed\b|b\.?eng\b|b\.?sc\b|b\.?tech|degree|sarjana muda|ijazah)\b/', $kel)) return 'Degree';
    if (preg_match('/\b(higher\s*diploma|higher\s*national\s*diploma|hnd|bdtvec)\b/', $kel)) return 'Higher Diploma';
    if (preg_match('/\bbtec\b/', $kel)) return 'BTEC';
    if (preg_match('/\bdiploma\b/', $kel)) return 'Diploma';
    if (preg_match('/\b(national diploma)\b/', $kel)) return 'ND';
    if (preg_match('/\b(sijil|certificate)\b/', $kel)) return 'Certificate';
    if (preg_match('/\b(o[-\s]?level|gce o)\b/', $kel)) return 'O Level';
    if (preg_match('/\b(a[-\s]?level|gce a)\b/', $kel)) return 'A Level';

    return 'Other';
}

private function isPastDate($date): bool
{
    try {
        return \Carbon\Carbon::parse($date)->isPast();
    } catch (\Exception $e) {
        return false;
    }
}

/**
 * Return distinct options for export filters (for AJAX)
 */
public function getExportOptions()
{
    $jawatanOptions = PemegangJawatanTeach::select(
        DB::raw("CASE
            WHEN LOWER([Jawatan di Sekolah]) LIKE '%guru besar%' THEN 'Guru Besar'
            ELSE [Jawatan di Sekolah]
        END as jawatan")
    )->distinct()->pluck('jawatan');

    $jantinaOptions = PemegangJawatanTeach::select('Jantina as jantina')->distinct()->pluck('jantina');

    $tempatBertugasOptions = PemegangJawatanTeach::select(DB::raw('[Sekolah Tempat Bertugas] as tempatBertugas'))->distinct()->pluck('tempatBertugas');

    $daerahOptions = PemegangJawatanTeach::select('Daerah as daerah')->distinct()->pluck('daerah');

    $kelulusanOptions = PemegangJawatanTeach::select(DB::raw('[Kelulusan Tertnggi] as kelulusan'))->distinct()->pluck('kelulusan');

    return response()->json([
        'jawatan' => $jawatanOptions,
        'jantina' => $jantinaOptions,
        'tempat_bertugas' => $tempatBertugasOptions,
        'daerah' => $daerahOptions,
        'kelulusan' => $kelulusanOptions
    ]);
}

// Save Peribadi tab data for a specific teacher

public function savePeribadiTeach(Request $request, $noKadPintar)
{
    // Validate the incoming data
    $validated = $request->validate([
        'alamat' => 'nullable|string|max:500',
        'emelPeribadi' => 'nullable|email|max:255',
        'emel' => 'nullable|email|max:255',
        'noTelefon' => 'nullable|string|max:20',
        'noMobile' => 'nullable|string|max:20',
    ]);

    try {
        // Find the teacher by No Kad Pintar
        $teacher = PemegangJawatanTeach::where('No Kad Pintar', $noKadPintar)->firstOrFail();

        // Prepare update data - only include non-null values
        $updateData = [];

        if ($request->has('alamat')) {
            $updateData['Alamat'] = $validated['alamat'];
        }

        if ($request->has('emelPeribadi')) {
            $updateData['Personal Email'] = $validated['emelPeribadi'];
        }

        if ($request->has('emel')) {
            $updateData['Email'] = $validated['emel'];
        }

        if ($request->has('noTelefon')) {
            $updateData['No Telefon'] = $validated['noTelefon'];
        }

        if ($request->has('noMobile')) {
            $updateData['No mobile'] = $validated['noMobile'];
        }

        // Update only if there's data to update
        if (!empty($updateData)) {
    PemegangJawatanTeach::where('No Kad Pintar', $noKadPintar)->update($updateData);
    Log::info('Teacher updated successfully for:', ['no_kad_pintar' => $noKadPintar]);
}


        return redirect()->back()->with('success', 'Maklumat peribadi berjaya dikemaskini!');

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return redirect()->back()->with('failure', 'Guru tidak dijumpai.');
    } catch (\Exception $e) {
        \Log::error('Error saving Peribadi data: ' . $e->getMessage());
        return redirect()->back()->with('failure', 'Ralat semasa menyimpan data. Sila cuba lagi.');
    }
}



/**
 * Save Prestasi/TPA/Gaji tab data
 */
public function savePrestasiGaji(Request $request, $noKadPintar)
{
    $validated = $request->validate([
        'gaji_matrix' => 'required|array',
        'gaji_matrix.*.tahun' => 'nullable|string|max:4',
        'gaji_matrix.*.tarikh_kenaikan' => 'nullable|date',
        'gaji_matrix.*.gaji' => 'nullable|string|max:50',
        'gaji_matrix.*.percentage' => 'nullable|string|max:10',
        'gaji_matrix.*.tahap' => 'nullable|string|max:50',
        'gaji_matrix.*.lain' => 'nullable|string|max:255',
        'gaji_matrix.*.subjek' => 'nullable|string|max:255',
    ]);

    try {
        // Find the teacher
        $teacher = PemegangJawatanTeach::where('No Kad Pintar', $noKadPintar)->firstOrFail();

        // Delete existing records for this teacher
        GajiMatrix::where('no_kad_pintar', $noKadPintar)->delete();

        // Insert new records
        foreach ($validated['gaji_matrix'] as $row) {
            // Skip empty rows
            if (empty($row['tahun']) && empty($row['gaji']) && empty($row['tarikh_kenaikan'])) {
                continue;
            }

            GajiMatrix::create([
                'no_kad_pintar' => $noKadPintar,
                'tahun' => $row['tahun'] ?? null,
                'tarikh_kenaikan' => $row['tarikh_kenaikan'] ?? null,
                'gaji' => $row['gaji'] ?? null,
                'percentage' => $row['percentage'] ?? null,
                'tahap' => $row['tahap'] ?? null,
                'lain' => $row['lain'] ?? null,
                'subjek' => $row['subjek'] ?? null,
            ]);
        }

        return redirect()->back()->with('success', 'Maklumat Prestasi/TPA/Gaji berjaya dikemaskini!');

    } catch (\Exception $e) {
        Log::error('Error saving Prestasi/Gaji data: ' . $e->getMessage());
        return redirect()->back()->with('failure', 'Ralat semasa menyimpan data.');
    }
}

/**
 * Show teacher profile for editing
 */
public function show($noKadPintar)
{
    try {
        $teacher = PemegangJawatanTeach::where('No Kad Pintar', $noKadPintar)->firstOrFail();

        // Safely parse Tarikh Lahir and calculate age
        $teacher->parsedTarikhLahir = null;
        $teacher->age = null;

        if (!empty($teacher->{'Tarikh Lahir'})) {
            try {
                // Try multiple date formats
                $tarikhLahir = $this->parseDate($teacher->{'Tarikh Lahir'});

                if ($tarikhLahir) {
                    $teacher->parsedTarikhLahir = $tarikhLahir->format('Y-m-d');
                    $now = \Carbon\Carbon::now();
                    $diff = $tarikhLahir->diff($now);
                    $teacher->age = $diff->y . ' Tahun ' . $diff->m . ' Bulan';
                }
            } catch (\Exception $e) {
                \Log::warning("Could not parse Tarikh Lahir for {$noKadPintar}: " . $e->getMessage());
            }
        }

        // Calculate default retirement date (60 years from birth)
        $teacher->defaultTarikhTamat = '';
        if (!empty($teacher->parsedTarikhLahir)) {
            try {
                $birthDate = \Carbon\Carbon::parse($teacher->parsedTarikhLahir);
                $teacher->defaultTarikhTamat = $birthDate->copy()->addYears(60)->format('Y-m-d');
            } catch (\Exception $e) {
                \Log::warning("Could not calculate retirement date for {$noKadPintar}");
            }
        }

        // Safely parse other dates
        $teacher->parsedTarikhTamatKontrak = $this->parseDateSafe($teacher->{'Tarikh Tamat Kontrak'});
        $teacher->parsedTarikhMulaBerkhidmat = $this->parseDateSafe($teacher->{'Tarikh Mula Berkhidmat'});
        $teacher->parsedTarikhJawatanSekarang = $this->parseDateSafe($teacher->{'Tarikh Jawatan Sekarang'});
        $teacher->parsedTarikhDiaturBertugas = $this->parseDateSafe($teacher->{'Tarikh diatur bertugas sekarang'});
        $teacher->parsedTarikhPenetapan = $this->parseDateSafe($teacher->{'tarikhpenetapan'});
        $teacher->parsedTarikhKenaikan = $this->parseDateSafe($teacher->{'TarikhKenaikan'});
        $teacher->parsedTarikhGajiBulan = $this->parseDateSafe($teacher->{'Tarikh Gaji Bulan'});
        $teacher->parsedTarikhLulus = $this->parseDateSafe($teacher->{'tarikh lulus'});
        $teacher->parsedTarikhCutiBersara = $this->parseDateSafe($teacher->{'Tarikh Cuti Bersara'});

        return view('teachers.showteaching', compact('teacher'));

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return redirect()->route('teacher.index')->with('failure', 'Guru tidak dijumpai.');
    } catch (\Exception $e) {
        \Log::error('Error loading teacher profile: ' . $e->getMessage());
        return redirect()->route('teacher.index')->with('failure', 'Ralat semasa memuatkan profil.');
    }
}



/**
 * Parse date with multiple format attempts
 */
private function parseDate($dateString)
{
    if (empty($dateString) || trim($dateString) === '') {
        return null;
    }

    // Clean the date string
    $dateString = trim($dateString);

    // Array of possible date formats
    $formats = [
        'Y-m-d',           // 2024-01-15
        'd-m-Y',           // 15-01-2024
        'd/m/Y',           // 15/01/2024
        'd-M-y',           // 15-Jan-24
        'd-M-Y',           // 15-Jan-2024
        'j-M-y',           // 5-Jan-24
        'j-M-Y',           // 5-Jan-2024
        'd M Y',           // 15 Jan 2024
        'Y/m/d',           // 2024/01/15
        'm-d-Y',           // 01-15-2024
        'm/d/Y',           // 01/15/2024
    ];

    foreach ($formats as $format) {
        try {
            $date = \Carbon\Carbon::createFromFormat($format, $dateString);

            // Verify the date is valid
            if ($date && $date->format($format) === $dateString) {
                return $date;
            }
        } catch (\Exception $e) {
            // Continue to next format
            continue;
        }
    }

    // Last resort: try Carbon's parse method
    try {
        return \Carbon\Carbon::parse($dateString);
    } catch (\Exception $e) {
        \Log::warning("Unable to parse date: {$dateString}");
        return null;
    }
}

/**
 * Safely parse date and return formatted string
 */
private function parseDateSafe($dateString)
{
    try {
        $date = $this->parseDate($dateString);
        return $date ? $date->format('Y-m-d') : '';
    } catch (\Exception $e) {
        return '';
    }
}


/**
 * Save Penyambungan tab data
 */
public function savePenyambungan(Request $request, $noKadPintar)
{
    $validated = $request->validate([
        'penyambungan' => 'required|array',
        'penyambungan.*.tarikh_mula' => 'nullable|date',
        'penyambungan.*.tarikh_hingga' => 'nullable|date',
        'penyambungan.*.lain' => 'nullable|string|max:255',
    ]);

    try {
        // Find the teacher
        $teacher = PemegangJawatanTeach::where('No Kad Pintar', $noKadPintar)->firstOrFail();

        // Delete existing records for this teacher
        Penyambungan::where('no_kad_pintar', $noKadPintar)->delete();

        // Insert new records
        foreach ($validated['penyambungan'] as $row) {
            // Skip empty rows
            if (empty($row['tarikh_mula']) && empty($row['tarikh_hingga']) && empty($row['lain'])) {
                continue;
            }

            Penyambungan::create([
                'no_kad_pintar' => $noKadPintar,
                'tarikh_mula' => $row['tarikh_mula'] ?? null,
                'tarikh_hingga' => $row['tarikh_hingga'] ?? null,
                'lain' => $row['lain'] ?? null,
            ]);
        }

        return redirect()->back()->with('success', 'Maklumat Penyambungan berjaya dikemaskini!');

    } catch (\Exception $e) {
        Log::error('Error saving Penyambungan data: ' . $e->getMessage());
        return redirect()->back()->with('failure', 'Ralat semasa menyimpan data.');
    }
}
/**
 * Save Penempatan Bertugas tab data
 */
public function saveTempatBertugas(Request $request, $noKadPintar)
{
    $validated = $request->validate([
        'jenis_tempat_bertugas' => 'nullable|string|max:255',
        'daerah' => 'nullable|string|max:255',
        'jawatan_sekolah' => 'nullable|string|max:255',
        'tempat_bertugas_records' => 'required|array',
        'tempat_bertugas_records.*.tarikh_mula' => 'nullable|date',
        'tempat_bertugas_records.*.tempat_bertugas' => 'nullable|string|max:255',
        'tempat_bertugas_records.*.tarikh_hingga' => 'nullable|date',
    ]);

    try {
        // Find the teacher
        $teacher = PemegangJawatanTeach::where('No Kad Pintar', $noKadPintar)->firstOrFail();

        // Update basic fields in main teacher table
        $updateData = [];
        
        if ($request->has('jenis_tempat_bertugas')) {
            $updateData['Jenis Sekolah Tempat Bertugas'] = $validated['jenis_tempat_bertugas'];
        }
        
        if ($request->has('daerah')) {
            $updateData['Daerah'] = $validated['daerah'];
        }
        
        if ($request->has('jawatan_sekolah')) {
            $updateData['Jawatan disekolah'] = $validated['jawatan_sekolah'];
        }

        // Update teacher basic info if there's data to update
        if (!empty($updateData)) {
    PemegangJawatanTeach::where('No Kad Pintar', $noKadPintar)->update($updateData);
    Log::info('Teacher updated successfully for:', ['no_kad_pintar' => $noKadPintar]);
}

        // Delete existing tempat bertugas records for this teacher
        TempatBertugasTeaching::where('no_kad_pintar', $noKadPintar)->delete();

        // Insert new records
        foreach ($validated['tempat_bertugas_records'] as $row) {
            // Skip empty rows
            if (empty($row['tarikh_mula']) && empty($row['tempat_bertugas']) && empty($row['tarikh_hingga'])) {
                continue;
            }

            TempatBertugasTeaching::create([
                'no_kad_pintar' => $noKadPintar,
                'tarikh_mula' => $row['tarikh_mula'] ?? null,
                'tempat_bertugas' => $row['tempat_bertugas'] ?? null,
                'tarikh_hingga' => $row['tarikh_hingga'] ?? null,
            ]);
        }

        return redirect()->back()->with('success', 'Maklumat Penempatan Bertugas berjaya dikemaskini!');

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        Log::error("Teacher not found: {$noKadPintar}");
        return redirect()->back()->with('failure', 'Guru tidak dijumpai.');
    } catch (\Illuminate\Validation\ValidationException $e) {
        Log::error('Validation Error:', $e->errors());
        return redirect()->back()->withErrors($e->errors())->withInput();
    } catch (\Exception $e) {
        Log::error('Error saving Tempat Bertugas data:', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        return redirect()->back()->with('failure', 'Ralat semasa menyimpan data. Sila cuba lagi.');
    }
}

/**
 * Save Cuti tab data
 */
public function saveCuti(Request $request, $noKadPintar)
{

    // Delete existing cuti records
    CutiTeach::where('no_kad_pintar',$noKadPintar)->delete();


    /* ======================
       CUTI KHAS
    ====================== */

    if($request->cuti_khas){
        foreach($request->cuti_khas as $row){

            if(!empty($row['tarikh_mula_khas'])){

                CutiTeach::create([
                    'no_kad_pintar' => $noKadPintar,
                    'jenis_cuti' => 'khas',

                    'tarikh_mula_khas' => $row['tarikh_mula_khas'],
                    'tarikh_hingga_khas' => $row['tarikh_hingga_khas'],
                    'jumlah_khas' => $row['jumlah_khas'],
                    'justifikasi_khas' => $row['justifikasi_khas'],
                    'kategori_khas' => $row['kategori_khas'],
                    'status_khas' => $row['status_khas'],
                    'tarikh_melapor_khas' => $row['tarikh_melapor_khas'],
                ]);

            }

        }
    }


    /* ======================
       CUTI TANPA GAJI
    ====================== */

    if($request->ctg){
        foreach($request->ctg as $row){

            if(!empty($row['tarikh_mula_ctg'])){

                CutiTeach::create([
                    'no_kad_pintar' => $noKadPintar,
                    'jenis_cuti' => 'tanpa_gaji',

                    'tarikh_mula_ctg' => $row['tarikh_mula_ctg'],
                    'tarikh_hingga_ctg' => $row['tarikh_hingga_ctg'],
                    'jumlah_ctg' => $row['jumlah_ctg'],
                    'justifikasi_ctg' => $row['justifikasi_ctg'],
                    'kategori_ctg' => $row['kategori_ctg'],
                    'status_ctg' => $row['status_ctg'],
                    'tarikh_melapor_ctg' => $row['tarikh_melapor_ctg'],
                ]);

            }

        }
    }

    return back()->with('success','Maklumat cuti berjaya disimpan');

}


/**
 * Save Kursus tab data
 */
// public function saveKursus(Request $request, $noKadPintar)
// {
//     $validated = $request->validate([
//         // Program Latihan Jangka Pendek
//         'kursus_pendek_records' => 'nullable|array',
//         'kursus_pendek_records.*.nama_kursus' => 'nullable|string|max:255',
//         'kkursus_pendek_records.*.nama_penganjur' => 'nullable|string|max:255',
//         'kursus_pendek_records.*.negeri' => 'nullable|string|max:255',
//         'kursus_pendek_records.*.tarikh_mula' => 'nullable|date',
//         'kursus_pendek_records.*.tarikh_hingga' => 'nullable|date',
//         'kursus_pendek_records.*.mod_latihan' => 'nullable|string|max:255',
//         'kursus_pendek_records.*.kaedah_peruntukan' => 'nullable|string|max:255',

//         // Program Latihan Jangka Panjang
//         'kursus_panjang_records' => 'nullable|array',
//         'kursus_panjang_records.*.peringkat' => 'nullable|string|max:255',
//         'kursus_panjang_records.*.bidang' => 'nullable|string|max:255',
//         'kursus_panjang_records.*.institusi' => 'nullable|string|max:255',
//         'kursus_panjang_records.*.tarikh_mula' => 'nullable|date',
//         'kursus_panjang_records.*.tarikh_hingga' => 'nullable|date',
//         'kursus_panjang_records.*.jenis_ldp' => 'nullable|string|max:255',

//         // Program Mentoring
//         'mentoring_records' => 'nullable|array',
//         'mentoring_records.*.nama_mentor' => 'nullable|string|max:255',
//         'mentoring_records.*.nama_sekolah' => 'nullable|string|max:255',
//         'mentoring_records.*.tarikh_mula' => 'nullable|date',
//         'mentoring_records.*.tarikh_hingga' => 'nullable|date',

//         // Program Kepimpinan
//         'kepimpinan_records' => 'nullable|array',
//         'kepimpinan_records.*.siri' => 'nullable|string|max:255',
//         'kepimpinan_records.*.modul' => 'nullable|string|max:255',
//         'kepimpinan_records.*.tarikh' => 'nullable|date',
//         'kepimpinan_records.*.sesi' => 'nullable|string|max:255',
//     ]);

//     try {

//         $teacher = PemegangJawatanTeach::where('No Kad Pintar', $noKadPintar)->firstOrFail();

//         /*
//         |--------------------------------------------------------------------------
//         | PROGRAM LATIHAN JANGKA PENDEK
//         |--------------------------------------------------------------------------
//         */
//         KursusPendek::where('no_kad_pintar', $noKadPintar)->delete();

//         if (!empty($validated['kursus_pendek_records'])) {
//             foreach ($validated['kursus_pendek_records'] as $row) {

//                 if (
//                     empty($row['nama_kursus']) &&
//                     empty($row['nama_penganjur']) &&
//                     empty($row['tarikh_mula'])
//                 ) {
//                     continue;
//                 }

//                 KursusPendek::create([
//                     'no_kad_pintar' => $noKadPintar,
//                     'nama_kursus' => $row['nama_kursus'] ?? null,
//                     'nama_penganjur' => $row['nama_penganjur'] ?? null,
//                     'negeri' => $row['negeri'] ?? null,
//                     'tarikh_mula' => $row['tarikh_mula'] ?? null,
//                     'tarikh_hingga' => $row['tarikh_hingga'] ?? null,
//                     'mod_latihan' => $row['mod_latihan'] ?? null,
//                     'kaedah_peruntukan' => $row['kaedah_peruntukan'] ?? null,
//                 ]);
//             }
//         }

//         /*
//         |--------------------------------------------------------------------------
//         | PROGRAM LATIHAN JANGKA PANJANG
//         |--------------------------------------------------------------------------
//         */
//         KursusPanjang::where('no_kad_pintar', $noKadPintar)->delete();

//         if (!empty($validated['kursus_panjang_records'])) {
//             foreach ($validated['kursus_panjang_records'] as $row) {

//                 if (
//                     empty($row['peringkat']) &&
//                     empty($row['institusi']) &&
//                     empty($row['tarikh_mula'])
//                 ) {
//                     continue;
//                 }

//                 KursusPanjang::create([
//                     'no_kad_pintar' => $noKadPintar,
//                     'peringkat' => $row['peringkat'] ?? null,
//                     'bidang' => $row['bidang'] ?? null,
//                     'institusi' => $row['institusi'] ?? null,
//                     'tarikh_mula' => $row['tarikh_mula'] ?? null,
//                     'tarikh_hingga' => $row['tarikh_hingga'] ?? null,
//                     'jenis_ldp' => $row['jenis_ldp'] ?? null,
//                 ]);
//             }
//         }

//         /*
//         |--------------------------------------------------------------------------
//         | PROGRAM MENTORING
//         |--------------------------------------------------------------------------
//         */
//         MentoringProgram::where('no_kad_pintar', $noKadPintar)->delete();

//         if (!empty($validated['mentoring_records'])) {
//             foreach ($validated['mentoring_records'] as $row) {

//                 if (
//                     empty($row['nama_mentor']) &&
//                     empty($row['nama_sekolah'])
//                 ) {
//                     continue;
//                 }

//                 MentoringProgram::create([
//                     'no_kad_pintar' => $noKadPintar,
//                     'nama_mentor' => $row['nama_mentor'] ?? null,
//                     'nama_sekolah' => $row['nama_sekolah'] ?? null,
//                     'tarikh_mula' => $row['tarikh_mula'] ?? null,
//                     'tarikh_hingga' => $row['tarikh_hingga'] ?? null,
//                 ]);
//             }
//         }

//         /*
//         |--------------------------------------------------------------------------
//         | PROGRAM LATIHAN KEPIMPINAN
//         |--------------------------------------------------------------------------
//         */
//         KepimpinanProgram::where('no_kad_pintar', $noKadPintar)->delete();

//         if (!empty($validated['kepimpinan_records'])) {
//             foreach ($validated['kepimpinan_records'] as $row) {

//                 if (
//                     empty($row['siri']) &&
//                     empty($row['modul'])
//                 ) {
//                     continue;
//                 }

//                 KepimpinanProgram::create([
//                     'no_kad_pintar' => $noKadPintar,
//                     'siri' => $row['siri'] ?? null,
//                     'modul' => $row['modul'] ?? null,
//                     'tarikh' => $row['tarikh'] ?? null,
//                     'sesi' => $row['sesi'] ?? null,
//                 ]);
//             }
//         }

//         return redirect()->back()->with('success', 'Maklumat kursus berjaya dikemaskini!');

//     } catch (\Exception $e) {

//         Log::error('Error saving Kursus data: ' . $e->getMessage());

//         return redirect()->back()->with('failure', 'Ralat semasa menyimpan data.');
//     }
// }

public function saveKursus(Request $request, $noKadPintar)
{

    KursusTeach::where('no_kad_pintar',$noKadPintar)->delete();

    /* ======================
       PROGRAM PENDEK
    ====================== */

    if($request->kursus_pendek_records){
        foreach($request->kursus_pendek_records as $row){

            if(!empty($row['nama_kursus'])){

                KursusTeach::create([
                    'no_kad_pintar' => $noKadPintar,
                    'jenis_program' => 'pendek',

                    'nama_kursus' => $row['nama_kursus'],
                    'nama_penganjur' => $row['nama_penganjur'],
                    'negeri' => $row['negeri'],
                    'tarikh_mula_pendek' => $row['tarikh_mula_pendek'],
                    'tarikh_hingga_pendek' => $row['tarikh_hingga_pendek'],
                    'mod_latihan' => $row['mod_latihan'],
                    'kaedah_peruntukan' => $row['kaedah_peruntukan'],
                ]);

            }

        }
    }

    /* ======================
       PROGRAM PANJANG
    ====================== */

    if($request->kursus_panjang_records){
        foreach($request->kursus_panjang_records as $row){

            if(!empty($row['peringkat'])){

                KursusTeach::create([
                    'no_kad_pintar'=>$noKadPintar,
                    'jenis_program'=>'panjang',

                    'peringkat'=>$row['peringkat'],
                    'bidang'=>$row['bidang'],
                    'nama_institusi'=>$row['nama_institusi'],
                    'tarikh_mula_panjang'=>$row['tarikh_mula_panjang'],
                    'tarikh_hingga_panjang'=>$row['tarikh_hingga_panjang'],
                    'jenis_ldp'=>$row['jenis_ldp']
                ]);

            }

        }
    }

    /* ======================
       PROGRAM MENTORING
    ====================== */

    if($request->kursus_mentoring_records){
        foreach($request->kursus_mentoring_records as $row){

            if(!empty($row['nama_mentor'])){

                KursusTeach::create([
                    'no_kad_pintar'=>$noKadPintar,
                    'jenis_program'=>'mentoring',

                    'nama_mentor'=>$row['nama_mentor'],
                    'nama_sekolah'=>$row['nama_sekolah'],
                    'tarikh_mula_mentoring'=>$row['tarikh_mula_mentoring'],
                    'tarikh_hingga_mentoring'=>$row['tarikh_hingga_mentoring']
                ]);

            }

        }
    }

    /* ======================
       PROGRAM KEPIMPINAN
    ====================== */

    if($request->kursus_latihan_records){
        foreach($request->kursus_latihan_records as $row){

            if(!empty($row['siri'])){

                KursusTeach::create([
                    'no_kad_pintar'=>$noKadPintar,
                    'jenis_program'=>'kepimpinan',

                    'siri'=>$row['siri'],
                    'modul'=>$row['modul'],
                    'tarikh'=>$row['tarikh'],
                    'sesi'=>$row['sesi']
                ]);

            }

        }
    }

    return back()->with('success','Maklumat kursus berjaya disimpan');

}


/**
 * Save Kelulusan tab data
 */
public function saveKelulusan(Request $request, $noKadPintar)
{
    $validated = $request->validate([
        'kelulusanTertinggi' => 'nullable|string|max:255',
        'filterkelulusan' => 'nullable|string|max:255',
        'tarikhLulus' => 'nullable|date',
        'sijilGuru' => 'nullable|string|max:255',
        'bidang' => 'nullable|string|max:255',
        'mengajar' => 'nullable|string|max:255',
        'sijilGuruFile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    try {
        // Find the teacher
        $teacher = PemegangJawatanTeach::where('No Kad Pintar', $noKadPintar)->firstOrFail();

        // Prepare update data
        $updateData = [];
        
        if ($request->filled('kelulusanTertinggi')) {
            $updateData['Kelulusan Tertnggi'] = $validated['kelulusanTertinggi'];
        }
        
        if ($request->filled('filterkelulusan')) {
            $updateData['filterkelulusan'] = $validated['filterkelulusan'];
        }
        
        // Handle date with proper parsing
        if ($request->filled('tarikhLulus')) {
            try {
                $date = \Carbon\Carbon::createFromFormat('Y-m-d', $validated['tarikhLulus']);
                $updateData['tarikh lulus'] = $date->format('d-M-y'); // Store as d-M-y
            } catch (\Carbon\Exceptions\InvalidFormatException $e) {
                Log::warning('Invalid date format for tarikhLulus: ' . $validated['tarikhLulus']);
                return redirect()->back()->with('failure', 'Format tarikh tidak sah.');
            }
        }
        
        if ($request->filled('sijilGuru')) {
            $updateData['Sijil Guru'] = $validated['sijilGuru'];
        }
        
        if ($request->filled('bidang')) {
            $updateData['Bidang'] = $validated['bidang'];
        }
        
        if ($request->filled('mengajar')) {
            $updateData['Mengajar'] = $validated['mengajar'];
        }

        // Handle file upload for Sijil Guru
        if ($request->hasFile('sijilGuruFile')) {
            $file = $request->file('sijilGuruFile');
            $filename = 'sijil_guru_' . $noKadPintar . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('sijil_guru', $filename, 'public');
            $updateData['sijil_guru_file'] = $path;
        }

        // Log what we're about to update
        Log::info('Updating Kelulusan data:', [
            'no_kad_pintar' => $noKadPintar,
            'data' => $updateData
        ]);

        // Update only if there's data to update
        if (!empty($updateData)) {
    PemegangJawatanTeach::where('No Kad Pintar', $noKadPintar)->update($updateData);
    Log::info('Teacher updated successfully for:', ['no_kad_pintar' => $noKadPintar]);
}


        return redirect()->back()->with('success', 'Maklumat Kelulusan berjaya dikemaskini!');

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        Log::error("Teacher not found: {$noKadPintar}");
        return redirect()->back()->with('failure', 'Guru tidak dijumpai.');
    } catch (\Illuminate\Validation\ValidationException $e) {
        Log::error('Validation Error:', $e->errors());
        return redirect()->back()->withErrors($e->errors())->withInput();
    } catch (\Exception $e) {
        Log::error('Error saving Kelulusan data:', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        return redirect()->back()->with('failure', 'Ralat semasa menyimpan data. Sila cuba lagi.');
    }
}

/**
 * Save History Jawatan tab data
 */
public function saveHistoryJawatan(Request $request, $noKadPintar) 
{
    $validated = $request->validate([
        'ruj_spg' => 'nullable|string|max:255',
        'sejarah_jawatan' => 'required|array',
        'sejarah_jawatan.*.jawatan' => 'nullable|string|max:255',
        'sejarah_jawatan.*.tarikh_lantikan' => 'nullable|date',
        'sejarah_jawatan.*.peruntukan' => 'nullable|string|max:255',
        'sejarah_jawatan.*.tempat_bertugas' => 'nullable|string|max:255',
    ]);

    try {
        // Find the teacher (ensures record exists)
        $teacher = PemegangJawatanTeach::where('No Kad Pintar', $noKadPintar)->firstOrFail();

        // Prepare update data for main teacher table
        $updateData = [];

        if ($request->filled('ruj_spg')) {
            $updateData['Ruj Memo SPA SPG'] = $validated['ruj_spg'];
        }

        // ✅ Only update if we have valid data
        if (!empty($updateData)) {
            PemegangJawatanTeach::where('No Kad Pintar', $noKadPintar)->update($updateData);
            Log::info('Teacher main data updated successfully for:', [
                'no_kad_pintar' => $noKadPintar,
                'update_data' => $updateData
            ]);
        }

        // Delete existing sejarah jawatan records
        SejarahJawatanTeaching::where('no_kad_pintar', $noKadPintar)->delete();

        // Insert new records
        foreach ($validated['sejarah_jawatan'] as $row) {
            if (
                empty($row['jawatan']) && 
                empty($row['tarikh_lantikan']) && 
                empty($row['peruntukan']) && 
                empty($row['tempat_bertugas'])
            ) {
                continue;
            }

            SejarahJawatanTeaching::create([
                'no_kad_pintar' => $noKadPintar,
                'jawatan' => $row['jawatan'] ?? null,
                'tarikh_lantikan' => $row['tarikh_lantikan'] ?? null,
                'peruntukan' => $row['peruntukan'] ?? null,
                'tempat_bertugas' => $row['tempat_bertugas'] ?? null,
            ]);
        }

        return redirect()->back()->with('success', 'Maklumat History Jawatan berjaya dikemaskini!');

    } catch (\Exception $e) {
        Log::error('Error saving History Jawatan data:', [
            'no_kad_pintar' => $noKadPintar,
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        return redirect()->back()->with('failure', 'Ralat semasa menyimpan data.');
    }
}

public function saveBersara(Request $request, $noKadPintar)
{
    // Log ALL incoming request data
    Log::info('=== BERSARA SAVE REQUEST ===', [
        'no_kad_pintar' => $noKadPintar,
        'all_request_data' => $request->all(),
        'tatatertib_raw' => $request->input('tatatertib'),
        'tatatertib_has' => $request->has('tatatertib'),
        'tatatertib_filled' => $request->filled('tatatertib'),
    ]);

    $validated = $request->validate([
        'peruntukanBersara' => 'nullable|string|max:255',
        'jabatanTempatBertugas' => 'nullable|string|max:255',
        'bahagianTempatBertugas' => 'nullable|string|max:255',
        'jawatanSekolah' => 'nullable|string|max:255',
        'filterBersara' => 'nullable|string|max:255',
        'jawatanBersara' => 'nullable|string|max:255',
        'tatatertib' => 'nullable|in:1',
        'tarikhBersaraOverride' => 'nullable|date',
        'catatanTatatertib' => 'nullable|string|max:1000',
        'tarikhCutiBersara' => 'nullable|date',
        'tarikhTamatKontrak' => 'nullable|date',
    ]);

    Log::info('=== VALIDATED DATA ===', $validated);

    try {
        // Find the teacher
        $teacher = PemegangJawatanTeach::where('No Kad Pintar', $noKadPintar)->firstOrFail();

        $updateData = [];
        
        if ($request->filled('peruntukanBersara')) {
            $updateData['Peruntukan Bersara'] = $validated['peruntukanBersara'];
        }
        
        if ($request->filled('jabatanTempatBertugas')) {
            $updateData['Jabatan Tempat Bertugas'] = $validated['jabatanTempatBertugas'];
        }
        
        if ($request->filled('bahagianTempatBertugas')) {
            $updateData['Bahagian Tempat Bertugas'] = $validated['bahagianTempatBertugas'];
        }
        
        if ($request->filled('jawatanSekolah')) {
            $updateData['Jawatan disekolah'] = $validated['jawatanSekolah'];
        }
        
        if ($request->filled('filterBersara')) {
            $updateData['Filter Bersara'] = $validated['filterBersara'];
        }
        
        if ($request->filled('jawatanBersara')) {
            $updateData['Jawatan Bersara'] = $validated['jawatanBersara'];
        }
        
        // ALWAYS save tatatertib state (0 or 1)
        $tatatertibValue = $request->input('tatatertib') === '1' ? 1 : 0;
        $updateData['tatatertib'] = $tatatertibValue;
        
        Log::info('=== TATATERTIB PROCESSING ===', [
            'input_value' => $request->input('tatatertib'),
            'saved_value' => $tatatertibValue,
            'is_checked' => $tatatertibValue === 1
        ]);
        
        // If tatatertib is checked
        if ($tatatertibValue === 1) {
            Log::info('Tatatertib is CHECKED, processing override data...');
            
            // Save override date if provided
            if ($request->filled('tarikhBersaraOverride')) {
                try {
                    $date = \Carbon\Carbon::createFromFormat('Y-m-d', $validated['tarikhBersaraOverride']);
                    $updateData['tarikhBersaraOverride'] = $date->format('Y-m-d');
                    
                    
                    Log::info('Override date saved:', [
                        'tarikhBersaraOverride' => $updateData['tarikhBersaraOverride'],
                        'Tarikh Tamat Kontrak' => $updateData['Tarikh Tamat Kontrak']
                    ]);
                } catch (\Exception $e) {
                    Log::error('Error parsing tarikhBersaraOverride: ' . $e->getMessage());
                }
            } else {
                Log::warning('tarikhBersaraOverride not filled');
            }
            
            // Save catatan if provided
            if ($request->filled('catatanTatatertib')) {
                $updateData['catatan_tatatertib'] = $validated['catatanTatatertib'];
                Log::info('Catatan saved:', ['catatan' => $updateData['catatan_tatatertib']]);
            } else {
                Log::warning('catatanTatatertib not filled');
            }
        } else {
            Log::info('Tatatertib is UNCHECKED, clearing related fields');
            // If unchecked, clear the tatatertib-related fields
            $updateData['catatan_tatatertib'] = null;
            $updateData['tarikhBersaraOverride'] = null;
        }
        
        // Handle Tarikh Cuti Bersara
        if ($request->filled('tarikhCutiBersara')) {
            try {
                $date = \Carbon\Carbon::createFromFormat('Y-m-d', $validated['tarikhCutiBersara']);
                $updateData['Tarikh Cuti Bersara'] = $date->format('d-M-y');
            } catch (\Exception $e) {
                Log::warning('Could not parse tarikhCutiBersara');
            }
        }
        
        // Handle Tarikh Tamat Kontrak (only if not overridden by tatatertib)
if ($tatatertibValue !== 1 && $request->filled('tarikhTamatKontrak')) {
    try {
        $date = \Carbon\Carbon::createFromFormat('Y-m-d', $validated['tarikhTamatKontrak']);
        $updateData['Tarikh Tamat Kontrak'] = $date->format('Y-m-d');
        Log::info('Tarikh Tamat Kontrak saved:', ['Tarikh Tamat Kontrak' => $updateData['Tarikh Tamat Kontrak']]);
    } catch (\Exception $e) {
        Log::warning('Could not parse tarikhTamatKontrak: ' . $e->getMessage());
    }
}


       // Log final update data
Log::info('=== FINAL UPDATE DATA ===', [
    'no_kad_pintar' => $noKadPintar,
    'update_data' => $updateData
]);

        // Update ONLY this teacher's record
        if (!empty($updateData)) {
    PemegangJawatanTeach::where('No Kad Pintar', $noKadPintar)->update($updateData);
    Log::info('Teacher updated successfully for:', ['no_kad_pintar' => $noKadPintar]);
} else {
    Log::warning('No data to update for:', ['no_kad_pintar' => $noKadPintar]);
}

        return redirect()->back()->with('success', 'Maklumat Peruntukan/Bersara berjaya dikemaskini!');

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        Log::error("Teacher not found: {$noKadPintar}");
        return redirect()->back()->with('failure', 'Guru tidak dijumpai.');
    } catch (\Exception $e) {
        Log::error('Error saving Bersara data:', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        return redirect()
    ->back()
    ->with('success', 'Maklumat berjaya dikemaskini.')
    ->with('tarikhBersaraOverride', $updateData['tarikhBersaraOverride'] ?? null);

    }
}

public function saveLainLainHal(Request $request, $noKadPintar)
{
    $validated = $request->validate([
        'catatan_tambahan' => 'nullable|string|max:5000',
    ]);

    try {
        // Find the teacher by No Kad Pintar
        $teacher = PemegangJawatanTeach::where('No Kad Pintar', $noKadPintar)->firstOrFail();

        $updateData = [
            'Catatan Tambahan' => $validated['catatan_tambahan'] ?? null,
        ];

        // Update ONLY this teacher
        PemegangJawatanTeach::where('No Kad Pintar', $noKadPintar)->update($updateData);

        Log::info('Lain-lain hal updated successfully for:', [
            'no_kad_pintar' => $noKadPintar,
            'update_data' => $updateData
        ]);

        return redirect()->back()->with('success', 'Maklumat Lain-lain hal berjaya disimpan!');

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        Log::error("Teacher not found for Lain-lain hal: {$noKadPintar}");
        return redirect()->back()->with('failure', 'Guru tidak dijumpai.');
    } catch (\Exception $e) {
        Log::error('Error saving Lain-lain hal:', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        return redirect()->back()->with('failure', 'Ralat semasa menyimpan data.');
    }
}
/**
 * Save Profile tab data
 */
public function saveProfile(Request $request, $noKadPintar)
{
    // Log incoming data for debugging
    Log::info('=== PROFILE SAVE REQUEST ===', [
        'no_kad_pintar' => $noKadPintar,
        'all_data' => $request->all()
    ]);

    $validated = $request->validate([
        'Nama' => 'nullable|string|max:255',
        'NoKadPintar' => 'nullable|string|max:255',
        'KodTempatBertugas' => 'nullable|string|max:255',
        'Jantina' => 'nullable|string|max:20',
        'TanggaGajiSebenar' => 'nullable|string|max:255',
        'TarikhLahir' => 'nullable|date',
        'TarikhTamatKontrak' => 'nullable|date',
        'TarikhMulaBerkhidmat' => 'nullable|date',
        'TarikhJawatanSekarang' => 'nullable|date',
        'TarikhDiaturBertugasSekarang' => 'nullable|date',
        'SekolahTempatBertugas' => 'nullable|string|max:255',
        'JabatanTempatBertugas' => 'nullable|string|max:255',
        'GajiSekarang' => 'nullable|string|max:255',
        'TarikhGajiBulan' => 'nullable|date',
        'TarikhPenetapan' => 'nullable|date',
        'TarikhKenaikan' => 'nullable|string|max:50', // ✅ Changed to string
        'JenisPerkhidmatan' => 'nullable|string|max:50',
    ]);

    try {
        // Find the teacher
        $teacher = PemegangJawatanTeach::where('No Kad Pintar', $noKadPintar)->firstOrFail();

        // Prepare update data
        $updateData = [];

        if ($request->has('Nama')) {
            $updateData['Nama'] = $validated['Nama'];
        }

        if ($request->has('KodTempatBertugas')) {
            $updateData['Kod Tempat Bertugas'] = $validated['KodTempatBertugas'];
        }

        if ($request->has('Jantina')) {
            $updateData['Jantina'] = $validated['Jantina'];
        }

        if ($request->has('TanggaGajiSebenar')) {
            $updateData['Tanggagaji Sebenar'] = $validated['TanggaGajiSebenar'];
        }

        if ($request->has('TarikhLahir') && !empty($validated['TarikhLahir'])) {
            try {
                $date = \Carbon\Carbon::createFromFormat('Y-m-d', $validated['TarikhLahir']);
                $updateData['Tarikh Lahir'] = $date->format('Y-m-d');
                
                Log::info('TarikhLahir saved:', ['value' => $date->format('Y-m-d')]);
            } catch (\Exception $e) {
                Log::warning('Could not parse TarikhLahir: ' . $e->getMessage());
            }
        }

        if ($request->has('TarikhTamatKontrak') && !empty($validated['TarikhTamatKontrak'])) {
            try {
                $date = \Carbon\Carbon::createFromFormat('Y-m-d', $validated['TarikhTamatKontrak']);
                $updateData['Tarikh Tamat Kontrak'] = $date->format('d-M-y');
                
                Log::info('Tarikh Tamat Kontrak saved:', [
                    'input' => $validated['TarikhTamatKontrak'],
                    'saved_as' => $date->format('d-M-y')
                ]);
            } catch (\Exception $e) {
                Log::error('Could not parse TarikhTamatKontrak: ' . $e->getMessage());
            }
        }

        if ($request->has('TarikhMulaBerkhidmat') && !empty($validated['TarikhMulaBerkhidmat'])) {
            try {
                $date = \Carbon\Carbon::createFromFormat('Y-m-d', $validated['TarikhMulaBerkhidmat']);
                $updateData['Tarikh Mula Berkhidmat'] = $date->format('d-M-y');
                
                Log::info('TarikhMulaBerkhidmat saved:', ['value' => $date->format('d-M-y')]);
            } catch (\Exception $e) {
                Log::warning('Could not parse TarikhMulaBerkhidmat: ' . $e->getMessage());
            }
        }

        if ($request->has('TarikhJawatanSekarang') && !empty($validated['TarikhJawatanSekarang'])) {
            try {
                $date = \Carbon\Carbon::createFromFormat('Y-m-d', $validated['TarikhJawatanSekarang']);
                $updateData['Tarikh Jawatan Sekarang'] = $date->format('d-M-y');
                
                Log::info('TarikhJawatanSekarang saved:', ['value' => $date->format('d-M-y')]);
            } catch (\Exception $e) {
                Log::warning('Could not parse TarikhJawatanSekarang: ' . $e->getMessage());
            }
        }

        if ($request->has('TarikhDiaturBertugasSekarang') && !empty($validated['TarikhDiaturBertugasSekarang'])) {
            try {
                $date = \Carbon\Carbon::createFromFormat('Y-m-d', $validated['TarikhDiaturBertugasSekarang']);
                $updateData['Tarikh diatur bertugas sekarang'] = $date->format('d-M-y');
                
                Log::info('TarikhDiaturBertugasSekarang saved:', ['value' => $date->format('d-M-y')]);
            } catch (\Exception $e) {
                Log::warning('Could not parse TarikhDiaturBertugasSekarang: ' . $e->getMessage());
            }
        }

        if ($request->has('SekolahTempatBertugas')) {
            $updateData['Sekolah Tempat Bertugas'] = $validated['SekolahTempatBertugas'];
        }

        if ($request->has('JabatanTempatBertugas')) {
            $updateData['Jabatan Tempat Bertugas'] = $validated['JabatanTempatBertugas'];
        }

        if ($request->has('GajiSekarang')) {
            $updateData['Gaji Sekarang'] = $validated['GajiSekarang'];
        }

        if ($request->has('TarikhGajiBulan') && !empty($validated['TarikhGajiBulan'])) {
            try {
                $date = \Carbon\Carbon::createFromFormat('Y-m-d', $validated['TarikhGajiBulan']);
                $updateData['Tarikh Gaji Bulan'] = $date->format('d-M-y');
                
                Log::info('TarikhGajiBulan saved:', ['value' => $date->format('d-M-y')]);
            } catch (\Exception $e) {
                Log::warning('Could not parse TarikhGajiBulan: ' . $e->getMessage());
            }
        }

        if ($request->has('TarikhPenetapan') && !empty($validated['TarikhPenetapan'])) {
            try {
                $date = \Carbon\Carbon::createFromFormat('Y-m-d', $validated['TarikhPenetapan']);
                $updateData['tarikhpenetapan'] = $date->format('d-M-y');
                
                Log::info('TarikhPenetapan saved:', ['value' => $date->format('d-M-y')]);
            } catch (\Exception $e) {
                Log::warning('Could not parse TarikhPenetapan: ' . $e->getMessage());
            }
        }

        // Save TarikhKenaikan as text (e.g., "01 MAC")
        if ($request->has('TarikhKenaikan')) {
            $updateData['TarikhKenaikan'] = $validated['TarikhKenaikan'];
            
            Log::info('TarikhKenaikan saved as text:', [
                'value' => $validated['TarikhKenaikan']
            ]);
        }

        if ($request->has('JenisPerkhidmatan')) {
            $updateData['Jenis Perkhidmatan'] = $validated['JenisPerkhidmatan'];
        }

        // Log what we're updating
        Log::info('=== PROFILE UPDATE DATA ===', $updateData);

        // Update the teacher
        if (!empty($updateData)) {
            $teacher->update($updateData);
            Log::info('=== PROFILE UPDATE SUCCESSFUL ===');
        }

        return redirect()->back()->with('success', 'Profil berjaya dikemaskini!');

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        Log::error("Teacher not found: {$noKadPintar}");
        return redirect()->back()->with('failure', 'Guru tidak dijumpai.');
    } catch (\Exception $e) {
        Log::error('Error saving teacher profile:', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        return redirect()->back()->with('failure', 'Ralat semasa menyimpan data: ' . $e->getMessage());
    }
}
}