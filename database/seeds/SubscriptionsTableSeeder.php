<?php

use Illuminate\Database\Seeder;

class SubscriptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('subscriptions')->delete();

        \DB::table('subscriptions')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => '',
                    'qty' => 1,
                    'package_id' => 3,
                    'ends_at' => \Carbon\Carbon::now()->addYear(),
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ),
            1 =>
                array (
                    'id' => 2,
                    'name' => '',
                    'qty' => 1,
                    'package_id' => 3,
                    'ends_at' => \Carbon\Carbon::now()->addYear(),
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ),
           
        ));
    }
}
