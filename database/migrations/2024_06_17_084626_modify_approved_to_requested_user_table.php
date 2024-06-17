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
        Schema::create('requested_user', function (Blueprint $table) {
            $table->id();
            $table->enum('approved', [1, 0, 2])->default(0);
            $table->string('name', 255);
            $table->string('surname', 255);
            $table->string('card_id', 13);
            $table->string('phone', 10);
            $table->string('email', 255)->nullable();
            $table->string('userid', 255)->nullable();
            $table->string('agency', 10)->nullable();
            $table->string('PROV_ID', 10)->nullable();
            $table->string('AMP_ID', 10)->nullable();
            $table->string('edu_area_id', 10)->nullable();
            $table->string('school', 255)->nullable();
            $table->string('dept_id', 10)->nullable();
            $table->string('file', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requested_user');
    }
};