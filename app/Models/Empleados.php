<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Departamentos;
use App\Models\Teams;

class Empleados extends Model
{
    use HasFactory;
    // Permitir la asignación masiva para estos campos
    protected $fillable = [
        'codigo_departamento',
        'cedula',
        'nombre',
        'apellido',
        'correo',
    ];

    /**
     * Relación con el modelo Departamento
     */
    public function departamento()
    {
        return $this->belongsTo(Departamentos::class, 'departamentos_id');
    }
}