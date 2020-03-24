<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAllEntities extends Migration
{
    public function up()
    {
        Schema::create('periods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('period');
            $table->integer('semester');
        });

        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('period_id')->unsigned();
            $table->string('name', 45);
            $table->foreign('period_id')->references('id')->on('periods');
        });

        Schema::create('exams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 80);
            $table->string('description');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->unsigned();
            $table->integer('role');
            $table->string('first_name', 30);
            $table->string('last_name', 60);
            $table->string('email')->unique();
            $table->string('password');
            $table->foreign('group_id')->references('id')->on('groups');
            $table->timestamps();
        });

        Schema::create('subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('period_id')->unsigned();
            $table->integer('exam_id')->unsigned();
            $table->string('name', 45);
            $table->string('description');
            $table->integer('credits');
            $table->foreign('period_id')->references('id')->on('periods');
            $table->foreign('exam_id')->references('id')->on('exams');
            $table->timestamps();
        });

        Schema::create('user_exams', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('exam_id')->unsigned();
            $table->decimal('grade', 3, 1)->nullable();
            $table->string('file')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('exam_id')->references('id')->on('exams');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('periods');
        Schema::dropIfExists('groups');
        Schema::dropIfExists('exams');
        Schema::dropIfExists('users');
        Schema::dropIfExists('subjects');
        Schema::dropIfExists('user_exams');
    }
}
