<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormRequest extends Model
{
    protected $table = 'form_requests';

    protected $fillable = [
        'pagename', 'city', 'name', 'phone', 'comment', 'status'
    ];
}
