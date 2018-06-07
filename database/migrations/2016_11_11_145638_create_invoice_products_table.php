<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function ($table) {
            $table->increments('id');
            $table->unsignedInteger('fee_id')->nullable()->default(NULL);
            $table->unsignedInteger('shipment_id')->nullable()->default(NULL);
            $table->unsignedInteger('package_id')->nullable()->default(NULL);
            $table->unsignedInteger('coupon_id')->nullable()->default(NULL);
            $table->enum('type', ['fee', 'shipment', 'package', 'coupon'])->default('fee');
            $table->enum('taxable', ['taxable', 'none'])->default('none');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('invoice_products', function($table) {
            $table->increments('id');
            $table->unsignedInteger('invoice_id');
            $table->unsignedInteger('product_id');
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
        Schema::drop('products');
        Schema::drop('invoice_products');
    }
}
