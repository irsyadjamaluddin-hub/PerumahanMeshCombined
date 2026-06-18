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
use ZipArchive;
use Illuminate\Support\Facades\Storage;

use App\Mail\EmailVendorSebutharga;

use App\Mail\EmailPermohonanBahanKurikulum;

//this is for excel
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use Mail;



use Carbon\Carbon;


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

  

    public function create(Request $request)
    {

        $icNos = Auth::user()->ic_no;
        
	    $employments = Employment::all()
						->where('ic_no', '=', $icNos);

        $biodatas = Biodata::all()
        ->where('ic_no', '=', $icNos);

        $sekolah= School::pluck('label','id')->all();

        $gurubesar = CddGuruBesarPengetua::all();

        // Fetch ISBN options from the database
        $isbnOptions = InventoryBook::pluck('isbn')->toArray(); 
        // return response()->json($isbnOptions);// Replace 'isbn' with the actual column name
           // Fetch information for all ISBNs
        $allBooks = InventoryBook::all();

        $allBooksJson = $allBooks->toJson();
        

     

        return view('cddinventory.create', compact('gurubesar','employments','biodatas','sekolah','isbnOptions','allBooks','allBooksJson'));
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

        $sekolah= School::pluck('label','id')->all();

        
        $allBooks = InventoryBook::all();


        return view('cddinventory.createunit', compact('employments','biodatas','sekolah','allBooks'));
    }

    public function store(Request $request)
{

    $icNos = Auth::user()->ic_no;
    $now = Carbon::now();
    
    $inventory = new Inventory;

        $inventory->nama_sch = $request->nama_sch;
        $inventory->unit = $request->unit;
        $inventory->jabatan = $request->jabatan;
        $inventory->kluster = $request->kluster;
        $inventory->no_tel = $request->no_tel;
        $inventory->ic_no = $icNos;
        $inventory->nama = $request->nama;
        $inventory->emel = $request->emel;
        $inventory->kgp_nama = $request->kgp_nama;
        $inventory->kgp_phone_number = $request->kgp_phone_number;
        $inventory->kgp_ic_no = $request->kgp_ic_no;
        $inventory->kgp_emel = $request->kgp_emel;
        $inventory->created_at = $now;

    $inventory->save();

    // method to take previous ID
    $data1 = Inventory::select('inventory.*')
    ->orderBy('created_at', 'DESC')
    ->first();

    $data2 = $data1->id;


    // email submission for GB

    $notf_userEmail = $request->kgp_emel;
    $notf_namagb = $request->kgp_nama;
    $notf_sekolah = $request->nama_sch;
    $notf_nama = $request->nama;
    $notf_date = $inventory->created_at;
    $notf_id= $data2;
    


    Mail::to($notf_userEmail)->send(new EmailPermohonanBahanKurikulum($notf_userEmail,$notf_namagb,$notf_sekolah,$notf_nama,$notf_date,$notf_id));


    $matapelajaran = $request->matapelajaran;
    $judulbahan = $request->judulbahan;
    $isbn = $request->isbn;
    $pengarang_penerbit = $request->pengarang_penerbit;
    $qty_dipohonkan = $request->qty_dipohonkan;
    $sebab_permohonan = $request->sebab_permohonan;

    if (!empty($request->matapelajaran) && is_array($matapelajaran) || !empty($request->judulbahan) && is_array($judulbahan)) {

        $insert_data_1 = []; // Initialize the array before the loop
    
        for ($count_1 = 0; $count_1 < count($matapelajaran); $count_1++) {
    
            $data_1 = array(
                'inventory_id' => $data2, //previous ID
                'matapelajaran' => $matapelajaran[$count_1],
                'judulbahan' => $judulbahan[$count_1],
                'isbn' => $isbn[$count_1],
                'pengarang_penerbit' => $pengarang_penerbit[$count_1],
                'qty_dipohonkan' => $qty_dipohonkan[$count_1],
                'sebab_permohonan' => $sebab_permohonan[$count_1],
                'created_at' => $now
                
            );
    
            $insert_data_1[] = $data_1;
        }
    
        // Save 'Inventorybbk' data
        InventoryBbk::insert($insert_data_1);
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

public function storepenerimaan(Request $request)
{
    // Get the current date and time
    $now = now();

    // Loop through form inputs
    foreach ($request->all() as $key => $value) {
        // Check if the input starts with 'penerima_'
        if (Str::startsWith($key, 'penerima_')) {
            $id = intval(str_replace('penerima_', '', $key));

            // Retrieve the existing date_recieve for the specific $id
            $existingDateRecieve = InventoryShdept::where('id', $id)->value('date_recieve');

            // Check if date_recieve input is provided before updating
            if ($request->filled('date_recieve_' . $id)) {
                $updateData = [
                    'penerima'      => $request->input('penerima_' . $id),
                    'penerima_icno' => $request->input('penerima_icno_' . $id),
                    'no_do'         => $request->input('no_do_' . $id),
                    'date_recieve'  => $request->input('date_recieve_' . $id) ?? $existingDateRecieve,
                    'updated_at'    => $now,
                ];

                // Handle file upload if a file is provided
                $fileInputName = 'file_' . $id;
                if ($request->hasFile($fileInputName)) {
                    // Get the uploaded file
                    $file = $request->file($fileInputName);

                    // Validate the file
                    $request->validate([
                        $fileInputName => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', // adjust mime types and max size as needed
                    ]);

                    // Define a unique filename and path
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $filePath = $file->storeAs('inventoryborangpenerimaan', $filename, 'public');

                    // Update the updateData array with the file path
                    $updateData['file'] = $filePath; // or 'filename' => $filename if you prefer to store the filename
                }

                // Perform the update operation
                InventoryShdept::where('id', $id)->update($updateData);
            }
        }
    }

    return redirect()->back()->with('success_message', 'Records were successfully updated!');
}








public function storebp(Request $request)
{

    $icNos = Auth::user()->ic_no;
    $now = Carbon::now();

    $inventory =  Inventory::select('inventory.*')
    ->where('id', $request->id)
    ->update([
    
 
        'bp_catatan' => $request->bp_catatan,
        'bp_disahkan_nama' => $request->bp_disahkan_nama,
        'bp_disahkan_icno' => $icNos,
        'bp_disahkan_date' => $now,
        'bp_status'=> 'adminapprove',

    ]);
    

    $data2 = $request->id;
    $bp_judulbahan = $request->bp_judulbahan;
    $bp_isbn = $request->bp_isbn;
    $bp_qty = $request->bp_qty;
    $bp_harga = $request->bp_harga;

    if (!empty($request->bp_judulbahan) && is_array($bp_judulbahan) || !empty($request->bp_isbn) && is_array($bp_isbn)) {

        $insert_data_1 = []; // Initialize the array before the loop
    
        for ($count_1 = 0; $count_1 < count($bp_judulbahan); $count_1++) {
    
            $data_1 = array(
                'inventory_id' => $data2, 
                'bp_judulbahan' => $bp_judulbahan[$count_1],
                'bp_isbn' => $bp_isbn[$count_1],
                'bp_qty' => $bp_qty[$count_1],
                'bp_harga' => $bp_harga[$count_1],
                'created_at' => $now
                
            );
    
            $insert_data_1[] = $data_1;
        }
    
        // Save 'Inventorybbk' data
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
    

    $inventorybookmenengahs = InventoryBook::select('inventory_book.*')
        ->where('sekolah', '=', 'Menengah')
        ->get();

    $inventorybookrendahs = InventoryBook::select('inventory_book.*')
        ->where('sekolah', '=', 'Rendah')
        ->get();
   
    return view('cddinventory.indexbook', compact('inventorybookmenengahs','inventorybookrendahs'));
}








     public function index()
    {
       
        $icNos = Auth::user()->ic_no;

        // $inventory= Inventory::select('inventory.*')
        //  ->orderBy('created_at', 'DESC')
        //  ->where([['ic_no', '=', $icNos]])
        //  ->orWhere('kgp_ic_no', '=', $icNos)
        //  ->get(); 

        $inventory = Inventory::select('inventory.*')
        ->orderBy('created_at', 'DESC')
        ->where('ic_no', '=', $icNos)
        ->whereNotNull('nama_sch')
        ->orWhere('kgp_ic_no', '=', $icNos)
        ->orWhere(function ($query) use ($icNos) {
            $query->orWhereJsonContains('bp_icno', $icNos)
                  ->orWhereJsonContains('bp_icno', null); // Include records with null values
        })
        ->get();

        $inventoryunit = Inventory::select('inventory.*')
        ->orderBy('created_at', 'DESC')
        ->whereNotNull('unit')
        ->where('ic_no', '=', $icNos)
        
        ->orWhere(function ($query) use ($icNos) {
            $query->orWhereJsonContains('bp_icno', $icNos)
                  ->orWhereJsonContains('bp_icno', null); // Include records with null values
        })
        ->get();

        $baucers =  InventoryBaucerPembekal::select('inventory_baucer_pembekal_info.*')
        ->OrderBy('id','DESC')
        ->where('created_by', '=', $icNos)
        ->get();


      

        return view('cddinventory.index', compact('inventory','inventoryunit','baucers') );
                       
    }

    public function indexadmin()
    {
       
        $icNos = Auth::user()->ic_no;

        $inventory= Inventory::select('inventory.*')
         ->orderBy('created_at', 'DESC')
         ->whereNotNull('nama_sch')
         ->where([['kgp_status', '=', 'approve' ]])
         ->get(); 

         $inventoryunit= Inventory::select('inventory.*')
         ->orderBy('created_at', 'DESC')
         ->whereNotNull('unit')
         ->get();

           // Initialize an array to hold inventorybbk for each inventory
            $inventorybbk = [];

            // Loop through each inventory to get related inventorybbk
            foreach ($inventory as $inv) {
                $inventorybbk[$inv->id] = InventoryBbk::where('inventory_id', '=', $inv->id)->get();
            }

            // inventoryunit
                // Initialize an array to hold inventorybbk for each inventory
                $inventorybbkunit = [];

                // Loop through each inventory to get related inventorybbk
                foreach ($inventoryunit as $invunit) {
                    $inventorybbkunit[$invunit->id] = InventoryBbk::where('inventory_id', '=', $invunit->id)->get();
                }



        return view('cddinventory.indexadmin', compact('inventory','inventoryunit','inventorybbk','inventorybbkunit') );
                       
    }

    public function indexsebutharga()
    {
       
        $icNos = Auth::user()->ic_no;

        $inventorysebutharga = InventorySebutharga::select('inventory_sebutharga.*')
        ->orderBy('created_by', 'desc')  // Order by the created_at column in descending order
        ->get();
        
    

        return view('cddinventory.indexsebutharga', compact('inventorysebutharga') );
                       
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

    public function edit($id)
    {

     
        $inventory= Inventory::all()
        ->where('id', '=', $id);

        $inventorybbk= InventoryBbk::all()
        ->where('inventory_id', '=', $id);

        $allBooks = InventoryBook::all();
       
      

    
     
        return view('cddinventory.edit',compact('inventory','inventorybbk','allBooks'));
    }


    public function editunit($id)
    {

     
        $inventoryunit= Inventory::all()
        ->where('id', '=', $id);

        $inventorybbk= InventoryBbk::all()
        ->where('inventory_id', '=', $id);
       
      

    
     
        return view('cddinventory.editunit',compact('inventoryunit','inventorybbk'));
    }

    public function editcddinfo($id)
    {

        $inventorynormalbbk= InventoryBbk::all()
        ->where('id', '=', $id);
       
        return view('cddinventory.editcddinfo',compact('inventorynormalbbk'));
    }

    public function editcddinfoadmin($id)
    {

        $inventorynormalbbk= InventoryBbk::all()
        ->where('id', '=', $id);
       
        return view('cddinventory.editcddinfoadmin',compact('inventorynormalbbk'));
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

    

    public function downloadPdfsAsZip()
    {
        $inventorysebutharga = InventorySebutharga::all(); // Fetch all inventory items
        
        // Check if there are any inventory items
        if ($inventorysebutharga->isEmpty()) {
            return redirect()->back()->with('error', 'No inventory data available.'); // Redirect or handle no data case
        }

        $zipFileName = 'pdfs.zip'; // Name of the zip file
        $zipFilePath = public_path($zipFileName); // Define the path for the zip file

        $zip = new ZipArchive;

        // Create the ZIP file
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            foreach ($inventorysebutharga as $item) {
                // Ensure item exists before accessing properties
                if (!$item) {
                    continue; // Skip if the item is not valid
                }

                // Retrieve necessary data using the item's ID
                $inventorysebuthargaItem = InventorySebutharga::find($item->id);
                if (!$inventorysebuthargaItem) {
                    continue; // Skip if the inventory item doesn't exist
                }

                // Get related data
                $inventoryshbook = InventoryShBk::where('sh_id', $item->id)->get();
                $inventoryshdept = InventoryShdept::where('sh_id', $item->id)->get();
                $inventoryshdeptorder = InventoryShdeptOrder::where('sh_id', $item->id)->get();

                // Fetch ISBN options from the database
                $isbnOptions = InventoryBook::pluck('isbn')->toArray();
        
                // Fetch information for all ISBNs
                $allBooks = InventoryBook::all();  

                // Prepare the file path
                $filePath = !empty($inventoryshdept->file) ? asset('storage/' . $inventoryshdept->file) : null;

                // Prepare data for the view
                $viewData = [
                    'inventorysebutharga' => $inventorysebuthargaItem,
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

                // Render PDF
                $dompdf->render();

                // Get the PDF content
                $pdfContent = $dompdf->output(); 

                // Add the PDF content to the ZIP archive
                $pdfFileName = 'SH' . $item->id . '.pdf'; // Specify the PDF file name
                $zip->addFromString($pdfFileName, $pdfContent); // Add PDF with specified name
            }

            $zip->close(); // Close the zip archive

            // Return the ZIP file as a download
            return response()->download($zipFilePath)->deleteFileAfterSend(true);
        }

        // Error handling if ZIP file creation fails
        return redirect()->back()->with('error', 'Failed to create ZIP file.');
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
 
    // dd($request->all());

    $now = Carbon::now();

            $id = $request->sh_id;

            $inventorysebutharga = InventorySebutharga::where('id', $id)
            ->update([
                'bil_po' => $request->bil_po,
                'pembekal' => $request->pembekal,
                'emel_pembekal' => $request->emel_pembekal,
                'updated_at' => $now,
            ]);


        return redirect()->back()
        ->with('success_message', 'Record was successfully updated!');
  
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

    public function updatecddinfoadmin(Request $request)
    {
     

        $now = Carbon::now();
        $icNos = Auth::user()->ic_no;


                $inventorynormalbbk =  InventoryBbk::select('inventorybbk.*')
                ->where('id', $request->id)
                ->update([
                
             
                    'cdd_qty_diluluskan' => $request->cdd_qty_diluluskan,
                    'cdd_status' => $request->cdd_status,
                    'cdd_catatan' => $request->cdd_catatan,
                    'updated_admin' => $now,
                    'admin'=> $icNos

                ]);

            return redirect()->back()
            ->with('success_message', 'Record was successfully updated!');

        
          
    }

    public function update(Request $request)
    {
        $now = Carbon::now();
        
        $inventory_id = $request->inventory_id;
    
        $matapelajaran = $request->matapelajaran;
        $judulbahan = $request->judulbahan;
        $isbn = $request->isbn;
        $pengarang_penerbit = $request->pengarang_penerbit;
        $qty_dipohonkan = $request->qty_dipohonkan;
        $sebab_permohonan = $request->sebab_permohonan;

    if (!empty($request->matapelajaran) && is_array($matapelajaran) || !empty($request->judulbahan) && is_array($judulbahan)) {

        $insert_data_1 = []; // Initialize the array before the loop
    
        for ($count_1 = 0; $count_1 < count($matapelajaran); $count_1++) {
    
            $data_1 = array(
                'inventory_id' => $inventory_id, //previous ID
                'matapelajaran' => $matapelajaran[$count_1],
                'judulbahan' => $judulbahan[$count_1],
                'isbn' => $isbn[$count_1],
                'pengarang_penerbit' => $pengarang_penerbit[$count_1],
                'qty_dipohonkan' => $qty_dipohonkan[$count_1],
                'sebab_permohonan' => $sebab_permohonan[$count_1],
                'updated_at' => $now
                
            );
    
            $insert_data_1[] = $data_1;
        }
    
        // Save 'Inventorybbk' data
        InventoryBbk::insert($insert_data_1);
    }

    $inventory =  Inventory::select('inventory.*')
    ->where('id', $request->id)
    ->update([
        'kgp_status'         =>      $request->kgp_status,
        'kgp_amendmentreasons'         =>      $request->kgp_amendmentreasons

    ]);

 

    return redirect()->back()
    ->with('success_message', 'Record was successfully updated!');

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

public function bpform($id)
{
    $inventory= Inventory::all()
    ->where('id', '=', $id);

    $inventorybp= Inventorybp::all()
    ->where('inventory_id', '=', $id);

    $icNos = Auth::user()->ic_no;
    
    $employments = Employment::all()
                    ->where('ic_no', '=', $icNos);
                    
    $sekolah= School::pluck('label','id')->all();


    return view('cddinventory.bpform', compact('employments','sekolah','inventory','inventorybp'));
}

public function updatebp(Request $request)
{

    $icNos = Auth::user()->ic_no;
    $now = Carbon::now();

    $inventory =  Inventory::select('inventory.*')
    ->where('id', $request->id)
    ->update([
    
 
        'bp_recieve_nama' => $request->bp_recieve_nama,
        'bp_recieve_icno' => $request->bp_recieve_icno,
        'bp_recieve_jawatan' => $request->bp_recieve_jawatan,
        'bp_recieve_date' => $now,

    ]);

    return redirect()->back()
    ->with('success_message', 'Record was successfully updated!');

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







}
