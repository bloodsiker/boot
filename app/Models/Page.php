<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'pages';

    protected $fillable = ['name', 'content', 'enabled'];

    public $timestamps = false;


    /**
     * @param Builder $builder
     * @return $this
     */
    public static function scopeEnabled(Builder $builder)
    {
        return $builder
            ->where('enabled', 1);
    }


    /**
     * @param $status
     * @return string
     */
    public static function availabilityStatus($status)
    {
        switch ($status)
        {
            case 1:
                return 'Включена';
                break;
            case 0:
                return 'Выключена';
                break;
            default:
                return 'Включена';
        }
    }
}
