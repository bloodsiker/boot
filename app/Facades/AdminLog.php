<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class AdminLog extends Facade
{
    protected static function getFacadeAccessor() { return 'AdminLog'; }
}