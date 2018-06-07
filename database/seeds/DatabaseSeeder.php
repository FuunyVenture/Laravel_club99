<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(FeaturesTableSeeder::class);
        $this->call(PackagesTableSeeder::class);
        $this->call(FeaturePackageTableSeeder::class);
        //$this->call(ShipmentsTableSeeder::class);
        //$this->call(ItemsTableSeeder::class);
        //$this->call(RetailersTableSeeder::class);
        $this->call(TaxesTableSeeder::class);
        $this->call(FeesTableSeeder::class);
        //$this->call(InvoicesTableSeeder::class);
        $this->call(AddressesTableSeeder::class);
        $this->call('PagesTableSeeder');
        $this->call('UsersTableSeeder');
        $this->call('MenusTableSeeder');
        //$this->call(InvoiceProductsTableSeeder::class);
        //$this->call(ShipmentDeliveryDetailsTableSeeder::class);
        $this->call(SubscriptionsTableSeeder::class);
    }

}
