<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OnlineNotification;

class OnsdashboardController extends Controller
{
    public function onsdashboard()
    {
      

        $jumlahdept1 = OnlineNotification::where('jabatan', 'Pejabat Menteri Pendidikan')->count();
        $jumlahdept2 = OnlineNotification::where('jabatan', 'Pejabat Timbalan Menteri Pendidikan')->count();
        $jumlahdept3 = OnlineNotification::where('jabatan', 'Pejabat Setiausaha Tetap (Pendidikan Teras)')->count();
        $jumlahdept4 = OnlineNotification::where('jabatan', 'Pejabat Setiausaha Tetap (Pengajian Tinggi)')->count();
        $jumlahdept5 = OnlineNotification::where('jabatan', 'Pejabat Timbalan Setiausaha Tetap (Pendidikan Teras)')->count();
        $jumlahdept6 = OnlineNotification::where('jabatan', 'Pejabat Timbalan Setiausaha Tetap (Pengajian Tinggi)')->count();
        $jumlahdept7 = OnlineNotification::where('jabatan', 'Pejabat Ketua Pengarah Pendidikan')->count();
        $jumlahdept8 = OnlineNotification::where('jabatan', 'Jabatan Pentadbiran dan Perkhidmatan-Perkhidmatan')->count();
        $jumlahdept9 = OnlineNotification::where('jabatan', 'Jabatan Sekolah-Sekolah')->count();
        $jumlahdept10 = OnlineNotification::where('jabatan', 'Jabatan Perancangan dan Pengurusan Estet')->count();
        $jumlahdept11 = OnlineNotification::where('jabatan', 'Jabatan Pengurusan Pendidik')->count();
        $jumlahdept12 = OnlineNotification::where('jabatan', 'Jabatan Teknologi Maklumat dan Komunikasi')->count();
        $jumlahdept13 = OnlineNotification::where('jabatan', 'Jabatan Peperiksaan')->count();
        $jumlahdept14 = OnlineNotification::where('jabatan', 'Jabatan Institut Pendidikan Teknikal Brunei')->count();
        $jumlahdept15 = OnlineNotification::where('jabatan', 'Jabatan Kenaziran Sekolah-Sekolah')->count();
        $jumlahdept16 = OnlineNotification::where('jabatan', 'Jabatan Pendidikan Kokurikulum')->count();
        $jumlahdept17 = OnlineNotification::where('jabatan', 'Jabatan Perkembangan Kurikulum')->count();
        $jumlahdept18 = OnlineNotification::where('jabatan', 'Jabatan Pengajian Tinggi')->count();
        $jumlahdept19 = OnlineNotification::where('jabatan', 'Jabatan Pendidikan Khas')->count();
        $jumlahdept20 = OnlineNotification::where('jabatan', 'Bahagian Komunikasi Korporat')->count();
        $jumlahdept21 = OnlineNotification::where('jabatan', 'Jabatan Pendidikan Swasta')->count();
        $jumlahdept22 = OnlineNotification::where('jabatan', 'Jabatan Pengurusan Biasiswa')->count();
        $jumlahdept23 = OnlineNotification::where('jabatan', 'Jabatan Perancangan Perkembangan dan Penyelidikan')->count();
        $jumlahdept24 = OnlineNotification::where('jabatan', 'Bahagian Perhubungan Antarabangsa')->count();
        $jumlahdept25 = OnlineNotification::where('jabatan', 'Majlis Kebangsaan Pengiktirafan Kelulusan (MKPK)')->count();
        $jumlahdept26 = OnlineNotification::where('jabatan', 'Pusat Kerjasama Sains, Teknologi dan Alam Sekitar (STEP)')->count();
        $jumlahdept27 = OnlineNotification::where('jabatan', 'Strategic Enterprise Performance dan Delivery Unit (SEPADU)')->count();
        $jumlahdept28 = OnlineNotification::where('jabatan', 'Brunei Darussalam Leadership & Teachers Academy (BDLTA)')->count();
        $jumlahdept29 = OnlineNotification::where('jabatan', 'Pusat Teknologi Pendidikan (EdTech)')->count();
        $jumlahdept30 = OnlineNotification::where('jabatan', 'Pusat Keusahawanan dan Inovasi')->count();
        $jumlahdept31 = OnlineNotification::where('jabatan', 'Pusat Perkembangan Pendidikan Cerdas Pintar dan Berbakat (EDGE)')->count();
        $jumlahdept32 = OnlineNotification::where('jabatan', 'Unit Hal Ehwal Antarabangsa')->count();
        $jumlahdept33 = OnlineNotification::where('jabatan', 'Brunei Darussalam Leadership & Teachers Academy (BDLTA)')->count();
        $jumlahdept34 = OnlineNotification::where('jabatan', 'Majlis Pelajaran Kebangsaan')->count();
        $jumlahdept35 = OnlineNotification::where('jabatan', 'Pusat Pembelajaran Sepanjang Hayat (L3)')->count();

        $usage = OnlineNotification::selectRaw('MONTH(updated_at) AS month, jabatan, COUNT(*) AS count')
        // ->groupBy('month', 'jabatan')
        ->groupByRaw('MONTH(updated_at), jabatan')
        ->get();
        
        // $monthlyCounts = OnlineNotification::selectRaw('DATE_FORMAT(updated_at, "%M %Y") as month_year, COUNT(*) as count')
        $monthlyCounts = OnlineNotification::selectRaw("FORMAT(updated_at, 'MMMM yyyy') as month_year, COUNT(*) as count")
        ->whereYear('updated_at', 2023)
        ->whereBetween('updated_at', ['2023-01-01', '2023-12-31'])
        // ->groupBy('month_year')
        ->groupByRaw("FORMAT(updated_at, 'MMMM yyyy')")
        ->get();

            //    $monthlyCounts2024 = OnlineNotification::selectRaw('DATE_FORMAT(updated_at, "%M %Y") as month_year, COUNT(*) as count')
        $monthlyCounts2024 = OnlineNotification::selectRaw("FORMAT(updated_at, 'MMMM yyyy') as month_year, COUNT(*) as count")
        ->whereYear('updated_at', 2024)
        ->whereBetween('updated_at', ['2024-01-01', '2024-12-31'])
        ->groupByRaw("FORMAT(updated_at, 'MMMM yyyy')")
        ->get();

        // ADD 2025 DATA HERE
        $monthlyCounts2025 = OnlineNotification::selectRaw("FORMAT(updated_at, 'MMMM yyyy') as month_year, COUNT(*) as count")
        ->whereYear('updated_at', 2025)
        ->whereBetween('updated_at', ['2025-01-01', '2025-12-31'])
        ->groupByRaw("FORMAT(updated_at, 'MMMM yyyy')")
        ->get();


        $jumlah = $monthlyCounts->sum('count');
        $jumlah2024 = $monthlyCounts2024->sum('count');
        $jumlah2025 = $monthlyCounts2025->sum('count');


         // Prepare data for the pie chart
         $departmentCounts = [
            'Pejabat Menteri Pendidikan' => OnlineNotification::where('jabatan', 'Pejabat Menteri Pendidikan')->count(),
            'Pejabat Timbalan Menteri Pendidikan' => OnlineNotification::where('jabatan', 'Pejabat Timbalan Menteri Pendidikan')->count(),
            'Pejabat Setiausaha Tetap (Pendidikan Teras)' => OnlineNotification::where('jabatan', 'Pejabat Setiausaha Tetap (Pendidikan Teras)')->count(),
            'Pejabat Setiausaha Tetap (Pengajian Tinggi)' => OnlineNotification::where('jabatan', 'Pejabat Setiausaha Tetap (Pengajian Tinggi)')->count(),
            'Pejabat Timbalan Setiausaha Tetap (Pendidikan Teras)' => OnlineNotification::where('jabatan', 'Pejabat Timbalan Setiausaha Tetap (Pendidikan Teras)')->count(),
            'Pejabat Timbalan Setiausaha Tetap (Pengajian Tinggi)' => OnlineNotification::where('jabatan', 'Pejabat Timbalan Setiausaha Tetap (Pengajian Tinggi)')->count(),
            'Pejabat Ketua Pengarah Pendidikan' => OnlineNotification::where('jabatan', 'Pejabat Ketua Pengarah Pendidikan')->count(),
            'Jabatan Pentadbiran dan Perkhidmatan-Perkhidmatan' => OnlineNotification::where('jabatan', 'Jabatan Pentadbiran dan Perkhidmatan-Perkhidmatan')->count(),
            'Jabatan Sekolah-Sekolah' => OnlineNotification::where('jabatan', 'Jabatan Sekolah-Sekolah')->count(),
            'Jabatan Perancangan dan Pengurusan Estet' => OnlineNotification::where('jabatan', 'Jabatan Perancangan dan Pengurusan Estet')->count(),
            'Jabatan Pengurusan Pendidik' => OnlineNotification::where('jabatan', 'Jabatan Pengurusan Pendidik')->count(),
            'Jabatan Teknologi Maklumat dan Komunikasi' => OnlineNotification::where('jabatan', 'Jabatan Teknologi Maklumat dan Komunikasi')->count(),
            'Jabatan Peperiksaan' => OnlineNotification::where('jabatan', 'Jabatan Peperiksaan')->count(),
            'Jabatan Institut Pendidikan Teknikal Brunei' => OnlineNotification::where('jabatan', 'Jabatan Institut Pendidikan Teknikal Brunei')->count(),
            'Jabatan Kenaziran Sekolah-Sekolah' => OnlineNotification::where('jabatan', 'Jabatan Kenaziran Sekolah-Sekolah')->count(),
            'Jabatan Pendidikan Kokurikulum' => OnlineNotification::where('jabatan', 'Jabatan Pendidikan Kokurikulum')->count(),
            'Jabatan Perkembangan Kurikulum' => OnlineNotification::where('jabatan', 'Jabatan Perkembangan Kurikulum')->count(),
            'Jabatan Pengajian Tinggi' => OnlineNotification::where('jabatan', 'Jabatan Pengajian Tinggi')->count(),
            'Jabatan Pendidikan Khas' => OnlineNotification::where('jabatan', 'Jabatan Pendidikan Khas')->count(),
            'Bahagian Komunikasi Korporat' => OnlineNotification::where('jabatan', 'Bahagian Komunikasi Korporat')->count(),
            'Jabatan Pendidikan Swasta' => OnlineNotification::where('jabatan', 'Jabatan Pendidikan Swasta')->count(),
            'Jabatan Pengurusan Biasiswa' => OnlineNotification::where('jabatan', 'Jabatan Pengurusan Biasiswa')->count(),
            'Jabatan Perancangan Perkembangan dan Penyelidikan' => OnlineNotification::where('jabatan', 'Jabatan Perancangan Perkembangan dan Penyelidikan')->count(),
            'Bahagian Perhubungan Antarabangsa' => OnlineNotification::where('jabatan', 'Bahagian Perhubungan Antarabangsa')->count(),
            'Majlis Kebangsaan Pengiktirafan Kelulusan (MKPK)' => OnlineNotification::where('jabatan', 'Majlis Kebangsaan Pengiktirafan Kelulusan (MKPK)')->count(),
            'Pusat Kerjasama Sains, Teknologi dan Alam Sekitar (STEP)' => OnlineNotification::where('jabatan', 'Pusat Kerjasama Sains, Teknologi dan Alam Sekitar (STEP)')->count(),
            'Strategic Enterprise Performance dan Delivery Unit (SEPADU)' => OnlineNotification::where('jabatan', 'Strategic Enterprise Performance dan Delivery Unit (SEPADU)')->count(),
            'Brunei Darussalam Leadership & Teachers Academy (BDLTA)' => OnlineNotification::where('jabatan', 'Brunei Darussalam Leadership & Teachers Academy (BDLTA)')->count(),
            'Pusat Teknologi Pendidikan (EdTech)' => OnlineNotification::where('jabatan', 'Pusat Teknologi Pendidikan (EdTech)')->count(),
            'Pusat Keusahawahan dan Inovasi' => OnlineNotification::where('jabatan', 'Pusat Keusahawahan dan Inovasi')->count(),
            'Pusat Perkembangan Pendidikan Cerdas Pintar dan Berbakat (EDGE)' => OnlineNotification::where('jabatan', 'Pusat Perkembangan Pendidikan Cerdas Pintar dan Berbakat (EDGE)')->count(),
            'Unit Hal Ehwal Antarabangsa' => OnlineNotification::where('jabatan', 'Unit Hal Ehwal Antarabangsa')->count(),
            'Brunei Darussalam Leadership & Teachers Academy (BDLTA)' => OnlineNotification::where('jabatan', 'Brunei Darussalam Leadership & Teachers Academy (BDLTA)')->count(),
            'Majlis Pelajaran Kebangsaan' => OnlineNotification::where('jabatan', 'Majlis Pelajaran Kebangsaan')->count(),
            'Pusat Pembelajaran Sepanjang Hayat (L3)' => OnlineNotification::where('jabatan', 'Pusat Pembelajaran Sepanjang Hayat (L3)')->count(),
        ];

        $filteredDepartmentCounts = array_filter($departmentCounts, function ($count) {
            return $count > 0;
        });
        
        $departmentLabels = array_keys($filteredDepartmentCounts);
        $departmentSeries = array_values($filteredDepartmentCounts);


        
    
       
        return view('/onsdashboard', compact(
        'jumlahdept1',
        'jumlahdept2',
        'jumlahdept3',
        'jumlahdept4',
        'jumlahdept5',
        'jumlahdept6',
        'jumlahdept7',
        'jumlahdept8',
        'jumlahdept9',
        'jumlahdept10',
        'jumlahdept11',
        'jumlahdept12',  
        'jumlahdept13',
        'jumlahdept14',   
        'jumlahdept15',
        'jumlahdept16',   
        'jumlahdept17',
        'jumlahdept18',   
        'jumlahdept19',
        'jumlahdept20',
        'jumlahdept21',
        'jumlahdept22',  
        'jumlahdept23',
        'jumlahdept24',   
        'jumlahdept25',
        'jumlahdept26',  
         'jumlahdept27',
         'jumlahdept28',   
         'jumlahdept29',
         'jumlahdept30',
        'jumlahdept31',
        'jumlahdept32', 
        'jumlahdept33',
        'jumlahdept34',   
        'jumlahdept35',
        'usage',
        'monthlyCounts',
        'monthlyCounts2024',
        'monthlyCounts2025',
        'jumlah',
        'jumlah2024',
        'jumlah2025',
        'departmentLabels',
        'departmentSeries'

    ));
    }
}
