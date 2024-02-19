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
        Schema::create('ajuste_stock_detalles', function (Blueprint $table) {
            $table->unsignedBigInteger('ajuste_stock_id');
            $table->unsignedBigInteger('materia_prima_id');
            $table->foreign('ajuste_stock_id')->references('id')->on('ajuste_stocks')->onDelete('cascade');
            $table->foreign('materia_prima_id')->references('id')->on('materia_primas')->onDelete('cascade');
            $table->primary(['ajuste_stock_id', 'materia_prima_id']); // Establece la clave primaria en ajuste_stock_id y materia_prima_id

            $table->decimal('cant_stock');
            $table->decimal('cant_almacen');
            $table->string('motivo');
            
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
        Schema::dropIfExists('ajuste_stock_detalles');
    }
};
