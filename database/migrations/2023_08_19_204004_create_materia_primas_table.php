<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('materia_primas', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->decimal('cantidad');
            $table->decimal('precio');
            $table->date('fecha_lote');
            $table->date('fecha_vencimiento');
            //foraneas
            $table->foreignId('umedida_id')->constrained('unidad_medidas');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('materia_primas');
    }
};
