<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Кол-во просмотров  предоставляемых услуг
 * Class ServicesView
 * @package App\Models
 */
class ServicesView extends Model
{
    protected $table = 'service_center_views_services';

    protected $fillable = ['service_center_id', 'user_id', 'services', 'date_view'];

    public $timestamps = false;
}
