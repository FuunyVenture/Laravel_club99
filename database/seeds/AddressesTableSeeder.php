<?php

use Illuminate\Database\Seeder;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('addresses')->delete();

        \DB::table('addresses')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'user_id' => 2,
                    'type' => 'home',
                    'address1' => 'Str. N. Coculescu, nr. 8, bl. 70B, sc. 1, ap. 10',
                    'address2' => 'Str. Sgt. C-tin. Popescu, bl. 48, sc. 1, ap. 7',
                    'city' => 'Craiova',
                    'state' => 'Dolj',
                    'zip_code' => '200695',
                    'home_number' => '0351412243',
                    'mobile_number' => '0762568966',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ),
            1 =>
                array (
                    'id' => 2,
                    'user_id' => 2,
                    'type' => 'bill',
                    'address1' => 'Str. Elena Farago, bl. 121I, sc. 2, ap. 6',
                    'address2' => 'str. Plopilor, nr. 3',
                    'city' => 'Craiova',
                    'state' => 'Dolj',
                    'zip_code' => '200960',
                    'home_number' => '0341402243',
                    'mobile_number' => '0786437543',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ),
            2 =>
                array (
                    'id' => 3,
                    'user_id' => 3,
                    'type' => 'home',
                    'address1' => 'Str. Sgt. C-tin. Popescu, bl. 48, sc. 1, ap. 7',
                    'address2' => 'Str. Valea Morii, nr. 8',
                    'city' => 'Craiova',
                    'state' => 'Dolj',
                    'zip_code' => '300938',
                    'home_number' => '0251123948',
                    'mobile_number' => '0722502983',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ),
            3 =>
                array (
                    'id' => 4,
                    'user_id' => 3,
                    'type' => 'bill',
                    'address1' => 'Str. Crizantemelor, nr. 4, bl. 61C1, sc. 2, ap. 2',
                    'address2' => 'Aleea Piersicilor, nr. 24, bl. i42, sc. 1, ap. 17',
                    'city' => 'Craiova',
                    'state' => 'Dolj',
                    'zip_code' => '403802',
                    'home_number' => '0251090039',
                    'mobile_number' => '0770981022',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ),
        ));
    }
}
