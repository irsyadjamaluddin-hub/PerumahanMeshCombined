<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InventoryNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $inventory;
    public $messageBody;

    /**
     * Create a new message instance.
     *
     * @param  mixed  $inventory
     * @param  string  $messageBody
     * @return void
     */
    public function __construct($inventory, $messageBody)
    {
        $this->inventory = $inventory;
        $this->messageBody = $messageBody;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.inventory.notification')
                    ->subject('Notification Regarding Your Inventory Request')
                    ->with([
                        'inventory' => $this->inventory,
                        'messageBody' => $this->messageBody,
                    ]);
    }
}
