<?php

namespace App\Http\Middleware;

use App\Http\Flash;
use Closure;

class JobAccess
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
        if ($request->is('employer/*') && !$this->isInCompany($request)) {
            return $this->isError();
        }

        if ($request->is('employer/*') && $this->isInCompany($request)) {
            return $next($request);
        }

        if ($request->is('jobs/*') && $this->isClosed($request) && $this->isAwarded($request)) {
            return $next($request);
        }

        if ($request->is('jobs/*') && !$this->isClosed($request)) {
            return $next($request);
        }

        return $this->isError();
    }

    public function isError()
    {
        Flash::make()->titleAs('Unauthorized')->createFlash('error');
        return redirect('/jobs');
    }

    public function isAwarded($request)
    {
        return (integer) $request->user()->id === (integer) $request->route('job')->awarded_to;
    }

    public function isInCompany($request)
    {
        return (integer) $request->user()->company_id === (integer) $request->route('job')->company_id;
    }

    public function isClosed($request)
    {
        return $request->route('job')->closing->isPast();
    }
}
