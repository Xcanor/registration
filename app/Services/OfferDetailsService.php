<?php

namespace App\Services;
 
use App\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Agency;
use App\OfferDetails;
use App\Photo;
use App\Category;
use Image;
use DateTime;
use DateInterval;
use DatePeriod;

class OfferDetailsService
{
    public function create(Request $request)
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
        }
        return "You have to Enter Validate Date !! ";
    }

    public function read($offerId)
    {
        $offer = Offer::findOrFail($offerId);
        return $offer;
    }

    public function update(Request $request)
    {
        $detail = OfferDetails::findOrFail($request->detailId);
        // save new values
        $detail -> from = $request -> from;
        $detail -> to = $request -> to;
        $detail -> departial_time = $request -> departial_time;
        $detail -> arrival_time = $request -> arrival_time;
        $detail -> ticket_number = $request -> ticket_number;
        $detail -> transportation = $request -> transportation;
        $detail -> save();
    }

    public function delete($detailId)
    {
        $detail = OfferDetails::findOrFail($detailId); //primary Key
        $detail->delete();
    }
}