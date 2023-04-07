<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\UserLoginRequest;
use App\Http\Requests\UserRegistrationRequest;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Hash;

use function App\Http\Controllers\config;
use function App\Http\Controllers\response;

class ApiAuthController extends Controller
{

    public function login(UserLoginRequest $request)
    {
        if (User::where('email', '=', $request->email)->exists()) {
            $user = User::where('email', '=', $request->email)->first();

            if (Hash::check($request->password, $user->password)) {
                $host = parse_url($request->url(), PHP_URL_HOST);
                $domain = explode('.', $host)[count(explode('.', $host)) - 2] . '.' . explode('.', $host)[count(
                        explode('.', $host)
                    ) - 1];


                // Set the token payload
                $payload = [
                    'iss' => $domain,
                    'sub' => $user->uuid,
                ];

                // Generate the token
                $token = JWT::encode($payload, $private_key, 'RS256');

                return response()->json([
                    'success' => true,
                    'message' => 'User Logged In Succesfully!',
                    'data' => [
                        'accessToken' => JWT::encode($payload, config('jwt.key'), 'RS256'),
                    ],
                ], 200);
            }

            return response()->json([
                'success' => true,
                'message' => 'Wrong User Credential!',
                'data' => null,
            ], 400);
        }

        return response()->json([
            'success' => false,
            'message' => 'No User With That Email Address!',
            'data' => null,
        ], 404);
    }

}
