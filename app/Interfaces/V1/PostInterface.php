<?php

namespace App\Interfaces\V1;


interface PostInterface
{

    public function getAllPosts();

    public function showPostDetails($post_uuid);



}
