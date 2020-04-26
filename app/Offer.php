<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{

    protected $fillable = [
        'agency_id','name', 'start_date', 'end_date', 'rooms', 'status', 'agency_price', 'user_price'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function details()
    {
        return $this->hasMany(OfferDetails::class);
    }

    public function images()
    {
        return $this->hasMany(Photo::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
