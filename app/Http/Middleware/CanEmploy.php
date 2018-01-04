<?php

namespace App\Http\Middleware;

use Closure;

class CanEmploy
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

        if ($request->user()->company()->count()) {
            return $next($request);
        }

        return redirect('/employer/setup');
    }
}
