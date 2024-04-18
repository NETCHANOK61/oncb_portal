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

        Schema::table('menus', function (Blueprint $table) {
            //
            $table->string('url_menu')->nullable()->after('menu_icon');
            $table->enum('status_menu', [1, 0])->default(1)->after('menu_icon');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('menus', function (Blueprint $table) {
        //     //
        //     $table->dropColumn('url_menu');
        //     $table->dropColumn('status_menu');
        // });
    }
};
