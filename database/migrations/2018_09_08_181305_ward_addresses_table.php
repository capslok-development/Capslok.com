<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WardAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('ward_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('house_number');
            $table->string('street_name');
            $table->string('street_type');
            $table->string('neighbourhood');
            $table->string('ward_name');
            $table->string('ward_id');
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
        Schema::dropIfExists('ward_addresses');
    }
}
