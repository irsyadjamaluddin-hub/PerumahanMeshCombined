<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffReportController extends Controller
{
    /**
     * Display Teaching Staff Report
     */
    public function teachingReport()
    {
        // Total Teaching Staff (using default connection)
        $totalTeaching = DB::table('pemegangjawatanteach')->count();

        // Gender Distribution
        $teachingLelaki = DB::table('pemegangjawatanteach')
            ->where('Jantina', 'LIKE', '%LELAKI%')
            ->count();

        $teachingPerempuan = DB::table('pemegangjawatanteach')
            ->where('Jantina', 'LIKE', '%PEREMPUAN%')
            ->count();

        // Kelulusan Distribution (based on export dropdown options)
        $kelulusanCategories = [
            'PhD' => 'teachingPhD',
            'PGCE' => 'teachingPGCE',
            'Master' => 'teachingMaster',
            'Degree' => 'teachingDegree',
            'Higher Diploma' => 'teachingHigherDiploma',
            'BTEC' => 'teachingBTEC',
            'Diploma' => 'teachingDiploma',
            'ND' => 'teachingND',
            'Certificate' => 'teachingCertificate',
            'O Level' => 'teachingOLevel',
            'A Level' => 'teachingALevel',
        ];

        $kelulusanData = [];
        
        foreach ($kelulusanCategories as $category => $varName) {
            $count = DB::table('pemegangjawatanteach')
                ->where('Kelulusan Tertnggi', 'LIKE', '%' . $category . '%')
                ->count();
            
            $kelulusanData[$varName] = $count;
        }

        return view('hrs.reports.teaching-report', array_merge([
            'totalTeaching' => $totalTeaching,
            'teachingLelaki' => $teachingLelaki,
            'teachingPerempuan' => $teachingPerempuan,
        ], $kelulusanData));
    }

    /**
     * Display Non-Teaching Staff Report
     */
    public function nonTeachingReport()
    {
        // Total Non-Teaching Staff (using default connection)
        $totalNonTeaching = DB::table('spjs')->count();

        // Gender Distribution
        $nonTeachingLelaki = DB::table('spjs')
            ->where('jantina', 'LIKE', '%LELAKI%')
            ->count();

        $nonTeachingPerempuan = DB::table('spjs')
            ->where('jantina', 'LIKE', '%PEREMPUAN%')
            ->count();

        // Kelulusan Distribution (based on export dropdown options)
        $kelulusanCategories = [
            'PhD' => 'nonTeachingPhD',
            'PGCE' => 'nonTeachingPGCE',
            'Master' => 'nonTeachingMaster',
            'Degree' => 'nonTeachingDegree',
            'Higher Diploma' => 'nonTeachingHigherDiploma',
            'BTEC' => 'nonTeachingBTEC',
            'Diploma' => 'nonTeachingDiploma',
            'ND' => 'nonTeachingND',
            'Certificate' => 'nonTeachingCertificate',
            'O Level' => 'nonTeachingOLevel',
            'A Level' => 'nonTeachingALevel',
        ];

        $kelulusanData = [];
        
        foreach ($kelulusanCategories as $category => $varName) {
            $count = DB::table('spjs')
                ->where('kelulusanTertinggi', 'LIKE', '%' . $category . '%')
                ->count();
            
            $kelulusanData[$varName] = $count;
        }

        return view('hrs.reports.non-teaching-report', array_merge([
            'totalNonTeaching' => $totalNonTeaching,
            'nonTeachingLelaki' => $nonTeachingLelaki,
            'nonTeachingPerempuan' => $nonTeachingPerempuan,
        ], $kelulusanData));
    }

    /**
     * Display Combined Staff Report Dashboard (All 6 Diagrams)
     */
    public function combinedReport()
    {
        // ===== TEACHING STAFF DATA (Default Connection) =====
        
        // Total Teaching Staff
        $totalTeaching = DB::table('pemegangjawatanteach')->count();

        // Teaching Gender Distribution
        $teachingLelaki = DB::table('pemegangjawatanteach')
            ->where('Jantina', 'LIKE', '%LELAKI%')
            ->count();

        $teachingPerempuan = DB::table('pemegangjawatanteach')
            ->where('Jantina', 'LIKE', '%PEREMPUAN%')
            ->count();

        // Teaching Kelulusan Distribution
        $teachingKelulusanCategories = [
            'PhD' => 'teachingPhD',
            'PGCE' => 'teachingPGCE',
            'Master' => 'teachingMaster',
            'Degree' => 'teachingDegree',
            'Higher Diploma' => 'teachingHigherDiploma',
            'BTEC' => 'teachingBTEC',
            'Diploma' => 'teachingDiploma',
            'ND' => 'teachingND',
            'Certificate' => 'teachingCertificate',
            'O Level' => 'teachingOLevel',
            'A Level' => 'teachingALevel',
        ];

        $teachingKelulusanData = [];
        foreach ($teachingKelulusanCategories as $category => $varName) {
            $count = DB::table('pemegangjawatanteach')
                ->where('Kelulusan Tertnggi', 'LIKE', '%' . $category . '%')
                ->count();
            
            $teachingKelulusanData[$varName] = $count;
        }

        // ===== NON-TEACHING STAFF DATA (Default Connection) =====
        
        // Total Non-Teaching Staff
        $totalNonTeaching = DB::table('spjs')->count();

        // Non-Teaching Gender Distribution
        $nonTeachingLelaki = DB::table('spjs')
            ->where('jantina', 'LIKE', '%LELAKI%')
            ->count();

        $nonTeachingPerempuan = DB::table('spjs')
            ->where('jantina', 'LIKE', '%PEREMPUAN%')
            ->count();

        // Non-Teaching Kelulusan Distribution
        $nonTeachingKelulusanCategories = [
            'PhD' => 'nonTeachingPhD',
            'PGCE' => 'nonTeachingPGCE',
            'Master' => 'nonTeachingMaster',
            'Degree' => 'nonTeachingDegree',
            'Higher Diploma' => 'nonTeachingHigherDiploma',
            'BTEC' => 'nonTeachingBTEC',
            'Diploma' => 'nonTeachingDiploma',
            'ND' => 'nonTeachingND',
            'Certificate' => 'nonTeachingCertificate',
            'O Level' => 'nonTeachingOLevel',
            'A Level' => 'nonTeachingALevel',
        ];

        $nonTeachingKelulusanData = [];
        foreach ($nonTeachingKelulusanCategories as $category => $varName) {
            $count = DB::table('spjs')
                ->where('kelulusanTertinggi', 'LIKE', '%' . $category . '%')
                ->count();
            
            $nonTeachingKelulusanData[$varName] = $count;
        }

        // ===== TEACHING DAERAH DISTRIBUTION =====
        $teachingBruneiMuara = DB::table('pemegangjawatanteach')
            ->where(function($query) {
                $query->where('Daerah', 'LIKE', '%Brunei%')
                      ->orWhere('Daerah', 'LIKE', '%Muara%');
            })
            ->count();

        $teachingTutong = DB::table('pemegangjawatanteach')
            ->where('Daerah', 'LIKE', '%Tutong%')
            ->count();

        $teachingKualaBelait = DB::table('pemegangjawatanteach')
            ->where(function($query) {
                $query->where('Daerah', 'LIKE', '%Kuala%')
                      ->orWhere('Daerah', 'LIKE', '%Belait%');
            })
            ->count();

        $teachingTemburong = DB::table('pemegangjawatanteach')
            ->where('Daerah', 'LIKE', '%Temburong%')
            ->count();

        // ===== NON-TEACHING DAERAH DISTRIBUTION =====
        $nonTeachingBruneiMuara = DB::table('spjs')
            ->where(function($query) {
                $query->where('daerah', 'LIKE', '%Brunei%')
                      ->orWhere('daerah', 'LIKE', '%Muara%');
            })
            ->count();

        $nonTeachingTutong = DB::table('spjs')
            ->where('daerah', 'LIKE', '%Tutong%')
            ->count();

        $nonTeachingKualaBelait = DB::table('spjs')
            ->where(function($query) {
                $query->where('daerah', 'LIKE', '%Kuala%')
                      ->orWhere('daerah', 'LIKE', '%Belait%');
            })
            ->count();

        $nonTeachingTemburong = DB::table('spjs')
            ->where('daerah', 'LIKE', '%Temburong%')
            ->count();

        // Combine all data
        return view('hrs.reports.combined-staff-report', array_merge([
            'totalTeaching' => $totalTeaching,
            'teachingLelaki' => $teachingLelaki,
            'teachingPerempuan' => $teachingPerempuan,
            'totalNonTeaching' => $totalNonTeaching,
            'nonTeachingLelaki' => $nonTeachingLelaki,
            'nonTeachingPerempuan' => $nonTeachingPerempuan,
            // Teaching Daerah
            'teachingBruneiMuara' => $teachingBruneiMuara,
            'teachingTutong' => $teachingTutong,
            'teachingKualaBelait' => $teachingKualaBelait,
            'teachingTemburong' => $teachingTemburong,
            // Non-Teaching Daerah
            'nonTeachingBruneiMuara' => $nonTeachingBruneiMuara,
            'nonTeachingTutong' => $nonTeachingTutong,
            'nonTeachingKualaBelait' => $nonTeachingKualaBelait,
            'nonTeachingTemburong' => $nonTeachingTemburong,
        ], $teachingKelulusanData, $nonTeachingKelulusanData));
    }
}