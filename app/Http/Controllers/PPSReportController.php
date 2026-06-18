<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PPSVisitor;

use Auth;
use Hash;
use DB;

class PPSReportController extends Controller
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

    // ====================================================================================================
    // Added by Amal 'Izzah

    public function ppsvisitor()
    {
        // Fetch distinct years from the table
        $years = PPSVisitor::select('year')->distinct()->pluck('year')->unique()->toArray();
        
        // Initialize an array to store total visitors for each month
        $totalVisitorsPerMonth = [];
        
        // Initialize an array to store visitors data for each month, year, and counter
        $counterVisitorsPerMonthYear = [];
        
        // Iterate through each year
        foreach ($years as $year) {
            // Initialize month to start from September if it's the starting year, otherwise start from January
            $startMonth = ($year == 2022) ? 9 : 1;
            
            // Iterate through each month
            for ($month = $startMonth; $month <= 12; $month++) {
                // Get the month name
                $monthName = date('F', mktime(0, 0, 0, $month, 1));
                
                // Fetch all visitors for the specified month and year grouped by counter
                $visitors = PPSVisitor::select('counter', $monthName)
                    ->where('year', $year)
                    ->get();
                
                // Initialize an array to store visitors data for each counter in the current month and year
                $counterVisitorsPerMonthYear["$monthName $year"] = [];
                
                // Iterate through each visitor record for the month and counter
                foreach ($visitors as $visitor) {
                    $counter = $visitor->counter;
                    $count = $visitor->$monthName;
                    
                    // Exclude MKPK counter
                    if ($counter != 'MKPK') {
                        // Store the visitors count for the month, year, and counter
                        $counterVisitorsPerMonthYear["$monthName $year"][$counter] = $count;
                        
                        // Update the total visitors count for the month and year
                        if (!isset($totalVisitorsPerMonth["$monthName $year"])) {
                            $totalVisitorsPerMonth["$monthName $year"] = 0;
                        }
                        $totalVisitorsPerMonth["$monthName $year"] += $count;
                    }
                }
            }
        }
    
        // Calculate total number of visitors across all counters
        $totalVisitorsAll = array_sum($totalVisitorsPerMonth);
    
        // Calculate total number of visitors for each year
        $totalVisitorsYear = [];
        foreach ($years as $year) {
            $totalVisitorsYear[$year] = 0;
            foreach ($totalVisitorsPerMonth as $key => $value) {
                if (strpos($key, (string)$year) !== false) {
                    $totalVisitorsYear[$year] += $value;
                }
            }
        }
    
        // Fetch specific counters data
        $jabatanPeperiksaan = $this->getCounterData('Jabatan Peperiksaan (Examination)', $counterVisitorsPerMonthYear);
        $suratAkuanPelajar = $this->getCounterData('Surat Akuan Pelajar (JSS)', $counterVisitorsPerMonthYear);
        $pindahSekolah = $this->getCounterData('Pindah Sekolah (JSS)', $counterVisitorsPerMonthYear);
        $jabatanPendidikanSwasta = $this->getCounterData('Jabatan Pendidikan Swasta', $counterVisitorsPerMonthYear);
        $scholarship = $this->getCounterData('Scholarship', $counterVisitorsPerMonthYear);
        $jppe = $this->getCounterData('Jabatan Perancangan Pengurusan Estet (JPPE)', $counterVisitorsPerMonthYear);
        $jabatanPengurusanPendidik = $this->getCounterData('Jabatan Pengurusan Pendidik', $counterVisitorsPerMonthYear);
        
        // Calculate combined counters data
        $jabatanSekolahSekolah = $this->combineCounterData(['Surat Akuan Pelajar (JSS)', 'Pindah Sekolah (JSS)'], $counterVisitorsPerMonthYear);
        $jabatanPentadbiran = $this->combineCounterData(['Kewangan (Gaji, Elaun)', 'Kewangan (Baucer)', 'Kewangan (Pembayaran, Hasil, Tender)'], $counterVisitorsPerMonthYear);
        
        // Return the view with the required data
        return view('ppsvisitor', compact('totalVisitorsAll', 'totalVisitorsPerMonth', 'counterVisitorsPerMonthYear', 'totalVisitorsYear', 'years', 'jabatanPeperiksaan', 'suratAkuanPelajar', 'pindahSekolah', 'jabatanPendidikanSwasta', 'scholarship', 'jppe', 'jabatanSekolahSekolah', 'jabatanPentadbiran', 'jabatanPengurusanPendidik'));
    }    
    
    // Helper function to combine data from multiple counters
    private function combineCounterData($counterNames, $counterVisitorsPerMonthYear) {
        $combinedData = [];
        foreach ($counterVisitorsPerMonthYear as $monthYear => $data) {
            $total = 0;
            foreach ($counterNames as $counterName) {
                if (isset($data[$counterName])) {
                    $total += $data[$counterName];
                }
            }
            $combinedData[$monthYear] = $total;
        }
        return $combinedData;
    }
    
    // Helper function to get counter data
    private function getCounterData($counterName, $counterVisitorsPerMonthYear) {
        $counterData = [];
        foreach ($counterVisitorsPerMonthYear as $monthYear => $data) {
            if (isset($data[$counterName])) {
                $counterData[$monthYear] = $data[$counterName];
            } else {
                $counterData[$monthYear] = 0;
            }
        }
        return $counterData;
    }

    // ====================================================================================================
}
