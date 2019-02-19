<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsumableStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumable_stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('object_id')->references('id')->on('objects');
            $table->integer('consumable_id')->references('id')->on('consumables');
            $table->integer('count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consumable_stocks');
    }
}
