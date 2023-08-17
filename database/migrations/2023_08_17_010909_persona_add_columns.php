<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('personas', function (Blueprint $table) {            
            $table->integer('ci');
        });
    }

    public function down()
    {
        
    }
};
