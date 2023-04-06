<?php

namespace App\Interfaces;


interface PostInterface
{

    public function getAllPosts();

    public function createPost(array $post_details);

    public function showPostDetails($post_uuid);

    public function updatePostDetails($post_uuid);

    public function deletePost($post_uuid);


}
