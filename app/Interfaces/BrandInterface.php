<?php

namespace App\Interfaces;


interface BrandInventoryInterface
{

    public function getAllBrands();

    public function createBrand($brand_details);

    public function showBrandDetails($brand_uuid);

    public function UpdateBrandDetails($brand_uuid);

    public function deleteBrand($brand_uuid);
   


}