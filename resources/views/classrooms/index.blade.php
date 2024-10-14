@extends('master')
@section('title')
    Quản lý
@endsection
@section('content')
    <h1>Danh sách lớp học</h1>
    <a href="{{ route('classrooms.create') }}" class="btn btn-primary">Thêm lớp học mới</a>

    <table class="table">
        <thead>
            <tr>
                <th>Tên lớp học</th>
                <th>Giáo viên</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($classrooms as $classroom)
                <tr>
                    <td>{{ $classroom->name }}</td>
                    <td>{{ $classroom->teacher_name }}</td>
                    <td>
                        <a href="{{ route('classrooms.edit', $classroom->id) }}" class="btn btn-warning">Sửa</a>
                        <form action="{{ route('classrooms.destroy', $classroom->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $classrooms->links() }}
@endsection
