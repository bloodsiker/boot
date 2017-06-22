<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicePhone extends Model
{
    protected $table = 'service_center_phone';

    protected $fillable = ['phone'];

    public $timestamps = false;
}
