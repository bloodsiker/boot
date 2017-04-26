<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $timestamps = false;

    public function street()
    {
        return $this->hasMany('App\Models\Street');
    }

    public function serviceCenter()
    {
        return $this->belongsToMany('App\Models\ServiceCenter');
    }
}
