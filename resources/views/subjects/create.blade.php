
@extends('master')
@section('title')
    Thêm môn
@endsection

@section('content')
    <h1>Thêm môn mới</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('subjects.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Tên môn học:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="credits">Tín chỉ:</label>
            <input type="number" name="credits" id="credits" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
