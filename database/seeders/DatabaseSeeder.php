<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Departments\Database\Seeders\DepartmentsDatabaseSeeder;
use Modules\Users\Database\Seeders\AdminSeeder;
use Modules\Users\Database\Seeders\DoctorSeeder;
use Modules\Users\Database\Seeders\PatientSeeder;
use Modules\Users\Database\Seeders\UsersDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            DepartmentsDatabaseSeeder::class,
            DoctorSeeder::class,
            PatientSeeder::class,
        ]);
    }
}
