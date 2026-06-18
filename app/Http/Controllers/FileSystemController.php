<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

use App\Models\Employment;
use App\Models\Biodata;
use App\Models\Contact;
use App\Models\FileSystem;
use App\Models\Filefsm;
use Symfony\Component\HttpFoundation\StreamedResponse;
use ZipArchive;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Finder\Finder;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use PhpZip\ZipFile;
use PharData;




class FileSystemController extends Controller


{

    public function createfsm()
    {
        // Fetch necessary data like employments, biodatas, contacts
        $icNos = Auth::user()->ic_no;
        $employments = Employment::all()->where('ic_no', '=', $icNos);
        $biodatas = Biodata::all()->where('ic_no', '=', $icNos);
        $contacts = Contact::all()->where('ic_no', '=', $icNos);

        return view('fsm.createfsm', compact('employments', 'biodatas', 'contacts'));

    }


    public function index()
    {
        $icNo = Auth::user()->ic_no;

        // Fetch documents uploaded by the authenticated user

        $folders = FileSystem::select('id', 'folder', 'created_at')
        ->where('ic_no', $icNo) // Filter by authenticated user's ic_no
        ->distinct() // Fetch distinct folder names
        ->orderBy('created_at', 'DESC') // Order by created_at in descending order
        ->get();

         // Fetch shared folders
         $sharedFolders = FileSystem::select('id', 'folder', 'created_at')
         ->where('shared_with', 'like', "%$icNo%") // Check if user's IC number is in the shared_with column
         ->distinct() // Fetch distinct folder names
         ->orderBy('created_at', 'DESC') // Order by creation date in descending order
         ->get();

        return view('fsm.index', compact('folders', 'sharedFolders'));
    }

    public function showSharedFolders()
{
    // Retrieve shared folders
    $sharedFolders = FileSystem::select('id', 'folder', 'created_at')
        ->where('shared_with', 'like', "%" . auth()->user()->ic_no . "%")
        ->distinct()
        ->orderBy('created_at', 'DESC')
        ->get();

    // Pass the sharedFolders data to the view
    return view('fsm.sharedfolder', compact('sharedFolders'));
}

public function showfile()
{
    $icNo = Auth::user()->ic_no;

    // Fetch folders along with their IDs and creation timestamps
    $folders = FileSystem::select('id', 'folder', 'created_at')
        ->where('ic_no', $icNo) // Filter by authenticated user's ic_no
        ->distinct() // Fetch distinct folder names
        ->orderBy('created_at', 'DESC') // Order by created_at in descending order
        ->get();

    return view('fsm.fsm.createfsm', compact('folders'));
}

// working but docs nda appear and masuk database
public function storefsm(Request $request)
{
    $icNo = auth()->user()->ic_no;

    // Create the folder in the file_storage table
    $folder = FileSystem::create([
        'name' => $request->name,
        'ic_no' => $icNo,
        'folder' => $request->folder,
    ]);

    // Check if files are present in the request
    if ($request->hasFile('file')) {
        // Get the files from the request
        $files = $request->file('file');

        // Store each file in the files table
        foreach ($files as $file) {
            // Process and store the file with original filename
            $filename = $file->getClientOriginalName();
            $path = $file->storeAs('public/fsm/' . $folder->folder, $filename); // Corrected usage of storeAs

            // Create a new file record in the files table
            Filefsm::create([
                'folder_id' => $folder->id,
                'filename' => $filename,
                'file_path' => $path,
            ]);
        }
    }

    // Redirect or return response as needed
    return redirect()->route('fsm.fsm.index')->with('success_message', 'Files uploaded successfully.');
}

public function addDocumentsfsm(Request $request, $folderId)
{
    // Retrieve the folder based on the folder ID
    $folder = FileSystem::findOrFail($folderId);

    // Check if files are present in the request
    if ($request->hasFile('file')) {
        // Get the files from the request
        $files = $request->file('file');

        // Store each file in the files table
        foreach ($files as $file) {
            // Process and store the file with original filename
            $filename = $file->getClientOriginalName();
            $path = $file->storeAs('public/fsm/' . $folder->folder, $filename); // Use folder name instead of icNo

            // Create a new file record in the files table
            Filefsm::create([
                'folder_id' => $folder->id,
                'filename' => $filename,
                'file_path' => $path,
            ]);
        }
    }

    // Redirect or return response as needed

    return redirect()->route('fsm.fsm.editfsm', ['id' => $folderId])->with('success_message', 'New documents added successfully.');

}

public function editfsm($id)
{
    // Retrieve the folder ID and folder name
    $folder = FileSystem::findOrFail($id);
    $folder_id = $folder->id;
    $folderName = $folder->folder;

    // Retrieve files associated with the folder
    $files = Filefsm::where('folder_id', $id)->get();

    // Pass data to the view
    return view('fsm.editfsm', compact('folder_id', 'folderName', 'files'));
}





    // Controller method to delete the folder
public function destroy($id)
{
    try {
        $folder = FileSystem::findOrFail($id);

        // Delete all files associated with the folder
        // Assuming 'files' is the relationship between FileSystem and files
         $folder->files()->delete();

        // Delete the folder
        $folder->delete();

        return redirect()->route('fsm.fsm.index')->with('success_message', 'Folder has been deleted successfully!');
    } catch (\Exception $exception) {
        return back()->withInput()->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
    }
}

public function destroyfile($id)
{
    try {
        // Find the file based on the file ID
        $file = Filefsm::findOrFail($id);

        // Store the folder ID before deleting the file
        $folderId = $file->folder_id;

        // Delete the file
        Storage::delete($file->file_path); // Delete the file from storage

        // Delete the file record from the database
        $file->delete();

        // Redirect back to the editfsm page with the appropriate folder ID
        return redirect()->route('fsm.fsm.editfsm', ['id' => $folderId])->with('success_message', 'File has been deleted successfully!');
    } catch (\Exception $exception) {
        return back()->withInput()->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
    }
}


public function grantAccess(Request $request, $folderId)
{
    // Retrieve the folder based on the folder ID
    $folder = FileSystem::findOrFail($folderId);

    // Retrieve the IC numbers of the target users to grant access
    $icNos = []; // Initialize an empty array

    // Pass the folder ID and folder object to the view
    return view('fsm.accessfsm', compact('folderId', 'folder', 'icNos'));
}



public function storeAccess(Request $request, $folderId)
{
    // Validate the request data
    $request->validate([
        'ic_no' => 'required|array', // Ensure ic_no is an array
        'ic_no.*' => 'required|exists:users,ic_no', // Validate each ic_no in the array
    ]);

    // Retrieve the folder based on the folder ID
    $folder = FileSystem::findOrFail($folderId);

    // Check if shared_with is already an array
    $sharedWith = $folder->shared_with ? explode(',', $folder->shared_with) : [];

    // Retrieve the array of IC numbers from the request
    $newIcNos = $request->input('ic_no');

    // Merge the existing and new IC numbers, removing duplicates
    $mergedIcNos = array_unique(array_merge($sharedWith, $newIcNos));

    // Convert merged IC numbers to a string separated by commas
    $updatedSharedWith = implode(',', $mergedIcNos);

    // Update the folder's 'shared_with' column with the updated list of IC numbers
    $folder->update(['shared_with' => $updatedSharedWith]);

    // Redirect to the route for displaying shared users with success message
    return redirect()->route('fsm.showAccessUsers', ['folderId' => $folderId])
        ->with('success_message', 'Access granted successfully.');
}


public function showAccessUsers($folderId)
{
    // Retrieve the folder based on the folder ID
    $folder = FileSystem::findOrFail($folderId);

    // Retrieve shared users for the target folder
    $sharedUsers = $folder->shared_with ? explode(',', $folder->shared_with) : []; // Convert string to array, or use empty array if string is empty

    // Pass the folder object and shared users to the view
    return view('fsm.access_users', compact('folder', 'sharedUsers'));
}


public function revokeAccess($folderId, $icNo)
{
    try {
        // Retrieve the folder based on the folder ID
        $folder = FileSystem::findOrFail($folderId);

        // Check if shared_with is not null and not empty
        if ($folder->shared_with) {
            // Convert shared_with from string to array
            $sharedWith = explode(',', $folder->shared_with);

            // Remove the IC number from the shared_with array
            $updatedSharedWith = array_diff($sharedWith, [$icNo]);

            // Convert the updated shared_with array back to a comma-separated string
            $updatedSharedWithString = implode(',', $updatedSharedWith);

            // Update the folder's 'shared_with' column with the updated list of IC numbers
            $folder->update(['shared_with' => $updatedSharedWithString]);
        }

        // Redirect back to the showAccessUsers route for the same folder
        return redirect()->route('fsm.showAccessUsers', ['folderId' => $folderId])
            ->with('success_message', 'Access revoked successfully.');
    } catch (\Exception $exception) {
        return back()->withInput()->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
    }
}

public function serveFile($folderName, $filename)
{
    // Construct the full file path
    $filePath = public_path('fsm/' . $folderName . '/' . $filename);

    // Dump and die to inspect the constructed file path
    //dd($filePath);

    // Check if the file exists
    if (file_exists($filePath)) {
        // Determine the content type based on the file's extension
        $contentType = mime_content_type($filePath);
        // Serve the file with a proper Content-Type
        return response()->file($filePath, ['Content-Type' => $contentType]);
    } else {
        // Handle the case when the file doesn't exist
        return abort(404);
    }
}


// below codes untuk user download whole folder
// wani nda delete jic beguna in the future

// this one dpt download tpi document nya masih alien code
// public function serveFolder($folderId)
// {
//     // Retrieve the folder based on the folder ID
//     $folder = FileSystem::findOrFail($folderId);

//     // Set the response headers for streaming the folder contents
//     $headers = [
//         'Content-Type' => 'application/octet-stream',
//         'Content-Disposition' => 'attachment; filename="' . $folder->folder . '.tar.gz"',
//     ];

//     // Prepare the response as a streamed response
//     $response = new StreamedResponse(function () use ($folder) {
//         // Open a file pointer for output
//         $output = fopen('php://output', 'w');

//         // Create a recursive directory iterator to traverse the folder
//         $directoryIterator = new RecursiveDirectoryIterator(storage_path("app/public/fsm/{$folder->folder}"));
//         $recursiveIterator = new RecursiveIteratorIterator($directoryIterator);

//         // Loop through each file and stream its contents
//         foreach ($recursiveIterator as $file) {
//             // Check if the item is a file (not a directory)
//             if ($file->isFile()) {
//                 // Get the relative path of the file
//                 $relativePath = substr($file->getPathname(), strlen(storage_path("app/public/fsm/{$folder->folder}")) + 1);

//                 // Write the relative path to the output stream
//                 fwrite($output, $relativePath . PHP_EOL);

//                 // Write the file contents to the output stream
//                 fwrite($output, file_get_contents($file->getPathname()) . PHP_EOL);
//             }
//         }

//         // Close the output file pointer
//         fclose($output);
//     });

//     // Set response headers
//     foreach ($headers as $key => $value) {
//         $response->headers->set($key, $value);
//     }

//     // Return the streamed response
//     return $response;
// }



// this one dapat download one document sja
// public function serveFolder($folderId)
// {
//     // Retrieve the folder based on the folder ID
//     $folder = FileSystem::findOrFail($folderId);

//     // Get the file path
//     $folderPath = storage_path("app/public/fsm/{$folder->folder}");

//     // Check if the folder exists
//     if (!is_dir($folderPath)) {
//         return response()->json(['error' => 'Folder not found'], 404);
//     }

//     // Create a directory iterator
//     $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($folderPath));

//     // Set response headers for downloading the files
//     $headers = [
//         'Content-Type' => 'application/octet-stream',
//         'Content-Disposition' => 'attachment; filename="' . $folder->folder . '.tar.gz"',
//     ];

//     // Prepare the response as a streamed response
//     $response = new StreamedResponse(function () use ($files) {
//         // Loop through each file and serve its contents
//         foreach ($files as $file) {
//             // Check if the item is a file (not a directory)
//             if ($file->isFile()) {
//                 // Serve the file with a proper Content-Disposition
//                 header('Content-Disposition: attachment; filename="' . basename($file) . '"');

//                 // Stream the file contents
//                 readfile($file->getPathname());
//             }
//         }
//     });

//     // Set response headers
//     foreach ($headers as $key => $value) {
//         $response->headers->set($key, $value);
//     }

//     // Return the streamed response
//     return $response;
// }




}
