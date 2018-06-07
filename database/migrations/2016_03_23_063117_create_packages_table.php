<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function(Blueprint $table){
            $table->increments('id');
            $table->string('name')->unique();
            $table->decimal('cost');
            $table->string('cost_per');
            $table->string('plan');
            $table->boolean('status');
            $table->boolean('featured');
            $table->tinyInteger('pricing_order');
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
        Schema::drop('packages');
    }
}
