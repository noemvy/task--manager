<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Departamentos;
use App\Models\Teams;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Empleados extends Model
{
    use HasFactory;
    protected $table = 'empleados';
    protected $primaryKey = 'cedula';
    public $incrementing = false;
    protected $keyType = 'string';
    // Permitir la asignación masiva para estos campos
    protected $fillable = [
        'codigo_departamento',
        'codigo_team',
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
        return $this->belongsTo(Departamentos::class,'codigo_departamento','codigo');
    }
       // Relación con el modelo Teams
       public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Teams::class, 'team_empleado', 'cedula', 'codigo')
                    ->withTimestamps();
    }

}
