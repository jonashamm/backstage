<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstrumentUserPivot extends Model
{
    protected $table = 'instrument_user';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function instrument()
    {
        return $this->belongsTo('App\Instrument');
    }

}
