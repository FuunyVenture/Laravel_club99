<?php

use Illuminate\Database\Seeder;

class FeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('fees')->delete();

        \DB::table('fees')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'Shipping cost',
                    'cost' => 20,
                    'taxable' => 'taxable',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'H&M Fee',
                    'cost' => 10.25,
                    'taxable' => 'none',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ),
            2 =>
                array (
                    'id' => 3,
                    'name' => 'Leroy Merlin Fee',
                    'cost' => 0.7,
                    'taxable' => 'taxable',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ),
        ));
    }
}
