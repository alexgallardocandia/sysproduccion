<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {        
    }

    public function down()
    {
        Schema::table('materia_primas', function (Blueprint $table) {
            $table->dropColumn('precio'); // Elimina la columna 'precio'
        });
    }
};
