<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOnDeleteCascadeToSubjectTeachersTable extends Migration
{
    public function up()
    {
        Schema::table('subject_teachers', function (Blueprint $table) {
            $table->dropForeign(['subject_id']);
            $table->dropForeign(['teacher_id']);
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('subject_teachers', function (Blueprint $table) {
            $table->dropForeign(['subject_id']);
            $table->dropForeign(['teacher_id']);
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->foreign('teacher_id')->references('id')->on('teachers');
        });
    }
}
