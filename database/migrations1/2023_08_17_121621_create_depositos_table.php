<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()
    {
        Schema::create('depositos', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->foreignId('sucursal_id')->nullable()->constrained('sucursales');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('depositos');
    }
};
