@extends('master')
@section('title')
    Sửa lớp
@endsection

@section('content')
    <h1>Sửa lớp</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('classrooms.update', $classroom->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Tên lớp học:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $classroom->name }}" required>
        </div>
        <div class="form-group">
            <label for="teacher_name">Giáo viên:</label>
            <input type="text" name="teacher_name" id="teacher_name" class="form-control"
                value="{{ $classroom->teacher_name }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Sửa</button>
    </form>
@endsection
