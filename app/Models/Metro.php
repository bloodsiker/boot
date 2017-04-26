<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Metro extends Model
{
    public $timestamps = false;

    public function serviceCenter()
    {
        return $this->belongsToMany('App\Models\ServiceCenter');
    }
}
