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
        Schema::table('timbrados', function (Blueprint $table) {
            $table->dropColumn('tipo');
            $table->foreignId('proveedor_id')->nullable()->after('fecha_vencimiento')->constrained('proveedores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('timbrados', function (Blueprint $table) {
            $table->integer('tipo');
            $table->dropForeign(['proveedor_id']);
            $table->dropColumn('proveedor_id');
        });
    }
};
