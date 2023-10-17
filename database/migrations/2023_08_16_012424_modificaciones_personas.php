<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::table('personas', function (Blueprint $table) {
            $table->integer('ci');
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
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('ci');
            $table->dropColumn('nombres');
            $table->dropColumn('apellidos');
            $table->dropColumn('direccion');
            $table->dropColumn('telefono');
            $table->dropColumn('email');
            $table->dropColumn('fecha_nacimiento');
            //foraneas
            $table->dropForeign(['civil_id']);
            $table->dropColumn('civil_id');
            $table->dropForeign(['cargo_id']);
            $table->dropColumn('cargo_id');
            $table->dropForeign(['sucursal_id']);
            $table->dropColumn('sucursal_id');
            $table->dropForeign(['ciudad_id']);
            $table->dropColumn('ciudad_id');
        });
    }
};
