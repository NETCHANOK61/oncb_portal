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
        Schema::create('requested_user_portal', function (Blueprint $table) {
            //
            $table->id();
            $table->string('approved', 255);
            $table->string('name', 255);
            $table->string('surname', 255);
            $table->string('card_id', 13);
            $table->string('phone', 10);
            $table->string('email', 255);
            $table->string('div2', 4)->nullable();
            $table->integer('groupid')->nullable();
            $table->string('agency', 10)->nullable();
            $table->string('PROV_ID', 10)->nullable();
            $table->string('AMP_ID', 10)->nullable();
            $table->string('edu_area_id', 10)->nullable();
            $table->string('file', 255)->nullable();
            $table->string('dept_id', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requested_user_portal');
    }
};
