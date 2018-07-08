<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('city_id')->unsigned()->nullable();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->tinyInteger('role_id')->default(\App\User::ROLE_USER);
            $table->tinyInteger('status_id')->default(\App\User::STATUS_WAITING_APPROVE);

            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('media', function (Blueprint $table) {
            $table->uuid('user_id')->nullable();
            $table->foreign('user_id')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        try {
            \DB::statement('ALTER TABLE `media` DROP FOREIGN KEY `media_user_id_foreign`');
        } catch (\Exception $exception) {
            Schema::table('media', function (Blueprint $table) {
                $table->dropForeign('media_user_id_foreign');
            });
        }
        Schema::table('media', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
        Schema::dropIfExists('users');
    }
}
