<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCourseIdToPendingCoursesTable extends Migration
{
    public function up()
    {
        Schema::table('pending_courses', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id')->nullable()->after('id'); // Tambahkan kolom course_id
        });
    }

    public function down()
    {
        Schema::table('pending_courses', function (Blueprint $table) {
            $table->dropColumn('course_id'); // Hapus kolom course_id jika di-rollback
        });
    }
}
