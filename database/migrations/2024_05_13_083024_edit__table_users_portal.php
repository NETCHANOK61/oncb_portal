<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users_portal', function (Blueprint $table) {
            // Check if the column exists before trying to add it again
            if (!Schema::hasColumn('users_portal', 'email_verified_at')) {
                $table->timestamp('email_verified_at')->nullable();
            }

            // Modify other columns to be nullable
            $table->string('remember_token', 100)->nullable()->change();
            $table->string('card_id', 13)->nullable()->change();
            $table->string('div2', 4)->nullable()->change();
            $table->integer('groupid')->nullable()->change();
            $table->string('username', 255)->nullable()->change();
            $table->string('file', 255)->nullable()->change();
            $table->string('phone', 10)->nullable()->change();
            $table->string('agency', 10)->nullable()->change();
            $table->string('PROV_ID', 10)->nullable()->change();
            $table->string('AMP_ID', 10)->nullable()->change();
            $table->string('edu_area_id', 10)->nullable()->change();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
