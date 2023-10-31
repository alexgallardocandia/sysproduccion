<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::rename('depositos', 'almacenes');
    }

    public function down()
    {
        Schema::rename('almacenes', 'depositos');
    }
};
