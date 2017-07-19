<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $table = 'service_center_price';

    public function service_center()
    {
        return $this->belongsTo('App\Models\ServiceCenter');
    }
}
