<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    public function service_centers()
    {
        return $this->hasMany('App\Models\ServiceCenter', 'user_id', 'id');
    }

    /**
     * @return bool
     */
    public function roleSc()
    {
        if(Auth::user()->role_id == 2){
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function roleAdmin()
    {
        if(Auth::user()->role_id == 1){
            return true;
        }
        return false;
    }


    /**
     * @return bool
     */
    public function roleSeo()
    {
        if(Auth::user()->role_id == 4){
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function roleCrm()
    {
        if(Auth::user()->role_id == 5){
            return true;
        }
        return false;
    }
}
