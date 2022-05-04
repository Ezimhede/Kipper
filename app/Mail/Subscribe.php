<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Subscribe extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $firstName;
    public $name;
    public $expiryDate;

    public function __construct($firstName, $name, $expiryDate)
    {
        //
        $this->firstName = $firstName;
        $this->name = $name;
        $this->expiryDate = $expiryDate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Kipper Notification')
            ->markdown('emails.subscribers');
    }
}
