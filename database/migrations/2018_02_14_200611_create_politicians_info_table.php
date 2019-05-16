<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoliticiansInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('politicians_info', function (Blueprint $table) {
            $table->integer('user_id');         /* maps to user table */
            $table->integer('profile_type_id'); /* maps to profile_type table */
            $table->integer('party_id')->nullable();        /* maps to politicians_party table */
            $table->integer('is_incumbent')->default(0);        /* maps to politicians_party table */
            $table->string('city')->default('Winnipeg');
            $table->string('province')->default('MB');
            $table->longText('aboutme')->nullable();
            $table->longText('aboutme_title')->nullable();
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
        Schema::dropIfExists('politicians_info');
    }
}
