<?php

namespace App\Http\Middleware;

use App\Http\Library\Notie;
use Closure;

class PermissionChecking
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param $permission_code
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $permission_code)
    {
        if(checkPermission($permission_code) == false)
        {
            Notie::error(trans('custom.do_not_have_permission'));

            return redirect()->back();
        }

        return $next($request);
    }
}
