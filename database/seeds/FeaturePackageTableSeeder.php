<?php

use Illuminate\Database\Seeder;

class FeaturePackageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('feature_package')->delete();
        DB::table('feature_package')->insert([
            ['package_id' => 1, 'feature_id' => 1, 'spec' => '2 x  shipments monthly', 'created_at' => \Carbon::now()],
            ['package_id' => 1, 'feature_id' => 4, 'spec' => 'Special discounts', 'created_at' => \Carbon::now()],
            ['package_id' => 2, 'feature_id' => 2, 'spec' => '3 x  shipments monthly', 'created_at' => \Carbon::now()],
            ['package_id' => 2, 'feature_id' => 4, 'spec' => 'Special discounts', 'created_at' => \Carbon::now()],
            ['package_id' => 2, 'feature_id' => 5, 'spec' => 'Acces to private lounge', 'created_at' => \Carbon::now()],
            ['package_id' => 3, 'feature_id' => 3, 'spec' => '4 x  shipments monthly', 'created_at' => \Carbon::now()],
            ['package_id' => 3, 'feature_id' => 4, 'spec' => 'Special discounts', 'created_at' => \Carbon::now()],
            ['package_id' => 3, 'feature_id' => 5, 'spec' => 'Acces to private lounge', 'created_at' => \Carbon::now()]

        ]);
    }
}
