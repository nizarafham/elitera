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
    Schema::table('transactions', function (Blueprint $table) {
        $table->unsignedBigInteger('user_id')->after('id'); // Tambahkan kolom user_id
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Relasi dengan tabel users
    });
}

public function down()
{
    Schema::table('transactions', function (Blueprint $table) {
        $table->dropForeign(['user_id']); // Hapus foreign key
        $table->dropColumn('user_id');    // Hapus kolom user_id
    });
}


    /**
     * Reverse the migrations.
     */
    
};
