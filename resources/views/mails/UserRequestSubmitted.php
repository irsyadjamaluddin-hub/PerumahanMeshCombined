<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\DevopsSupportRequest;

class UserRequestSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public DevopsSupportRequest $supportRequest;
    public array $filenames;

    public function __construct(DevopsSupportRequest $supportRequest, array $filenames = [])
    {
        $this->supportRequest = $supportRequest;
        $this->filenames = $filenames;
    }

    public function build()
    {
        return $this->subject('Support Ticket Created: '.$this->supportRequest->ticket_id)
            ->markdown('emails.user.submitted');
    }
}
