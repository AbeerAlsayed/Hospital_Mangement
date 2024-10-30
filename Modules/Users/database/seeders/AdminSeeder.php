<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('adminpassword'),
            'phone_number' => '999888777',
            'address' => '123 Admin Blvd, Admin City',
            'date_of_birth' => '1980-01-01',
            'gender' => 'male',
            'role' => 'admin',
        ]);
    }
}
