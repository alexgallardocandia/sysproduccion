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
        Schema::create('compra_cuotas', function (Blueprint $table) {
            $table->unsignedBigInteger('compra_id');
            $table->integer('cuota_nro');
            $table->integer('monto_cuota');
            $table->integer('saldo');
            $table->date('fecha_vencimiento');
            $table->integer('estado');
            
    
            $table->foreign('compra_id')->references('id')->on('compras')->onDelete('cascade');
    
            $table->primary(['compra_id', 'cuota_nro']); // Establece la clave primaria en compra_id y cuota_nro

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
        Schema::dropIfExists('compra_cuotas');
    }
};
