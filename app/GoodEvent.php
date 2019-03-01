<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoodEvent extends Model
{
    protected $table='events';

    public function GoodDate()
    {
        return $this->belongsTo('App\GoodDate','dateTimeId');
    }
}
