<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    public $timestamps = false;

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

}
