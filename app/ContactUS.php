<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactUS extends Model
{
    public $table = 'contact_us_users';

    protected $fillable = [
        'first_name','last_name', 'email', 'type', 'description'
    ];
}
