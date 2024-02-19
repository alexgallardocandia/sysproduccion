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
        Schema::create('ajuste_stocks', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->foreignId('almacen_id')->nullable()->constrained('almacenes');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->integer('estado');
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
        Schema::dropIfExists('ajuste_stocks');
    }
};
