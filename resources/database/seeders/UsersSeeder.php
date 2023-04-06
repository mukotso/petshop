<?php

namespace resources\database\seeders;

use Database\Seeders\Hash;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //create default admin acccount
        \App\Models\User::create([
            'first_name' => 'Buckhill',
            'last_name' => 'Admin',
            'email' => 'admin@buckhill.co.uk',
            'password' => Hash::make('admin'),
            'address' => 'Nairobi Kenya',
            'phone_number' => '2547890876543',
            'is_admin' => true,
        ]);
    }
}
