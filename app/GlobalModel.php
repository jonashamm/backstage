<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GlobalModel extends Model
{
    use SoftDeletes;
    public $dates = ['deleted_at'];
}
