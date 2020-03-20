<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeSizeOfColumnsLongerInTeachersTable extends Migration
{
    public function up()
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->dropColumn('abbreviation');
        });

        Schema::table('teachers', function (Blueprint $table) {
            $table->longText('first_name')->change();
            $table->longText('last_name')->change();
            $table->longText('abbreviation');
        });
    }

    public function down()
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->string('first_name', 30)->change();
            $table->string('last_name', 60)->change();
            $table->string('abbreviation', 255)->unique()->change();
        });
    }
}
