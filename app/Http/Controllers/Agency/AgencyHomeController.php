<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Agency;
use App\Offer;

class AgencyHomeController extends Controller
{
    public function index()
    {   
        $agency = Auth::guard('agency')->user();
        $agency_id = $agency->id;
        $agencies = Agency::find($agency_id);

        $offer = Offer::latest()->first();
        
        return view('auth.agency.pages.dashboard', compact('agencies','offer'));
    }
}
