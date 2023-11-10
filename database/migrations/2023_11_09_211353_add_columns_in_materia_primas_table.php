<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('materia_primas', function (Blueprint $table) {
            $table->foreignId('unidad_medida_id')->nullable()->after('nombre')->constrained('unidad_medidas');
            $table->foreignId('marca_id')->nullable()->after('unidad_medida_id')->constrained('marcas');
            $table->foreignId('categoria_id')->nullable()->after('marca_id')->constrained('categorias');
            $table->integer('tipo')->nullable()->after('categoria_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('materia_primas', function (Blueprint $table) {
            $table->dropForeign(['unidad_medida_id']);
            $table->dropColumn('unidad_medida_id');
            $table->dropForeign(['marca_id']);
            $table->dropColumn('marca_id');
            $table->dropForeign(['categoria_id']);
            $table->dropColumn('categoria_id');
            $table->dropColumn('tipo');
        });
    }
};
