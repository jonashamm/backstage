<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'email', 'password',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function instruments()
    {
        return $this->belongsToMany('App\Instrument', 'casts');
    }
    public function invitation() {
    	return $this->hasOne('App\Invitation');
    }
    public function casts() {
    	return $this->hasMany('App\Cast');
    }
	public function songcasts() {
		return $this->hasManyThrough(
			'App\Songcast', 'App\Cast',
			'user_id', 'cast_id', 'id'
		);
	}
}
