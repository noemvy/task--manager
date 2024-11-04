<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;
    protected $table = 'tasks';
    protected $fillable = [
        'codigo_proyecto',
        'codigo',
        'nombre',
        'descripcion',
        'status',
        'prioridad',
        'fecha_inicio',
        'fecha_finalizacion',
    ];



    public function projects (){
        return $this ->belongsTo(Projects::class, 'codigo_proyecto','codigo');
    }
}