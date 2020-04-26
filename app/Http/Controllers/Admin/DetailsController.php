<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Offer;
use App\Agency;
use App\OfferDetails;
use App\Photo;
use App\Category;
use Image;
use DateTime;
use DateInterval;
use DatePeriod;


class DetailsController extends Controller
{
    public function addDetails($offerId)
    {
        $offer = Offer::findOrFail($offerId);
        return view('auth.admin.pages.create-details',compact('offer'));
    }

    public function save(Request $request)
    {    
        $offer = Offer::findOrFail($request->offerId);
        // array of date-time 
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
            return redirect('admin/dashboard/offer');
        }
        return "You have to Enter Validate Date !! ";
        
        
    }

    public function showDetails($offerId)
    {
        $offer = Offer::findOrFail($offerId);
        return view('auth.admin.pages.show-details', compact('offer'));
    }

    public function editDetails($detailId)
    {
        $detail = OfferDetails::findOrFail($detailId);
        return view('auth.admin.pages.edit-details', compact('detail'));
    }

    public function updateDetails(Request $request)
    {
        $detail = OfferDetails::findOrFail($request->detailId);

        $this->validate($request, [
            'from' => 'required',
            'to' => 'required',
            'departial_time' => 'required',
            'arrival_time' => 'required',
            'ticket_number' => 'required|numeric',
            'transportation' => 'required',
        ]);
        // save new values
        $detail -> from = $request -> from;
        $detail -> to = $request -> to;
        $detail -> departial_time = $request -> departial_time;
        $detail -> arrival_time = $request -> arrival_time;
        $detail -> ticket_number = $request -> ticket_number;
        $detail -> transportation = $request -> transportation;
        $detail -> save();


        return redirect('admin/dashboard/offer');
    }

}
