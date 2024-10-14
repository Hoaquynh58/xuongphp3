
@extends('master')
@section('title')
    Sửa môn
@endsection

@section('content')
    <h1>Sửa môn</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('subjects.update', $subject->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Tên môn học:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $subject->name }}" required>
        </div>
        <div class="form-group">
            <label for="credits">Tín chỉ:</label>
            <input type="number" name="credits" id="credits" class="form-control" value="{{ $subject->credits }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Sửa</button>
    </form>
@endsection
