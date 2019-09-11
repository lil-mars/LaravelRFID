@extends('layout')
@section('content')
    <h1>Lista de empleados segun edad (mayor a menor)</h1>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Edad</th>
            <th>Cantidad de empleados</th>
        </tr>
        </thead>
        <tbody>
        @foreach($filteredEmployees as $employee => $col)
            <tr>
                <td>{{$employee}}</td>
                <td>{{$col->count()}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
@section('script')

@endsection
