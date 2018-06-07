<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClub99DetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('club99_details', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->double('total');
            $table->string('vat_number');
            $table->string('address');
            $table->string('administrator_name');
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
        Schema::drop('club99_details');
    }
}
