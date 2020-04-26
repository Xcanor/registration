<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfferDetails extends Model
{
    protected $fillable = [
        'offer_id','from', 'to', 'departial_time', 'arrival_time', 'ticket_number', 'transportation'
    ];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
}
