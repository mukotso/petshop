<?php

namespace resources\database\seeders;

use App\Models\Brand;
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
            //create  brand if it does not exist in the database ( to avoid duplicates )
            if (!Brand::where('title', $brand->title)->exists()) {
                Brand::create($brand);
            }
        }
    }
}
