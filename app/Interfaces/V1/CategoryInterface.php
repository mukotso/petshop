<?php

namespace App\Interfaces\V1;


interface CategoryInterface
{

    public function getAllCategories();

    public function createCategory(array $category_details);

    public function showCategoryDetails($category_uuid);

    public function updateCategoryDetails($category_uuid);

    public function deleteCategory($category_uuid);


}
