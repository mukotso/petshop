<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
         
            [
                'title' => 'cats',
                'slug' => 'cats '
            ],
            [
                'title' => 'dogs',
                'slug' => 'dogs '
            ],
            [
                'title' => 'birds',
                'slug' => 'birds '
            ],
            [
                'title' => 'rabbits',
                'slug' => 'rabbits '
            ],
            [
                'title' => 'guinea pigs',
                'slug' => 'guinea_pigs '
            ],
            [
                'title' => 'fish',
                'slug' => 'fish '
            ],
        ];

        foreach ($categories as $category) {
            //create  category if it does not exist in the database
            if( !Category::where('title', $category->title)->exists()){
                Category::create($category);
            }
          
        }
    }
}
