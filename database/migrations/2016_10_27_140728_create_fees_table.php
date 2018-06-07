<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fees', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->double('cost');
            $table->enum('taxable', ['taxable', 'none'])->default('none');
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
        Schema::drop('fees');
    }
}
