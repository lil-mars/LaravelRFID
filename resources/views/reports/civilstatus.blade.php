@extends('layout')

@section('content')
    <h1>Empleados segun su estado Civil</h1>
    <table class="table table-bordered ">
        <thead>
        <tr>
            <th>Estado civil</th>
            <th>Empleados</th>
        </tr>
        </thead>
        <tbody>
        @foreach($civilStates as $name => $employees)
                <tr>
                    <th rowspan="{{$employees->count() + 1}}">{{$name}}</th>

                @foreach($employees as $employee)
                <tr>
                    <td>{{$employee->fullName()}} </td>
                </tr>
                @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@section('script')

@endsection
