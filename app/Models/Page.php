<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'pages';

    protected $fillable = ['name', 'content', 'enabled'];

    public $timestamps = false;


    public static function scopeEnabled(Builder $builder)
    {
        return $builder
            ->where('enabled', 1);
    }
}
