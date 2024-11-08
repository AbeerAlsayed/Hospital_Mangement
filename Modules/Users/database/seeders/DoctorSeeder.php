<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Shifts\Models\ShiftSchedule;
use Modules\Users\Models\Doctor;
use Modules\Users\Models\User;


class DoctorSeeder extends Seeder
{
    public function run()
    {
        // إنشاء 10 أطباء مع شفتات العمل الخاصة بهم
        for ($i = 1; $i <= 10; $i++) {
            // إنشاء مستخدم جديد
            $user = User::create([
                'first_name' => "DoctorFirstName{$i}",
                'last_name' => "DoctorLastName{$i}",
                'email' => "doctor{$i}@hospital.com",
                'password' => Hash::make('password123'),
                'phone_number' => "123-456-78{$i}",
                'address' => "123 Street {$i}, City",
                'date_of_birth' => '1980-01-01',
                'gender' => $i % 2 == 0 ? 'male' : 'female',
                'role' => 'doctor',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // إنشاء الطبيب المرتبط بالمستخدم
            $doctor = Doctor::create([
                'user_id' => $user->id,
                'specialization' => 'Cardiology',
                'department_id' => 1, // تأكد من وجود قسم بهذا المعرف
                'salary' => 5000.00,
            ]);

            // إنشاء 3 شفتات (ورديات) لكل طبيب
            for ($j = 0; $j < 3; $j++) {
                $date = now()->addDays($j); // التاريخ للشفتات
                $startTime = Carbon::create($date->year, $date->month, $date->day, 8, 0, 0); // وقت البداية
                $endTime = Carbon::create($date->year, $date->month, $date->day, 16, 0, 0);  // وقت النهاية

                // تحديد فترة الشفت (صباحًا أو مساءً)
                $sessionPeriod = ($startTime->hour < 12) ? 'morning' : 'evening';

                ShiftSchedule::create([
                    'shiftable_id' => $doctor->id,
                    'shiftable_type' => Doctor::class,
                    'date' => $date->toDateString(), // إضافة التاريخ
                    'start_time' => $startTime->toTimeString(), // وقت البداية
                    'end_time' => $endTime->toTimeString(),  // وقت النهاية
                    'session_period' => $sessionPeriod, // تعيين فترة الشفت
                ]);
            }
        }
    }
}

