<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishPurchaseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wish_purchase_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantity');
            $table->unsignedInteger('deposit_id');

            $table->unsignedInteger('material_id');
            $table->foreign('material_id')->references('id')->on('raw_materials');

            $table->unsignedInteger('wish_purchase_id');
            $table->foreign('wish_purchase_id')->references('id')->on('wish_purchases');
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
        Schema::dropIfExists('wish_purchase_details');
    }
}
