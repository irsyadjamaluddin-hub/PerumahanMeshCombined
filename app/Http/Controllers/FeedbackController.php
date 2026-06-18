<?php

namespace App\Http\Controllers;

use Session;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;


use App\Http\Controllers\Controller;

use App\Models\Biodata;
use App\Models\Employment;
use App\Models\User;
use App\Models\Feedback;
// use App\Models\PeruntukanBersara;
use App\Models\Terminationtype;
use App\Models\Retirementposition;

// use App\Models\Employment;
use App\Models\Department;


use Log;
use Carbon\Carbon;

class FeedbackController extends Controller
{


/**
 * Display a listing of the Biodata applications.
 *
 * @return Illuminate\View\View
 */


public function index()
{
    return view('feedbacks.index');
  
}

public function fb()
{
    return view('feedbacks.fb');
  
}

public function indexadmin()
{
    $feedbacks= Feedback::select('feedbacks.*')->orderBy('created_at', 'DESC')->get();

   

    return view('feedbacks.indexadmin', compact('feedbacks'));
}


public function store(Request $request)
{
 
    $request->validate([
        'jenis' => 'required',
        'catatan' => 'required',
    ]);

    

        $feedback = new Feedback;
        
        $feedback-> jenis = $request->jenis;
        $feedback-> catatan = $request->catatan;
        $feedback-> nama = $request->nama;
        $feedback-> contact = $request->contact;
      

    

    // Save 'acting' data
   $feedback-> save();
   return redirect()->back()
                    ->with('success', 'Your message has been submitted');


}

public function showadmin(Request $request, $id)
    {

        

        $feedbacks = Feedback::select('feedbacks.*')
            ->where('id', $id)
            ->first();

        

        return view('feedbacks.showadmin', compact('feedbacks'));
    }


}
