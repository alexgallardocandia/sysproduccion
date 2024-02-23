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
        Schema::table('compras', function (Blueprint $table) {
            $table->date('vencimiento_timbrado')->nullable()->after('orden_compra_id');
            $table->integer('timbrado')->after('orden_compra_id');
            $table->foreignId('solicitante_id')->nullable()->constrained('empleados')->after('orden_compra_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('compras', function (Blueprint $table) {
            $table->dropColumn('vencimiento_timbrado');
            $table->dropColumn('timbrado');
            $table->dropForeign(['solicitante_id']);
            $table->dropColumn('solicitante_id');
        });
    }
};
