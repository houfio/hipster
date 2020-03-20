<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEmailColumnsInTables extends Migration
{
    public function up()
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->dropColumn('email');
        });

        Schema::table('teachers', function (Blueprint $table) {
            $table->longText('email');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('email');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->longText('email');
        });
    }

    public function down()
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->string('email')->unique();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('email')->unique();
        });
    }
}
