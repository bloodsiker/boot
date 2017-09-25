<?php

namespace App\Services;

use Illuminate\Support\Facades\Route;

class ReturnToPreviousPage
{

    /**
     *  После авторизации клиента в личный кабинет, перенаправляем его на страницу с которой он пришел
     * @return string
     */
    public function redirectToPrev()
    {
        $this->route = Route::currentRouteName();

        $prevUrl = \Session::has('page') ? \Session::get('page') : route('user.dashboard');

        return $prevUrl;
    }
}