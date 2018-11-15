<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('task_priorities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('class');
            $table->timestamps();
        });

        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->integer('priority_id')->unsigned();
            $table->string('name')->index();
            $table->string('description');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('status_id')->references('id')->on('task_statuses')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('priority_id')->references('id')->on('task_priorities')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('task_subtasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('task_id')->unsigned();
            $table->string('name')->index();
            $table->tinyInteger('checked')->default(0);
            $table->timestamps();

            $table->foreign('task_id')->references('id')->on('tasks')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('task_subtask_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('subtask_id')->unsigned();
            $table->string('text');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('subtask_id')->references('id')->on('task_subtasks')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('task_attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('task_id')->unsigned();
            $table->string('filename')->index();
            $table->timestamps();

            $table->foreign('task_id')->references('id')->on('tasks')
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
            $table->dropForeign(['user_id']);
            $table->dropForeign(['status_id']);
            $table->dropForeign(['priority_id']);
        });

        Schema::table('task_subtasks', function (Blueprint $table) {
            $table->dropForeign(['task_id']);
        });

        Schema::table('task_subtask_comments', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['subtask_id']);
        });

        Schema::table('task_attachments', function (Blueprint $table) {
            $table->dropForeign(['task_id']);
        });

        Schema::dropIfExists('task_attachments');
        Schema::dropIfExists('task_subtask_comments');
        Schema::dropIfExists('task_subtasks');
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('task_priorities');
        Schema::dropIfExists('task_statuses');
    }
}
