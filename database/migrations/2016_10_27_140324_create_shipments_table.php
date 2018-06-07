<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->double('cost', 8, 2);
            $table->double('duty_cost');
            $table->double('duty_tax');
            $table->double('retailer_shipping_cost');
            $table->double('retailer_tax');
            $table->string('status');
            $table->integer('weight')->nullable();
            $table->integer('height')->nullable();
            $table->integer('length')->nullable();
            $table->timestamp('eta');
            $table->double('width')->nullable();
            $table->string('destination')->nullable();
            $table->string('tracking_number')->nullable();
            $table->string('order_number')->nullable();
            $table->timestamp('pickup_date')->nullable();
            $table->timestamp('collected_date')->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('fee_id')->nullable();
            $table->unsignedInteger('retailer_id');
            $table->string('uploaded_file');
            $table->softDeletes();
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
        Schema::drop('shipments');
    }
}
