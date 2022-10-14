<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmployeeregisterMail extends Mailable
{
    use Queueable, SerializesModels;
    public $pdf;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pdf)
    {
        //
        $this->pdf = $pdf;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('Superadmin.employee.employee_register_mail');


        return $this->from($address ='admin@smartit.com', $name = 'Smart It Ventures')->subject('Employee Details')->markdown('Superadmin.employee.employee_register_mail')->attachData($this->pdf->output(),"test.pdf");

    //     $subject = 'Welcome';
    //    return $this->view('Superadmin.employee.employee_register_mail')->subject($subject);



    }
}
