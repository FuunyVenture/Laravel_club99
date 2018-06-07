<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxes', function ($table) {
            $table->increments('id');
            $table->string('description');
            $table->string('code');
            $table->string('tarif_heading');
            $table->double('cost')->default(1);
            $table->double('duty');
            $table->double('excise');
            $table->double('stamp');
            $table->double('env_levy');
            $table->enum('enabled', [0, 1])->default(1);
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
        Schema::drop('taxes');
    }
}
