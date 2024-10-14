<?php

namespace Modules\Users\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Users\Models\User::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // كلمة مرور مشفرة
            'phone_number' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'date_of_birth' => $this->faker->date,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'role' => $this->faker->randomElement(['doctor', 'nurse', 'patient']),
        ];
    }
}

