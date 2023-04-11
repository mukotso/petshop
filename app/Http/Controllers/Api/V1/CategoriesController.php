<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\CategoriesRequest;
use App\Http\Resources\V1\CategoryResource;
use App\Interfaces\V1\CategoryInterface;
use Illuminate\Support\Facades\Log;

class CategoriesController extends Controller
{

    protected CategoryInterface $categoryRepository;

    public function __construct(CategoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     */

    /**
     * @OA\Get(
     * path="/categories",
     * summary="List all categories",
     * description="view all categories",
     * tags={"Categories"},
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
            $categories = $this->categoryRepository->getAllCategories();

            return response(
                [
                    'categories' => CategoryResource::collection($categories),
                    'message' => 'Categories Retrieved successfully'
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
     * Show the form for creating a new resource.
     */

    /**
     * @OA\Post(
     * path="/category/create",
     * summary="Create  a category",
     * description=" create a category",
     * tags={"Categories"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass required category details",
     *    @OA\JsonContent(
     *       required={"title","slug"},
     *       @OA\Property(property="title", type="string", example="family"),
     *       @OA\Property(property="slug", type="string", example="fm"),
     *    ),
     * ),
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
    public function create(CategoriesRequest $request)
    {
        try {
           $category = $this->categoryRepository->createCategory($request->all());

            return response(
                [
                    'category' => new CategoryResource($category),
                    'message' => 'Category created successfully'
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
     * path="/category/{category_uuid}",
     * summary="view a single category",
     * description="view a category",
     * tags={"Categories"},
     * @OA\Parameter(
     *          name="category_uuid",
     *          description="category id",
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
    public function show($category_uuid)
    {
        try {
            $category = $this->categoryRepository->showCategoryDetails($category_uuid);

            return response(
                [
                    'category' => new CategoryResource($category),
                    'message' => 'Category details fetched successfully'
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
     * Update the specified resource in storage.
     */

    /**
     * @OA\Put(
     * path="/category/{category_uuid}",
     * summary="update a  category",
     * description="update a category",
     * tags={"Categories"},
     * @OA\Parameter(
     *          name="category_uuid",
     *          description="category id",
     *          required=true,
     *          in="path",
     *
     *      ),
     *
     *  @OA\RequestBody(
     *    required=true,
     *    description="Pass required category details",
     *    @OA\JsonContent(
     *       required={"title","slug"},
     *       @OA\Property(property="title", type="string", example="family edited"),
     *       @OA\Property(property="slug", type="string", example="fm ed"),
     *    ),
     * ),
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
    public function update(CategoriesRequest $request, $category_uuid)
    {
        try {
            $this->categoryRepository->updateCategoryDetails($request->all(), $category_uuid);
            return response(
                [
                    'message' => 'Category details updated successfully'
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
     * Remove the specified resource from storage.
     */

    /**
     * @OA\Delete(
     * path="/category/{category_uuid}",
     * summary="delete a single category",
     * description="delete a category",
     * tags={"Categories"},
     * @OA\Parameter(
     *          name="category_uuid",
     *          description="category id",
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
    public function destroy($category_uuid)
    {
        try {
            $this->categoryRepository->deleteCategory($category_uuid);

            return response(
                [
                    'message' => 'Category deleted successfully'
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
}
