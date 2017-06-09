<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserRequest
 * @package App\Models
 */
class UserRequest extends Model
{

    protected $table = 'requests';


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service()
    {
        return $this->belongsTo('App\Models\ServiceCenter');
    }


    /**
     * @param $service_center_id
     * @return mixed
     */
    public static function count_request($service_center_id)
    {
        $count = parent::where('service_id', $service_center_id)->get()->count();
        return $count;
    }

}
