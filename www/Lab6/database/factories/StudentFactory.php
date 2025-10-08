<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'age' => fake()->numberBetween(16, 25),
            'gender' => fake()->randomElement(['male', 'female']),
            'class_name' => 'K' . fake()->numberBetween(1, 5)
        ];
    }
}
