<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Firebase\JWT\Key;

class JwtMiddleware
{
    public function handle(Request $request, Closure $next)
    {

        // Get the JWT token from the request header
        $token = $request->header('Authorization');

        // Check if the token is present
        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Remove 'Bearer ' prefix from the token
        $token = str_replace('Bearer ', '', $token);

        try {
            $privateKey = file_get_contents('../openssl/public.pem');

            // Verify and decode the JWT token
            $decoded = JWT::decode($token,new Key($privateKey, 'RS256'));
            // You can add additional validation here if needed
            // Pass the decoded token to the request for further use
            $request->jwt = $decoded;

        } catch (\Exception $e) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
