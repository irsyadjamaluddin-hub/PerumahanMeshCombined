<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\DevopsSupportRequest;

class SupportRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public DevopsSupportRequest $supportRequest;
    public array $attachmentsList;

    public function __construct(DevopsSupportRequest $supportRequest, array $attachmentsList = [])
    {
        $this->supportRequest = $supportRequest->fresh(); // pastikan ada ticket_id
        $this->attachmentsList = $attachmentsList;
    }

    public function build()
    {
        $subject = '['.$this->supportRequest->ticket_id.'] Permohonan Sokongan: '.$this->supportRequest->perkara;

        $mail = $this->subject($subject)
            ->view('mails.support_request_admin', [
                'supportRequest' => $this->supportRequest,
                'attachments'    => $this->attachmentsList,
            ])
            ->text('emails.support_request_admin_plain', [
                'supportRequest' => $this->supportRequest,
                'attachments'    => $this->attachmentsList,
            ]);

        return $mail;
    }
}
