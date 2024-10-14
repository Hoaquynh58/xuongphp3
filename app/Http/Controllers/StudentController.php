<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lấy danh sách sinh viên cùng với lớp học, hộ chiếu và môn học
        $students = Student::with('classroom', 'passport', 'subjects')->paginate(10);
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classrooms = Classroom::all();
        $subjects = Subject::all();
        return view('students.create', compact('classrooms', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //thêm
        $student = Student::create($request->only(['name', 'email', 'classroom_id']));

        // gắn môn vào sinh viên
        $student->subjects()->attach($request->subject_ids);

        return redirect()->route('students.index')->with('success', 'Sinh viên đã được thêm thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Tìm sinh viên theo ID và lấy cả các quan hệ liên quan
        $student = Student::with('passport', 'classroom', 'subjects')->find($id);
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Lấy dữ liệu để sửa
        $student = Student::find($id);
        $classrooms = Classroom::all();
        $subjects = Subject::all();

        return view('students.edit', compact('student', 'classrooms', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Upd sinh viên
        $student = Student::find($id);
        $student->update($request->only(['name', 'email', 'classroom_id']));

        // Upd lại danh sách môn học
        $student->subjects()->sync($request->subject_ids);

        return redirect()->route('students.index')->with('success', 'Thông tin sinh viên đã được cập nhật.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::find($id);
        $student->delete();
        
        return redirect()->route('students.index')->with('success', 'Sinh viên đã được xóa.');
    }
}
