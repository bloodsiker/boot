<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class ServiceCenter extends Model
{
    //protected $table = 'service_centers';
    public $timestamps = false;

    public function user()
    {
        return $this->hasOne('App/Models/User');
    }

    public function request()
    {
        return $this->hasMany('App\Models\UserRequest');
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
    public function certificate()
    {
        return $this->hasMany('App\Models\Certificate', 'service_center_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function service_photo()
    {
        return $this->hasMany('App\Models\ServicePhoto', 'service_center_id', 'id');
    }
}
