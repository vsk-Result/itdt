<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeyCollectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('key_collection', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('key')->unique();
            $table->string('login')->unique();
            $table->string('password')->unique();
            $table->string('product')->nullable();
            $table->date('expire_date');
            $table->string('renewal_id')->nullable();
            $table->timestamps();
        });

        Schema::create('key_collection_usage', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('key_id');
            $table->string('user_name')->nullable();
            $table->string('PC_name')->nullable();
            $table->string('IP')->nullable();
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
        Schema::dropIfExists('key_collection');
    }
}
