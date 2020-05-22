<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{   
    
    protected $fillable = ['name','parent_id'];

    public function offers()
    {
        return $this->belongsToMany(Offer::class);
    }

    public function childs()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
