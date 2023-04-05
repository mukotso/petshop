<?php

namespace App\Interfaces;


interface CategoryInventoryInterface
{

    public function getAllCategories();

    public function createCategory($category_details);

    public function showCategoryDetails($category_uuid);

    public function updateCategoryDetails($category_uuid);

    public function deleteCategory($category_uuid);
   


}