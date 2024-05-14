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
            $table->string('approved', 255)->nullable();
            $table->string('name', 255)->nullable();
            $table->string('surname', 255)->nullable();
            $table->string('card_id', 13)->nullable();
            $table->string('phone', 10)->nullable();
            $table->string('email', 255);
            $table->string('div2', 4);
            $table->integer('groupid');
            $table->string('agency', 10);
            $table->string('PROV_ID', 10);
            $table->string('AMP_ID', 10);
            $table->string('edu_area_id', 10);
            $table->string('file', 255);
            $table->string('dept_id', 255);
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
