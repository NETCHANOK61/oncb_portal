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
        Schema::create('users_portal', function (Blueprint $table) {
            //
            $table->id();
            $table->string('name', 255);
            $table->string('email', 255);
            $table->timestamp('email_verified_at');
            $table->string('password', 255);
            $table->string('remember_token', 100);
            $table->string('surname', 255);
            $table->string('card_id', 13);
            $table->string('div2', 4);
            $table->integer('groupid');
            $table->string('username', 255);
            $table->string('file', 255);
            $table->string('phone', 10);
            $table->string('agency', 10);
            $table->string('PROV_ID', 10);
            $table->string('AMP_ID', 10);
            $table->string('edu_area_id', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_portal');
    }
};
