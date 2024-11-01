<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Teams extends Model
{
    use HasFactory;

    protected $table = 'teams';
    protected $primaryKey = 'codigo';
    public $incrementing = false;
    protected $keyType = 'string';


    protected $fillable = [
        'codigo_departamento',
        'codigo',
        'nombre',
        'descripcion',
    ];

    //Relacion con el modelo empleados
    public function empleados(): BelongsToMany
    {
        return $this->belongsToMany(Empleados::class, 'team_empleado', 'codigo', 'cedula')
                    ->withTimestamps();
    }
    public function departamento(){
        return $this->belongsTo(Departamentos::class,'codigo_departamento','codigo');
    }
}
