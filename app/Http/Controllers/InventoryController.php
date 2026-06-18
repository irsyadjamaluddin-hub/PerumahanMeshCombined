<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Employment;
use App\Models\Biodata;
use App\Models\School;
use App\Models\Inventory;
use App\Models\InventoryBKK;
use App\Models\StudentInv;
use App\Models\CCA;
use Carbon\Carbon;


class InventoryController extends Controller
{
    public function create()
    {

        $icNos = Auth::user()->ic_no;
        
        $employments = Employment::all()
                        ->where('ic_no', '=', $icNos);

        $biodatas = Biodata::all()
        ->where('ic_no', '=', $icNos);

        $sekolah= School::pluck('label','id')->all();


        return view('inventory.create', compact('employments','biodatas','sekolah'));
    }

    public function createunit()
    {

        $icNos = Auth::user()->ic_no;
        
        $employments = Employment::all()
                        ->where('ic_no', '=', $icNos);

        $biodatas = Biodata::all()
        ->where('ic_no', '=', $icNos);

        $sekolah= School::pluck('label','id')->all();


        return view('inventory.createunit', compact('employments','biodatas','sekolah'));
    }

   public function sendNotification(Request $request, $inventory_id)
{
    $request->validate([
        'message' => 'required|string',
    ]);

    $inventory = Inventory::findOrFail($inventory_id);

    // Check if send_email checkbox is ticked
    if ($request->has('send_email') && $request->input('send_email') == '1') {
        $messageBody = $request->input('message');
        \Mail::to($inventory->emel)->send(new \App\Mail\InventoryNotificationMail($inventory, $messageBody));
        $msg = 'Notification and email sent successfully!';
    } else {
        $msg = 'Notification saved but email was not sent.';
    }

    return redirect()->route('cddinventory.notify', $inventory_id)
                     ->with('success_message', $msg);
}



    public function store(Request $request)
{

    $icNos = Auth::user()->ic_no;
    $now = Carbon::now();
    
    $inventory = new Inventory;

        $inventory->nama_sch = $request->nama_sch;
        $inventory->kluster = $request->kluster;
        $inventory->no_tel = $request->no_tel;
        $inventory->ic_no = $icNos;
        $inventory->nama = $request->nama;
        $inventory->emel = $request->emel;
        $inventory->kgp_nama = $request->kgp_nama;
        $inventory->kgp_ic_no = $request->kgp_ic_no;
        $inventory->kgp_emel = $request->kgp_emel;
        $inventory->created_at = $now;

    $inventory->save();

    // method to take previous ID
    $data1 = Inventory::select('inventory.*')
    ->orderBy('created_at', 'DESC')
    ->first();

    $data2 = $data1->id;



    $matapelajaran = $request->matapelajaran;
    $judulbahan = $request->judulbahan;


    if (!empty($request->matapelajaran) && is_array($matapelajaran) || !empty($request->judulbahan) && is_array($judulbahan)) {

        $insert_data_1 = []; // Initialize the array before the loop
    
        for ($count_1 = 0; $count_1 < count($matapelajaran); $count_1++) {
    
            $data_1 = array(
                'inventory_id' => $data2, //previous ID
                'matapelajaran' => $matapelajaran[$count_1],
                'judulbahan' => $judulbahan[$count_1]
            );
    
            $insert_data_1[] = $data_1;
        }
    
        // Save 'Inventorybkk' data
        Inventorybkk::insert($insert_data_1);
    }


        return redirect()->route('inventory.index')
            ->with('success_message', 'Borang telah berjaya dihantar');
}

    public function index()
    {
    
        $icNos = Auth::user()->ic_no;

        $inventory= Inventory::select('inventory.*')
        ->orderBy('created_at', 'DESC')
        ->where([['ic_no', '=', $icNos]])
        ->orWhere('kgp_ic_no', '=', $icNos)
        ->get(); 

        return view('inventory.index', compact('inventory') );
                    
    }

    public function indexadmin()
    {
    
        $icNos = Auth::user()->ic_no;

        $inventory= Inventory::select('inventory.*')
        ->orderBy('created_at', 'DESC')
        ->where([['kgp_status', '=', 'sent' ]])
        ->get(); 

        return view('inventory.indexadmin', compact('inventory') );
                    
    }

    public function destroy($id)
    {
        try {

            $inventory = Inventory::where('id', $id)->delete();

            return Redirect::back()->with('success_message','Inventory Record was successfully deleted!');
            
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function edit($id)
    {

    
        $inventory= Inventory::all()
        ->where('id', '=', $id);

        $inventorybkk= Inventorybkk::all()
        ->where('inventory_id', '=', $id);

        return view('inventory.edit',compact('inventory','inventorybkk'));
    }

    public function editbkk($id)
    {

        $inventorynormalbkk= Inventorybkk::all()
        ->where('id', '=', $id);
    
        return view('inventory.editbbk',compact('inventorynormalbkk'));
    }

    public function editadmin($id)
    {
        
        $inventory= Inventory::all()
        ->where('id', '=', $id);

        $inventorybkk= Inventorybkk::all()
        ->where('inventory_id', '=', $id);
    
        return view('inventory.editadmin',compact('inventory','inventorybkk'));
    }

    public function datakeramaianindex()
    {
        $icNos = Auth::user()->ic_no;

        $schoolname = CCA::select('kelab_ccas.*')
            ->where('year', 2023)
            ->whereIn('school_name', [1, 2, 3, 4, 5, 6, 
        
                                        7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 
                                        24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 37, 154,
                                        
                                        36, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 
                                        54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 
                                        70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85,
                                        86, 87, 88, 89, 90, 91, 92, 93, 94, 95, 96, 97, 98, 99, 100, 101, 
                                        102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114,
                                        115, 116, 117, 118, 119, 120, 121, 122, 123, 124, 125, 126, 127, 
                                        128, 129, 130, 131, 132, 133, 134, 135, 136, 137, 138, 139, 140,
                                        141, 142, 143, 144, 145, 146, 147, 148, 149, 150, 151, 152, 153, 155])
            ->orderByRaw("CAST(school_name AS INT) ASC") // Cast to integer for sorting
            ->get();

        // Define a mapping of numerical school_name values to school names
        $schoolNameMapping = [
            1 => 'Maktab Sains PSBS',
            2 => 'Maktab Duli PMAMB',
            3 => 'PTE Belait',
            4 => 'PTE Meragang',
            5 => 'PTE Sengkurong',
            6 => 'PTE Tutong',

            7 => 'Maktab Anthony Abell Seria',
            8 => 'Maktab Sultan Omar Ali Saifuddien',
            9 => 'STPRI', 
            10 => 'SM Sultan Sharif Ali', 
            11 => 'SM Awang Semaun', 
            12 => 'SM Berakas', 
            13 => 'SM Katok', 
            14 => 'SM Lambak Kiri', 
            15 => 'SM Masin', 
            16 => 'SM Menglait', 
            17 => 'SM Muda Hashim', 
            18 => 'SM PAP Hajah Rashidah Saadatul Bolkiah', 
            19 => 'SM Pehin Dato Seri Maharaja', 
            20 => 'SM Pengiran Anak Puteri Hajah Masna', 
            21 => 'SM Pengiran Isteri Hajah Mariam',
            22 => 'SM Pengiran Jaya Negara Pengiran Haji Abu Bakar', 
            23 => 'SM Perdana Wazir', 
            24 => 'SM Raja Isteri Pengiran Anak Saleha', 
            25 => 'SM Rimba', 
            26 => 'SM Rimba II', 
            27 => 'SM Sayyidina Abu Bakar', 
            28 => 'SM Sayyidina Ali', 
            29 => 'SM Sultan Hassan Bangar, Temburong',
            30 => 'SM Sayyidina Husain', 
            31 => 'SM Sayyidina Othman', 
            32 => 'SM Sayyidina Umar Al-Khattab', 
            33 => 'SM Sufri Bolkiah', 
            34 => 'SM Sayyidina Hasan', 
            35 => 'SM Sultan Muhammad Jamalul Alam',
            154 => 'SM Tanjong Maya Tutong',
            37 => 'Sekolah Sukan',

            36 => 'Sekolah Rendah Abdul Rashid, Tanjong Maya',
            39 => 'Sekolah Rendah Ahmad Tajuddin',
            40 => 'Sekolah Rendah AHMY Katimahar',
            41 => 'Sekolah Rendah Amar Pahlawan',
            42 => 'Sekolah Rendah Amo',
            43 => 'Sekolah Rendah Anggerek Desa',
            44 => 'Sekolah Rendah Angkatan Tentera Laut',
            45 => 'Sekolah Rendah Bakiau',
            46 => 'Sekolah Rendah Batang Mitus',
            47 => 'Sekolah Rendah Batu Marang',
            48 => 'Sekolah Rendah Bebuloh',
            49 => 'Sekolah Rendah Bendahara Lama',
            50 => 'Sekolah Rendah Bendahara Sakam Bunut',
            51 => 'Sekolah Rendah Bengkurong',
            52 => 'Sekolah Rendah Benutan',
            53 => 'Sekolah Rendah Berakas Garisson',
            54 => 'Sekolah Rendah Beribi Telanai',
            55 => 'Sekolah Rendah Binturan',
            56 => 'Sekolah Rendah Birau',
            57 => 'Sekolah Rendah Bukit Panggal',
            58 => 'Sekolah Rendah Bukit Udal',
            59 => 'Sekolah Rendah Danau',
            60 => 'Sekolah Rendah Dato Basir',
            61 => 'Sekolah Rendah Dato Maharaja Setia Dian Sukang',
            62 => 'Sekolah Rendah Dato Mahawangsa Lambak',
            63 => 'Sekolah Rendah Dato Marsal',
            64 => 'Sekolah Rendah Dato Mohd Yassin',
            65 => 'Sekolah Rendah Dato Othman',
            66 => 'Sekolah Rendah Dato Pemancha Saging Ukong',
            67 => 'Sekolah Rendah Dato Ratna Haji Muhammad Jaafar',
            68 => 'Sekolah Rendah Delima Satu',
            69 => 'Sekolah Rendah Haji Mohd Jaafar Maun',
            70 => 'Sekolah Rendah Haji Mohd Salleh',
            71 => 'Sekolah Rendah Haji Tarif',
            72 => 'Sekolah Rendah Jerudong',
            73 => 'Sekolah Rendah Junjongan',
            74 => 'Sekolah Rendah Kampong Bukit',
            75 => 'Sekolah Rendah Kampong Bukit Beruang II',
            76 => 'Sekolah Rendah Kampong Mata-Mata',
            77 => 'Sekolah Rendah Kampong Menengah',
            78 => 'Sekolah Rendah Kampong Perpindahan Lambak Kanan Jalan',
            79 => 'Sekolah Rendah Kapok',
            80 => 'Sekolah Rendah Kasat',
            81 => 'Sekolah Rendah Katok A',
            82 => 'Sekolah Rendah Katok B',
            83 => 'Sekolah Rendah Keriam',
            84 => 'Sekolah Rendah Kiudang',
            85 => 'Sekolah Rendah Kuala Belait',
            86 => 'Sekolah Rendah Kupang',
            87 => 'Sekolah Rendah Labi',
            88 => 'Sekolah Rendah Labu Estate',
            89 => 'Sekolah Rendah Lambak Kanan Jalan',
            90 => 'Sekolah Rendah Lamunin',
            91 => 'Sekolah Rendah Lubok Pulau',
            92 => 'Sekolah Rendah Lumapas',
            93 => 'Sekolah Rendah Lumut',
            94 => 'Sekolah Rendah Mabohai',
            95 => 'Sekolah Rendah Masin',
            96 => 'Sekolah Rendah Melilas',
            97 => 'Sekolah Rendah Mentiri',
            98 => 'Sekolah Rendah Merangking',
            99 => 'Sekolah Rendah Muda Hashim',
            100 => 'Sekolah Rendah Muhammad Alam',
            101 => 'Sekolah Rendah Mulaut',
            102 => 'Sekolah Rendah Nakhoda Abdul Rashid Menunggol',
            103 => 'Sekolah Rendah Negalang',
            104 => 'Sekolah Rendah OKSB Kilanas',
            105 => 'Sekolah Rendah Paduka Seri Begawan SOAS',
            106 => 'Sekolah Rendah Panaga',
            107 => 'Sekolah Rendah Panchong',
            108 => 'Sekolah Rendah Panchor Murai',
            109 => 'Sekolah Rendah Panglima Barudin',
            110 => 'Sekolah Rendah Pantai Berakas',
            111 => 'Sekolah Rendah PAP Besar Sungai Kebun',
            112 => 'Sekolah Rendah Pehin Dato Jamil',
            113 => 'Sekolah Rendah Penanjong',
            114 => 'Sekolah Rendah Penapar',
            115 => 'Sekolah Rendah Pengiran Dipa Negara Pengiran Jaya Sengkarai',
            116 => 'Sekolah Rendah Pengiran Muda Mahkota',
            117 => 'Sekolah Rendah Pengiran Pekerma Setia Diraja Sahibul Bandar',
            118 => 'Sekolah Rendah Pengiran Setia Jaya Pengiran Abdul Momin',
            119 => 'Sekolah Rendah Pengkalan Batu',
            120 => 'Sekolah Rendah Pg Setia Negara Pg Mohd Yusof',
            121 => 'Sekolah Rendah Pintu Malim',
            122 => 'Sekolah Rendah PKN Bukit Beruang',
            123 => 'Sekolah Rendah Pulaie',
            124 => 'Sekolah Rendah Puni',
            125 => 'Sekolah Rendah Pusar Ulak',
            126 => 'Sekolah Rendah Putat',
            127 => 'Sekolah Rendah Raja Isteri Fatimah',
            128 => 'Sekolah Rendah Rambai',
            129 => 'Sekolah Rendah Rataie',
            130 => 'Sekolah Rendah Rimba I',
            131 => 'Sekolah Rendah Rimba II',
            132 => 'Sekolah Rendah Rimba III',
            133 => 'Sekolah Rendah S.U.A.S Muara',
            134 => 'Sekolah Rendah Saba Darat',
            135 => 'Sekolah Rendah Selangan',
            136 => 'Sekolah Rendah Selapon',
            137 => 'Sekolah Rendah Semabat',
            138 => 'Sekolah Rendah Sengkurong',
            139 => 'Sekolah Rendah Serasa',
            140 => 'Sekolah Rendah Sinaut',
            141 => 'Sekolah Rendah Subok',
            142 => 'Sekolah Rendah Sultan Abdul Bubin',
            143 => 'Sekolah Rendah Sultan Hasan Bangar',
            144 => 'Sekolah Rendah Sultan Hashim',
            145 => 'Sekolah Rendah Sungai Liang',
            146 => 'Sekolah Rendah Sungai Siamas',
            147 => 'Sekolah Rendah Sungai Tali',
            148 => 'Sekolah Rendah Sungai Teraban',
            149 => 'Sekolah Rendah Tanah Jambu',
            150 => 'Sekolah Rendah Tanjong Kindana',
            151 => 'Sekolah Rendah Tumpuan Telisai',
            152 => 'Sekolah Rendah Tungku',
            153 => 'Sekolah Rendah Tutong Kem',
            155 => 'Sekolah Rendah Orang Kaya Ali Wanika Setia Diraja Kupang',
        ];

        $studentInv = StudentInv::leftJoin('kelab_ccas', function($join) {
            // Map numerical school_name to text school_name using your mapping
            $join->on('student_inv.school_name', '=', DB::raw("CASE
                WHEN kelab_ccas.school_name = 1 THEN 'Maktab Sains PSBS'
                WHEN kelab_ccas.school_name = 2 THEN 'Maktab Duli PMAMB'
                WHEN kelab_ccas.school_name = 3 THEN 'PTE Belait'
                WHEN kelab_ccas.school_name = 4 THEN 'PTE Meragang'
                WHEN kelab_ccas.school_name = 5 THEN 'PTE Sengkurong'
                WHEN kelab_ccas.school_name = 6 THEN 'PTE Tutong'

                WHEN kelab_ccas.school_name = 7 THEN 'Maktab Anthony Abell Seria'
                WHEN kelab_ccas.school_name = 8 THEN 'Maktab Sultan Omar Ali Saifuddien'
                WHEN kelab_ccas.school_name = 9 THEN 'STPRI'
                WHEN kelab_ccas.school_name = 10 THEN 'SM Sultan Sharif Ali' 
                WHEN kelab_ccas.school_name = 11 THEN 'SM Awang Semaun'
                WHEN kelab_ccas.school_name = 12 THEN 'SM Berakas'
                WHEN kelab_ccas.school_name = 13 THEN 'SM Katok'
                WHEN kelab_ccas.school_name = 14 THEN 'SM Lambak Kiri' 
                WHEN kelab_ccas.school_name = 15 THEN 'SM Masin' 
                WHEN kelab_ccas.school_name = 16 THEN 'SM Menglait' 
                WHEN kelab_ccas.school_name = 17 THEN 'SM Muda Hashim' 
                WHEN kelab_ccas.school_name = 18 THEN 'SM PAP Hajah Rashidah Saadatul Bolkiah' 
                WHEN kelab_ccas.school_name = 19 THEN 'SM Pehin Dato Seri Maharaja' 
                WHEN kelab_ccas.school_name = 20 THEN 'SM Pengiran Anak Puteri Hajah Masna' 
                WHEN kelab_ccas.school_name = 21 THEN 'SM Pengiran Isteri Hajah Mariam'
                WHEN kelab_ccas.school_name = 22 THEN 'SM Pengiran Jaya Negara Pengiran Haji Abu Bakar' 
                WHEN kelab_ccas.school_name = 23 THEN 'SM Perdana Wazir' 
                WHEN kelab_ccas.school_name = 24 THEN 'SM Raja Isteri Pengiran Anak Saleha' 
                WHEN kelab_ccas.school_name = 25 THEN 'SM Rimba' 
                WHEN kelab_ccas.school_name = 26 THEN 'SM Rimba II' 
                WHEN kelab_ccas.school_name = 27 THEN 'SM Sayyidina Abu Bakar' 
                WHEN kelab_ccas.school_name = 28 THEN 'SM Sayyidina Ali' 
                WHEN kelab_ccas.school_name = 29 THEN 'SM Sultan Hassan Bangar Temburong'
                WHEN kelab_ccas.school_name = 30 THEN 'SM Sayyidina Husain' 
                WHEN kelab_ccas.school_name = 31 THEN 'SM Sayyidina Othman' 
                WHEN kelab_ccas.school_name = 32 THEN 'SM Sayyidina Umar Al-Khattab' 
                WHEN kelab_ccas.school_name = 33 THEN 'SM Sufri Bolkiah' 
                WHEN kelab_ccas.school_name = 34 THEN 'SM Sayyidina Hasan' 
                WHEN kelab_ccas.school_name = 35 THEN 'SM Sultan Muhammad Jamalul Alam'
                WHEN kelab_ccas.school_name = 154 THEN 'SM Tanjong Maya Tutong'
                WHEN kelab_ccas.school_name = 37 THEN 'Sekolah Sukan'

                WHEN kelab_ccas.school_name = 36 THEN 'Sekolah Rendah Abdul Rashid, Tanjong Maya'
                WHEN kelab_ccas.school_name = 39 THEN 'Sekolah Rendah Ahmad Tajuddin'
                WHEN kelab_ccas.school_name = 40 THEN 'Sekolah Rendah AHMY Katimahar'
                WHEN kelab_ccas.school_name = 41 THEN 'Sekolah Rendah Amar Pahlawan'
                WHEN kelab_ccas.school_name = 42 THEN 'Sekolah Rendah Amo'
                WHEN kelab_ccas.school_name = 43 THEN 'Sekolah Rendah Anggerek Desa'
                WHEN kelab_ccas.school_name = 44 THEN 'Sekolah Rendah Angkatan Tentera Laut'
                WHEN kelab_ccas.school_name = 45 THEN 'Sekolah Rendah Bakiau'
                WHEN kelab_ccas.school_name = 46 THEN 'Sekolah Rendah Batang Mitus'
                WHEN kelab_ccas.school_name = 47 THEN 'Sekolah Rendah Batu Marang'
                WHEN kelab_ccas.school_name = 48 THEN 'Sekolah Rendah Bebuloh'
                WHEN kelab_ccas.school_name = 49 THEN 'Sekolah Rendah Bendahara Lama'
                WHEN kelab_ccas.school_name = 50 THEN 'Sekolah Rendah Bendahara Sakam Bunut'
                WHEN kelab_ccas.school_name = 51 THEN 'Sekolah Rendah Bengkurong'
                WHEN kelab_ccas.school_name = 52 THEN 'Sekolah Rendah Benutan'
                WHEN kelab_ccas.school_name = 53 THEN 'Sekolah Rendah Berakas Garisson'
                WHEN kelab_ccas.school_name = 54 THEN 'Sekolah Rendah Beribi Telanai'
                WHEN kelab_ccas.school_name = 55 THEN 'Sekolah Rendah Binturan'
                WHEN kelab_ccas.school_name = 56 THEN 'Sekolah Rendah Birau'
                WHEN kelab_ccas.school_name = 57 THEN 'Sekolah Rendah Bukit Panggal'
                WHEN kelab_ccas.school_name = 58 THEN 'Sekolah Rendah Bukit Udal'
                WHEN kelab_ccas.school_name = 59 THEN 'Sekolah Rendah Danau'
                WHEN kelab_ccas.school_name = 60 THEN 'Sekolah Rendah Dato Basir'
                WHEN kelab_ccas.school_name = 61 THEN 'Sekolah Rendah Dato Maharaja Setia Dian Sukang'
                WHEN kelab_ccas.school_name = 62 THEN 'Sekolah Rendah Dato Mahawangsa Lambak'
                WHEN kelab_ccas.school_name = 63 THEN 'Sekolah Rendah Dato Marsal'
                WHEN kelab_ccas.school_name = 64 THEN 'Sekolah Rendah Dato Mohd Yassin'
                WHEN kelab_ccas.school_name = 65 THEN 'Sekolah Rendah Dato Othman'
                WHEN kelab_ccas.school_name = 66 THEN 'Sekolah Rendah Dato Pemancha Saging Ukong'
                WHEN kelab_ccas.school_name = 67 THEN 'Sekolah Rendah Dato Ratna Haji Muhammad Jaafar'
                WHEN kelab_ccas.school_name = 68 THEN 'Sekolah Rendah Delima Satu'
                WHEN kelab_ccas.school_name = 69 THEN 'Sekolah Rendah Haji Mohd Jaafar Maun'
                WHEN kelab_ccas.school_name = 70 THEN 'Sekolah Rendah Haji Mohd Salleh'
                WHEN kelab_ccas.school_name = 71 THEN 'Sekolah Rendah Haji Tarif'
                WHEN kelab_ccas.school_name = 72 THEN 'Sekolah Rendah Jerudong'
                WHEN kelab_ccas.school_name = 73 THEN 'Sekolah Rendah Junjongan'
                WHEN kelab_ccas.school_name = 74 THEN 'Sekolah Rendah Kampong Bukit'
                WHEN kelab_ccas.school_name = 75 THEN 'Sekolah Rendah Kampong Bukit Beruang II'
                WHEN kelab_ccas.school_name = 76 THEN 'Sekolah Rendah Kampong Mata-Mata'
                WHEN kelab_ccas.school_name = 77 THEN 'Sekolah Rendah Kampong Menengah'
                WHEN kelab_ccas.school_name = 78 THEN 'Sekolah Rendah Kampong Perpindahan Lambak Kanan Jalan'
                WHEN kelab_ccas.school_name = 79 THEN 'Sekolah Rendah Kapok'
                WHEN kelab_ccas.school_name = 80 THEN 'Sekolah Rendah Kasat'
                WHEN kelab_ccas.school_name = 81 THEN 'Sekolah Rendah Katok A'
                WHEN kelab_ccas.school_name = 82 THEN 'Sekolah Rendah Katok B'
                WHEN kelab_ccas.school_name = 83 THEN 'Sekolah Rendah Keriam'
                WHEN kelab_ccas.school_name = 84 THEN 'Sekolah Rendah Kiudang'
                WHEN kelab_ccas.school_name = 85 THEN 'Sekolah Rendah Kuala Belait'
                WHEN kelab_ccas.school_name = 86 THEN 'Sekolah Rendah Kupang'
                WHEN kelab_ccas.school_name = 87 THEN 'Sekolah Rendah Labi'
                WHEN kelab_ccas.school_name = 88 THEN 'Sekolah Rendah Labu Estate'
                WHEN kelab_ccas.school_name = 89 THEN 'Sekolah Rendah Lambak Kanan Jalan'
                WHEN kelab_ccas.school_name = 90 THEN 'Sekolah Rendah Lamunin'
                WHEN kelab_ccas.school_name = 91 THEN 'Sekolah Rendah Lubok Pulau'
                WHEN kelab_ccas.school_name = 92 THEN 'Sekolah Rendah Lumapas'
                WHEN kelab_ccas.school_name = 93 THEN 'Sekolah Rendah Lumut'
                WHEN kelab_ccas.school_name = 94 THEN 'Sekolah Rendah Mabohai'
                WHEN kelab_ccas.school_name = 95 THEN 'Sekolah Rendah Masin'
                WHEN kelab_ccas.school_name = 96 THEN 'Sekolah Rendah Melilas'
                WHEN kelab_ccas.school_name = 97 THEN 'Sekolah Rendah Mentiri'
                WHEN kelab_ccas.school_name = 98 THEN 'Sekolah Rendah Merangking'
                WHEN kelab_ccas.school_name = 99 THEN 'Sekolah Rendah Muda Hashim'
                WHEN kelab_ccas.school_name = 100 THEN 'Sekolah Rendah Muhammad Alam'
                WHEN kelab_ccas.school_name = 101 THEN 'Sekolah Rendah Mulaut'
                WHEN kelab_ccas.school_name = 102 THEN 'Sekolah Rendah Nakhoda Abdul Rashid Menunggol'
                WHEN kelab_ccas.school_name = 103 THEN 'Sekolah Rendah Negalang'
                WHEN kelab_ccas.school_name = 104 THEN 'Sekolah Rendah OKSB Kilanas'
                WHEN kelab_ccas.school_name = 105 THEN 'Sekolah Rendah Paduka Seri Begawan SOAS'
                WHEN kelab_ccas.school_name = 106 THEN 'Sekolah Rendah Panaga'
                WHEN kelab_ccas.school_name = 107 THEN 'Sekolah Rendah Panchong'
                WHEN kelab_ccas.school_name = 108 THEN 'Sekolah Rendah Panchor Murai'
                WHEN kelab_ccas.school_name = 109 THEN 'Sekolah Rendah Panglima Barudin'
                WHEN kelab_ccas.school_name = 110 THEN 'Sekolah Rendah Pantai Berakas'
                WHEN kelab_ccas.school_name = 111 THEN 'Sekolah Rendah PAP Besar Sungai Kebun'
                WHEN kelab_ccas.school_name = 112 THEN 'Sekolah Rendah Pehin Dato Jamil'
                WHEN kelab_ccas.school_name = 113 THEN 'Sekolah Rendah Penanjong'
                WHEN kelab_ccas.school_name = 114 THEN 'Sekolah Rendah Penapar'
                WHEN kelab_ccas.school_name = 115 THEN 'Sekolah Rendah Pengiran Dipa Negara Pengiran Jaya Sengkarai'
                WHEN kelab_ccas.school_name = 116 THEN 'Sekolah Rendah Pengiran Muda Mahkota'
                WHEN kelab_ccas.school_name = 117 THEN 'Sekolah Rendah Pengiran Pekerma Setia Diraja Sahibul Bandar'
                WHEN kelab_ccas.school_name = 118 THEN 'Sekolah Rendah Pengiran Setia Jaya Pengiran Abdul Momin'
                WHEN kelab_ccas.school_name = 119 THEN 'Sekolah Rendah Pengkalan Batu'
                WHEN kelab_ccas.school_name = 120 THEN 'Sekolah Rendah Pg Setia Negara Pg Mohd Yusof'
                WHEN kelab_ccas.school_name = 121 THEN 'Sekolah Rendah Pintu Malim'
                WHEN kelab_ccas.school_name = 122 THEN 'Sekolah Rendah PKN Bukit Beruang'
                WHEN kelab_ccas.school_name = 123 THEN 'Sekolah Rendah Pulaie'
                WHEN kelab_ccas.school_name = 124 THEN 'Sekolah Rendah Puni'
                WHEN kelab_ccas.school_name = 125 THEN 'Sekolah Rendah Pusar Ulak'
                WHEN kelab_ccas.school_name = 126 THEN 'Sekolah Rendah Putat'
                WHEN kelab_ccas.school_name = 127 THEN 'Sekolah Rendah Raja Isteri Fatimah'
                WHEN kelab_ccas.school_name = 128 THEN 'Sekolah Rendah Rambai'
                WHEN kelab_ccas.school_name = 129 THEN 'Sekolah Rendah Rataie'
                WHEN kelab_ccas.school_name = 130 THEN 'Sekolah Rendah Rimba I'
                WHEN kelab_ccas.school_name = 131 THEN 'Sekolah Rendah Rimba II'
                WHEN kelab_ccas.school_name = 132 THEN 'Sekolah Rendah Rimba III'
                WHEN kelab_ccas.school_name = 133 THEN 'Sekolah Rendah S.U.A.S Muara'
                WHEN kelab_ccas.school_name = 134 THEN 'Sekolah Rendah Saba Darat'
                WHEN kelab_ccas.school_name = 135 THEN 'Sekolah Rendah Selangan'
                WHEN kelab_ccas.school_name = 136 THEN 'Sekolah Rendah Selapon'
                WHEN kelab_ccas.school_name = 137 THEN 'Sekolah Rendah Semabat'
                WHEN kelab_ccas.school_name = 138 THEN 'Sekolah Rendah Sengkurong'
                WHEN kelab_ccas.school_name = 139 THEN 'Sekolah Rendah Serasa'
                WHEN kelab_ccas.school_name = 140 THEN 'Sekolah Rendah Sinaut'
                WHEN kelab_ccas.school_name = 141 THEN 'Sekolah Rendah Subok'
                WHEN kelab_ccas.school_name = 142 THEN 'Sekolah Rendah Sultan Abdul Bubin'
                WHEN kelab_ccas.school_name = 143 THEN 'Sekolah Rendah Sultan Hasan Bangar'
                WHEN kelab_ccas.school_name = 144 THEN 'Sekolah Rendah Sultan Hashim'
                WHEN kelab_ccas.school_name = 145 THEN 'Sekolah Rendah Sungai Liang'
                WHEN kelab_ccas.school_name = 146 THEN 'Sekolah Rendah Sungai Siamas'
                WHEN kelab_ccas.school_name = 147 THEN 'Sekolah Rendah Sungai Tali'
                WHEN kelab_ccas.school_name = 148 THEN 'Sekolah Rendah Sungai Teraban'
                WHEN kelab_ccas.school_name = 149 THEN 'Sekolah Rendah Tanah Jambu'
                WHEN kelab_ccas.school_name = 150 THEN 'Sekolah Rendah Tanjong Kindana'
                WHEN kelab_ccas.school_name = 151 THEN 'Sekolah Rendah Tumpuan Telisai'
                WHEN kelab_ccas.school_name = 152 THEN 'Sekolah Rendah Tungku'
                WHEN kelab_ccas.school_name = 153 THEN 'Sekolah Rendah Tutong Kem'
                WHEN kelab_ccas.school_name = 155 THEN 'Sekolah Rendah Orang Kaya Ali Wanika Setia Diraja Kupang'
                ELSE NULL END"));
        })
        ->select('student_inv.*')
        ->where('kelab_ccas.year', 2023)
        ->whereIn('kelab_ccas.school_name', [1, 2, 3, 4, 5, 6,
                                            7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 
                                            24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 37, 154,
                                            36, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 
                                            54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 
                                            70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85,
                                            86, 87, 88, 89, 90, 91, 92, 93, 94, 95, 96, 97, 98, 99, 100, 101, 
                                            102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114,
                                            115, 116, 117, 118, 119, 120, 121, 122, 123, 124, 125, 126, 127, 
                                            128, 129, 130, 131, 132, 133, 134, 135, 136, 137, 138, 139, 140,
                                            141, 142, 143, 144, 145, 146, 147, 148, 149, 150, 151, 152, 153, 155])
        ->orderBy('kelab_ccas.school_name', 'asc')
        ->get();

        $schoolSources = [];

            // Loop through each school and determine its source
            foreach ($schoolname as $school) {
                $schoolName = $school->school_name;

                if ($schoolName >= 2 && $schoolName <= 6) {
                    $schoolSource = 'PTE';
                } elseif (
                    ($schoolName >= 7 && $schoolName <= 35)
                    || $schoolName == 37
                    || $schoolName == 154
                ) {
                    $schoolSource = 'SM';
                } elseif (
                    ($schoolName >= 39 && $schoolName <= 153)
                    || $schoolName == 36
                    || $schoolName == 155
                ) {
                    $schoolSource = 'SR';
                } elseif ($schoolName == 1) {
                    $schoolSource = 'SM/PTE';
                } else {
                    $schoolSource = ''; // Default value if none of the conditions match
                }

                $schoolSources[$school->school_name] = $schoolSource;
            }

        // Set $schoolInvDataExists to true if there's any data in StudentInv, false otherwise
        $schoolDataExists = $studentInv->isNotEmpty();

        $schoolTotals = [];

        //SR
        $schoolnameSR = CCA::select('kelab_ccas.*')
            ->where('year', 2023)
            ->whereIn('school_name', [
                36, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 
                54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 
                70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85,
                86, 87, 88, 89, 90, 91, 92, 93, 94, 95, 96, 97, 98, 99, 100, 101, 
                102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114,
                115, 116, 117, 118, 119, 120, 121, 122, 123, 124, 125, 126, 127, 
                128, 129, 130, 131, 132, 133, 134, 135, 136, 137, 138, 139, 140,
                141, 142, 143, 144, 145, 146, 147, 148, 149, 150, 151, 152, 153, 155
            ])
            ->orderByRaw("CAST(school_name AS INT) ASC")
            ->get();

        foreach ($schoolnameSR as $schoolSR) {
            // Check if there is corresponding data in StudentInv for this school
            $studentData = $studentInv->where('school_name', $schoolNameMapping[$schoolSR->school_name])->first();

            if ($studentData) {
                // Use data from StudentInv if it exists
                $jumlahPraSekolah = $studentData->pra_sekolah;
                $jumlahTahun1 = $studentData->tahun_1;
                $jumlahTahun2 = $studentData->tahun_2;
                $jumlahTahun3 = $studentData->tahun_3;
                $jumlahTahun4 = $studentData->tahun_4;
                $jumlahTahun5 = $studentData->tahun_5;
                $jumlahTahun6 = $studentData->tahun_6;
            } else {
                // Use data from CCA if no data in StudentInv
                $jumlahPraSekolah = $schoolSR->jum_lelaki_pra + $schoolSR->jum_perempuan_pra;
                $jumlahTahun1 = $schoolSR->jum_lelaki_1 + $schoolSR->jum_perempuan_1;
                $jumlahTahun2 = $schoolSR->jum_lelaki_2 + $schoolSR->jum_perempuan_2;
                $jumlahTahun3 = $schoolSR->jum_lelaki_3 + $schoolSR->jum_perempuan_3;
                $jumlahTahun4 = $schoolSR->jum_lelaki_4 + $schoolSR->jum_perempuan_4;
                $jumlahTahun5 = $schoolSR->jum_lelaki_5 + $schoolSR->jum_perempuan_5;
                $jumlahTahun6 = $schoolSR->jum_lelaki_6 + $schoolSR->jum_perempuan_6;
            }

            $schoolTotals[$schoolSR->school_name] = [
                        'jumlahPraSekolah' => $jumlahPraSekolah,
                        'jumlahTahun1' => $jumlahTahun1,
                        'jumlahTahun2' => $jumlahTahun2,
                        'jumlahTahun3' => $jumlahTahun3,
                        'jumlahTahun4' => $jumlahTahun4,
                        'jumlahTahun5' => $jumlahTahun5,
                        'jumlahTahun6' => $jumlahTahun6,
            ];
        }

        //SM
        $schoolnameSM = CCA::select('kelab_ccas.*')
            ->where('year', 2023)
            ->whereIn('school_name', [
                7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 
                24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 37, 154,
            ])
            ->orderByRaw("CAST(school_name AS INT) ASC")
            ->get();

        foreach ($schoolnameSM as $schoolSM) {
            // Check if there is corresponding data in StudentInv for this school
            $studentData = $studentInv->where('school_name', $schoolNameMapping[$schoolSM->school_name])->first();

            if ($studentData) {
                // Use data from StudentInv if it exists
                $jumlahTahun7 = $studentData->tahun_7;
                $jumlahTahun8 = $studentData->tahun_8;
                $jumlahTahun9 = $studentData->tahun_9;
                $jumlahTahun10 = $studentData->tahun_10;
                $jumlahTahun11 = $studentData->tahun_11;
            } else {
                // Use data from CCA if no data in StudentInv
                $jumlahTahun7 = $schoolSM->jum_lelaki_7 + $schoolSM->jum_perempuan_7;
                $jumlahTahun8 = $schoolSM->jum_lelaki_8 + $schoolSM->jum_perempuan_8;
                $jumlahTahun9 = $schoolSM->jum_lelaki_9 + $schoolSM->jum_perempuan_9;
                $jumlahTahun10 = $schoolSM->jum_lelaki_10 + $schoolSM->jum_perempuan_10;
                $jumlahTahun11 = $schoolSM->jum_lelaki_11 + $schoolSM->jum_perempuan_11;
            }

            $schoolTotals[$schoolSM->school_name] = [
                        'jumlahTahun7' => $jumlahTahun7,
                        'jumlahTahun8' => $jumlahTahun8,
                        'jumlahTahun9' => $jumlahTahun9,
                        'jumlahTahun10' => $jumlahTahun10,
                        'jumlahTahun11' => $jumlahTahun11,
            ];
        }

        //PTE
        $schoolnamePTE = CCA::select('kelab_ccas.*')
            ->where('year', 2023)
            ->whereIn('school_name', [2, 3, 4, 5, 6])
            ->orderByRaw("CAST(school_name AS INT) ASC")
            ->get();

        foreach ($schoolnamePTE as $schoolPTE) {
            // Check if there is corresponding data in StudentInv for this school
            $studentData = $studentInv->where('school_name', $schoolNameMapping[$schoolPTE->school_name])->first();

            if ($studentData) {
                // Use data from StudentInv if it exists
                $jumlahEnamBawah = $studentData->prau_1;
                $jumlahEnamAtas = $studentData->prau_2;
            } else {
                // Use data from CCA if no data in StudentInv
                $jumlahEnamBawah = $schoolPTE->jum_lelaki_12 + $schoolPTE->jum_perempuan_12;
                $jumlahEnamAtas = $schoolPTE->jum_lelaki_13 + $schoolPTE->jum_perempuan_13;
            }

            $schoolTotals[$schoolPTE->school_name] = [
                'jumlahEnamBawah' => $jumlahEnamBawah,
                'jumlahEnamAtas' => $jumlahEnamAtas,
            ];
        }

        //Maktab Sains (SM and PTE)
        $schoolnameMaktab = CCA::select('kelab_ccas.*')
            ->where('year', 2023)
            ->whereIn('school_name', [1])
            ->orderByRaw("CAST(school_name AS INT) ASC")
            ->get();

        foreach ($schoolnameMaktab as $schoolMaktab) {
            // Check if there is corresponding data in StudentInv for this school
            $studentData = $studentInv->where('school_name', $schoolNameMapping[$schoolMaktab->school_name])->first();

            if ($studentData) {
                // Use data from StudentInv if it exists
                $jumlahTahun7 = $studentData->tahun_7;
                $jumlahTahun8 = $studentData->tahun_8;
                $jumlahTahun9 = $studentData->tahun_9;
                $jumlahTahun10 = $studentData->tahun_10;
                $jumlahTahun11 = $studentData->tahun_11;
                $jumlahEnamBawah = $studentData->prau_1;
                $jumlahEnamAtas = $studentData->prau_2;
            } else {
                // Use data from CCA if no data in StudentInv
                $jumlahTahun7 = $schoolMaktab->jum_lelaki_7 + $schoolMaktab->jum_perempuan_7;
                $jumlahTahun8 = $schoolMaktab->jum_lelaki_8 + $schoolMaktab->jum_perempuan_8;
                $jumlahTahun9 = $schoolMaktab->jum_lelaki_9 + $schoolMaktab->jum_perempuan_9;
                $jumlahTahun10 = $schoolMaktab->jum_lelaki_10 + $schoolMaktab->jum_perempuan_10;
                $jumlahTahun11 = $schoolMaktab->jum_lelaki_11 + $schoolMaktab->jum_perempuan_11;
                $jumlahEnamBawah = $schoolMaktab->jum_lelaki_12 + $schoolMaktab->jum_perempuan_12;
                $jumlahEnamAtas = $schoolMaktab->jum_lelaki_13 + $schoolMaktab->jum_perempuan_13;
            }

            $schoolTotals[$schoolMaktab->school_name] = [
                'jumlahTahun7' => $jumlahTahun7,
                'jumlahTahun8' => $jumlahTahun8,
                'jumlahTahun9' => $jumlahTahun9,
                'jumlahTahun10' => $jumlahTahun10,
                'jumlahTahun11' => $jumlahTahun11,
                'jumlahEnamBawah' => $jumlahEnamBawah,
                'jumlahEnamAtas' => $jumlahEnamAtas,
            ];
        }

        // Calculate total students for all levels
        $totalStudentsPraSekolah = array_sum(array_column($schoolTotals, 'jumlahPraSekolah'));
        $totalStudentsTahun1 = array_sum(array_column($schoolTotals, 'jumlahTahun1'));
        $totalStudentsTahun2 = array_sum(array_column($schoolTotals, 'jumlahTahun2'));
        $totalStudentsTahun3 = array_sum(array_column($schoolTotals, 'jumlahTahun3'));
        $totalStudentsTahun4 = array_sum(array_column($schoolTotals, 'jumlahTahun4'));
        $totalStudentsTahun5 = array_sum(array_column($schoolTotals, 'jumlahTahun5'));
        $totalStudentsTahun6 = array_sum(array_column($schoolTotals, 'jumlahTahun6'));
        $totalStudentsTahun7 = array_sum(array_column($schoolTotals, 'jumlahTahun7'));
        $totalStudentsTahun8 = array_sum(array_column($schoolTotals, 'jumlahTahun8'));
        $totalStudentsTahun9 = array_sum(array_column($schoolTotals, 'jumlahTahun9'));
        $totalStudentsTahun10 = array_sum(array_column($schoolTotals, 'jumlahTahun10'));
        $totalStudentsTahun11 = array_sum(array_column($schoolTotals, 'jumlahTahun11'));
        $totalStudentsEnamBawah = array_sum(array_column($schoolTotals, 'jumlahEnamBawah'));
        $totalStudentsEnamAtas = array_sum(array_column($schoolTotals, 'jumlahEnamAtas'));

        return view('inventory.datakeramaianindex', compact('schoolname', 'schoolSources', 'schoolNameMapping', 'studentInv', 'schoolTotals', 'schoolDataExists', 'schoolnameSR',  'schoolnameSM', 'schoolnamePTE', 'schoolnameMaktab', 
                                                            'totalStudentsPraSekolah', 'totalStudentsTahun1', 'totalStudentsTahun2', 'totalStudentsTahun3', 'totalStudentsTahun4', 
                                                            'totalStudentsTahun5', 'totalStudentsTahun6', 'totalStudentsTahun7', 'totalStudentsTahun8', 'totalStudentsTahun9', 'totalStudentsTahun10',
                                                            'totalStudentsTahun11', 'totalStudentsEnamBawah', 'totalStudentsEnamAtas',));
    }


    public function datakeramaianedit($id)
    {

        $icNos = Auth::user()->ic_no;
        
        // Retrieve the specific school data based on the ID
        $schoolData = CCA::find($id);

        // Ensure that $schoolData is not null
        if (!$schoolData) {
            // Handle the case where the school with the given ID does not exist
            abort(404); // You can customize this error handling as needed
        }

        // Determine the source based on the school_name value
        if ($schoolData->school_name >= 2 && $schoolData->school_name <= 6) {
            $source = 'PTE';
        } 
        
        elseif (
            ($schoolData->school_name >= 7 && $schoolData->school_name <= 35)
            || $schoolData->school_name == 37
            || $schoolData->school_name == 154
        ) {
            $source = 'SM';
        } 
        
        elseif (
            ($schoolData->school_name >= 39 && $schoolData->school_name <= 153)
            || $schoolData->school_name == 36
            || $schoolData->school_name == 155
        ) {
            $source = 'SR';
        } 
        
        elseif ( $schoolData->school_name == 1 ) {
            $source = 'SM/PTE';
        }

        $schoolname = CCA::select('kelab_ccas.*')
            ->where('year', 2023)
            ->whereIn('school_name', [1, 2, 3, 4, 5, 6, 
        
                                        7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 
                                        24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 37, 154,
                                        
                                        36, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 
                                        54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 
                                        70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85,
                                        86, 87, 88, 89, 90, 91, 92, 93, 94, 95, 96, 97, 98, 99, 100, 101, 
                                        102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114,
                                        115, 116, 117, 118, 119, 120, 121, 122, 123, 124, 125, 126, 127, 
                                        128, 129, 130, 131, 132, 133, 134, 135, 136, 137, 138, 139, 140,
                                        141, 142, 143, 144, 145, 146, 147, 148, 149, 150, 151, 152, 153, 155])
            ->orderByRaw("CAST(school_name AS INT) ASC") // Cast to integer for sorting
            ->get();

        // Define a mapping of numerical school_name values to school names
        $schoolNameMapping = [
            1 => 'Maktab Sains PSBS',
            2 => 'Maktab Duli PMAMB',
            3 => 'PTE Belait',
            4 => 'PTE Meragang',
            5 => 'PTE Sengkurong',
            6 => 'PTE Tutong',

            7 => 'Maktab Anthony Abell Seria',
            8 => 'Maktab Sultan Omar Ali Saifuddien',
            9 => 'STPRI', 
            10 => 'SM Sultan Sharif Ali', 
            11 => 'SM Awang Semaun', 
            12 => 'SM Berakas', 
            13 => 'SM Katok', 
            14 => 'SM Lambak Kiri', 
            15 => 'SM Masin', 
            16 => 'SM Menglait', 
            17 => 'SM Muda Hashim', 
            18 => 'SM PAP Hajah Rashidah Saadatul Bolkiah', 
            19 => 'SM Pehin Dato Seri Maharaja', 
            20 => 'SM Pengiran Anak Puteri Hajah Masna', 
            21 => 'SM Pengiran Isteri Hajah Mariam',
            22 => 'SM Pengiran Jaya Negara Pengiran Haji Abu Bakar', 
            23 => 'SM Perdana Wazir', 
            24 => 'SM Raja Isteri Pengiran Anak Saleha', 
            25 => 'SM Rimba', 
            26 => 'SM Rimba II', 
            27 => 'SM Sayyidina Abu Bakar', 
            28 => 'SM Sayyidina Ali', 
            29 => 'SM Sultan Hassan Bangar, Temburong',
            30 => 'SM Sayyidina Husain', 
            31 => 'SM Sayyidina Othman', 
            32 => 'SM Sayyidina Umar Al-Khattab', 
            33 => 'SM Sufri Bolkiah', 
            34 => 'SM Sayyidina Hasan', 
            35 => 'SM Sultan Muhammad Jamalul Alam',
            37 => 'Sekolah Sukan',
            154 => 'SM Tanjong Maya Tutong',

            36 => 'Sekolah Rendah Abdul Rashid, Tanjong Maya',
            39 => 'Sekolah Rendah Ahmad Tajuddin',
            40 => 'Sekolah Rendah AHMY Katimahar',
            41 => 'Sekolah Rendah Amar Pahlawan',
            42 => 'Sekolah Rendah Amo',
            43 => 'Sekolah Rendah Anggerek Desa',
            44 => 'Sekolah Rendah Angkatan Tentera Laut',
            45 => 'Sekolah Rendah Bakiau',
            46 => 'Sekolah Rendah Batang Mitus',
            47 => 'Sekolah Rendah Batu Marang',
            48 => 'Sekolah Rendah Bebuloh',
            49 => 'Sekolah Rendah Bendahara Lama',
            50 => 'Sekolah Rendah Bendahara Sakam Bunut',
            51 => 'Sekolah Rendah Bengkurong',
            52 => 'Sekolah Rendah Benutan',
            53 => 'Sekolah Rendah Berakas Garisson',
            54 => 'Sekolah Rendah Beribi Telanai',
            55 => 'Sekolah Rendah Binturan',
            56 => 'Sekolah Rendah Birau',
            57 => 'Sekolah Rendah Bukit Panggal',
            58 => 'Sekolah Rendah Bukit Udal',
            59 => 'Sekolah Rendah Danau',
            60 => 'Sekolah Rendah Dato Basir',
            61 => 'Sekolah Rendah Dato Maharaja Setia Dian Sukang',
            62 => 'Sekolah Rendah Dato Mahawangsa Lambak',
            63 => 'Sekolah Rendah Dato Marsal',
            64 => 'Sekolah Rendah Dato Mohd Yassin',
            65 => 'Sekolah Rendah Dato Othman',
            66 => 'Sekolah Rendah Dato Pemancha Saging Ukong',
            67 => 'Sekolah Rendah Dato Ratna Haji Muhammad Jaafar',
            68 => 'Sekolah Rendah Delima Satu',
            69 => 'Sekolah Rendah Haji Mohd Jaafar Maun',
            70 => 'Sekolah Rendah Haji Mohd Salleh',
            71 => 'Sekolah Rendah Haji Tarif',
            72 => 'Sekolah Rendah Jerudong',
            73 => 'Sekolah Rendah Junjongan',
            74 => 'Sekolah Rendah Kampong Bukit',
            75 => 'Sekolah Rendah Kampong Bukit Beruang II',
            76 => 'Sekolah Rendah Kampong Mata-Mata',
            77 => 'Sekolah Rendah Kampong Menengah',
            78 => 'Sekolah Rendah Kampong Perpindahan Lambak Kanan Jalan',
            79 => 'Sekolah Rendah Kapok',
            80 => 'Sekolah Rendah Kasat',
            81 => 'Sekolah Rendah Katok A',
            82 => 'Sekolah Rendah Katok B',
            83 => 'Sekolah Rendah Keriam',
            84 => 'Sekolah Rendah Kiudang',
            85 => 'Sekolah Rendah Kuala Belait',
            86 => 'Sekolah Rendah Kupang',
            87 => 'Sekolah Rendah Labi',
            88 => 'Sekolah Rendah Labu Estate',
            89 => 'Sekolah Rendah Lambak Kanan Jalan',
            90 => 'Sekolah Rendah Lamunin',
            91 => 'Sekolah Rendah Lubok Pulau',
            92 => 'Sekolah Rendah Lumapas',
            93 => 'Sekolah Rendah Lumut',
            94 => 'Sekolah Rendah Mabohai',
            95 => 'Sekolah Rendah Masin',
            96 => 'Sekolah Rendah Melilas',
            97 => 'Sekolah Rendah Mentiri',
            98 => 'Sekolah Rendah Merangking',
            99 => 'Sekolah Rendah Muda Hashim',
            100 => 'Sekolah Rendah Muhammad Alam',
            101 => 'Sekolah Rendah Mulaut',
            102 => 'Sekolah Rendah Nakhoda Abdul Rashid Menunggol',
            103 => 'Sekolah Rendah Negalang',
            104 => 'Sekolah Rendah OKSB Kilanas',
            105 => 'Sekolah Rendah Paduka Seri Begawan SOAS',
            106 => 'Sekolah Rendah Panaga',
            107 => 'Sekolah Rendah Panchong',
            108 => 'Sekolah Rendah Panchor Murai',
            109 => 'Sekolah Rendah Panglima Barudin',
            110 => 'Sekolah Rendah Pantai Berakas',
            111 => 'Sekolah Rendah PAP Besar Sungai Kebun',
            112 => 'Sekolah Rendah Pehin Dato Jamil',
            113 => 'Sekolah Rendah Penanjong',
            114 => 'Sekolah Rendah Penapar',
            115 => 'Sekolah Rendah Pengiran Dipa Negara Pengiran Jaya Sengkarai',
            116 => 'Sekolah Rendah Pengiran Muda Mahkota',
            117 => 'Sekolah Rendah Pengiran Pekerma Setia Diraja Sahibul Bandar',
            118 => 'Sekolah Rendah Pengiran Setia Jaya Pengiran Abdul Momin',
            119 => 'Sekolah Rendah Pengkalan Batu',
            120 => 'Sekolah Rendah Pg Setia Negara Pg Mohd Yusof',
            121 => 'Sekolah Rendah Pintu Malim',
            122 => 'Sekolah Rendah PKN Bukit Beruang',
            123 => 'Sekolah Rendah Pulaie',
            124 => 'Sekolah Rendah Puni',
            125 => 'Sekolah Rendah Pusar Ulak',
            126 => 'Sekolah Rendah Putat',
            127 => 'Sekolah Rendah Raja Isteri Fatimah',
            128 => 'Sekolah Rendah Rambai',
            129 => 'Sekolah Rendah Rataie',
            130 => 'Sekolah Rendah Rimba I',
            131 => 'Sekolah Rendah Rimba II',
            132 => 'Sekolah Rendah Rimba III',
            133 => 'Sekolah Rendah S.U.A.S Muara',
            134 => 'Sekolah Rendah Saba Darat',
            135 => 'Sekolah Rendah Selangan',
            136 => 'Sekolah Rendah Selapon',
            137 => 'Sekolah Rendah Semabat',
            138 => 'Sekolah Rendah Sengkurong',
            139 => 'Sekolah Rendah Serasa',
            140 => 'Sekolah Rendah Sinaut',
            141 => 'Sekolah Rendah Subok',
            142 => 'Sekolah Rendah Sultan Abdul Bubin',
            143 => 'Sekolah Rendah Sultan Hasan Bangar',
            144 => 'Sekolah Rendah Sultan Hashim',
            145 => 'Sekolah Rendah Sungai Liang',
            146 => 'Sekolah Rendah Sungai Siamas',
            147 => 'Sekolah Rendah Sungai Tali',
            148 => 'Sekolah Rendah Sungai Teraban',
            149 => 'Sekolah Rendah Tanah Jambu',
            150 => 'Sekolah Rendah Tanjong Kindana',
            151 => 'Sekolah Rendah Tumpuan Telisai',
            152 => 'Sekolah Rendah Tungku',
            153 => 'Sekolah Rendah Tutong Kem',
            155 => 'Sekolah Rendah Orang Kaya Ali Wanika Setia Diraja Kupang',
        ];

        $studentInv = StudentInv::leftJoin('kelab_ccas', function($join) {
            // Map numerical school_name to text school_name using your mapping
            $join->on('student_inv.school_name', '=', DB::raw("CASE
                WHEN kelab_ccas.school_name = 1 THEN 'Maktab Sains PSBS'
                WHEN kelab_ccas.school_name = 2 THEN 'Maktab Duli PMAMB'
                WHEN kelab_ccas.school_name = 3 THEN 'PTE Belait'
                WHEN kelab_ccas.school_name = 4 THEN 'PTE Meragang'
                WHEN kelab_ccas.school_name = 5 THEN 'PTE Sengkurong'
                WHEN kelab_ccas.school_name = 6 THEN 'PTE Tutong'

                WHEN kelab_ccas.school_name = 7 THEN 'Maktab Anthony Abell Seria'
                WHEN kelab_ccas.school_name = 8 THEN 'Maktab Sultan Omar Ali Saifuddien'
                WHEN kelab_ccas.school_name = 9 THEN 'STPRI'
                WHEN kelab_ccas.school_name = 10 THEN 'SM Sultan Sharif Ali' 
                WHEN kelab_ccas.school_name = 11 THEN 'SM Awang Semaun'
                WHEN kelab_ccas.school_name = 12 THEN 'SM Berakas'
                WHEN kelab_ccas.school_name = 13 THEN 'SM Katok'
                WHEN kelab_ccas.school_name = 14 THEN 'SM Lambak Kiri' 
                WHEN kelab_ccas.school_name = 15 THEN 'SM Masin' 
                WHEN kelab_ccas.school_name = 16 THEN 'SM Menglait' 
                WHEN kelab_ccas.school_name = 17 THEN 'SM Muda Hashim' 
                WHEN kelab_ccas.school_name = 18 THEN 'SM PAP Hajah Rashidah Saadatul Bolkiah' 
                WHEN kelab_ccas.school_name = 19 THEN 'SM Pehin Dato Seri Maharaja' 
                WHEN kelab_ccas.school_name = 20 THEN 'SM Pengiran Anak Puteri Hajah Masna' 
                WHEN kelab_ccas.school_name = 21 THEN 'SM Pengiran Isteri Hajah Mariam'
                WHEN kelab_ccas.school_name = 22 THEN 'SM Pengiran Jaya Negara Pengiran Haji Abu Bakar' 
                WHEN kelab_ccas.school_name = 23 THEN 'SM Perdana Wazir' 
                WHEN kelab_ccas.school_name = 24 THEN 'SM Raja Isteri Pengiran Anak Saleha' 
                WHEN kelab_ccas.school_name = 25 THEN 'SM Rimba' 
                WHEN kelab_ccas.school_name = 26 THEN 'SM Rimba II' 
                WHEN kelab_ccas.school_name = 27 THEN 'SM Sayyidina Abu Bakar' 
                WHEN kelab_ccas.school_name = 28 THEN 'SM Sayyidina Ali' 
                WHEN kelab_ccas.school_name = 29 THEN 'SM Sultan Hassan Bangar Temburong'
                WHEN kelab_ccas.school_name = 30 THEN 'SM Sayyidina Husain' 
                WHEN kelab_ccas.school_name = 31 THEN 'SM Sayyidina Othman' 
                WHEN kelab_ccas.school_name = 32 THEN 'SM Sayyidina Umar Al-Khattab' 
                WHEN kelab_ccas.school_name = 33 THEN 'SM Sufri Bolkiah' 
                WHEN kelab_ccas.school_name = 34 THEN 'SM Sayyidina Hasan' 
                WHEN kelab_ccas.school_name = 35 THEN 'SM Sultan Muhammad Jamalul Alam'
                WHEN kelab_ccas.school_name = 154 THEN 'SM Tanjong Maya Tutong'
                WHEN kelab_ccas.school_name = 37 THEN 'Sekolah Sukan'

                WHEN kelab_ccas.school_name = 36 THEN 'Sekolah Rendah Abdul Rashid, Tanjong Maya'
                WHEN kelab_ccas.school_name = 39 THEN 'Sekolah Rendah Ahmad Tajuddin'
                WHEN kelab_ccas.school_name = 40 THEN 'Sekolah Rendah AHMY Katimahar'
                WHEN kelab_ccas.school_name = 41 THEN 'Sekolah Rendah Amar Pahlawan'
                WHEN kelab_ccas.school_name = 42 THEN 'Sekolah Rendah Amo'
                WHEN kelab_ccas.school_name = 43 THEN 'Sekolah Rendah Anggerek Desa'
                WHEN kelab_ccas.school_name = 44 THEN 'Sekolah Rendah Angkatan Tentera Laut'
                WHEN kelab_ccas.school_name = 45 THEN 'Sekolah Rendah Bakiau'
                WHEN kelab_ccas.school_name = 46 THEN 'Sekolah Rendah Batang Mitus'
                WHEN kelab_ccas.school_name = 47 THEN 'Sekolah Rendah Batu Marang'
                WHEN kelab_ccas.school_name = 48 THEN 'Sekolah Rendah Bebuloh'
                WHEN kelab_ccas.school_name = 49 THEN 'Sekolah Rendah Bendahara Lama'
                WHEN kelab_ccas.school_name = 50 THEN 'Sekolah Rendah Bendahara Sakam Bunut'
                WHEN kelab_ccas.school_name = 51 THEN 'Sekolah Rendah Bengkurong'
                WHEN kelab_ccas.school_name = 52 THEN 'Sekolah Rendah Benutan'
                WHEN kelab_ccas.school_name = 53 THEN 'Sekolah Rendah Berakas Garisson'
                WHEN kelab_ccas.school_name = 54 THEN 'Sekolah Rendah Beribi Telanai'
                WHEN kelab_ccas.school_name = 55 THEN 'Sekolah Rendah Binturan'
                WHEN kelab_ccas.school_name = 56 THEN 'Sekolah Rendah Birau'
                WHEN kelab_ccas.school_name = 57 THEN 'Sekolah Rendah Bukit Panggal'
                WHEN kelab_ccas.school_name = 58 THEN 'Sekolah Rendah Bukit Udal'
                WHEN kelab_ccas.school_name = 59 THEN 'Sekolah Rendah Danau'
                WHEN kelab_ccas.school_name = 60 THEN 'Sekolah Rendah Dato Basir'
                WHEN kelab_ccas.school_name = 61 THEN 'Sekolah Rendah Dato Maharaja Setia Dian Sukang'
                WHEN kelab_ccas.school_name = 62 THEN 'Sekolah Rendah Dato Mahawangsa Lambak'
                WHEN kelab_ccas.school_name = 63 THEN 'Sekolah Rendah Dato Marsal'
                WHEN kelab_ccas.school_name = 64 THEN 'Sekolah Rendah Dato Mohd Yassin'
                WHEN kelab_ccas.school_name = 65 THEN 'Sekolah Rendah Dato Othman'
                WHEN kelab_ccas.school_name = 66 THEN 'Sekolah Rendah Dato Pemancha Saging Ukong'
                WHEN kelab_ccas.school_name = 67 THEN 'Sekolah Rendah Dato Ratna Haji Muhammad Jaafar'
                WHEN kelab_ccas.school_name = 68 THEN 'Sekolah Rendah Delima Satu'
                WHEN kelab_ccas.school_name = 69 THEN 'Sekolah Rendah Haji Mohd Jaafar Maun'
                WHEN kelab_ccas.school_name = 70 THEN 'Sekolah Rendah Haji Mohd Salleh'
                WHEN kelab_ccas.school_name = 71 THEN 'Sekolah Rendah Haji Tarif'
                WHEN kelab_ccas.school_name = 72 THEN 'Sekolah Rendah Jerudong'
                WHEN kelab_ccas.school_name = 73 THEN 'Sekolah Rendah Junjongan'
                WHEN kelab_ccas.school_name = 74 THEN 'Sekolah Rendah Kampong Bukit'
                WHEN kelab_ccas.school_name = 75 THEN 'Sekolah Rendah Kampong Bukit Beruang II'
                WHEN kelab_ccas.school_name = 76 THEN 'Sekolah Rendah Kampong Mata-Mata'
                WHEN kelab_ccas.school_name = 77 THEN 'Sekolah Rendah Kampong Menengah'
                WHEN kelab_ccas.school_name = 78 THEN 'Sekolah Rendah Kampong Perpindahan Lambak Kanan Jalan'
                WHEN kelab_ccas.school_name = 79 THEN 'Sekolah Rendah Kapok'
                WHEN kelab_ccas.school_name = 80 THEN 'Sekolah Rendah Kasat'
                WHEN kelab_ccas.school_name = 81 THEN 'Sekolah Rendah Katok A'
                WHEN kelab_ccas.school_name = 82 THEN 'Sekolah Rendah Katok B'
                WHEN kelab_ccas.school_name = 83 THEN 'Sekolah Rendah Keriam'
                WHEN kelab_ccas.school_name = 84 THEN 'Sekolah Rendah Kiudang'
                WHEN kelab_ccas.school_name = 85 THEN 'Sekolah Rendah Kuala Belait'
                WHEN kelab_ccas.school_name = 86 THEN 'Sekolah Rendah Kupang'
                WHEN kelab_ccas.school_name = 87 THEN 'Sekolah Rendah Labi'
                WHEN kelab_ccas.school_name = 88 THEN 'Sekolah Rendah Labu Estate'
                WHEN kelab_ccas.school_name = 89 THEN 'Sekolah Rendah Lambak Kanan Jalan'
                WHEN kelab_ccas.school_name = 90 THEN 'Sekolah Rendah Lamunin'
                WHEN kelab_ccas.school_name = 91 THEN 'Sekolah Rendah Lubok Pulau'
                WHEN kelab_ccas.school_name = 92 THEN 'Sekolah Rendah Lumapas'
                WHEN kelab_ccas.school_name = 93 THEN 'Sekolah Rendah Lumut'
                WHEN kelab_ccas.school_name = 94 THEN 'Sekolah Rendah Mabohai'
                WHEN kelab_ccas.school_name = 95 THEN 'Sekolah Rendah Masin'
                WHEN kelab_ccas.school_name = 96 THEN 'Sekolah Rendah Melilas'
                WHEN kelab_ccas.school_name = 97 THEN 'Sekolah Rendah Mentiri'
                WHEN kelab_ccas.school_name = 98 THEN 'Sekolah Rendah Merangking'
                WHEN kelab_ccas.school_name = 99 THEN 'Sekolah Rendah Muda Hashim'
                WHEN kelab_ccas.school_name = 100 THEN 'Sekolah Rendah Muhammad Alam'
                WHEN kelab_ccas.school_name = 101 THEN 'Sekolah Rendah Mulaut'
                WHEN kelab_ccas.school_name = 102 THEN 'Sekolah Rendah Nakhoda Abdul Rashid Menunggol'
                WHEN kelab_ccas.school_name = 103 THEN 'Sekolah Rendah Negalang'
                WHEN kelab_ccas.school_name = 104 THEN 'Sekolah Rendah OKSB Kilanas'
                WHEN kelab_ccas.school_name = 105 THEN 'Sekolah Rendah Paduka Seri Begawan SOAS'
                WHEN kelab_ccas.school_name = 106 THEN 'Sekolah Rendah Panaga'
                WHEN kelab_ccas.school_name = 107 THEN 'Sekolah Rendah Panchong'
                WHEN kelab_ccas.school_name = 108 THEN 'Sekolah Rendah Panchor Murai'
                WHEN kelab_ccas.school_name = 109 THEN 'Sekolah Rendah Panglima Barudin'
                WHEN kelab_ccas.school_name = 110 THEN 'Sekolah Rendah Pantai Berakas'
                WHEN kelab_ccas.school_name = 111 THEN 'Sekolah Rendah PAP Besar Sungai Kebun'
                WHEN kelab_ccas.school_name = 112 THEN 'Sekolah Rendah Pehin Dato Jamil'
                WHEN kelab_ccas.school_name = 113 THEN 'Sekolah Rendah Penanjong'
                WHEN kelab_ccas.school_name = 114 THEN 'Sekolah Rendah Penapar'
                WHEN kelab_ccas.school_name = 115 THEN 'Sekolah Rendah Pengiran Dipa Negara Pengiran Jaya Sengkarai'
                WHEN kelab_ccas.school_name = 116 THEN 'Sekolah Rendah Pengiran Muda Mahkota'
                WHEN kelab_ccas.school_name = 117 THEN 'Sekolah Rendah Pengiran Pekerma Setia Diraja Sahibul Bandar'
                WHEN kelab_ccas.school_name = 118 THEN 'Sekolah Rendah Pengiran Setia Jaya Pengiran Abdul Momin'
                WHEN kelab_ccas.school_name = 119 THEN 'Sekolah Rendah Pengkalan Batu'
                WHEN kelab_ccas.school_name = 120 THEN 'Sekolah Rendah Pg Setia Negara Pg Mohd Yusof'
                WHEN kelab_ccas.school_name = 121 THEN 'Sekolah Rendah Pintu Malim'
                WHEN kelab_ccas.school_name = 122 THEN 'Sekolah Rendah PKN Bukit Beruang'
                WHEN kelab_ccas.school_name = 123 THEN 'Sekolah Rendah Pulaie'
                WHEN kelab_ccas.school_name = 124 THEN 'Sekolah Rendah Puni'
                WHEN kelab_ccas.school_name = 125 THEN 'Sekolah Rendah Pusar Ulak'
                WHEN kelab_ccas.school_name = 126 THEN 'Sekolah Rendah Putat'
                WHEN kelab_ccas.school_name = 127 THEN 'Sekolah Rendah Raja Isteri Fatimah'
                WHEN kelab_ccas.school_name = 128 THEN 'Sekolah Rendah Rambai'
                WHEN kelab_ccas.school_name = 129 THEN 'Sekolah Rendah Rataie'
                WHEN kelab_ccas.school_name = 130 THEN 'Sekolah Rendah Rimba I'
                WHEN kelab_ccas.school_name = 131 THEN 'Sekolah Rendah Rimba II'
                WHEN kelab_ccas.school_name = 132 THEN 'Sekolah Rendah Rimba III'
                WHEN kelab_ccas.school_name = 133 THEN 'Sekolah Rendah S.U.A.S Muara'
                WHEN kelab_ccas.school_name = 134 THEN 'Sekolah Rendah Saba Darat'
                WHEN kelab_ccas.school_name = 135 THEN 'Sekolah Rendah Selangan'
                WHEN kelab_ccas.school_name = 136 THEN 'Sekolah Rendah Selapon'
                WHEN kelab_ccas.school_name = 137 THEN 'Sekolah Rendah Semabat'
                WHEN kelab_ccas.school_name = 138 THEN 'Sekolah Rendah Sengkurong'
                WHEN kelab_ccas.school_name = 139 THEN 'Sekolah Rendah Serasa'
                WHEN kelab_ccas.school_name = 140 THEN 'Sekolah Rendah Sinaut'
                WHEN kelab_ccas.school_name = 141 THEN 'Sekolah Rendah Subok'
                WHEN kelab_ccas.school_name = 142 THEN 'Sekolah Rendah Sultan Abdul Bubin'
                WHEN kelab_ccas.school_name = 143 THEN 'Sekolah Rendah Sultan Hasan Bangar'
                WHEN kelab_ccas.school_name = 144 THEN 'Sekolah Rendah Sultan Hashim'
                WHEN kelab_ccas.school_name = 145 THEN 'Sekolah Rendah Sungai Liang'
                WHEN kelab_ccas.school_name = 146 THEN 'Sekolah Rendah Sungai Siamas'
                WHEN kelab_ccas.school_name = 147 THEN 'Sekolah Rendah Sungai Tali'
                WHEN kelab_ccas.school_name = 148 THEN 'Sekolah Rendah Sungai Teraban'
                WHEN kelab_ccas.school_name = 149 THEN 'Sekolah Rendah Tanah Jambu'
                WHEN kelab_ccas.school_name = 150 THEN 'Sekolah Rendah Tanjong Kindana'
                WHEN kelab_ccas.school_name = 151 THEN 'Sekolah Rendah Tumpuan Telisai'
                WHEN kelab_ccas.school_name = 152 THEN 'Sekolah Rendah Tungku'
                WHEN kelab_ccas.school_name = 153 THEN 'Sekolah Rendah Tutong Kem'
                WHEN kelab_ccas.school_name = 155 THEN 'Sekolah Rendah Orang Kaya Ali Wanika Setia Diraja Kupan'
                ELSE NULL END"));
        })
        ->select('student_inv.*')
        ->where('kelab_ccas.year', 2023)
        ->whereIn('kelab_ccas.school_name', [1, 2, 3, 4, 5, 6, 
        
                                            7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 
                                            24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 37, 154,
                                            
                                            36, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 
                                            54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 
                                            70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85,
                                            86, 87, 88, 89, 90, 91, 92, 93, 94, 95, 96, 97, 98, 99, 100, 101, 
                                            102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114,
                                            115, 116, 117, 118, 119, 120, 121, 122, 123, 124, 125, 126, 127, 
                                            128, 129, 130, 131, 132, 133, 134, 135, 136, 137, 138, 139, 140,
                                            141, 142, 143, 144, 145, 146, 147, 148, 149, 150, 151, 152, 153, 155])
        ->orderBy(DB::raw("CAST(kelab_ccas.school_name AS INT)"), 'asc')
        ->get();

        // Find the school associated with the given ID
        $selectedSchool = $schoolname->firstWhere('id', $id);

        if (!$selectedSchool) {
            // Handle the case where the school with the given ID is not found
            // You can return an error message or redirect to an error page
            return abort(404); // For example, return a 404 Not Found error
        }

        $schoolTotals = [];

        // Initialize variables
        $jumlahPraSekolah = 0;
        $jumlahTahun1 = 0;
        $jumlahTahun2 = 0;
        $jumlahTahun3 = 0;
        $jumlahTahun4 = 0;
        $jumlahTahun5 = 0;
        $jumlahTahun6 = 0;
        $jumlahTahun7 = 0;
        $jumlahTahun8 = 0;
        $jumlahTahun9 = 0;
        $jumlahTahun10 = 0;
        $jumlahTahun11 = 0;
        $jumlahEnamBawah = 0;
        $jumlahEnamAtas = 0;

        // Check if there is corresponding data in StudentInv for this school
        $studentData = $studentInv->where('school_name', $schoolNameMapping[$schoolData->school_name])->first();

        if ($studentData) {
            // Use data from StudentInv if it exists
            $jumlahPraSekolah = $studentData->pra_sekolah;
            $jumlahTahun1 = $studentData->tahun_1;
            $jumlahTahun2 = $studentData->tahun_2;
            $jumlahTahun3 = $studentData->tahun_3;
            $jumlahTahun4 = $studentData->tahun_4;
            $jumlahTahun5 = $studentData->tahun_5;
            $jumlahTahun6 = $studentData->tahun_6;
            $jumlahTahun7 = $studentData->tahun_7;
            $jumlahTahun8 = $studentData->tahun_8;
            $jumlahTahun9 = $studentData->tahun_9;
            $jumlahTahun10 = $studentData->tahun_10;
            $jumlahTahun11 = $studentData->tahun_11;
            $jumlahEnamBawah = $studentData->prau_1;
            $jumlahEnamAtas = $studentData->prau_2;
        } else {
            // Use data from CCA if no data in StudentInv
            $jumlahPraSekolah = $schoolData->jum_lelaki_pra + $schoolData->jum_perempuan_pra;
            $jumlahTahun1 = $schoolData->jum_lelaki_3 + $schoolData->jum_perempuan_3;
            $jumlahTahun2 = $schoolData->jum_lelaki_2 + $schoolData->jum_perempuan_2;
            $jumlahTahun3 = $schoolData->jum_lelaki_3 + $schoolData->jum_perempuan_3;
            $jumlahTahun4 = $schoolData->jum_lelaki_4 + $schoolData->jum_perempuan_4;
            $jumlahTahun5 = $schoolData->jum_lelaki_5 + $schoolData->jum_perempuan_5;
            $jumlahTahun6 = $schoolData->jum_lelaki_6 + $schoolData->jum_perempuan_6;
            $jumlahTahun7 = $schoolData->jum_lelaki_7 + $schoolData->jum_perempuan_7;
            $jumlahTahun8 = $schoolData->jum_lelaki_8 + $schoolData->jum_perempuan_8;
            $jumlahTahun9 = $schoolData->jum_lelaki_9 + $schoolData->jum_perempuan_9;
            $jumlahTahun10 = $schoolData->jum_lelaki_10 + $schoolData->jum_perempuan_10;
            $jumlahTahun11 = $schoolData->jum_lelaki_11 + $schoolData->jum_perempuan_11;
            $jumlahEnamBawah = $schoolData->jum_lelaki_12 + $schoolData->jum_perempuan_12;
            $jumlahEnamAtas = $schoolData->jum_lelaki_13 + $schoolData->jum_perempuan_13;
        }

        // Use the school's ID as the key in the $schoolTotals array
        $schoolTotals[$schoolData->id] = [
            'jumlahPraSekolah' => $jumlahPraSekolah,
            'jumlahTahun1' => $jumlahTahun1,
            'jumlahTahun2' => $jumlahTahun2,
            'jumlahTahun3' => $jumlahTahun3,
            'jumlahTahun4' => $jumlahTahun4,
            'jumlahTahun5' => $jumlahTahun5,
            'jumlahTahun6' => $jumlahTahun6,
            'jumlahTahun7' => $jumlahTahun7,
            'jumlahTahun8' => $jumlahTahun8,
            'jumlahTahun9' => $jumlahTahun9,
            'jumlahTahun10' => $jumlahTahun10,
            'jumlahTahun11' => $jumlahTahun11,
            'jumlahEnamBawah' => $jumlahEnamBawah,
            'jumlahEnamAtas' => $jumlahEnamAtas,
        ];


        // Calculate total students for all levels
        $totalStudentsPraSekolah = array_sum(array_column($schoolTotals, 'jumlahPraSekolah'));
        $totalStudentsTahun1 = array_sum(array_column($schoolTotals, 'jumlahTahun1'));
        $totalStudentsTahun2 = array_sum(array_column($schoolTotals, 'jumlahTahun2'));
        $totalStudentsTahun3 = array_sum(array_column($schoolTotals, 'jumlahTahun3'));
        $totalStudentsTahun4 = array_sum(array_column($schoolTotals, 'jumlahTahun4'));
        $totalStudentsTahun5 = array_sum(array_column($schoolTotals, 'jumlahTahun5'));
        $totalStudentsTahun6 = array_sum(array_column($schoolTotals, 'jumlahTahun6'));
        $totalStudentsTahun7 = array_sum(array_column($schoolTotals, 'jumlahTahun7'));
        $totalStudentsTahun8 = array_sum(array_column($schoolTotals, 'jumlahTahun8'));
        $totalStudentsTahun9 = array_sum(array_column($schoolTotals, 'jumlahTahun9'));
        $totalStudentsTahun10 = array_sum(array_column($schoolTotals, 'jumlahTahun10'));
        $totalStudentsTahun11 = array_sum(array_column($schoolTotals, 'jumlahTahun11'));
        $totalStudentsEnamBawah = array_sum(array_column($schoolTotals, 'jumlahEnamBawah'));
        $totalStudentsEnamAtas = array_sum(array_column($schoolTotals, 'jumlahEnamAtas'));

        return view('inventory.datakeramaianedit', compact('id', 'source', 'schoolname', 'schoolNameMapping', 'selectedSchool', 'studentInv', 'schoolTotals', 'schoolData', 'schoolData', 
                                                            'totalStudentsPraSekolah', 'totalStudentsTahun1', 'totalStudentsTahun2', 'totalStudentsTahun3', 'totalStudentsTahun4', 
                                                            'totalStudentsTahun5', 'totalStudentsTahun6', 'totalStudentsTahun7', 'totalStudentsTahun8', 'totalStudentsTahun9', 'totalStudentsTahun10',
                                                            'totalStudentsTahun11', 'totalStudentsEnamBawah', 'totalStudentsEnamAtas'));
    }

    public function datakeramaianupdate(Request $request, $id)
    {
        // Fetch the specific school's data based on $id
        $school = CCA::where('year', 2023)
            ->whereIn('school_name', [1, 2, 3, 4, 5, 6, 7, 
        
                                        8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 
                                        24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 37, 154,
                                        
                                        36, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 
                                        54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 
                                        70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85,
                                        86, 87, 88, 89, 90, 91, 92, 93, 94, 95, 96, 97, 98, 99, 100, 101, 
                                        102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114,
                                        115, 116, 117, 118, 119, 120, 121, 122, 123, 124, 125, 126, 127, 
                                        128, 129, 130, 131, 132, 133, 134, 135, 136, 137, 138, 139, 140,
                                        141, 142, 143, 144, 145, 146, 147, 148, 149, 150, 151, 152, 153, 155])
            ->where('id', $id)
            ->firstOrFail(); // Assuming you want to fetch a single school

        // Define a mapping of numerical school_name values to school names
        $schoolNameMapping = [
            1 => 'Maktab Sains PSBS',
            2 => 'Maktab Duli PMAMB',
            3 => 'PTE Belait',
            4 => 'PTE Meragang',
            5 => 'PTE Sengkurong',
            6 => 'PTE Tutong',

            7 => 'Maktab Anthony Abell Seria',
            8 => 'Maktab Sultan Omar Ali Saifuddien',
            9 => 'STPRI', 
            10 => 'SM Sultan Sharif Ali', 
            11 => 'SM Awang Semaun', 
            12 => 'SM Berakas', 
            13 => 'SM Katok', 
            14 => 'SM Lambak Kiri', 
            15 => 'SM Masin', 
            16 => 'SM Menglait', 
            17 => 'SM Muda Hashim', 
            18 => 'SM PAP Hajah Rashidah Saadatul Bolkiah', 
            19 => 'SM Pehin Dato Seri Maharaja', 
            20 => 'SM Pengiran Anak Puteri Hajah Masna', 
            21 => 'SM Pengiran Isteri Hajah Mariam',
            22 => 'SM Pengiran Jaya Negara Pengiran Haji Abu Bakar', 
            23 => 'SM Perdana Wazir', 
            24 => 'SM Raja Isteri Pengiran Anak Saleha', 
            25 => 'SM Rimba', 
            26 => 'SM Rimba II', 
            27 => 'SM Sayyidina Abu Bakar', 
            28 => 'SM Sayyidina Ali', 
            29 => 'SM Sultan Hassan Bangar, Temburong',
            30 => 'SM Sayyidina Husain', 
            31 => 'SM Sayyidina Othman', 
            32 => 'SM Sayyidina Umar Al-Khattab', 
            33 => 'SM Sufri Bolkiah', 
            34 => 'SM Sayyidina Hasan', 
            35 => 'SM Sultan Muhammad Jamalul Alam',
            154 => 'SM Tanjong Maya Tutong',
            37 => 'Sekolah Sukan',

            36 => 'Sekolah Rendah Abdul Rashid, Tanjong Maya',
            39 => 'Sekolah Rendah Ahmad Tajuddin',
            40 => 'Sekolah Rendah AHMY Katimahar',
            41 => 'Sekolah Rendah Amar Pahlawan',
            42 => 'Sekolah Rendah Amo',
            43 => 'Sekolah Rendah Anggerek Desa',
            44 => 'Sekolah Rendah Angkatan Tentera Laut',
            45 => 'Sekolah Rendah Bakiau',
            46 => 'Sekolah Rendah Batang Mitus',
            47 => 'Sekolah Rendah Batu Marang',
            48 => 'Sekolah Rendah Bebuloh',
            49 => 'Sekolah Rendah Bendahara Lama',
            50 => 'Sekolah Rendah Bendahara Sakam Bunut',
            51 => 'Sekolah Rendah Bengkurong',
            52 => 'Sekolah Rendah Benutan',
            53 => 'Sekolah Rendah Berakas Garisson',
            54 => 'Sekolah Rendah Beribi Telanai',
            55 => 'Sekolah Rendah Binturan',
            56 => 'Sekolah Rendah Birau',
            57 => 'Sekolah Rendah Bukit Panggal',
            58 => 'Sekolah Rendah Bukit Udal',
            59 => 'Sekolah Rendah Danau',
            60 => 'Sekolah Rendah Dato Basir',
            61 => 'Sekolah Rendah Dato Maharaja Setia Dian Sukang',
            62 => 'Sekolah Rendah Dato Mahawangsa Lambak',
            63 => 'Sekolah Rendah Dato Marsal',
            64 => 'Sekolah Rendah Dato Mohd Yassin',
            65 => 'Sekolah Rendah Dato Othman',
            66 => 'Sekolah Rendah Dato Pemancha Saging Ukong',
            67 => 'Sekolah Rendah Dato Ratna Haji Muhammad Jaafar',
            68 => 'Sekolah Rendah Delima Satu',
            69 => 'Sekolah Rendah Haji Mohd Jaafar Maun',
            70 => 'Sekolah Rendah Haji Mohd Salleh',
            71 => 'Sekolah Rendah Haji Tarif',
            72 => 'Sekolah Rendah Jerudong',
            73 => 'Sekolah Rendah Junjongan',
            74 => 'Sekolah Rendah Kampong Bukit',
            75 => 'Sekolah Rendah Kampong Bukit Beruang II',
            76 => 'Sekolah Rendah Kampong Mata-Mata',
            77 => 'Sekolah Rendah Kampong Menengah',
            78 => 'Sekolah Rendah Kampong Perpindahan Lambak Kanan Jalan',
            79 => 'Sekolah Rendah Kapok',
            80 => 'Sekolah Rendah Kasat',
            81 => 'Sekolah Rendah Katok A',
            82 => 'Sekolah Rendah Katok B',
            83 => 'Sekolah Rendah Keriam',
            84 => 'Sekolah Rendah Kiudang',
            85 => 'Sekolah Rendah Kuala Belait',
            86 => 'Sekolah Rendah Kupang',
            87 => 'Sekolah Rendah Labi',
            88 => 'Sekolah Rendah Labu Estate',
            89 => 'Sekolah Rendah Lambak Kanan Jalan',
            90 => 'Sekolah Rendah Lamunin',
            91 => 'Sekolah Rendah Lubok Pulau',
            92 => 'Sekolah Rendah Lumapas',
            93 => 'Sekolah Rendah Lumut',
            94 => 'Sekolah Rendah Mabohai',
            95 => 'Sekolah Rendah Masin',
            96 => 'Sekolah Rendah Melilas',
            97 => 'Sekolah Rendah Mentiri',
            98 => 'Sekolah Rendah Merangking',
            99 => 'Sekolah Rendah Muda Hashim',
            100 => 'Sekolah Rendah Muhammad Alam',
            101 => 'Sekolah Rendah Mulaut',
            102 => 'Sekolah Rendah Nakhoda Abdul Rashid Menunggol',
            103 => 'Sekolah Rendah Negalang',
            104 => 'Sekolah Rendah OKSB Kilanas',
            105 => 'Sekolah Rendah Paduka Seri Begawan SOAS',
            106 => 'Sekolah Rendah Panaga',
            107 => 'Sekolah Rendah Panchong',
            108 => 'Sekolah Rendah Panchor Murai',
            109 => 'Sekolah Rendah Panglima Barudin',
            110 => 'Sekolah Rendah Pantai Berakas',
            111 => 'Sekolah Rendah PAP Besar Sungai Kebun',
            112 => 'Sekolah Rendah Pehin Dato Jamil',
            113 => 'Sekolah Rendah Penanjong',
            114 => 'Sekolah Rendah Penapar',
            115 => 'Sekolah Rendah Pengiran Dipa Negara Pengiran Jaya Sengkarai',
            116 => 'Sekolah Rendah Pengiran Muda Mahkota',
            117 => 'Sekolah Rendah Pengiran Pekerma Setia Diraja Sahibul Bandar',
            118 => 'Sekolah Rendah Pengiran Setia Jaya Pengiran Abdul Momin',
            119 => 'Sekolah Rendah Pengkalan Batu',
            120 => 'Sekolah Rendah Pg Setia Negara Pg Mohd Yusof',
            121 => 'Sekolah Rendah Pintu Malim',
            122 => 'Sekolah Rendah PKN Bukit Beruang',
            123 => 'Sekolah Rendah Pulaie',
            124 => 'Sekolah Rendah Puni',
            125 => 'Sekolah Rendah Pusar Ulak',
            126 => 'Sekolah Rendah Putat',
            127 => 'Sekolah Rendah Raja Isteri Fatimah',
            128 => 'Sekolah Rendah Rambai',
            129 => 'Sekolah Rendah Rataie',
            130 => 'Sekolah Rendah Rimba I',
            131 => 'Sekolah Rendah Rimba II',
            132 => 'Sekolah Rendah Rimba III',
            133 => 'Sekolah Rendah S.U.A.S Muara',
            134 => 'Sekolah Rendah Saba Darat',
            135 => 'Sekolah Rendah Selangan',
            136 => 'Sekolah Rendah Selapon',
            137 => 'Sekolah Rendah Semabat',
            138 => 'Sekolah Rendah Sengkurong',
            139 => 'Sekolah Rendah Serasa',
            140 => 'Sekolah Rendah Sinaut',
            141 => 'Sekolah Rendah Subok',
            142 => 'Sekolah Rendah Sultan Abdul Bubin',
            143 => 'Sekolah Rendah Sultan Hasan Bangar',
            144 => 'Sekolah Rendah Sultan Hashim',
            145 => 'Sekolah Rendah Sungai Liang',
            146 => 'Sekolah Rendah Sungai Siamas',
            147 => 'Sekolah Rendah Sungai Tali',
            148 => 'Sekolah Rendah Sungai Teraban',
            149 => 'Sekolah Rendah Tanah Jambu',
            150 => 'Sekolah Rendah Tanjong Kindana',
            151 => 'Sekolah Rendah Tumpuan Telisai',
            152 => 'Sekolah Rendah Tungku',
            153 => 'Sekolah Rendah Tutong Kem',
            155 => 'Sekolah Rendah Orang Kaya Ali Wanika Setia Diraja Kupang',
        ];

        // Validate the form data
        $validatedData = $request->validate([
            'pra_sekolah' => 'integer',
            'tahun_1' => 'integer',
            'tahun_2' => 'integer',
            'tahun_3' => 'integer',
            'tahun_4' => 'integer',
            'tahun_5' => 'integer',
            'tahun_6' => 'integer',
            'tahun_7' => 'integer',
            'tahun_8' => 'integer',
            'tahun_9' => 'integer',
            'tahun_10' => 'integer',
            'tahun_11' => 'integer',
            'prau_1' => 'integer',
            'prau_2' => 'integer',
        ]);

        // Retrieve the specific school data based on the ID
        $schoolData = CCA::find($id);

        // Ensure that $schoolData is not null
        if (!$schoolData) {
            // Handle the case where the school with the given ID does not exist
            abort(404); // You can customize this error handling as needed
        }

        // Determine the source based on the school_name value
        if ($schoolData->school_name >= 2 && $schoolData->school_name <= 6) {
            $source = 'PTE';
        } 
        
        elseif (
            ($schoolData->school_name >= 7 && $schoolData->school_name <= 35)
            || $schoolData->school_name == 37
            || $schoolData->school_name == 154
        ) {
            $source = 'SM';
        } 
        
        elseif (
            ($schoolData->school_name >= 39 && $schoolData->school_name <= 153)
            || $schoolData->school_name == 36
            || $schoolData->school_name == 155
        ) {
            $source = 'SR';
        } 
        
        elseif ( $schoolData->school_name == 1 ) {
            $source = 'SM/PTE';
        }

        // Get the logged-in user's ic_no
        $icNo = Auth::user()->ic_no;

        // Get the current year
        $currentYear = Carbon::now()->year;

        // Update or create a record in the StudentInv model
        StudentInv::updateOrCreate(
            [
                'school_name' => $schoolNameMapping[$school->school_name],
                'edited_by' => $icNo,
            ],
            [
                'level' => $source,
                'year' => $currentYear, 
                'pra_sekolah' => $request->input('pra_sekolah'),
                'tahun_1' => $request->input('tahun_1'),
                'tahun_2' => $request->input('tahun_2'),
                'tahun_3' => $request->input('tahun_3'),
                'tahun_4' => $request->input('tahun_4'),
                'tahun_5' => $request->input('tahun_5'),
                'tahun_6' => $request->input('tahun_6'),
                'tahun_7' => $request->input('tahun_7'),
                'tahun_8' => $request->input('tahun_8'),
                'tahun_9' => $request->input('tahun_9'),
                'tahun_10' => $request->input('tahun_10'),
                'tahun_11' => $request->input('tahun_11'),
                'prau_1' => $request->input('prau_1'),
                'prau_2' => $request->input('prau_2'),
            ]
        );

        // Now that the data is updated or created, you can return the view
        return redirect()->route('inventory.datakeramaianindex')
            ->with('success_message', 'Data updated successfully.');
    }

}
