<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('image_id')->unsigned()->nullable();
            $table->string('code', 6);
            $table->string('name');
            $table->string('address')->nullable();
            $table->timestamps();
        });

        Schema::create('object_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('object_id')->unsigned();
            $table->string('filename');
            $table->string('description')->nullable();
            $table->integer('order')->unsigned();
            $table->timestamps();

            $table->foreign('object_id')->references('id')->on('objects')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('objects', function (Blueprint $table) {
            $table->foreign('image_id')->references('id')->on('object_images')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('object_persons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('object_id')->unsigned();
            $table->string('fullname');
            $table->string('appointment')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();

            $table->foreign('object_id')->references('id')->on('objects')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('object_infoparts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('object_id')->unsigned();
            $table->integer('icon_id')->unsigned()->nullable();
            $table->string('title');
            $table->text('body');
            $table->integer('order')->unsigned();
            $table->timestamps();

            $table->foreign('object_id')->references('id')->on('objects')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('object_infopart_attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('infopart_id')->unsigned();
            $table->string('filename');
            $table->timestamps();

            $table->foreign('infopart_id')->references('id')->on('object_infoparts')
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
        Schema::table('object_infopart_attachments', function (Blueprint $table) {
            $table->dropForeign(['infopart_id']);
        });
        Schema::dropIfExists('object_infopart_attachments');

        Schema::table('object_infoparts', function (Blueprint $table) {
            $table->dropForeign(['object_id']);
        });
        Schema::dropIfExists('object_infoparts');

        Schema::table('object_persons', function (Blueprint $table) {
            $table->dropForeign(['object_id']);
        });
        Schema::dropIfExists('object_persons');

        Schema::table('objects', function (Blueprint $table) {
            $table->dropForeign(['image_id']);
        });

        Schema::table('object_images', function (Blueprint $table) {
            $table->dropForeign(['object_id']);
        });
        Schema::dropIfExists('object_images');

        Schema::dropIfExists('objects');
    }
}
