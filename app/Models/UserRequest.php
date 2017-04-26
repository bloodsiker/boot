<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
{
    protected $table = 'requests';

    public function service()
    {
        return $this->belongsTo('App\ServiceCenter');
    }

    public static function count_request($service_center_id)
    {
        $count = parent::where('service_id', $service_center_id)->get()->count();
        return $count;
    }

}
