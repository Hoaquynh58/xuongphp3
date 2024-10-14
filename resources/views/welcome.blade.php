@extends('master')

@section('content')
    <h1>Welcome to my website</h1>
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
@endsection
