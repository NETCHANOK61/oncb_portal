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
            $table->unsignedBigInteger('system_id');
            $table->unsignedBigInteger('user_id');
            $table->string('role')->default('admin');
            $table->string('created_by')->default('system');
            $table->string('updated_by')->default('system');
            $table->timestamps();

            $table->unique(['system_id', 'user_id']);

            $table->foreign('system_id')->references('id')->on('portal_system')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('portal_system_admin');
    }
};

