<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Models\PPSVisitor;
use Carbon\Carbon;

class PPSPublicController extends Controller
{
    public function showLockPage()
    {
        return view('pps.publicgraphlock');
    }

    public function publicgraphpost(Request $request)
    {
        $password = $request->input('password');
        $correctPassword = 'ppsmoe'; // Set the correct password provided by the admin
        $Yearly = Crypt::encrypt($password); // Encrypt the password

        if ($password === $correctPassword) {
            return redirect()->route('pps.pps.public',compact('Yearly'))->with('success', 'Page unlocked successfully.'); // Redirect to the desired page
        } else {
            return redirect()->back()->with('error', 'Incorrect password. Please try again.'); // Redirect back with error message
        }
    }

    public function publicgraph()
    {
        // $password = '12345678'; // Set the password
        // $encryptedPassword = Crypt::encrypt($password); // Encrypt the password

        // $url = route('pps.pps.public', ['encrypted_password' => $encryptedPassword]);
        // setlocale(LC_TIME, 'ms_MY');

        // $monthyear = Carbon::now()->subMonth()->format('F Y');
        // Define an array of Malay month names
//         $malayMonths = [
//             'Januari', 'Februari', 'Mac', 'April', 'Mei', 'Jun', 'Julai', 'Ogos', 'September', 'Oktober', 'November', 'Disember'
//         ];

// // Get the current month and year in Malay
// $currentMonth = Carbon::now()->subMonth()->month; // Get the month number (1 to 12)
// $malayMonth = $malayMonths[$currentMonth - 1]; // Translate the month number to Malay month name
// $year = Carbon::now()->subMonth()->year; // Get the previous year if needed

// // Output the formatted month and year in Malay
// $monthyear = $malayMonth . ' ' . $year;

    // Define an array mapping English month names to Malay month names
    $englishToMalayMonths = [
        'January' => 'Januari',
        'February' => 'Februari',
        'March' => 'Mac',
        'April' => 'April',
        'May' => 'Mei',
        'June' => 'Jun',
        'July' => 'Julai',
        'August' => 'Ogos',
        'September' => 'September',
        'October' => 'Oktober',
        'November' => 'November',
        'December' => 'Disember'
    ];

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
            // Get the month name in English
            $monthNameEnglish = date('F', mktime(0, 0, 0, $month, 1));
            // Translate the month name to Malay
            $monthNameMalay = $englishToMalayMonths[$monthNameEnglish];

            // Fetch all visitors for the specified month and year grouped by counter
            $visitors = PPSVisitor::select('counter', $monthNameEnglish)
                ->where('year', $year)
                ->get();

            // Initialize an array to store visitors data for each counter in the current month and year
            $counterVisitorsPerMonthYear["$monthNameMalay $year"] = [];

            // Iterate through each visitor record for the month and counter
            foreach ($visitors as $visitor) {
                $counter = $visitor->counter;
                $count = $visitor->$monthNameEnglish;

                // Exclude MKPK counter
                if ($counter != 'MKPK') {
                    // Store the visitors count for the month, year, and counter
                    $counterVisitorsPerMonthYear["$monthNameMalay $year"][$counter] = $count;

                    // Update the total visitors count for the month and year
                    if (!isset($totalVisitorsPerMonth["$monthNameMalay $year"])) {
                        $totalVisitorsPerMonth["$monthNameMalay $year"] = 0;
                    }
                    $totalVisitorsPerMonth["$monthNameMalay $year"] += $count;
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
    return view('pps.publicgraph', compact('totalVisitorsAll', 'totalVisitorsPerMonth', 'counterVisitorsPerMonthYear', 'totalVisitorsYear', 'years', 'jabatanPeperiksaan', 'suratAkuanPelajar', 'pindahSekolah', 'jabatanPendidikanSwasta', 'scholarship', 'jppe', 'jabatanSekolahSekolah', 'jabatanPentadbiran', 'jabatanPengurusanPendidik'));
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
}
