<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class wisata extends Model
{
    //
    public function file()
    {
        return $this->belongsTo('App\File');
    }
    public function reviews()
	{
	    return $this->hasMany('Review');
	}
	
}
