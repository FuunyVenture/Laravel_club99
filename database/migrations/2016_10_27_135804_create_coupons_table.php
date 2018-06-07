<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function ($table) {
            $table->increments('id');
            $table->string('code');
            $table->double('value');
            $table->enum('type', ['percentage', 'dollars'])->default('percentage');
            $table->string('status');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->unsignedInteger('user_id');
            $table->enum('archived', [0, 1])->default(0);
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
        Schema::drop('coupons');
    }
}
