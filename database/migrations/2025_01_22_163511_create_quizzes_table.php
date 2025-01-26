<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('video_id');
            $table->text('question');
            $table->json('options'); // Array JSON untuk pilihan jawaban
            $table->string('correct_answer'); // Jawaban yang benar
            $table->timestamps();
            
            $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
