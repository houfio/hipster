<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOnDeleteCascadeToTagsTable extends Migration
{
    public function up()
    {
        Schema::table('exam_tags', function (Blueprint $table) {
            $table->dropForeign(['tag_id']);
            $table->dropForeign(['exam_id']);
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('exam_tags', function (Blueprint $table) {
            $table->dropForeign(['tag_id']);
            $table->dropForeign(['exam_id']);
            $table->foreign('tag_id')->references('id')->on('tags');
            $table->foreign('exam_id')->references('id')->on('exams');
        });
    }
}
