<?php

namespace App\Interfaces\V1;


interface ProductInterface
{

    public function getAllProducts();

    public function createProduct(array $product_details);

    public function showProductDetails($product_uuid);

    public function updateProductDetails(array $product_details,$product_uuid);

    public function deleteProduct($product_uuid);

}
