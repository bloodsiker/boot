<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class ServiceCenter extends Model
{
    protected $table = 'service_centers';

    public $timestamps = false;

    protected $fillable = [
        'service_name', 'about', 'city_id', 'metro_id', 'district_id',
        'address', 'number_h', 'number_h_add', 'street', 'c1', 'c2', 'logo', 'exit_master'
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function request()
    {
        return $this->hasMany('App\Models\FormRequest');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function city()
    {
        return $this->hasOne('App\Models\City', 'id', 'city_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function metro()
    {
        return $this->hasOne('App\Models\Metro', 'id', 'metro_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function district()
    {
        return $this->hasOne('App\Models\District', 'id', 'district_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tags()
    {
        return $this->hasMany('App\Models\Tags', 'service_center_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comments');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function manufacturers()
    {
        return $this->belongsToMany('App\Models\Manufacturer', 'service_center_vs_manufacturer', 'service_center_id', 'manufacturer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function advantages()
    {
        return $this->hasMany('App\Models\Advantages', 'service_center_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function price()
    {
        return $this->hasMany('App\Models\Price', 'service_center_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function personal()
    {
        return $this->hasMany('App\Models\Personal', 'service_center_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function work_days()
    {
        return $this->hasMany('App\Models\WorkDays', 'service_center_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function service_photo()
    {
        return $this->hasMany('App\Models\ServicePhoto', 'service_center_id', 'id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function service_phones()
    {
        return $this->hasMany('App\Models\ServicePhone', 'service_center_id', 'id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function service_emails()
    {
        return $this->hasMany('App\Models\ServiceEmail', 'service_center_id', 'id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function service_request()
    {
        return $this->hasMany('App\Models\FormRequest', 'service_center_id', 'id');
    }


    /**
     * @param Builder $builder
     * @param int $enabled
     * @return mixed
     */
    public static function scopeEnabled(Builder $builder, $enabled = 0)
    {
        return $builder
            ->where('enabled', $enabled);
    }
}
