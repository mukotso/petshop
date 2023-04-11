<?php

namespace App\Http\Middleware;

use App\Models\User;
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
        $user =User::find($request->jwt->sub);
        if ($user->is_admin)  {
            return $next($request);
        }
            return response(["message" => "Permission Denied"], 401);

    }
}
