<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    public function song()
    {
        return $this->belongsTo('App\Song');
    }
    public function attachmenttype() {
    	return $this->belongsTo('App\Attachmenttype');
    }
}
