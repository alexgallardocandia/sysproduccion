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
            $table->foreignId('tipo_impuesto_id')->after('tipo')->nullable()->constrained('tipo_impuestos');
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
            $table->dropForeign(['tipo_impuesto_id']);
            $table->dropColumn('tipo_impuesto_id');
        });
    }
};
