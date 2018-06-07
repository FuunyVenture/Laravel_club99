<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function ($table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->double('total');
            $table->unsignedInteger('club99_details_id')->nullable();
            $table->unsignedInteger('gift_card_id')->nullable();
            $table->unsignedInteger('coupon_id')->nullable();
            $table->unsignedInteger('store_payment_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->string('status')->nullable();
            $table->timestamp('due_date');
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
        Schema::drop('invoices');
    }
}
