
@extends('master')
@section('title')
    Sửa Sinh Viên
@endsection

@section('content')
    <h1>Sửa sinh viên</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Tên sinh viên:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $student->name }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $student->email }}" required>
        </div>
        <div class="form-group">
            <label for="classroom_id">Lớp học:</label>
            <select name="classroom_id" id="classroom_id" class="form-control">
                @foreach($classrooms as $classroom)
                    <option value="{{ $classroom->id }}" {{ $classroom->id == $student->classroom_id ? 'selected' : '' }}>
                        {{ $classroom->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="subjects">Môn học:</label>
            <select name="subject_ids[]" id="subjects" class="form-control">
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ in_array($subject->id, $student->subjects->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $subject->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Sửa</button>
    </form>
@endsection
