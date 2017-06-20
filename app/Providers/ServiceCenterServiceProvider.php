<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ServiceCenterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Repositories\ServiceCenter\ServiceCenterRepositoryInterface::class,
            \App\Repositories\ServiceCenter\ServiceCenterRepository::class
        );

        $this->app->bind(
            \App\Repositories\VisitsServiceCenter\VisitsRepositoryInterface::class,
            \App\Repositories\VisitsServiceCenter\VisitsRepository::class
        );

        $this->app->bind(
            \App\Services\SessionFromPage::class
        );
    }
}
