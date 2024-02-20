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
        Schema::create('nota_creditos', function (Blueprint $table) {
            $table->id();
            $table->integer('numero');
            $table->foreignId('proveedor_id')->nullable()->constrained('proveedores');
            $table->foreignId('compra_id')->nullable()->constrained('compras');
            $table->foreignId('motivo_id')->nullable()->constrained('nota_credito_motivos');
            $table->foreignId('timbrado_id')->nullable()->constrained('timbrados');
            $table->date('fecha');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nota_creditos');
    }
};
