<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Empleados;
use App\Models\Teams;

class Departamentos extends Model
{
    use HasFactory;

    protected $table = 'departamentos';
    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
    ];


    public function empleados()
{
    return $this->hasMany(Empleados::class,'codigo_departamento','codigo');


}

public function teams(){
    return $this->hasMany(Teams::class,'codigo_departamento','codigo');
}


}
