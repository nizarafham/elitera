<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_xxxxxx_add_status_to_user_courses_table.php

public function up()
{
    Schema::table('user_courses', function (Blueprint $table) {
        $table->string('status')->default('in-progress'); // Misalnya status default 'in-progress'
    });
}

public function down()
{
    Schema::table('user_courses', function (Blueprint $table) {
        $table->dropColumn('status');
    });
}

};
