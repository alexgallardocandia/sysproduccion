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
        Schema::create('orden_compras', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->foreignId('presupuesto_compras_id')->nullable()->constrained('presupuesto_compras');
            $table->foreignId('solicitante_id')->nullable()->constrained('empleados');
            $table->string('observacion')->nullable();
            $table->integer('descuento')->nullable();//descuento en porcentaje
            $table->foreignId('autorizador_id')->nullable()->constrained('empleados');
            $table->integer('estado')->nullable();
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
        Schema::dropIfExists('orden_compras');
    }
};
