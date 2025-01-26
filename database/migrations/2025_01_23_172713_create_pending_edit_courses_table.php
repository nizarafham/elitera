<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('pending_edit_courses', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('mentor_id');
        $table->unsignedBigInteger('course_id'); // ID course yang akan diupdate
        $table->string('name');
        $table->text('description');
        $table->text('sub_description');
        $table->decimal('price', 10, 2);
        $table->string('image_url')->nullable();
        $table->integer('level');
        $table->string('material_title');
        $table->text('material_description');
        $table->string('material_file_path')->nullable();
        $table->json('video_data')->nullable();
        $table->json('quiz_data')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_edit_courses');
    }
};
