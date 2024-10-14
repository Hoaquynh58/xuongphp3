<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'teacher_name'
    ];

    // Quan hệ 1-N với Student
    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
