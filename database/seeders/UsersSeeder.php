<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //create default admin acccount

        $is_admin_account_already_created =User::where('email','admin@buckhill.co.uk')->exists();

       if(!$is_admin_account_already_created){
           User::create([
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
}
