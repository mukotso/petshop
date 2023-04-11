<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\ProductsRequest;
use App\Http\Resources\V1\ProductResource;
use App\Interfaces\V1\ProductInterface;
use Illuminate\Support\Facades\Log;


class ProductsController extends Controller
{

    protected ProductInterface $productRepository;

    public function __construct(ProductInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $products = $this->productRepository->getAllProducts();

            return response(
                [
                    'products' => ProductResource::collection($products),
                    'message' => 'Products Retrieved successfully'
                ]
                , 200
            );
        } catch (\Exception $e) {
            //log exception
            Log::error($e);
            return response(
                [
                    [],
                    'message' => 'An error occurred ,Please try again'
                ]
                , 500
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ProductsRequest $request)
    {
        try {
           $product = $this->productRepository->createProduct($request->all());

            return response(
                [
                    'product' => new ProductResource($product),
                    'message' => 'product created successfully'
                ]
                , 200
            );
        } catch (\Exception $e) {
            //log exception
            Log::error($e);
            return response(
                [
                    [],
                    'message' => 'An error occurred ,Please try again'
                ]
                , 500
            );
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($product_uuid)
    {
        try {
            $product = $this->productRepository->showProductDetails($product_uuid);

            return response(
                [
                    'product' => new ProductResource($product),
                    'message' => 'product details fetched  successfully'
                ]
                , 200
            );
        } catch (\Exception $e) {
            //log exception
            Log::error($e);
            return response(
                [
                    [],
                    'message' => 'An error occurred ,Please try again'
                ]
                , 500
            );
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductsRequest $request,  $product_uuid)
    {
        try {
            $this->productRepository->updateProductDetails($request->all(), $product_uuid);
            return response(
                [
                    [],
                    'message' => 'product details updated successfully'
                ]
                , 200
            );
        } catch (\Exception $e) {
            //log exception
            Log::error($e);
            return response(
                [
                    [],
                    'message' => 'An error occurred ,Please try again'
                ]
                , 500
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($product_uuid)
    {
        try {
            $this->productRepository->deleteProduct($product_uuid);

            return response(
                [
                    [],
                    'message' => 'product deleted successfully'
                ]
                , 200
            );
        } catch (\Exception $e) {
            //log exception
            Log::error($e);
            return response(
                [
                    [],
                    'message' => 'An error occurred ,Please try again'
                ]
                , 500
            );
        }
    }
}
