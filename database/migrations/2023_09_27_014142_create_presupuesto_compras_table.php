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
        Schema::create('presupuesto_compras', function (Blueprint $table) {
            $table->id();            
            $table->integer('estado');
            $table->date('fecha');
            //foranea
            $table->foreignId('proveedor_id')->nullable()->constrained('proveedores');
            $table->foreignId('pedido_compra_id')->nullable()->constrained('pedido_compras');
            //created_at
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('presupuesto_compras');
    }
};