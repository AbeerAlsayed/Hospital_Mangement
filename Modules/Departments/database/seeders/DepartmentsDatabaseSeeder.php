<?php



namespace Modules\Departments\Database\Seeders;
use Illuminate\Database\Seeder;
use Modules\Departments\Database\Factories\DepartmentFactory; // تأكد من استخدام الـ namespace الكامل
use Modules\Departments\Models\Department;
use Modules\Departments\Database\Factories\RoomFactory;
use Modules\Departments\Models\Room;

class DepartmentsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::factory()->count(5)->create();

        Room::factory()->count(10)->create();
    }
}
