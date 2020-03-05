<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Hip1AddEntities extends Migration
{
    public function up()
    {
        Schema::create('semesters', function (Blueprint $table) {
            $table->integer('semester')->unsigned()->primary();
        });

        Schema::create('periods', function (Blueprint $table) {
            $table->integer('id')->unsigned()->primary();
            $table->integer('semester')->unsigned();
        });

        Schema::create('groups', function (Blueprint $table) {
            $table->integer('id')->unsigned()->primary();
            $table->string('name', 45);
            $table->integer('period')->unsigned();
            $table->foreign('period')->references('id')->on('periods');
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->string('role', 12)->primary();
        });

        Schema::create('exams', function (Blueprint $table) {
            $table->integer('id')->unsigned()->primary();
            $table->string('name', 80);
            $table->string('description');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
        });

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

        Schema::create('subjects', function (Blueprint $table) {
            $table->integer('id')->unsigned()->primary();
            $table->string('name', 45);
            $table->string('description');
            $table->integer('credits')->unsigned();
            $table->integer('period')->unsigned();
            $table->integer('exam_id')->unsigned();
            $table->foreign('period')->references('id')->on('periods');
            $table->foreign('exam_id')->references('id')->on('exams');
        });

        Schema::create('user_exams', function (Blueprint $table) {
            $table->integer('id')->unsigned()->primary();
            $table->integer('user_id')->unsigned();
            $table->integer('exam_id')->unsigned();
            $table->decimal('grade', 3, 1)->nullable();
            $table->string('file')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('exam_id')->references('id')->on('exams');
        });
    }

    public function down()
    {
        Schema::dropIfExists('semesters');
        Schema::dropIfExists('periods');
        Schema::dropIfExists('groups');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('exams');
        Schema::dropIfExists('users');
        Schema::dropIfExists('subjects');
        Schema::dropIfExists('user_exams');
    }
}
