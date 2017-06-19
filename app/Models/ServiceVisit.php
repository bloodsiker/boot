<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ServiceVisit
 * @package App\Models
 */
class ServiceVisit extends Model
{
    protected $table = 'service_center_visits';

    protected $fillable = ['service_center_id', 'hosts', 'views', 'date_view'];

    public $timestamps = false;
}
