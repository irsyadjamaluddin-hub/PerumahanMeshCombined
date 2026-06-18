<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Employment;
use App\Models\Biodata;
use App\Models\Prestasi;
use App\Models\Department;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Exceptions\PostTooLargeException;
use App\Models\Contact;






use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    public function index()
    {
           $ic = Auth::user()->ic_no;
           $prestasi= Prestasi::select('prestasi.*')->where('ic_no', $ic )->orderBy('created_at', 'DESC')->get();
           $departments = Department::pluck('label','id')->all();

        return view('prestasi.index', compact('prestasi','departments'));
    }

    public function indexadmin()
    {

        if (Auth::user()->hasRole('ROLE_SUPERADMIN') || Auth::user()->hasRole('ROLE_PRESTASI')){
            $prestasi = Prestasi::select('prestasi.*')
            ->orderBy('created_at', 'DESC')
            ->get();
        }

        return view('prestasi.indexadmin', compact('prestasi'));
    }

    public function create()
    {

        $icNos = Auth::user()->ic_no;
        
	    $employments = Employment::all()
						->where('ic_no', '=', $icNos);

        $biodatas = Biodata::all()
        ->where('ic_no', '=', $icNos);

   $contacts = Contact::all()
        ->where('ic_no', '=', $icNos);


        return view('prestasi.create', compact('employments','biodatas','contacts'));
    }

    public function edit($id)
    {

        $icNos = Auth::user()->ic_no;

        $prestasi= Prestasi::all()
            ->where('id', '=', $id);

        $employments = Employment::all()
        ->where('ic_no', '=', $icNos);

        $biodatas = Biodata::all()
        ->where('ic_no', '=', $icNos);


        $contacts = Contact::all()
        ->where('ic_no', '=', $icNos);



  

        return view('prestasi.edit', compact('prestasi','employments','biodatas','contacts'));
    }

    public function editadmin($id)
    {
        
        $prestasi = Prestasi::all()
            ->where('id', '=', $id);  
            
       
      
    

        return view('prestasi.editadmin', compact('prestasi'));
    }

    public function store(Request $request)
    {


        $icNos = Auth::user()->ic_no;
        $prestasi = new Prestasi;
        
        $prestasi->ic_no = $icNos;
        $prestasi->nama = $request->nama;
        $prestasi->ic_no = $icNos;
        $prestasi->telephone_mobile = $request->telephone_mobile;
        $prestasi->jabatan = $request->jabatan;
        $prestasi->perkara = $request->perkara;
        $prestasi->catatan = $request->catatan;

// Handle uploaded images
if ($request->hasFile('file')) {
    $files = $request->file('file');
    $FileNames = $prestasi->file ?? [];
    $FilePaths = $prestasi->filename ?? [];

    foreach ($files as $file) {
        // Check if the file is empty
        if ($file->getSize() === 0) {
            return redirect()->back()->withErrors(['file' => 'The selected file is empty.']);
        }

        // Check the file size before anything else
        $fileSize = $file->getSize();
        $maxFileSize = 2 * 1024 * 1024; // 2MB in bytes

        if ($fileSize > $maxFileSize) {
            return redirect()->back()->withErrors(['file_size' => 'Please use a file size up to 2MB.']);
        }

        // Validate the file
        $validatedData = $request->validate([
            'file.*' => 'file|mimes:pdf|max:2048',
        ]);

        // Get the original filename and extension
        $originalFilename = $file->getClientOriginalName();
        $extension = strtolower($file->getClientOriginalExtension());

        // Store the file in the desired disk and directory
        $path = $file->storeAs('public/prestasi', $originalFilename);

        // Store the file name and path in the respective arrays
        $FileNames[] = $originalFilename;
        $FilePaths[] = $path;
    }

    $prestasi->setAttribute('file', array_values($FileNames));
    $prestasi->setAttribute('filename', array_values($FilePaths));
} else {
    // Handle the case where no file is selected
    return redirect()->back()->withErrors(['file' => 'The Uploaded file exceeded 2MB']);
}


// Save data
$prestasi->save();

    $contact = Contact::updateOrCreate([
        'ic_no' => $request->input('ic_no'),
    ],

    [
       
        'telephone_mobile' => $request->input('telephone_mobile'),
        
    ]);

        return redirect()->route('prestasi.prestasi.index')
            ->with('success_message', 'New prestasi record was successfully added!');
    }


    public function updatearchived(Request $request,$id)
     {
        $request->validate([]);

        $now = Carbon::now();

        try {
            $prestasi =  Prestasi::select('prestasi.*')
            ->where('id', $request->id)
            ->update([
                  'perkara'         =>      $request->perkara,
                  'catatan'         =>      $request->catatan,
                  'updated_at'         =>      $now,
                  ]);

            // Retrieve the updated Prestasi model instance
           $prestasi = Prestasi::find($id);

 
        // Check if the "Remove file" for pdf checkboxes are checked
        if ($request->has('remove_file')) {
            $removeImageIndexes = $request->input('remove_file');
            $FileCount = count($prestasi->file);
            $FileNames = $prestasi->file ?? []; // Retrieve existing image filenames or initialize an empty array
            $FilePaths = $prestasi->filename ?? []; // Retrieve existing image file paths or initialize an empty array

            foreach ($removeImageIndexes as $index) {
                // Ensure the index is within the range of the pdf_file array
                if ($index >= 0 && $index < FileCount) {
                    if (in_array($index, $removeImageIndexes)) {
                        // Delete the image file and path
                        $filePath = $prestasi->filename[$index];
                        if ($filePath) {
                            Storage::delete($filePath);
                        }

                        // Remove the image from the arrays
                        unset($FileNames[$index]);
                        unset($FilePaths[$index]);
                    }
                }
            }

            // Reindex the arrays after removing elements
            $reindexedFileNames = array_values($FileNames);
            $reindexedFilePaths = array_values($FilePaths);

            // Save the updated result pdf file names and paths in the Announcement model
            $prestasi->setAttribute('file', $reindexedFileNames);
            $prestasi->setAttribute('filename', $reindexedFilePaths);
        }

    // Handle uploaded images
    if ($request->hasFile('file')) {
        $files = $request->file('file');
        $FileNames = $prestasi->file ?? []; // Retrieve existing image filenames or initialize an empty array
        $FilePaths = $prestasi->filename ?? []; // Retrieve existing image file paths or initialize an empty array

        foreach ($files as $file) {
            // Check the file size
            $fileSize = $file->getSize();
            $maxFileSize = 2 * 1024 * 1024; // 2MB in bytes

            if ($fileSize > $maxFileSize) {
                return redirect()->back()->withErrors(['file_size' => 'Please use a file size up to 2MB.']);
            }

            // Validate the file
            $validatedData = $request->validate([
                'file.*' => 'file|mimes:pdf|max:2048',
            ]);

            // Get the original filename and extension
            $originalFilename = $file->getClientOriginalName();
            $extension = strtolower($file->getClientOriginalExtension());


            // Store the file in the desired disk and directory
            $path = $file->storeAs('public/prestasi', $originalFilename);

            // Store the file name and path in the respective arrays
            $FileNames[] = $originalFilename;
            $FilePaths[] = $path;
        }

        $prestasi->setAttribute('file', array_values($FileNames));
        $prestasi->setAttribute('filename', array_values($FilePaths));
        

    }

        return redirect()->route('prestasi.prestasi.index')
            ->with('success_message', 'Dispatch updated successfully.');
    } catch (Exception $exception) {
        return back()->withInput()
            ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
    }
    }

    public function update(Request $request)
{
    $request->validate([
        // Add your validation rules here, if needed.
    ]);

    $now = Carbon::now();

    try {
        // Retrieve the updated Prestasi model
        $prestasi = Prestasi::where('id', $request->id)->firstOrFail();

        $prestasi->update([
            'perkara' => $request->perkara,
            'catatan' => $request->catatan,
            'updated_at' => $now,
        ]);

        // Handle the "Remove file" checkboxes
    if ($request->has('remove_file')) {
        $removeImageIndexes = $request->input('remove_file');

        // Initialize or retrieve the existing arrays
        $FileNames = $prestasi->file ?? [];
        $FilePaths = $prestasi->filename ?? [];

        foreach ($removeImageIndexes as $index) {
            // Check if the index is valid
            if ($index >= 0 && $index < count($FileNames)) {
                // Delete the file and remove it from the arrays
                $filePath = $FilePaths[$index] ?? null;
                if ($filePath) {
                    Storage::delete($filePath);
                }

                // Remove elements from the arrays
                unset($FileNames[$index]);
                unset($FilePaths[$index]);
            }
        }

        // Reindex the arrays after removing elements
        $FileNames = array_values($FileNames);
        $FilePaths = array_values($FilePaths);
    }

// ...

    // Handle uploaded files
    if ($request->hasFile('file')) {
        $files = $request->file('file');

        // Existing file arrays or empty arrays if they don't exist
        $FileNames = $prestasi->file ?? [];
        $FilePaths = $prestasi->filename ?? [];

        foreach ($files as $file) {
            // Validate the file
            $validatedData = $request->validate([
                'file.*' => 'file|mimes:pdf|max:2048',
            ]);

            // Store the file in the desired disk and directory
            $originalFilename = $file->getClientOriginalName();
            $path = $file->storeAs('public/prestasi', $originalFilename);

            // Add the new file name and path to the existing arrays
            $FileNames[] = $originalFilename;
            $FilePaths[] = $path;
        }
    }

      // Only update the "file" and "filename" attributes if they are not empty
      if (!empty($FileNames)) {
        $prestasi->file = $FileNames;
        $prestasi->filename = $FilePaths;
        $prestasi->save();
    }



        return redirect()->route('prestasi.prestasi.index')
            ->with('success_message', 'Updated successfully.');
    } catch (Exception $exception) {
        return back()->withInput()
            ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
    }
}






    public function updateadmin(Request $request)
    {
       

        $now = Carbon::now();

        $icNos = Auth::user()->ic_no;

            $prestasi =  Prestasi::select('prestasi.*')
                ->where('id', $request->id)
                ->update([
                    'status'         =>      $request->status,
                    'admin_icno'=>$icNos,
                    'catatanadmin'=>$request->catatanadmin,
                    'updated_at' => $now

                ]);
        

        return redirect()->route('prestasi.prestasi.indexadmin')
            ->with('success_message', 'Data record was successfully updated!');
    }

        public function destroy($id)
    {
        try {

            $prestasi = Prestasi::where('id', $id)->delete();

            return Redirect::back()->with('success_message','Prestasi Record was successfully deleted!');
            
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }




}
