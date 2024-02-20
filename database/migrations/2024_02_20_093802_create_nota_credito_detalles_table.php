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
        Schema::create('nota_credito_detalles', function (Blueprint $table) {
            $table->unsignedBigInteger('nota_credito_id');
            $table->unsignedBigInteger('materia_prima_id');
            $table->foreign('nota_credito_id')->references('id')->on('nota_creditos')->onDelete('cascade');
            $table->foreign('materia_prima_id')->references('id')->on('materia_primas')->onDelete('cascade');
            $table->primary(['nota_credito_id', 'materia_prima_id']);

            $table->decimal('cantidad');
            $table->decimal('precio_unitario');
            $table->decimal('exenta');
            $table->decimal('iva_5');
            $table->decimal('iva_10');

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
        Schema::dropIfExists('nota_credito_detalles');
    }
};
