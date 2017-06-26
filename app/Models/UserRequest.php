<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserRequest
 * @package App\Models
 */
class UserRequest extends Model
{

    protected $table = 'requests';

    protected $fillable = ['user_name', 'phone', 'comment', 'status'];
}
