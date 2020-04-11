<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class ChangePasswordController extends Controller
{
    
    public function showChangePasswordForm()
    {
        return view('auth.user.change-password');
    }

    // Function to change user password
    
    public function ChangePassword(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::guard('web')->user()->password))) {
            // The passwords not matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $admin_user = Auth::guard('web')->user();
        $admin_user->password = bcrypt($request->get('new-password'));
        $admin_user->save();

        return redirect()->back()->with("success","Password changed successfully !");
    }
}
