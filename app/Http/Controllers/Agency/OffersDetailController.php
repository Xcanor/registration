<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Offer;
use App\Agency;
use App\OfferDetails;
use App\Photo;
use App\Category;
use Image;

class OffersDetailController extends Controller
{
    public function add($offerId)
    {   
        $offer = Offer::findOrFail($offerId);
        return view('auth.agency.pages.create-details',compact('offer'));
    }

    public function save(Request $request)

    {     $this->validate($request, [
            'from' => 'required',
            'to' => 'required',
            'departial_time' => 'required',
            'arrival_time' => 'required',
            'ticket_number' => 'required|numeric',
            'transportation' => 'required',
        ]);
        
        $offer = Offer::findOrFail($request->offerId);
        $start_offer = new DateTime($offer->start_date); 
        $end_offer = new DateTime($offer->end_date); 
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($start_offer, $interval, $end_offer);

        $dates = array();
        $begin = date('Y-m-d',strtotime($request['departial_time']));
        $end = date('Y-m-d',strtotime($request['arrival_time']));

        foreach($period as $dt)
        {   
            array_push( $dates,$dt->format('Y-m-d'));
        }

        if(in_array($begin,$dates) && in_array($end,$dates))
        {
            $detail = OfferDetails::create([
                'offer_id' => $offer->id,
                'from' => $request['from'],
                'to' => $request['to'],
                'departial_time' => $request['departial_time'],
                'arrival_time' => $request['arrival_time'],
                'ticket_number' => $request['ticket_number'],
                'transportation' => $request['transportation'],
            ]);
    
            return redirect('agency/dashboard');
        }
        return "Please Enter Validate Date/Time";


       
    }

    public function showdetails($offerId)
    {
        $offer = Offer::findOrFail($offerId);
        return view('auth.agency.pages.show-details', compact('offer'));
    }

    public function editDetails($detailId)
    {
        $detail = OfferDetails::findOrFail($detailId);
        return view('auth.agency.pages.edit-details', compact('detail'));
    }

    public function updateDetails(Request $request)
    {
        $this->validate($request, [
            'from' => 'required',
            'to' => 'required',
            'departial_time' => 'required',
            'arrival_time' => 'required',
            'ticket_number' => 'required|numeric',
            'transportation' => 'required',
        ]);

        
        $detail = OfferDetails::findOrFail($request->detailId);

        $offer = Offer::latest()->first();
        $start_offer = new DateTime($offer->start_date); 
        $end_offer = new DateTime($offer->end_date); 
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($start_offer, $interval, $end_offer);

        $dates = array();
        $begin = date('Y-m-d',strtotime($request['departial_time']));
        $end = date('Y-m-d',strtotime($request['arrival_time']));

        foreach($period as $dt)
        {   
            array_push( $dates,$dt->format('Y-m-d'));
        }
        
        if(in_array($begin,$dates) && in_array($end,$dates))
        {
            $detail -> from = $request -> from;
            $detail -> to = $request -> to;
            $detail -> departial_time = $request -> departial_time;
            $detail -> arrival_time = $request -> arrival_time;
            $detail -> ticket_number = $request -> ticket_number;
            $detail -> transportation = $request -> transportation;
            $detail -> save();

            return redirect('agency/dashboard');
        }
        return "Error";
        
    }

}
