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
        Schema::create('pedido_compra_detalles', function (Blueprint $table) {
            $table->unsignedBigInteger('pedido_compra_id');
            $table->unsignedBigInteger('materia_prima_id');
            $table->decimal('cantidad');
            $table->foreignId('umedid_id')->nullable()->constrained('unidad_medidas');
            
            $table->timestamps();
            $table->softDeletes();
    
            $table->foreign('pedido_compra_id')->references('id')->on('pedido_compras')->onDelete('cascade');
            $table->foreign('materia_prima_id')->references('id')->on('materia_primas')->onDelete('cascade');
    
            $table->primary(['pedido_compra_id', 'materia_prima_id']); // Establece la clave primaria en usuario_id y rol_id
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedido_compra_detalles');
    }
};
