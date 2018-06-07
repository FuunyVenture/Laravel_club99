<?php

use Illuminate\Database\Seeder;

class FeaturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('features')->delete();
        DB::table('features')->insert([
            ['id' => 1, 'name' => '2 x  shipments monthly', 'status' => 1, 'qty' => 2, 'type' => 'shipment', 'created_at' => \Carbon::now()],
            ['id' => 2, 'name' => '3 x  shipments monthly', 'status' => 1, 'qty' => 3, 'type' => 'shipment', 'created_at' => \Carbon::now()],
            ['id' => 3, 'name' => '4 x  shipments monthly', 'status' => 1, 'qty' => 4, 'type' => 'shipment', 'created_at' => \Carbon::now()],
            ['id' => 4, 'name' => 'Special discounts', 'status' => 1, 'qty' => 0, 'type' => '', 'created_at' => \Carbon::now()],
            ['id' => 5, 'name' => 'Acces to private lounge', 'status' => 1, 'qty' => 0, 'type' => '', 'created_at' => \Carbon::now()]
        ]);
    }
}
