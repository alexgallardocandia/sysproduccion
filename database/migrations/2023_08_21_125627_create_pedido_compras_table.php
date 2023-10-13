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
        Schema::create('pedido_compras', function (Blueprint $table) {
            $table->id();
            $table->integer('prioridad');
            $table->integer('estado');
            $table->date('fecha_pedido');
            //foranea
            $table->foreignId('user_id')->nullable()->constrained('users');
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
        Schema::dropIfExists('pedido_compras');
    }
};
