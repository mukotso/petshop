<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\UsersRequest;
use App\Http\Resources\V1\UserResource;
use App\Interfaces\V1\UserInterface;
use Log;

class UsersController extends Controller
{

    protected UserInterface $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     */

    /**
     * @OA\Get(
     * path="/admin/user-listing",
     * summary="List all users",
     * description="admin view all users",
     * tags={"Admin end points"},
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
    public function index()
    {
        try {
            $users = $this->userRepository->getAllUsers();

            return response(
                [
                    'users' => UserResource::collection($users),
                    'message' => 'Users Retrieved successfully'
                ]
                , 200
            );
        } catch (\Exception $e) {
            //log exception
            Log::error($e);
            return response(
                [
                    'message' => 'An error occurred ,Please try again'
                ]
                , 500
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * @OA\Post(
     * path="/admin/create",
     * summary="Create  a user",
     * description="admin create a user account",
     * tags={"Admin end points"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass required user details",
     *    @OA\JsonContent(
     *       required={"first_name","last_name","email","password","address","phone_number"},
     *       @OA\Property(property="first_name", type="string", example="kelvin"),
     *       @OA\Property(property="last_name", type="string", example="mukotso"),
     *       @OA\Property(property="email", type="string", format="email", example="user@gmail"),
     *       @OA\Property(property="password", type="string", format="password", example="password"),
     *       @OA\Property(property="address", type="string", example="east kenya"),
     *       @OA\Property(property="phone_number", type="number", format="tel", example="0776756454"),
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


    public function create(UsersRequest $request)
    {
        try {
           $user = $this->userRepository->createUser($request->all());

            return response(
                [
                    ['user' => new UserResource($user)],
                    'message' => 'User created successfully'
                ]
                , 200
            );
        } catch (\Exception $e) {
            //log exception
            Log::error($e);
            return response(
                [
                    'message' => 'An error occurred ,Please try again'
                ]
                , 500
            );
        }
    }



    /**
     * Display the specified resource.
     */

    /**
     * @OA\Get(
     * path="/admin/user-show/{user_uuid}",
     * summary="view a single user",
     * description="admin create a user account",
     * tags={"Admin end points"},
     * @OA\Parameter(
     *          name="user_uuid",
     *          description="user id",
     *          required=true,
     *          in="path",
     *
     *      ),
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
    public function show($user_uuid)
    {
        try {
            $user = $this->userRepository->showUserDetails($user_uuid);

            return response(
                [
                    'user' => new UserResource($user),
                    'message' => 'user details fetched  successfully'
                ]
                , 200
            );
        } catch (\Exception $e) {
            //log exception
            Log::error($e);
            return response(
                [
                    'message' => 'An error occurred ,Please try again'
                ]
                , 500
            );
        }
    }



    /**
     * Update the specified resource in storage.
     */
    /**
     * @OA\Put(
     * path="/admin/user-edit/{user_uuid}",
     * summary="update user details",
     * description="admin update a user account",
     * tags={"Admin end points"},
     * @OA\Parameter(
     *          name="user_uuid",
     *          description="user id",
     *          required=true,
     *          in="path",
     *
     *      ),

     * @OA\RequestBody(
     *    required=true,
     *    description="Pass required user details",
     *    @OA\JsonContent(
     *       required={"first_name","last_name","email","address","phone_number"},
     *       @OA\Property(property="first_name", type="string", example="kelvin"),
     *       @OA\Property(property="last_name", type="string", example="mukotso"),
     *       @OA\Property(property="email", type="string", format="email", example="useredited@gmail"),
     *       @OA\Property(property="address", type="string", example="east kenya"),
     *       @OA\Property(property="phone_number", type="number", format="tel", example="0776756454"),
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
    public function update(UsersRequest $request, $user_uuid)
    {
        try {
            $this->userRepository->updateUserDetails($request->all(), $user_uuid);
            return response(
                [
                    'message' => 'User details updated successfully'
                ]
                , 200
            );
        } catch (\Exception $e) {
            //log exception
            Log::error($e);
            return response(
                [
                    'message' => 'An error occurred ,Please try again'
                ]
                , 500
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */

    /**
     * @OA\Delete(
     * path="/admin/user-delete/{user_uuid}",
     * summary="delete a single user",
     * description="admin delete a user account",
     * tags={"Admin end points"},
     * @OA\Parameter(
     *          name="user_uuid",
     *          description="user id",
     *          required=true,
     *          in="path",
     *
     *      ),
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
    public function destroy($user_uuid)
    {
        try {
            $this->userRepository->deleteUser($user_uuid);

            return response(
                [
                    'message' => 'User deleted successfully'
                ]
                , 200
            );
        } catch (\Exception $e) {
            //log exception
            Log::error($e);
            return response(
                [
                    'message' => 'An error occurred ,Please try again'
                ]
                , 500
            );
        }
    }
}
