<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTagsTable extends Migration
{
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('exam_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tag_id')->unsigned();
            $table->integer('exam_id')->unsigned();
            $table->foreign('tag_id')->references('id')->on('tags');
            $table->foreign('exam_id')->references('id')->on('exams');
            $table->timestamps();
        });

        Schema::table('exams', function (Blueprint $table) {
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
            $table->dateTime('due_on');
        });
    }

    public function down()
    {
        Schema::dropIfExists('exam_tags');
        Schema::dropIfExists('tags');

        Schema::table('exams', function (Blueprint $table) {
            $table->dropColumn('due_on');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
        });
    }
}
