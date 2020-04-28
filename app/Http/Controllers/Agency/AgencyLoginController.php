<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Agency;

class AgencyLoginController extends Controller
{
    use AuthenticatesUsers;

    public function showLoginForm()
    {
        return view('auth.agency.pages.login');
    }

    public function Login(Request $request)
    {
        
        $user_identification = $request->email;
        $user_password =$request->password;

        if (Auth::guard('agency')->attempt(['email' => $user_identification, 'password' => $user_password])) {

            return redirect('agency/dashboard');
        }
        return back();
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('agency/login');
    }
}
