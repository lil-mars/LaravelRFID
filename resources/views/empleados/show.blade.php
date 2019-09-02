@extends('layout')

@section('content')
    <div class="container">
        <div>
            <h1>
                {{$empleado->fullName() }}
                {{$empleado->cargo->nombre }}
            </h1>
            <h3>
                Horario
            </h3>
            <table>
                <tbody>
                @foreach($empleado->cargo->horarios as $horario)
                    <tr>
                        <td>
                            Total horas: {{$horario->horasDeTrabajo}}
                        </td>


                        <td>
                            {{$horario->horaSalida}}
                        </td>
                        <td>
                            {{$horario->turno}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @php
                $var = 0
            @endphp
            <div>
                <form method="post" action="{{ route('empleados.update', $empleado->idEmpleado)}}">
                    @method('PATCH')
                    @csrf
                    <label>Fecha Inicio</label>
                    <input name="fechaInicio" type="date">
                    <label>Fecha Final</label>
                    <input name="fechaFin" type="date">
                    <input value="Enviar" type="submit">
                </form>
            </div>
            <br>
            <table border="1" class="table">

                @foreach($empleado->getAsistencias() as $Asistencia => $collection)
                    <tr>
                        <td>{{$empleado->convertirFecha($Asistencia) }}</td>
                        <td> {{$collection->sum('horasDeTrabajo')}}</td>
                        @php
                            $var += $collection->sum('horasDeTrabajo')
                        @endphp
                    </tr>
                @endforeach
            </table>
            <div>
                Total Horas {{$var}}
            </div>
        </div>
    </div>
@endsection