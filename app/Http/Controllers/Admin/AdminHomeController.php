<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Admin;
use App\User;
use App\Agency;
use App\Offer;

class AdminHomeController extends Controller
{
    public function welcome()
    {   
        return view('auth.admin.pages.welcome');
    }

    public function showUsers()
    {   
        $users = User::all();
        return view('auth.admin.pages.users',compact('users'));
    }

    public function showAgencies()
    {   
       $agencies = Agency::all();
        return view('auth.admin.pages.agencies',compact('agencies'));
    }

    public function showOffers()
    {
        $agencies = Agency::all();

        $offer = Offer::latest()->first();
        
        return view('auth.admin.pages.offers', compact('agencies','offer'));
    }

 
}
