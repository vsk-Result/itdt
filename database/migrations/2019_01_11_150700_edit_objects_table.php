<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditObjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('objects', function (Blueprint $table) {
            $table->dropForeign(['image_id']);
        });

        Schema::table('objects', function (Blueprint $table) {
            $table->dropColumn('image_id');
            $table->string('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('objects', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->integer('image_id')->unsigned()->nullable();
        });

        Schema::table('objects', function (Blueprint $table) {
            $table->foreign('image_id')->references('id')->on('object_images')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }
}
