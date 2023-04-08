<?php

namespace App\Repositories\V1;

use App\Http\Resources\V1\BrandResource;
use App\Interfaces\V1\BrandInterface;
use App\Models\Brand;


class BrandRepository implements BrandInterface
{
    public function getAllBrands()
    {
        return Brand::all()->orderBy('created_at', 'DESC')->paginate('8');
    }

    public function createBrand(array $brand_details)
    {
        return Brand::create($brand_details);
    }

    public function showBrandDetails($brand_uuid)
    {
        return Brand::findorFail($brand_uuid);
    }

    public function updateBrandDetails(array $new_brand_details, $brand_uuid)
    {
        $brand = Brand::findorFail($brand_uuid);
        return $brand->update($new_brand_details);
    }

    public function deleteBrand($brand_uuid)
    {
        $brand = Brand::findorFail($brand_uuid);
        return $brand->delete();
    }


}
