<?php

namespace App\Http\Middleware;

use App\Http\Flash;
use Closure;

class ApplicationAccess
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

        if ($request->is('jobs/*') && $this->isInCompany($request)) {
            return redirect("employer/{$request->path()}");
        }

        if ($request->is('jobs/*') && $this->isApplicant($request)) {
            return $next($request);
        }

        Flash::make()->titleAs('Unauthorized')->createFlash('error');
        return redirect('/applications');
    }

    public function isApplicant($request)
    {
        return (integer) $request->user()->id === (integer) $request->route('application')->user->id;
    }

    public function isInCompany($request)
    {
        return (integer) $request->user()->company_id === (integer) $request->route('job')->company_id;
    }
}
