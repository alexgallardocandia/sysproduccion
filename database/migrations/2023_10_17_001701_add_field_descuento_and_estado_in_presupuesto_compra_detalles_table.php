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
        Schema::table('presupuesto_compra_detalles', function (Blueprint $table) {
            $table->decimal('descuento')->nullable()->after('precio_unitario');
            $table->integer('estado')->default(1)->after('umedid_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('presupuesto_compra_detalles', function (Blueprint $table) {
            $table->dropColumn('descuento');
            $table->dropColumn('estado');
        });
    }
};
