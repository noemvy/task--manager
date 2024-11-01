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
        Schema::create('team_empleado', function (Blueprint $table) {
            $table->id();
            $table->string('codigo'); // Referencia a 'codigo' en teams
            $table->string('cedula'); // Referencia a 'cedula' en empleados
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_empleado');
    }
};