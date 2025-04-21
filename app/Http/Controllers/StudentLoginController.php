<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Mail\OTPMail;
use App\Models\AcademicDetail;

class StudentLoginController extends Controller
{
    /************************************* Student Signup ***********************************/

    public function showSignupForm()
    {
        return view('student-signup');
    }

//     public function initiateSignup(Request $request)
// {
//     $request->validate([
//         'name' => 'required|string|max:255',
//         'email' => 'required|email|unique:students,email',
//         'password' => 'required|string|min:6|confirmed',
//     ]);

//     $otp = rand(100000, 999999);
//     $student = Student::create([
//         'name' => $request->name,
//         'email' => $request->email,
//         'password' => hash('sha256', $request->password),
//         'otp' => $otp,
//     ]);
    
//     try {
//         Mail::to($request->email)->send(new OTPMail($otp));
//         return response()->json(['message' => 'OTP sent to your email!']);
//     } catch (\Exception $e) {
//         return response()->json(['error' => 'Failed to send OTP: ' . $e->getMessage()], 500);
//     }
// }

public function initiateSignup(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'password' => 'required|string|min:6|confirmed',
    ]);

    if (Student::where('email', $request->email)->exists()) {
        return response()->json(['error' => 'Already Signed Up'], 400);
    }

    $otp = rand(100000, 999999);
    $student = Student::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => hash('sha256', $request->password),
        'otp' => $otp,
    ]);
    
    try {
        Mail::to($request->email)->send(new OTPMail($otp));
        return response()->json(['message' => 'OTP sent to your email!']);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to send OTP: ' . $e->getMessage()], 500);
    }
}


public function verifySignupOTP(Request $request)
{
    $request->validate(['otp' => 'required|numeric']);
    $student = Student::where('otp', $request->otp)->first();

    if (!$student) {
        return response()->json(['error' => 'Invalid OTP.'], 400);
    }
    $student->update(['otp' => null]);
return response()->json([
    'message' => 'Signup successful! You can now log in.',
    'redirect' => route('student.login.form')
], 200);

return response()->json([
    'error' => 'Invalid OTP.'
], 400);

}



    /*************************************Student Login***********************************/
    
    public function showStudentLoginForm()
    {
        return view('student-login');
    }

    public function studentLogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|email',
            'password' => 'required|string',
        ]);
    
        $student = Student::where('email', $credentials['username'])->first();
    
        if ($student && hash('sha256', $credentials['password']) === $student->password) {
            Session::put('student_id', $student->id);
            Session::put('student_email', $student->email);
            Session::put('student_name', $student->name);
            Session::flash('success_message', 'Login successfully!');
            return redirect()->route('student.dashboard');
        }

        session()->flash('error', 'Invalid email or password.');
        return back();
           
    }
    


    public function dashboard()
    {
        $studentEmail = Session::get('student_email');
    
        if (!$studentEmail) {
            return redirect()->route('student.login')->with('error', 'Please login first.');
        }
    
        $student = Student::where('email', $studentEmail)->first();
    
        if (!$student) {
            return redirect()->route('student.login')->with('error', 'Student not found.');
        }
    
        $isRegistered = !empty($student->email);
    
        return view('student-dashboard', compact('isRegistered', 'student'));
    }
    


public function checkRegistration()
{
    $studentEmail = session('student_email');

    if (!$studentEmail) {
        return response()->json(['error' => 'No student found in session'], 400);
    }

    $student = Student::where('email', $studentEmail)->first();

    if ($student && !is_null($student->registration_number)) {
        return response()->json(['registered' => true]);
    } else {
        return response()->json(['registered' => false]);
    }
}

public function checkDetails()
{
    $studentEmail = session('student_email');

    if (!$studentEmail) {
        return response()->json(['error' => 'No student found in session'], 400);
    }

    $student = Student::where('email', $studentEmail)->first();

    if ($student && !is_null($student->registration_number)) {
        return response()->json(['registered' => true]);
    } else {
        return response()->json(['registered' => false]);
    }
}




public function studentDetails()
{
    $student = Student::with(['address', 'basicInformation', 'academicDetail.school'])
                      ->find(Session::get('student_id'));

    if (!$student) {
        abort(404, 'Student not found');
    }

    $academicDetails = AcademicDetail::where('student_id', $student->id)->get();

    $studentName = strtolower(str_replace(' ', '_', $student->name));
    $regNo = $student->registration_number;

    $imageName = "{$studentName}_{$regNo}." . pathinfo($student->image, PATHINFO_EXTENSION);
    $signatureName = "{$studentName}_{$regNo}." . pathinfo($student->signature, PATHINFO_EXTENSION);

    return view('student-details', compact('student', 'academicDetails', 'imageName', 'signatureName'));
}




    public function logout()
    {
        Session::flush();
        return view('home');
    }
}
