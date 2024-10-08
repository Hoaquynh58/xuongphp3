@extends('master')
@section('title')
    <h1>Expense</h1>
@endsection
@section('content')
    <div class="table-responsive">
        <h1>Tổng chi phí theo tháng</h1>
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">Năm</th>
                    <th scope="col">Tháng</th>
                    <th scope="col">Tổng</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $expense)
                    <tr class="">
                        <td scope="row">{{ $expense->year}}</td>
                        <td>{{ $expense->month}}</td>
                        <td>{{ $expense->total_expenses }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection