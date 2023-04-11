<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class HasUserAccess{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        if (Auth::check() && !Auth::user()->is_admin)  {
            return $next($request);
        }
            return response(["message" => "Permission Denied"], 401);

    }
}
