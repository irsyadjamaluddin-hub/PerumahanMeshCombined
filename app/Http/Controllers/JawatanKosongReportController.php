<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JawtanKosong;
use App\Models\Jawatanlist;



use Auth;
use Hash;
use DB;

class JawatanKosongReportController extends Controller
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


    public function jawatankosongreport()
    {
        $bhg1 = JawtanKosong::where('bhg', 1)->sum('jum_kosong');
        $bhg2 = JawtanKosong::where('bhg', 2)->sum('jum_kosong');
        $bhg3 = JawtanKosong::where('bhg', 3)->sum('jum_kosong');
        $bhg4 = JawtanKosong::where('bhg', 4)->sum('jum_kosong');
        $bhg5 = JawtanKosong::where('bhg', 5)->sum('jum_kosong');
        

        // $prosesjabatan = JawtanKosong::where('status','LIKE', '%Proses Jabatan%')->sum('jum_kosong');
        // $prosesspa = JawtanKosong::where('status', 'LIKE','%Proses SPA%')->sum('jum_kosong');
        // $jupamoe = JawtanKosong::where('status', 'LIKE','%JUPA MOE%')->sum('jum_kosong');
        // $dipangku = JawtanKosong::where('status', 'LIKE','%Dipangku%')->sum('jum_kosong');
        // $tradeoff = JawtanKosong::where('status','LIKE', '%Tradeoff%')->sum('jum_kosong');
        
        $prosesjabatan1 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('status', 'Proses Jabatan')
        ->where('bhg', '1')
        ->value('jum_kosong');

        $prosesjabatan2 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('bhg', '2')
        ->where('status', 'Proses Jabatan')
        ->value('jum_kosong');

        $prosesjabatan3 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('status', 'Proses Jabatan')
        ->where('bhg', '3')
        ->value('jum_kosong');

        $prosesjabatan4 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('bhg', '4')
        ->where('status', 'Proses Jabatan')
        ->value('jum_kosong');

        $prosesjabatan5 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('bhg', '5')
        ->where('status', 'Proses Jabatan')
        ->value('jum_kosong');


        $prosesspa1 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('bhg', '1')
        ->where('status', 'Proses SPA')
        ->value('jum_kosong');

        $prosesspa2 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('bhg', '2')
        ->where('status', 'Proses SPA')
        ->value('jum_kosong');

        $prosesspa3 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('bhg', '3')
        ->where('status', 'Proses SPA')
        ->value('jum_kosong');

        $prosesspa4 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('bhg', '4')
        ->where('status', 'Proses SPA')
        ->value('jum_kosong');

        $prosesspa5 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('bhg', '5')
        ->where('status', 'Proses SPA')
        ->value('jum_kosong');

        $jupamoe1 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('bhg', '1')
        ->where('status', 'JUPA MOE')
        ->value('jum_kosong');

        $jupamoe2 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('bhg', '2')
        ->where('status', 'JUPA MOE')
        ->value('jum_kosong');

        $jupamoe3 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('bhg', '3')
        ->where('status', 'JUPA MOE')
        ->value('jum_kosong');

        $jupamoe4 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('bhg', '4')
        ->where('status', 'JUPA MOE')
        ->value('jum_kosong');

        $jupamoe5 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('bhg', '5')
        ->where('status', 'JUPA MOE')
        ->value('jum_kosong');

        $dipangku1 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('bhg', '1')
        ->where('status', 'Dipangku')
        ->value('jum_kosong');

        $dipangku2 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('bhg', '2')
        ->where('status', 'Dipangku')
        ->value('jum_kosong');

        $dipangku3 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('bhg', '3')
        ->where('status', 'Dipangku')
        ->value('jum_kosong');

        $dipangku4 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('bhg', '4')
        ->where('status', 'Dipangku')
        ->value('jum_kosong');

        $dipangku5 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('bhg', '5')
        ->where('status', 'Dipangku')
        ->value('jum_kosong');

        $tradeoff1 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('bhg', '1')
        ->where('status', 'Tradeoff')
        ->value('jum_kosong');

        $tradeoff2 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('bhg', '2')
        ->where('status', 'Tradeoff')
        ->value('jum_kosong');

        $tradeoff3 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('bhg', '3')
        ->where('status', 'Tradeoff')
        ->value('jum_kosong');

        $tradeoff4 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('bhg', '4')
        ->where('status', 'Tradeoff')
        ->value('jum_kosong');

        $tradeoff5= JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('bhg', '5')
        ->where('status', 'Tradeoff')
        ->value('jum_kosong');

        // chart 3


        $jumlahdept1 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('dept_id', '1')
        ->where('status', '!=', 'Diisikan')
        ->value('jum_kosong');

        $jumlahdept2 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('dept_id', '2')
        ->where('status', '!=', 'Diisikan')
        ->value('jum_kosong');

        $jumlahdept3 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('dept_id', '3')
        ->where('status', '!=', 'Diisikan')
        ->value('jum_kosong');

        $jumlahdept4 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('dept_id', '4')
        ->where('status', '!=', 'Diisikan')
        ->value('jum_kosong');

        $jumlahdept5 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('dept_id', '5')
        ->where('status', '!=', 'Diisikan')
        ->value('jum_kosong');

        $jumlahdept6 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('dept_id', '6')
        ->where('status', '!=', 'Diisikan')
        ->value('jum_kosong');

        $jumlahdept7 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('dept_id', '7')
        ->where('status', '!=', 'Diisikan')
        ->value('jum_kosong');

        $jumlahdept8 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('dept_id', '8')
        ->where('status', '!=', 'Diisikan')
        ->value('jum_kosong');

        $jumlahdept9 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('dept_id', '9')
        ->where('status', '!=', 'Diisikan')
        ->value('jum_kosong');

        $jumlahdept10 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('dept_id', '10')
        ->where('status', '!=', 'Diisikan')
        ->value('jum_kosong');

        $jumlahdept11 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('dept_id', '11')
        ->where('status', '!=', 'Diisikan')
        ->value('jum_kosong');


        $jumlahdept12 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('dept_id', '12')
        ->where('status', '!=', 'Diisikan')
        ->value('jum_kosong');

        $jumlahdept13 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('dept_id', '13')
        ->where('status', '!=', 'Diisikan')
        ->value('jum_kosong');

        $jumlahdept14 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('dept_id', '14')
        ->where('status', '!=', 'Diisikan')
        ->value('jum_kosong');

        $jumlahdept15 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('dept_id', '15')
        ->where('status', '!=', 'Diisikan')
        ->value('jum_kosong');

        $jumlahdept16 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('dept_id', '16')
        ->where('status', '!=', 'Diisikan')
        ->value('jum_kosong');

        $jumlahdept17 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('dept_id', '17')
        ->where('status', '!=', 'Diisikan')
        ->value('jum_kosong');

        $jumlahdept18 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('dept_id', '18')
        ->where('status', '!=', 'Diisikan')
        ->value('jum_kosong');

        $jumlahdept19 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('dept_id', '19')
        ->where('status', '!=', 'Diisikan')
        ->value('jum_kosong');

        $jumlahdept20 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('dept_id', '20')
        ->where('status', '!=', 'Diisikan')
        ->value('jum_kosong');

        $jumlahdept21 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('dept_id', '21')
        ->where('status', '!=', 'Diisikan')
        ->value('jum_kosong');

        $jumlahdept22 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('dept_id', '22')
        ->where('status', '!=', 'Diisikan')
        ->value('jum_kosong');

        $jumlahdept23 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('dept_id', '23')
        ->where('status', '!=', 'Diisikan')
        ->value('jum_kosong');

        $jumlahdept24 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('dept_id', '24')
        ->where('status', '!=', 'Diisikan')
        ->value('jum_kosong');

        $jumlahdept25 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('dept_id', '25')
        ->where('status', '!=', 'Diisikan')
        ->value('jum_kosong');

        $jumlahdept26 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('dept_id', '26')
        ->where('status', '!=', 'Diisikan')
        ->value('jum_kosong');

        $jumlahdept27 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('dept_id', '27')
        ->where('status', '!=', 'Diisikan')
        ->value('jum_kosong');

        $jumlahdept28 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('dept_id', '28')
        ->where('status', '!=', 'Diisikan')
        ->value('jum_kosong');

        $jumlahdept29 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('dept_id', '29')
        ->where('status', '!=', 'Diisikan')
        ->value('jum_kosong');

        $jumlahdept30 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('dept_id', '30')
        ->where('status', '!=', 'Diisikan')
        ->value('jum_kosong');

        $jumlahdept31 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('dept_id', '31')
        ->where('status', '!=', 'Diisikan')
        ->value('jum_kosong');

        $jumlahdept32 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('dept_id', '32')
        ->where('status', '!=', 'Diisikan')
        ->value('jum_kosong');

        $jumlahdept33 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('dept_id', '33')
        ->where('status', '!=', 'Diisikan')
        ->value('jum_kosong');

        $jumlahdept34 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('dept_id', '34')
        ->where('status', '!=', 'Diisikan')
        ->value('jum_kosong');

        $jumlahdept35 = JawtanKosong::selectRaw('ISNULL(SUM(jum_kosong), 0) AS jum_kosong')
        ->where('dept_id', '35')
        ->where('status', '!=', 'Diisikan')
        ->value('jum_kosong');

        $jawatanlist = Jawatanlist::select('jawatansenarais.*')->orderBy('id', 'DESC')->get();

        $sumJawatanList = JawtanKosong::leftJoin('jawatansenarais', 'jawatankosong.jawatan', '=', 'jawatansenarais.id')
        ->select('jawatankosong.jawatan', DB::raw('SUM(jawatankosong.jum_kosong) as total_kosong'))
        ->where('status', '!=', 'Diisikan')
        ->groupBy('jawatankosong.jawatan')
        ->get();

        foreach ($sumJawatanList as $item) {
            $jawatan = Jawatanlist::find($item->jawatan);

            if ($jawatan) {
                $jawatan->total_kosong = $item->total_kosong;
            }
        }

        // $sumjawatanlist = JawtanKosong::leftJoin('jawatansenarais', 'jawatankosongs.jawatan', '=', 'jawatansenarais.id')
        // ->select('jawatankosongs.*', 'jawatansenarais.label')
        // ->where('label', $request->kpd_jabatan)
        // ->first();

       
        return view('/jawatankosongreport', compact('bhg1','bhg2','bhg3','bhg4','bhg5',
        'prosesjabatan1','prosesjabatan2', 'prosesjabatan3','prosesjabatan4', 'prosesjabatan5',
        'prosesspa1', 'prosesspa2', 'prosesspa3', 'prosesspa4', 'prosesspa5',
        'jupamoe1', 'jupamoe2', 'jupamoe3', 'jupamoe4', 'jupamoe5',
        'dipangku1','dipangku2','dipangku3','dipangku4', 'dipangku5',
        'tradeoff1', 'tradeoff2', 'tradeoff3', 'tradeoff4', 'tradeoff5',
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
        'jumlahdept12' ,
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
        'jawatanlist',
        'sumJawatanList'

    ));
    }
}
