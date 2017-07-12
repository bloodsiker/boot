<?php

namespace App\Providers;

use App\Models\FormRequest;
use Auth;
use Illuminate\Support\ServiceProvider;

class UserProfileComposer extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('user_profile.includes.sidebar', function($view){
            $count_request = FormRequest::where('user_id', Auth::user()->id)->where('status_id', 1)->count();
            $view->with('count_request', $count_request);
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
