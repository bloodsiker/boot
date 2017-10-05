<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class SessionFromPage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->route = Route::currentRouteName();

        if($this->route != 'user.login' &&
            $this->route != 'auth.facebook' && $this->route != 'auth.facebook.callback' &&
            $this->route != 'auth.google' && $this->route != 'auth.google.callback' &&
            $this->route != 'auth.linkedin' && $this->route != 'auth.linkedin.callback') {
            Session::put('page', url()->current());
        }

        if($this->route != 'catalog' && $this->route != 'sc') {
            if(Session::has('pick_up_service')){
                Session::forget('pick_up_service');
            }
        }
        return $next($request);
    }
}
