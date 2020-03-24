<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Hip3AddTimestampsToGroupsTable extends Migration
{
    public function up()
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
}
