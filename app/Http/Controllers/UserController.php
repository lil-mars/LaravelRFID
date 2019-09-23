<?php

namespace App\Http\Controllers;

use App\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function check(Request $request){
        $user = $request->get('user');
        $password = $request->get('password');
        $employees = Empleado::all();
        $employee = $employees->where('usuario','=',$user)->first();
        if(Hash::check($password,$employee->contrasena))
        {
            dd("OK");
        }
        else
        {
            dd("Wrong");
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employee = new Empleado();
        $employee->ci = $request->get('ci');
        $employee->nombre = $request->get('firstName');
        $employee->segundoNombre = $request->get('secondName');
        $employee->apellidoPaterno = $request->get('fatherName');
        $employee->apellidoMaterno = $request->get('motherName');
        $employee->genero = $request->get('gender');
        $employee->usuario = $request->get('user');
        $employee->contrasena = Hash::make($request->get('password'));
        $employee->idCargo = $request->get('idCargo');
        $employee->idRol = 3;
        $employee->save();
        dd($employee);


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
