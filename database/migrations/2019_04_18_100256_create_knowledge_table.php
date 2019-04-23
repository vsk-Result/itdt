<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKnowledgeTable extends Migration
{
    public function up()
    {
        Schema::create('knowledge_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('knowledge_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('icon')->nullable();
        });

        Schema::create('knowledge_articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->references('id')->on('users');
            $table->integer('category_id')->references('id')->on('knowledge_categories');
            $table->string('title');
            $table->text('content')->nullable();
            $table->string('icon')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('knowledge_article_tag', function (Blueprint $table) {
            $table->integer('tag_id')->references('id')->on('knowledge_tags');
            $table->integer('article_id')->references('id')->on('knowledge_articles');
            $table->primary(['tag_id', 'article_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('knowledge_tags');
        Schema::dropIfExists('knowledge_categories');
        Schema::dropIfExists('knowledge_articles');
        Schema::dropIfExists('knowledge_article_tag');
    }
}
