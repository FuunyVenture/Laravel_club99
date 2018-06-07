<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function ($table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->enum('type', ['home', 'bill']);
            $table->string('address1');
            $table->string('address2');
            $table->string('city');
            $table->string('state');
            $table->string('zip_code');
            $table->string('country');
            $table->string('home_number');
            $table->string('mobile_number');
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
        Schema::drop('addresses');
    }
}
