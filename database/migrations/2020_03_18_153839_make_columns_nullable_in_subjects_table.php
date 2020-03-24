<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HipMakeColumnsNullableInSubjectsTable extends Migration
{
    public function up()
    {
        Schema::table('subjects', function (Blueprint $table) {
            $table->integer('period_id')->unsigned()->nullable()->change();
            $table->integer('exam_id')->unsigned()->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('subjects', function (Blueprint $table) {
            $table->integer('period_id')->unsigned()->change();
            $table->integer('exam_id')->unsigned()->change();
        });
    }
}
