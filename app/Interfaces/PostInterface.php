<?php

namespace App\Interfaces;


interface PostInterface
{

    public function getAllPosts();

    public function showPostDetails($post_uuid);



}
