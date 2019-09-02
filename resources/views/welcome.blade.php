@extends('layout')

@section('content')
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>CI</th>
                <th>Nombre Completo</th>
                <th>Edad</th>
                <th>Cargo</th>
            </tr>
            </thead>
            <tbody>
            @foreach($empleados as $empleado)
                <tr>
                    <td>{{$empleado->idEmpleado}}</td>
                    <td>{{$empleado->ci}}</td>
                    <td>
                        <form method="post" action="{{ route('empleados.update', $empleado->idEmpleado)}}">
                            @method('PATCH')
                            @csrf
                            <input type="submit" value="{{$empleado->fullName()}}">
                        </form>
                    </td>
                    <td>{{$empleado->age()}}</td>
                    <td>{{$empleado->cargo->nombre}}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection
