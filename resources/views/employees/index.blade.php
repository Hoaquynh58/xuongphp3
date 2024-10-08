@extends('master')

@section('title')
    Danh sách khách hàng
@endsection

@section('content')
    <h1>Danh sách khách hàng
        <a class="btn btn-info" href="{{ route('employees.create') }}">Create</a>
    </h1>

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

    <div class="table-responsive">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">first_name</th>
                    <th scope="col">last_name</th>
                    <th scope="col">email</th>
                    <th scope="col">phone </th>
                    <th scope="col">date_of_birth</th>
                    <th scope="col">hire_date</th>
                    <th scope="col">salary</th>
                    <th scope="col">department_id</th>
                    <th scope="col">manager_id</th>
                    <th scope="col">address</th>
                    <th scope="col">profile_picture</th>
                    <th scope="col">IS ACTIVE</th>
                    <th scope="col">CREATED AT</th>
                    <th scope="col">UPDATED AT</th>
                    <th scope="col">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $employee)
                    <tr class="">
                        <td scope="row">{{ $employee->id }}</td>
                        <td>{{ $employee->first_name }}</td>
                        <td>{{ $employee->last_name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->phone }}</td>
                        <td>{{ $employee->date_of_birth }}</td>
                        <td>{{ $employee->hire_date }}</td>
                        <td>{{ $employee->salary }}</td>
                        <td>{{ $employee->department_id }}</td>
                        <td>{{ $employee->manager_id }}</td>
                        <td>{{ $employee->address }}</td>
                        <td>
                            @if ($employee->profile_picture)
                                <img src="{{ Storage::url($employee->profile_picture) }}" width="100px">
                            @endif
                        </td>
                        <td>
                            @if ($employee->is_active)
                                <span class="badge bg-primary">YES</span>
                            @else
                                <span class="badge bg-danger">NO</span>
                            @endif
                        </td>
                        <td>{{ $employee->created_at }}</td>
                        <td>{{ $employee->updated_at }}</td>
                        <td>
                            <a class="btn btn-info" href="{{ route('employees.show', $employee) }}">Show</a>
                            <a class="btn btn-warning" href="{{ route('employees.edit', $employee) }}">Edit</a>

                            <form action="{{ route('employees.destroy', $employee) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <button type="submit" onclick="return confirm('Có chắc chắn xóa không?')"
                                    class="btn btn-danger">XM</button>
                            </form>

                            <form action="{{ route('employees.forceDestroy', $employee) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <button type="submit" onclick="return confirm('Có chắc chắn xóa cứng chứ?')"
                                    class="btn btn-dark">XC</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        {{ $data->links() }}
    </div>
@endsection
