<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Active
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (!Auth::guard($guard)->guest() && !Auth::user()->isActive()) {
            abort(403);
        }

        return $next($request);
    }
}
