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
        Schema::table('pedido_compras', function (Blueprint $table) {
            $table->foreignId('empleado_id')->nullable()->after('prioridad')->constrained('empleados');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pedido_compras', function (Blueprint $table) {
            $table->dropForeign(['empleado_id']);
            $table->dropColumn('empleado_id');
        });
    }
};
