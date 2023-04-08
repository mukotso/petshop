<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\V1\PostResource;
use App\Interfaces\V1\PostInterface;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{

    protected PostInterface $postRepository;

    public function __construct(PostInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return $this->postRepository->getAllPosts();

    }


    /**
     * Display the specified resource.
     */
    public function show($post_uuid)
    {
        return $this->postRepository->showPostDetails($post_uuid);
    }


}
