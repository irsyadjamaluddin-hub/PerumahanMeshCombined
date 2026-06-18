<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PersonnelID;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

class PersonnelIDController extends Controller
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

    public function index(){

        $icNos = Auth::user()->ic_no;
        
        $pi = PersonnelID::select('personnel_id.*')
            ->paginate(500);
        
        return view('personnelid.index',compact('pi'));
    }

    public function searchpersonnel(Request $request)
    {
        $query = $request->input('query');
    
        // Define the columns you want to search in
        $columns = ['name', 'department','ic_no', 'personnel_id','position'];
    
        // Start building the query
        $pi = PersonnelID::where(function ($queryBuilder) use ($columns, $query) {
            foreach ($columns as $column) {
                $queryBuilder->orWhere($column, 'LIKE', '%' . $query . '%');
            }
        })->orderBy('updated_at', 'DESC');
    
        // Check if the number of results exceeds a threshold
        $threshold = 1000; // Adjust the threshold as needed
        $totalResults = $pi->count();
    
        if ($totalResults > $threshold) {
            $pi = $pi->paginate(5000);
        } else {
            $pi = $pi->paginate(500);
        }

        $now = Carbon::now();
    
        return view('personnelid.indexsearch', ['pi' => $pi, 'now' => $now]);
    }

    public function update(Request $request)
    {
        $now = Carbon::now();

        $pi = PersonnelID::select('attendance_list.*')
            ->where('id', $request->id)
            ->update([
                'name' => $request->name,
                'ic_no' => $request->ic_no,
                'position' => $request->position,
                'department' => $request->department,
                'personnel_id' => $request->personnel_id,
                'updated_at' => $now
            ]);
    
       return redirect()->back()
       ->with('success_message', 'Data was successfully updated!');
    }
}
