<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;
    protected $table = 'projects';
    protected $fillable = [
        'codigo_team',
        'codigo_proyecto',
        'nombre',
        'descripcion',
        'status',
        'prioridad',
        'fecha_inicio',
        'fecha_finalizacion',

    ];

    public function teams(){
        return $this ->belongsTo(Teams::class,'codigo_team','codigo');
    }

}