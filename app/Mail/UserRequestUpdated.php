<?php

namespace App\Mail;

use App\Models\DevopsSupportRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRequestUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public DevopsSupportRequest $req;
    public string $oldStatus;
    public string $newStatus;

    public function __construct(DevopsSupportRequest $req, string $oldStatus, string $newStatus)
    {
        $this->req = $req;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
    }

    public function build()
    {
        return $this->subject("ℹ️ [{$this->req->ticket_id}] Status permohonan dikemaskini")
            ->view('emails.support.user_updated')
            ->with([
                'req'       => $this->req,
                'oldStatus' => $this->oldStatus,
                'newStatus' => $this->newStatus,
            ]);
    }
}
