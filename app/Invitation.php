<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'invitations';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'user_id', 'active_user_id'];

    
}
