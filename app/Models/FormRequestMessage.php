<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormRequestMessage extends Model
{
    protected $table = 'form_request_message';

    protected $fillable = ['request_id', 'user_id', 'service_center_id', 'message', 'sys_info'];
}
