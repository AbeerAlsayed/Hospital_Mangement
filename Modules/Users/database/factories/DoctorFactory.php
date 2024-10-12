<?php

namespace Modules\Users\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Departments\Models\Department;
use Modules\Users\Models\User;

class DoctorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Users\Models\Doctor::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(), // إنشاء مستخدم مرتبط بالطبيب
            'specialization' => $this->faker->word,
            'department_id' => Department::factory(), // إنشاء قسم مرتبط بالطبيب
            'salary' => $this->faker->numberBetween(50000, 150000),
        ];
    }
}

