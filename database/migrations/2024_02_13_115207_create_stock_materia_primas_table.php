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
        Schema::create('stock_materia_primas', function (Blueprint $table) {

            $table->unsignedBigInteger('almacen_id');
            $table->unsignedBigInteger('materia_prima_id');
            $table->foreign('almacen_id')->references('id')->on('almacenes')->onDelete('cascade');
            $table->foreign('materia_prima_id')->references('id')->on('materia_primas')->onDelete('cascade');
            $table->primary(['almacen_id', 'materia_prima_id']); 

            $table->decimal('cantidad_minima');
            $table->decimal('cantidad_maxima');
            $table->decimal('actual');

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
        Schema::dropIfExists('stock_materia_primas');
    }
};
