<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id(); // Crea una columna id auto-incremental
            $table->foreignId('departamentos_id')->constrained()->cascadeOnDelete();
            $table->string('nombre');
            $table->string('descrip'); // Puedes agregar esta línea si necesitas un apellido
            $table->string('correo')->unique(); // Agregar un campo para el correo electrónico y hacerlo único
            $table->timestamps(); // Crea las columnas created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams'); // Elimina la tabla si existe
    }
};