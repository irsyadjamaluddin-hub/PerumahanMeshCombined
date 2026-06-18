<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\DevopsSupportRequest;

class UserRequestSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public DevopsSupportRequest $support;
    public array $attachmentsNames;

    /**
     * @param DevopsSupportRequest $support
     * @param array<string> $attachmentsNames
     */
    public function __construct(DevopsSupportRequest $support, array $attachmentsNames = [])
    {
        $this->support = $support;
        $this->attachmentsNames = $attachmentsNames;
    }

    public function build()
    {
        // Subjek boleh include Ticket ID kalau ada accessor/column
        $subject = 'Aduan Telah Diterima — ' . ($this->support->ticket_id ?? 'Tiada ID');

        return $this->subject($subject)
            ->view('emails.support.user_submitted') // <-- path to your Blade
            ->with([
                'support'          => $this->support,
                'attachmentsNames' => $this->attachmentsNames,
            ]);
    }
}
