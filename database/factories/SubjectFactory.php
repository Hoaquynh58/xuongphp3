<?php

namespace Database\Factories;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Subject::class;

    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['Toán học', 'Vật lý', 'Hóa học', 'Sinh học']),
            'credits' => $this->faker->randomElement([2, 3]),
        ];
    }
}
