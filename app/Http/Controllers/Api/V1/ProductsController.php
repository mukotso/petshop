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

    /**
     * @OA\Get(
     * path="/products",
     * summary="List all products",
     * description="view all products",
     * tags={"Products"},
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

    /**
     * @OA\Post(
     * path="/product/create",
     * summary="Create  product",
     * description=" create product",
     * tags={"Products"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass required product details",
     *    @OA\JsonContent(
     *       required={"title","price","category_id","description","metadata"},
     *       @OA\Property(property="title", type="string", example="dog chain"),
     *       @OA\Property(property="price", type="number", example="400"),
     *     @OA\Property(property="category_id", type="string", example=" "),
     *     @OA\Property(property="description", type="string", example="best for cats"),
     *    @OA\Property(property="metadata", type="object", example={"brand":"98e61f3e-ecb0-4286-83a2-fba964a7a6b6"}),
     *
     * ),
     * ),
     *
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

    /**
     * @OA\Get(
     * path="/product/{product_uuid}",
     * summary="view a single product",
     * description="view product",
     * tags={"Products"},
     * @OA\Parameter(
     *          name="product_uuid",
     *          description="product id",
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

    /**
     * @OA\Put(
     * path="/product/{product_uuid}",
     * summary="update product",
     * description="update product",
     * tags={"Products"},
     * @OA\Parameter(
     *          name="product_uuid",
     *          description="product id",
     *          required=true,
     *          in="path",
     *
     *      ),
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass required product details",
     *    @OA\JsonContent(
     *       required={"title","price","category_id","description","metadata"},
     *       @OA\Property(property="title", type="string", example="dog chain edited"),
     *       @OA\Property(property="price", type="number", example="200"),
     *     @OA\Property(property="category_id", type="string", example=""),
     *     @OA\Property(property="description", type="string", example="best for cats as well as dogs"),
     *    @OA\Property(property="metadata", type="object", example={"brand":"98e61f3e-ecdsdsb0-4286-83a2-fba964a7a6b6"}),
     *
     * ),
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

    /**
     * @OA\Delete(
     * path="/product/{product_uuid}",
     * summary="delete a product",
     * description="delete product",
     * tags={"Products"},
     * @OA\Parameter(
     *          name="product_uuid",
     *          description="product id",
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
