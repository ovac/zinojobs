<?php

namespace App\Http\Middleware;

use App\Http\Flash;
use Closure;

class MessageAccess
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
        if ($request->is('employer/*') && $this->isInCompany($request)) {
            return $next($request);
        }

        if ($request->is('jobs/*') && $this->isClosed($request) && $this->isAwarded($request)) {
            return $next($request);
        }

        if ($request->is('jobs/*') && !$this->isClosed($request)) {
            return $next($request);
        }

        if ($request->is('jobs/*') && $this->isApplicant($request)) {
            return $next($request);
        }

        if ($request->wantsJson()) {
            return response(401);
        }

        Flash::make()->titleAs('Unauthorized')->createFlash('error');

        return redirect('/');
    }

    public function isAwarded($request)
    {
        return (integer) $request->user()->id === (integer) $request->route('job')->awarded_to;
    }

    public function isInCompany($request)
    {
        return (integer) $request->user()->company_id === (integer) $request->route('job')->company_id;
    }

    public function isApplicant($request)
    {
        return (integer) $request->user()->id === (integer) $request->route('application')->user->id;
    }

    public function isClosed($request)
    {
        return $request->route('job')->closing->isPast();
    }
}
