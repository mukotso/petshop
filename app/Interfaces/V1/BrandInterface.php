<?php

namespace App\Interfaces\V1;


interface BrandInterface
{

    public function getAllBrands();

    public function createBrand(array $brand_details);

    public function showBrandDetails($brand_uuid);

    public function updateBrandDetails(array $new_brand_details, $brand_uuid);

    public function deleteBrand($brand_uuid);


}
