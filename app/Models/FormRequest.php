<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class FormRequest extends Model
{
    protected $table = 'form_requests';

    protected $fillable = [
        'r_id', 'service_center_id', 'user_id', 'city', 'name', 'phone', 'email',
        'manufacturer', 'services', 'cost_of_work_min', 'cost_of_work_max', 'cost_of_work_end', 'task_description',
        'payment_method', 'exit_master', 'client_address', 'comment', 'status_id'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service_center()
    {
        return $this->belongsTo('App\Models\ServiceCenter');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany('App\Models\FormRequestMessage', 'request_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function status()
    {
        return $this->hasOne('App\Models\RequestStatus', 'id', 'status_id');
    }


    /**
     * @param $service_center_id
     * @return mixed
     */
    public static function count_request($service_center_id)
    {
        $count = parent::where('service_center_id', $service_center_id)->get()->count();
        return $count;
    }


    /**
     * @param Builder $builder
     * @param $r_id
     * @return mixed
     */
    public static function scopeCheckID(Builder $builder, $r_id)
    {
        return $builder
            ->where('r_id', $r_id);
    }
}
