@extends('layout')

@section('content')
    <div class="container">
        <div>
            @php
                $var = 0
            @endphp
            <br>
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
            <div class="panel-body">
                {!! $calendar->calendar() !!}
            </div>
            <div>
                Total Horas {{$var}}
            </div>
        </div>
    </div>
@endsection
@section('script')

    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src="{{asset('js/fullcalendar.min.js')}}"></script>


    {!! $calendar->script() !!}

@endsection
