<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
    /**
     * Admin middleware grant access only to Administration Users.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       		if (\Auth::guard()->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('guest#login');
            }
        }
        if('Admin' === \Auth::user()->role->name || 'Sub Admin' === \Auth::user()->role->name)
        {
            return $next($request);
        }

        return redirect('/');
    }
}
