<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\BrandsRequest;
use App\Http\Resources\V1\BrandResource;
use App\Interfaces\V1\BrandInterface;
use App\Models\Brand;
use Illuminate\Http\Request;
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
    public function create(BrandsRequest $request)
    {
        try {
            $this->brandRepository->createBrand($request->all());

            return response(
                [
                    [],
                    'message' => 'Brands created successfully'
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
    public function show($brand_uuid)
    {
        try {
            $brand = $this->brandRepository->showBrandDetails($brand_uuid);

            return response(
                [
                    'brand' => new BrandResource($brand),
                    'message' => 'Brands created successfully'
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
    public function update(BrandsRequest $request, $brand_uuid)
    {
        try {
            $this->brandRepository->updateBrandDetails($request->all(), $brand_uuid);
            return response(
                [
                    [],
                    'message' => 'Brands details updated successfully'
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
    public function destroy($brand_uuid)
    {
        try {
            $this->brandRepository->deleteBrand($brand_uuid);

            return response(
                [
                    [],
                    'message' => 'Brands deleted successfully'
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
