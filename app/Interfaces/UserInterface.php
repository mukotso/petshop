<?php

namespace App\Interfaces;


interface UserInterface
{

    public function getAllUsers();

    public function createUser($user_details);

    public function showUserDetails($user_uuid);

    public function UpdateUserDetails($user_uuid);

    public function deleteUser($user_uuid);

}
