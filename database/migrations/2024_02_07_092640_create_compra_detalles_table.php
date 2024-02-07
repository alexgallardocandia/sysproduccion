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
        Schema::create('compra_detalles', function (Blueprint $table) {
            $table->unsignedBigInteger('compra_id');
            $table->unsignedBigInteger('materia_prima_id');
            $table->foreign('compra_id')->references('id')->on('compras')->onDelete('cascade');
            $table->foreign('materia_prima_id')->references('id')->on('materia_primas')->onDelete('cascade');
            $table->primary(['compra_id', 'materia_prima_id']); // Establece la clave primaria en compra_id y materia_prima_id

            $table->integer('cantidad');
            $table->integer('precio_unitario');
            $table->integer('exenta');
            $table->integer('iva5');
            $table->integer('iva10');
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
        Schema::dropIfExists('compra_detalles');
    }
};
