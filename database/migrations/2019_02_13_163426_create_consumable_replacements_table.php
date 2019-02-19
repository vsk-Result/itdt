<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsumableReplacementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumable_replacements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->references('id')->on('users');
            $table->integer('object_id')->references('id')->on('objects');
            $table->integer('printer_id')->references('id')->on('printers');
            $table->integer('consumable_id')->references('id')->on('consumables');
            $table->string('comment')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('replaced_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consumable_replacements');
    }
}
