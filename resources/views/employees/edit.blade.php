@extends('master')

@section('title')
    Cập nhật khách hàng: {{ $employee->first_name }} {{ $employee->last_name }}
@endsection

@section('content')
    <h1>Cập nhật khách hàng: {{ $employee->first_name }} {{ $employee->last_name }}</h1>

    @if (session()->has('success') && !session()->get('success'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif

    @if (session()->has('success') && session()->get('success'))
        <div class="alert alert-info">
            Thao tác thành công
        </div>
    @endif
    {{-- hiển thị lỗi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <form method="POST" action="{{ route('employees.update', $employee) }}" enctype="multipart/form-data">
            @csrf

            @method('PUT')

            <div class="mb-3 row">
                <label for="first_name" class="col-4 col-form-label">first_name</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="first_name" id="first_name"
                        value="{{ $employee->first_name }}" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="last_name" class="col-4 col-form-label">last_name</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="last_name" id="last_name"
                        value="{{ $employee->last_name }}" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="col-4 col-form-label">Email</label>
                <div class="col-8">
                    <input type="email" class="form-control" name="email" id="email"
                        value="{{ $employee->email }}" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="phone" class="col-4 col-form-label">Phone</label>
                <div class="col-8">
                    <input type="tel" class="form-control" name="phone" id="phone"
                        value="{{ $employee->phone }}" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="date_of_birth" class="col-4 col-form-label">date_of_birth</label>
                <div class="col-8">
                    <input type="date" class="form-control" name="date_of_birth" id="date_of_birth"
                        value="{{ $employee->date_of_birth }}" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="hire_date" class="col-4 col-form-label">hire_date</label>
                <div class="col-8">
                    <input type="date" class="form-control" name="hire_date" id="hire_date"
                        value="{{ $employee->hire_date }}" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="salary" class="col-4 col-form-label">salary</label>
                <div class="col-8">
                    <input type="number" class="form-control" name="salary" id="salary"
                        value="{{ $employee->salary }}" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="is_active" class="col-4 col-form-label">Is_active</label>
                <div class="col-8">
                    <input type="checkbox" @checked($employee->is_active) class="form-checkbox" value="1"
                        name="is_active" id="is_active" />
                </div>
            </div>


            <div class="mb-3 row">
                <label for="department_id" class="col-4 col-form-label">department_id</label>
                <div class="col-8">
                    <input type="number" class="form-control" name="department_id" id="department_id"
                        value="{{ $employee->department_id }}" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="manager_id" class="col-4 col-form-label">manager_id</label>
                <div class="col-8">
                    <input type="number" class="form-control" name="manager_id" id="manager_id"
                        value="{{ $employee->manager_id }}" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="address" class="col-4 col-form-label">Address</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="address" id="address"
                        value="{{ $employee->address }}" />
                </div>
            </div>


            <div class="mb-3 row">
                <label for="profile_picture" class="col-4 col-form-label">profile_picture</label>
                <div class="col-8">
                    <input type="file" class="form-control" name="profile_picture" id="profile_picture" />
                    @if ($employee->profile_picture)
                        <img src="{{ Storage::url($employee->profile_picture) }}" width="100px">
                    @endif
                </div>
            </div>
            <div class="mb-3 row">
                <div class="offset-sm-4 col-sm-8">
                    <button type="submit" class="btn btn-primary">
                        Action
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
