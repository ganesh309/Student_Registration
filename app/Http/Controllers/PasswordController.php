<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
class PasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function checkEmail(Request $request)
{
    $request->validate([
        'identifier' => 'required',
    ]);

    // Check whether the identifier is an email or registration number
    if (filter_var($request->identifier, FILTER_VALIDATE_EMAIL)) {
        $student = Student::where('email', $request->identifier)->first();
    } else {
        $student = Student::where('registration_number', $request->identifier)->first();
    }

    if (!$student) {
        return back()->with('error', 'No account found');
    }

    $token = Str::random(60);
    $otp = rand(100000, 999999);

    $student->password_reset_token = $token;
    $student->otp = $otp;
    $student->save();

    $encryptedEmail = Crypt::encryptString($student->email);
    $encryptedToken = Crypt::encryptString($token);

    Mail::to($student->email)->send(new PasswordResetMail($student, $encryptedToken, $otp));

    return redirect()->route('forgot-password.form', ['email' => $encryptedEmail])
        ->with('success', 'Password reset link and OTP sent to your email.');
}


    public function showResetRequestForm($email)
{
    try {
        $decryptedEmail = Crypt::decryptString($email);
        $student = Student::where('email', $decryptedEmail)->firstOrFail();
        $imageName = $student->image;
        return view('auth.verify-otp', compact('student', 'imageName'));
    } catch (\Exception $e) {
        return redirect()->route('forgot-password')->with('error', 'Invalid reset link.');
    }
}

 // Handle OTP Verification
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric',
        ]);
        $student = Student::where('email', $request->email)->firstOrFail();

        if ((int)$student->otp !== (int)$request->otp) {
            return back()->with('error', 'Invalid OTP.');
        }
        $student->otp = null;
        $student->save();
        return redirect()->route('password.reset', [
            'email' => Crypt::encryptString($student->email),
            'token' => Crypt::encryptString($student->password_reset_token)
        ])->with('otp_success', true);

    }
    public function showResetForm($email, $token)
    {
        try {
            $email = Crypt::decryptString($email);
            $token = Crypt::decryptString($token);
            $student = Student::where('email', $email)->firstOrFail();
            return view('auth.reset-password', compact('student', 'token'));
        } catch (\Exception $e) {
            return redirect()->route('forgot-password')->with('error', 'Invalid or expired reset link.');
        }
    }
    
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
            'token' => 'required'
        ]);
    
        $student = Student::where('email', $request->email)->first();
    
        if (!$student || $student->password_reset_token !== $request->token) {
            return back()->with('error', 'Invalid token.');
        }
        $student->password = hash('sha256', $request->password);
        $student->password_reset_token = null;
        $student->otp = null;
        $student->save();
    
        return redirect()->route('login')->with('success', 'Password reset successfully!');
    }
    
}
