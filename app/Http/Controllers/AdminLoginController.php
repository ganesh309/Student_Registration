<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
class AdminLoginController extends Controller
{

    public function logout()
{
    Auth::logout();
    return view('home');

}


  /*****************************************Admin Login********************************************/
    public function showAdminLoginForm()
    {
        return view('admin-login');
    }

    
    public function adminLogin(Request $request)
    {
       
        $defaultAdmin = [
            'username' => 'admin',
            'password' => 'password123', 
        ];

      
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        
        if ($credentials['username'] === $defaultAdmin['username'] && $credentials['password'] === $defaultAdmin['password']) {
            return redirect()->route('admin.panel', [
                'success_message' => urlencode('Login successfully!')]);
        } else {
            
            return redirect()->route('admin.login.form')->with('error', 'Invalid username or password');
        }
    }

}
