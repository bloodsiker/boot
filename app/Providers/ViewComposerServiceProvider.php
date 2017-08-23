<?php

namespace App\Providers;

use App\Models\Comments;
use App\Models\FormRequest;
use App\Models\UserRequest;
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

        //Кол-во заявок для сервисного центра с статусом Новая
        view()->composer('service_center_cabinet.layouts.master', function($view){
            if(Auth::user()->roleSc()){
                $serviceCenters = Auth::user()->service_centers->toArray();
                $array_id = array_column($serviceCenters, 'id');
                $new_sc_request = FormRequest::select('*')->whereIn('service_center_id', $array_id)->where('status_id', 1)->get()->count();
                $view->with('new_sc_request', $new_sc_request);
            }
        });

        view()->composer('service_center_cabinet.includes.sidebar', function($view){
            $new_comments = Comments::where('status', 0)->get()->count();
            $new_help_request = UserRequest::where('status', 'Новая')->get()->count();
            $new_sc_all_request = FormRequest::where('status_id', 1)->get()->count();
            $view->with('new_comments', $new_comments);
            $view->with('new_help_request', $new_help_request);
            $view->with('new_sc_all_request', $new_sc_all_request);
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
