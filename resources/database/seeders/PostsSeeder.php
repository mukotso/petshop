<?php

namespace resources\database\seeders;

use Database\Seeders\Posts;
use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Create Five promotions
        Posts::factory()->count(5)->create();
    }
}
