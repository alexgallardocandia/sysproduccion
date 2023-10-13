<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('unidad_medidas', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->string('signo');
            $table->timestamps();
            $table->softDeletes();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('unidad_medidas');
    }
};
