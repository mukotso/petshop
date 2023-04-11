<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\BrandsRequest;
use App\Http\Resources\V1\BrandResource;
use App\Interfaces\V1\BrandInterface;
use Illuminate\Support\Facades\Log;

class BrandsController extends Controller
{

    protected BrandInterface $brandRepository;

    public function __construct(BrandInterface $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    /**
     * Display a listing of the resource.
     */

    /**
     * @OA\Get(
     * path="/brands",
     * summary="List all brands",
     * description=" view all brands",
     * tags={"Brands"},
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
            $brands = $this->brandRepository->getAllBrands();

            return response(
                [
                    'brands' => BrandResource::collection($brands),
                    'message' => 'Brands Retrieved successfully'
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
     * path="/brand/create",
     * summary="Create  a brand",
     * description=" create a brand",
     * tags={"Brands"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass required brand details",
     *    @OA\JsonContent(
     *       required={"title","slug"},
     *       @OA\Property(property="title", type="string", example="test brand"),
     *       @OA\Property(property="slug", type="string", example="test"),
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
    public function create(BrandsRequest $request)
    {
        try {
           $brand = $this->brandRepository->createBrand($request->all());

            return response(
                [
                    ['brand' => new BrandResource($brand)],
                    'message' => 'Brands created successfully'
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
     * path="/brand/{brand_uuid}",
     * summary="view a single brand",
     * description="view a brand",
     * tags={"Brands"},
     * @OA\Parameter(
     *          name="brand_uuid",
     *          description="brand id",
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
    public function show($brand_uuid)
    {
        try {
            $brand = $this->brandRepository->showBrandDetails($brand_uuid);

            return response(
                [
                    'brand' => new BrandResource($brand),
                    'message' => 'Brands details fetched  successfully'
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
     * @OA\Put(
     * path="/brand/{brand_uuid}",
     * summary="update a  brand",
     * description="update a brand",
     * tags={"Brands"},
     * @OA\Parameter(
     *          name="brand_uuid",
     *          description="brand id",
     *          required=true,
     *          in="path",
     *
     *      ),
     *
     *  @OA\RequestBody(
     *    required=true,
     *    description="Pass required brand details",
     *    @OA\JsonContent(
     *       required={"title","slug"},
     *       @OA\Property(property="title", type="string", example="edited brand"),
     *       @OA\Property(property="slug", type="string", example=" edited slug"),
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

    public function update(BrandsRequest $request, $brand_uuid)
    {
        try {
           $brand = $this->brandRepository->updateBrandDetails($request->all(), $brand_uuid);
            return response(
                [
                    'brand' => new BrandResource($brand),
                    'message' => 'Brands details updated successfully'
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
     * path="/brand/{brand_uuid}",
     * summary="delete a single category",
     * description="delete a category",
     * tags={"Brands"},
     * @OA\Parameter(
     *          name="brand_uuid",
     *          description="brand id",
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
    public function destroy($brand_uuid)
    {
        try {
            $this->brandRepository->deleteBrand($brand_uuid);

            return response(
                [
                    'message' => 'Brand deleted successfully'
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
