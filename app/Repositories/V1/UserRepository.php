<?php

namespace App\Repositories\V1;


use App\Interfaces\V1\UserInterface;
use App\Models\User;


class UserRepository implements UserInterface
{

    public function getAllUsers()
    {
        return User::nonAdmin()->orderBy('created_at', 'DESC')->paginate('8');
    }

    public function createUser(array $user_details)
    {
        return User::create($user_details);
    }

    public function showUserDetails($user_uuid)
    {
        return User::findorFail($user_uuid);
    }

    public function updateUserDetails(array $user_details, $user_uuid)
    {
        $user = User::findorFail($user_uuid);
        return $user->update($user_details);
    }

    public function deleteUser($user_uuid)
    {
        $user = User::findorFail($user_uuid);
        return $user->delete();
    }

}
