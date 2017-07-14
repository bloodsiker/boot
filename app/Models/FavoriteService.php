<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteService extends Model
{
    /**
     * @var string
     */
    protected $table = 'favorite_service_center';


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user()
    {
        return $this->belongsToMany('App\Models\Users');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function service_center()
    {
        return $this->belongsToMany('App\Models\ServiceCenter');
    }
}
