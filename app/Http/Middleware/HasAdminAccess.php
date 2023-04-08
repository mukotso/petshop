<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HasAdminAccess{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        if (Auth::check() && Auth::user()->is_admin)  {
            return $next($request);
        } else{
            return response(["message" => "Permission Denied"], 401);
        }
    }
}
