<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrinterConsumableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printer_consumable', function (Blueprint $table) {
            $table->integer('printer_id')->references('id')->on('printer_models')->onDelete('CASCADE');
            $table->integer('consumable_id')->references('id')->on('consumables')->onDelete('CASCADE');
            $table->primary(['printer_id', 'consumable_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('printer_consumable');
    }
}
