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
        Schema::create('compras', function (Blueprint $table) {
            $table->id();

            $table->foreignId('proveedor_id')->nullable()->constrained('proveedores');            
            $table->foreignId('orden_compra_id')->nullable()->constrained('orden_compras');            
            $table->foreignId('timbrado_id')->nullable()->constrained('timbrados');
            $table->foreignId('tipo_impuesto_id')->nullable()->constrained('tipo_impuestos');
            $table->string('nro_factura')->nullable();
            $table->integer('condicion')->default(1);
            $table->string('razon_social')->nullable();
            $table->string('ruc')->nullable();
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->boolean('electronico')->default(0);
            $table->integer('descuento')->nullable();

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
        Schema::dropIfExists('compras');
    }
};
