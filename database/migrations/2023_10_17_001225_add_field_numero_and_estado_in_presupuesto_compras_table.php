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
            $table->integer('numero')->nullable()->after('id');
            $table->date('validez')->after('fecha');
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
            $table->dropColumn('numero');
            $table->dropColumn('validez');
        });
    }
};
