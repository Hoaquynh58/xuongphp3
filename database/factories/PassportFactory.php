<?php

namespace Database\Factories;

use App\Models\Passport;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Passport>
 */
class PassportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Passport::class;

    public function definition()
    {
        return [
            'student_id' => Student::factory(),  // Tạo sinh viên tự động
            'passport_number' => $this->faker->unique()->regexify('[A-Z]{1}[0-9]{7}'),
            'issued_date' => $this->faker->date(),
            'expiry_date' => $this->faker->date('Y-m-d', '+10 years'),
        ];
    }
}
