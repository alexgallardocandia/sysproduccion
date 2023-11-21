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
        Schema::table('presupuesto_compras', function (Blueprint $table) {
            $table->integer('tipo_descuento')->nullable()->after('validez');
            $table->float('monto_descuento')->nullable()->after('validez');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('presupuesto_compras', function (Blueprint $table) {
            $table->dropColumn('tipo_descuento');
            $table->dropColumn('monto_descuento');
        });
    }
};
