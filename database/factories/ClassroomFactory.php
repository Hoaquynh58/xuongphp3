<?php

namespace Database\Factories;

use App\Models\Classroom;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classroom>
 */
class ClassroomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Classroom::class;

    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['Lớp 10A1', 'Lớp 10A2', 'Lớp 11B1']),
            'teacher_name' => $this->faker->name,
        ];
    }
}
