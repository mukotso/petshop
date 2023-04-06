<?php

namespace App\Interfaces;


interface BrandInterface
{

    public function getAllBrands();

    public function createBrand(array $brand_details);

    public function showBrandDetails($brand_uuid);

    public function UpdateBrandDetails($brand_uuid);

    public function deleteBrand($brand_uuid);


}
