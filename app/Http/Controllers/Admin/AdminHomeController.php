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
        $users = User::all();

        return view('auth.admin.pages.dashboard',compact('users'));
    }

 
}
