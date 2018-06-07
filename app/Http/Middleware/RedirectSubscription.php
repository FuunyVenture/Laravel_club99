<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class RedirectSubscription
{
    /**
     * If user has a valid subscription it will be redirected to 'member/dashboard' else
     * if subscription is not activated by administrator it will be redirected to warning screen at 'member/pending-subscription'
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (isset(\Auth::user()->subscription) && Carbon::today()->lt(Carbon::parse(\Auth::user()->subscription->ends_at)) && isset(\Auth::user()->home_address)) {
            return redirect('member/dashboard');
        } else if(isset(\Auth::user()->subscription) && \Auth::user()->subscription->status == 'pending') {
            return redirect('member/pending-subscription');
        }
        return $next($request);

    }
}