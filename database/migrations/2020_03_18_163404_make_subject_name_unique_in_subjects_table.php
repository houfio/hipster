<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeSubjectNameUniqueInSubjectsTable extends Migration
{
    public function up()
    {
        Schema::table('subjects', function (Blueprint $table) {
            $table->string('name', 45)->unique()->change();
        });
    }

    public function down()
    {
        Schema::table('subjects', function (Blueprint $table) {
            $table->string('name', 45)->change();
        });
    }
}
