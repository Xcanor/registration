<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;


class UserController extends Controller
{
    public function showUserRegisterForm()
    {
        return view('auth.user.register-user');
    }
    public function showUserLoginForm()
    {
        return view('auth.user.login-user');
    }

    protected function createUser(Request $request)
    {
        // first we validate inputs from request (Register Form)
        
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'telephone' => 'required|numeric',
            'gender' => 'nullable',
            'date_of_birth' => 'nullable',
            'password' => 'required|min:6'
        ]);
        
        $user =  User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'telephone' => $request['telephone'],
            'gender' => $request['gender'],
            'date_of_birth' => $request['date_of_birth'],
            'password' => Hash::make($request['password']),
        ]);

        return redirect('user/login');
    }

    public function userLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        $user_email = $request->email;
        $user_password = $request->password;

        if (Auth::guard('web')->attempt(['email' => $user_email, 'password' => $user_password])) {

            return redirect('home');
        }
        return back()->withInput($request->only('email'));
    }
}
