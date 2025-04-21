<?php
// app/Mail/PasswordResetMail.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;
class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $student;
    public $token;
    public $otp;
    public function __construct($student, $token, $otp)
    {
        $this->student = $student;
        $this->token = $token;
        $this->otp = $otp;
    }
    public function build()
    {
        return $this->view('emails.password-reset')
            ->subject('Verify Your Password Reset Request')
            ->with([
                'studentName' => $this->student->name,
                'otpUrl' => route('forgot-password.form', [
                    'email' => Crypt::encryptString($this->student->email),
                ]),
                'otp' => $this->otp,
            ]);
    }

}
