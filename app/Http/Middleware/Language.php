<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Application;

class Language
{
    function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = session('lg','en');
        $this->app->setLocale($locale);

        return $next($request);
    }
}
