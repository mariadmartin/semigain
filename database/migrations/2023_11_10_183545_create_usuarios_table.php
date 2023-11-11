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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->string('apellidos', 50);
            $table->dateTime('fecha_nacimiento')->nullable();
            $table->string('sexo', 45)->nullable();
            $table->string('direccion_postal', 200)->nullable();
            $table->string('municipio', 50)->nullable();
            $table->string('provincia', 50)->nullable();
            $table->string('imagen_perfil', 100)->nullable();
            $table->string('email', 100);
            $table->string('numero_socio')->unique();
            $table->dateTime('fecha_alta');
            $table->dateTime('fecha_baja')->nullable();
            $table->string('es_admin', 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};