<?php

use Illuminate\Database\Seeder;

class ShipmentDeliveryDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('shipment_delivery_details')->delete();

        \DB::table('shipment_delivery_details')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'shipment_id' => 1,
                    'firstname' => 'John',
                    'lastname' => 'Doe',
                    'address1' => 'str. N. Coculescu',
                    'address2' => 'str. N. Coculescu',
                    'city' => 'Craiova',
                    'state' => 'Dolj',
                    'country' => 'Romania',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ),
            1 =>
                array (
                    'id' => 2,
                    'shipment_id' => 2,
                    'firstname' => 'John',
                    'lastname' => 'Doe',
                    'address1' => 'str. N. Coculescu',
                    'address2' => 'str. N. Coculescu',
                    'city' => 'Craiova',
                    'state' => 'Dolj',
                    'country' => 'Romania',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ),
            2 =>
                array (
                    'id' => 3,
                    'shipment_id' => 3,
                    'firstname' => 'John',
                    'lastname' => 'Doe',
                    'address1' => 'str. N. Coculescu',
                    'address2' => 'str. N. Coculescu',
                    'city' => 'Craiova',
                    'state' => 'Dolj',
                    'country' => 'Romania',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ),
        ));
    }
}
