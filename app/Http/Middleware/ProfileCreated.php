<?php

namespace App\Http\Middleware;

use Closure;

class ProfileCreated
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
        if ($request->user()->isEmployer() && null === $request->user()->profile()->first()) {
            return redirect(route('employer.create'));
        }
        return $next($request);
    }
}
