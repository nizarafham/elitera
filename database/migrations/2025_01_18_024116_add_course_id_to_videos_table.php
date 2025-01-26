<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCourseIdToVideosTable extends Migration
{
    public function up()
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('videos', function (Blueprint $table) {
            // Hapus kolom dan constraint jika rollback
            $table->dropForeign(['course_id']);
            $table->dropColumn('course_id');
        });
    }
}
