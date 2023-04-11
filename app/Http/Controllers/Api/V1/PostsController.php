<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\V1\PostResource;
use App\Interfaces\V1\PostInterface;
use Illuminate\Support\Facades\Log;

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
        try {
            $posts = $this->postRepository->getAllPosts();
            return response(
                [
                    'posts' => PostResource::collection($posts),
                    'message' => 'Blogs Retrieved successfully'
                ]
                , 200
            );
        } catch (\Exception $e) {
            //log exception
            Log::error($e);
            return response(
                [
                    'message' => 'An error occurred ,Please try again'
                ]
                , 500
            );
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($post_uuid)
    {
        try {
            $post = $this->postRepository->showPostDetails($post_uuid);
            return response(
                [
                    'post' => new PostResource($post),
                    'message' => 'Blogs Retrieved successfully'
                ]
                , 200
            );
        }catch (\Exception $e) {
                //log exception
                Log::error($e);
                return response(
                    [
                        'message' => 'An error occurred ,Please try again'
                    ]
                    , 500
                );
            }
    }


}
