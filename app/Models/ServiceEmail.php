<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceEmail extends Model
{
    protected $table = 'service_center_email';

    protected $fillable = ['email'];

    public $timestamps = false;
}
