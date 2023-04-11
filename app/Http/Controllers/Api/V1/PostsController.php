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

    /**
     * @OA\Get(
     * path="/main/blog",
     * summary="List all blogs",
     * description=" view all blogs",
     * tags={"Main Page"},
     *
    @OA\Response(
     * response=200,
     * description="Successfull (Ok)",
     * ),
     * @OA\Response(
     * response=403,
     * description="Forbidden"
     * ),
     *
     * @OA\Response(
     * response=401,
     * description="Unauthenticated"
     * ),
     * @OA\Response(
     * response=404,
     * description="Page not found"
     * ),
     *  @OA\Response(
     * response=422,
     * description="Unprocessable Entity"
     * ),
     *  @OA\Response(
     * response=500,
     * description="Internal server error"
     * ),
     * )
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

    /**
     * @OA\Get(
     * path="/main/blog/{blog_uuid}",
     * summary="view a single blog",
     * description="view a blog",
     * tags={"Main Page"},
     * @OA\Parameter(
     *          name="blog_uuid",
     *          description="blog id",
     *          required=true,
     *          in="path",
     *
     *      ),
     *
    @OA\Response(
     * response=200,
     * description="Successfull (Ok)",
     * ),
     * @OA\Response(
     * response=403,
     * description="Forbidden"
     * ),
     *
     * @OA\Response(
     * response=401,
     * description="Unauthenticated"
     * ),
     * @OA\Response(
     * response=404,
     * description="Page not found"
     * ),
     *  @OA\Response(
     * response=422,
     * description="Unprocessable Entity"
     * ),
     *  @OA\Response(
     * response=500,
     * description="Internal server error"
     * ),
     * )
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
