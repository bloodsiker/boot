<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Visit
 * @package App\Models
 */
class Visit extends Model
{
    protected $table = 'ips_visits';

    protected $fillable = ['service_center_id', 'ip_address', 'date_view'];

    public $timestamps = false;
}
