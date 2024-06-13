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
        Schema::create('users_request_sys', function (Blueprint $table) {
            $table->id();
            $table->string('users_id');
            $table->string('portal_system_id');
            $table->string('file')->nullable();
            $table->enum('approved', [1, 0, 2])->default(0);
            $table->string('approved_by')->default('system');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_request_sys');
    }
};
