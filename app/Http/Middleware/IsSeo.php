<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsSeo
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
        if (Auth::user() &&  (Auth::user()->roleAdmin() || Auth::user()->roleSeo())) {
            Auth::user()->updateLastOnline();
            return $next($request);
        }
        return redirect('/adm/auth')->with(['message' => 'У вас нету прав доступа в эту часть кабинета!']);
    }
}
