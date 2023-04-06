<?php

namespace resources\database\seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatuses extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [

            [
                'title' => 'open',
            ],
            [
                'title' => 'pending_payment',
            ],
            [
                'title' => 'paid',
            ],
            [
                'title' => 'shipped',
            ],
            [
                'title' => 'cancelled',
            ],
        ];

        foreach ($statuses as $status) {
            //create  status if it does not exist in the database ( to avoid duplicates )
            if (!OrderStatus::where('title', $status->title)->exists()) {
                OrderStatus::create($status);
            }
        }
    }
}
