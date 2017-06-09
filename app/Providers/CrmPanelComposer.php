<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CrmPanelComposer extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('crm_cabinet.includes.sidebar', function($view){
            $count = 5;
            $view->with('count_request_cs', $count);
            $count_help = 7;
            $view->with('count_request_help', $count_help);
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
