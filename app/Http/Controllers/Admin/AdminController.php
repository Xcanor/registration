<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Admin;

class AdminController extends Controller
{
    
    public function showAdminLoginForm()
    {
        return view('auth.admin.login-admin');
    }


    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
        
        $user_email = $request->email;
        $user_password =$request->password;

        if (Auth::guard('admin')->attempt(['email' => $user_email, 'password' => $user_password])) {

            return redirect('admin/dashboard');
        }
        return back()->withInput($request->only('email'));
    }

}
