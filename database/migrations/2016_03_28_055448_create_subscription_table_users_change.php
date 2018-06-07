<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionTableUsersChange extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('qty');
            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->unsignedInteger('package_id');
            $table->unsignedInteger('invoice_id');
            $table->unsignedInteger('store_payment_id');
            $table->enum('status', ['active', 'pending'])->default('active');
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
        Schema::drop('subscriptions');
    }
}