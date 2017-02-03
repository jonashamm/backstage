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
    public function songcasts() {
        return $this->hasMany('App\Songcast');
    }
    public function most_recent_audiofile() {
	    $audiofile_type = Attachmenttype::where('typical_extension','mp3')->orderBy('created_at','desc')->first();

    	return $this->hasOne('App\Attachment')->where('type',$audiofile_type->id);
    }
}
