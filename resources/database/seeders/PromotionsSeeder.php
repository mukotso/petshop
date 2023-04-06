<?php

namespace resources\database\seeders;

use Database\Seeders\Promotions;
use Illuminate\Database\Seeder;

class PromotionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Create Five promotions
        Promotions::factory()->count(5)->create();
    }
}
