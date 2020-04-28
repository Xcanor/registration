<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Admin;


class AdminLoginController extends Controller
{
    use AuthenticatesUsers;


    public function showLoginForm()
    {
        return view('auth.admin.login-admin');
    }


    public function Login(Request $request)
    {
        
        $user_identification = $request->email;
        $user_password =$request->password;

        if (Auth::guard('admin')->attempt(['email' => $user_identification, 'password' => $user_password])) {

            return redirect('admin/dashboard');
        }
        return back();
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('admin/login');
    }

}
