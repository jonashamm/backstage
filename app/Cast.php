<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cast extends Model
{
	public function user()
	{
		return $this->belongsTo('App\User');
	}
	public function instrument()
	{
		return $this->belongsTo('App\Instrument');
	}
	public function songcasts()
	{
		return $this->hasMany('App\Songcast');
	}
}
