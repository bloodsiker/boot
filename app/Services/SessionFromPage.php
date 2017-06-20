<?php

namespace App\Services;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class SessionFromPage
{

    /**
     * @var
     */
    protected $route;

    /**
     * SessionFromPage constructor.
     */
    public function __construct()
    {
        $this->checkUrl();
    }


    /**
     *
     */
    public function checkUrl()
    {
        $this->route = Route::currentRouteName();

        if($this->route != 'catalog' && $this->route != 'sc') {
            Session::forget('pick_up_service');
        }
        //dd(Session::all());
    }
}