<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    protected $table = 'service_center_vs_tags';

    public function serviceCenter()
    {
        return $this->belongsTo('App\Models\ServiceCenter');
    }
}
