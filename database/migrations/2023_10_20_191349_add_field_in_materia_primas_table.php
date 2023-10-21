<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::table('materia_primas', function (Blueprint $table) {
            // $table->dropColumn('precio');
            // $table->dropColumn('descripcion');
            $table->string('nombre')->after('id');
            $table->integer('presentacion')->after('nombre');
            $table->integer('type')->after('fecha_vencimiento');
        });
    }

    public function down()
    {
        Schema::table('materia_primas', function (Blueprint $table) {
            $table->dropColumn('nombre');
            $table->dropColumn('presentacion');
            $table->dropColumn('type');
            $table->string('precio');
            $table->integer('descripcion');
        });
    }
};
