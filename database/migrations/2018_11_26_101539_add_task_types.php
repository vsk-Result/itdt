<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTaskTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_types', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('color', 20);
            $table->string('icon', 20);
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->integer('type_id')->unsigned()->nullable();

            $table->foreign('type_id')->references('id')->on('task_types')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['type_id']);
            $table->dropColumn(['type_id']);
        });

        Schema::dropIfExists('task_types');
    }
}
