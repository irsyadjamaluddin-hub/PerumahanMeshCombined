<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CCA;
use App\Models\School;
use App\Models\CCASenarai;
use App\Models\Employment;
use App\Models\Gender;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Cluster;
use App\Models\CCA_Name;
use App\Models\CCA_Name2;
use App\Models\KelabCcasTeachers;

class CCAController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $icNos = Auth::user()->ic_no;
    
        $ccas = CCA::select('kelab_ccas.*')
        ->orderBy('created_at', 'DESC')
        ->where(function ($query) use ($icNos) {
            $query->whereRaw("CAST(ic_no_guru AS NVARCHAR(MAX)) = ?", [$icNos])
                ->orWhereRaw("CAST(ic_no_guru1 AS NVARCHAR(MAX)) = ?", [$icNos])
                ->orWhereRaw("CAST(ic_no_guru2 AS NVARCHAR(MAX)) = ?", [$icNos])
                ->orWhereHas('teachers', function ($query) use ($icNos) {
                    $query->whereRaw("CAST(add_ic_no_guru AS NVARCHAR(MAX)) = ?", [$icNos]);
                });
        })
        ->get();
    
        return view('cca.index', compact('ccas'));
    }

     public function indexAll()
    {
        if ((Auth::user()->hasRole('ROLE_SUPERADMIN')) || Auth::user()->hasRole('ROLE_CCA_ADMIN')) {
            $ccas = CCA::select('kelab_ccas.*')->orderBy('created_at', 'DESC')->get();

            return view('cca.indexadmin', compact('ccas'));
        }

        if (Auth::user()->hasRole('ROLE_CCA_FOCAL')) {

            $icNos = Auth::user()->ic_no;

            $schools = Employment::select('emp_employment_infos.*')
                ->where('ic_no', '=', $icNos)->first();

            $id = $schools->school_id;

            $ccas = CCA::leftJoin('biodatas', 'kelab_ccas.ic_no_guru', '=', 'biodatas.ic_no')

                ->select('kelab_ccas.*', 'biodatas.name')
                ->orderBy('created_at', 'DESC')
                ->where('school_name', '=', $id)
                ->get();

            // $ccas = DB::table('kelab_ccas')
            //     ->leftJoin('biodatas', 'kelab_ccas.ic_no_guru', '=', 'biodatas.ic_no')
            //     ->leftJoin('biodatas', 'kelab_ccas.ic_no_guru1', '=', 'biodatas.ic_no')

            //     ->select('kelab_ccas.*', 'biodatas.name')
            //     ->orderBy('created_at', 'DESC')
            //     ->where('school_name', '=', $id)
            //     ->get();

            $countAll = CCA::where('school_name', '=', $id)->count();

            return view('cca.indexfocal', compact('schools', 'ccas'));
        }
    }

    public function create()
    {
        $ccas = CCA::all();

        $schools = School::pluck('label', 'id')->all();
        $clusters = Cluster::pluck('code', 'id')->all();

        return view('cca.create', compact('schools', 'ccas', 'clusters'));
    }

    public function store(Request $request)
    {
        $request->validate([]);

        $icNos = Auth::user()->ic_no;

        $CCA = new CCA;

        $CCA->school_name = $request->school_name;
        $CCA->kluster = $request->kluster;
        $CCA->year = $request->year;
        $CCA->jum_pelajar = $request->jum_pelajar;

        //details pengawas
        $CCA->nama_guru = $request->nama_guru;
        $CCA->ic_no_guru = $request->ic_no_guru;
        $CCA->guru_position = $request->guru_position;
        $CCA->jantina = $request->jantina;
        $CCA->no_tel_guru = $request->no_tel_guru;
        $CCA->email = $request->email;

        $CCA->nama_guru1 = $request->nama_guru1;
        $CCA->ic_no_guru1 = $request->ic_no_guru1;
        $CCA->guru_position1 = $request->guru_position1;
        $CCA->jantina1 = $request->jantina1;
        $CCA->no_tel_guru1 = $request->no_tel_guru1;
        $CCA->email1 = $request->email1;

        $CCA->nama_guru2 = $request->nama_guru2;
        $CCA->ic_no_guru2 = $request->ic_no_guru2;
        $CCA->guru_position2 = $request->guru_position2;
        $CCA->jantina2 = $request->jantina2;
        $CCA->no_tel_guru2 = $request->no_tel_guru2;
        $CCA->email2 = $request->email2;

        // jadual sesi cca
        $CCA->jum_lelaki_pra = $request->jum_lelaki_pra;
        $CCA->jum_perempuan_pra = $request->jum_perempuan_pra;
        $CCA->jum_lelaki_1 = $request->jum_lelaki_1;
        $CCA->jum_perempuan_1 = $request->jum_perempuan_1;
        $CCA->jum_lelaki_2 = $request->jum_lelaki_2;
        $CCA->jum_perempuan_2 = $request->jum_perempuan_2;
        $CCA->jum_lelaki_3 = $request->jum_lelaki_3;
        $CCA->jum_perempuan_3 = $request->jum_perempuan_3;
        $CCA->jum_lelaki_4 = $request->jum_lelaki_4;
        $CCA->jum_perempuan_4 = $request->jum_perempuan_4;
        $CCA->jum_lelaki_5 = $request->jum_lelaki_5;
        $CCA->jum_perempuan_5 = $request->jum_perempuan_5;
        $CCA->jum_lelaki_6 = $request->jum_lelaki_6;
        $CCA->jum_perempuan_6 = $request->jum_perempuan_6;
        $CCA->jum_lelaki_7 = $request->jum_lelaki_7;
        $CCA->jum_perempuan_7 = $request->jum_perempuan_7;
        $CCA->jum_lelaki_8 = $request->jum_lelaki_8;
        $CCA->jum_perempuan_8 = $request->jum_perempuan_8;
        $CCA->jum_lelaki_9 = $request->jum_lelaki_9;
        $CCA->jum_perempuan_9 = $request->jum_perempuan_9;
        $CCA->jum_lelaki_10 = $request->jum_lelaki_10;
        $CCA->jum_perempuan_10 = $request->jum_perempuan_10;
        $CCA->jum_lelaki_11 = $request->jum_lelaki_11;
        $CCA->jum_perempuan_11 = $request->jum_perempuan_11;
        $CCA->jum_lelaki_12 = $request->jum_lelaki_12;
        $CCA->jum_perempuan_12 = $request->jum_perempuan_12;
        $CCA->jum_lelaki_13 = $request->jum_lelaki_13;
        $CCA->jum_perempuan_13 = $request->jum_perempuan_13;

        $CCA->jum_lelaki_pra_khas = $request->jum_lelaki_pra_khas;
        $CCA->jum_perempuan_pra_khas = $request->jum_perempuan_pra_khas;
        $CCA->jum_lelaki_1_khas = $request->jum_lelaki_1_khas;
        $CCA->jum_perempuan_1_khas = $request->jum_perempuan_1_khas;
        $CCA->jum_lelaki_2_khas = $request->jum_lelaki_2_khas;
        $CCA->jum_perempuan_2_khas = $request->jum_perempuan_2_khas;
        $CCA->jum_lelaki_3_khas = $request->jum_lelaki_3_khas;
        $CCA->jum_perempuan_3_khas = $request->jum_perempuan_3_khas;
        $CCA->jum_lelaki_4_khas = $request->jum_lelaki_4_khas;
        $CCA->jum_perempuan_4_khas = $request->jum_perempuan_4_khas;
        $CCA->jum_lelaki_5_khas = $request->jum_lelaki_5_khas;
        $CCA->jum_perempuan_5_khas = $request->jum_perempuan_5_khas;
        $CCA->jum_lelaki_6_khas = $request->jum_lelaki_6_khas;
        $CCA->jum_perempuan_6_khas = $request->jum_perempuan_6_khas;
        $CCA->jum_lelaki_7_khas = $request->jum_lelaki_7_khas;
        $CCA->jum_perempuan_7_khas = $request->jum_perempuan_7_khas;
        $CCA->jum_lelaki_8_khas = $request->jum_lelaki_8_khas;
        $CCA->jum_perempuan_8_khas = $request->jum_perempuan_8_khas;
        $CCA->jum_lelaki_9_khas = $request->jum_lelaki_9_khas;
        $CCA->jum_perempuan_9_khas = $request->jum_perempuan_9_khas;
        $CCA->jum_lelaki_10_khas = $request->jum_lelaki_10_khas;
        $CCA->jum_perempuan_10_khas = $request->jum_perempuan_10_khas;
        $CCA->jum_lelaki_11_khas = $request->jum_lelaki_11_khas;
        $CCA->jum_perempuan_11_khas = $request->jum_perempuan_11_khas;
        $CCA->jum_lelaki_12_khas = $request->jum_lelaki_12_khas;
        $CCA->jum_perempuan_12_khas = $request->jum_perempuan_12_khas;
        $CCA->jum_lelaki_13_khas = $request->jum_lelaki_13_khas;
        $CCA->jum_perempuan_13_khas = $request->jum_perempuan_13_khas;

        $CCA->hari_pra = $request->hari_pra;
        $CCA->hari_tahun_1 = $request->hari_tahun_1;
        $CCA->hari_tahun_2 = $request->hari_tahun_2;
        $CCA->hari_tahun_3 = $request->hari_tahun_3;
        $CCA->hari_tahun_4 = $request->hari_tahun_4;
        $CCA->hari_tahun_5 = $request->hari_tahun_5;
        $CCA->hari_tahun_6 = $request->hari_tahun_6;
        $CCA->hari_tahun_7 = $request->hari_tahun_7;
        $CCA->hari_tahun_8 = $request->hari_tahun_8;
        $CCA->hari_tahun_9 = $request->hari_tahun_9;
        $CCA->hari_tahun_10 = $request->hari_tahun_10;
        $CCA->hari_tahun_11 = $request->hari_tahun_11;
        $CCA->hari_tahun_12 = $request->hari_tahun_12;
        $CCA->hari_tahun_13 = $request->hari_tahun_13;

        $CCA->jam_mula_pra = $request->jam_mula_pra;
        $CCA->jam_mula_tahun1 = $request->jam_mula_tahun1;
        $CCA->jam_mula_tahun2 = $request->jam_mula_tahun2;
        $CCA->jam_mula_tahun3 = $request->jam_mula_tahun3;
        $CCA->jam_mula_tahun4 = $request->jam_mula_tahun4;
        $CCA->jam_mula_tahun5 = $request->jam_mula_tahun5;
        $CCA->jam_mula_tahun6 = $request->jam_mula_tahun6;
        $CCA->jam_mula_tahun7 = $request->jam_mula_tahun7;
        $CCA->jam_mula_tahun8 = $request->jam_mula_tahun8;
        $CCA->jam_mula_tahun9 = $request->jam_mula_tahun9;
        $CCA->jam_mula_tahun10 = $request->jam_mula_tahun10;
        $CCA->jam_mula_tahun11 = $request->jam_mula_tahun11;
        $CCA->jam_mula_tahun12 = $request->jam_mula_tahun12;
        $CCA->jam_mula_tahun13 = $request->jam_mula_tahun13;

        $CCA->jam_berakhir_pra = $request->jam_berakhir_pra;
        $CCA->jam_berakhir_tahun1 = $request->jam_berakhir_tahun1;
        $CCA->jam_berakhir_tahun2 = $request->jam_berakhir_tahun2;
        $CCA->jam_berakhir_tahun3 = $request->jam_berakhir_tahun3;
        $CCA->jam_berakhir_tahun4 = $request->jam_berakhir_tahun4;
        $CCA->jam_berakhir_tahun5 = $request->jam_berakhir_tahun5;
        $CCA->jam_berakhir_tahun6 = $request->jam_berakhir_tahun6;
        $CCA->jam_berakhir_tahun7 = $request->jam_berakhir_tahun7;
        $CCA->jam_berakhir_tahun8 = $request->jam_berakhir_tahun8;
        $CCA->jam_berakhir_tahun9 = $request->jam_berakhir_tahun9;
        $CCA->jam_berakhir_tahun10 = $request->jam_berakhir_tahun10;
        $CCA->jam_berakhir_tahun11 = $request->jam_berakhir_tahun11;
        $CCA->jam_berakhir_tahun12 = $request->jam_berakhir_tahun12;
        $CCA->jam_berakhir_tahun13 = $request->jam_berakhir_tahun13;

        $CCA->created_by_ic_no = $icNos;
        $CCA->save();

        
            // Handling additional teachers
            if ($request->has('add_nama_guru')) {
                $addNamaGuru = $request->add_nama_guru;
                $addIcNoGuru = $request->add_ic_no_guru;
                $addGuruPosition = $request->add_guru_position;
                $addJantina = $request->add_jantina;
                $addNoTelGuru = $request->add_no_tel_guru;
                $addEmail = $request->add_email;

                // Get current timestamp
                $now = now();

                // Loop through each additional teacher and insert their data
                foreach ($addNamaGuru as $index => $nama) {
                    $data = [
                        'kelab_cca_id' => $CCA->id, // Link the additional teacher to the current CCA record
                        'add_nama_guru' => $nama,
                        'add_ic_no_guru' => $addIcNoGuru[$index],
                        'add_guru_position' => $addGuruPosition[$index],
                        'add_jantina' => $addJantina[$index],
                        'add_no_tel_guru' => $addNoTelGuru[$index],
                        'add_email' => $addEmail[$index],
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];

                    // Insert into the 'kelab_ccas_teachers_add' table
                    DB::table('kelab_ccas_teachers_add')->insert($data);
                }
}

        return redirect()->route('cca.cca.indexAll')
            ->with('success_message', 'New CCA record was successfully added!');
    }

     public function edit($id)
    {
        $ccas = CCA::all()
            ->where('id', '=', $id);

        $schools = School::pluck('label', 'id')->all();
        $clusters = Cluster::pluck('code', 'id')->all();

        $cca_names = CCA_Name::pluck('label', 'id')->all();

        $cca_names_2 = CCA_Name2::pluck('label', 'id')->all();

        // untuk relate kan between db kelab_ccas dan cca_senarais
        $cca_senarais = CCASenarai::where('kelab_cca_id', $id)
            // ->orderBy('tahun', 'ASC')
            ->get();

         $teachers = KelabCcasTeachers::where('kelab_cca_id', $id)->get();

        return view('cca.edit', compact('ccas', 'schools', 'clusters','cca_names', 'cca_senarais', 'cca_names_2', 'teachers'));
    }

    public function editadmin($id)
    {
        $ccas = CCA::all()
            ->where('id', '=', $id);

        $schools = School::pluck('label', 'id')->all();

        $clusters = Cluster::pluck('code', 'id')->all();

        $cca_names = CCA_Name::pluck('label', 'id')->all();

        $cca_names_2 = CCA_Name2::pluck('label', 'id')->all();

        // untuk relate kan between db kelab_ccas dan cca_senarais
        $cca_senarais = CCASenarai::where('kelab_cca_id', $id)
            // ->orderBy('tahun', 'ASC')
            ->get();

        $teachers = KelabCcasTeachers::where('kelab_cca_id', $id)->get();

        return view('cca.editadmin', compact('ccas', 'schools', 'clusters', 'cca_senarais', 'cca_names', 'cca_names_2','teachers'));
    }

    public function editfocal($id)
    {
        $ccas = CCA::all()
            ->where('id', '=', $id);

        $schools = School::pluck('label', 'id')->all();
        $clusters = Cluster::pluck('code', 'id')->all();

        $cca_names = CCA_Name::pluck('label', 'id')->all();

        // untuk relate kan between db kelab_ccas dan cca_senarais
        $cca_senarais = CCASenarai::select('cca_senarais.*')
            ->orderBy('created_at', 'DESC')
            ->where([
                ['kelab_cca_id', '=', $id]
            ])
            ->get();

        return view('cca.editfocal', compact('ccas', 'schools', 'clusters', 'cca_senarais', 'cca_names'));
    }

    public function update(Request $request)
    {
        $request->validate([]);

        $now = Carbon::now();

        $icNos = Auth::user()->ic_no;

        $CCA =  CCA::select('kelab_ccas.*')
            ->where('id', $request->id)
            ->update([

                'kluster'         =>      $request->kluster,
                'year'         =>      $request->year,
                'jum_pelajar'         =>      $request->jum_pelajar,

                // guru pengawas details
                'nama_guru' => $request->nama_guru,
                'ic_no_guru' => $request->ic_no_guru,
                'guru_position' => $request->guru_position,
                'jantina'         =>      $request->jantina,
                'no_tel_guru'         =>      $request->no_tel_guru,
                'nama_guru1' => $request->nama_guru1,
                'ic_no_guru1' => $request->ic_no_guru1,
                'guru_position1' => $request->guru_position1,
                'jantina1'         =>      $request->jantina1,
                'no_tel_guru1'         =>      $request->no_tel_guru1,
                'nama_guru2' => $request->nama_guru2,
                'ic_no_guru2' => $request->ic_no_guru2,
                'guru_position2' => $request->guru_position2,
                'jantina2'         =>      $request->jantina2,
                'no_tel_guru2'         =>      $request->no_tel_guru2,
                'email2' => $request->email2,
                'email1' => $request->email1,
                'email' => $request->email,

                'jum_lelaki_pra'         =>      $request->jum_lelaki_pra,
                'jum_perempuan_pra'      =>      $request->jum_perempuan_pra,
                'jum_lelaki_pra_khas'    =>      $request->jum_lelaki_pra_khas,
                'jum_perempuan_pra_khas' =>      $request->jum_perempuan_pra_khas,


                'jum_lelaki_1'           =>      $request->jum_lelaki_1,
                'jum_perempuan_1'        =>      $request->jum_perempuan_1,
                'jum_lelaki_1_khas'      =>      $request->jum_lelaki_1_khas,
                'jum_perempuan_1_khas'   =>      $request->jum_perempuan_1_khas,

                'jum_lelaki_2'           =>      $request->jum_lelaki_2,
                'jum_perempuan_2'        =>      $request->jum_perempuan_2,
                'jum_lelaki_2_khas'      =>      $request->jum_lelaki_2_khas,
                'jum_perempuan_2_khas'   =>      $request->jum_perempuan_2_khas,

                'jum_lelaki_3'           =>      $request->jum_lelaki_3,
                'jum_perempuan_3'        =>      $request->jum_perempuan_3,
                'jum_lelaki_3_khas'      =>      $request->jum_lelaki_3_khas,
                'jum_perempuan_3_khas'   =>      $request->jum_perempuan_3_khas,

                'jum_lelaki_4'           =>      $request->jum_lelaki_4,
                'jum_perempuan_4'        =>      $request->jum_perempuan_4,
                'jum_lelaki_4_khas'      =>      $request->jum_lelaki_4_khas,
                'jum_perempuan_4_khas'   =>      $request->jum_perempuan_4_khas,

                'jum_lelaki_5'           =>      $request->jum_lelaki_5,
                'jum_perempuan_5'        =>      $request->jum_perempuan_5,
                'jum_lelaki_5_khas'      =>      $request->jum_lelaki_5_khas,
                'jum_perempuan_5_khas'   =>      $request->jum_perempuan_5_khas,

                'jum_lelaki_6'           =>      $request->jum_lelaki_6,
                'jum_perempuan_6'        =>      $request->jum_perempuan_6,
                'jum_lelaki_6_khas'      =>      $request->jum_lelaki_6_khas,
                'jum_perempuan_6_khas'   =>      $request->jum_perempuan_6_khas,

                'jum_lelaki_7'           =>      $request->jum_lelaki_7,
                'jum_perempuan_7'        =>      $request->jum_perempuan_7,
                'jum_lelaki_7_khas'      =>      $request->jum_lelaki_7_khas,
                'jum_perempuan_7_khas'   =>      $request->jum_perempuan_7_khas,

                'jum_lelaki_8'           =>      $request->jum_lelaki_8,
                'jum_perempuan_8'        =>      $request->jum_perempuan_8,
                'jum_lelaki_8_khas'      =>      $request->jum_lelaki_8_khas,
                'jum_perempuan_8_khas'   =>      $request->jum_perempuan_8_khas,

                'jum_lelaki_9'           =>      $request->jum_lelaki_9,
                'jum_perempuan_9'        =>      $request->jum_perempuan_9,
                'jum_lelaki_9_khas'      =>      $request->jum_lelaki_9_khas,
                'jum_perempuan_9_khas'   =>      $request->jum_perempuan_9_khas,

                'jum_lelaki_10'          =>      $request->jum_lelaki_10,
                'jum_perempuan_10'       =>      $request->jum_perempuan_10,
                'jum_lelaki_10_khas'     =>      $request->jum_lelaki_10_khas,
                'jum_perempuan_10_khas'  =>      $request->jum_perempuan_10_khas,

                'jum_lelaki_11'          =>      $request->jum_lelaki_11,
                'jum_perempuan_11'       =>      $request->jum_perempuan_11,
                'jum_lelaki_11_khas'     =>      $request->jum_lelaki_11_khas,
                'jum_perempuan_11_khas'  =>      $request->jum_perempuan_11_khas,

                'jum_lelaki_12'          =>      $request->jum_lelaki_12,
                'jum_perempuan_12'       =>      $request->jum_perempuan_12,
                'jum_lelaki_12_khas'     =>      $request->jum_lelaki_12_khas,
                'jum_perempuan_12_khas'  =>      $request->jum_perempuan_12_khas,

                'jum_lelaki_13'          =>      $request->jum_lelaki_13,
                'jum_perempuan_13'       =>      $request->jum_perempuan_13,
                'jum_lelaki_13_khas'     =>      $request->jum_lelaki_13_khas,
                'jum_perempuan_13_khas'  =>      $request->jum_perempuan_13_khas,

                'hari_pra' => $request->hari_pra,
                'hari_tahun_1' => $request->hari_tahun_1,
                'hari_tahun_2' => $request->hari_tahun_2,
                'hari_tahun_3' => $request->hari_tahun_3,
                'hari_tahun_4' => $request->hari_tahun_4,
                'hari_tahun_5' => $request->hari_tahun_5,
                'hari_tahun_6' => $request->hari_tahun_6,
                'hari_tahun_7' => $request->hari_tahun_7,
                'hari_tahun_8' => $request->hari_tahun_8,
                'hari_tahun_9' => $request->hari_tahun_9,
                'hari_tahun_10' => $request->hari_tahun_10,
                'hari_tahun_11' => $request->hari_tahun_11,
                'hari_tahun_12' => $request->hari_tahun_12,
                'hari_tahun_13' => $request->hari_tahun_13,

                'jam_mula_pra' => $request->jam_mula_pra,
                'jam_mula_tahun1' => $request->jam_mula_tahun1,
                'jam_mula_tahun2' => $request->jam_mula_tahun2,
                'jam_mula_tahun3' => $request->jam_mula_tahun3,
                'jam_mula_tahun4' => $request->jam_mula_tahun4,
                'jam_mula_tahun5' => $request->jam_mula_tahun5,
                'jam_mula_tahun6' => $request->jam_mula_tahun6,
                'jam_mula_tahun7' => $request->jam_mula_tahun7,
                'jam_mula_tahun8' => $request->jam_mula_tahun8,
                'jam_mula_tahun9' => $request->jam_mula_tahun9,
                'jam_mula_tahun10' => $request->jam_mula_tahun10,
                'jam_mula_tahun11' => $request->jam_mula_tahun11,
                'jam_mula_tahun12' => $request->jam_mula_tahun12,
                'jam_mula_tahun13' => $request->jam_mula_tahun13,

                'jam_berakhir_pra' => $request->jam_berakhir_pra,
                'jam_berakhir_tahun1' => $request->jam_berakhir_tahun1,
                'jam_berakhir_tahun2' => $request->jam_berakhir_tahun2,
                'jam_berakhir_tahun3' => $request->jam_berakhir_tahun3,
                'jam_berakhir_tahun4' => $request->jam_berakhir_tahun4,
                'jam_berakhir_tahun5' => $request->jam_berakhir_tahun5,
                'jam_berakhir_tahun6' => $request->jam_berakhir_tahun6,
                'jam_berakhir_tahun7' => $request->jam_berakhir_tahun7,
                'jam_berakhir_tahun8' => $request->jam_berakhir_tahun8,
                'jam_berakhir_tahun9' => $request->jam_berakhir_tahun9,
                'jam_berakhir_tahun10' => $request->jam_berakhir_tahun10,
                'jam_berakhir_tahun11' => $request->jam_berakhir_tahun11,
                'jam_berakhir_tahun12' => $request->jam_berakhir_tahun12,
                'jam_berakhir_tahun13' => $request->jam_berakhir_tahun13,

                'updated_at' => $now
            ]);

        $id = $request->id;
        $kelab_cca_id = $request->kelab_cca_id;
        $nama_cca = $request->nama_cca;

        $nama_cca_khusus = $request->nama_cca_khusus;
        $komponen = $request->komponen;
        $kaitan = $request->kaitan;
        $tahun = $request->tahun;
        $jantina_stat = $request->jantina_stat;
        $jumlah_stat = $request->jumlah_stat;
        $cca_senarai_ids = $request->cca_senarai_id; // Holds the existing IDs

        // dd($request->all());

        if (!empty($nama_cca)) {
            foreach ($nama_cca as $index => $nama) {
                /*
                if($index == 96){
                    dd($nama_cca);
                }*/

                $data = [
                    'kelab_cca_id' => $kelab_cca_id,
                    'nama_cca' => $nama_cca[$index],
                    'nama_cca_khusus' => $nama_cca_khusus[$index],
                    'tahun' => $tahun[$index],
                    'jantina_stat' => $jantina_stat[$index],
                    'jumlah_stat' => $jumlah_stat[$index],
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
    
                if (!empty($cca_senarai_ids[$index])) {
                    // Update existing record if ID exists
                    CCASenarai::where('id', $cca_senarai_ids[$index])
                        ->update($data);
                } else {
                    // Create a new record if ID doesn't exist
                    CCASenarai::create($data);
                }
            }
        }

    

        // if (!empty($nama_cca)) {
        //     foreach ($nama_cca as $index => $nama) {
        //         $data_1 = [
        //             'kelab_cca_id' => $kelab_cca_id,
        //             'nama_cca' => $nama_cca[$index],
        //             'nama_cca_khusus' => $nama_cca_khusus[$index],
        //             'tahun' => $tahun[$index],
        //             'jantina_stat' => $jantina_stat[$index],
        //             'jumlah_stat' => $jumlah_stat[$index],
        //             'created_at' => $now,
        //         ];

        //         // Find existing record or create a new one
        //         CCASenarai::updateOrCreate(
        //             [
        //                 'kelab_cca_id' => $kelab_cca_id,
        //                 'nama_cca' => $nama_cca[$index],
        //                 'nama_cca_khusus' => $nama_cca_khusus[$index],
        //                 'tahun' => $tahun[$index],
        //                 'created_at' => $now,
        //                 'updated_at' => $now,
        //             ],
        //             $data_1
        //         );
        //     }
        // }

        return redirect()->route('cca.cca.index')
            ->with('success_message', 'CCA record was successfully updated!');
    }

    public function show(Request $request, $id)
    {
        $ccas = CCA::all()->where('id', '=', $id)->first();
        $ccas = CCA::all()->where('id', '=', $id);

        // untuk relate kan between db kelab_ccas dan cca_senarais
        $cca_senarais = CCASenarai::where('kelab_cca_id', $id)
            ->orderBy('tahun', 'ASC')
            ->get();

        return view('cca.show', compact('ccas', 'cca_senarais'));
    }

    public function dashboard(Request $request, $id)
    {
        $ccas = CCA::all()->where('id', '=', $id)->first();
        $ccas = CCA::all()->where('id', '=', $id);

        $cca_senarais = CCASenarai::select('cca_senarais.*')
            ->orderBy('created_at', 'DESC')
            ->where([
                ['kelab_cca_id', '=', $id]
            ])
            ->get();

         $jumlahLelaki = CCA::select('kelab_ccas.*')->where([['id', '=', $id]])
        ->sum(\DB::raw(
            'ISNULL(jum_lelaki_pra,0)+ ISNULL(jum_lelaki_1,0) + ISNULL(jum_lelaki_2,0) + ISNULL(jum_lelaki_3,0)
                + ISNULL(jum_lelaki_4,0) +  ISNULL(jum_lelaki_5,0) + ISNULL(jum_lelaki_6,0)
                 + ISNULL(jum_lelaki_7,0) +  ISNULL(jum_lelaki_8,0) + ISNULL(jum_lelaki_9,0)
                  + ISNULL(jum_lelaki_10,0) +  ISNULL(jum_lelaki_11,0) + ISNULL(jum_lelaki_12,0)  + ISNULL(jum_lelaki_13,0) '));


        $jumlahPerempuan = CCA::select('kelab_ccas.*')->where([['id', '=', $id]])

        ->sum(\DB::raw(
            'ISNULL(jum_perempuan_pra,0)+ ISNULL(jum_perempuan_1,0) + ISNULL(jum_perempuan_2,0)
            + ISNULL(jum_perempuan_3,0) + ISNULL(jum_perempuan_4,0)
             + ISNULL(jum_perempuan_5,0) + ISNULL(jum_perempuan_6,0)
                + ISNULL(jum_perempuan_7,0) + ISNULL(jum_perempuan_8,0)
             + ISNULL(jum_perempuan_9,0) + ISNULL(jum_perempuan_10,0)
                + ISNULL(jum_perempuan_11,0) + ISNULL(jum_perempuan_12,0)
             + ISNULL(jum_perempuan_13,0)


                '));

                
                $jumlahlelakiberkeperluankhas = CCA::select('kelab_ccas.*')->where([['id', '=', $id]])
                ->sum(\DB::raw(
                    'ISNULL(jum_lelaki_pra_khas, 0) + ISNULL(jum_lelaki_1_khas, 0) + ISNULL(jum_lelaki_2_khas, 0) +
                     ISNULL(jum_lelaki_3_khas, 0) + ISNULL(jum_lelaki_4_khas, 0) + ISNULL(jum_lelaki_5_khas, 0) +
                     ISNULL(jum_lelaki_6_khas, 0) + ISNULL(jum_lelaki_7_khas, 0) + ISNULL(jum_lelaki_8_khas, 0) +
                     ISNULL(jum_lelaki_9_khas, 0) + ISNULL(jum_lelaki_10_khas, 0) + ISNULL(jum_lelaki_11_khas, 0) +
                     ISNULL(jum_lelaki_12_khas, 0) + ISNULL(jum_lelaki_13_khas, 0)'
                ));
            
                            $jumlahperempuanberkeperluankhas = CCA::select('kelab_ccas.*')->where([['id', '=', $id]])
                ->sum(\DB::raw(
                    'ISNULL(jum_perempuan_pra_khas, 0) + ISNULL(jum_perempuan_1_khas, 0) + ISNULL(jum_perempuan_2_khas, 0) +
                     ISNULL(jum_perempuan_3_khas, 0) + ISNULL(jum_perempuan_4_khas, 0) + ISNULL(jum_perempuan_5_khas, 0) +
                     ISNULL(jum_perempuan_6_khas, 0) + ISNULL(jum_perempuan_7_khas, 0) + ISNULL(jum_perempuan_8_khas, 0) +
                     ISNULL(jum_perempuan_9_khas, 0) + ISNULL(jum_perempuan_10_khas, 0) + ISNULL(jum_perempuan_11_khas, 0) +
                     ISNULL(jum_perempuan_12_khas, 0) + ISNULL(jum_perempuan_13_khas, 0)'
                ));


                $jumlah = $jumlahLelaki + $jumlahPerempuan;

//for chart komponen by gender:
	$pecahan = CCASenarai::leftJoin('cca_names', 'cca_senarais.nama_cca', '=', 'cca_names.id')
 		->select('cca_senarais.*', 'cca_names.komponen', 'jantina_stat', 'jumlah_stat')
 		->where('kelab_cca_id', '=', $id)
 		->get();

	$groupedResults = $pecahan->groupBy('komponen');

	$komponenCounts = [];

	foreach ($groupedResults as $komponen => $results) {
 	$jantinaStatCount = $results->sum('jantina_stat');
 	$jumlahStatCount = $results->sum('jumlah_stat');

 	$komponenCounts[$komponen] = [
     	'jantina_stat' => $jantinaStatCount,
     	'jumlah_stat' => $jumlahStatCount,
 	];
	}

	// Access the counts for each type of data
	$fizikalCount = isset($komponenCounts['Fizikal']) ? $komponenCounts['Fizikal'] : ['jantina_stat' => 0, 'jumlah_stat' => 0];
	$perkhidmatanCount = isset($komponenCounts['Perkhidmatan']) ? $komponenCounts['Perkhidmatan'] : ['jantina_stat' => 0, 'jumlah_stat' => 0];
	$kerohanianCount = isset($komponenCounts['Kerohanian']) ? $komponenCounts['Kerohanian'] : ['jantina_stat' => 0, 'jumlah_stat' => 0];
	$kreativitiCount = isset($komponenCounts['Kreativiti']) ? $komponenCounts['Kreativiti'] : ['jantina_stat' => 0, 'jumlah_stat' => 0];

 // Query data and join the relevant tables
 $pecahanNew = CCASenarai::leftJoin('cca_names_2', 'cca_senarais.nama_cca', '=', 'cca_names_2.id')
 ->select('cca_senarais.*', 'cca_names_2.komponen', 'jantina_stat', 'jumlah_stat')
 ->where('kelab_cca_id', '=', $id)
 ->where(function($query) {
     // Apply LIKE filter for each komponen dynamically
     $query->where('cca_names_2.komponen', 'LIKE', '%fizikal%')
           ->orWhere('cca_names_2.komponen', 'LIKE', '%perkhidmatan%')
           ->orWhere('cca_names_2.komponen', 'LIKE', '%kerohanian%')
           ->orWhere('cca_names_2.komponen', 'LIKE', '%kreativiti%');
 })
 ->get();

// Group results by komponen, normalized to lowercase
$groupedResultsNew = $pecahanNew->groupBy(function($item) {
 return strtolower(trim($item->komponen));  // Normalize to lowercase and trim spaces
});

// Initialize an empty array for storing counts
$komponenCountsNew = [];

// Loop through each group and calculate the counts
foreach ($groupedResultsNew as $komponenNew => $resultsNew) {
 $jantinaStatCount = $resultsNew->sum('jantina_stat');
 $jumlahStatCount = $resultsNew->sum('jumlah_stat');

 // Store the calculated counts in the komponenCounts array
 $komponenCountsNew[strtolower($komponenNew)] = [
     'jantina_stat' => $jantinaStatCount,
     'jumlah_stat' => $jumlahStatCount,
 ];
}

// Now, handle case-insensitive access to component counts
$fizikalCountNew = isset($komponenCountsNew[strtolower('Fizikal')]) ? $komponenCountsNew[strtolower('Fizikal')] : ['jantina_stat' => 0, 'jumlah_stat' => 0];
$perkhidmatanCountNew = isset($komponenCountsNew[strtolower('Perkhidmatan')]) ? $komponenCountsNew[strtolower('Perkhidmatan')] : ['jantina_stat' => 0, 'jumlah_stat' => 0];
$kerohanianCountNew = isset($komponenCountsNew[strtolower('Kerohanian')]) ? $komponenCountsNew[strtolower('Kerohanian')] : ['jantina_stat' => 0, 'jumlah_stat' => 0];
$kreativitiCountNew = isset($komponenCountsNew[strtolower('Kreativiti')]) ? $komponenCountsNew[strtolower('Kreativiti')] : ['jantina_stat' => 0, 'jumlah_stat' => 0];







        $Total6L = CCA::select('kelab_ccas.*')->where([['id', '=', $id]])->sum(\DB::raw('jum_lelaki_6'));
        $Total6P = CCA::select('kelab_ccas.*')->where([['id', '=', $id]])->sum(\DB::raw('jum_perempuan_6'));

        $Total5L = CCA::select('kelab_ccas.*')->where([['id', '=', $id]])->sum(\DB::raw('jum_lelaki_5'));
        $Total5P = CCA::select('kelab_ccas.*')->where([['id', '=', $id]])->sum(\DB::raw('jum_perempuan_5'));

        $Total4L = CCA::select('kelab_ccas.*')->where([['id', '=', $id]])->sum(\DB::raw('jum_lelaki_4'));
        $Total4P = CCA::select('kelab_ccas.*')->where([['id', '=', $id]])->sum(\DB::raw('jum_perempuan_4'));

        $Total3L = CCA::select('kelab_ccas.*')->where([['id', '=', $id]])->sum(\DB::raw('jum_lelaki_3'));
        $Total3P = CCA::select('kelab_ccas.*')->where([['id', '=', $id]])->sum(\DB::raw('jum_perempuan_3'));

        $Total2L = CCA::select('kelab_ccas.*')->where([['id', '=', $id]])->sum(\DB::raw('jum_lelaki_2'));
        $Total2P = CCA::select('kelab_ccas.*')->where([['id', '=', $id]])->sum(\DB::raw('jum_perempuan_2'));

        $Total1L = CCA::select('kelab_ccas.*')->where([['id', '=', $id]])->sum(\DB::raw('jum_lelaki_1'));
        $Total1P = CCA::select('kelab_ccas.*')->where([['id', '=', $id]])->sum(\DB::raw('jum_perempuan_1'));

        $TotalPraL = CCA::select('kelab_ccas.*')->where([['id', '=', $id]])->sum(\DB::raw('jum_lelaki_pra'));
        $TotalPraP = CCA::select('kelab_ccas.*')->where([['id', '=', $id]])->sum(\DB::raw('jum_perempuan_pra'));

        $Total7L = CCA::select('kelab_ccas.*')->where([['id', '=', $id]])->sum(\DB::raw('jum_lelaki_7'));
        $Total7P = CCA::select('kelab_ccas.*')->where([['id', '=', $id]])->sum(\DB::raw('jum_perempuan_7'));

        $Total8L = CCA::select('kelab_ccas.*')->where([['id', '=', $id]])->sum(\DB::raw('jum_lelaki_8'));
        $Total8P = CCA::select('kelab_ccas.*')->where([['id', '=', $id]])->sum(\DB::raw('jum_perempuan_8'));

        $Total9L = CCA::select('kelab_ccas.*')->where([['id', '=', $id]])->sum(\DB::raw('jum_lelaki_9'));
        $Total9P = CCA::select('kelab_ccas.*')->where([['id', '=', $id]])->sum(\DB::raw('jum_perempuan_9'));

        $Total10L = CCA::select('kelab_ccas.*')->where([['id', '=', $id]])->sum(\DB::raw('jum_lelaki_10'));
        $Total10P = CCA::select('kelab_ccas.*')->where([['id', '=', $id]])->sum(\DB::raw('jum_perempuan_10'));

        $Total11L = CCA::select('kelab_ccas.*')->where([['id', '=', $id]])->sum(\DB::raw('jum_lelaki_11'));
        $Total11P = CCA::select('kelab_ccas.*')->where([['id', '=', $id]])->sum(\DB::raw('jum_perempuan_11'));

        $Total12L = CCA::select('kelab_ccas.*')->where([['id', '=', $id]])->sum(\DB::raw('jum_lelaki_12'));
        $Total12P = CCA::select('kelab_ccas.*')->where([['id', '=', $id]])->sum(\DB::raw('jum_perempuan_12'));

        $Total13L = CCA::select('kelab_ccas.*')->where([['id', '=', $id]])->sum(\DB::raw('jum_lelaki_13'));
        $Total13P = CCA::select('kelab_ccas.*')->where([['id', '=', $id]])->sum(\DB::raw('jum_perempuan_13'));

        $checklistcca = CCASenarai::leftJoin('cca_names', 'cca_senarais.nama_cca', '=', 'cca_names.id')
            ->select('cca_senarais.*', 'cca_names.komponen')
            ->where('kelab_cca_id', '=', $id)
            ->get();

        $Kerohanian = 0;
        $Fizikal = 0;
        $Kreativiti = 0;
        $Perkhidmatan = 0;


        foreach ($checklistcca as $item) {
            if ($item->komponen === 'Kerohanian') {
            $Kerohanian++;
        }if ($item->komponen === 'Fizikal') {
            $Fizikal++;
        }if ($item->komponen === 'Kreativiti') {
            $Kreativiti++;
        }if ($item->komponen === 'Perkhidmatan') {
            $Perkhidmatan++;
        }
    };

    // for year above 2023

    $checklistccanew = CCASenarai::leftJoin('cca_names_2', 'cca_senarais.nama_cca', '=', 'cca_names_2.id')
    ->select('cca_senarais.*', 'cca_names_2.komponen')
    ->where('kelab_cca_id', '=', $id)
    ->get();

    $KerohanianNew = 0;
    $FizikalNew = 0;
    $KreativitiNew = 0;
    $PerkhidmatanNew = 0;


    foreach ($checklistccanew as $itemnew) {
     if(stripos($itemnew->komponen,'Kerohanian') !==false) {
        $KerohanianNew++;
    }if (stripos($itemnew->komponen ,'Fizikal') !==false) {
        $FizikalNew++;
    }if (stripos($itemnew->komponen ,'Kreativiti') !==false) {
        $KreativitiNew++;
    }if (stripos($itemnew->komponen , 'Perkhidmatan') !==false){
        $PerkhidmatanNew++;
    }
    };

        $FizikalLelaki = CCASenarai::select('cca_senarais.*')->where([['kelab_cca_id', '=', $id]])->where('komponen', 'Fizikal')->sum('jantina_stat');
        $FizikalPerempuan = CCASenarai::select('cca_senarais.*')->where([['kelab_cca_id', '=', $id]])->where('komponen', 'Fizikal')->sum('jumlah_stat');

        $KerohanianLelaki = CCASenarai::select('cca_senarais.*')->where([['kelab_cca_id', '=', $id]])->where('komponen', 'Kerohanian')->sum('jantina_stat');
        $KerohanianPerempuan = CCASenarai::select('cca_senarais.*')->where([['kelab_cca_id', '=', $id]])->where('komponen', 'Kerohanian')->sum('jumlah_stat');

        $KreativitiLelaki = CCASenarai::select('cca_senarais.*')->where([['kelab_cca_id', '=', $id]])->where('komponen', 'Kreativiti')->sum('jantina_stat');
        $KreativitiPerempuan = CCASenarai::select('cca_senarais.*')->where([['kelab_cca_id', '=', $id]])->where('komponen', 'Kreativiti')->sum('jumlah_stat');

        $PerkhidmatanLelaki = CCASenarai::select('cca_senarais.*')->where([['kelab_cca_id', '=', $id]])->where('komponen', 'Perkhidmatan')->sum('jantina_stat');
        $PerkhidmatanPerempuan = CCASenarai::select('cca_senarais.*')->where([['kelab_cca_id', '=', $id]])->where('komponen', 'Perkhidmatan')->sum('jumlah_stat');

        $FizikalPra = CCASenarai::select('cca_senarais.*')->where([['kelab_cca_id', '=', $id]])->where('komponen', 'Fizikal')->where('tahun', 'Pra')->sum('jumlah_stat');
        $FizikalTahun1 = CCASenarai::select('cca_senarais.*')->where([['kelab_cca_id', '=', $id]])->where('komponen', 'Fizikal')->where('tahun', 'Tahun 1')->sum('jumlah_stat');
        $FizikalTahun2 = CCASenarai::select('cca_senarais.*')->where([['kelab_cca_id', '=', $id]])->where('komponen', 'Fizikal')->where('tahun', 'Tahun 2')->sum('jumlah_stat');
        $FizikalTahun3 = CCASenarai::select('cca_senarais.*')->where([['kelab_cca_id', '=', $id]])->where('komponen', 'Fizikal')->where('tahun', 'Tahun 3')->sum('jumlah_stat');
        $FizikalTahun4 = CCASenarai::select('cca_senarais.*')->where([['kelab_cca_id', '=', $id]])->where('komponen', 'Fizikal')->where('tahun', 'Tahun 4')->sum('jumlah_stat');
        $FizikalTahun5 = CCASenarai::select('cca_senarais.*')->where([['kelab_cca_id', '=', $id]])->where('komponen', 'Fizikal')->where('tahun', 'Tahun 5')->sum('jumlah_stat');
        $FizikalTahun6 = CCASenarai::select('cca_senarais.*')->where([['kelab_cca_id', '=', $id]])->where('komponen', 'Fizikal')->where('tahun', 'Tahun 6')->sum('jumlah_stat');

        $KerohanianPra = CCASenarai::select('cca_senarais.*')->where([['kelab_cca_id', '=', $id]])->where('komponen', 'Kerohanian')->where('tahun', 'Pra')->sum('jumlah_stat');
        $KerohanianTahun1 = CCASenarai::select('cca_senarais.*')->where([['kelab_cca_id', '=', $id]])->where('komponen', 'Kerohanian')->where('tahun', 'Tahun 1')->sum('jumlah_stat');
        $KerohanianTahun2 = CCASenarai::select('cca_senarais.*')->where([['kelab_cca_id', '=', $id]])->where('komponen', 'Kerohanian')->where('tahun', 'Tahun 2')->sum('jumlah_stat');
        $KerohanianTahun3 = CCASenarai::select('cca_senarais.*')->where([['kelab_cca_id', '=', $id]])->where('komponen', 'Kerohanian')->where('tahun', 'Tahun 3')->sum('jumlah_stat');
        $KerohanianTahun4 = CCASenarai::select('cca_senarais.*')->where([['kelab_cca_id', '=', $id]])->where('komponen', 'Kerohanian')->where('tahun', 'Tahun 4')->sum('jumlah_stat');
        $KerohanianTahun5 = CCASenarai::select('cca_senarais.*')->where([['kelab_cca_id', '=', $id]])->where('komponen', 'Kerohanian')->where('tahun', 'Tahun 5')->sum('jumlah_stat');
        $KerohanianTahun6 = CCASenarai::select('cca_senarais.*')->where([['kelab_cca_id', '=', $id]])->where('komponen', 'Kerohanian')->where('tahun', 'Tahun 6')->sum('jumlah_stat');

        $KreativitiPra = CCASenarai::select('cca_senarais.*')->where([['kelab_cca_id', '=', $id]])->where('komponen', 'Kreativiti')->where('tahun', 'Pra')->sum('jumlah_stat');
        $KreativitiTahun1 = CCASenarai::select('cca_senarais.*')->where([['kelab_cca_id', '=', $id]])->where('komponen', 'Kreativiti')->where('tahun', 'Tahun 1')->sum('jumlah_stat');
        $KreativitiTahun2 = CCASenarai::select('cca_senarais.*')->where([['kelab_cca_id', '=', $id]])->where('komponen', 'Kreativiti')->where('tahun', 'Tahun 2')->sum('jumlah_stat');
        $KreativitiTahun3 = CCASenarai::select('cca_senarais.*')->where([['kelab_cca_id', '=', $id]])->where('komponen', 'Kreativiti')->where('tahun', 'Tahun 3')->sum('jumlah_stat');
        $KreativitiTahun4 = CCASenarai::select('cca_senarais.*')->where([['kelab_cca_id', '=', $id]])->where('komponen', 'Kreativiti')->where('tahun', 'Tahun 4')->sum('jumlah_stat');
        $KreativitiTahun5 = CCASenarai::select('cca_senarais.*')->where([['kelab_cca_id', '=', $id]])->where('komponen', 'Kreativiti')->where('tahun', 'Tahun 5')->sum('jumlah_stat');
        $KreativitiTahun6 = CCASenarai::select('cca_senarais.*')->where([['kelab_cca_id', '=', $id]])->where('komponen', 'Kreativiti')->where('tahun', 'Tahun 6')->sum('jumlah_stat');

        $PerkhidmatanPra = CCASenarai::select('cca_senarais.*')->where([['kelab_cca_id', '=', $id]])->where('komponen', 'Perkhidmatan')->where('tahun', 'Pra')->sum('jumlah_stat');
        $PerkhidmatanTahun1 = CCASenarai::select('cca_senarais.*')->where([['kelab_cca_id', '=', $id]])->where('komponen', 'Perkhidmatan')->where('tahun', 'Tahun 1')->sum('jumlah_stat');
        $PerkhidmatanTahun2 = CCASenarai::select('cca_senarais.*')->where([['kelab_cca_id', '=', $id]])->where('komponen', 'Perkhidmatan')->where('tahun', 'Tahun 2')->sum('jumlah_stat');
        $PerkhidmatanTahun3 = CCASenarai::select('cca_senarais.*')->where([['kelab_cca_id', '=', $id]])->where('komponen', 'Perkhidmatan')->where('tahun', 'Tahun 3')->sum('jumlah_stat');
        $PerkhidmatanTahun4 = CCASenarai::select('cca_senarais.*')->where([['kelab_cca_id', '=', $id]])->where('komponen', 'Perkhidmatan')->where('tahun', 'Tahun 4')->sum('jumlah_stat');
        $PerkhidmatanTahun5 = CCASenarai::select('cca_senarais.*')->where([['kelab_cca_id', '=', $id]])->where('komponen', 'Perkhidmatan')->where('tahun', 'Tahun 5')->sum('jumlah_stat');
        $PerkhidmatanTahun6 = CCASenarai::select('cca_senarais.*')->where([['kelab_cca_id', '=', $id]])->where('komponen', 'Perkhidmatan')->where('tahun', 'Tahun 6')->sum('jumlah_stat');


        return view('cca.dashboard', compact('ccas', 'cca_senarais', 'jumlah', 'jumlahLelaki', 'jumlahPerempuan',
                    'Total6L', 'Total6P', 'Total5L', 'Total5P', 'Total4L', 'Total4P',
                    'Total3L', 'Total3P', 'Total2L', 'Total2P', 'Total1L', 'Total1P', 'TotalPraL', 'TotalPraP',
                    'Total7L', 'Total7P', 'Total8L', 'Total8P', 'Total9L', 'Total9P', 'Total10L', 'Total10P', 'Total11L', 'Total11P', 'Total12L', 'Total12P', 'Total13L', 'Total13P',
                     'checklistcca',
                    'Fizikal', 'Kerohanian', 'Kreativiti', 'Perkhidmatan',
                    'checklistccanew',
                    'FizikalNew', 'KerohanianNew', 'KreativitiNew', 'PerkhidmatanNew',
                    'FizikalLelaki', 'FizikalPerempuan', 'KerohanianLelaki', 'KerohanianPerempuan',
                    'KreativitiLelaki', 'KreativitiPerempuan', 'PerkhidmatanLelaki', 'PerkhidmatanPerempuan',
                    'FizikalPra', 'FizikalTahun1', 'FizikalTahun2', 'FizikalTahun3', 'FizikalTahun4', 'FizikalTahun5', 'FizikalTahun6',
                    'KerohanianPra', 'KerohanianTahun1', 'KerohanianTahun2', 'KerohanianTahun3', 'KerohanianTahun4', 'KerohanianTahun5', 'KerohanianTahun6',
                    'KreativitiPra', 'KreativitiTahun1', 'KreativitiTahun2', 'KreativitiTahun3', 'KreativitiTahun4', 'KreativitiTahun5', 'KreativitiTahun6',
                    'PerkhidmatanPra', 'PerkhidmatanTahun1', 'PerkhidmatanTahun2', 'PerkhidmatanTahun3', 'PerkhidmatanTahun4', 'PerkhidmatanTahun5', 'PerkhidmatanTahun6',
		'groupedResults', 'pecahan','komponenCounts', 'fizikalCount', 'perkhidmatanCount', 'kerohanianCount', 'kreativitiCount',
        'groupedResultsNew', 'pecahanNew','komponenCountsNew', 'fizikalCountNew', 'perkhidmatanCountNew', 'kerohanianCountNew', 'kreativitiCountNew',
          'jumlahlelakiberkeperluankhas' , 'jumlahperempuanberkeperluankhas'

                ));
    }

    public function updatefocal(Request $request)
    {
        $request->validate([]);

        $now = Carbon::now();

        $icNos = Auth::user()->ic_no;

        $CCA =  CCA::select('kelab_ccas.*')
            ->where('id', $request->id)
            ->update([


                'kluster'         =>      $request->kluster,
                'year'         =>      $request->year,
                'jum_pelajar'         =>      $request->jum_pelajar,

                // guru pengawas details
                'nama_guru' => $request->nama_guru,
                'ic_no_guru' => $request->ic_no_guru,
                'guru_position' => $request->guru_position,
                'jantina'         =>      $request->jantina,
                'no_tel_guru'         =>      $request->no_tel_guru,
                'nama_guru1' => $request->nama_guru1,
                'ic_no_guru1' => $request->ic_no_guru1,
                'guru_position1' => $request->guru_position1,
                'jantina1'         =>      $request->jantina1,
                'no_tel_guru1'         =>      $request->no_tel_guru1,
                'nama_guru2' => $request->nama_guru2,
                'ic_no_guru2' => $request->ic_no_guru2,
                'guru_position2' => $request->guru_position2,
                'jantina2'         =>      $request->jantina2,
                'no_tel_guru2'         =>      $request->no_tel_guru2,
                'email2' => $request->email2,
                'email1' => $request->email1,
                'email' => $request->email,

                'jum_lelaki_pra'         =>      $request->jum_lelaki_pra,
                'jum_perempuan_pra'         =>      $request->jum_perempuan_pra,
                'jum_lelaki_1' => $request->jum_lelaki_1,
                'jum_perempuan_1'         =>      $request->jum_perempuan_1,
                'jum_lelaki_2' => $request->jum_lelaki_2,
                'jum_perempuan_2'         =>      $request->jum_perempuan_2,
                'jum_lelaki_3' => $request->jum_lelaki_3,
                'jum_perempuan_3'         =>      $request->jum_perempuan_3,
                'jum_lelaki_4' => $request->jum_lelaki_4,
                'jum_perempuan_4'         =>      $request->jum_perempuan_4,
                'jum_lelaki_5' => $request->jum_lelaki_5,
                'jum_perempuan_5'         =>      $request->jum_perempuan_5,
                'jum_lelaki_6' => $request->jum_lelaki_6,
                'jum_perempuan_6'         =>      $request->jum_perempuan_6,
                'jum_lelaki_7' => $request->jum_lelaki_7,
                'jum_perempuan_7'         =>      $request->jum_perempuan_7,
                'jum_lelaki_8' => $request->jum_lelaki_8,
                'jum_perempuan_8'         =>      $request->jum_perempuan_8,
                'jum_lelaki_9' => $request->jum_lelaki_9,
                'jum_perempuan_9'         =>      $request->jum_perempuan_9,
                'jum_lelaki_10' => $request->jum_lelaki_10,
                'jum_perempuan_10'         =>      $request->jum_perempuan_10,
                'jum_lelaki_11' => $request->jum_lelaki_11,
                'jum_perempuan_11'         =>      $request->jum_perempuan_11,
                'jum_lelaki_12' => $request->jum_lelaki_12,
                'jum_perempuan_12'         =>      $request->jum_perempuan_12,
                'jum_lelaki_13' => $request->jum_lelaki_13,
                'jum_perempuan_13'         =>      $request->jum_perempuan_13,

                'hari_pra' => $request->hari_pra,
                'hari_tahun_1' => $request->hari_tahun_1,
                'hari_tahun_2' => $request->hari_tahun_2,
                'hari_tahun_3' => $request->hari_tahun_3,
                'hari_tahun_4' => $request->hari_tahun_4,
                'hari_tahun_5' => $request->hari_tahun_5,
                'hari_tahun_6' => $request->hari_tahun_6,
                'hari_tahun_7' => $request->hari_tahun_7,
                'hari_tahun_8' => $request->hari_tahun_8,
                'hari_tahun_9' => $request->hari_tahun_9,
                'hari_tahun_10' => $request->hari_tahun_10,
                'hari_tahun_11' => $request->hari_tahun_11,
                'hari_tahun_12' => $request->hari_tahun_12,
                'hari_tahun_13' => $request->hari_tahun_13,

                'jam_mula_pra' => $request->jam_mula_pra,
                'jam_mula_tahun1' => $request->jam_mula_tahun1,
                'jam_mula_tahun2' => $request->jam_mula_tahun2,
                'jam_mula_tahun3' => $request->jam_mula_tahun3,
                'jam_mula_tahun4' => $request->jam_mula_tahun4,
                'jam_mula_tahun5' => $request->jam_mula_tahun5,
                'jam_mula_tahun6' => $request->jam_mula_tahun6,
                'jam_mula_tahun7' => $request->jam_mula_tahun7,
                'jam_mula_tahun8' => $request->jam_mula_tahun8,
                'jam_mula_tahun9' => $request->jam_mula_tahun9,
                'jam_mula_tahun10' => $request->jam_mula_tahun10,
                'jam_mula_tahun11' => $request->jam_mula_tahun11,
                'jam_mula_tahun12' => $request->jam_mula_tahun12,
                'jam_mula_tahun13' => $request->jam_mula_tahun13,

                'jam_berakhir_pra' => $request->jam_berakhir_pra,
                'jam_berakhir_tahun1' => $request->jam_berakhir_tahun1,
                'jam_berakhir_tahun2' => $request->jam_berakhir_tahun2,
                'jam_berakhir_tahun3' => $request->jam_berakhir_tahun3,
                'jam_berakhir_tahun4' => $request->jam_berakhir_tahun4,
                'jam_berakhir_tahun5' => $request->jam_berakhir_tahun5,
                'jam_berakhir_tahun6' => $request->jam_berakhir_tahun6,
                'jam_berakhir_tahun7' => $request->jam_berakhir_tahun7,
                'jam_berakhir_tahun8' => $request->jam_berakhir_tahun8,
                'jam_berakhir_tahun9' => $request->jam_berakhir_tahun9,
                'jam_berakhir_tahun10' => $request->jam_berakhir_tahun10,
                'jam_berakhir_tahun11' => $request->jam_berakhir_tahun11,
                'jam_berakhir_tahun12' => $request->jam_berakhir_tahun12,
                'jam_berakhir_tahun13' => $request->jam_berakhir_tahun13,

                'updated_at' => $now
            ]);

        $id = $request->id;
        $nama_cca = $request->nama_cca;
        $komponen = $request->komponen;
        $kaitan = $request->kaitan;
        $tahun = $request->tahun;
        $jantina_stat = $request->jantina_stat;
        $jumlah_stat = $request->jumlah_stat;

        if ($request->nama_cca != '' || $request->komponen != '' || $request->kaitan != '' || $request->class != '' || $request->jantina_stat != '' || $request->jumlah_stat != '') {

            for ($count_1 = 0; $count_1 < count($nama_cca); $count_1++) {

                $data_1 = array(

                    'kelab_cca_id' => $id,
                    'nama_cca' => $nama_cca[$count_1],
                    // 'komponen' => $komponen[$count_1],
                    // 'kaitan' => $kaitan[$count_1],
                    'tahun' => $tahun[$count_1],
                    'jantina_stat' => $jantina_stat[$count_1],
                    'jumlah_stat' => $jumlah_stat[$count_1],
                    'created_at' => $now,
                    'updated_at' => $now,

                );

                $insert_data_1[] = $data_1;
            }

            // Save 'kadarkenaikangaji' data
            CCASenarai::insert($insert_data_1);
        }

        return redirect()->route('cca.cca.indexAll')
            ->with('success_message', 'CCA record was successfully updated!');
    }

    public function updateadmin(Request $request)
    {
        $request->validate([]);

        $now = Carbon::now();

        $icNos = Auth::user()->ic_no;

        $CCA =  CCA::select('kelab_ccas.*')
            ->where('id', $request->id)
            ->update([
                'kluster'         =>      $request->kluster,
                'year'         =>      $request->year,
                'jum_pelajar'         =>      $request->jum_pelajar,

                // guru pengawas details
                'nama_guru' => $request->nama_guru,
                'ic_no_guru' => $request->ic_no_guru,
                'guru_position' => $request->guru_position,
                'jantina'         =>      $request->jantina,
                'no_tel_guru'         =>      $request->no_tel_guru,
                'nama_guru1' => $request->nama_guru1,
                'ic_no_guru1' => $request->ic_no_guru1,
                'guru_position1' => $request->guru_position1,
                'jantina1'         =>      $request->jantina1,
                'no_tel_guru1'         =>      $request->no_tel_guru1,
                'nama_guru2' => $request->nama_guru2,
                'ic_no_guru2' => $request->ic_no_guru2,
                'guru_position2' => $request->guru_position2,
                'jantina2'         =>      $request->jantina2,
                'no_tel_guru2'         =>      $request->no_tel_guru2,
                'email2' => $request->email2,
                'email1' => $request->email1,
                'email' => $request->email,


                'jum_lelaki_pra'         =>      $request->jum_lelaki_pra,
                'jum_perempuan_pra'      =>      $request->jum_perempuan_pra,
                'jum_lelaki_pra_khas'    =>      $request->jum_lelaki_pra_khas,
                'jum_perempuan_pra_khas' =>      $request->jum_perempuan_pra_khas,


                'jum_lelaki_1'           =>      $request->jum_lelaki_1,
                'jum_perempuan_1'        =>      $request->jum_perempuan_1,
                'jum_lelaki_1_khas'      =>      $request->jum_lelaki_1_khas,
                'jum_perempuan_1_khas'   =>      $request->jum_perempuan_1_khas,

                'jum_lelaki_2'           =>      $request->jum_lelaki_2,
                'jum_perempuan_2'        =>      $request->jum_perempuan_2,
                'jum_lelaki_2_khas'      =>      $request->jum_lelaki_2_khas,
                'jum_perempuan_2_khas'   =>      $request->jum_perempuan_2_khas,

                'jum_lelaki_3'           =>      $request->jum_lelaki_3,
                'jum_perempuan_3'        =>      $request->jum_perempuan_3,
                'jum_lelaki_3_khas'      =>      $request->jum_lelaki_3_khas,
                'jum_perempuan_3_khas'   =>      $request->jum_perempuan_3_khas,

                'jum_lelaki_4'           =>      $request->jum_lelaki_4,
                'jum_perempuan_4'        =>      $request->jum_perempuan_4,
                'jum_lelaki_4_khas'      =>      $request->jum_lelaki_4_khas,
                'jum_perempuan_4_khas'   =>      $request->jum_perempuan_4_khas,

                'jum_lelaki_5'           =>      $request->jum_lelaki_5,
                'jum_perempuan_5'        =>      $request->jum_perempuan_5,
                'jum_lelaki_5_khas'      =>      $request->jum_lelaki_5_khas,
                'jum_perempuan_5_khas'   =>      $request->jum_perempuan_5_khas,

                'jum_lelaki_6'           =>      $request->jum_lelaki_6,
                'jum_perempuan_6'        =>      $request->jum_perempuan_6,
                'jum_lelaki_6_khas'      =>      $request->jum_lelaki_6_khas,
                'jum_perempuan_6_khas'   =>      $request->jum_perempuan_6_khas,

                'jum_lelaki_7'           =>      $request->jum_lelaki_7,
                'jum_perempuan_7'        =>      $request->jum_perempuan_7,
                'jum_lelaki_7_khas'      =>      $request->jum_lelaki_7_khas,
                'jum_perempuan_7_khas'   =>      $request->jum_perempuan_7_khas,

                'jum_lelaki_8'           =>      $request->jum_lelaki_8,
                'jum_perempuan_8'        =>      $request->jum_perempuan_8,
                'jum_lelaki_8_khas'      =>      $request->jum_lelaki_8_khas,
                'jum_perempuan_8_khas'   =>      $request->jum_perempuan_8_khas,

                'jum_lelaki_9'           =>      $request->jum_lelaki_9,
                'jum_perempuan_9'        =>      $request->jum_perempuan_9,
                'jum_lelaki_9_khas'      =>      $request->jum_lelaki_9_khas,
                'jum_perempuan_9_khas'   =>      $request->jum_perempuan_9_khas,

                'jum_lelaki_10'          =>      $request->jum_lelaki_10,
                'jum_perempuan_10'       =>      $request->jum_perempuan_10,
                'jum_lelaki_10_khas'     =>      $request->jum_lelaki_10_khas,
                'jum_perempuan_10_khas'  =>      $request->jum_perempuan_10_khas,

                'jum_lelaki_11'          =>      $request->jum_lelaki_11,
                'jum_perempuan_11'       =>      $request->jum_perempuan_11,
                'jum_lelaki_11_khas'     =>      $request->jum_lelaki_11_khas,
                'jum_perempuan_11_khas'  =>      $request->jum_perempuan_11_khas,

                'jum_lelaki_12'          =>      $request->jum_lelaki_12,
                'jum_perempuan_12'       =>      $request->jum_perempuan_12,
                'jum_lelaki_12_khas'     =>      $request->jum_lelaki_12_khas,
                'jum_perempuan_12_khas'  =>      $request->jum_perempuan_12_khas,

                'jum_lelaki_13'          =>      $request->jum_lelaki_13,
                'jum_perempuan_13'       =>      $request->jum_perempuan_13,
                'jum_lelaki_13_khas'     =>      $request->jum_lelaki_13_khas,
                'jum_perempuan_13_khas'  =>      $request->jum_perempuan_13_khas,

                'hari_pra' => $request->hari_pra,
                'hari_tahun_1' => $request->hari_tahun_1,
                'hari_tahun_2' => $request->hari_tahun_2,
                'hari_tahun_3' => $request->hari_tahun_3,
                'hari_tahun_4' => $request->hari_tahun_4,
                'hari_tahun_5' => $request->hari_tahun_5,
                'hari_tahun_6' => $request->hari_tahun_6,
                'hari_tahun_7' => $request->hari_tahun_7,
                'hari_tahun_8' => $request->hari_tahun_8,
                'hari_tahun_9' => $request->hari_tahun_9,
                'hari_tahun_10' => $request->hari_tahun_10,
                'hari_tahun_11' => $request->hari_tahun_11,
                'hari_tahun_12' => $request->hari_tahun_12,
                'hari_tahun_13' => $request->hari_tahun_13,

                'jam_mula_pra' => $request->jam_mula_pra,
                'jam_mula_tahun1' => $request->jam_mula_tahun1,
                'jam_mula_tahun2' => $request->jam_mula_tahun2,
                'jam_mula_tahun3' => $request->jam_mula_tahun3,
                'jam_mula_tahun4' => $request->jam_mula_tahun4,
                'jam_mula_tahun5' => $request->jam_mula_tahun5,
                'jam_mula_tahun6' => $request->jam_mula_tahun6,
                'jam_mula_tahun7' => $request->jam_mula_tahun7,
                'jam_mula_tahun8' => $request->jam_mula_tahun8,
                'jam_mula_tahun9' => $request->jam_mula_tahun9,
                'jam_mula_tahun10' => $request->jam_mula_tahun10,
                'jam_mula_tahun11' => $request->jam_mula_tahun11,
                'jam_mula_tahun12' => $request->jam_mula_tahun12,
                'jam_mula_tahun13' => $request->jam_mula_tahun13,

                'jam_berakhir_pra' => $request->jam_berakhir_pra,
                'jam_berakhir_tahun1' => $request->jam_berakhir_tahun1,
                'jam_berakhir_tahun2' => $request->jam_berakhir_tahun2,
                'jam_berakhir_tahun3' => $request->jam_berakhir_tahun3,
                'jam_berakhir_tahun4' => $request->jam_berakhir_tahun4,
                'jam_berakhir_tahun5' => $request->jam_berakhir_tahun5,
                'jam_berakhir_tahun6' => $request->jam_berakhir_tahun6,
                'jam_berakhir_tahun7' => $request->jam_berakhir_tahun7,
                'jam_berakhir_tahun8' => $request->jam_berakhir_tahun8,
                'jam_berakhir_tahun9' => $request->jam_berakhir_tahun9,
                'jam_berakhir_tahun10' => $request->jam_berakhir_tahun10,
                'jam_berakhir_tahun11' => $request->jam_berakhir_tahun11,
                'jam_berakhir_tahun12' => $request->jam_berakhir_tahun12,
                'jam_berakhir_tahun13' => $request->jam_berakhir_tahun13,

                'updated_at' => $now
            ]);

        $id = $request->id;
        $kelab_cca_id = $request->kelab_cca_id;
        $nama_cca = $request->nama_cca ?? [];
        $nama_cca_khusus = $request->nama_cca_khusus ?? [];
        $komponen = $request->komponen ?? [];
        $kaitan = $request->kaitan ?? [];
        $tahun = $request->tahun ?? [];
        $jantina_stat = $request->jantina_stat ?? [];
        $jumlah_stat = $request->jumlah_stat ?? [];
        $cca_senarai_ids = $request->cca_senarai_id ?? []; // Holds the existing IDs

        if (!empty($nama_cca)) {
            foreach ($nama_cca as $index => $nama) {
                $data = [
                    'kelab_cca_id' => $kelab_cca_id,
                    'nama_cca' => $nama_cca[$index] ?? null,
                    'nama_cca_khusus' => $nama_cca_khusus[$index] ?? null,
                    'tahun' => $tahun[$index] ?? null,
                    'jantina_stat' => $jantina_stat[$index] ?? null,
                    'jumlah_stat' => $jumlah_stat[$index] ?? null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
        
                if (!empty($cca_senarai_ids[$index])) {
                    CCASenarai::where('id', $cca_senarai_ids[$index])->update($data);
                } else {
                    CCASenarai::create($data);
                }
            }
        }
        

      // Ensure all arrays have the same length
    // $count = count($nama_cca);
    // if ($count !== count($nama_cca_khusus) || $count !== count($tahun) || $count !== count($jantina_stat) || $count !== count($jumlah_stat) || $count !== count($cca_senarai_ids)) {
    //     return back()->with('error_message', 'Arrays do not have the same length!');
    // }

    // $now = now(); // Get the current time

    // if (!empty($nama_cca)) {
    //     foreach ($nama_cca as $index => $nama) {
    //         // Ensure all necessary values are set for this index
    //         if (!isset($nama_cca[$index], $nama_cca_khusus[$index], $tahun[$index], $jantina_stat[$index], $jumlah_stat[$index])) {
    //             continue; // Skip if any value is missing
    //         }

    //         // Prepare data for creating or updating the record
    //         $data = [
    //             'kelab_cca_id' => $kelab_cca_id,
    //             'nama_cca' => $nama_cca[$index],
    //             'nama_cca_khusus' => $nama_cca_khusus[$index],
    //             'tahun' => $tahun[$index],
    //             'jantina_stat' => $jantina_stat[$index],
    //             'jumlah_stat' => $jumlah_stat[$index],
    //             'created_at' => $now,
    //             'updated_at' => $now, // Ensure 'updated_at' is set
    //         ];

    //         // Check if the existing record ID is set and update, else create new
    //         if (isset($cca_senarai_ids[$index]) && !empty($cca_senarai_ids[$index])) {
    //             // Update the record if ID exists
    //             CCASenarai::where('id', $cca_senarai_ids[$index])->update($data);
    //         } else {
    //             // Create a new record if ID doesn't exist
    //             CCASenarai::create($data);
    //         }
    //     }
    // }
    

        // if (isset($nama_cca[$index], $nama_cca_khusus[$index], $tahun[$index], $jantina_stat[$index], $jumlah_stat[$index])) {
        //     $data = [
        //         'kelab_cca_id' => $kelab_cca_id,
        //         'nama_cca' => $nama_cca[$index],
        //         'nama_cca_khusus' => $nama_cca_khusus[$index],
        //         'tahun' => $tahun[$index],
        //         'jantina_stat' => $jantina_stat[$index],
        //         'jumlah_stat' => $jumlah_stat[$index],
        //         'created_at' => $now,
        //         'updated_at' => $now,
        //     ];
            
        //     if (!empty($cca_senarai_ids[$index])) {
        //         CCASenarai::where('id', $cca_senarai_ids[$index])->update($data);
        //     } else {
        //         CCASenarai::create($data);
        //     }
        // }
        


        //  if (!empty($nama_cca)) {
        //     foreach ($nama_cca as $index => $nama) {
        //         $data = [
        //             'kelab_cca_id' => $kelab_cca_id,
        //             'nama_cca' => $nama_cca[$index],
        //             'nama_cca_khusus' => $nama_cca_khusus[$index],
        //             'tahun' => $tahun[$index],
        //             'jantina_stat' => $jantina_stat[$index],
        //             'jumlah_stat' => $jumlah_stat[$index],
        //             'created_at' => $now,
        //             'updated_at' => $now,
        //         ];
    
        //         if (!empty($cca_senarai_ids[$index])) {
        //             // Update existing record if ID exists
        //             CCASenarai::where('id', $cca_senarai_ids[$index])
        //                 ->update($data);
        //         } else {
        //             // Create a new record if ID doesn't exist
        //             CCASenarai::create($data);
        //         }
        //     }
        // }

        
          // Handling additional teachers
    if ($request->has('add_nama_guru')) {
        $kelab_cca_id_add = $request->kelab_cca_id_add;
        $addNamaGuru = $request->add_nama_guru;
        $addIcNoGuru = $request->add_ic_no_guru;
        $addGuruPosition = $request->add_guru_position;
        $addJantina = $request->add_jantina;
        $addNoTelGuru = $request->add_no_tel_guru;
        $addEmail = $request->add_email;

        foreach ($addNamaGuru as $index => $nama) {
            // Prepare the data for each additional teacher
            $data = [
                'kelab_cca_id' => $kelab_cca_id_add,
                'add_nama_guru' => $nama,
                'add_ic_no_guru' => $addIcNoGuru[$index],
                'add_guru_position' => $addGuruPosition[$index],
                'add_jantina' => $addJantina[$index],
                'add_no_tel_guru' => $addNoTelGuru[$index],
                'add_email' => $addEmail[$index],
                'created_at' => $now,
                'updated_at' => $now,
            ];

            // Insert each teacher into the kelab_ccas_teachers_add table
            DB::table('kelab_ccas_teachers_add')->insert($data);
        }
    }


        return back()
            ->with('success_message', 'CCA record was successfully updated!');
        // return redirect()->route('cca.cca.indexAll')
        //     ->with('success_message', 'CCA record was successfully updated!');
    }

    public function destroy($id)
    {
        try {

            $ccas = CCA::where('id', $id)->delete();

            return redirect()->route('cca.cca.index')
                ->with('success_message', 'CCA was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

       public function destroyadmin($id)
    {
        try {


            $ccas = CCA::where('id', $id)->delete();

            return redirect()->route('cca.cca.indexAll')
                ->with('success_message', 'CCA was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function destroyfocal($id)
    {
        try {


            $ccas = CCA::where('id', $id)->delete();

            return redirect()->route('cca.cca.indexfocal')
                ->with('success_message', 'CCA was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function destroysenarai($id)
    {
        try {


            $cca_senarai = CCASenarai::where('id', $id)->delete();

             return redirect()->back()
            ->with('success_message', 'CCA was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

     public function destroysenaraiadmin($id)
    {
        try {


            $cca_senarais = CCASenarai::where('id', $id)->delete();

            return redirect()->back()
                ->with('success_message', 'CCA was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function destroysenaraifocal($id)
    {
        try {


            $cca_senarais = CCASenarai::where('id', $id)->delete();

             return redirect()->back()
                ->with('success_message', 'CCA was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }


    public function storetambahkelab(Request $request)
    {

        foreach ($request->moreFields as $key => $value) {
            CCA_Name::create($value);
            // ->where('id', $value->code)
            // ->update([
            //     'code'         =>      $value->code,
            // ]);
        }

        return redirect()->route('cca.cca.tambahkelab')
            ->with('success_message', 'New Data record was successfully added!');
    }

    public function tambahkelab()
    {

        // declare for tambahkelabs
        $ccanames = CCA_Name::select('cca_names.*')
        ->get();

       // $id = $schools->school_id;
        return view('cca.tambahkelab', compact("ccanames"));

    }

    public function destroytambahkelab($id)
    {
        try {

            $ccanames = CCA_Name::where('id', $id)->delete();

            return redirect()->route('dispatchs.dis.indextindakan')
                ->with('success_message', 'Data was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }
}
