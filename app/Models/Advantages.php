<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advantages extends Model
{
    protected $table = 'service_center_advantages';

    public function serviceCenter()
    {
        return $this->belongsTo('App\Models\ServiceCenter');
    }
}
