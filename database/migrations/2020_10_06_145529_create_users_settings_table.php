<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_settings', function (Blueprint $table) {
            $table->foreignId('id')->primary();
            $table->smallInteger('points_conversion_unit')->unsigned()->default(20);
            $table->smallInteger('points_multiplication')->unsigned()->default(1);
            $table->boolean('profile_locked')->default(true);
            $table->boolean('email_notifications')->default(false);

            $table->foreign('id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_settings');
    }
}
