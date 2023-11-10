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
            $table->dropColumn('presentacion');
            $table->dropColumn('fecha_lote');
            $table->dropColumn('fecha_vencimiento');
            $table->dropColumn('type');
            $table->dropForeign(['umedida_id']);
            $table->dropColumn('umedida_id');
            $table->dropForeign(['categoria_id']);
            $table->dropColumn('categoria_id');
            $table->dropForeign(['marca_id']);
            $table->dropColumn('marca_id');

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
            $table->integer('presentacion');
            $table->date('fecha_lote');
            $table->date('fecha_vencimiento');
            $table->integer('type');
            $table->foreignId('umedida_id')->nullable()->constrained('unidad_medidas');
            $table->foreignId('categoria_id')->nullable()->constrained('categorias');
            $table->foreignId('marca_id')->nullable()->constrained('marcas');
        });
    }
};
