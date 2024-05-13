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
        Schema::create('portal_system', function (Blueprint $table) {
            //
            $table->id();
            $table->string('fullname', 255);
            $table->string('en_name', 255);
            $table->enum('status', [1, 0])->default(1);
            $table->string('url', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portal_system');
    }
};
