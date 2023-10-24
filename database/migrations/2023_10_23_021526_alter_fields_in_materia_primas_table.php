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
            $table->date('fecha_lote')->nullable()->change();
            $table->date('fecha_vencimiento')->nullable()->change();
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
            $table->date('fecha_lote');
            $table->date('fecha_vencimiento');
        });
    }
};
