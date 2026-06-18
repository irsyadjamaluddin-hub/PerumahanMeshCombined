<?php

namespace App\Http\Controllers;

use App\Mail\DevopsAdminNotif;
use App\Mail\DrfEmail;
use App\Models\Department;
use App\Models\DevopsAdminEmail;
use App\Models\DevopsRequest;
use App\Models\DrfDocument;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DevopsRequestController extends Controller
{
    public function indexadmin() {
        $devopsRequests = DevopsRequest::all();
        return view('devopsrequest.indexadmin', compact('devopsRequests'));
    }

    public function create() {
        $departments = Department::all();

        return view('devopsrequest.drf-create', compact('departments'));
    }

    public function store() {
        request()->validate([
            'jabatan' => ['required'],
            'bahagian_unit' => ['required'],
            'nama_projek' => ['required'],
            'penyelaras_projek' => ['required'],
            'jawatan' => ['required'],
            'emel' => ['required', 'email'],
            'tel_no' => ['required'],
            'perkhidmatan' => ['required'],
            'huraian' => ['required', 'string', 'max:3000'],
            'tarikh_diperlukan' => ['required'],
            'uploaded_doc.*' => ['nullable', 'file', 'mimes:pdf,doc,docx,ppt,pptx', 'max:20480'],
        ], [
            'uploaded_doc.*.mimes' => 'File type must be PDF, Word Document or PowerPoint.'
        ]);

        $dateInput = request('tarikh_diperlukan');
        $formattedDate = Carbon::parse($dateInput)->format('d/m/Y');

        $devopsRequest = DevopsRequest::create([
            // 'ic_no' => Auth::user()->ic_no,
            'jabatan' => request('jabatan'),
            'bahagian_unit' => request('bahagian_unit'),
            'nama_projek' => request('nama_projek'),
            'penyelaras_projek' => request('penyelaras_projek'),
            'jawatan' => request('jawatan'),
            'emel' => request('emel'),
            'tel_no' => request('tel_no'),
            'perkhidmatan' => request('perkhidmatan'),
            'huraian' => request('huraian'),
            'tarikh_diperlukan' => $formattedDate,
            'status' => 'No action yet',
        ]);

        
        if (request()->hasFile('uploaded_doc')) {
            foreach (request()->file('uploaded_doc') as $file) {
                $path = $file->store('uploaded_docs', 'public');

                $devopsRequest->drfdocuments()->create([
                    'doc_name' => $file->getClientOriginalName(),
                    'doc_path' => $path,
                    'doc_size' => $file->getSize(),
                    'doc_mime' => $file->getClientOriginalExtension(),
                ]);
            }
        }

        $emails = DevopsAdminEmail::orderBy('id')->pluck('email')->toArray();
        $ccEmails = array_slice($emails, 1);

        Mail::to($devopsRequest->emel)->send(new DrfEmail($devopsRequest));

        Mail::to($emails[0])
        ->cc($ccEmails)
        ->send(new DevopsAdminNotif($devopsRequest));
        
        return redirect()->route('devops-request.addrequest')
            ->with('success_message', 'Request telah berjaya dihantar');
        
    }

    public function downloadTemplate() {
        $pathToFile = public_path('templates/devops_request_form.pdf');
        return response()->download($pathToFile, 'devops_request_form.pdf');
    }

    public function editadmin(DevopsRequest $devopsRequest) {
        $drfRemarks = $devopsRequest->drfremarks;
        $statuses = [
            'No action yet',
            'Engaged',
            'In development',
            'Completed',
            'On hold',
            'Cancelled',
        ];
        return view('devopsrequest.editadmin', compact('devopsRequest', 'drfRemarks', 'statuses'));
    }
    
    public function downloadUploadedFile(DrfDocument $drfDocument) {
        if (!Storage::disk('public')->exists($drfDocument->doc_path)) {
            abort(404);
        }

        $filepath = Storage::disk('public')->path($drfDocument->doc_path);

        return response()->download($filepath, $drfDocument->doc_name);
    }

    
    
    public function updateadmin(DevopsRequest $devopsRequest) {
        $validated = request()->validate([
            'drf_remarks' => ['nullable', 'array'],
            'drf_remarks.*.remark' => ['nullable'],
        ]);

        $devopsRequest->update([
            'status' => request('status'),
        ]);

        if (request()->has('drf_remarks')) {
            foreach ($validated['drf_remarks'] as $remarkData) {
                $devopsRequest->drfremarks()->create($remarkData);
            }
        }

        return redirect()->route('devops-request.editadmin', $devopsRequest->id)->with('success', 'Status updated successfully');
        
    }
}
