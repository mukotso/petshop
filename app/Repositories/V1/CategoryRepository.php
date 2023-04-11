<?php

namespace App\Repositories\V1;

use App\Interfaces\V1\CategoryInterface;
use App\Models\Category;


class CategoryRepository implements CategoryInterface
{

    public function getAllCategories()
    {
        return Category::orderBy('created_at', 'DESC')->paginate('8');
    }

    public function createCategory(array $category_details)
    {
        return Category::create($category_details);
    }

    public function showCategoryDetails($category_uuid)
    {
        return Category::findorFail($category_uuid);
    }

    public function updateCategoryDetails(array $updated_category_details , $category_uuid)
    {
        $category = Category::findorFail($category_uuid);
        $category->update($updated_category_details);
        return $category;
    }

    public function deleteCategory($category_uuid)
    {
        $category = Category::findorFail($category_uuid);
        return $category->delete();
    }

}
