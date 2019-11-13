<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditConsumableOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consumable_orders', function (Blueprint $table) {
            $table->integer('object_id')->nullable();
            $table->string('responsible')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consumable_orders', function (Blueprint $table) {
            $table->dropColumn('object_id');
            $table->dropColumn('responsible');
        });
    }
}
