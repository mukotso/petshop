<?php

namespace App\Interfaces\V1;


interface CategoryInterface
{

    public function getAllCategories();

    public function createCategory(array $category_details);

    public function showCategoryDetails($category_uuid);

    public function updateCategoryDetails(array $updated_category_details ,$category_uuid);

    public function deleteCategory($category_uuid);


}
