<?php

namespace Modules\Departments\Database\Factories;

use Modules\Departments\Models\Department;
use Modules\Departments\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    protected $model = Room::class;
    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'room_number' => $this->faker->unique()->numberBetween(100, 500),
            'status' => $this->faker->randomElement(['available', 'occupied']),
            'type' => $this->faker->randomElement(['ICU', 'General', 'Private']),
            'department_id' => Department::factory(), // إنشاء قسم مرتبط بالغرفة
        ];
    }
}

