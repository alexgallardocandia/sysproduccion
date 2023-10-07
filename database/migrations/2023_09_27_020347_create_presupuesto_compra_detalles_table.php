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
        Schema::create('presupuesto_compra_detalles', function (Blueprint $table) {
            $table->unsignedBigInteger('presupuesto_id');
            $table->unsignedBigInteger('materia_prima_id');
            $table->decimal('cantidad');
            $table->integer('precio_unitario');
            $table->foreignId('umedid_id')->nullable()->constrained('unidad_medidas');
            
            $table->timestamps();
            $table->softDeletes();
    
            $table->foreign('presupuesto_id')->references('id')->on('pedido_compras')->onDelete('cascade');
            $table->foreign('materia_prima_id')->references('id')->on('materia_primas')->onDelete('cascade');
    
            $table->primary(['presupuesto_id', 'materia_prima_id']); // Establece la clave primaria en presupuesto_id y materia_prima_id
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('presupuesto_compra_detalles');
    }
};
