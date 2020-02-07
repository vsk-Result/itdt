<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('email_verified_at');
            $table->string('objectguid')->nullable()->after('id');
            $table->integer('employee_id')->nullable()->after('objectguid');
            $table->string('username')->unique()->after('name');
            $table->dateTime('last_activity')->nullable();
            $table->ipAddress('last_ip')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->dropColumn('objectguid');
            $table->dropColumn('username');
            $table->dropColumn('last_activity');
            $table->dropColumn('last_ip');
            $table->dropColumn('employee_id');
        });
    }
}
