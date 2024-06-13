<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemAdministratorsTable extends Migration
{
    public function up()
    {
        Schema::create('portal_system_admin', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('system_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('system_id')->references('id')->on('portal_system')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('portal_system_admin');
    }
};

