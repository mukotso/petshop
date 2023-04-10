<?php

namespace App\Repositories\V1;

use App\Http\Resources\V1\PostResource;
use App\Interfaces\V1\PostInterface;
use App\Models\Post;


class PostRepository implements PostInterface
{

    public function getAllPosts()
    {
        return Post::orderBy('created_at', 'DESC')->paginate('8');
    }


    public function showPostDetails($post_uuid)
    {
        return Post::findorFail($post_uuid);
    }


}
