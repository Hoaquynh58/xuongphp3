
@extends('master')
@section('title')
    Thêm lớp
@endsection

@section('content')
    <h1>Thêm lớp mới</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('classrooms.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Tên lớp học:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="teacher_name">Giáo viên:</label>
            <input type="text" name="teacher_name" id="teacher_name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
