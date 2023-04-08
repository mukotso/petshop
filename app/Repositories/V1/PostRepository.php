<?php

namespace App\Repositories\V1;

use App\Http\Resources\V1\PostResource;
use App\Interfaces\V1\PostInterface;
use App\Models\Post;


class PostRepository implements PostInterface
{

    public function getAllPosts()
    {
        $blogs = Post::all()->paginate('8');
        return  new PostResource::collection($blogs);
    }


    public function showPostDetails($post_uuid)
    {
        $blog = Post::findorFail($post_uuid);
        return  new PostResource($blog);
    }


}
