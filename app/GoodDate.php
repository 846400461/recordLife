<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoodDate extends Model
{
    protected $table='dateTime';

    public function User()
    {
        return $this->belongsTo('App\User','UserId');
    }

    public function GoodEvent()
    {
        return $this->hasOne('App\GoodEvent','dateTimeId');
    }
}
