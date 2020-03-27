<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCreditsTypeOfSubjectsTable extends Migration
{
    public function up()
    {
        Schema::table('subjects', function (Blueprint $table) {
            $table->decimal('credits', 4, 1)->change();
        });
    }

    public function down()
    {
        Schema::table('subjects', function (Blueprint $table) {
            $table->integer('credits')->change();
        });
    }
}
