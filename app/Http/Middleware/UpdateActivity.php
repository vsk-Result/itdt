<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

class UpdateActivity
{
    public function handle($request, Closure $next, $guard = null)
    {
        $request = $next($request);

        if (!Auth::guard($guard)->guest()) {
            Auth::user()->update([
                'last_activity' => Carbon::now(),
                'last_ip' => $this->getIP()
            ]);
        }

        return $request;
    }

    private function getIP()
    {
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = @$_SERVER['REMOTE_ADDR'];

        if (filter_var($client, FILTER_VALIDATE_IP)) $ip = $client;
        elseif (filter_var($forward, FILTER_VALIDATE_IP)) $ip = $forward;
        else $ip = $remote;

        return $ip;
    }
}
