<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id')->unsigned()->primary();
            $table->string('first_name', 30);
            $table->string('last_name', 60);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role', 12);
            $table->integer('group_id')->unsigned();
            $table->foreign('role')->references('role')->on('roles');
            $table->foreign('group_id')->references('id')->on('groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
