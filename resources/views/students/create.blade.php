
@extends('master')
@section('title')
    Thêm Sinh Viên
@endsection

@section('content')
    <h1>Thêm sinh viên mới</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('students.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Tên sinh viên:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="classroom_id">Lớp học:</label>
            <select name="classroom_id" id="classroom_id" class="form-control">
                @foreach($classrooms as $classroom)
                    <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="subjects">Môn học:</label>
            <select name="subject_ids[]" id="subjects" class="form-control">
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
