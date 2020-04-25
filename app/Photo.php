<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'offer_id','imagename'
    ];


    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
}

