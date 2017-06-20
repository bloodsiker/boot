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
        if (Auth::user() && (Auth::user()->roleSc() || Auth::user()->roleAdmin())) {
            return $next($request);
        }
        return redirect('/service-center/login')->with(['message' => 'У вас нету прав доступа в эту часть кабинета!']);
    }
}
