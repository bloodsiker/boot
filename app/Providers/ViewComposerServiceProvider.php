<?php

namespace App\Providers;

use App\Models\Comments;
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
            if(Auth::user()->roleSc()){
                $service_centers = Auth::user()->service_centers()->enabled()->get();
                $view->with('service_centers', $service_centers);
            }
        });

        view()->composer('service_center_cabinet.includes.sidebar', function($view){
            $new_comments = Comments::where('status', 0)->get()->count();
            $view->with('new_comments', $new_comments);
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
