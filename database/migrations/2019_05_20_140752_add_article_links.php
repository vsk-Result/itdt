<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddArticleLinks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('knowledge_articles', function (Blueprint $table) {
            $table->string('link')->nullable();
            $table->boolean('link_access')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('knowledge_articles', function (Blueprint $table) {
            $table->dropColumn('link')->unique();
            $table->dropColumn('link_access');
        });
    }
}
