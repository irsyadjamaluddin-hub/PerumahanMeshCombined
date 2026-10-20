<?php

namespace App\Http\Controllers;

use Session;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;

use Log;
use Carbon\Carbon;
use Hash;

use App\Models\Announcement;
use App\Models\Announcement2;
use App\Models\Announcementnotification;
use App\Models\SRannouncementnotification;


use App\Mail\AnnouncementEmail;

class AnnouncementController extends Controller
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
    public function announcementindex(Request $request)
    {
        $user = Auth::user();

        // Check if there are any records in the SrNews table
        $announcementExist = Announcement::exists();

        $search = $request->query('q');
        $kind = $request->query('kind');

        $query = Announcement::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('announcement_title', 'like', '%' . $search . '%')
                  ->orWhere('announcement_content', 'like', '%' . $search . '%');
            });
        }

        if ($kind && in_array($kind, ['urgent', 'info', 'update', 'maintenance'])) {
            $query->where('announcement_icon', 'like', '%"' . $kind . '"%');
        }

        $announcements = $query->orderBy('created_at', 'DESC')
            ->paginate(5)
            ->appends($request->query());

        return view('announcement.announcementindex', compact('user', 'announcements', 'announcementExist', 'search', 'kind'));
    }

     public function announcementadmin()
    {
        $user = Auth::user();

        // Check if there are any records in the SrNews table
        $announcementExist = Announcement::exists();

        $announcements = Announcement::orderBy('created_at', 'DESC')->paginate(5);

        $notification = Announcementnotification::all();

        //$notification2 = SRannouncementnotification::all();

        return view('announcement.announcementadmin', compact('user', 'announcements','announcementExist','notification'));
    }

    public function announcementadmincreate()
    {
      $user =  Auth::user();
        return view('announcement.announcementadmin-create',compact('user'));
    }   

    public function announcementstore(Request $request)
{
    $now = Carbon::now();
    $now = new Carbon();
    $now->setTimezone('Asia/Brunei');

    $announcement = new Announcement;
    
    $announcement->announcement_title = $request->announcement_title;
    $announcement->announcement_date = $now;
    $announcement->announcement_icon = json_encode($request->input('announcement_icon'));
    
    // Remove HTML tags and convert <br> tags to line breaks
    $announcementContent = $request->input('announcement_content');
    $announcementContent = strip_tags($announcementContent);
    $announcementContent = str_replace('<br>', "\n", $announcementContent);
    $announcementContent = str_replace('<br/>', "\n", $announcementContent);

    $announcement->announcement_content = $announcementContent;

    // Check if an announcement_file is uploaded
    if ($request->hasFile('announcement_file')) {
        $file = $request->file('announcement_file');
        
        // Check the file size
        $fileSize = $file->getSize();
        $maxFileSize = 2 * 1024 * 1024; // 2MB in bytes

        if ($fileSize > $maxFileSize) {
            return redirect()->back()->withErrors(['file_size' => 'Please use an image size up to 2MB.']);
        }

        // Validate the file
        $validatedData = $request->validate([
          'announcement_file' => 'file|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Generate a unique filename
        $filename = uniqid().'.'.$file->getClientOriginalExtension();

        // Store the file in the public disk
        $destinationPath = public_path('announcement');
        $file->move($destinationPath, $filename);

        $path = 'announcement/' . $filename;
        $announcement->announcement_file = $filename;
        $announcement->announcement_file_path = $path;
    }

    // Handle uploaded pdf
    if ($request->hasFile('pdf_file')) {
        $files = $request->file('pdf_file');
        $pdfFileNames = [];
        $pdfFilePaths = [];

        foreach ($files as $file) {
            // Check the file size
            $fileSize = $file->getSize();
            $maxFileSize = 2 * 1024 * 1024; // 2MB in bytes

            if ($fileSize > $maxFileSize) {
                return redirect()->back()->withErrors(['file_size' => 'Please use an image size up to 2MB.']);
            }

            // Validate the file
            $validatedData = $request->validate([
                'pdf_file.*' => 'file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            ]);

            // Generate a unique ID for the file
            $uniqueId = uniqid();

            // Retrieve the original filename
            $originalFilename = $file->getClientOriginalName();

            // Append the unique ID to the original filename
            $filename = $uniqueId . '_' . $originalFilename;

            // Store the file in the desired disk and directory
            $destinationPath = public_path('announcement');
            $file->move($destinationPath, $filename);

            // Store the file name and path in the respective arrays
            $pdfFileNames[] = $filename;
            $pdfFilePaths[] = 'announcement/' . $filename;
        }

        // Save the pdf_file names and paths as arrays in the Announcement model
        $announcement->pdf_file = $pdfFileNames;
        $announcement->pdf_file_path = $pdfFilePaths;
    }

    $announcement->save();

    $announcementIcons = $request->input('announcement_icon', []);
    $sendToEase = in_array('ease', $announcementIcons);

    if ($sendToEase) {

        $announcementease = new Announcement2;

        $announcementease->announcement_title = $request->announcement_title;
        $announcementease->announcement_date = $now;
        $announcementease->announcement_icon = json_encode($request->input('announcement_icon'));
        
        $announcementContent2 = $request->input('announcement_content');
        $announcementContent2 = strip_tags($announcementContent2);
        $announcementContent2 = str_replace('<br>', "\n", $announcementContent2);
        $announcementContent2 = str_replace('<br/>', "\n", $announcementContent2);

        $announcementease->announcement_content = $announcementContent2;

        // Handle image file synchronization
        if ($request->hasFile('announcement_file')) {
            $announcementease->announcement_file = $announcement->announcement_file;
            $announcementease->announcement_file_path = $path;
        }

        // Handle uploaded pdf synchronization
        if ($request->hasFile('pdf_file')) {
            // Create new paths for announcementease starting with 'storage/announcement'
            $pdfFilePathsEase = $announcement->pdf_file_path;

            $announcementease->pdf_file = $announcement->pdf_file;
            $announcementease->pdf_file_path = $pdfFilePathsEase;
        }

        $announcementease->save();

        $notifiedUsersEase = SRannouncementnotification::where('notification', true)->get();

        // Iterate through each notified user and send the email
        foreach ($notifiedUsersEase as $userEASE) {
            // Get the image file path (if available)
            $notf_image = $announcement->announcement_file;

            // Send the email with the image file path
            Mail::to($userEASE->email)->send(new AnnouncementEmail(
                $request->file('pdf_file'),
                $notf_image, // Pass the image file path here
                $request->announcement_file,
                $request->announcement_title,
                $request->announcement_date,
                json_encode($request->announcement_icon),
                $request->announcement_content,
                $userEASE->email,
                'Announcement',
                $announcement
            ));
        }
    }

    // Retrieve users with notification set to true
    $notifiedUsers = Announcementnotification::where('notification', true)->get();

    // Iterate through each notified user and send the email
    foreach ($notifiedUsers as $user) {
        // Get the image file path (if available)
        $notf_image = $announcement->announcement_file;

        // Send the email with the image file path
        Mail::to($user->email)->send(new AnnouncementEmail(
            $request->file('pdf_file'),
            $notf_image, // Pass the image file path here
            $request->announcement_file,
            $request->announcement_title,
            $request->announcement_date,
            json_encode($request->announcement_icon),
            $request->announcement_content,
            $user->email,
            'Announcement',
            $announcement
        ));
    }

    session()->flash('announcement_added', true);

    try {
        $data = $this->getDataAnnouncement($request);

        return redirect()->route('announcement.announcementadmin')
            ->with('success_message', 'Announcement was successfully added!');
    } catch (Exception $exception) {
        return back()->withInput()
            ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
    }
}

    protected function getDataAnnouncement(Request $request)
    {
        $data = $request->validate([
            'announcement_title'   => 'required',
            'announcement_date'    => 'required',
            'announcement_icon'    => 'required',
            'announcement_content' => 'required',              
        ]);
    } 

    public function announcementedit($created_at)
    {
        // Parse the input created_at to a Carbon instance
        $createdAt = Carbon::parse($created_at);
    
        // Fetch the announcement where created_at matches the same year, month, day, hour, and minute
        $announcement = Announcement::whereBetween('created_at', [
            $createdAt->copy()->second(0),             // start of the minute
            $createdAt->copy()->second(59)             // end of the minute
        ])->first();
    
        $user = Auth::user();
    
        return view('announcement.announcementadmin-edit', compact('announcement', 'user'));
    }


    public function announcementupdate(Request $request, $created_at)
{
    try {
        $createdAt = Carbon::parse($created_at);
        // Fetch both announcement and announcementease records. Announcement's
        // "mysql"-named connection actually resolves to the sqlsrv driver (see
        // config/database.php), so DATE_FORMAT (MySQL-only) can't be used here —
        // whereBetween works on both drivers. Announcement2 genuinely runs on
        // MySQL (the "ease" connection), so its DATE_FORMAT call stays as-is.
        $announcement = Announcement::whereBetween('created_at', [
            $createdAt->copy()->second(0),
            $createdAt->copy()->second(59)
        ])->first();
        $announcementease = Announcement2::whereRaw("DATE_FORMAT(created_at, '%Y-%m-%d %H:%i') = ?", [$createdAt->format('Y-m-d H:i')])->first();
        
        // Generate a unique ID for filenames
        $uniqueId = uniqid();

        // Retrieve existing icons and merge with input icons
        $existingIcons = json_decode($announcement->announcement_icon, true);
        $inputIcons = $request->input('announcement_icon', []);
        if (in_array('ease', $existingIcons) && !in_array('ease', $inputIcons)) {
            $inputIcons[] = 'ease';
        }
        $mergedIcons = array_unique($inputIcons);

        // Update common fields
        $announcement->announcement_title = $request->input('announcement_title');
        $announcement->announcement_icon = json_encode($mergedIcons);

        // Process announcement content
        $announcementContent = $request->input('announcement_content');
        $announcementContent = strip_tags($announcementContent);
        $announcementContent = str_replace(['<br>', '<br/>'], "\n", $announcementContent);
        $announcement->announcement_content = $announcementContent;

        // Handle image file
        if ($request->has('remove_image')) {
            // Remove the image file and path
            if ($announcement->announcement_file_path) {
                Storage::delete($announcement->announcement_file_path);
            }
            $announcement->announcement_file = null;
            $announcement->announcement_file_path = null;
        } elseif ($request->hasFile('announcement_file')) {
            $file = $request->file('announcement_file');
            $fileSize = $file->getSize();
            $maxFileSize = 2 * 1024 * 1024; // 2MB

            if ($fileSize > $maxFileSize) {
                return redirect()->back()->withErrors(['file_size' => 'Please use an image size up to 2MB.']);
            }

            $validatedData = $request->validate([
                'announcement_file' => 'file|mimes:jpg,jpeg,png|max:2048',
            ]);

            $filename = $uniqueId . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('announcement');
            $file->move($destinationPath, $filename);

            if ($announcement->announcement_file_path) {
                Storage::delete($announcement->announcement_file_path);
            }

            $path = 'announcement/' . $filename;
            $announcement->announcement_file = $filename;
            $announcement->announcement_file_path = $path;
        }

        // Handle pdf files
        if ($request->has('remove_file')) {
            $removeImageIndexes = $request->input('remove_file');
            $pdfFileNames = $announcement->pdf_file ?? [];
            $pdfFilePaths = $announcement->pdf_file_path ?? [];

            foreach ($removeImageIndexes as $index) {
                if (isset($pdfFilePaths[$index])) {
                    Storage::delete($pdfFilePaths[$index]);
                    unset($pdfFileNames[$index]);
                    unset($pdfFilePaths[$index]);
                }
            }

            $announcement->setAttribute('pdf_file', array_values($pdfFileNames));
            $announcement->setAttribute('pdf_file_path', array_values($pdfFilePaths));
        }

        if ($request->hasFile('pdf_file')) {
            $files = $request->file('pdf_file');
            $pdfFileNames = [];
            $pdfFilePaths = [];
        
            foreach ($files as $file) {
        
                $fileSize = $file->getSize();
                $maxFileSize = 2 * 1024 * 1024;
        
                if ($fileSize > $maxFileSize) {
                    return redirect()->back()->withErrors([
                        'file_size' => 'Please use a file size up to 2MB.'
                    ]);
                }
        
                $request->validate([
                    'pdf_file.*' => 'file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                ]);
        
                $uniqueId = uniqid();
                $originalFilename = $file->getClientOriginalName();
                $filename = $uniqueId . '_' . $originalFilename;
        
                $destinationPath = public_path('announcement');
        
                $file->move($destinationPath, $filename);
        
                $pdfFileNames[] = $filename;
                $pdfFilePaths[] = 'announcement/' . $filename;
            }
        
            $announcement->pdf_file = $pdfFileNames;
            $announcement->pdf_file_path = $pdfFilePaths;
        }

        $announcement->save();

        if ($announcementease) {
            // Update common fields for announcementease
            $announcementease->announcement_title = $request->input('announcement_title');
            $announcementease->announcement_icon = json_encode($mergedIcons);

            $announcementeaseContent = $request->input('announcement_content');
            $announcementeaseContent = strip_tags($announcementeaseContent);
            $announcementeaseContent = str_replace(['<br>', '<br/>'], "\n", $announcementeaseContent);
            $announcementease->announcement_content = $announcementeaseContent;

            // Handle image file for announcementease
            if ($request->has('remove_image')) {
                if ($announcementease->announcement_file_path) {
                    Storage::delete($announcementease->announcement_file_path);
                }
                $announcementease->announcement_file = null;
                $announcementease->announcement_file_path = null;
            } elseif ($request->hasFile('announcement_file')) {
                $announcementease->announcement_file = $announcement->announcement_file;
                $announcementease->announcement_file_path = $path;
            }

            // Handle pdf files for announcementease
            if ($request->has('remove_file')) {
                $removeImageIndexes = $request->input('remove_file');
                $pdfFileNamesEase = $announcementease->pdf_file ?? [];
                $pdfFilePathsEase = $announcementease->pdf_file_path ?? [];

                foreach ($removeImageIndexes as $index) {
                    if (isset($pdfFilePathsEase[$index])) {
                        Storage::delete($pdfFilePathsEase[$index]);
                        unset($pdfFileNamesEase[$index]);
                        unset($pdfFilePathsEase[$index]);
                    }
                }

                $announcementease->setAttribute('pdf_file', array_values($pdfFileNamesEase));
                $announcementease->setAttribute('pdf_file_path', array_values($pdfFilePathsEase));
            }

            if ($request->hasFile('pdf_file')) {
                $pdfFilePathsEase = $announcement->pdf_file_path;

                $announcementease->setAttribute('pdf_file', $announcement->pdf_file);
                $announcementease->setAttribute('pdf_file_path', $pdfFilePathsEase);
            }

            $announcementease->save();
        }

        return redirect()->route('announcement.announcementadmin')
            ->with('success_message', 'Announcement updated successfully.');
    } catch (Exception $exception) {
        return back()->withInput()
            ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
    }
}

     public function announcementdestroy($created_at)
{
    try {
        $createdAt = Carbon::parse($created_at);

        // Retrieve the announcement and announcementease records. Announcement's
        // "mysql"-named connection actually resolves to the sqlsrv driver (see
        // config/database.php), so DATE_FORMAT (MySQL-only) can't be used here —
        // whereBetween works on both drivers. Announcement2 genuinely runs on
        // MySQL (the "ease" connection), so its DATE_FORMAT call stays as-is.
        $announcement = Announcement::whereBetween('created_at', [
            $createdAt->copy()->second(0),
            $createdAt->copy()->second(59)
        ])->first();
        $announcementease = Announcement2::whereRaw("DATE_FORMAT(created_at, '%Y-%m-%d %H:%i') = ?", [$createdAt->format('Y-m-d H:i')])->first();

        // Check if the announcement record exists
        if ($announcement) {
            // Delete the image from the storage
            if ($announcement->announcement_file_path) {
                Storage::delete($announcement->announcement_file_path);
            }

            // Delete the pdf files from the storage
            if ($announcement->pdf_file_path) {
                foreach ((array) $announcement->pdf_file_path as $pdfPath) { // Cast to array
                    Storage::delete($pdfPath);
                }
            }

            // Delete the announcement record
            $announcement->delete();
        }

        // Check if the announcementease record exists
        if ($announcementease) {
            // Convert the paths in announcementease to the format stored in the storage
            $announcementease->announcement_file_path = str_replace('storage/', 'public/', $announcementease->announcement_file_path);

            $announcementease->pdf_file_path = array_map(function($path) {
                return str_replace('storage/', 'public/', $path);
            }, (array) $announcementease->pdf_file_path); // Cast to array

            // Delete the image from the storage
            if ($announcementease->announcement_file_path) {
                Storage::delete($announcementease->announcement_file_path);
            }

            // Delete the pdf files from the storage
            if ($announcementease->pdf_file_path) {
                foreach ((array) $announcementease->pdf_file_path as $pdfPath) { // Cast to array
                    Storage::delete($pdfPath);
                }
            }

            // Delete the announcementease record
            $announcementease->delete();
        }

        // Redirect with success message
        return redirect()->route('announcement.announcementadmin')
                         ->with('success_message', 'Announcement was successfully deleted!');
    } catch (Exception $exception) {
        // Handle unexpected errors
        return back()->withInput()
                     ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
    }
}

    public function subscribeannouncement(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Validate if the user's email and IC number are not empty
        if (!empty($user->email) && !empty($user->ic_no)) {
            // Create a new SrAnnouncementnotification record or update an existing one
            Announcementnotification::updateOrCreate(
                ['ic_no' => $user->ic_no],
                ['email' => $user->email, 'notification' => true]
            );

            // Redirect back with a success message
            return redirect()->back()->with('success', 'You have subscribed successfully.');
        }

        // If the user's email or IC number is empty, redirect with an error message
        return redirect()->back()->with('error', 'Please make sure your email and IC number are filled in your profile.');
    }

    public function unsubscribeannouncement(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Update the notification status to false
        \App\Models\Announcementnotification::where('email', $user->email)
            ->where('ic_no', $user->ic_no)
            ->update(['notification' => false]);

        // Redirect back to the previous page
        return redirect()->back()->with('success', 'You have successfully unsubscribed.');
    }

    public function notificationdestroy($id)
    {
        $notification = Announcementnotification::findOrFail($id);

        if (!$notification) {
            return redirect()->back()->with('success_message', 'Notification not found.');
        }

        $notification->delete();

        return redirect()->back()->with('error_message', 'Notification deleted successfully');
    }

     public function notificationdestroyEASE($id)
    {
        $notificationEASE = SRannouncementnotification::findOrFail($id);

        if (!$notificationEASE) {
            return redirect()->back()->with('success_message', 'Notification not found.');
        }

        $notificationEASE->delete();

        return redirect()->back()->with('error_message', 'Notification deleted successfully');
    }

    public function toggleNotification(Request $request)
    {
        $notificationSetting = Announcementnotification::findOrFail($request->id);
        
        // Toggle the value of 'notification'
        $notificationSetting->notification = !$notificationSetting->notification;
        $notificationSetting->save();
        
        $notificationStatus = $notificationSetting->notification ? '<span class="badge badge-success mr-2" style="width: 5%;">True</span>' : '<span class="badge badge-warning mr-2" style="width: 5%;">False</span>';
        $notificationType = $notificationSetting->email; // Assuming there's a 'type' attribute, replace it with the appropriate attribute if needed
        
        $message = "Notification for \"$notificationType\" successfully changed to $notificationStatus";
        
        return redirect()->route('announcement.announcementadmin')
            ->with('success_message', $message);
    }

    public function toggleNotificationEase(Request $request)
    {
        $notificationSettingEase = SRannouncementnotification::findOrFail($request->id);
        
        // Toggle the value of 'notification'
        $notificationSettingEase->notification = !$notificationSettingEase->notification;
        $notificationSettingEase->save();
        
        $notificationStatus = $notificationSettingEase->notification ? '<span class="badge badge-success mr-2" style="width: 5%;">True</span>' : '<span class="badge badge-warning mr-2" style="width: 5%;">False</span>';
        $notificationType = $notificationSettingEase->email; // Assuming there's a 'type' attribute, replace it with the appropriate attribute if needed
        
        $message = "Notification for \"$notificationType\" successfully changed to $notificationStatus";
        
        return redirect()->route('announcement.announcementadmin')
            ->with('success_message', $message);
    }




}