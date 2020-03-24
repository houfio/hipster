<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeDueOnColumnNullableOnExamsTable extends Migration
{
    public function up()
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->dateTime('due_on')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->dateTime('due_on')->change();
        });
    }
}
