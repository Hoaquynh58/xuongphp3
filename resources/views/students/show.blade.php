
@extends('master')
@section('title')
    Hiển thị Sinh Viên
@endsection

@section('content')
    <h1>Thông tin chi tiết sinh viên</h1>

    <p><strong>Tên:</strong> {{ $student->name }}</p>
    <p><strong>Email:</strong> {{ $student->email }}</p>
    <p><strong>Lớp học:</strong> {{ $student->classroom->name }}</p>
    <p><strong>Hộ chiếu:</strong> {{ $student->passport->passport_number ?? 'Chưa có hộ chiếu' }}</p>
    
    <h3>Môn học đã đăng ký:</h3>
    <ul>
        @foreach($student->subjects as $subject)
            <li>{{ $subject->name }} ({{ $subject->credits }} tín chỉ)</li>
        @endforeach
    </ul>
    
    <a href="{{ route('students.index') }}" class="btn btn-secondary">Danh sách</a>
@endsection
