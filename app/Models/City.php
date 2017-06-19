<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class City
 * @package App\Models
 */
class City extends Model
{
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function street()
    {
        return $this->hasMany('App\Models\Street');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function serviceCenter()
    {
        return $this->belongsToMany('App\Models\ServiceCenter');
    }

    /**
     * @param $metro
     * @return string
     */
    public static function availabilityMetro($metro)
    {
        switch ($metro)
        {
            case 1:
                return 'Есть';
                break;
            case 0:
                return 'Нету';
                break;
            default:
                return 'Нету';
        }
    }
}
