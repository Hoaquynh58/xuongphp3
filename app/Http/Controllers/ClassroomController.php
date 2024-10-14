<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classrooms = Classroom::paginate(10);
        return view('classrooms.index', compact('classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('classrooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Classroom::create($request->only(['name', 'teacher_name']));
        return redirect()->route('classrooms.index')->with('success', 'Lớp học đã được thêm.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $classroom = Classroom::find($id);
        return view('classrooms.show', compact('classroom'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $classroom = Classroom::find($id);
        return view('classrooms.edit', compact('classroom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $classroom = Classroom::find($id);
        $classroom->update($request->only(['name', 'teacher_name']));
        return redirect()->route('classrooms.index')->with('success', 'Thông tin lớp học đã được cập nhật.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $classroom = Classroom::find($id);
        $classroom->delete();
        return redirect()->route('classrooms.index')->with('success', 'Lớp học đã được xóa.');
    }
}
