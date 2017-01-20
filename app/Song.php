<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends GlobalModel
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function attachments() {
        return $this->hasMany('App\Attachment');
    }
	public function grouped_attachments() {
		return $this->hasMany('App\Attachment');
	}
    public function songcasts() {
        return $this->hasMany('App\Songcast');
    }
}
