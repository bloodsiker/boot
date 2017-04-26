<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    public function serviceCenter()
    {
        return $this->belongsToMany('App\Models\ServiceCenter');
    }
}
