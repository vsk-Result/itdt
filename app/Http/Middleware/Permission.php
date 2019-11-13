<?php

namespace App\Http\Middleware;

use Closure;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $permissionSlug
     * @return mixed
     */
    public function handle($request, Closure $next, $permissionSlug)
    {
        if (! app('auth')->user()->hasPermission($permissionSlug)) {
            abort(403);
        }
        return $next($request);
    }
}
