<?php

namespace App\Http\Controllers;

use App\Empleado;
use Carbon\Carbon;
use Illuminate\Http\Request;
use MaddHatter\LaravelFullcalendar\Calendar;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = Empleado::all();
        return view('welcome')->with('empleados',$empleados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empleado = Empleado::find($id);
        return view('empleados.show')->with('empleado',$empleado);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fecha= $request->get('fechaInicio');
        $fechaFin = $request->get('fechaFin');
        $empleado = Empleado::find($id);
        $asistencias = $empleado->getAsistencias($fecha,$fechaFin);
        $horarios = $empleado->cargo->horarios;

        $events = [];
        $hours = 0;

        if($asistencias->count()) {
            foreach ($asistencias as $key => $value) {
                $carbon = Carbon::createFromDate($key);
                $decimal = number_format((float)$value->sum('horasDeTrabajo'),1,'.','');
                $string = $decimal;
                $color = 'blue';
                $decimal < $horarios->sum('horasDeTrabajo') ? $color = "red" : $color = 'blue';
                if ($carbon->dayOfWeek === 0){
                    $hours = 0;
                    continue;
                }
                else if ($carbon->dayOfWeek === 6){
                    $string = number_format((float)$hours,1,'.','');
                    $string < ($horarios->sum('horasDeTrabajo')*5) ? $color = "red" : $color = 'blue';
                }


                $events[] = Calendar::event(
                    $string,
                    true,
                    $key,
                    $key,
                    null,
                    // Add color and link on event
                    [
                        'textColor' => 'white',
                        'color' => $color,
                    ]

                );
                $hours += $value->sum('horasDeTrabajo');
            }
        }
        $calendar = \Calendar::addEvents($events)
        ->setOptions
        ([ //set fullcalendar options
            'monthNames'=> ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio',
            'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            'dayNames' => ['Domingo', 'Lunes', 'Martes', 'Miercoles',
            'Jueves', 'Viernes', 'Sabado'],
            'monthNamesShort' => ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
            'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            'dayNamesShort' => ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie','Total horas'],
            'defaultDate' => $fecha,
            'buttonText' => [
                'today' => 'Hoy',
                'day' => 'Dia',
                'month' => 'Mes',
                'week' => 'Semana',
            ],
        ]);

        return view('lista')
        ->with('asistencias',$asistencias)
        ->with('empleado',$empleado)
        ->with('calendar',$calendar);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
