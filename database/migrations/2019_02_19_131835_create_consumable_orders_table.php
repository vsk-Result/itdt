<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsumableOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumable_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable()->references('id')->on('users');
            $table->timestamps();
        });

        Schema::create('consumable_order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->references('id')->on('consumable_orders');
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
        Schema::dropIfExists('consumable_order_items');
        Schema::dropIfExists('consumable_orders');
    }
}
