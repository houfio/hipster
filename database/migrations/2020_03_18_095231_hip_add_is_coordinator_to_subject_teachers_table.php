<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HipAddIsCoordinatorToSubjectTeachersTable extends Migration
{
    public function up()
    {
        Schema::table('subject_teachers', function (Blueprint $table) {
            $table->boolean('is_coordinator')->default(0);
        });
    }

    public function down()
    {
        Schema::table('subject_teachers', function (Blueprint $table) {
            $table->dropColumn('is_coordinator');
        });
    }
}
