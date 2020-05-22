<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Admin;

class AdminLoginController extends Controller
{

    public function Login()
    {
        if (Auth::guard('admin')->attempt(['email' => request('email'), 'password' => request('password')])) {

            $user = Auth::guard('admin')->user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], 200);
        }
       else
        {
           return response()->json(['error'=>'Unauthorised'], 401);
        }

    }
        
    
}
