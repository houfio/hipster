<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEntities extends Migration
{
    public function up()
    {
        Schema::table('subjects', function (Blueprint $table) {
            $table->dropForeign(['exam_id']);
            $table->dropColumn('exam_id');
        });

        Schema::table('exams', function (Blueprint $table) {
            $table->integer('subject_id')->unsigned();
            $table->decimal('grade', 3, 1)->nullable();
            $table->string('file', 255)->nullable();
            $table->boolean('is_assessment')->default(false);
            $table->dateTime('end_date')->nullable()->change();
            $table->foreign('subject_id')->references('id')->on('subjects');

        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['group_id']);
            $table->dropColumn('group_id');
        });

        Schema::dropIfExists('user_exams');
        Schema::dropIfExists('groups');
    }

    public function down()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('period_id')->unsigned();
            $table->string('name', 45);
            $table->foreign('period_id')->references('id')->on('periods');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->integer('group_id')->unsigned();
            $table->foreign('group_id')->references('id')->on('groups');
        });

        Schema::table('exams', function (Blueprint $table) {
            $table->dropColumn('grade');
            $table->dropColumn('is_assessment');
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
}
