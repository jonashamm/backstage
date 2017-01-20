<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachmenttype extends Model
{
    protected $fillable = ['name','typical_extension'];

	public function attachments() {
		return $this->hasMany('App\Attachment','type');
	}
}
