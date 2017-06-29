<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminLog extends Model
{
    protected $table = 'admin_logs';

    protected $fillable = ['user_id', 'action', 'ip_address', 'user_agent'];
}
