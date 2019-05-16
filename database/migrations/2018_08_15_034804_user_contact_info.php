<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserContactInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_contact_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('phone_number')->default('');
            $table->string('primary_email')->nullable();
            $table->string('secondary_email')->nullable()->default('');
            $table->string('address')->nullable()->default('');
            $table->integer('city_id')->default(1);
            $table->tinyInteger('is_politician')->default(0);
            $table->string('fb_link')->nullable()->default('');
            $table->string('twitter_link')->nullable()->default('');
            $table->string('other_link')->nullable()->default('');
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
        Schema::dropIfExists('user_contact_info');
    }
}
