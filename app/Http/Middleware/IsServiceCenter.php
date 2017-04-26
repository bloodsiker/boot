<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsServiceCenter
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
        if (Auth::user() &&  (Auth::user()->role_id == 2 || Auth::user()->role_id == 4)) {
            return $next($request);
        }
        return redirect('/service-center/login')->with(['message' => 'У вас нету прав доступа в эту часть кабинета!']);
    }
}
