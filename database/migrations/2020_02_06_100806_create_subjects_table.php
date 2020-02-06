<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjects');
    }
}
