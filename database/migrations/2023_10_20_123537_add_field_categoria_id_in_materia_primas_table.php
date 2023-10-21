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
            $table->foreignId('categoria_id')->nullable()->constrained('categorias')->after('umedida_id');
            $table->foreignId('marca_id')->nullable()->constrained('marcas')->after('umedida_id');

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
            $table->dropForeign(['categoria_id']);
            $table->dropColumn('categoria_id');
            $table->dropForeign(['marca_id']);
            $table->dropColumn('marca_id');
        });
    }
};
