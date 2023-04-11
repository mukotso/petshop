<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Auth;
use Request;


class ApiAuthController extends Controller
{

    public function login(UserLoginRequest $request)
    {
        if (User::where('email', '=', $request->email)->exists()) {
            $user = User::where('email', '=', $request->email)->first();

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $domain = Request::server("HTTP_HOST");

                $privateKey = file_get_contents('../openssl/private.pem');
                // Set the token payload
                $payload = [
                    'iss' => $domain,
                    'sub' => $user->id,
                ];

                // Generate the token
                $token = JWT::encode($payload, $privateKey, 'RS256');
                return response()->json([
                    'success' => true,
                    'message' => 'User Logged In Succesfully!',
                    'data' => [
                        'accessToken' => $token,
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
