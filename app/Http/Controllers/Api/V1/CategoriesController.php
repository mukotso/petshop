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
