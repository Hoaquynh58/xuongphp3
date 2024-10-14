@extends('master')
@section('title')
    Quản lý
@endsection
@section('content')
    <h1>Danh sách môn học</h1>
    <a href="{{ route('subjects.create') }}" class="btn btn-primary">Thêm môn học mới</a>

    <table class="table">
        <thead>
            <tr>
                <th>Tên môn học</th>
                <th>Tín chỉ</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subjects as $subject)
                <tr>
                    <td>{{ $subject->name }}</td>
                    <td>{{ $subject->credits }}</td>
                    <td>
                        <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-warning">Sửa</a>
                        <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $subjects->links() }}
@endsection
