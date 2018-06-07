<?php

namespace App\Http\Middleware;

use Auth;
use Carbon\Carbon;
use Closure;
use Log;

class Subscribed
{
    /**
     * Redirect users to subscription page if subscription expired..
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::guard()->guest()) {
            if (!isset(\Auth::user()->subscription) ||
                (!Carbon::today()->lt(Carbon::parse(\Auth::user()->subscription->ends_at)))
            ) {
                return redirect('member/subscription')->withErrors(['error' => 'Your subscription has expired']);
            }

        }
        return $next($request);
    }
}
