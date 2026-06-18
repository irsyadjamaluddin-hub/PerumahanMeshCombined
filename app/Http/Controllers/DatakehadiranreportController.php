<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Datakehadiran;
use App\Models\Datakehadiranschools;




use Auth;
use Hash;
use DB;


class DatakehadiranreportController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('/home');
    }
	
    public function dkreport()
    {

        $countAll = Datakehadiran::where('kategori', '!=', 'PEGAWAI & KAKITANGAN')->count();

        $countPositive = Datakehadiran::where('hadir', '1')
          ->where('kategori', '!=', 'PEGAWAI & KAKITANGAN')
          ->count();

      $countNegative = Datakehadiran::where(function ($query) {
        $query->where('hadir', 'x')
              ->orWhere('hadir', 'X');
		    })
		    ->where('kategori', '!=', 'PEGAWAI & KAKITANGAN')
		    ->count();

    $countAction = Datakehadiran::where(function ($query) {
        $query->where('hadir', '')
              ->orWhereNull('hadir');
    })
    ->where('kategori', '!=', 'PEGAWAI & KAKITANGAN')
    ->count();

    
 $uniform= Datakehadiran::where('kategori', 'PASUKAN BERUNIFORM')->count();
 $moeteras= Datakehadiran::where('kategori', 'MOE PENDIDIKAN TERAS')->count();
 $moepengajiantinggi= Datakehadiran::where('kategori', 'MOE PENGAJIAN TINGGI')->count();
 $mora= Datakehadiran::where('kategori', 'MORA')->count();
 $swasta= Datakehadiran::where('kategori', 'SEKOLAH-SEKOLAH SWASTA')->count();
 $ipts= Datakehadiran::where('kategori', 'INSTITUT PENGAJIAN TINGGI SWASTA')->count();

 $iptshadir = Datakehadiran::where('kategori', 'INSTITUT PENGAJIAN TINGGI SWASTA')
                     ->where('hadir', 1)
                     ->count();

                     
                     $iptsnonhadir = Datakehadiran::where('kategori', 'INSTITUT PENGAJIAN TINGGI SWASTA')
                     ->where(function($query) {
                         $query->where('hadir', 'x')
                               ->orWhere('hadir', 'X')
                               ->orWhereNull('hadir')
                               ->orWhere('hadir', '');
                     })
                     ->count();

                     // For 'PASUKAN BERUNIFORM' with 'hadir' equals 1
$uniformhadir = Datakehadiran::where('kategori', 'PASUKAN BERUNIFORM')
->where('hadir', 1)
->count();

// For 'PASUKAN BERUNIFORM' with 'hadir' not equal to 1, null, or empty
$uniformnonhadir = Datakehadiran::where('kategori', 'PASUKAN BERUNIFORM')
   ->where(function($query) {
       $query->where('hadir', '<>', 1)
             ->orWhereNull('hadir')
             ->orWhere('hadir', '');
   })
   ->count();

   // For 'MOE PENDIDIKAN TERAS' with 'hadir' equals 1
$moeterashadir = Datakehadiran::where('kategori', 'MOE PENDIDIKAN TERAS')
->where('hadir', 1)
->count();

// For 'MOE PENDIDIKAN TERAS' with 'hadir' not equal to 1, null, or empty
$moeterasnonhadir = Datakehadiran::where('kategori', 'MOE PENDIDIKAN TERAS')
   ->where(function($query) {
       $query->where('hadir', '<>', 1)
             ->orWhereNull('hadir')
             ->orWhere('hadir', '');
   })
   ->count();

// For 'MOE PENGAJIAN TINGGI' with 'hadir' equals 1
$moepengajiantinggihadir = Datakehadiran::where('kategori', 'MOE PENGAJIAN TINGGI')
          ->where('hadir', 1)
          ->count();

// For 'MOE PENGAJIAN TINGGI' with 'hadir' not equal to 1, null, or empty
$moepengajiantingginonhadir = Datakehadiran::where('kategori', 'MOE PENGAJIAN TINGGI')
             ->where(function($query) {
                 $query->where('hadir', '<>', 1)
                       ->orWhereNull('hadir')
                       ->orWhere('hadir', '');
             })
             ->count();

// For 'MORA' with 'hadir' equals 1
$morahadir = Datakehadiran::where('kategori', 'MORA')
->where('hadir', 1)
->count();

// For 'MORA' with 'hadir' not equal to 1, null, or empty
$moranonhadir = Datakehadiran::where('kategori', 'MORA')
->where(function($query) {
   $query->where('hadir', '<>', 1)
         ->orWhereNull('hadir')
         ->orWhere('hadir', '');
})
->count();

// For 'SEKOLAH-SEKOLAH SWASTA' with 'hadir' equals 1
$swastahadir = Datakehadiran::where('kategori', 'SEKOLAH-SEKOLAH SWASTA')
->where('hadir', 1)
->count();

// For 'SEKOLAH-SEKOLAH SWASTA' with 'hadir' not equal to 1, null, or empty
$swastanonhadir = Datakehadiran::where('kategori', 'SEKOLAH-SEKOLAH SWASTA')
 ->where(function($query) {
     $query->where('hadir', '<>', 1)
           ->orWhereNull('hadir')
           ->orWhere('hadir', '');
 })
 ->count();

 //chart pelajar dan guru pengawas

  //tablechart
$pelajarteras = Datakehadiran::where('kategori', 'MOE PENDIDIKAN TERAS')
    ->where('hadir', 1)
    ->where(function ($query) {
        $query->whereNull('pasukan')
              ->orWhere('pasukan', '');
    })
    ->where(function ($query) {
        $query->whereRaw('LOWER(type_pelajar_pengawas) = ?', ['p'])
              ->orWhereRaw('LOWER(type_pelajar_pengawas) = ?', ['ph']);
    })
    ->count();




$pelajarpt = Datakehadiran::where('kategori', 'MOE PENGAJIAN TINGGI')
->where('hadir', 1)
    ->where(function ($query) {
        $query->whereNull('pasukan')
              ->orWhere('pasukan', '');
    })
    ->where(function ($query) {
        $query->whereRaw('LOWER(type_pelajar_pengawas) = ?', ['p'])
              ->orWhereRaw('LOWER(type_pelajar_pengawas) = ?', ['ph']);
    })
    ->count();


$pelajarmora = Datakehadiran::where('kategori', 'MORA')
->where('hadir', 1)
    ->where(function ($query) {
        $query->whereNull('pasukan')
              ->orWhere('pasukan', '');
    })
    ->where(function ($query) {
        $query->whereRaw('LOWER(type_pelajar_pengawas) = ?', ['p'])
              ->orWhereRaw('LOWER(type_pelajar_pengawas) = ?', ['ph']);
    })
    ->count();



$pelajarswasta = Datakehadiran::where('kategori', 'SEKOLAH-SEKOLAH SWASTA')
->where('hadir', 1)
    ->where(function ($query) {
        $query->whereNull('pasukan')
              ->orWhere('pasukan', '');
    })
    ->where(function ($query) {
        $query->whereRaw('LOWER(type_pelajar_pengawas) = ?', ['p'])
              ->orWhereRaw('LOWER(type_pelajar_pengawas) = ?', ['ph']);
    })
    ->count();

$pelajaripts = Datakehadiran::where('kategori', 'INSTITUT PENGAJIAN TINGGI SWASTA')
->where('hadir', 1)
    ->where(function ($query) {
        $query->whereNull('pasukan')
              ->orWhere('pasukan', '');
    })
    ->where(function ($query) {
        $query->whereRaw('LOWER(type_pelajar_pengawas) = ?', ['p'])
              ->orWhereRaw('LOWER(type_pelajar_pengawas) = ?', ['ph']);
    })
    ->count();


//guru

$guruteras = Datakehadiran::where('kategori', 'MOE PENDIDIKAN TERAS')
    ->where('hadir', 1)
    ->where(function($query) {
        $query->whereNull('pasukan')
              ->orWhere('pasukan', '');
    })
       ->where(function($query) {
        $query->whereRaw('LOWER(type_pelajar_pengawas) = ?', ['g'])
              ->orwhereRaw('LOWER(type_pelajar_pengawas) = ?', ['gp'])
              ->orwhereRaw('LOWER(type_pelajar_pengawas) = ?', ['gh'])
              ->orwhereRaw('LOWER(type_pelajar_pengawas) = ?', ['pu'])
              ->orwhereRaw('LOWER(type_pelajar_pengawas) = ?', ['pengawas']);
    })
    ->count();

    $gurupt = Datakehadiran::where('kategori', 'MOE PENGAJIAN TINGGI')
    ->where('hadir', 1)
    ->where(function($query) {
        $query->whereNull('pasukan')
              ->orWhere('pasukan', '');
    })
       ->where(function($query) {
        $query->whereRaw('LOWER(type_pelajar_pengawas) = ?', ['g'])
              ->orwhereRaw('LOWER(type_pelajar_pengawas) = ?', ['gp'])
              ->orwhereRaw('LOWER(type_pelajar_pengawas) = ?', ['gh'])
              ->orwhereRaw('LOWER(type_pelajar_pengawas) = ?', ['pu'])
              ->orwhereRaw('LOWER(type_pelajar_pengawas) = ?', ['pengawas']);
    })
    ->count();

    $gurumora = Datakehadiran::where('kategori', 'MORA')
    ->where('hadir', 1)
    ->where(function($query) {
        $query->whereNull('pasukan')
              ->orWhere('pasukan', '');
    })
       ->where(function($query) {
        $query->whereRaw('LOWER(type_pelajar_pengawas) = ?', ['g'])
              ->orwhereRaw('LOWER(type_pelajar_pengawas) = ?', ['gp'])
              ->orwhereRaw('LOWER(type_pelajar_pengawas) = ?', ['gh'])
              ->orwhereRaw('LOWER(type_pelajar_pengawas) = ?', ['pu'])
              ->orwhereRaw('LOWER(type_pelajar_pengawas) = ?', ['pengawas']);
    })
    ->count();

 

    $guruswasta = Datakehadiran::where('kategori', 'SEKOLAH-SEKOLAH SWASTA')
    ->where('hadir', 1)
    ->where(function($query) {
        $query->whereNull('pasukan')
              ->orWhere('pasukan', '');
    })
       ->where(function($query) {
        $query->whereRaw('LOWER(type_pelajar_pengawas) = ?', ['g'])
              ->orwhereRaw('LOWER(type_pelajar_pengawas) = ?', ['gp'])
              ->orwhereRaw('LOWER(type_pelajar_pengawas) = ?', ['gh'])
              ->orwhereRaw('LOWER(type_pelajar_pengawas) = ?', ['pu'])
              ->orwhereRaw('LOWER(type_pelajar_pengawas) = ?', ['pengawas']);
    })
    ->count();

    $guruipts = Datakehadiran::where('kategori', 'INSTITUT PENGAJIAN TINGGI SWASTA')
    ->where('hadir', 1)
    ->where(function($query) {
        $query->whereNull('pasukan')
              ->orWhere('pasukan', '');
    })
       ->where(function($query) {
        $query->whereRaw('LOWER(type_pelajar_pengawas) = ?', ['g'])
              ->orwhereRaw('LOWER(type_pelajar_pengawas) = ?', ['gp'])
              ->orwhereRaw('LOWER(type_pelajar_pengawas) = ?', ['gh'])
              ->orwhereRaw('LOWER(type_pelajar_pengawas) = ?', ['pu'])
              ->orwhereRaw('LOWER(type_pelajar_pengawas) = ?', ['pengawas']);
    })
    ->count();

    //hadrah pelajar
    $hadrahpelajarteras = Datakehadiran::where('kategori', 'MOE PENDIDIKAN TERAS')
    ->where('hadir', 1)
    ->where('pasukan', 'pasukan hadrah')
    ->where(function($query) {
        $query->whereRaw('LOWER(type_pelajar_pengawas) = ?', ['p'])
              ->orWhereRaw('LOWER(type_pelajar_pengawas) = ?', ['ph']);
    })
    ->count();

    $hadrahpelajarpt = Datakehadiran::where('kategori', 'MOE PENGAJIAN TINGGI')
    ->where('hadir', 1)
    ->where('pasukan', 'pasukan hadrah')
    ->where(function($query) {
        $query->whereRaw('LOWER(type_pelajar_pengawas) = ?', ['p'])
              ->orWhereRaw('LOWER(type_pelajar_pengawas) = ?', ['ph']);
    })
    ->count();

    $hadrahpelajarmora = Datakehadiran::where('kategori', 'MORA')
    ->where('pasukan', 'pasukan hadrah')
    ->where('hadir', 1)
    ->where(function($query) {
        $query->whereRaw('LOWER(type_pelajar_pengawas) = ?', ['p'])
              ->orWhereRaw('LOWER(type_pelajar_pengawas) = ?', ['ph']);
    })
    ->count();

   
    $hadrahpelajarswasta = Datakehadiran::where('kategori', 'SEKOLAH-SEKOLAH SWASTA')
    ->where('hadir', 1)
    ->where('pasukan', 'pasukan hadrah')
    ->where(function($query) {
        $query->whereRaw('LOWER(type_pelajar_pengawas) = ?', ['p'])
              ->orWhereRaw('LOWER(type_pelajar_pengawas) = ?', ['ph']);
    })
    ->count();

    $hadrahpelajaripts = Datakehadiran::where('kategori', 'INSTITUT PENGAJIAN TINGGI SWASTA')
    ->where('hadir', 1)
    ->where('pasukan', 'pasukan hadrah')
    ->where(function($query) {
        $query->whereRaw('LOWER(type_pelajar_pengawas) = ?', ['p'])
              ->orWhereRaw('LOWER(type_pelajar_pengawas) = ?', ['ph']);
    })
    ->count();

    // guru hadrah
    //hadrah pelajar
    $hadrahguruteras = Datakehadiran::where('kategori', 'MOE PENDIDIKAN TERAS')
    ->where('hadir', 1)
    ->where('pasukan', 'pasukan hadrah')
    ->where(function($query) {
        $query->whereRaw('LOWER(type_pelajar_pengawas) = ?', ['g'])
              ->orWhereRaw('LOWER(type_pelajar_pengawas) = ?', ['gh'])
              ->orWhereRaw('LOWER(type_pelajar_pengawas) = LOWER(?)', ['gp']);
    })
    ->count();

    $hadrahgurupt = Datakehadiran::where('kategori', 'MOE PENGAJIAN TINGGI')
    ->where('hadir', 1)
    ->where('pasukan', 'pasukan hadrah')
    ->where(function($query) {
        $query->whereRaw('LOWER(type_pelajar_pengawas) = ?', ['g'])
              ->orWhereRaw('LOWER(type_pelajar_pengawas) = ?', ['gh'])
              ->orWhereRaw('LOWER(type_pelajar_pengawas) = LOWER(?)', ['gp']);
    })
    ->count();


    $hadrahgurumora = Datakehadiran::where('kategori', 'MORA')
    ->where('pasukan', 'pasukan hadrah')
    ->where('hadir', 1)
    ->where(function($query) {
        $query->whereRaw('LOWER(type_pelajar_pengawas) = ?', ['g'])
              ->orWhereRaw('LOWER(type_pelajar_pengawas) = ?', ['gh'])
              ->orWhereRaw('LOWER(type_pelajar_pengawas) = LOWER(?)', ['gp']);
    })
    ->count();

   

    $hadrahguruswasta = Datakehadiran::where('kategori', 'SEKOLAH-SEKOLAH SWASTA')
    ->where('hadir', 1)
    ->where('pasukan', 'pasukan hadrah')
    ->where(function($query) {
        $query->whereRaw('LOWER(type_pelajar_pengawas) = ?', ['g'])
              ->orWhereRaw('LOWER(type_pelajar_pengawas) = ?', ['gh'])
              ->orWhereRaw('LOWER(type_pelajar_pengawas) = LOWER(?)', ['gp']);
    })
    ->count();

    $hadrahguruipts = Datakehadiran::where('kategori', 'INSTITUT PENGAJIAN TINGGI SWASTA')
    ->where('hadir', 1)
    ->where('pasukan', 'pasukan hadrah')
    ->where(function($query) {
        $query->whereRaw('LOWER(type_pelajar_pengawas) = ?', ['g'])
              ->orWhereRaw('LOWER(type_pelajar_pengawas) = ?', ['gh'])
              ->orWhereRaw('LOWER(type_pelajar_pengawas) = LOWER(?)', ['gp']);
    })
    ->count();



    // Pasukan beruniform data
    $gurupu = Datakehadiran::where('kategori', 'PASUKAN BERUNIFORM')
    ->where('hadir', 1)
    ->where(function($query) {
        $query->where('type_pelajar_pengawas', 'G')
              ->orWhere('type_pelajar_pengawas', 'GP')
              ->orWhere('type_pelajar_pengawas', 'GH')
              ->orWhere('type_pelajar_pengawas', 'PU');


    })
    ->count();

    $pelajarpu = Datakehadiran::where('kategori', 'PASUKAN BERUNIFORM')
    ->where('hadir', 1)
    ->where('type_pelajar_pengawas', 'P')
    ->count();

         //tablechart
    $terasnull = Datakehadiran::where('kategori', 'MOE PENDIDIKAN TERAS')
 ->where('hadir', 1)
    ->where(function ($query) {
        $query->whereNull('pasukan')
              ->orWhere('pasukan', '');
    })
    ->where(function ($query) {
       $query->whereNull('type_pelajar_pengawas')
             ->orWhere('type_pelajar_pengawas', '');
    })
    ->count();

     $ptnull = Datakehadiran::where('kategori', 'MOE PENGAJIAN TINGGI')
   ->where('hadir', 1)
    ->where(function ($query) {
        $query->whereNull('pasukan')
              ->orWhere('pasukan', '');
    })
    ->where(function ($query) {
       $query->whereNull('type_pelajar_pengawas')
             ->orWhere('type_pelajar_pengawas', '');
    })
    ->count();

    $iptsnull = Datakehadiran::where('kategori', 'INSTITUT PENGAJIAN TINGGI SWASTA')
    ->where('hadir', 1)
    ->where(function ($query) {
        $query->whereNull('pasukan')
              ->orWhere('pasukan', '');
    })
    ->where(function ($query) {
       $query->whereNull('type_pelajar_pengawas')
             ->orWhere('type_pelajar_pengawas', '');
    })
    ->count();





    $sumteras = $pelajarteras + $guruteras + $hadrahpelajarteras + $hadrahguruteras;
    $sumpt = $pelajarpt + $gurupt + $hadrahpelajarpt + $hadrahgurupt;
    $summora = $pelajarmora + $gurumora + $hadrahpelajarmora + $hadrahgurumora;
    $sumpu = $pelajarpu + $gurupu;
    $sumswasta = $pelajarswasta + $guruswasta + $hadrahpelajarswasta + $hadrahguruswasta;
    $sumipts = $pelajaripts + $guruipts + $hadrahpelajaripts + $hadrahguruipts;


    $dkschools = Datakehadiranschools::select('data_kehadiran_schools.*')
    ->whereIn('id', range(1, 125))
    ->orWhereIn('id', range(155, 173))
    ->orWhere('id', 178)
    ->orWhereIn('id', range(182, 187))
    ->orWhere('id', 193)
    ->get();

    $dkschoolspt = Datakehadiranschools::select('data_kehadiran_schools.*')
    ->whereIn('id', range(147, 154))
    ->orWhereIn('id', range(129, 130))
    ->orWhereIn('id', range(133, 134))
    ->get();

    $dkschoolsmoras = Datakehadiranschools::select('data_kehadiran_schools.*')
    ->whereIn('id', range(139, 146))
    ->orWhere('id', 128)
    ->get();

    $dkschoolswastas = Datakehadiranschools::select('data_kehadiran_schools.*')
    ->whereIn('id', range(174, 177))
    ->orWhereIn('id', range(179, 181))
    ->get();

   $dkschoolsipts = Datakehadiranschools::select('data_kehadiran_schools.*')
    ->whereIn('id', range(131, 132))
    ->orWhereIn('id', range(135, 138))
    ->orWhereIn('id', range(126, 127))
    ->get();











        return view('/dkreport', compact('countAll', 'countPositive', 'countNegative','countAction', 'moeteras', 'moepengajiantinggi','mora' ,'uniform' ,'swasta','ipts',
        'iptshadir','iptsnonhadir','uniformhadir','uniformnonhadir','moeterashadir','moeterasnonhadir','moepengajiantinggihadir','moepengajiantingginonhadir',
        'morahadir','moranonhadir','swastanonhadir','swastahadir',
          'pelajarteras','pelajarpt','pelajarmora','pelajarswasta','pelajarpu','pelajaripts',
        'guruteras','gurupt','gurumora','guruswasta','gurupu','guruipts',
        'hadrahpelajarteras','hadrahpelajarpt','hadrahpelajarmora','hadrahpelajarswasta','hadrahpelajaripts',
        'hadrahguruteras','hadrahgurupt','hadrahgurumora','hadrahguruswasta','hadrahguruipts',
        'sumteras','sumpt','summora','sumpu','sumswasta','sumipts',
        'terasnull','iptsnull','ptnull',
        'dkschools','dkschoolspt','dkschoolsmoras','dkschoolsipts','dkschoolswastas'

    ));
 
    }


	


   
}
