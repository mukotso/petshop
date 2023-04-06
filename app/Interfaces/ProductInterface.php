<?php

namespace App\Interfaces;


interface ProductInterface
{

    public function getAllProducts();

    public function createProduct($product_details);

    public function showProductDetails($product_uuid);

    public function updateProductDetails($product_uuid);

    public function deleteProduct($product_uuid);

}
