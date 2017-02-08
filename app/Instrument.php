<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instrument extends GlobalModel
{
	public function users() {
		return $this->belongsToMany('App\User','casts');
	}
    public function casts()
    {
        return $this->belongsToMany('App\User','casts');
    }
    public function songcasts() {
	    return $this->hasManyThrough(
		    'App\Songcast', 'App\Cast',
		    'instrument_id', 'cast_id', 'id'
	    );
    }
}