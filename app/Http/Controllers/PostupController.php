<?php

namespace App\Http\Controllers;
use App\Models\Postup;
use Illuminate\Support\Facades\Auth;
use App\Models\Biodata;
use App\Models\Soalanbiskitadepartment;
use App\Models\Employment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;


use Illuminate\Http\Request;

class PostupController extends Controller
{

    public function postupform()
    {
        return view('postup1');
    }
  
    public function indexadmin()
    {
       
        $postups= PostUp::select('postups.*')->orderBy('created_at', 'DESC')->get();
     
        return view('postup.indexadmin', compact('postups'));


    }

    public function store(Request $request)
    {
     
        $request->validate([
            'name' => 'required',
            'ic_no' => 'required',
            'filename' => 'required',
            'subjek'=>'required',
            'rujukan'=>'required',
       
            
        ]);

       
        $now = Carbon::now();


            $postups = new Postup;
            $postups-> subjek = $request->subjek;
            $postups-> rujukan = $request->rujukan;
            $postups-> name = $request->name;
            $postups-> ic_no = $request->ic_no;
            $postups->created_at = $now;

            // Handle uploaded images
            if ($request->hasFile('filename')) {
                $files = $request->file('filename');
                $postupsFileNames = $postups->file ?? []; // Retrieve existing image filenames or initialize an empty array
                $postupsFilePaths = $postups->filename ?? []; // Retrieve existing image file paths or initialize an empty array

                foreach ($files as $file) {
                    // Check the file size
                    $fileSize = $file->getSize();
                    $maxFileSize = 7 * 1024 * 1024; // 7MB in bytes

                    if ($fileSize > $maxFileSize) {
                        return redirect()->back()->withErrors(['file_size' => 'Please use an image size up to 7MB.']);
                    }

                    // Validate the file
                    $validatedData = $request->validate([
                        'filename.*' => 'file|mimes:pdf,jpg,jpeg,png|max:7168',
                    ]);

                    // Generate a unique ID for the file
                    $uniqueId = uniqid();

                    // Retrieve the original filename
                    $originalFilename = $file->getClientOriginalName();

                    // Append the unique ID to the original filename
                    $filename = $uniqueId . '_' . $originalFilename;

                    // Store the file in the desired disk and directory
                    $path = $file->storeAs('public/postup', $filename);

                    // Store the file name and path in the respective arrays
                    $postupsFileNames[] = $filename;
                    $postupsFilePaths[] = $path;
                }

            // Save the updated file names and paths in the Postup model
            $postups->setAttribute('filename', array_values($postupsFileNames));
            $postups->setAttribute('file', array_values($postupsFilePaths));

            }

        // Save 'Postup' data
    $postups-> save();

    return Redirect::back()->with('success_message','Your PostUP detail has been successfully uploaded!');
    }

    public function destroy($id)
    {
        try {

            $postups = Postup::where('id', $id)->delete();

            return Redirect::back()->with('success_message','PostUp Record was successfully deleted!');
            
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }
}
