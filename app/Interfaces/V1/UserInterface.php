<?php

namespace App\Interfaces\V1;


interface UserInterface
{

    public function getAllUsers();

    public function createUser(array $user_details);

    public function showUserDetails($user_uuid);

    public function updateUserDetails(array $user_details, $user_uuid);

    public function deleteUser($user_uuid);

}
