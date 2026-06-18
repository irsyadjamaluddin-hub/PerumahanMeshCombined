<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\DevopsSupportRequest;

class UserRequestUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public DevopsSupportRequest $supportRequest;
    public string $oldStatus;
    public string $newStatus;

    public function __construct(DevopsSupportRequest $supportRequest, string $oldStatus, string $newStatus)
    {
        $this->supportRequest = $supportRequest;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
    }

    public function build()
    {
        return $this->subject('Ticket '.$this->supportRequest->ticket_id.' status: '.$this->newStatus)
            ->markdown('emails.user.updated');
    }
}
