<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Modules\Users\Models\User;


class AdminSeeder extends Seeder
{

    public function run(): void
    {
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'), // يمكنك تغيير كلمة المرور
            'phone_number' => '1234567890',
            'address' => '123 Admin Street',
            'date_of_birth' => '1990-01-01',
            'gender' => 'male',
            'role' => 'admin', // تحديد الدور كـ admin
        ]);
    }

}
