<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AmendmentsCompletedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $inventory;
    public $responseMessage;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($inventory, $responseMessage = null)
    {
        $this->inventory = $inventory;
        $this->responseMessage = $responseMessage;
        
        // Debug log
        \Log::info('AmendmentsCompletedMail constructed', [
            'inventory_id' => $inventory->id ?? 'NULL',
            'has_response_message' => !empty($responseMessage)
        ]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        \Log::info('Building AmendmentsCompletedMail');
        
        try {
            $subject = 'Pindaan Telah Dilaksanakan - ' . ($this->inventory->nama_sch ?? 'Permohonan BBK');
            
            return $this->subject($subject)
                        ->from(config('mail.from.address'), config('mail.from.name'))
                        ->view('emails.amendments-completed')
                        ->with([
                            'inventory' => $this->inventory,
                            'responseMessage' => $this->responseMessage
                        ]);
        } catch (\Exception $e) {
            \Log::error('Error building email', [
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }
}