<?php

use Illuminate\Database\Seeder;

class InvoiceProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('products')->delete();
        \DB::table('products')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'fee_id' => 1,
                    'shipment_id' => null,
                    'package_id' => null,
                    'coupon_id' => null,
                    'type' => 'fee',
                    'taxable' => 'none',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ),
            1 =>
                array (
                    'id' => 2,
                    'fee_id' => 2,
                    'shipment_id' => null,
                    'package_id' => null,
                    'coupon_id' => null,
                    'type' => 'fee',
                    'taxable' => 'none',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ),
            2 =>
                array (
                    'id' => 3,
                    'fee_id' => 3,
                    'shipment_id' => null,
                    'package_id' => null,
                    'coupon_id' => null,
                    'type' => 'fee',
                    'taxable' => 'none',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ),
            3 =>
                array (
                    'id' => 7,
                    'fee_id' => null,
                    'shipment_id' => null,
                    'package_id' => 1,
                    'coupon_id' => null,
                    'type' => 'package',
                    'taxable' => 'none',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ),
            4 =>
                array (
                    'id' => 8,
                    'fee_id' => null,
                    'shipment_id' => null,
                    'package_id' => 2,
                    'coupon_id' => null,
                    'type' => 'package',
                    'taxable' => 'none',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ),
            5 =>
                array (
                    'id' => 9,
                    'fee_id' => null,
                    'shipment_id' => null,
                    'package_id' => 3,
                    'coupon_id' => null,
                    'type' => 'package',
                    'taxable' => 'none',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                )
        ));
    }
}
