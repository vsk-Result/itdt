<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsumableMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumable_movements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->references('id')->on('users');
            $table->integer('user_confirm_id')->nullable()->references('id')->on('users');
            $table->integer('consumable_id')->references('id')->on('consumables');
            $table->integer('sender_id')->nullable()->references('id')->on('objects');
            $table->integer('recipient_id')->references('id')->on('objects');
            $table->integer('count');
            $table->string('status', 16);
            $table->string('comment')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('confirmed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consumable_movements');
    }
}
