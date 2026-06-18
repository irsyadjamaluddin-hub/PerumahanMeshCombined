<?php

namespace App\Http\Controllers;

use Session;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use Log;
use Carbon\Carbon;
use Hash;

use App\Models\Biodata;
use App\Models\Employment;
use App\Models\Department;
use App\Models\Jawatanlist;
use App\Models\TaskTrackingGiven;
use App\Models\TaskTrackingCreate;
use App\Models\TaskTrackingStaffKod;
use App\Models\TaskTrackingStatusTindakan;

class TaskTrackingController extends Controller
{
    public function indextask()
    {

        $icNos = Auth::user()->ic_no;

        $tasks = TaskTrackingGiven::with('taskCreated', 'taskStatus')
        ->where('task_kod', $icNos)
        ->where(function ($query) {
            $query->where('task_staffstatus', '!=', 'Selesai')
                ->orWhereNull('task_staffstatus')
                ->orWhere(function ($query) {
                    $query->whereHas('taskStatus', function ($query) {
                        $query->where('nama_id_colour', '!=', 'Hijau');
                    });
                });
        })
        ->get();

        $tasksselesai = TaskTrackingGiven::with('taskCreated', 'taskStatus')
            ->where('task_kod', $icNos)
            ->where(function ($query) {
                $query->where('task_staffstatus', '=', 'Selesai')
                    ->whereHas('taskStatus', function ($query) {
                        $query->where('nama_id_colour', '=', 'Hijau');
                    });
            })
            ->get();

        $tasksouts = TaskTrackingGiven::with('taskCreated', 'taskStatus', 'staffkodreceiver') // Eager load the related TaskTrackingCreate model
            ->where('task_ic_no_giver', $icNos)
            ->get();

        $taskmain = TaskTrackingCreate::with('tasksGiven.taskStatus', 'staffkod', 'department') // Main Tab 
            ->where('task_ic_no', $icNos)
            ->get();

        // $taskmain = TaskTrackingGiven::with('taskCreated', 'taskStatus')
        //     ->whereHas('taskCreated', function ($query) use ($icNos) {
        //         $query->where('task_ic_no_giver', $icNos);
        //     })
        //     ->get();

        $status = TaskTrackingStatusTindakan::select('tasktrackingstaff_statustindakan.*')
            ->where('nama_id', 'Status')
            ->orderBy('id', 'ASC')
            ->get();

        $hijauStatus = TaskTrackingStatusTindakan::where('nama_id_colour', 'Hijau')->first();
        $kuningStatus = TaskTrackingStatusTindakan::where('nama_id_colour', 'Kuning')->first();

        return view('tasktracking.indextasktracking', compact('tasks','tasksselesai','tasksouts', 'taskmain', 'hijauStatus', 'kuningStatus'));
    }

//Staff Kod Starts
    public function staffkod()
    {

        $icNos = Auth::user()->ic_no;

        $department = Employment::where('ic_no', $icNos)->first();

        if ($department) {
            $department_id = $department->department_id;

            // Use the department_id to get the staffkods
            $staffkods = TaskTrackingStaffKod::where('department_id', $department_id)
                ->orderBy('created_at', 'DESC')
                ->get();
        } else {
            // Handle the case where no matching department is found
            $staffkods = collect(); // empty collection
        }

        return view('tasktracking.staffkod',compact('department','staffkods', 'icNos'));
    }

    public function storestaffkod(Request $request)
    {

        foreach ($request->moreFields as $key => $value) {
            TaskTrackingStaffKod::create($value);
        }

        return redirect()->route('tasktracking.staffkod')
            ->with('success_message', 'New Data record was successfully added!');
    }

    public function destroystaffkod($id)
    {
        try {

            $staffkods = TaskTrackingStaffKod::where('id', $id)->delete();

            return redirect()->route('tasktracking.staffkod')
                ->with('success_message', 'Data was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }
//Staff Kod Ends

//Status Tindakan Start
    public function statustindakan()
    {
        $icNos = Auth::user()->ic_no;

        $statuss = TaskTrackingStatusTindakan::select('tasktrackingstaff_statustindakan.*')
            ->where('nama_id','Status')
            ->orderBy('id', 'ASC')
            ->get();

        $tindakans = TaskTrackingStatusTindakan::select('tasktrackingstaff_statustindakan.*')
            ->where('nama_id','Tindakan')
            ->orderBy('id', 'ASC')
            ->get();

            $existingColours = TaskTrackingStatusTindakan::whereNotNull('nama_id_colour')
            ->distinct()
            ->pluck('nama_id_colour')
            ->toArray();

            $colours = [
                'Kuning' => 'btn-warning',
                'Biru Terang' => 'btn-info',
                'Biru' => 'btn-primary',
                'Merah' => 'btn-danger',
                'Hijau' => 'btn-success'
            ];

        return view('tasktracking.statustindakan', compact('statuss','tindakans', 'existingColours', 'colours'));
    }

    public function storestatus(Request $request)
    {
        $icNos = Auth::user()->ic_no;
        $now = Carbon::now();

        $statuss = new TaskTrackingStatusTindakan;

        $statuss-> text = $request->text;
        $statuss-> nama_id = $request->nama_id;
        $statuss-> nama_id_colour = $request->nama_id_colour;
        $statuss-> created_by = $icNos;
        $statuss-> created_at = $now;

        $statuss->save();

        return back()->withInput()
                ->with('success_message', 'Status Added!');
    }

    public function destroystatus($id)
    {
        try {
        $statuss= TaskTrackingStatusTindakan::where('id', $id)->delete();

            return back()->withInput()
                ->with('success_message', 'Status was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['error_message' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function editstatus($id)
    {
        $icNos = Auth::user()->ic_no;

        $statuss = TaskTrackingStatusTindakan::select('tasktrackingstaff_statustindakan.*')
            ->where('id', '=', $id)
            ->first();

        return view('tasktracking.editstatus', compact('statuss'));
    }

    public function updatestatus(Request $request)
    {
        $user = Auth::user()->name;

        $id = $request->input('id');

        // Find the record to be updated
        $statuss = TaskTrackingStatusTindakan::where('id', $id)
            ->where('id', $id)
            ->first();

        if (!$statuss) {
            return redirect()->back()->with('error', 'Record not found');
        }

        // Update the record with the new data
        $statuss->text = $request->input('text');
        $statuss->nama_id_colour = $request->input('nama_id_colour');
        $statuss->save();

        return redirect()->route('tasktracking.statustindakan')
            ->with('success_message', 'Status Updated!');
    }

    public function storetindakan(Request $request)
    {
        $icNos = Auth::user()->ic_no;
        $now = Carbon::now();

        $tindakans = new TaskTrackingStatusTindakan;

        $tindakans-> text = $request->text;
        $tindakans-> nama_id = $request->nama_id;
        $tindakans-> created_by = $icNos;
        $tindakans-> created_at = $now;

        $tindakans->save();

        return back()->withInput()
                ->with('success_message', 'Tindakan Added!');
    }

    public function destroytindakan($id)
    {
        try {
        $tindakans= TaskTrackingStatusTindakan::where('id', $id)->delete();

            return back()->withInput()
                ->with('success_message', 'Tindakan was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['error_message' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function edittindakan($id)
    {
        $icNos = Auth::user()->ic_no;

        $tindakans = TaskTrackingStatusTindakan::select('tasktrackingstaff_statustindakan.*')
            ->where('id', '=', $id)
            ->first();

        return view('tasktracking.edittindakan', compact('tindakans'));
    }

    public function updatetindakan(Request $request)
    {
        $user = Auth::user()->name;

        $id = $request->input('id');

        // Find the record to be updated
        $tindakans = TaskTrackingStatusTindakan::where('id', $id)
            ->where('id', $id)
            ->first();

        if (!$tindakans) {
            return redirect()->back()->with('error', 'Record not found');
        }

        // Update the record with the new data
        $tindakans->text = $request->input('text');
        $tindakans->save();

        return redirect()->route('tasktracking.statustindakan')
            ->with('success_message', 'Tindakan Updated!');
    }
//Status Tindakan End

//Update Status Start
    public function updatetaskstatus(Request $request){

        $icNos = Auth::user()->ic_no;

        $now = Carbon::now();
        $idstatus = $request->input('id');

        // Find the record to be updated based on kod and icno_pemohon
        $taskstatus = TaskTrackingGiven::find($idstatus);

        $taskstatus->task_userstatus = $request->input('task_userstatus');

        $taskstatus->save();

        // Redirect with a success message
        return redirect()->back()
            ->with('success_message', 'Task status were successfully changed!');
    }
//Update Status End

//Create Task Start
    public function createtaskinternal()
    {
        $icNos = Auth::user()->ic_no;
        $today = date('Y-m-d');

        $jawatanlist =Jawatanlist::pluck('label','id')->all();

        $departments = Department::pluck('label', 'id')->all();

        $tindakans = TaskTrackingStatusTindakan::select('tasktrackingstaff_statustindakan.*')
            ->where('nama_id','Tindakan')
            ->orderBy('id', 'ASC')
            ->get();

        $employments = Employment::where('ic_no', $icNos)->firstOrFail();

        $departmentCode = $employments->department_id;

        $staffkod = TaskTrackingStaffKod::with('department')
            ->whereHas('department', function($query) use ($departmentCode) {
                $query->where('code', $departmentCode);
            })
            ->orderBy('kod', 'DESC')
            ->get();

        $biodatas = Biodata::all()
                    ->where('ic_no', '=', $icNos);

        return view('tasktracking.createtaskinternal', compact('jawatanlist','staffkod','tindakans','departments','employments', 'today'));
    }

    public function createtaskexternal()
    {
        $icNos = Auth::user()->ic_no;
        $today = date('Y-m-d');

        $jawatanlist = Jawatanlist::pluck('label','id')->all();

        $employments = Employment::where('ic_no', $icNos)->firstOrFail();

        // Get distinct department IDs from TaskTrackingStaffKod
        $departmentIds = TaskTrackingStaffKod::distinct()->pluck('department_id')->toArray();

        // Retrieve corresponding department names from the Department model
        $departments = Department::whereIn('code', $departmentIds)->get();

        $staffKods = TaskTrackingStaffKod::all();

        $tindakans = TaskTrackingStatusTindakan::select('tasktrackingstaff_statustindakan.*')
            ->where('nama_id', 'Tindakan')
            ->orderBy('id', 'ASC')
            ->get();

        $biodatas = Biodata::where('ic_no', $icNos)->get();

        return view('tasktracking.createtaskexternal', compact('jawatanlist', 'employments', 'tindakans', 'departments', 'staffKods', 'today'));
    }

    public function storetask(Request $request)
    {
        $now = Carbon::now();
        $icNos = Auth::user()->ic_no;

        // Store data in ssm_dc database
        $taskcreated = new TaskTrackingCreate();
        $taskcreated->task_ic_no = $icNos;
        $taskcreated->task_date = $request->task_date;
        $taskcreated->task_kategori = $request->task_kategori;
        $taskcreated->task_jabatan = $request->task_jabatan;
        $taskcreated->created_at = $now;
        $taskcreated->save();

        // Store task details in TaskTrackingGiven model
        $taskPerkara = $request->input('task_perkara');
        $taskKod = $request->input('task_kod');
        $taskTindakan = $request->input('task_tindakan');
        $taskCatatan = $request->input('task_catatan');
        $taskIntExt = $request->input('task_int_ext');

        foreach ($taskPerkara as $index => $perkara) {
            $taskDetail = new TaskTrackingGiven();
            $taskDetail->ref_id = $taskcreated->id;
            $taskDetail->task_ic_no_giver = $icNos;
            $taskDetail->task_perkara = $perkara;
            $taskDetail->task_int_ext = $taskIntExt;
            $taskDetail->task_kod = $taskKod[$index];
            $taskDetail->task_tindakan = $taskTindakan[$index];
            $taskDetail->task_catatan = $taskCatatan[$index];

            // Handle file uploads for this specific row
            if ($request->hasFile('task_file.' . $index)) {
                $uploadedFiles = [];

                foreach ($request->file('task_file.' . $index) as $file) {
                    // Validate and store each file
                    $filename = $file->getClientOriginalName();
                    $path = $file->storeAs('public/task_files', $filename);

                    $uploadedFiles[] = $filename;
                }

                // Store $uploadedFiles in your database or perform any other actions
                $taskDetail->task_file = json_encode($uploadedFiles);
            }

            $taskDetail->created_at = $now;
            $taskDetail->save();
        }

        return redirect()->route('tasktracking.indextasktracking')
            ->with('success_message', 'Task Created!');
    }
//Create Task End

//Update Task Start
    public function edittaskgiven($id)
    {
        $taskgiven = TaskTrackingGiven::with('taskCreated')
            ->where('id', $id)
            ->firstOrFail();

        $status = TaskTrackingStatusTindakan::select('tasktrackingstaff_statustindakan.*')
            ->where('nama_id','Status')
            ->orderBy('id', 'ASC')
            ->get();

        return view('tasktracking.edittaskgiven', compact('taskgiven', 'status'));
    }

    public function updatetaskuser(Request $request, $id)
    {
        $now = Carbon::now();
        $icNos = Auth::user()->ic_no;

        $id = $request->input('id');

        // Find the record to be updated
        $taskgiven = TaskTrackingGiven::findorfail($id);

        // Update the record with the new data
        $taskgiven->task_userstatus = $request->input('task_userstatus');

        // Check if there is a change in the task_catatanuser text
        if ($taskgiven->task_catatanuser !== $request->input('task_catatanuser')) {
            $taskgiven->task_catatanuser = $request->input('task_catatanuser');
            $taskgiven->task_catatanuser_submit_at = $now;
        }

        $taskgiven->save();

        return redirect()->back()
            ->with('success_message', 'Task Updated!');
    }

    public function edittaskcreated($id)
    {
        $icNos = Auth::user()->ic_no;
        $today = date('Y-m-d');

        $taskcreated = TaskTrackingGiven::with('taskCreated')
            ->where('id', $id)
            ->firstOrFail();

        $status = TaskTrackingStatusTindakan::select('tasktrackingstaff_statustindakan.*')
            ->where('nama_id','Status')
            ->orderBy('id', 'ASC')
            ->get();

        $staffkod = TaskTrackingStaffKod::select('tasktrackingstaff_kod.*')->orderBy('kod', 'DESC')->get();

        $tindakans = TaskTrackingStatusTindakan::select('tasktrackingstaff_statustindakan.*')
            ->where('nama_id','Tindakan')
            ->orderBy('id', 'ASC')
            ->get();

        $employments = Employment::all()
                    ->where('ic_no', '=', $icNos);

        $biodatas = Biodata::all()
                    ->where('ic_no', '=', $icNos);

        return view('tasktracking.edittaskcreated', compact('taskcreated', 'status', 'staffkod', 'tindakans', 'employments', 'biodatas'));
    }

    public function updatetaskcreated(Request $request, $id)
    {
        $now = Carbon::now();
        $icNos = Auth::user()->ic_no;

        // Find the record to be updated
        $taskcreated = TaskTrackingGiven::findorfail($id);

        // Update the record with the new data
        $taskcreated->task_perkara = $request->input('task_perkara');
        $taskcreated->task_tindakan = $request->input('task_tindakan');
        $taskcreated->task_catatan = $request->input('task_catatan');
        $taskcreated->task_staffstatus = $request->input('task_staffstatus');
        // Update the main attributes
        $taskcreated->update([
            'task_perkara'        => $request->task_perkara,
            'task_tindakan'       => $request->task_tindakan,
            'task_catatan'        => $request->task_catatan,
            'task_staffstatus'    => $request->task_staffstatus,
            'updated_at'          => $now,
        ]);

        // Check if there is a change in the task_catatanstaff text
        if ($taskcreated->task_catatanstaff !== $request->input('task_catatanstaff')) {
            $taskcreated->task_catatanstaff = $request->input('task_catatanstaff');
            $taskcreated->task_catatanstaff_submit_at = $now;
        }

        // Check if 'remove_file' checkbox is selected
        if ($request->has('remove_file')) {

            $removeIndexes = $request->input('remove_file'); // this should be an array of indexes
            $existingFiles = $taskcreated->task_file;

            foreach ($removeIndexes as $index) {
                if (isset($existingFiles[$index])) {
                    // Delete the file
                    Storage::delete('public/task_files' . $existingFiles[$index]);

                    // Remove the element from the array
                    unset($existingFiles[$index]);
                }
            }

            // Reindex the array after removing elements
            $existingFiles = array_values($existingFiles);
            // Store the updated array in your database or perform any other actions
            $taskcreated->task_file = $existingFiles;
        }

        // Handle uploaded files
        if ($request->hasFile('task_file')) {

            $files = $request->file('task_file');
            $existingFiles = $taskcreated->task_file ?: []; // If task_file is null, default to an empty array

            foreach ($files as $file) {
                try {
                    // Validate and store each file
                    $filename = $file->getClientOriginalName();
                    $path = $file->storeAs('public/task_files', $filename);

                    // Append the new file name to the existing array
                    $existingFiles[] = $filename;
                } catch (\Exception $e) {
                    // Log or display the error
                    dd($e->getMessage());
                }
            }
            // Store the updated array in your database or perform any other actions
            $taskcreated->task_file = $existingFiles;
        }

        $taskcreated->save();

        return redirect()->back()
            ->with('success_message', 'Task Updated!');
    }
//Update Task End
//Main View Tab 

    public function editmaintask($id)
    {
        $icNos = Auth::user()->ic_no;
        $today = date('Y-m-d');

        $taskcreated = TaskTrackingCreate::select('tasktrackingstaff_taskcreated.*')
            ->where('id', $id)
            ->first();

        $taskgiven = TaskTrackingGiven::select('tasktrackingstaff_taskgiven.*')
            ->where('ref_id', $id)
            ->get();

        $departments = Department::select('departments.*')
            ->where('code',$taskcreated->task_jabatan)
            ->first();

        $status = TaskTrackingStatusTindakan::select('tasktrackingstaff_statustindakan.*')
            ->where('nama_id','Status')
            ->orderBy('id', 'ASC')
            ->get();

        $staffkod = TaskTrackingStaffKod::select('tasktrackingstaff_kod.*')->orderBy('kod', 'DESC')->get();

        $tindakans = TaskTrackingStatusTindakan::select('tasktrackingstaff_statustindakan.*')
            ->where('nama_id','Tindakan')
            ->orderBy('id', 'ASC')
            ->get();

        $employments = Employment::all()
                    ->where('ic_no', '=', $icNos);

        $biodatas = Biodata::all()
                    ->where('ic_no', '=', $icNos);

        return view('tasktracking.edittaskinternalmain', compact('departments','taskcreated', 'taskgiven', 'status', 'staffkod', 'tindakans', 'employments', 'biodatas'));
    }
}
