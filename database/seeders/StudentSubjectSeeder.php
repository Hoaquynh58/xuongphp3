<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = Student::all();
        $subjects = Subject::all();

        foreach ($students as $student) {
            // Mỗi sinh viên đăng ký ngẫu nhiên 2 đến 4 môn học
            $student->subjects()->attach(
                $subjects->random(rand(2, 4))->pluck('id')->toArray()
            );
        }
    }
}
