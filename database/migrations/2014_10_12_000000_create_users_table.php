<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('avatar');;
            $table->string('stripe_id');
            $table->string('card_brand');
            $table->string('card_last_four');
            $table->timestamp('trial_ends_at')->nullable();
            $table->dateTime('birthday');
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('subscription_id');
            $table->boolean('archived')->default(0);
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
