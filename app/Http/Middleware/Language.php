<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Language
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
        if (!Session::get('locale') == null) {
            $locale = Session::get('locale');
            App::setLocale($locale);
        } else {
            Session::put('locale', 'en');
            App::setLocale(Session::get('locale'));
        }


        return $next($request);
    }
}
