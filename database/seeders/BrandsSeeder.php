<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
         
            [
                'title' => 'feeders',
                'slug' => 'feeders '
            ],
            [
                'title' => 'food',
                'slug' => 'food '
            ],
            [
                'title' => 'grooming',
                'slug' => 'grooming'
            ],
            [
                'title' => 'health supplies',
                'slug' => 'health_supplies '
            ],
        ];

        foreach ($brands as $brand) {
            //create  category if it does not exist in the database
            if( !Brand::where('title', $category->title)->exists()){
                Brand::create($category);
            }
          
        }
    }
}
