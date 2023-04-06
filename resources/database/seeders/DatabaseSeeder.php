<?php

namespace resources\database\seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PostsSeeder::class,
            PromotionsSeeder::class,
            UserSeeder::class,
            CategoriesSeeder::class,
            BrandsSeeder::class,
            OrderStatuses::class
        ]);
    }
}
