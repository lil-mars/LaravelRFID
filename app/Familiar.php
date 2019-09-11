<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Familiar extends Model
{
    protected $primaryKey = 'idFamiliar';
    protected $table = 'Familiar';
    protected $fillable = [
        'idFamiliar','nombre','segundoNombre','apellidoPaterno',
        'apellidoPaterno','idEmpleado','ci','tipoRelacion'
    ];

    public function empleado()
    {
        return $this->belongsTo('App\Empleado','idEmpleado','idEmpleado');
    }

}
