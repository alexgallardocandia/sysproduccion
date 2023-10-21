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
        Schema::table('pedido_compra_detalles', function (Blueprint $table) {
            $table->dropForeign(['umedid_id']);
            $table->dropColumn('umedid_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pedido_compra_detalles', function (Blueprint $table) {
            $table->foreignId('umedid_id')->nullable()->constrained('unidad_medidas')->after('descripcion');
        });
    }
};
