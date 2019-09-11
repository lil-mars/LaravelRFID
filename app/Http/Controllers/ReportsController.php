<?php

namespace App\Http\Controllers;

use App\Cargo;
use App\Empleado;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function jobs()
    {
        $number = 10;
        $filteredCargos = [];
        $cargos = Cargo::all();
        foreach ($cargos as $cargo) {
            if ($cargo->empleados->count() >= $number)
                $filteredCargos[] = $cargo;
        }
        $filteredCargos;
        return view('reports.jobs')->with('cargos', $filteredCargos);
    }

    public function selectJobs(Request $request)
    {
        $number = $request->get('number');
        $filteredCargos = [];
        $cargos = Cargo::all();
        foreach ($cargos as $cargo) {
            if ($cargo->empleados->count() >= $number)
                $filteredCargos[] = $cargo;
        }
        $filteredCargos;
        return view('reports.jobs')->with('cargos', $filteredCargos);
    }

    public function civilStatus()
    {
        $employees = Empleado::all();
        $civilStates = $employees->groupBy('estadoCivil');

        return view('reports.civilstatus')->with('civilStates', $civilStates);
    }

    public function child()
    {
        $employees = Empleado::all();
        $filteredEmployees = [];
        foreach ($employees as $employee) {
            if ($employee->familiares->where('tipoRelacion', 'Hijo')->count() > 0)
                $filteredEmployees[] = $employee;
        }
        return view('reports.familiar')->with('filteredEmployees', $filteredEmployees);
    }

    public function selectChild(Request $request)
    {
        $number = $request->get('number');
        $employees = Empleado::all();
        $filteredEmployees = [];
        foreach ($employees as $employee) {
            if ($employee->familiares->where('tipoRelacion', 'Hijo')->count() > $number)
                $filteredEmployees[] = $employee;
        }
        return view('reports.familiar')->with('filteredEmployees', $filteredEmployees);
    }

    public function age()
    {
        $employees = Empleado::get();

        foreach ($employees as $employee) {
            $birthDate = Carbon::parse($employee->fechaNacimiento);
            $employee->edad = $birthDate->diffInYears(Carbon::now());
        }
        $emp = $employees->sortByDesc('edad')->groupBy('edad');


        return view('reports.age')->with('filteredEmployees', $emp);
    }
    public function gender()
    {
        $nowYear = Carbon::now()->year;
        $employees = Empleado::all();
        $list = [];
        $counts = [];
        $number=0;
        $years = collect(
            [
            $nowYear => ['F'=>0,'M'=>0],
            $nowYear-1 => ['F'=>0,'M'=>0],
            $nowYear-2 => ['F' =>0,'M'=>0]
            ]
        );
        $help = $years->get($nowYear);
        $years[$nowYear]['F'] = [] ;
        dd($years[$nowYear]['F']);
        foreach ($employees as $employee) {
            $flag1 = false;
            $flag2 = false;
            $flag3 = false;
            foreach ($employee->asistencias as $asistencia){
                $year = Carbon::parse($asistencia->fecha)->year;

                if ($nowYear === $year && !$flag1){
                    if ($employee->gender == 'M'){
                        dd($years);
                    }
                    else
                        $years->get($nowYear)["F"]++;
                    $flag1 = true;

                }
                elseif ( $nowYear-1 === $year && !$flag2){

                }
                elseif ($nowYear-2 === $year && !$flag3){
                    $list[] =  $nowYear-2;
                }
                if ($flag1 && $flag2 && $flag3){
                    continue;
                }
                dd($years);

            }
        }


        foreach ($employees as $employee) {
            $birthDate = Carbon::parse($employee->fechaNacimiento);
            $employee->edad = $birthDate->diffInYears(Carbon::now());
        }
        $emp = $employees->sortByDesc('edad')->groupBy('edad');


        return view('reports.age')->with('filteredEmployees', $emp);
    }
}
