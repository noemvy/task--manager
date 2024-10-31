<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo_departamento',
        'codigo',
        'nombre',
        'cedula_empleado',
        'descripcion',
    ];

    //Relacion con el modelo empleados
    public function empleados(){
        return $this->HasMany(Empleados::class,'cedula');
    }
    public function departamento(){
        return $this->belongsTo(Departamentos::class,'codigo');
    }
}