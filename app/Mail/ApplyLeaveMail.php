<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplyLeaveMail extends Mailable
{
    use Queueable, SerializesModels;
    public $leave;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($leave)
    {
         $this->leave = $leave;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(auth()->user()->email, $name = 'Smart_It')->subject('Mail Regarding leave')->markdown('employee.send_mail');

    }
}
