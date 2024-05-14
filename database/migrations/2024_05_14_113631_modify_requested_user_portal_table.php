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
        Schema::table('requested_user_portal', function (Blueprint $table) {
            //
            $table->string('approved', 255)->change();
            $table->string('name', 255)->change();
            $table->string('surname', 255)->change();
            $table->string('card_id', 13)->change();
            $table->string('phone', 10)->change();
            $table->string('email', 255)->change();
            $table->string('div2', 4)->nullable()->change();
            $table->integer('groupid')->nullable()->change();
            $table->string('agency', 10)->nullable()->change();
            $table->string('PROV_ID', 10)->nullable()->change();
            $table->string('AMP_ID', 10)->nullable()->change();
            $table->string('edu_area_id', 10)->nullable()->change();
            $table->string('file', 255)->nullable()->change();
            $table->string('dept_id', 255)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
