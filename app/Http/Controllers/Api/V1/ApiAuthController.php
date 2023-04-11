<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Auth;
use Request;


class ApiAuthController extends Controller
{
    /**
     * @OA\Post(
     * path="/admin/login",
     * summary="Sign in a user",
     * description="Login by email, password",
     * operationId="authLogin",
     * tags={"auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"email","password"},
     *       @OA\Property(property="email", type="string", format="email", example="admin@buckhill.co.uk"),
     *       @OA\Property(property="password", type="string", format="password", example="admin"),
     *    ),
     * ),
     *
    @OA\Response(
     * response=200,
     * description="Successfull (Ok)",
     * ),
     * @OA\Response(
     * response=403,
     * description="Forbidden"
     * ),
     *
     * @OA\Response(
     * response=401,
     * description="Unauthenticated"
     * ),
     * @OA\Response(
     * response=404,
     * description="Page not found"
     * ),
     *  @OA\Response(
     * response=422,
     * description="Unprocessable Entity"
     * ),
     *  @OA\Response(
     * response=500,
     * description="Internal server error"
     * ),
     * )
     */

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
