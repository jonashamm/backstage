<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instrument extends GlobalModel
{
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
