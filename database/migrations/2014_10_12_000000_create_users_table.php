<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_name')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->default(bcrypt('testpass'));
            $table->integer('user_type')->default(1);       /* maps to user types table */
            $table->string('profile_pic_path')->nullable()->default('images/user-img-placeholder.jpg');
            $table->string('background_pic_path')->nullable()->default('images/bg-img-placeholder.png');
            $table->string('description')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
