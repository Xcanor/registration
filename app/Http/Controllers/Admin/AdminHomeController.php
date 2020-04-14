<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use App\User;

class AdminHomeController extends Controller
{
    public function index()
    {   
        $admins = Admin::all();
        $users = User::all();

        return view('auth.admin.dashboard',compact('admins','users'));
    }
}
