<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Users\Models\Patient;
use Modules\Users\Models\User;

class PatientSeeder extends Seeder
{
    public function run()
    {
        // إنشاء 10 مرضى
        for ($i = 1; $i <= 10; $i++) {
            // إنشاء مستخدم جديد
            $user = User::create([
                'first_name' => "PatientFirstName{$i}",
                'last_name' => "PatientLastName{$i}",
                'email' => "patient{$i}@hospital.com",
                'password' => Hash::make('password123'),
                'phone_number' => "123-456-78{$i}",
                'address' => "123 Street {$i}, City",
                'date_of_birth' => '1990-01-01',
                'gender' => $i % 2 == 0 ? 'male' : 'female',
                'role' => 'patient',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // إنشاء المريض المرتبط بالمستخدم
            Patient::create([
                'user_id' => $user->id,
                'room_id' => 1, // تأكد من وجود غرفة بهذا المعرف
                'national_number' => "NATIONAL{$i}", // أو يمكنك استخدام قيم أخرى فريدة
            ]);
        }
    }
}
