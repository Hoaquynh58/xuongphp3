<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'email', 
        'classroom_id'
    ];

    // Quan hệ 1-1 với Passport
    public function passport()
    {
        return $this->hasOne(Passport::class);
    }

    // Quan hệ 1-N với Classroom
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    // Quan hệ N-N với Subject
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'student_subject');
    }
}
