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
        Schema::create('timbrados', function (Blueprint $table) {
            $table->id();
            $table->integer('numero');
            $table->date('fecha_emision');
            $table->date('fecha_vencimiento');
            $table->integer('tipo');
            $table->integer('estado');
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
        Schema::dropIfExists('timbrados');
    }
};
