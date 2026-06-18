<?php

namespace App\Http\Controllers;

use Session;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;

use Log;
use Carbon\Carbon;
use Hash;

use App\Models\News;

class NewsController extends Controller
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
    public function newsindex()
    {
        $user = Auth::user();

        // Check if there are any records in the News table
        $newsExist = News::exists();

        $news = News::orderBy('created_at', 'DESC')->paginate(8);

        return view('news.newsindex',compact('user', 'news','newsExist'));
    }  

    public function newsadmin()
    {
        $user = Auth::user();

        // Check if there are any records in the News table
        $newsExist = News::exists();

        $news = News::orderBy('created_at', 'DESC')->paginate(8);

        return view('news.newsadmin', compact('user', 'news','newsExist'));
    }

    public function newsadmincreate()
    {
        $user =  Auth::user();

        return view('news.newsadmin-create',compact('user'));
    } 

    public function newsstore(Request $request)
    {
        $now = Carbon::now();
        $now = new Carbon();
        $now->setTimezone('Asia/Brunei');

        $news = new News;

        $news->news_title = $request->news_title;
        $news->news_name = $request->news_name;
        $news->news_date = $request->news_date;

        // Remove HTML tags and convert <br> tags to line breaks
        $newsContent = $request->input('news_content');
        $newsContent = strip_tags($newsContent);
        $newsContent = str_replace('<br>', "\n", $newsContent);
        $newsContent = str_replace('<br/>', "\n", $newsContent);

        $news->news_content = $newsContent;

        // Handle uploaded images
        if ($request->hasFile('news_file')) {
            $files = $request->file('news_file');
            $newsFileNames = [];
            $newsFilePaths = [];

            foreach ($files as $file) {
                // Check the file size
                $fileSize = $file->getSize();
                $maxFileSize = 2 * 1024 * 1024; // 2MB in bytes

                if ($fileSize > $maxFileSize) {
                    return redirect()->back()->withErrors(['file_size' => 'Please use a file size up to 2MB.']);
                }

                // Validate the file
                $validatedData = $request->validate([
                    'news_file.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
                ]);

                // Get the original filename and extension
                $originalFilename = $file->getClientOriginalName();
                $extension = strtolower($file->getClientOriginalExtension());

                // Generate a unique filename for images (jpg, jpeg, png)
                if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
                    $filename = uniqid().'.'.$extension;
                } elseif ($extension === 'pdf') {
                    // Use the original filename for PDF files
                    $filename = $originalFilename;
                } else {
                    // Handle other file types here
                    $filename = uniqid().'.'.$extension;
                }

                // Store the file in the desired disk and directory
                $path = $file->storeAs('news', $filename, 'public');

                // Store the file name and path in the respective arrays
                $newsFileNames[] = $filename;
                $newsFilePaths[] = $path;
            }

            // Save the news_file names and paths as arrays in the SrNews model
            $news->news_file = $newsFileNames;
            $news->news_file_path = $newsFilePaths;
        }

        $news->save();

        try {
            $data = $this->getDataNews($request);

            return redirect()->route('news.newsadmin')
                ->with('success_message', 'News was successfully added!');
        } catch (Exception $exception) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function newsedit($id)
    {
        $news = News::findOrFail($id);
        $user = Auth::user();

        return view('news.newsadmin-edit', compact('news','user'));
    }

    public function newsupdate(Request $request, $id)
    {
        try {
            $news = News::findOrFail($id);
            $news->news_title = $request->input('news_title');
            $news->news_date = $request->input('news_date');
            $news->news_name = $request->input('news_name');

            // Remove HTML tags and convert <br> tags to line breaks
            $newsContent = $request->input('news_content');
            $newsContent = strip_tags($newsContent);
            $newsContent = str_replace('<br>', "\n", $newsContent);
            $newsContent = str_replace('<br/>', "\n", $newsContent);
            $news->news_content = $newsContent;

            // Check if the "Remove image" checkboxes are checked
            if ($request->has('remove_image')) {
                $removeImageIndexes = $request->input('remove_image');
                $newsFileCount = count($news->news_file);
                $newsFileNames = $news->news_file ?? []; // Retrieve existing image filenames or initialize an empty array
                $newsFilePaths = $news->news_file_path ?? []; // Retrieve existing image file paths or initialize an empty array

                foreach ($removeImageIndexes as $index) {
                    // Ensure the index is within the range of the news_file array
                    if ($index >= 0 && $index < $newsFileCount) {
                        if (in_array($index, $removeImageIndexes)) {
                            // Delete the image file and path
                            $filePath = $news->news_file_path[$index];
                            if ($filePath) {
                                Storage::delete($filePath);
                            }

                            // Remove the image from the arrays
                            unset($newsFileNames[$index]);
                            unset($newsFilePaths[$index]);
                        }
                    }
                }

                // Reindex the arrays after removing elements
                $reindexedFileNames = array_values($newsFileNames);
                $reindexedFilePaths = array_values($newsFilePaths);

                // Save the updated result news file names and paths in the News model
                $news->setAttribute('news_file', $reindexedFileNames);
                $news->setAttribute('news_file_path', $reindexedFilePaths);
            }

            // Handle uploaded images
            if ($request->hasFile('news_file')) {
                $files = $request->file('news_file');
                $newsFileNames = $news->news_file ?? []; // Retrieve existing image filenames or initialize an empty array
                $newsFilePaths = $news->news_file_path ?? []; // Retrieve existing image file paths or initialize an empty array

                foreach ($files as $file) {
                    // Check the file size
                    $fileSize = $file->getSize();
                    $maxFileSize = 2 * 1024 * 1024; // 2MB in bytes

                    if ($fileSize > $maxFileSize) {
                        return redirect()->back()->withErrors(['file_size' => 'Please use a file size up to 2MB.']);
                    }

                    // Validate the file
                    $validatedData = $request->validate([
                        'news_file.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
                    ]);

                    // Get the original filename and extension
                    $originalFilename = $file->getClientOriginalName();
                    $extension = strtolower($file->getClientOriginalExtension());

                    // Generate a unique filename for images (jpg, jpeg, png)
                    if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
                        $filename = uniqid().'.'.$extension;
                    } elseif ($extension === 'pdf') {
                        // Use the original filename for PDF files
                        $filename = $originalFilename;
                    } else {
                        // Handle other file types here
                        $filename = uniqid().'.'.$extension;
                    }

                    // Store the file in the desired disk and directory
                    $path = $file->storeAs('news', $filename, 'public');

                    // Store the file name and path in the respective arrays
                    $newsFileNames[] = $filename;
                    $newsFilePaths[] = $path;
                }

            // Save the updated news_file names and paths in the SrNews model
            $news->setAttribute('news_file', array_values($newsFileNames));
            $news->setAttribute('news_file_path', array_values($newsFilePaths));

            }

            $news->save();

            return redirect()->route('news.newsadmin')
                ->with('success_message', 'News updated successfully.');
        } catch (Exception $exception) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function newsdestroy($id)
    {
        try {
            $news = News::findOrFail($id);

            // Delete the file from the storage
            if ($news->news_file_path) {
                Storage::delete($news->news_file_path);
            }

            $news->delete();

            return redirect()->route('news.newsadmin')
                            ->with('success_message', 'News was successfully deleted!');
        } catch (Exception $exception) {
            return back()->withInput()
                        ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    protected function getDataNews(Request $request)
    {
        $data = $request->validate([
            'news_title'   => 'required',
            'news_content' => 'required',                
        ]);
    } 
}
