<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'first_name' => 'Buckhill',
            'last_name'=>'Admin',
            'email' => 'admin@buckhill.co.uk',
            'password'=>Hash::make('admin'),
            'address'=>'Nairobi Kenya',
            'phone_number'=>'2547890876543',
            'is_admin'=>true,
        ]);
    }
}
