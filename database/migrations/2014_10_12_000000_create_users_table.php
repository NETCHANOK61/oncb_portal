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
        Schema::create('users', function (Blueprint $table) {
            //
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('username', 255)->nullable();
            $table->string('password')->nullable();
            $table->string('userid', 255)->nullable();
            $table->string('role', 255)->nullable();
            $table->rememberToken();
            $table->string('card_id', 13);
            $table->string('phone', 10);
            $table->string('div2', 4)->nullable();
            $table->integer('groupid')->nullable();
            $table->string('agency', 10)->nullable();
            $table->string('PROV_ID', 10)->nullable();
            $table->string('AMP_ID', 10)->nullable();
            $table->string('edu_area_id', 10)->nullable();
            $table->string('file', 255)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portal.users');
    }
};
