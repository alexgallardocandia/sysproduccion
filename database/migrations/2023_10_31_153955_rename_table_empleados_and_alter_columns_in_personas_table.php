<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::rename('personas', 'empleados');
        Schema::table('empleados', function (Blueprint $table) {
            $table->dropForeign(['ciudad_id']);
            $table->dropColumn('ciudad_id');
        });
    }

    public function down()
    {
        Schema::rename('empleados', 'personas');

        Schema::table('personas', function (Blueprint $table) {
            $table->foreignId('ciudad_id')->nullable()->constrained('ciudades');
        });
    }
};
