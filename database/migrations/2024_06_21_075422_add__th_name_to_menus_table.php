<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddThNameToMenusTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            // Add the column
            $table->string('th_name')->nullable();
        });
        DB::statement('ALTER TABLE menus MODIFY COLUMN th_name VARCHAR(255) AFTER id');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            // Drop the column
            $table->dropColumn('th_name');
        });
    }
}
