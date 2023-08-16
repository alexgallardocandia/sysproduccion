<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('email');
            $table->date('fecha_nacimiento');
            //foraneas
            $table->foreignId('civil_id')->nullable()->constrained('estado_civiles');
            $table->foreignId('cargo_id')->nullable()->constrained('cargos');
            $table->foreignId('sucursal_id')->nullable()->constrained('sucursales');
            $table->foreignId('ciudad_id')->nullable()->constrained('ciudades');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('personas');
    }
};
