<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('qty');
            $table->double('cost');
            $table->string('image');
            $table->string('description');
            $table->unsignedInteger('shipment_id');
            $table->string('classification');
            $table->unsignedInteger('tax_id');
            $table->unsignedInteger('retailer_id');
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
        Schema::drop('items');
    }
}
