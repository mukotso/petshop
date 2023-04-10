<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\UsersRequest;
use App\Http\Resources\V1\UserResource;
use App\Interfaces\V1\UserInterface;
use App\Models\User;
use Illuminate\Http\Request;

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
                    [],
                    'message' => 'An error occurred ,Please try again'
                ]
                , 500
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(UsersRequest $request)
    {
        try {
            $this->userRepository->createUser($request->all());

            return response(
                [
                    [],
                    'message' => 'User created successfully'
                ]
                , 200
            );
        } catch (\Exception $e) {
            //log exception
            Log::error($e);
            return response(
                [
                    [],
                    'message' => 'An error occurred ,Please try again'
                ]
                , 500
            );
        }
    }



    /**
     * Display the specified resource.
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
                    [],
                    'message' => 'An error occurred ,Please try again'
                ]
                , 500
            );
        }
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UsersRequest $request, $user_uuid)
    {
        try {
            $this->userRepository->updateUserDetails($request->all(), $user_uuid);
            return response(
                [
                    [],
                    'message' => 'User details updated successfully'
                ]
                , 200
            );
        } catch (\Exception $e) {
            //log exception
            Log::error($e);
            return response(
                [
                    [],
                    'message' => 'An error occurred ,Please try again'
                ]
                , 500
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($user_uuid)
    {
        try {
            $this->userRepository->deleteUser($user_uuid);

            return response(
                [
                    [],
                    'message' => 'User deleted successfully'
                ]
                , 200
            );
        } catch (\Exception $e) {
            //log exception
            Log::error($e);
            return response(
                [
                    [],
                    'message' => 'An error occurred ,Please try again'
                ]
                , 500
            );
        }
    }
}
