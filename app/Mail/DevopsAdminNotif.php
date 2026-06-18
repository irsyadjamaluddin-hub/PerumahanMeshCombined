<?php

namespace App\Mail;

use App\Models\DevopsRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Mail\Mailables\Attachment;

class DevopsAdminNotif extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public DevopsRequest $devopsRequest)
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.devops-admin-notif')
        ->with([
            'documents' => $this->devopsRequest->drfdocuments()->get()
        ])
        ;
    }

    public function attachments(): array
    {
        $documents = $this->devopsRequest->drfdocuments()->get();

        return $documents->filter(function ($document) {
            return !empty($document->doc_path) && Storage::exists($document->doc_path);
        })->map(function ($document) {
            return Attachment::fromStorage($document->doc_path)->as($document->doc_name)->withMime($document->doc_mime);
        })->values()->all();
    }
}
