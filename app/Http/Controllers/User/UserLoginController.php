<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;


class UserLoginController extends Controller
{
    use AuthenticatesUsers;

    // Show register form to user
    public function showRegisterForm()
    {
        return view('auth.user.register-user');
    }

    // Show login form to user
    public function showLoginForm()
    {
        return view('auth.user.login-user');
    }

    protected function create(Request $request)
    {
        // first we validate inputs from request (Register Form)
        
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'telephone' => 'required|numeric',
            'gender' => 'nullable',
            'date_of_birth' => 'nullable',
            'status' => 'required',
            'password' => 'required|min:6'
        ]);
        
        $user =  User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'telephone' => $request['telephone'],
            'gender' => $request['gender'],
            'date_of_birth' => $request['date_of_birth'],
            'status' => $request['status'],
            'password' => Hash::make($request['password']),
        ]);

        return redirect('user/login');
    }

    // Login Process
    public function Login(Request $request)
    {
        $user_identification = $request->telephone;
        $user_password = $request->password;

        if (Auth::guard('web')->attempt([$this->username() => $user_identification, 'password' => $user_password])) {

            return redirect('user/offers');
        }
        return back();
    }

    public function username() 
    {
        $user_identifier = request()->input('telephone');

        $field = filter_var($user_identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'telephone';

        request()->merge([$field => $user_identifier]);

        return $field;
    }


    public function logout(Request $request) 
    {
        Auth::logout();
        return redirect('user/login');
    }


}
