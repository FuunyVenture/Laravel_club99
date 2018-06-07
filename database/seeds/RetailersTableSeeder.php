<?php

use Illuminate\Database\Seeder;

class RetailersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('retailers')->delete();

        \DB::table('retailers')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'user_id' => 1,
                    'name' => 'H&M',
                    'website' => 'http://hm.com',
                    'status' => 'affiliate',
                    'logo' => 'uploads/logos/hm.jpg',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ),
            1 =>
                array (
                    'id' => 2,
                    'user_id' => 1,
                    'name' => 'Leroy Merlin',
                    'website' => 'www.leroymerlin.ro/',
                    'status' => 'affiliate',
                    'logo' => 'uploads/logos/leroymerlin.jpg',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ),
        ));
    }
}
