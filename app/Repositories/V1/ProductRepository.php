<?php

namespace App\Repositories\V1;


use App\Interfaces\V1\ProductInterface;
use App\Models\Product;


class ProductRepository implements ProductInterface
{

    public function getAllProducts()
    {
        return Product::with('category')->orderBy('created_at', 'DESC')->paginate('8');
    }

    public function createProduct(array $product_details)
    {
        return Product::create($product_details);
    }

    public function showProductDetails($product_uuid)
    {
        return Product::with('category')->findorFail($product_uuid);
    }

    public function updateProductDetails(array $product_details, $product_uuid)
    {
        $product = Product::findorFail($product_uuid);
        return $product->update($product_details);
    }

    public function deleteProduct($product_uuid)
    {
        $product = Product::findorFail($product_uuid);
        return $product->delete();
    }

}
