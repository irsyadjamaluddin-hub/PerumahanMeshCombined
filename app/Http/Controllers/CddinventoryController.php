<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;
use App\Models\Employment;
use App\Models\Biodata;
use App\Models\School;
use App\Models\Inventory;
use App\Models\InventoryBbk;
use App\Models\Inventorybp;
use App\Models\InventorySebutharga;
use App\Models\InventoryShBk;
use App\Models\deptInventorySh;
use App\Models\InventoryShdept;
use App\Models\InventoryShdeptorder;
use App\Models\InventoryBookKategori;
use App\Models\InventoryBaucerBuku;
use App\Models\CddGuruBesarPengetua;
use Barryvdh\DomPDF\Facade as PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\InventoryBook;
use App\Models\InventoryBaucerPembekal;
use App\Models\Department;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

use App\Mail\AmendmentsCompletedMail;
use ZipArchive;
use Illuminate\Support\Facades\Storage;

use App\Mail\EmailVendorSebutharga;
use App\Mail\QuerySubmittedMail;
use App\Models\InventoryBorangPengeluaran;
use App\Mail\EmailPermohonanBahanKurikulum;
use App\Mail\AmendmentRequiredMail;
use App\Mail\ApprovedMail;
use App\Mail\BorangPenerimaanMail;
use Illuminate\Support\Facades\Mail;

//this is for excel
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

//push notiication
use Illuminate\Support\Facades\DB;
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;




use Carbon\Carbon;
use App\Models\Ppk;


class CddinventoryController extends Controller
{

    //openform

    public function isiborangpenerimaan($id)
{
    $departments = Department::pluck('label', 'id')->all();
    $inventoryshbook= InventoryShBk::all()
    ->where('sh_id', '=', $id);


    $inventoryshdept = InventoryShdept::where('sh_id', $id)->get();

    
    // Fetch data from inventory_shdept_order table
    $inventoryshdeptorder = InventoryShdeptOrder::where('sh_id', $id)->get();

    

    return view('inventorypenerimaanbuku', compact('departments','inventoryshbook','inventoryshdept','inventoryshbook','inventoryshdeptorder'));
}

  //notify in super admin
public function notify($inventory_id)
{
    $inventory = Inventory::findOrFail($inventory_id);

    return view('cddinventory.notify', compact('inventory'));
}

public function sendNotificationold(Request $request, $inventory_id)
{
    $request->validate([
        'message' => 'required|string',
    ]);

    $inventory = Inventory::findOrFail($inventory_id);
    $messageBody = $request->input('message');

    // Check if send_email checkbox was ticked
    if ($request->has('send_email') && $request->input('send_email') == '1') {
        \Mail::to($inventory->emel)->send(new \App\Mail\InventoryNotification($inventory, $messageBody));

    }

    return redirect()->route('cddinventory.cddinventory.indexadmin')
                     ->with('success_message', 'Notification processed successfully!');
}

public function sendNotification(Request $request, $inventory_id)
{
    $inventory = Inventory::findOrFail($inventory_id);

    // Only validate message if send_email checkbox is checked
    if ($request->has('send_email') && $request->input('send_email') == '1') {
        $request->validate([
            'message' => 'required|string',
        ]);

        $messageBody = $request->input('message');
        \Mail::to($inventory->emel)->send(new \App\Mail\InventoryNotification($inventory, $messageBody));
    }

    return redirect()->route('cddinventory.cddinventory.indexadmin')
                     ->with('success_message', 'Notification processed successfully!');
}

public function create(Request $request)
{
    $icNos = Auth::user()->ic_no;

    $employments = Employment::where('ic_no', $icNos)->get();
    $biodatas    = Biodata::where('ic_no', $icNos)->get();
    $sekolah     = School::pluck('label','id');
    $gurubesar   = CddGuruBesarPengetua::all();
    $allBooks    = InventoryBook::all();

    $pagename = 'Cddinventory'; // Add this

    return view('cddinventory.create', compact(
        'gurubesar', 'employments', 'biodatas', 'sekolah', 'allBooks', 'pagename'
    ));
}


    // YourController.php
public function getKgpNama($nama_sch)
{
    // Fetch data from the database
    $kgpData = CddGuruBesarPengetua::where('school', $nama_sch)
                 ->get(['name', 'ic_no','email','phone_number']); // Get both name and ic_no
    
    return response()->json($kgpData);
}


    public function fetchInfo($isbn)
{
    try {
        $book = InventoryBook::where('isbn', $isbn)->firstOrFail();

        return response()->json([
            'kategori' => $book->kategori,
            'judul' => $book->judul,
            'pengarang_penerbit' => $book->pengarang_penerbit,
        ]);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json(['error' => 'Book not found'], 404);
    }
}


//Inventory Book Start
public function createbook()
{

    $icNos = Auth::user()->ic_no;

    $kategoribuku = InventoryBookKategori::orderBy('kategori', 'ASC')
                ->pluck('kategori', 'id')
                ->all();

    return view('cddinventory.createbook', compact('kategoribuku'));
}

public function storebook(Request $request)
{

    $icNos = Auth::user()->ic_no;
    $now = Carbon::now();

    // Get the data from the request
    $sekolah = $request->sekolah;
    $subjek = $request->kategori;
    $judul = $request->judul;
    $pengarang = $request->pengarang;
    $isbn = $request->isbn;
    $penerbit = $request->penerbit;
    $peringkat = $request->peringkat;
    $jenisbuku = $request->jenisbuku;
    $tahunterbitan = $request->tahunterbitan;
    $status = $request->status;
    $catatan = $request->catatan;
    $sukatanpelajaran = $request->sukatanpelajaran;
    $created_at = $now;
    $created_by = $icNos;

    $insert_data = []; // Initialize the array before the loop

    for ($i = 0; $i < count($judul); $i++) {
        $data = array(
            'sekolah' => $request->sekolah[$i],
            'subjek' => $request->kategori[$i],
            'judul' => $request->judul[$i],
            'pengarang' => $request->pengarang[$i],
            'isbn' => $request->isbn[$i],
            'penerbit' => $request->penerbit[$i],
            'peringkat' => $request->peringkat[$i],
            'jenisbuku' => $request->jenisbuku[$i],
            'tahunterbitan' => $request->tahunterbitan[$i],
            'status' => $request->status[$i],
            'catatan' => $request->catatan[$i],
            'sukatanpelajaran' => $request->sukatanpelajaran[$i],
            'created_at' => $now,
            'created_by' => $icNos,
        );

        $insert_data[] = $data;
    }

    // Save the data
    InventoryBook::insert($insert_data);

    return redirect()->route('cddinventory.cddinventory.indexbook')
        ->with('success_message', 'Buku telah di tambah!');
}

public function editbook($id)
{

    $icNos = Auth::user()->ic_no;
    
    $employments = Employment::all()
                    ->where('ic_no', '=', $icNos);

    $biodatas = Biodata::all()
    ->where('ic_no', '=', $icNos);

    $sekolah= School::pluck('label','id')->all();

    $inventorybook = InventoryBook::with('kategori')->findOrFail($id);

    $kategoribuku = InventoryBookKategori::orderBy('kategori', 'ASC')
                ->pluck('kategori', 'id')
                ->all();

    return view('cddinventory.editbook', compact('employments','biodatas','sekolah','inventorybook','kategoribuku'));
}

public function updatebook(Request $request)
{

    $icNos = Auth::user()->ic_no;
    $now = Carbon::now();

    $inventoryid = $request->id;

    $inventorybook =  InventoryBook::findorFail($inventoryid)
    ->update([
        'sekolah' => $request->sekolah,
        'subjek' => $request->kategori,
        'judul' => $request->judul,
        'pengarang' => $request->pengarang,
        'isbn' => $request->isbn,
        'penerbit' => $request->penerbit,
        'peringkat' => $request->peringkat,
        'jenisbuku' => $request->jenisbuku,
        'tahunterbitan' => $request->tahunterbitan,
        'status' => $request->status,
        'catatan' => $request->catatan,
        'sukatanpelajaran' => $request->sukatanpelajaran,
        'updated_at' => $now,
        'updated_by' => $icNos
    ]);

    return redirect()->route('cddinventory.cddinventory.indexbook')
        ->with('success_message', 'Buku telah di tukar!');
}

public function destroybook($id)
{
    try {

        $inventorybook = InventoryBook::where('id', $id)->delete();

        return redirect()->route('cddinventory.cddinventory.indexbook')
        ->with('success_message', 'Buku telah di delete!');
        
    } catch (Exception $exception) {

        return back()->withInput()
            ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
    }
}


public function createbooksubject()
{

    $icNos = Auth::user()->ic_no;

    $booksubjects = InventoryBookKategori::select('inventory_book_kategori.*')
                ->orderBy('kategori', 'ASC')
                ->get();

    return view('cddinventory.booksubject', compact('booksubjects'));
}

public function editbooksubject($id)
{

    $icNos = Auth::user()->ic_no;

    $booksubjects = InventoryBookKategori::select('inventory_book_kategori.*')
                ->where('id', $id)
                ->first();

    return view('cddinventory.editbooksubject', compact('booksubjects'));
}

public function storebooksubject(Request $request)
{

    $icNos = Auth::user()->ic_no;
    $now = Carbon::now();

    $booksubjects = new InventoryBookKategori;

    $booksubjects->kategori = $request->kategori;
    $booksubjects->created_at = $now;

    $booksubjects->save();

    return redirect()->back()
        ->with('success_message', 'Subject telah di tambah!');
}

public function updatebooksubject(Request $request)
{

    $icNos = Auth::user()->ic_no;
    $now = Carbon::now();

    $booksubjectsid = $request->id;

    $booksubjects =  InventoryBookKategori::findorFail($booksubjectsid)
    ->update([
        'kategori' => $request->kategori,
    ]);

    return redirect()->route('cddinventory.cddinventory.createbooksubject')
        ->with('success_message', 'Subjek telah di tukar!');
}

public function destroybooksubject($id)
{
    try {

        $booksubjects = InventoryBookKategori::where('id', $id)->delete();

        return redirect()->back()
        ->with('success_message', 'Subject telah di delete!');
        
    } catch (Exception $exception) {

        return back()->withInput()
            ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
    }
}

//Inventory Book End

    public function createsebuthargaform()
    {

        $icNos = Auth::user()->ic_no;
        
	    $employments = Employment::all()
						->where('ic_no', '=', $icNos);

        $biodatas = Biodata::all()
        ->where('ic_no', '=', $icNos);

        $sekolah= School::pluck('label','id')->all();

        // Fetch ISBN options from the database
        $isbnOptions = InventoryBook::pluck('isbn')->toArray();
        
        // Fetch information for all ISBNs
        $allBooks = InventoryBook::all();

    $departments = Department::pluck('label', 'id')->all();


     

        return view('cddinventory.sebuthargaform', compact('employments','biodatas','sekolah','allBooks','isbnOptions','departments'));
    }

    

    public function createunit()
{
    $icNos = Auth::user()->ic_no;
    
    $employments = Employment::all()
        ->where('ic_no', '=', $icNos);

    $biodatas = Biodata::all()
        ->where('ic_no', '=', $icNos);

    $sekolah = School::pluck('label','id')->all();

    $allBooks = InventoryBook::all();

    // Fetch all PPK records
    $ppks = Ppk::all();

    return view('cddinventory.createunit', compact('employments', 'biodatas', 'sekolah', 'allBooks', 'ppks'));
}


public function store(Request $request)
{
    $icNos = Auth::user()->ic_no;
    $now = Carbon::now();

    // Fetch the selected PPK record
    $ppk = Ppk::find($request->ppk_id);

    $inventory = new Inventory;

    // Applicant / GB info from form
    $inventory->nama_sch = $request->nama_sch;
    $inventory->unit = $request->unit;
    $inventory->jabatan = $request->jabatan;
    $inventory->kluster = $request->kluster;
    $inventory->no_tel = $request->no_tel;
    $inventory->ic_no = $icNos;
    $inventory->nama = $request->nama;
    $inventory->emel = $request->emel;

    // PPK info from database
    $inventory->ppk_nama = $ppk ? $ppk->name : null;
    $inventory->ppk_ic_no = $ppk ? $ppk->ic_no : null;
    $inventory->ppk_emel = $ppk ? $ppk->email : null;
    $inventory->ppk_phone_number = $ppk ? $ppk->phone : null;

    // Guru Besar info from form input
    $inventory->kgp_nama = $request->kgp_nama ?? null;
    $inventory->kgp_ic_no = $request->kgp_ic_no ?? null;
    $inventory->kgp_emel = $request->kgp_emel ?? null;
    $inventory->kgp_phone_number = $request->kgp_phone_number ?? null;

    $inventory->created_at = $now;
    $inventory->save();

    $inventoryId = $inventory->id; // Assign the inventory ID after save

    $data1 = Inventory::orderBy('created_at', 'DESC')->first();
    $data2 = $data1->id;

    // --- Email to Guru Besar ---
    if (!empty($inventory->kgp_emel)) {
        Mail::to($inventory->kgp_emel)->send(
            new EmailPermohonanBahanKurikulum(
                $inventory->kgp_emel,
                $inventory->kgp_nama,
                $inventory->nama_sch,
                $inventory->nama,
                $inventory->created_at,
                $inventoryId
            )
        );
    }

    // --- Email to PPK ---
    if (!empty($inventory->ppk_emel)) {
        Mail::to($inventory->ppk_emel)->send(
            new EmailPermohonanBahanKurikulum(
                $inventory->ppk_emel,
                $inventory->ppk_nama,
                $inventory->nama_sch,
                $inventory->nama,
                $inventory->created_at,
                $inventoryId
            )
        );
    }

    // --- Save Bahan-Bahan Kurikulum (BBK) ---
    if (!empty($request->matapelajaran) && is_array($request->matapelajaran)) {
        $insert_data = [];

        $data1 = Inventory::orderBy('created_at', 'DESC')->first();
        $data2 = $data1->id;
        for ($i = 0; $i < count($request->matapelajaran); $i++) {
            $insert_data[] = [
                'inventory_id' => $data2,
                'matapelajaran' => $request->matapelajaran[$i] ?? null,
                'judulbahan' => $request->judulbahan[$i] ?? null,
                'isbn' => $request->isbn[$i] ?? null,
                'pengarang_penerbit' => $request->pengarang_penerbit[$i] ?? null,
                'qty_dipohonkan' => $request->qty_dipohonkan[$i] ?? null,
                'sebab_permohonan' => $request->sebab_permohonan[$i] ?? null,
                'cdd_status' => $request->cdd_status[$i] ?? null,
                'cdd_qty_diluluskan' => $request->cdd_qty_diluluskan[$i] ?? null,
                'cdd_catatan' => $request->cdd_catatan[$i] ?? null,
                'created_at' => $now,
            ];
        }

        InventoryBbk::insert($insert_data);
    }

    return redirect()->route('cddinventory.cddinventory.index')
                     ->with('success_message', 'Borang telah berjaya dihantar');
}




public function storepenerimaanworking(Request $request)
{
    // Get the current date and time
    $now = Carbon::now();

    // Loop through form inputs
    foreach ($request->all() as $key => $value) {
        // Check if the input starts with 'penerima_'
        if (Str::startsWith($key, 'penerima_')) {
            $id = str_replace('penerima_', '', $key);

            // Update the record using the extracted 'id'
            InventoryShdept::where('id', $id)
                ->update([
                    'penerima'      => $request->input('penerima_' . $id),
                    'penerima_icno' => $request->input('penerima_icno_' . $id),
                    'no_do'         => $request->input('no_do_' . $id),
                    'date_recieve'  => $request->input('date_recieve_' . $id), // Use the correct input here
                    'updated_at'         => $now,


                ]);
        }
    }



    return redirect()->back()->with('success_message', 'Records were successfully updated!');
}

public function storePpk(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:ppks,email',
        'ic_no' => 'required|string|unique:ppks,ic_no',
        'phone' => 'nullable|string',
    ]);

    $ppk = Ppk::create($validated);

    // Always return JSON for AJAX
    return response()->json([
        'success' => true,
        'ppk' => $ppk
    ]);
}

public function storepenerimaan(Request $request)
{
    $now = now();

    foreach ($request->all() as $key => $value) {

        if (preg_match('/^penerima_(\d+)$/', $key, $matches)) {

            $id = $matches[1];

            $inventory = InventoryShdept::find($id);

            if (!$inventory) {
                continue;
            }

            $updateData = [
                'penerima'      => $request->input("penerima_$id"),
                'penerima_icno' => $request->input("penerima_icno_$id"),
                'no_do'         => $request->input("no_do_$id"),
                'date_recieve'  => $request->input("date_recieve_$id"),
                'updated_at'    => $now,
            ];

            if ($request->hasFile("file_$id")) {

                $file = $request->file("file_$id");

                $filename = time() . '_' . $file->getClientOriginalName();

                $filePath = $file->storeAs(
                    'inventoryborangpenerimaan',
                    $filename,
                    'public'
                );

                $updateData['file'] = $filePath;
            }

            $inventory->update($updateData);

            // Reload with relationships
            $inventory = InventoryShdept::with([
                'department',
                'inventorysebutharga'
            ])->find($id);

            /*
            |--------------------------------------------------------------------------
            | SEND EMAIL TO PPKS
            |--------------------------------------------------------------------------
            */

            $ppksUsers = Ppk::whereNotNull('email')->get();

            foreach ($ppksUsers as $ppks) {

                Mail::to($ppks->email)
                    ->send(
                        new BorangPenerimaanMail(
                            $inventory,
                            $ppks->name
                        )
                    );
            }

            /*
            |--------------------------------------------------------------------------
            | SEND EMAIL TO GURU BESAR / PENGETUA
            |--------------------------------------------------------------------------
            */

            $schoolName = $inventory->department->label ?? null;

            if ($schoolName) {

                $gbUsers = CddGurubesarPengetua::where('school', $schoolName)
                    ->whereNotNull('email')
                    ->get();

                foreach ($gbUsers as $gb) {

                    Mail::to($gb->email)
                        ->send(
                            new BorangPenerimaanMail(
                                $inventory,
                                $gb->name
                            )
                        );
                }
            }
        }
    }

    return redirect()->back()
        ->with('success_message', 'Records were successfully updated!');
}

public function storebp(Request $request)
{
    $icNos = Auth::user()->ic_no;
    $now = Carbon::now();

    // Update inventory data + mark bp_submitted = true
    Inventory::where('id', $request->id)
        ->update([
            'bp_catatan' => $request->bp_catatan,
            'bp_disahkan_nama' => $request->bp_disahkan_nama,
            'bp_disahkan_icno' => $icNos,
            'bp_disahkan_date' => $now,
            'bp_status' => 'adminapprove',
            'bp_submitted' => true,  // <-- Add this line
        ]);

    $data2 = $request->id;
    $bp_judulbahan = $request->bp_judulbahan;
    $bp_isbn = $request->bp_isbn;
    $bp_qty = $request->bp_qty;
    $bp_harga = $request->bp_harga;

    if (!empty($bp_judulbahan) && is_array($bp_judulbahan)) {
        $insert_data_1 = [];

        for ($count_1 = 0; $count_1 < count($bp_judulbahan); $count_1++) {
            $insert_data_1[] = [
                'inventory_id' => $data2,
                'bp_judulbahan' => $bp_judulbahan[$count_1],
                'bp_isbn' => $bp_isbn[$count_1] ?? null,
                'bp_qty' => $bp_qty[$count_1] ?? null,
                'bp_harga' => $bp_harga[$count_1] ?? null,
                'created_at' => $now,
            ];
        }

        Inventorybp::insert($insert_data_1);
    }

    return redirect()->back()
        ->with('success_message', 'Record was successfully updated!');
}


public function storesebutharga(Request $request)
{

    $icNos = Auth::user()->ic_no;
    $now = Carbon::now();
    
    // Table 1: main data
    $inventorysebutharga = new InventorySebutharga;

        $inventorysebutharga->bil_sh = $request->bil_sh; //nda pakai for time being
        $inventorysebutharga->bilangan_sebutharga = $request->bilangan_sebutharga; // NEW FIELD
        $inventorysebutharga->bil_po = $request->bil_po;
        $inventorysebutharga->pembekal = $request->pembekal;
        $inventorysebutharga->emel_pembekal = $request->emel_pembekal;
        $inventorysebutharga->created_by= $icNos; //save hiddenly
        $inventorysebutharga->created_at = $now; //save hiddenly
        $inventorysebutharga->updated_at = $now; //save hiddenly

    $inventorysebutharga->save();

    // end Table 2


    // method to take the sebutharga ID
    $data1 = InventorySebutharga::select('inventory_sebutharga.*')
    ->orderBy('created_at', 'DESC')
    ->first();

    $data2 = $data1->id; 

    // Table 2: Store buku ( take the id from table 1)


    // storing the buku2 info ( another database)
    $judul_bahan = $request->judul_bahan;
    $harga = $request->harga;
    $penulis_penerbit = $request->penulis_penerbit;
    $isbn = $request->isbn;
    $jum_bahan = $request->jum_bahan;

    if (!empty($request->judul_bahan) && is_array($judul_bahan) || !empty($request->harga) && is_array($harga)) {

        $insert_data_1 = []; // Initialize the array before the loop
    
        for ($count_1 = 0; $count_1 < count($judul_bahan); $count_1++) {
    
            $data_1 = array(
                'sh_id' => $data2, //previous ID
                'judul_bahan' => $judul_bahan[$count_1],
                'harga' => $harga[$count_1],
                'penulis_penerbit' => $penulis_penerbit[$count_1],
                'isbn' => $isbn[$count_1],
                'jum_bahan' => $jum_bahan[$count_1],
                'created_at' => $now
                
            );

    
            $insert_data_1[] = $data_1;
        }
    
        // Save 'Inventorybbk' data
        InventoryShBk::insert($insert_data_1);
    }

    // End Table 2


// Table:3 Store the School Details

$unit_sch = $request->unit_sch; //the schoolname

if (!empty($request->unit_sch) && is_array($unit_sch)) {

    $insert_data_2 = []; // Initialize the array before the loop

    foreach ($unit_sch as $unit) {

        $data_2 = [
            'sh_id' => $data2, //take the main id of sebutharga
            'unit_sch' => $unit,
            'created_at' => $now,
        ];

        $insert_data_2[] = $data_2;
    }

    // Save 'Inventoryshdept' data
    InventoryShdept::insert($insert_data_2);
}

// End Table 3

// Table 4: what the school ordered is here


    // Continue with your logic for storing unit book order
    $qty = $request->qty;
    $shbk_id = $request->shbk_id;
    $unit_sch_order = $request->unit_sch_order;


    if (!empty($request->qty) && is_array($qty)) {
        $insert_data_3 = []; // Initialize the array before the loop

        for ($count_3 = 0; $count_3 < count($qty); $count_3++) {
            $unitSch = isset($unit_sch[$count_3]) ? $unit_sch[$count_3] : null;

            $data_3 = [
                'sh_id' => $data2, //previous ID
                'shbk_id' => $shbk_id[$count_3], // Use the retrieved 'shbk_id'
                'unit_sch_order' => $unit_sch_order[$count_3],
                'qty' => $qty[$count_3],
                'created_at' => $now,
                'updated_at' => $now,
            ];

            $insert_data_3[] = $data_3;
        }

        // Save 'Inventoryshdeptorder' data
        InventoryShdeptorder::insert($insert_data_3);
    
}

// End Table 4




   

        return redirect()->route('cddinventory.cddinventory.indexsebutharga')
            ->with('success_message', 'Borang telah berjaya dihantar');

}

public function storeicnumber(Request $request,$id) {
    try {
        $inventory = Inventory::findOrFail($id);
        $icFileNames = $inventory->bp_icno ?? [];

        // Handle removing IC numbers
        if ($request->has('remove_icno')) {
            $removeIcnoIndexes = $request->input('remove_icno');
            $icFileCount = count($inventory->bp_icno);
            $icFileNames = $inventory->bp_icno ?? []; // Retrieve existing image filenames or initialize an empty array

            foreach ($removeIcnoIndexes as $index) {
                // Ensure the index is within the range of the ic_no array
                if ($index >= 0 && $index < $icFileCount) {
                    if (in_array($index, $removeIcnoIndexes)) {
                        // Remove the ic_no from the arrays
                        unset($icFileNames[$index]);
                    }
                }
            }

                // Reindex the arrays after removing elements
                $reindexedFileNames = array_values($icFileNames);

                // Save the updated result news file names and paths in the News model
                $inventory->setAttribute('bp_icno', $reindexedFileNames);
            }


        // Handle uploaded IC numbers
        if ($request->has('bp_icno')) {
            $uploadedIcNos = $request->input('bp_icno');


            foreach ($uploadedIcNos as $bp_icno) {
                // Store the new IC number in the existing array
                $icFileNames[] = $bp_icno;
            }
            
        }

        //Save the updated IC numbers in the model
        $inventory->setAttribute('bp_icno', array_values($icFileNames));
        $inventory->save();

        return redirect()->back()->with('success', 'IC Number was updated!');

    } catch (Exception $e) {
        // Handle exceptions if necessary
        return back()->with('error_message', 'An error occurred.');
    }
}

public function indexbook()
{
    $inventorybookmenengahs = InventoryBook::where('sekolah', 'Menengah')->get();
    $inventorybookrendahs = InventoryBook::where('sekolah', 'Rendah')->get();
    
    return view('cddinventory.indexbook', compact('inventorybookmenengahs','inventorybookrendahs'));
}








public function index()
{
    $icNos = Auth::user()->ic_no;

    // Sekolah Inventory
    $inventory = Inventory::select('inventory.*')
        ->where(function ($query) use ($icNos) {
            $query->where('ic_no', $icNos)
                  ->orWhere('kgp_ic_no', $icNos)
                  ->orWhereHas('ppk', function ($query) use ($icNos) {
                    $query->where('ic_no', $icNos);
                    })

                  ->orWhereJsonContains('bp_icno', $icNos)
                  ->orWhereJsonContains('bp_icno', null);
        })
        ->whereNotNull('nama_sch')
        ->orderBy('created_at', 'DESC')
        ->get();

    // Unit Inventory (add ppk_ic_no logic here)
    $inventoryunit = Inventory::select('inventory.*')
        ->where(function ($query) use ($icNos) {
            $query->where('ic_no', $icNos)
                  ->orWhere('ppk_ic_no', $icNos) // 👈 NEW: show to PPK
                  ->orWhereJsonContains('bp_icno', $icNos)
                  ->orWhereJsonContains('bp_icno', null);
        })
        ->whereNotNull('unit')
        ->orderBy('created_at', 'DESC')
        ->get();

    // Count forms for Sekolah
    foreach ($inventory as $inv) {
        $inventorybbk = InventoryBbk::where('inventory_id', $inv->id)->get();
        $inv->total_forms = $inventorybbk->count();
        $inv->submitted_forms = $inventorybbk->filter(function ($form) {
            return !empty($form->cdd_status);
        })->count();
    }

    // Count forms for Unit
    foreach ($inventoryunit as $invunit) {
        $inventorybbkunit = InventoryBbk::where('inventory_id', $invunit->id)->get();
        $invunit->total_forms = $inventorybbkunit->count();
        $invunit->submitted_forms = $inventorybbkunit->filter(function ($form) {
            return !empty($form->cdd_status);
        })->count();
    }

    $baucers = InventoryBaucerPembekal::select('inventory_baucer_pembekal_info.*')
        ->orderBy('id','DESC')
        ->where('created_by', '=', $icNos)
        ->get();

    return view('cddinventory.index', compact('inventory','inventoryunit','baucers'));
}





public function indexadmin()
{
    $icNos = Auth::user()->ic_no;

    // Fetch school inventory (approved only)
    $inventory = Inventory::select('inventory.*')
        ->whereNotNull('nama_sch')
        ->where('kgp_status', '=', 'approve')  // ✅ filter approved
        ->orderBy('created_at', 'DESC')
        ->get();

    // Fetch unit inventory (approved only)
    $inventoryunit = Inventory::select('inventory.*')
        ->whereNotNull('unit')
        ->where('kgp_status', '=', 'approve')  // ✅ filter approved
        ->orderBy('created_at', 'DESC')
        ->get();

    // Get related InventoryBbk for school inventories
    $inventorybbk = [];
    foreach ($inventory as $inv) {
        $inventorybbk[$inv->id] = InventoryBbk::where('inventory_id', '=', $inv->id)->get();
    }

    // Count total and submitted forms for school inventories
    foreach ($inventory as $inv) {
        $allForms = $inventorybbk[$inv->id] ?? collect();
        $totalForms = $allForms->count();
        $submittedForms = $allForms->filter(function ($form) {
            return !empty($form->cdd_status);
        })->count();

        $inv->total_forms = $totalForms;
        $inv->submitted_forms = $submittedForms;
    }

    // Get related InventoryBbk for unit inventories
    $inventorybbkunit = [];
    foreach ($inventoryunit as $invunit) {
        $inventorybbkunit[$invunit->id] = InventoryBbk::where('inventory_id', '=', $invunit->id)->get();
    }

    // Count total and submitted forms for unit inventories
    foreach ($inventoryunit as $invunit) {
        $allFormsUnit = $inventorybbkunit[$invunit->id] ?? collect();
        $totalFormsUnit = $allFormsUnit->count();
        $submittedFormsUnit = $allFormsUnit->filter(function ($form) {
            return !empty($form->cdd_status);
        })->count();

        $invunit->total_forms = $totalFormsUnit;
        $invunit->submitted_forms = $submittedFormsUnit;
    }

    // Return to blade view
    return view('cddinventory.indexadmin', compact('inventory', 'inventoryunit', 'inventorybbk', 'inventorybbkunit'));
}




public function indexsebutharga()
{
    $inventorysebutharga = InventorySebutharga::with('inventoryshdept')
        ->orderBy('created_by', 'desc')
        ->get();

    foreach ($inventorysebutharga as $inventory) {

        $rows = $inventory->inventoryshdept;
        $total = $rows->count();

        // 1. No records at all
        if ($total == 0) {
            $inventory->status = 'BELUM DI HANTAR';
            continue;
        }

        // 2. Check all completed
        $allCompleted = $rows->every(function ($row) {
            return !empty($row->penerima)
                && !empty($row->penerima_icno)
                && !empty($row->no_do)
                && !empty($row->date_recieve);
        });

        // 3. Check all empty
        $allEmpty = $rows->every(function ($row) {
            return empty($row->penerima)
                && empty($row->penerima_icno)
                && empty($row->no_do)
                && empty($row->date_recieve);
        });

        // 4. Assign status
        if ($allCompleted) {
            $inventory->status = 'SELESAI';
        }
        elseif ($allEmpty) {
            $inventory->status = 'BELUM DI HANTAR';
        }
        else {
            $inventory->status = 'BELUM SELESAI';
        }
    }

    return view('cddinventory.indexsebutharga', compact('inventorysebutharga'));
}




    public function emailvendorsebutharga($id)
{
    $inventorysebutharga = InventorySebutharga::findOrFail($id);
    $inventorysebutharga->update([
        'emailsent_at' => now(),
        'email_status' => 'sent'
       
    ]);

    $notf_userEmail = $inventorysebutharga->emel_pembekal;
    $notf_id=$inventorysebutharga->id;

    // Added by Amal 'Izzah (PB)
    Mail::to($notf_userEmail)->send(new EmailVendorSebutharga($notf_userEmail,$notf_id));



    return redirect()->route('cddinventory.cddinventory.indexsebutharga')
        ->with('success_message', 'Email sent to Syarikat Succesfully');
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
    
 public function destroyppk($id)
{
    $ppk = Ppk::find($id);

    if(!$ppk){
        return response()->json(['success' => false, 'message' => 'PPK not found']);
    }

    $ppk->delete();

    return response()->json(['success' => true]);
}

public function edit($id)
{
    $inventory = Inventory::findOrFail($id); // single model
    $inventorybbk = InventoryBbk::where('inventory_id', $id)->get();
    $allBooks = InventoryBook::all();

    return view('cddinventory.edit', compact('inventory','inventorybbk','allBooks'));
}

public function editunit($id)
{
    $inventoryunit = Inventory::findOrFail($id); // single model
    $inventorybbk = InventoryBbk::where('inventory_id', $id)->get();

    return view('cddinventory.editunit', compact('inventoryunit','inventorybbk'));
}

    public function editcddinfo($id)
{
    $currentRecord = InventoryBbk::findOrFail($id);

    $allRecords = InventoryBbk::where('inventory_id', $currentRecord->inventory_id)
        ->orderBy('id')
        ->get();

    $currentIndex = $allRecords->search(fn($item) => $item->id == $id);

    $nextId = null;
    if ($currentIndex !== false && ($currentIndex + 1) < $allRecords->count()) {
        $nextId = $allRecords[$currentIndex + 1]->id;
    }

    $isLast = ($currentIndex === $allRecords->count() - 1);

    return view('cddinventory.editcddinfo', [
        'inventorynormalbbk' => $currentRecord,
        'nextId' => $nextId,
        'isLast' => $isLast,
        'inventoryId' => $currentRecord->inventory_id,
    ]);
}


public function editcddinfoadmin($id)
{
    $currentRecord = InventoryBbk::findOrFail($id);

    $allRecords = InventoryBbk::where('inventory_id', $currentRecord->inventory_id)
        ->orderBy('id')
        ->get();

    $currentIndex = $allRecords->search(function ($item) use ($id) {
        return $item->id == $id;
    });

    $nextId = null;
    $previousId = null;

    if ($currentIndex !== false) {
        if (($currentIndex + 1) < $allRecords->count()) {
            $nextId = $allRecords[$currentIndex + 1]->id;
        }
        if (($currentIndex - 1) >= 0) {
            $previousId = $allRecords[$currentIndex - 1]->id;
        }
    }

    // Flag to check if current is last record
    $isLast = ($currentIndex === $allRecords->count() - 1);

    return view('cddinventory.editcddinfoadmin', [
        'inventorynormalbbk' => $currentRecord,
        'nextId' => $nextId,
        'previousId' => $previousId,
        'isLast' => $isLast,
        'inventoryId' => $currentRecord->inventory_id, //parentID
    ]);
}

public function editadmin($id)
{
    
    $inventory= Inventory::all()
    ->where('id', '=', $id);

    $inventorybbk= InventoryBbk::all()
    ->where('inventory_id', '=', $id);

    return view('cddinventory.editadmin',compact('inventory','inventorybbk'));
}

public function editadminunit($id)
{
    
    $inventoryunit= Inventory::all()
    ->whereNotNull('unit')
    ->where('id', '=', $id);

    $inventorybbk= InventoryBbk::all()
    ->where('inventory_id', '=', $id);



    return view('cddinventory.editadminunit',compact('inventoryunit','inventorybbk'));
}




    public function exportToExcel(Request $request)
    {
        // Retrieve Inventory records with specific conditions
        $approvedInventoryIds = Inventory::whereNotNull('nama_sch')
            ->where('kgp_status', 'approve')
            ->orderBy('created_at', 'DESC')
            ->pluck('id');
        
        $unitInventoryIds = Inventory::whereNotNull('unit')
            ->orderBy('created_at', 'DESC')
            ->pluck('id');
        
        // Retrieve InventoryBbk records matching the filtered Inventory IDs
        $allData = InventoryBbk::whereIn('inventory_id', $approvedInventoryIds->merge($unitInventoryIds))
            ->get(['inventory_id', 'matapelajaran', 'judulbahan', 'isbn', 'pengarang_penerbit', 
                   'qty_dipohonkan', 'sebab_permohonan', 'cdd_status', 'cdd_qty_diluluskan', 
                   'cdd_catatan', 'created_at', 'updated_admin', 'admin']);
        
        // Create a new spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
    
        // Set column headers
        $headers = [
            'A1' => 'Inventory ID',
            'B1' => 'Mata Pelajaran',
            'C1' => 'Judul Bahan',
            'D1' => 'ISBN',
            'E1' => 'Pengarang Penerbit',
            'F1' => 'Qty Dipohonkan',
            'G1' => 'Sebab Permohonan',
            'H1' => 'CDD Status',
            'I1' => 'CDD Qty Diluluskan',
            'J1' => 'CDD Catatan',
            'K1' => 'Created At',
            'L1' => 'Updated Admin',
            'M1' => 'Admin',
        ];
    
        foreach ($headers as $cell => $title) {
            $sheet->setCellValue($cell, $title);
        }
    
        // Loop through data and add it to the Excel file with formatted inventory_id
        $row = 2; // Start from the second row to leave space for headers
        foreach ($allData as $item) {
            $inventory = Inventory::find($item->inventory_id);
    
            // Format the inventory_id based on the conditions
            if ($inventory) {
                if (in_array($item->inventory_id, $approvedInventoryIds->toArray())) {
                    $formattedId = '2024/SP/BBK-' . $item->inventory_id;
                } elseif (in_array($item->inventory_id, $unitInventoryIds->toArray())) {
                    $formattedId = '2024/UP/BBK-' . $item->inventory_id;
                } else {
                    $formattedId = 'Not Applicable'; // Fallback if neither condition is met
                }
            } else {
                $formattedId = 'Not Found'; // If the inventory record is not found
            }
    
            // Add data to the spreadsheet
            $sheet->setCellValue('A' . $row, $formattedId);
            $sheet->setCellValue('B' . $row, $item->matapelajaran);
            $sheet->setCellValue('C' . $row, $item->judulbahan);
            $sheet->setCellValue('D' . $row, $item->isbn);
            $sheet->setCellValue('E' . $row, $item->pengarang_penerbit);
            $sheet->setCellValue('F' . $row, $item->qty_dipohonkan);
            $sheet->setCellValue('G' . $row, $item->sebab_permohonan);
            $sheet->setCellValue('H' . $row, $item->cdd_status);
            $sheet->setCellValue('I' . $row, $item->cdd_qty_diluluskan);
            $sheet->setCellValue('J' . $row, $item->cdd_catatan);
            $sheet->setCellValue('K' . $row, $item->created_at);
            $sheet->setCellValue('L' . $row, $item->updated_admin);
            $sheet->setCellValue('M' . $row, $item->admin);
            $row++;
        }
    
        // Create the Excel file
        $writer = new Xlsx($spreadsheet);
        $filename = 'exported_inventorybbk_data.xlsx';
    
        return response()->stream(
            function () use ($writer) {
                $writer->save('php://output');
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ]
        );
    }



public function destroysebutharga($id)
{
    try {
        $inventorysebutharga = InventorySebutharga::where('id', $id)->delete();

        // / Delete related records from InventoryShBk
        InventoryShBk::where('sh_id', $id)->delete();
        
        // Delete related records from InventoryShdept
        InventoryShdept::where('sh_id', $id)->delete();

          // Delete related records from InventoryShdeptorder
       InventoryShdeptorder::where('sh_id', $id)->delete();

        return redirect()->route('cddinventory.cddinventory.indexsebutharga') // Redirect to a list or another suitable route
            ->with('success_message', 'Senarai Agihan telah di delete!');
        
    } catch (Exception $exception) {
        return back()->withInput()
            ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
    }
}


    public function editsebutharga($id)
    {
        
        $inventorysebutharga= InventorySebutharga::all()
        ->where('id', '=', $id);


        $inventoryshbook= InventoryShBk::all()
        ->where('sh_id', '=', $id);

        
        $inventoryshdept = InventoryShdept::where('sh_id', $id)->get();
        // $inventoryshdeptorder = InventoryShdeptorder::where('sh_id', $id)->get();

          // Fetch ISBN options from the database
          $isbnOptions = InventoryBook::pluck('isbn')->toArray();
        
          // Fetch information for all ISBNs
          $allBooks = InventoryBook::all();  

        // Fetch data from inventory_shdept_order table
        $inventoryshdeptorder = InventoryShdeptOrder::where('sh_id', $id)->get();

        
    
        return view('cddinventory.editsebutharga',compact('inventorysebutharga','inventoryshdept', 'inventoryshbook','inventoryshdeptorder','isbnOptions','allBooks'));
    }

    public function downloadAllRecordsPdf()
{
    // Fetch all inventory records using the same model from your generatePDF method
    $inventorysebutharga = InventorySebutharga::all();
    
    // Load the view and pass data - using PDF since you already have that import
    $pdf = PDF::loadView('pdf.all-records', compact('inventorysebutharga'));
    
    // Set paper size and orientation
    $pdf->setPaper('A4', 'landscape');
    
    // Download the PDF
    return $pdf->download('senarai-agihan-' . date('Y-m-d') . '.pdf');
}

public function downloadPdfsAsZip()
{
    \Log::info('=== Starting ZIP download process ===');
    
    try {
        $inventoryRecords = Inventorysebutharga::all();
        \Log::info('Found ' . $inventoryRecords->count() . ' records');
        
        if ($inventoryRecords->isEmpty()) {
            \Log::warning('No records found');
            return back()->with('error_message', 'Tiada rekod untuk dijana PDF.');
        }
        
        // Generate all PDFs in memory
        $pdfs = [];
        
        foreach ($inventoryRecords as $record) {
            try {
                \Log::info('Generating PDF for record ID: ' . $record->id);
                $pdfContent = $this->generatePDFContent($record->id);
                \Log::info('PDF generated, size: ' . strlen($pdfContent) . ' bytes');
                
                $fileName = 'SH' . $record->id . '_' . preg_replace('/[^A-Za-z0-9_\-]/', '-', $record->bil_po) . '.pdf';
                $pdfs[$fileName] = $pdfContent;
                
            } catch (\Exception $e) {
                \Log::error('Failed to generate PDF for record ' . $record->id . ': ' . $e->getMessage());
                \Log::error($e->getTraceAsString());
                continue;
            }
        }
        
        \Log::info('Total PDFs generated: ' . count($pdfs));
        
        if (empty($pdfs)) {
            \Log::error('No PDFs were generated successfully');
            return back()->with('error_message', 'Gagal menjana PDF.');
        }
        
        // Create ZIP in memory
        \Log::info('Creating ZIP file in memory...');
        $zipData = $this->createZipInMemory($pdfs);
        \Log::info('ZIP created, size: ' . strlen($zipData) . ' bytes');
        
        $zipFileName = 'Semua_Sebut_Harga_' . date('Y-m-d_His') . '.zip';
        \Log::info('Sending ZIP file: ' . $zipFileName);
        
        // Force headers and return
        return response()->make($zipData, 200, [
            'Content-Type' => 'application/zip',
            'Content-Disposition' => 'attachment; filename="' . $zipFileName . '"',
            'Content-Length' => strlen($zipData),
            'Cache-Control' => 'no-cache, must-revalidate',
            'Pragma' => 'public',
            'Expires' => '0',
        ]);
        
    } catch (\Exception $e) {
        \Log::error('ZIP Download Error: ' . $e->getMessage());
        \Log::error('Stack trace: ' . $e->getTraceAsString());
        return back()->with('error_message', 'Ralat: ' . $e->getMessage());
    }
}

// Create ZIP file in memory without ZipArchive
private function createZipInMemory($files)
{
    \Log::info('Building ZIP with ' . count($files) . ' files');
    
    $zip = '';
    $centralDirectory = '';
    $offset = 0;
    $fileCount = 0;
    
    foreach ($files as $filename => $content) {
        \Log::info('Adding file to ZIP: ' . $filename . ' (' . strlen($content) . ' bytes)');
        
        $filename = str_replace('\\', '/', $filename);
        
        // Local file header
        $localHeader = 
            "\x50\x4b\x03\x04" . // Local file header signature
            "\x14\x00" .         // Version needed to extract
            "\x00\x00" .         // General purpose bit flag
            "\x00\x00" .         // Compression method (stored)
            $this->getDosTime() . // Last mod file time/date
            pack('V', crc32($content)) . // CRC-32
            pack('V', strlen($content)) . // Compressed size
            pack('V', strlen($content)) . // Uncompressed size
            pack('v', strlen($filename)) . // File name length
            pack('v', 0) .       // Extra field length
            $filename;           // File name
        
        $zip .= $localHeader . $content;
        
        // Central directory file header
        $centralDirectory .= 
            "\x50\x4b\x01\x02" . // Central file header signature
            "\x14\x00" .         // Version made by
            "\x14\x00" .         // Version needed to extract
            "\x00\x00" .         // General purpose bit flag
            "\x00\x00" .         // Compression method
            $this->getDosTime() . // Last mod file time/date
            pack('V', crc32($content)) . // CRC-32
            pack('V', strlen($content)) . // Compressed size
            pack('V', strlen($content)) . // Uncompressed size
            pack('v', strlen($filename)) . // File name length
            pack('v', 0) .       // Extra field length
            pack('v', 0) .       // File comment length
            pack('v', 0) .       // Disk number start
            pack('v', 0) .       // Internal file attributes
            pack('V', 32) .      // External file attributes
            pack('V', $offset) . // Relative offset of local header
            $filename;
        
        $offset += strlen($localHeader) + strlen($content);
        $fileCount++;
    }
    
    \Log::info('ZIP file count: ' . $fileCount);
    
    // End of central directory record
    $endOfCentralDirectory = 
        "\x50\x4b\x05\x06" . // End of central dir signature
        "\x00\x00" .         // Number of this disk
        "\x00\x00" .         // Disk where central directory starts
        pack('v', $fileCount) . // Number of central directory records on this disk
        pack('v', $fileCount) . // Total number of central directory records
        pack('V', strlen($centralDirectory)) . // Size of central directory
        pack('V', $offset) . // Offset of start of central directory
        "\x00\x00";          // ZIP file comment length
    
    $finalZip = $zip . $centralDirectory . $endOfCentralDirectory;
    \Log::info('Final ZIP size: ' . strlen($finalZip) . ' bytes');
    
    return $finalZip;
}

// Get DOS timestamp
private function getDosTime()
{
    $time = time();
    $date = getdate($time);
    
    $dosDate = (($date['year'] - 1980) << 9) | ($date['mon'] << 5) | $date['mday'];
    $dosTime = ($date['hours'] << 11) | ($date['minutes'] << 5) | ($date['seconds'] >> 1);
    
    return pack('v', $dosTime) . pack('v', $dosDate);
}

// Keep your existing generatePDFContent
private function generatePDFContent($id)
{
    $inventorysebutharga = InventorySebutharga::findOrFail($id);
    $inventorysebutharga = InventorySebutharga::all()->where('id', '=', $id);
    $inventoryshbook = InventoryShBk::where('sh_id', $id)->get();
    $inventoryshdept = InventoryShdept::where('sh_id', $id)->get();
    $inventoryshdeptorder = InventoryShdeptOrder::where('sh_id', $id)->get();
    
    $isbnOptions = InventoryBook::pluck('isbn')->toArray();
    $allBooks = InventoryBook::all();
    $filePath = !empty($inventoryshdept->file) ? asset('storage/' . $inventoryshdept->file) : null;
    
    $viewData = [
        'inventorysebutharga' => $inventorysebutharga,
        'inventoryshbook' => $inventoryshbook,
        'inventoryshdept' => $inventoryshdept,
        'inventoryshdeptorder' => $inventoryshdeptorder,
        'isbnOptions' => $isbnOptions,
        'allBooks' => $allBooks,
        'filePath' => $filePath,
    ];
    
    $html = view('cddinventory.sebuthargapdf', $viewData)->render();
    
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);
    $dompdf = new Dompdf($options);
    
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    
    return $dompdf->output();
}

    // THIS GENERATE WORKING

    public function generatePDF($id)
    {
        // Retrieve data based on the $id parameter
        $inventorysebutharga = InventorySebutharga::findOrFail($id);
        $inventorysebutharga= InventorySebutharga::all()
        ->where('id', '=', $id);
        $inventoryshbook = InventoryShBk::where('sh_id', $id)->get();
        $inventoryshdept = InventoryShdept::where('sh_id', $id)->get();
        $inventoryshdeptorder = InventoryShdeptOrder::where('sh_id', $id)->get();
    
    
          // Fetch ISBN options from the database
          $isbnOptions = InventoryBook::pluck('isbn')->toArray();
        
          // Fetch information for all ISBNs
          $allBooks = InventoryBook::all();  

          // Prepare the file path
    $filePath = !empty($inventoryshdept->file) ? asset('storage/' . $inventoryshdept->file) : null;


 
        // Your existing Blade code here, passing the data to the view
        $viewData = [
            'inventorysebutharga' => $inventorysebutharga,
            'inventoryshbook' => $inventoryshbook,
            'inventoryshdept' => $inventoryshdept,
            'inventoryshdeptorder' => $inventoryshdeptorder,
            'isbnOptions' => $isbnOptions,
            'allBooks' => $allBooks,
            'filePath' => $filePath,



            
        ];
    
        // Render the Blade view to HTML
        $html = view('cddinventory.sebuthargapdf', $viewData)->render();
    
        // Initialize dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf = new Dompdf($options);
    
        // Load HTML content
        $dompdf->loadHtml($html);
    
        // Set paper size
        $dompdf->setPaper('A4', 'portrait');
    
        // Render PDF (first buffer the PDF content)
        $dompdf->render();
    
        // Output the generated PDF (download or display)
        return response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="sebuthargaform.pdf"',
        ]);
    }

    public function addicnumber($id)
{

    $inventory= Inventory::all()
    ->where('id', '=', $id);
    

    return view('cddinventory.addicnumber', compact('inventory'));
}



public function updatesebutharga (Request $request)
{
    //dd($request->all());

    $now = Carbon::now();

    $id = $request->sh_id;

    $inventorysebutharga = InventorySebutharga::where('id', $id)
    ->update([
        'bil_sh' => $request->bil_sh,
        'bilangan_sebutharga' => $request->bilangan_sebutharga,
        'bil_po' => $request->bil_po,
        'pembekal' => $request->pembekal,
        'emel_pembekal' => $request->emel_pembekal,
        'updated_at' => $now,
    ]);


    return redirect()->back()
        ->with('success', 'Record was successfully updated!');
}

    public function updateinfo (Request $request)
    {
     

        $now = Carbon::now();

                $inventorynormalbbk =  InventoryBbk::select('inventorybbk.*')
                ->where('id', $request->id)
                ->update([
                
                    'matapelajaran' => $request->matapelajaran,
                    'judulbahan' => $request->judulbahan,
                    'isbn' => $request->isbn,
                    'pengarang_penerbit' => $request->pengarang_penerbit,
                    'qty_dipohonkan' => $request->qty_dipohonkan,
                    'sebab_permohonan' => $request->sebab_permohonan,
                    'updated_at' => $now

                ]);

            return redirect()->back()
            ->with('success_message', 'Record was successfully updated!');

        
          
    }

    public function updatecddinfoadminnew(Request $request)
{
    $request->validate([
        'id' => 'required|exists:inventorybbk,id',
        'cdd_status' => 'nullable|string',
        'cdd_qty_diluluskan' => 'nullable|integer|min:0',
        'kqty_pengeluaran' => 'nullable|integer|min:0',
        'kqty_sebutharga' => 'nullable|integer|min:0',
        'cdd_catatan' => 'nullable|string',
        'direction' => 'required|string|in:submit,next,previous,notify',
    ]);

    // Update record
    $inventory = InventoryBbk::findOrFail($request->id);
    $inventory->update([
        'cdd_status' => $request->cdd_status,
        'cdd_qty_diluluskan' => $request->cdd_qty_diluluskan,
        'kqty_pengeluaran' => $request->kqty_pengeluaran,
        'kqty_sebutharga' => $request->kqty_sebutharga,
        'cdd_catatan' => $request->cdd_catatan,
    ]);

    $currentId = $inventory->id;
    $direction = $request->direction;

    if ($direction === 'next') {
        $nextId = InventoryBbk::where('id', '>', $currentId)->orderBy('id')->value('id');
        if ($nextId) {
            return redirect()->route('cddinventory.cddinventory.editcddinfoadmin', $nextId)
                             ->with('success_message', 'Record updated successfully!');
        }
    }

    if ($direction === 'previous') {
        $previousId = InventoryBbk::where('id', '<', $currentId)->orderBy('id', 'desc')->value('id');
        if ($previousId) {
            return redirect()->route('cddinventory.cddinventory.editcddinfoadmin', $previousId)
                             ->with('success_message', 'Record updated successfully!');
        }
    }

    if ($direction === 'notify') {
        return redirect()->route('cddinventory.notify', ['inventory_id' => $currentId])
                         ->with('success_message', 'Data saved. You may now notify the pemohon.');
    }

    // Default (submit or nothing else matched)
    return redirect()->route('cddinventory.cddinventory.editcddinfoadmin', $currentId)
                     ->with('success_message', 'Record updated successfully!');
}


public function updatecddinfoadmin(Request $request)
{
    $request->validate([
        'id' => 'required|exists:inventorybbk,id',
        'cdd_status' => 'nullable|string',
        'cdd_qty_diluluskan' => 'nullable|integer|min:0',
        'kqty_pengeluaran' => 'nullable|integer|min:0',
        'kqty_sebutharga' => 'nullable|integer|min:0',
        'cdd_catatan' => 'nullable|string',
        'direction' => 'required|string|in:submit,next,previous,notify',
    ]);

    InventoryBbk::where('id', $request->id)->update([
        'cdd_status' => $request->cdd_status,
        'cdd_qty_diluluskan' => $request->cdd_qty_diluluskan,
        'kqty_pengeluaran' => $request->kqty_pengeluaran,
        'kqty_sebutharga' => $request->kqty_sebutharga,
        'cdd_catatan' => $request->cdd_catatan,
    ]);

    $currentId = $request->id;
    $direction = $request->direction;

    if ($direction === 'next') {
        $nextId = InventoryBbk::where('id', '>', $currentId)->orderBy('id')->value('id');
        if ($nextId) {
            return redirect()->route('cddinventory.cddinventory.editcddinfoadmin', $nextId)
                             ->with('success_message', 'Record updated successfully!');
        }
    } elseif ($direction === 'previous') {
        $previousId = InventoryBbk::where('id', '<', $currentId)->orderBy('id', 'desc')->value('id');
        if ($previousId) {
            return redirect()->route('cddinventory.cddinventory.editcddinfoadmin', $previousId)
                             ->with('success_message', 'Record updated successfully!');
        }
    } elseif ($direction === 'notify') {
        return redirect()->route('cddinventory.notify', [
            'inventory_id' => $request->inventory_id // not $request->id
        ])->with('success_message', 'Data saved. You may now notify the pemohon.');
    }

    // For "submit" or if no next/previous found, redirect back to edit page
    return redirect()->route('cddinventory.cddinventory.editcddinfoadmin', $currentId)
                     ->with('success_message', 'Record updated successfully!');
}
    

    public function updateRemarks(Request $request, $id)
{
    $request->validate([
        'remarks' => 'nullable|string|max:500',
    ]);

    $inventory = Inventory::findOrFail($id); // Adjust model name if needed
    $inventory->remarks = $request->remarks;
    $inventory->save();

    return redirect()->back()->with('success_message', 'Remarks updated successfully.');
}

public function updateRemarksUnit(Request $request, $id)
{
    $request->validate([
        'remarks' => 'nullable|string|max:500',
    ]);

    $inventoryUnit = InventoryUnit::findOrFail($id); // Adjust model name if needed
    $inventoryUnit->remarks = $request->remarks;
    $inventoryUnit->save();

    return redirect()->back()->with('success_message', 'Remarks updated successfully.');
}

public function updateunit(Request $request)
{
    $inventory = Inventory::findOrFail($request->inventory_id);

    // Update inventory fields if needed (status, amendments, etc.)
    $inventory->kgp_status = $request->kgp_status ?? $inventory->kgp_status;
    $inventory->kgp_amendmentreasons = $request->kgp_amendmentreasons ?? $inventory->kgp_amendmentreasons;
    $inventory->save();

    // Delete old BBK records for this inventory
    InventoryBbk::where('inventory_id', $inventory->id)->delete();

    // Save updated BBK records from the form
    if (!empty($request->matapelajaran) && is_array($request->matapelajaran)) {
        $now = Carbon::now();
        $insert_data = [];

        for ($i = 0; $i < count($request->matapelajaran); $i++) {
            $insert_data[] = [
                'inventory_id' => $inventory->id,
                'matapelajaran' => $request->matapelajaran[$i],
                'judulbahan' => $request->judulbahan[$i],
                'isbn' => $request->isbn[$i] ?? null,
                'pengarang_penerbit' => $request->pengarang_penerbit[$i] ?? null,
                'qty_dipohonkan' => $request->qty_dipohonkan[$i] ?? 0,
                'sebab_permohonan' => $request->sebab_permohonan[$i] ?? null,
                'created_at' => $now,
            ];
        }

        InventoryBbk::insert($insert_data);
    }

    return redirect()->back()->with('success_message', 'Inventory and BBK updated successfully.');
}


// public function update(Request $request)
// {
//     $now = Carbon::now();
    
//     $inventory_id = $request->inventory_id;

//     $matapelajaran = $request->matapelajaran;
//     $judulbahan = $request->judulbahan;
//     $isbn = $request->isbn;
//     $pengarang_penerbit = $request->pengarang_penerbit;
//     $qty_dipohonkan = $request->qty_dipohonkan;
//     $sebab_permohonan = $request->sebab_permohonan;

//     if (!empty($matapelajaran) && is_array($matapelajaran) || !empty($judulbahan) && is_array($judulbahan)) {
//         $insert_data_1 = [];

//         for ($count_1 = 0; $count_1 < count($matapelajaran); $count_1++) {
//             $insert_data_1[] = [
//                 'inventory_id' => $inventory_id,
//                 'matapelajaran' => $matapelajaran[$count_1],
//                 'judulbahan' => $judulbahan[$count_1],
//                 'isbn' => $isbn[$count_1],
//                 'pengarang_penerbit' => $pengarang_penerbit[$count_1],
//                 'qty_dipohonkan' => $qty_dipohonkan[$count_1],
//                 'sebab_permohonan' => $sebab_permohonan[$count_1],
//                 'updated_at' => $now
//             ];
//         }

//         InventoryBbk::insert($insert_data_1);
//     }

//     // Corrected update
//     Inventory::where('id', $inventory_id)
//         ->update([
//             'kgp_status' => $request->kgp_status,
//             'kgp_amendmentreasons' => $request->kgp_amendmentreasons
//         ]);

//     return redirect()->back()->with('success_message', 'Record was successfully updated!');
// }

public function update(Request $request)
{
    $now = Carbon::now();
    $inventory_id = $request->inventory_id;

    $inventory = Inventory::findOrFail($inventory_id);
    $oldStatus = $inventory->kgp_status;

    // ===========================
    // INSERT BBK
    // ===========================
    if (!empty($request->matapelajaran) && is_array($request->matapelajaran)) {
        $insert_data_1 = [];

        for ($i = 0; $i < count($request->matapelajaran); $i++) {
            $insert_data_1[] = [
                'inventory_id' => $inventory_id,
                'matapelajaran' => $request->matapelajaran[$i],
                'judulbahan' => $request->judulbahan[$i],
                'isbn' => $request->isbn[$i],
                'pengarang_penerbit' => $request->pengarang_penerbit[$i],
                'qty_dipohonkan' => $request->qty_dipohonkan[$i],
                'sebab_permohonan' => $request->sebab_permohonan[$i],
                'updated_at' => $now
            ];
        }

        InventoryBbk::insert($insert_data_1);
    }

    // ===========================
    // UPDATE STATUS
    // ===========================
    $inventory->update([
        'kgp_status' => $request->kgp_status,
        'kgp_amendmentreasons' => $request->kgp_amendmentreasons
    ]);

    // ===========================
    // 📧 NEED AMENDMENTS EMAIL
    // ===========================
    if (
        $request->kgp_status === 'Need Amendments' &&
        $oldStatus !== 'Need Amendments'
    ) {
        Mail::to($inventory->emel)->send(
            new AmendmentRequiredMail($inventory)
        );
    }

    // ===========================
    // 📧 APPROVE EMAIL (NEW)
    // ===========================
    if (
        $request->kgp_status === 'Approve' &&
        $oldStatus !== 'Approve'
    ) {
        $recipients = [];
    
        // ✅ Applicant (Guru / Unit user)
        if (!empty($inventory->emel)) {
            $recipients[] = $inventory->emel;
        }
    
        // ✅ School flow (KGP exists)
        if (!empty($inventory->kgp_emel)) {
            $recipients[] = $inventory->kgp_emel;
        }
    
        // ✅ Unit flow (PPK exists)
        if (!empty($inventory->ppk_emel)) {
            $recipients[] = $inventory->ppk_emel;
        }
    
        // ✅ JPK ADMIN (always)
        // $recipients[] = 'jpk@moe.gov.bn';
    
        // ✅ Remove duplicates + nulls
        $recipients = array_unique(array_filter($recipients));
    
        Mail::to($recipients)->send(
            new ApprovedMail($inventory)
        );
    
        \Log::info('Approval email sent', [
            'inventory_id' => $inventory->id,
            'recipients' => $recipients
        ]);
    }

    return redirect()->back()->with('success_message', 'Record was successfully updated!');
}


public function borangpengeluaran($id)
{
    $inventory= Inventory::all()
    ->where('id', '=', $id);

    $inventorybp= Inventorybp::all()
    ->where('inventory_id', '=', $id);

    $icNos = Auth::user()->ic_no;
    
    $employments = Employment::all()
                    ->where('ic_no', '=', $icNos);
                    
    $sekolah= School::pluck('label','id')->all();



    $inventorybbk= InventoryBbk::all()
    ->where('inventory_id', '=', $id);


    return view('cddinventory.borangpengeluaran', compact('employments','sekolah','inventory','inventorybbk','inventorybp'));
}
public function getUserByIc(Request $request)
{
    try {
        $icNo = $request->input('ic_no');
        $user = \App\Models\User::where('ic_no', $icNo)->first();
        
        if ($user) {
            return response()->json([
                'success' => true,
                'data' => [
                    'name' => $user->name,
                    'jawatan' => '', // Empty since user will type it
                ]
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'User not found'
        ]);
        
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}
public function bpform($id)
{
    $inventory = Inventory::all()
        ->where('id', '=', $id);

    // Get items from BP table
    $inventorybp = Inventorybp::all()
        ->where('inventory_id', '=', $id);

    // Get items from BBK table where status includes "Borang Pengeluaran"
    $inventorybbk = Inventorybbk::where('inventory_id', '=', $id)
        ->whereIn('cdd_status', [
            'Borang Pengeluaran', 
            'Borang Pengeluaran & Sebutharga'
        ])
        ->get();

    $icNos = Auth::user()->ic_no;
    
    $employments = Employment::all()
        ->where('ic_no', '=', $icNos);
                    
    $sekolah = School::pluck('label','id')->all();

    return view('cddinventory.bpform', compact('employments','sekolah','inventory','inventorybp','inventorybbk'));
}

public function updatebp(Request $request)
{
    try {
        $icNos = Auth::user()->ic_no;
        $now = Carbon::now();

        // Validate the request - make fields nullable if they might be empty
        $request->validate([
            'id' => 'required',
            'bp_recieve_icno' => 'nullable',
            'bp_recieve_nama' => 'nullable',
            'bp_recieve_jawatan' => 'nullable',
        ]);

        // Update the inventory record
        Inventory::where('id', $request->id)
            ->update([
                'bp_recieve_nama' => $request->bp_recieve_nama,
                'bp_recieve_icno' => $request->bp_recieve_icno,
                'bp_recieve_jawatan' => $request->bp_recieve_jawatan,
                'bp_recieve_date' => $now,
            ]);

        // Get the updated inventory record for email
        $inventory = Inventory::find($request->id);

        // Send email to Guru Besar
        $this->sendEmailToGuruBesar($inventory, $now);

        

        return redirect()->back()
            ->with('success_message', 'Rekod berjaya dikemaskini dan e-mel telah dihantar kepada Guru Besar!');
            
    } catch (\Exception $e) {
        \Log::error('Error updating BP form: ' . $e->getMessage());
        return redirect()->back()
            ->with('error_message', 'Ralat: ' . $e->getMessage());
    }
}

private function sendEmailToGuruBesar($inventory, $receiveDate)
{
    try {
        // Get Guru Besar email from kgp_emel field
        $guruBesarEmail = $inventory->kgp_emel;
        
        if (!$guruBesarEmail) {
            \Log::warning('Guru Besar email not found for inventory ID: ' . $inventory->id);
            return;
        }

        // Get Guru Besar name from kgp_nama field
        $guruBesarName = $inventory->kgp_nama ?? 'Guru Besar/Pengetua';
        
        // Get school name from nama_sch field
        $schoolName = $inventory->nama_sch ?? '';

        // Convert created_at to Carbon instance if it's a string
        $createdAt = $inventory->created_at instanceof \Carbon\Carbon 
            ? $inventory->created_at 
            : \Carbon\Carbon::parse($inventory->created_at);

        // Prepare email data
        $emailData = [
            'notf_namagb' => $guruBesarName,
            'notf_sekolah' => $schoolName,
            'notf_id' => $inventory->id,
            'notf_date' => $createdAt,
            'notf_recieve_date' => Carbon::parse($receiveDate)->format('d-m-Y H:i:s'),
            'notf_recieve_nama' => $inventory->bp_recieve_nama ?? '-',
            'notf_recieve_icno' => $inventory->bp_recieve_icno ?? '-',
            'notf_recieve_jawatan' => $inventory->bp_recieve_jawatan ?? '-',
        ];

        // Send email
        \Mail::send('emails.EmailBorangPengeluaranDiambil', $emailData, function($message) use ($guruBesarEmail, $inventory, $createdAt) {
            $message->to($guruBesarEmail)
                    ->subject('[Pengesahan] Buku Telah Diambil - ' . $createdAt->format('Y') . '/SP/BBK-' . $inventory->id);
        });

        \Log::info('Email sent successfully to Guru Besar (' . $guruBesarEmail . ') for inventory ID: ' . $inventory->id);
        
    } catch (\Exception $e) {
        \Log::error('Error sending email to Guru Besar: ' . $e->getMessage());
        // Don't throw exception - we don't want email failure to break the form submission
    }
}


// zharifcode


//borang penerimaan functions
public function createbaucer()
{

    $icNos = Auth::user()->ic_no;
    
    $employments = Employment::all()
                    ->where('ic_no', '=', $icNos);

    $biodatas = Biodata::all()
    ->where('ic_no', '=', $icNos);

    return view('cddinventory.baucer.createbaucer', compact('employments','biodatas'));
}

public function showbaucer ($id) {

    $icNos = Auth::user()->ic_no;
    
    $employments = Employment::all()
                    ->where('ic_no', '=', $icNos);

    $baucers =  InventoryBaucerPembekal::findOrFail($id);

    // Only retrieve related InventoryBaucerBuku records with the same rujukan_srv
    $baucersbuku = InventoryBaucerBuku::select('inventory_baucer_buku_info.*')
                    ->where('inventory_baucer_buku_info.rujukan_srv', '=', $baucers->rujukan_srv)
                    ->orderBy('inventory_baucer_buku_info.id', 'ASC')
                    ->get();

    return view('cddinventory.baucer.showbaucer', compact('employments', 'baucers', 'baucersbuku'));
}

public function editbaucer($id) {

    $icNos = Auth::user()->ic_no;
    
    $employments = Employment::all()
                    ->where('ic_no', '=', $icNos);

    $baucers =  InventoryBaucerPembekal::findOrFail($id);

    // Only retrieve related InventoryBaucerBuku records with the same rujukan_srv
    $baucersbuku = InventoryBaucerBuku::select('inventory_baucer_buku_info.*')
                    ->where('inventory_baucer_buku_info.rujukan_srv', '=', $baucers->rujukan_srv)
                    ->orderBy('inventory_baucer_buku_info.id', 'ASC')
                    ->get();

    return view('cddinventory.baucer.editbaucer', compact('employments', 'baucers', 'baucersbuku'));
}

public function storebaucer(Request $request){

    $icNos = Auth::user()->ic_no;
    $now = Carbon::now();

    $baucer = new InventoryBaucerPembekal;

        $baucer->rujukan_srv = $request->rujukan_srv;
        $baucer->nama_syarikat_pembekal = $request->nama_syarikat_pembekal;
        $baucer->jenis_barang = $request->jenis_barang;
        $baucer->po_norujukan = $request->po_norujukan;
        $baucer->po_tarikh = $request->po_tarikh;
        $baucer->do_norujukan = $request->do_norujukan;
        $baucer->do_tarikh = $request->do_tarikh;
        $baucer->lokasi_penerimaan = $request->lokasi_penerimaan;
        $baucer->created_by = $icNos;
        $baucer->created_at = $now;
        $baucer->updated_at = $now;

        $baucer->save();

    // Process and store multiple rows of related data
    $bukuData = [];

    foreach ($request->bil as $key => $bil) {
        $bukuData[] = [
            'rujukan_srv' => $request->rujukan_srv,
            'bil' => $request->bil[$key],
            'jadual_buku' => $request->jadual_buku[$key],
            'isbn' => $request->isbn[$key],
            'unit' => $request->unit[$key],
            'kuantiti_do' => $request->kuantiti_do[$key],
            'kuantiti_diterima' => $request->kuantiti_diterima[$key],
            'harga_kos_seunit' => $request->harga_kos_seunit[$key],
            'harga_jumlah' => $request->harga_jumlah[$key],
            'catatan' => $request->catatan[$key],
            'created_at' => $now,
            'updated_at' => $now,
        ];
    }

    // Bulk insert the data into the related table
    InventoryBaucerBuku::insert($bukuData);


    return redirect()->route('cddinventory.cddinventory.index')
    ->with('success_message', 'Borang Baucer telah berjaya dihantar');
}

public function updatebaucer(Request $request, $id)
{
    $now = Carbon::now();

    // Update the main InventoryBaucerPembekal record
    $baucer = InventoryBaucerPembekal::findOrFail($id);

    // Store the old rujukan_srv
    $oldRujukanSrv = $baucer->rujukan_srv;

    $baucer->rujukan_srv = $request->rujukan_srv;
    $baucer->nama_syarikat_pembekal = $request->nama_syarikat_pembekal;
    $baucer->jenis_barang = $request->jenis_barang;
    $baucer->po_norujukan = $request->po_norujukan;
    $baucer->po_tarikh = $request->po_tarikh;
    $baucer->do_norujukan = $request->do_norujukan;
    $baucer->do_tarikh = $request->do_tarikh;
    $baucer->lokasi_penerimaan = $request->lokasi_penerimaan;

    $baucer->save();

    // Update the related InventoryBaucerBuku records
    foreach ($request->bil as $key => $bil) {
        InventoryBaucerBuku::where('rujukan_srv', $oldRujukanSrv)
            ->where('id', $key + 1)
            ->update([
                'rujukan_srv' => $request->rujukan_srv,
                'bil' => $request->bil[$key],
                'jadual_buku' => $request->jadual_buku[$key],
                'isbn' => $request->isbn[$key],
                'unit' => $request->unit[$key],
                'kuantiti_do' => $request->kuantiti_do[$key],
                'kuantiti_diterima' => $request->kuantiti_diterima[$key],
                'harga_kos_seunit' => $request->harga_kos_seunit[$key],
                'harga_jumlah' => $request->harga_jumlah[$key],
                'catatan' => $request->catatan[$key],
                'updated_at' => now(),
            ]);
    }

    return redirect()->route('cddinventory.cddinventory.index')
        ->with('success_message', 'Borang Baucer telah berjaya dikemaskini');
}

public function destroybaucer($id)
{
    try {
        // Find the InventoryBaucerPembekal record to get its rujukan_srv
        $baucer = InventoryBaucerPembekal::findorFail($id);

        // Get the rujukan_srv
        $rujukanSrv = $baucer->rujukan_srv;

        // Delete the selected InventoryBaucerPembekal record
        $baucer->delete();

        // Delete related records in InventoryBaucerBuku with the same rujukan_srv
        InventoryBaucerBuku::where('rujukan_srv', $rujukanSrv)->delete();

        return Redirect::back()->with('success_message', 'Baucer Record was successfully deleted!');
    } catch (Exception $exception) {
        return back()->withInput()->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
    }
}

//end borang penerimaan functions

// end zharifcode

// STARTHRMD RR ADD

public function indexgbpg(){

    $sekolah= School::pluck('label','id')->all();

    $gbpg = CddGuruBesarPengetua::select('cdd_gurubesarpengetua.*')
        ->get(); 

    return view('cddinventory.indexgurubesar',compact('sekolah','gbpg'));
}


public function storegbpg(Request $request){

    $sekolah= School::pluck('label','id')->all();

    $icNos = Auth::user()->ic_no;

    $now = Carbon::now();

    $gbpg = new CddGuruBesarPengetua;

    $gbpg->name = $request->name;
    $gbpg->email = $request->email;
    $gbpg->ic_no = $request->ic_no;
    $gbpg->school = $request->school;
    $gbpg->phone_number = $request->phone_number;
    $gbpg->created_by = $icNos;
    $gbpg->created_at = $now;
    $gbpg->save();

  

    return back()->with('success_message','Information successfully updated!');
}

public function updategbpg(Request $request){

    $sekolah= School::pluck('label','id')->all();

    $now = Carbon::now();

    $gbpg = CddGuruBesarPengetua::where('id',$request->id)
        ->update([
            'name' => $request->name,
            'email' => $request->email,
            'ic_no' => $request->ic_no,
            'school' => $request->school,
            'phone_number' => $request->phone_number,
            'updated_at' => now(),
        ]);

    return back()->with('success_message','Information successfully updated!');
}

public function destroygbpg($id){

    try {

        $gbpg = CddGuruBesarPengetua::where('id',$id)->delete();

        return Redirect::back()->with('success_message', 'Guru Besar / Pengetua was successfully deleted!');
    } catch (Exception $exception) {
        return back()->withInput()->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
    }
}

// END HRMD RR ADD
public function query($id)
{
    // Fetch the inventory record by ID (adjust model as needed)
    $inventory = Inventory::findOrFail($id);

    // Return a view to display the query details (create this view next)
    return view('cddinventory.query', compact('inventory'));
}
public function submitQuery(Request $request)
{
    $request->validate([
        'message' => 'required|string',
        'inventory_id' => 'required|integer',
    ]);

    $message = $request->input('message');
    $inventoryId = $request->input('inventory_id');

    // Get the inventory record to fetch the pemohon's email
    $inventory = Inventory::find($inventoryId);
    
    if (!$inventory) {
        // If not found in inventory table, try inventory_units table
        $inventory = \App\Models\InventoryUnit::find($inventoryId);
    }
    
    // Get the pemohon's email from the inventory record
    $userEmail = $inventory ? $inventory->emel : 'user@example.com';

    // Send email with both message and inventory data
    Mail::to($userEmail)->send(new QuerySubmittedMail($message, $inventory));
    
    // Update inventory has_query to true (keeping your exact code)
    Inventory::where('id', $inventoryId)->update(['has_query' => true]);

    // Add queried_inventory_id to session flash data here (keeping your exact return)
    return back()->with('success_message', 'Kuiri telah dihantar dan emel telah berjaya dihantar kepada pemohon!')
                 ->with('queried_inventory_id', $inventoryId);
}public function notifyAmendments(Request $request, $id)
{
    $request->validate([
        'response_message' => 'nullable|string|max:500'
    ]);
    
    // Get the inventory record
    $inventory = \App\Models\Inventory::find($id);
    
    if (!$inventory) {
        // Try inventory_units table if not found
        $inventory = \App\Models\InventoryUnit::find($id);
    }
    
    if (!$inventory) {
        \Log::error('Inventory not found', ['id' => $id]);
        return back()->with('error', 'Inventory record not found.');
    }
    
    // Ensure only the applicant can send this notification
    if (Auth::user()->ic_no !== $inventory->ic_no) {
        \Log::warning('Unauthorized attempt to send amendment notification', [
            'user_ic' => Auth::user()->ic_no,
            'inventory_ic' => $inventory->ic_no
        ]);
        return back()->with('error', 'Anda tidak dibenarkan untuk menghantar notifikasi ini.');
    }
    
    // ===========================
    // 📧 DETERMINE TARGET EMAIL
    // ===========================
    // Default to principal email (for legacy records)
    $principalEmail = $inventory->kgp_emel ?? null;
    $principalName  = $inventory->kgp_nama ?? 'Guru Besar/Pengetua';
    
    // If PPK email exists, prioritize it
    if (!empty($inventory->ppk_emel)) {
        $principalEmail = $inventory->ppk_emel;
        $principalName  = $inventory->ppk_nama ?? 'Penolong Pegawai Kerja';
    }

    // ENHANCED LOGGING
    \Log::info('=== AMENDMENT NOTIFICATION DEBUG ===', [
        'inventory_id' => $id,
        'inventory_table' => get_class($inventory),
        'principal_name' => $principalName ?? 'NULL',
        'principal_email' => $principalEmail ?? 'NULL',
        'principal_email_length' => strlen($principalEmail ?? ''),
        'applicant_name' => $inventory->nama ?? 'NULL',
        'applicant_ic' => $inventory->ic_no ?? 'NULL',
        'response_message' => $request->response_message ?? 'NULL',
        'mail_driver' => config('mail.default'),
        'mail_from' => config('mail.from.address'),
    ]);
    
    // ===========================
    // 📧 VALIDATION
    // ===========================
    if (empty($principalEmail)) {
        \Log::error('Principal/PPK email is empty for inventory ID: ' . $id);
        return back()->with('error', 'Emel Guru Besar/Pengetua atau Penolong Pegawai Kerja tidak dijumpai dalam rekod.');
    }
    
    if (!filter_var($principalEmail, FILTER_VALIDATE_EMAIL)) {
        \Log::error('Invalid email format', ['email' => $principalEmail]);
        return back()->with('error', 'Format emel tidak sah: ' . $principalEmail);
    }
    
    try {
        // Test mail configuration before sending
        \Log::info('Testing mail configuration...');
        
        // ===========================
        // ✉️ SEND EMAIL
        // ===========================
        Mail::to($principalEmail)->send(
            new AmendmentsCompletedMail($inventory, $request->response_message)
        );
        
        // Check if mail was queued or sent
        if (Mail::failures()) {
            \Log::error('Mail sending failed', [
                'failures' => Mail::failures()
            ]);
            throw new \Exception('Mail sending failed');
        }
        
        \Log::info('Amendment notification sent successfully', [
            'to' => $principalEmail,
            'timestamp' => now()
        ]);
        
        // ============================================================
        // ✅ UPDATE STATUS TO "WAITING FOR APPROVAL" 
        // ============================================================
        try {
            $statusUpdates = [
                'amendments_notified' => true,
                'amendments_notified_at' => now(),
                'kgp_status' => 'Waiting for Approval'  // 🔥 KEY ADDITION
            ];

            // If record has PPK, also update gb_status
            if (!empty($inventory->ppk_emel) && \Schema::hasColumn($inventory->getTable(), 'gb_status')) {
                $statusUpdates['gb_status'] = 'Waiting for Approval';
            }

            $inventory->update($statusUpdates);
            
            \Log::info('Inventory status updated to Waiting for Approval', [
                'id' => $inventory->id,
                'table' => $inventory->getTable(),
                'status_updates' => $statusUpdates
            ]);
            
        } catch (\Exception $e) {
            \Log::warning('Could not update status fields', [
                'error' => $e->getMessage()
            ]);
        }
        // ============================================================
        
        return back()->with('success_message', 'Notifikasi telah berjaya dihantar kepada ' . $principalName . ' (' . $principalEmail . ')!');
        
    } catch (\Exception $e) {
        \Log::error('Failed to send amendment notification', [
            'error' => $e->getMessage(),
            'error_class' => get_class($e),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
        ]);
        
        return back()->with('error', 'Gagal menghantar notifikasi. Sila semak log untuk maklumat lanjut. Error: ' . $e->getMessage());
    }
}

private function sendPushNotification($inventory)
{
    // 1. Get Guru Besar
    $guruBesar = CddGuruBesarPengetua::where('school', $inventory->nama_sch)->first();

    if (!$guruBesar) {
        \Log::warning('Guru Besar not found', [
            'school' => $inventory->nama_sch,
            'inventory_id' => $inventory->id
        ]);
        return;
    }

    // 2. Get push subscriptions
    $subscriptions = DB::table('push_subscriptions')
        ->where('user_id', $guruBesar->id) // ⚠️ change if you use ic_no/email
        ->get();

    if ($subscriptions->isEmpty()) {
        \Log::warning('No push subscription found', [
            'guru_besar_id' => $guruBesar->id
        ]);
        return;
    }

    // 3. Check VAPID keys
    if (!env('VAPID_PUBLIC_KEY') || !env('VAPID_PRIVATE_KEY')) {
        \Log::error('Missing VAPID keys');
        return;
    }

    // 4. WebPush setup
    $webPush = new WebPush([
        "VAPID" => [
            "subject" => env('VAPID_SUBJECT'),
            "publicKey" => env('VAPID_PUBLIC_KEY'),
            "privateKey" => env('VAPID_PRIVATE_KEY'),
        ],
    ]);

    // 5. Payload
    $payload = json_encode([
        "title" => "Pengesahan penerimaan bahan",
        "body" =>
            "No: SH{$inventory->id}\n" .
            "PO: " . ($inventory->bil_po ?? '-') . "\n" .
            "Pembekal: " . ($inventory->pembekal ?? '-') . "\n" .
            "Sekolah: " . ($inventory->nama_sch ?? '-'),
        "url" => route('cddinventory.notification', $inventory->id),
    ]);

    // 6. Send to all subscriptions
    foreach ($subscriptions as $sub) {

        if (!$sub->endpoint || !$sub->public_key || !$sub->auth_token) {
            continue;
        }

        $webPush->queueNotification(
            Subscription::create([
                "endpoint" => $sub->endpoint,
                "publicKey" => $sub->public_key,
                "authToken" => $sub->auth_token,
            ]),
            $payload
        );
    }

    $webPush->sendBatch();

    // 7. Log success
    \Log::info('Push notification sent successfully', [
        'inventory_id' => $inventory->id,
        'guru_besar' => $guruBesar->name
    ]);
}

}
