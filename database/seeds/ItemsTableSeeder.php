<?php

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('items')->delete();

        \DB::table('items')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'Young Red T-Shirt',
                    'qty' => '2',
                    'cost' => 10.90,
                    'image' => '',
                    'description' => '',
                    'shipment_id' => 1,
                    'classification' => '',
                    'tax_id' => 1,
                    'retailer_id' => 1,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'Lady Jeans W26',
                    'qty' => '1',
                    'cost' => 120,
                    'image' => '',
                    'description' => '',
                    'shipment_id' => 1,
                    'classification' => '',
                    'tax_id' => 1,
                    'retailer_id' => 1,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ),
            2 =>
                array (
                    'id' => 3,
                    'name' => 'OldSchool Blue Jeans',
                    'qty' => '2',
                    'cost' => 50.90,
                    'image' => '',
                    'description' => '',
                    'shipment_id' => 2,
                    'classification' => '',
                    'tax_id' => 1,
                    'retailer_id' => 1,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ),
            3 =>
                array (
                    'id' => 4,
                    'name' => 'Boy T-Shirt Camouflage',
                    'qty' => '1',
                    'cost' => 44.90,
                    'image' => '',
                    'description' => '',
                    'shipment_id' => 1,
                    'classification' => '',
                    'tax_id' => 1,
                    'retailer_id' => 1,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ),
            4 =>
                array (
                    'id' => 5,
                    'name' => 'Balsa Wood',
                    'qty' => '5',
                    'cost' => 9.90,
                    'image' => '',
                    'description' => '',
                    'shipment_id' => 2,
                    'classification' => '',
                    'tax_id' => 1,
                    'retailer_id' => 2,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ),
            5 =>
                array (
                    'id' => 6,
                    'name' => 'Steel Wire 8mm',
                    'qty' => '1',
                    'cost' => 5,
                    'image' => '',
                    'description' => '',
                    'shipment_id' => 2,
                    'classification' => '',
                    'tax_id' => 1,
                    'retailer_id' => 2,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ),
            6 =>
                array (
                    'id' => 7,
                    'name' => 'Bison Epoxy Resin 5min',
                    'qty' => '1',
                    'cost' => 14.90,
                    'image' => '',
                    'description' => '',
                    'shipment_id' => 2,
                    'classification' => '',
                    'tax_id' => 1,
                    'retailer_id' => 2,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                )
        ));
    }
}
