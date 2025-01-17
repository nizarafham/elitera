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
        Schema::create('pending_courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mentor_id');
            $table->string('name');
            $table->text('description');
            $table->text('sub_description');
            $table->decimal('price', 10, 2);
            $table->string('image_url')->nullable();
            $table->integer('level');
            $table->boolean('is_free')->default(false);
            $table->string('material_title');
            $table->text('material_description');
            $table->string('material_file_path');
            $table->json('video_data'); // Menyimpan video URLs dan titles dalam bentuk JSON
            $table->timestamps();

            $table->foreign('mentor_id')->references('id')->on('users')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_courses');
    }
};
