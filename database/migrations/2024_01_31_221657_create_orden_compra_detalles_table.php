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
        Schema::create('orden_compra_detalles', function (Blueprint $table) {
            $table->unsignedBigInteger('orden_compra_id');
            $table->unsignedBigInteger('materia_prima_id');
            $table->foreign('orden_compra_id')->references('id')->on('orden_compras')->onDelete('cascade');
            $table->foreign('materia_prima_id')->references('id')->on('materia_primas')->onDelete('cascade');
            $table->primary(['orden_compra_id', 'materia_prima_id']); // Establece la clave primaria en presupuesto_id y materia_prima_id

            $table->integer('cantidad');
            $table->integer('precio_unitario');
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
        Schema::dropIfExists('orden_compra_detalles');
    }
};
