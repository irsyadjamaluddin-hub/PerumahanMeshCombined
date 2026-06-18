<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CCA;
use App\Models\School;
use App\Models\CCASenarai;
use App\Models\Employment;
use App\Models\Gender;
use App\Models\Cluster;
use App\Models\CCA_Name;
use App\Models\CCA_Kaitan;

use Auth;
use Hash;
use DB;

class CCAReportController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }


    public function ccareport()
    {
        $CCAs = CCA::count();
        
	$jumlahLelaki = CCA::select('kelab_ccas.*')->where('year', date('Y'))
    ->sum(\DB::raw(
            'ISNULL(jum_lelaki_pra,0)+ ISNULL(jum_lelaki_1,0) + ISNULL(jum_lelaki_2,0) + ISNULL(jum_lelaki_3,0)
                + ISNULL(jum_lelaki_4,0) +  ISNULL(jum_lelaki_5,0) + ISNULL(jum_lelaki_6,0) 
                 + ISNULL(jum_lelaki_7,0) +  ISNULL(jum_lelaki_8,0) + ISNULL(jum_lelaki_9,0) 
                  + ISNULL(jum_lelaki_10,0) +  ISNULL(jum_lelaki_11,0) + ISNULL(jum_lelaki_12,0)  + ISNULL(jum_lelaki_13,0) '));

                  $jumlahlelakiberkeperluankhas = CCA::select('kelab_ccas.*')->where('year', date('Y'))->get()
                  ->sum(\DB::raw(
                           'ISNULL(jum_lelaki_pra_khas, 0) + ISNULL(jum_lelaki_1_khas, 0) + ISNULL(jum_lelaki_2_khas, 0) +
         ISNULL(jum_lelaki_3_khas, 0) + ISNULL(jum_lelaki_4_khas, 0) + ISNULL(jum_lelaki_5_khas, 0) +
         ISNULL(jum_lelaki_6_khas, 0) + ISNULL(jum_lelaki_7_khas, 0) + ISNULL(jum_lelaki_8_khas, 0) +
         ISNULL(jum_lelaki_9_khas, 0) + ISNULL(jum_lelaki_10_khas, 0) + ISNULL(jum_lelaki_11_khas, 0) +
         ISNULL(jum_lelaki_12_khas, 0) + ISNULL(jum_lelaki_13_khas, 0)' ));



    
        $jumlahPerempuan = CCA::select('kelab_ccas.*')->where('year', date('Y'))
        ->sum(\DB::raw(
            'ISNULL(jum_perempuan_pra,0)+ ISNULL(jum_perempuan_1,0) + ISNULL(jum_perempuan_2,0) 
            + ISNULL(jum_perempuan_3,0) + ISNULL(jum_perempuan_4,0) 
             + ISNULL(jum_perempuan_5,0) + ISNULL(jum_perempuan_6,0) 
                + ISNULL(jum_perempuan_7,0) + ISNULL(jum_perempuan_8,0) 
             + ISNULL(jum_perempuan_9,0) + ISNULL(jum_perempuan_10,0) 
                + ISNULL(jum_perempuan_11,0) + ISNULL(jum_perempuan_12,0) 
             + ISNULL(jum_perempuan_13,0)
                
                
                '));

                $jumlahperempuanberkeperluankhas = CCA::select('kelab_ccas.*')->where('year', date('Y'))->get()
                ->sum(\DB::raw(
                   'ISNULL(jum_perempuan_pra_khas, 0) + ISNULL(jum_perempuan_1_khas, 0) + ISNULL(jum_perempuan_2_khas, 0) +
                 ISNULL(jum_perempuan_3_khas, 0) + ISNULL(jum_perempuan_4_khas, 0) + ISNULL(jum_perempuan_5_khas, 0) +
                 ISNULL(jum_perempuan_6_khas, 0) + ISNULL(jum_perempuan_7_khas, 0) + ISNULL(jum_perempuan_8_khas, 0) +
                 ISNULL(jum_perempuan_9_khas, 0) + ISNULL(jum_perempuan_10_khas, 0) + ISNULL(jum_perempuan_11_khas, 0) +
                 ISNULL(jum_perempuan_12_khas, 0) + ISNULL(jum_perempuan_13_khas, 0)'
                        
                        ));


        $jumlah = $jumlahLelaki + $jumlahPerempuan;
            
        $jumlahRendah = CCA::select('kelab_ccas.*')->sum(\DB::raw('jum_lelaki_pra + jum_perempuan_pra + jum_lelaki_1 + jum_perempuan_1 + jum_lelaki_2 + jum_perempuan_2 + jum_lelaki_3 + jum_perempuan_3 + jum_lelaki_4 + jum_perempuan_4 + jum_lelaki_5 + jum_perempuan_5 + jum_lelaki_6 + jum_perempuan_6'));
        $jumlahMenengah = CCA::select('kelab_ccas.*')->sum(\DB::raw('jum_lelaki_7 + jum_perempuan_7 + jum_lelaki_8 + jum_perempuan_8 + jum_lelaki_9 + jum_perempuan_9 + jum_lelaki_10 + jum_perempuan_10 + jum_lelaki_11 + jum_perempuan_11'));
        $jumlahSixthForm = CCA::select('kelab_ccas.*')->sum(\DB::raw('jum_lelaki_12 + jum_perempuan_12 + jum_lelaki_13 + jum_perempuan_13'));

        $kluster1 = CCA::select('kelab_ccas.*')
        ->where('year', date('Y'))
        ->where('kluster', '1')->count();

        $kluster2 = CCA::select('kelab_ccas.*')
        ->where('year', date('Y'))
        ->where('kluster', '2')->count();

        $kluster3 = CCA::select('kelab_ccas.*')
        ->where('year', date('Y'))
        ->where('kluster', '3')->count();

        $kluster4 = CCA::select('kelab_ccas.*')
        ->where('year', date('Y'))
        ->where('kluster', '4')->count();
        
        $kluster5 = CCA::select('kelab_ccas.*')
        ->where('year', date('Y'))
        ->where('kluster', '5')->count();

        $kluster6 = CCA::select('kelab_ccas.*')
        ->where('year', date('Y'))
        ->where('kluster', '6')->count();

    //    $checklistcca = CCASenarai::leftJoin('cca_names', 'cca_senarais.nama_cca', '=', 'cca_names.id')
    //         ->select('cca_senarais.*', 'cca_names.komponen')
    //         //->whereYear('updated_at', 2025)
    //         ->whereRaw("YEAR(TRY_CONVERT(DATETIME, updated_at)) = 2025")
            // ->get();

            $checklistcca = CCASenarai::leftJoin('cca_names', 'cca_senarais.nama_cca', '=', 'cca_names.id')
            ->select('cca_senarais.*', 'cca_names.komponen')
            ->whereRaw("YEAR(TRY_CONVERT(DATETIME, created_at)) =?", [date('Y')])
            ->get();

        $Kerohanian = 0;
        $Fizikal = 0;
        $Kreativiti = 0;
        $Perkhidmatan = 0;


        foreach ($checklistcca as $item) {
            if ($item->komponen === 'Kerohanian') {
            $Kerohanian++;
        }if ($item->komponen === 'Fizikal') {
            $Fizikal++;
        }if ($item->komponen === 'Kreativiti') {
            $Kreativiti++;
        }if ($item->komponen === 'Perkhidmatan') {
            $Perkhidmatan++;
        }
    };

        $totalRL = CCA::select('kelab_ccas.*')->where('year', date('Y'))->sum(\DB::raw('ISNULL(jum_lelaki_pra,0)+ ISNULL(jum_lelaki_1,0) + ISNULL(jum_lelaki_2,0) + ISNULL(jum_lelaki_3,0) + ISNULL(jum_lelaki_4,0) +  ISNULL(jum_lelaki_5,0) + ISNULL(jum_lelaki_6,0) '));
        $totalRP = CCA::select('kelab_ccas.*')->where('year', date('Y'))->sum(\DB::raw('ISNULL(jum_perempuan_pra,0)+ ISNULL(jum_perempuan_1,0) + ISNULL(jum_perempuan_2,0) + ISNULL(jum_perempuan_3,0) + ISNULL(jum_perempuan_4,0) + ISNULL(jum_perempuan_5,0) + ISNULL(jum_perempuan_6,0)'));

        $totalML = CCA::select('kelab_ccas.*')->where('year', date('Y'))->sum(\DB::raw('ISNULL(jum_lelaki_7,0) + ISNULL(jum_lelaki_8,0) + ISNULL(jum_lelaki_9,0) + ISNULL(jum_lelaki_10,0) + ISNULL(jum_lelaki_11,0)'));
        $totalMP = CCA::select('kelab_ccas.*')->where('year', date('Y'))->sum(\DB::raw('ISNULL(jum_perempuan_7,0) + ISNULL(jum_perempuan_8,0) + ISNULL(jum_perempuan_9,0) + ISNULL(jum_perempuan_10,0) + ISNULL(jum_perempuan_11,0)'));
        
        $totalPL = CCA::select('kelab_ccas.*')->where('year', date('Y'))->sum(\DB::raw('ISNULL(jum_lelaki_12,0) + ISNULL(jum_lelaki_13,0)'));
        $totalPP = CCA::select('kelab_ccas.*')->where('year', date('Y'))->sum(\DB::raw('ISNULL(jum_perempuan_12,0) + ISNULL(jum_perempuan_13,0)'));
        
        
        // RENDAH

        $pecahankelabr = CCASenarai::leftJoin('cca_names', 'cca_senarais.nama_cca', '=', 'cca_names.id')
            ->select('cca_senarais.*', 'cca_names.komponen')
            ->whereIn('tahun', ['Pra','Tahun 1', 'Tahun 2', 'Tahun 3', 'Tahun 4', 'Tahun 5', 'Tahun 6'])
            ->whereRaw("YEAR(TRY_CONVERT(DATETIME, created_at)) =?", [date('Y')])
            ->get();

        $kerohanianr = 0;
        $fizikalr = 0;
        $kreativitir = 0;
        $perkhidmatanr = 0;

        foreach ($pecahankelabr as $item) {
            if ($item->komponen === 'Kerohanian') {
                $fizikalr++;
            } elseif ($item->komponen === 'Fizikal') {
                $kerohanianr++;
            } elseif ($item->komponen === 'Kreativiti') {
                $kreativitir++;
            } elseif ($item->komponen === 'Perkhidmatan') {
                $perkhidmatanr++;
            }
        }

        // MENENGAH

        $pecahankelabm = CCASenarai::leftJoin('cca_names', 'cca_senarais.nama_cca', '=', 'cca_names.id')
            ->select('cca_senarais.*', 'cca_names.komponen')
            ->whereIn('tahun', ['Tahun 7', 'Tahun 8', 'Tahun 9', 'Tahun 10', 'Tahun 11'])
            ->whereRaw("YEAR(TRY_CONVERT(DATETIME, created_at)) =?", [date('Y')])
            ->get();

        $kerohanianm = 0;
        $fizikalm = 0;
        $kreativitim = 0;
        $perkhidmatanm = 0;

        foreach ($pecahankelabm as $item) {
            if ($item->komponen === 'Kerohanian') {
                $fizikalm++;
            } elseif ($item->komponen === 'Fizikal') {
                $kerohanianm++;
            } elseif ($item->komponen === 'Kreativiti') {
                $kreativitim++;
            } elseif ($item->komponen === 'Perkhidmatan') {
                $perkhidmatanm++;
            }
        }

        // PTE

        $pecahankelabp = CCASenarai::leftJoin('cca_names', 'cca_senarais.nama_cca', '=', 'cca_names.id')
            ->select('cca_senarais.*', 'cca_names.komponen')
            ->whereIn('tahun', ['Tahun 12', 'Tahun 13'])
            ->whereRaw("YEAR(TRY_CONVERT(DATETIME, created_at)) =?", [date('Y')])
            ->get();

        $kerohanianp = 0;
        $fizikalp = 0;
        $kreativitip = 0;
        $perkhidmatanp = 0;

        foreach ($pecahankelabp as $item) {
            if ($item->komponen === 'Kerohanian') {
                $fizikalp++;
            } elseif ($item->komponen === 'Fizikal') {
                $kerohanianp++;
            } elseif ($item->komponen === 'Kreativiti') {
                $kreativitip++;
            } elseif ($item->komponen === 'Perkhidmatan') {
                $perkhidmatanp++;
            }
        }


        $year = '2025';  // Change the year as needed

        // Kerohanian query
        $topKerohanian = CCASenarai::join('kelab_ccas as kc', 'cca_senarais.kelab_cca_id', '=', 'kc.id')
            ->whereRaw('TRIM(kc.year) = ?', [$year])
            ->whereRaw('TRIM(cca_senarais.komponen) = ?', ['Kerohanian'])
            ->select('cca_senarais.nama_cca', DB::raw('COUNT(*) as occurrences'))
            ->groupBy('cca_senarais.nama_cca')
            ->orderByDesc('occurrences')
            ->limit(5)
            ->get();
        
        $topKerohanian->load('namacca');
        
        // Kreativiti query
        $topKreativiti = CCASenarai::join('kelab_ccas as kc', 'cca_senarais.kelab_cca_id', '=', 'kc.id')
            ->whereRaw('TRIM(kc.year) = ?', [$year])
            ->whereRaw('TRIM(cca_senarais.komponen) = ?', ['Kreativiti'])
            ->select('cca_senarais.nama_cca', DB::raw('COUNT(*) as occurrences'))
            ->groupBy('cca_senarais.nama_cca')
            ->orderByDesc('occurrences')
            ->limit(5)
            ->get();
        
        $topKreativiti->load('namacca');
        
        // Perkhidmatan query
        $topPerkhidmatan = CCASenarai::join('kelab_ccas as kc', 'cca_senarais.kelab_cca_id', '=', 'kc.id')
            ->whereRaw('TRIM(kc.year) = ?', [$year])
            ->whereRaw('TRIM(cca_senarais.komponen) = ?', ['Perkhidmatan'])
            ->select('cca_senarais.nama_cca', DB::raw('COUNT(*) as occurrences'))
            ->groupBy('cca_senarais.nama_cca')
            ->orderByDesc('occurrences')
            ->limit(5)
            ->get();
        
        $topPerkhidmatan->load('namacca');
        
        // Fizikal query
        $topFizikal = CCASenarai::join('kelab_ccas as kc', 'cca_senarais.kelab_cca_id', '=', 'kc.id')
            ->whereRaw('TRIM(kc.year) = ?', [$year])
            ->whereRaw('TRIM(cca_senarais.komponen) = ?', ['Fizikal'])
            ->select('cca_senarais.nama_cca', DB::raw('COUNT(*) as occurrences'))
            ->groupBy('cca_senarais.nama_cca')
            ->limit(5)
            ->get();
        
        $topFizikal->load('namacca');

        //  $topKerohanian = CCASenarai::select('nama_cca', DB::raw('COUNT(*) as occurrences'))
        // ->where('komponen', 'Kerohanian')
        // ->groupBy('nama_cca')
        // ->orderByDesc('occurrences')
        // ->limit(5)
        // ->get();
    
        //     // Load the related 'namacca' for each item
        //     $topKerohanian->load('namacca');
    
    
        // $topKreativiti = CCASenarai::select('nama_cca', DB::raw('COUNT(*) as occurrences'))
        // ->where('komponen', 'Kreativiti')
        // ->groupBy('nama_cca')
        // ->orderByDesc('occurrences')
        // ->limit(5)
        // ->get();
    
        //     // Load the related 'namacca' for each item
        //     $topKreativiti->load('namacca');
    
        
        // $topPerkhidmatan = CCASenarai::select('nama_cca', DB::raw('COUNT(*) as occurrences'))
        //     ->where('komponen', 'Perkhidmatan')
        //     ->groupBy('nama_cca')
        //     ->orderByDesc('occurrences')
        //     ->limit(5)
        //     ->get();

        //     $topPerkhidmatan->load('namacca');

        //     // $komponencheck = DB::table('cca_senarais')
        //     // ->where('komponen', 'fizikal')
        //     // ->get();

        //     // dd($komponencheck);
        
        //     $topFizikal = CCASenarai::select('cca_senarais.nama_cca', DB::raw('COUNT(*) as occurrences'))
        //     ->join('kelab_ccas as kc', 'cca_senarais.kelab_cca_id', '=', 'kc.id')
        //     ->whereRaw('TRIM(kc.year) =?', ['2025'])
        //     ->where('cca_senarais.komponen', 'Fizikal')
        //     ->groupBy('cca_senarais.nama_cca')
        //     ->orderByDesc('occurrences')
        //     ->limit(5)
        //     ->get();

        //     // $topFizikal= CCASenarai::select('cca_senarais.nama_cca', 'cca_senarais.komponen')
        //     // ->join('kelab_ccas as kc', 'cca_senarais.kelab_cca_id','=', 'kc.id')
        //     // ->where('cca_senarais.komponen','Fizikal')
        //     // ->limit(5)
        //     // ->get();

        //     $topFizikal->load('namacca');

            //Kaitan
            $kaitanData = CCA_Kaitan::where('kaitan', 'Kebudayaan')
                ->where('jumlah', 15)
                ->first();
            $kaitan1 = $kaitanData->jumlah;

            $kaitanData = CCA_Kaitan::where('kaitan', 'Kebudayaan Islam')
                ->where('jumlah', 3)
                ->first();
            $kaitan2 = $kaitanData->jumlah;

            $kaitanData = CCA_Kaitan::where('kaitan', 'Kemahiran Bahasa')
                ->where('jumlah', 35)
                ->first();
            $kaitan3 = $kaitanData->jumlah;

            $kaitanData = CCA_Kaitan::where('kaitan', 'Kesenian')
                ->where('jumlah', 56)
                ->first();
            $kaitan4 = $kaitanData->jumlah;

            $kaitanData = CCA_Kaitan::where('kaitan', 'Kesenian Islam')
                ->where('jumlah', 4)
                ->first();
            $kaitan5 = $kaitanData->jumlah;

            $kaitanData = CCA_Kaitan::where('kaitan', 'Kesihatan & Kecergasan')
                ->where('jumlah', 25)
                ->first();
            $kaitan6 = $kaitanData->jumlah;

            $kaitanData = CCA_Kaitan::where('kaitan', 'Keusahawanan')
                ->where('jumlah', 6)
                ->first();
            $kaitan7 = $kaitanData->jumlah;

            $kaitanData = CCA_Kaitan::where('kaitan', 'Khidmat Masyarakat')
                ->where('jumlah', 13)
                ->first();
            $kaitan8 = $kaitanData->jumlah;

            $kaitanData = CCA_Kaitan::where('kaitan', 'Pasukan Beruniform')
                ->where('jumlah', 18)
                ->first();
            $kaitan9 = $kaitanData->jumlah;

            $kaitanData = CCA_Kaitan::where('kaitan', 'Permainan')
                ->where('jumlah', 37)
                ->first();
            $kaitan10 = $kaitanData->jumlah;

            $kaitanData = CCA_Kaitan::where('kaitan', 'Rekreasi')
                ->where('jumlah', 8)
                ->first();
            $kaitan11 = $kaitanData->jumlah;

            $kaitanData = CCA_Kaitan::where('kaitan', 'S.T.E.A.M')
                ->where('jumlah', 32)
                ->first();
            $kaitan12 = $kaitanData->jumlah;

            $kaitanData = CCA_Kaitan::where('kaitan', 'Sukan')
                ->where('jumlah', 60)
                ->first();
            $kaitan13 = $kaitanData->jumlah;

            $kaitanData = CCA_Kaitan::where('kaitan', 'Teras')
                ->where('jumlah', 19)
                ->first();
            $kaitan14 = $kaitanData->jumlah;


        return view('/ccareport', compact('CCAs', 'jumlah', 'jumlahLelaki', 'jumlahPerempuan',
                    'jumlahRendah', 'jumlahMenengah', 'jumlahSixthForm',
                    'kluster1', 'kluster2', 'kluster3', 'kluster4', 'kluster5', 'kluster6',
                    'Fizikal', 'Kerohanian', 'Kreativiti', 'Perkhidmatan','checklistcca','totalRL', 
                    'totalRP', 'totalML', 'totalMP', 'totalPL', 'totalPP', 'pecahankelabr', 'fizikalr', 
                    'kerohanianr','kreativitir', 'perkhidmatanr' ,'fizikalm', 'kerohanianm','kreativitim', 
                    'perkhidmatanm', 'pecahankelabm','fizikalp', 'kerohanianp','kreativitip', 'perkhidmatanp', 'pecahankelabp',
                    'topFizikal', 'topKerohanian', 'topKreativiti', 'topPerkhidmatan',
                    'kaitan1', 'kaitan2', 'kaitan3', 'kaitan4', 'kaitan5', 'kaitan6', 'kaitan7', 'kaitan8', 'kaitan9',
                    'kaitan10', 'kaitan11', 'kaitan12', 'kaitan13', 'kaitan14', 'jumlahlelakiberkeperluankhas' , 'jumlahperempuanberkeperluankhas'));
    }
}
