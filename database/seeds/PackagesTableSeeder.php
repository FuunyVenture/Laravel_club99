<?php

use Illuminate\Database\Seeder;

class PackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('packages')->delete();
        DB::table('packages')->insert([
            ['id' => 1, 'name' => 'LiteShopper', 'cost' => 0.00, 'cost_per' => 'year', 'plan' => 'LiteShopper', 'status' => 1, 'featured' => 0, 'pricing_order' => 1, 'created_at' => \Carbon::now()],
            ['id' => 2, 'name' => 'ProShopper', 'cost' => 4.99, 'cost_per' => 'year', 'plan' => 'ProShopper', 'status' => 1, 'featured' => 0, 'pricing_order' => 2, 'created_at' => \Carbon::now()],
            ['id' => 3, 'name' => 'ExtraShopper', 'cost' => 9.99, 'cost_per' => 'year', 'plan' => 'ExtraShopper', 'status' => 1, 'featured' => 1, 'pricing_order' => 3, 'created_at' => \Carbon::now()]
        ]);
    }
}
