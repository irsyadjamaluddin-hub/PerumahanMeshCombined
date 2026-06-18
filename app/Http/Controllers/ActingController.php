<?php

namespace App\Http\Controllers;

use Session;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;


use App\Models\Biodata;
use App\Models\User;
use App\Models\SalaryScale;
use App\Models\Acting;
use App\Models\ReasonActing;


use Log;
use Carbon\Carbon;

class ActingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the Biodata applications.
     *
     * @return Illuminate\View\View
     */
	
	public function index()
    {
        $acts= Acting::select('actings.*')->orderBy('created_at', 'DESC')->get();

        return view('actings.index', compact('acts'));
    }

    public function indexP()
    {
        $ic = Auth::user()->ic_no;

        $acts= Acting::select('actings.*')->where('ic_no', $ic )->orderBy('created_at', 'DESC')->get();

        return view('actings.indexP', compact('acts'));
    }

    public function create()
    {
        $salary_scale = SalaryScale::pluck('label','id')->all();
        $reason = ReasonActing::pluck('label','id')->all();


        return view('actings.create', compact('salary_scale', 'reason'));
      
    }

    public function store(Request $request)
    {
     
        $request->validate([
            'name' => 'required',
            'ic_no' => 'required',
            'acting_post' => 'required',
            'acting_salary_scale' => 'required',
            'start_date_acting' => 'required',
            'end_date_acting' => 'required',
            'reason' => 'required',
            //'acting_period' => 'required|int',
            'acting_file' => 'mimes:jpg,jpeg,bmp,png,pdf|max:2048'
        ]);

        $icNos = Auth::user()->ic_no;

        if($request->acting_file != ''){

            $act = new Acting;
            $act-> name = $request->name;
            $act-> ic_no = $request->ic_no;
            $act-> acting_post = $request->acting_post;
            $act-> acting_salary_scale = $request->acting_salary_scale;
            $act-> acting_start_date = $request->start_date_acting;
            $act-> acting_end_date = $request->end_date_acting;
            $act-> acting_reason = $request->reason;
            $act-> acting_period = $request->acting_period;
            $act-> created_by_ic_no = $icNos;
            $act-> acting_filename = $request->acting_file->getClientOriginalName();
            $act-> acting_file = $request->file('acting_file')->store('acting', 'public');

        } else{

            $act = new Acting;
            $act-> name = $request->name;
            $act-> ic_no = $request->ic_no;
            $act-> acting_post = $request->acting_post;
            $act-> acting_salary_scale = $request->acting_salary_scale;
            $act-> acting_start_date = $request->start_date_acting;
            $act-> acting_end_date = $request->end_date_acting;
            $act-> acting_reason = $request->reason;
            $act-> acting_period = $request->acting_period;
            $act-> created_by_ic_no = $icNos;

        }

        // Save 'acting' data
       $act-> save();

        return redirect()->route('actings.acting.index')
            ->with('success_message', 'New Memangku record was successfully added!');


    }

    public function edit($id)
    {
        
        $actings= Acting::all()
                    ->where('id', '=', $id);

        $salary_scale = SalaryScale::pluck('label','id')->all();
        $reason = ReasonActing::pluck('label','id')->all();
                               
        return view('actings.edit', compact('actings' , 'salary_scale', 'reason') );
      
    }

    public function editP($id)
    {
        
        $actings= Acting::all()
                    ->where('id', '=', $id);

        $salary_scale = SalaryScale::pluck('label','id')->all();
        $reason = ReasonActing::pluck('label','id')->all();
                               
        return view('actings.editP', compact('actings' , 'salary_scale', 'reason') );
      
    }

    public function search(Request $request)
    {
        $id = $request->ic_search;

        $salary_scale = SalaryScale::pluck('label','id')->all();
        $reason = ReasonActing::pluck('label','id')->all();

        $biodatas= Biodata::all()
                    ->where('ic_no', '=', $id);
                               
        return view('actings.createSearch', compact('biodatas' , 'id', 'salary_scale', 'reason') );
      
    }

  

    public function searchIC(Request $request)
    {
        $id = $request->ic_no;

        $acts= Acting::where('ic_no', '=', $id)
                    ->orWhere('ic_no', 'like', '%' . $id . '%')
                    ->orWhere('name', 'like', '%' . $id . '%')
                    ->get();
                
        return view('actings.index', compact('acts') );
      
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'ic_no' => 'required',
            'acting_post' => 'required',
            'acting_salary_scale' => 'required',
            'start_date_acting' => 'required',
            'end_date_acting' => 'required',
            'reason' => 'required',
            //'acting_period' => 'required|int',
            'acting_file' => 'mimes:jpg,jpeg,bmp,png,pdf|max:2048'
        ]);

        $now = Carbon::now();

        if($request->acting_file != ''){

            $act1 = Acting::select(['actings.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('id', $request->id)
            ->value('acting_filename');

            if($act1 != ''){

                Storage::disk('public')->delete($act1);

                $act =  Acting::select('actings.*')
                ->where('id', $request->id)
                    ->update([
                        'acting_post'         =>      $request->acting_post,
                        'acting_salary_scale'      =>      $request->acting_salary_scale,
                        'acting_start_date'      =>      $request->start_date_acting,
                        'acting_end_date'      =>      $request->end_date_acting,
                        'acting_reason' => $request->reason,
                        'acting_period' => $request->acting_period,
                        'acting_filename' => $request->acting_file->getClientOriginalName(),
                        'acting_file' => $request->file('acting_file')->store('acting', 'public'),
                        'updated_at' => $now
                    ]);

            }else{

                $act =  Acting::select('actings.*')
                ->where('id', $request->id)
                    ->update([
                        'acting_post'         =>      $request->acting_post,
                        'acting_salary_scale'      =>      $request->acting_salary_scale,
                        'acting_start_date'      =>      $request->start_date_acting,
                        'acting_end_date'      =>      $request->end_date_acting,
                        'acting_reason' => $request->reason,
                        'acting_period' => $request->acting_period,
                        'acting_filename' => $request->acting_file->getClientOriginalName(),
                        'acting_file' => $request->file('acting_file')->store('acting', 'public'),
                        'updated_at' => $now
                    ]);


            }


        }
        else{

                $act =  Acting::select('actings.*')
                ->where('id', $request->id)
                ->update([
                    'acting_post'         =>      $request->acting_post,
                    'acting_salary_scale'      =>      $request->acting_salary_scale,
                    'acting_start_date'      =>      $request->start_date_acting,
                    'acting_end_date'      =>      $request->end_date_acting,
                    'acting_reason' => $request->reason,
                    'acting_period' => $request->acting_period,
                    'updated_at' => $now

                ]);

        }

        return redirect()->route('actings.acting.index')
            ->with('success_message', 'Memangku record was successfully updated!');

        
          
    }

    public function updateP(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'ic_no' => 'required',
            'acting_post' => 'required',
            'acting_salary_scale' => 'required',
            'start_date_acting' => 'required',
            'end_date_acting' => 'required',
            'reason' => 'required',
            'acting_period' => 'required|int',
            'acting_file' => 'required|mimes:jpg,jpeg,bmp,png,pdf|max:2048'
        ]);

        $now = Carbon::now();

        $act =  Acting::select('actings.*')
                ->where('id', $request->id)
                    ->update([
                        'acting_post'         =>      $request->acting_post,
                        'acting_salary_scale'      =>      $request->acting_salary_scale,
                        'acting_start_date'      =>      $request->start_date_acting,
                        'acting_end_date'      =>      $request->end_date_acting,
                        'acting_reason' => $request->reason,
                        'acting_period' => $request->acting_period,
                        'acting_filename' => $request->acting_file->getClientOriginalName(),
                        'acting_file' => $request->file('acting_file')->store('acting', 'public'),
                        'updated_at' => $now
                    ]);

         

        return redirect()->route('actings.acting.indexP')
            ->with('success_message', 'Memangku record was successfully updated!');

        
          
    }

    public function destroy($id)
    {
        try {

            $act1 = Acting::select(['actings.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('id', $id)
            ->value('acting_file');

            Storage::disk('public')->delete($act1);

            $act = Acting::where('id', $id)->delete();

          

            return redirect()->route('actings.acting.index')
                             ->with('success_message', 'Memangku was successfully deleted!');

            

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }


}
