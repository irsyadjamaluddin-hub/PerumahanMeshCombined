<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\SoalanTaklimat;
use App\Models\PerkaraSoalanTaklimat;
use Carbon\Carbon;


class SoalanTaklimatController extends Controller
{
    public function index(){

            //generate two random numbers for addition

    $num1 = rand(1,10);
    $num2 = rand(1,10);

    //store the correct answer in the session

    session(['captcha_answer'=> $num1 + $num2]);

    //create the captcha question

    $captchaQuestion = "{$num1} + {$num2} = ?";

        $departments = Department::pluck('label', 'id')->all();
        $perkara = PerkaraSoalanTaklimat::pluck('perkara','id')->all();
        $currentdate = Carbon::now();
    
        return view('soalantaklimat.index', compact('departments','currentdate','perkara','captchaQuestion'));
    }

    public function store(Request $request){

        $request->validate([
        
            'captcha'=> 'required|digits_between:1,2',        
        
        ]);
       
            //validate CAPTCHA agains the answer stored in the session

            $captchaAnswer = session('captcha_answer');
            if($request->input('captcha') != $captchaAnswer){
                return redirect()->back()->witherrors(['captcha'=> 'Invalid CAPTCHA. Please try again.'])->withInput();
            }
       
        $soalantaklimat = new SoalanTaklimat;
        
        $soalantaklimat-> nama = $request->nama;
        $soalantaklimat-> organisation = $request->organisation;
        $soalantaklimat-> perkara = $request->perkara;
        $soalantaklimat-> tarikh_st = $request->tarikh_st;
        $soalantaklimat-> soalan = $request->soalan;
        $soalantaklimat->save();
        
        session()->forget('captcha_answer');

        return redirect()->back()->with('success_message', 'Soalan Telah Di Hantar');

    }

    public function storeperkara(Request $request){

        $perkara_st = new PerkaraSoalanTaklimat;
        
        $perkara_st-> perkara = $request->perkara;
        $perkara_st->save();

        return redirect()->route('st.soalantaklimat.indexadmin')
                ->with('success_message', 'Perkara was updated!');

    }

    public function indexadmin()
    {
        $soalantaklimat= SoalanTaklimat::select('soalan_taklimat.*')
        ->orderBy('tarikh_st', 'DESC')
        ->get();

        $perkara_st = PerkaraSoalanTaklimat::select('perkara_st.*')
        ->get();
    
        return view('soalantaklimat.indexadmin', compact('soalantaklimat','perkara_st'));	
    }

    public function showadmin($id)
    {
    
        $soalantaklimat =SoalanTaklimat::select('soalan_taklimat.*')
            ->orderBy('tarikh_st', 'DESC')
            ->where('soalan_taklimat.id', '=', $id)
            ->get();

          return view('soalantaklimat.showadmin', compact('soalantaklimat'));
    }

    public function destroy($id)
    {
        try {


          $soalantaklimat= SoalanTaklimat::where('id', $id)->delete();

            return redirect()->route('st.soalantaklimat.indexadmin')
                ->with('success_message', 'Data was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function destroyperkara($id)
    {
        try {


          $pst= PerkaraSoalanTaklimat::where('id', $id)->delete();

            return redirect()->route('st.soalantaklimat.indexadmin')
                ->with('success_message', 'Data was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }
}
