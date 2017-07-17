<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class IsUserProfile
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
        if (Auth::user() && (Auth::user()->roleUser())) {
            Auth::user()->updateLastOnline();
            return $next($request);
        }
        return redirect()->route('user.login')->with(['message' => 'Вы не авторизованы!']);
    }
}
