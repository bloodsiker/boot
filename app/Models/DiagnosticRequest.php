<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiagnosticRequest extends Model
{
    protected $table = 'diagnostic_request';

    protected $fillable = ['type_device', 'problem_know', 'problem_watching', 'problem_description', 'ip_address'];
}
