<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\PPSVisitor;

class PPSVisitorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // public function index()
    // {
    //     $icNos = Auth::user()->ic_no;

    //     $ppsvisitors = PPSVisitor::select('ppsvisitor.*')
    //     ->get();

    //     return view('pps.index', compact('ppsvisitors'));
    // }

    // ====================================================================================================
    // Added by Amal 'Izzah (PN)

    public function index()
{
    $icNos = Auth::user()->ic_no;

    // Retrieve the latest updated_at timestamp for each unique counter
    $latestUpdateTimes = PPSVisitor::select('counter', DB::raw('MAX(updated_at) as latest_updated_at'))
                                    ->groupBy('counter')
                                    ->pluck('latest_updated_at', 'counter');

    $ppsvisitors = PPSVisitor::select('ppsvisitor.*')->get();

    return view('pps.index', compact('ppsvisitors', 'latestUpdateTimes'));
}


    public function addpps($counter)
{
    return view('pps.addpps', ['counter' => $counter]);
}


public function storepps(Request $request)
{
    // Validation - validate incoming request data here

    // Retrieve the counter name from the request
    $counterName = $request->input('counter');

    // Check if a record with the same year and counter name already exists
    $ppsVisitor = PPSVisitor::where('year', $request->input('year'))
        ->where('counter', $counterName) // Use $counterName here
        ->first();

    if (!$ppsVisitor) {
        // If no record exists for the given year and counter name, create a new one
        $ppsVisitor = new PPSVisitor();
        $ppsVisitor->year = $request->input('year');
        $ppsVisitor->counter = $counterName; // Use $counterName here
    }

    // Update visitor counts for each month
    $ppsVisitor->january = $request->input('january');
    $ppsVisitor->february = $request->input('february');
    $ppsVisitor->march = $request->input('march');
    $ppsVisitor->april = $request->input('april');
    $ppsVisitor->may = $request->input('may');
    $ppsVisitor->june = $request->input('june');
    $ppsVisitor->july = $request->input('july');
    $ppsVisitor->august = $request->input('august');
    $ppsVisitor->september = $request->input('september');
    $ppsVisitor->october = $request->input('october');
    $ppsVisitor->november = $request->input('november');
    $ppsVisitor->december = $request->input('december');
    // Repeat for other months...

    // Save the record
    $ppsVisitor->save();

    return redirect()->route('pps.pps.index')
        ->with('success_message', 'Visitor data added successfully.');
}




public function editpps($id)
{
    // Retrieve the PPSVisitor instance by its ID
    $ppsVisitor = PPSVisitor::findOrFail($id);

    // Get the counter and years for this PPSVisitor instance
    $counter = $ppsVisitor->counter;
    
    // Retrieve the unique years for all PPSVisitor instances with the same counter
    $years = PPSVisitor::where('counter', $counter)->pluck('year')->unique();
    $data = PPSVisitor::where('counter', $counter)->get();

    // Pass the PPSVisitor instance, counter, and years to the view
    return view('pps.editpps', compact('ppsVisitor', 'counter', 'years', 'data'));
}

public function updatepps(Request $request)
{
    // Validation - validate incoming request data here
    
    // Get the selected year and ID
    $year = $request->input('year');
    $id = $request->input('id');
    
    // Find the corresponding record for the given year and ID
    $ppsVisitor = PPSVisitor::where('year', $year)->where('id', $id)->first();
    
    // If no record exists for the given year and ID, handle this case
    if (!$ppsVisitor) {
        // Handle case where no record exists for the given year and ID
        // For example, you might want to create a new record instead
        // Or display an error message to the user
        // Redirect back to index or wherever appropriate
        return redirect()->route('pps.pps.index')
                         ->with('error_message', 'No record found for the selected year and ID.');
    }
    
    // Update the corresponding month values based on the year
    foreach ($request->all() as $key => $value) {
        // Check if the key corresponds to a month
        if (in_array($key, ['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'])) {
            // Explicitly handle NULL values for January
            if ($key == 'january' && $value === null) {
                $ppsVisitor->$key = null;
            } else {
                $ppsVisitor->$key = $value;
            }
        }
    }

    // Update the updated_at field with the current timestamp
    $ppsVisitor->updated_at = now();
    
    $ppsVisitor->save();
    
    // Redirect back to index or wherever appropriate
    return redirect()->route('pps.pps.index')
                     ->with('success_message', 'Visitor data updated successfully.');
}

    
    

    // ====================================================================================================


    // public function editpps($id)
    // {

    //     $ppsvisitors = PPSVisitor::all()
    //         ->where('id', '=', $id);
        
    //     return view('pps.editpps', compact('ppsvisitors'));

    // }

    // public function updatepps(Request $request)
    // {
    //     $request->validate([]);
    //     $now = Carbon::now();

    //     $ppsvisitors =  PPSVisitor::select('ppsvisitor.*')
    //         ->where('id', $request->id)
    //         ->update([
    //             'january' => $request->january,
    //             'february' => $request->february,
    //             'march' => $request->march,
    //             'april' => $request->april,
    //             'may' => $request->may,
    //             'june' => $request->june,
    //             'july' => $request->july,
    //             'august' => $request->august,
    //             'september' => $request->september,
    //             'october' => $request->october,
    //             'november' => $request->november,
    //             'december' => $request->december,
    //             'year' => $request->year,

    //             'updated_at' => $now
                
    //         ]);


    //     return redirect()->route('pps.pps.index')
    //         ->with('success_message', 'Number of visitors successfully updated!');

    // }

}
