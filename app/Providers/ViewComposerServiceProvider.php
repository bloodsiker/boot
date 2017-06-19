<?php

namespace App\Providers;

use App\Models\ServiceCenter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('service_center_cabinet.includes.sidebar', function($view){
            $view->with('service_centers', Auth::user()->service_centers()->enabled()->get());
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
