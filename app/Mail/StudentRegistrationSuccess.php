<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StudentRegistrationSuccess extends Mailable
{
    use Queueable, SerializesModels;

    public $student;

    public function __construct($student)
    {
        $this->student = $student;
    }

    public function build()
    {
        return $this->subject('🎉 Welcome to Our School!')
            ->view('emails.registration-success', [
                'name' => $this->student->name,
                'registration_number' => $this->student->registration_number,
            ]);
    }
}
