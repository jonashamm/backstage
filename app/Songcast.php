<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Songcast extends Model
{
    protected $table = 'songcasts';

    public function instrument_user()
    {
        return $this->belongsTo('App\InstrumentUserPivot');
    }
}
