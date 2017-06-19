<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkDays extends Model
{
    protected $table = 'service_working_days';

    protected $fillable = ['title', 'start_time', 'end_time', 'weekend'];
}
