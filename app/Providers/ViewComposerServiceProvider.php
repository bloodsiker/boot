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
            if(Auth::user()->role_id == 2){
                $service_centers = Auth::user()->service_centers()->enabled()->get();
            } elseif (Auth::user()->role_id == 1){
                $service_centers = ServiceCenter::where('enabled', 0)->get();
            }
            $view->with('service_centers', $service_centers);
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
