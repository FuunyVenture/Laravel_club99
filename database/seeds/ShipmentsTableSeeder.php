<?php

use Illuminate\Database\Seeder;

class ShipmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('shipments')->delete();

        \DB::table('shipments')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'Shipment 01',
                    'cost' => '290.90',
                    'duty_cost' => '175.85',
                    'duty_tax' => '1.23',
                    'retailer_shipping_cost' => '0.00',
                    'retailer_tax' => '0.00',
                    'status' => 'pending_approval',
                    'weight' => '22',
                    'height' => '120',
                    'length' => '55',
                    'eta' => \Carbon\Carbon::now(),
                    'width' => '12',
                    'destination' => 'Craiova',
                    'tracking_number' => '1921004160030',
                    'order_number' => '1',
                    'pickup_date' => \Carbon\Carbon::now()->addDays(22),
                    'collected_date' => null,
                    'user_id' => 3,
                    'retailer_id' => 1,
                    'uploaded_file' => '/assets/pdf/pdf_invoice_seed.pdf',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'Shipment 02',
                    'cost' => '495.99',
                    'duty_cost' => '400',
                    'duty_tax' => '1.23',
                    'retailer_shipping_cost' => '0.00',
                    'retailer_tax' => '0.00',
                    'status' => 'ordered',
                    'weight' => '112',
                    'height' => '45',
                    'length' => '23',
                    'eta' => \Carbon\Carbon::now(),
                    'width' => '28',
                    'destination' => 'Craiova',
                    'tracking_number' => '1921004160031',
                    'order_number' => '2',
                    'pickup_date' => \Carbon\Carbon::now(),
                    'collected_date' => null,
                    'user_id' => 3,
                    'retailer_id' => 1,
                    'uploaded_file' => '/assets/pdf/pdf_invoice_seed.pdf',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ),
            2 =>
                array (
                    'id' => 3,
                    'name' => 'Shipment 03',
                    'cost' => '100',
                    'duty_cost' => '86.75',
                    'duty_tax' => '1.23',
                    'retailer_shipping_cost' => '0.00',
                    'retailer_tax' => '0.00',
                    'status' => 'collected',
                    'weight' => '20',
                    'height' => '15',
                    'length' => '20',
                    'eta' => \Carbon\Carbon::now(),
                    'width' => '20',
                    'destination' => 'Craiova',
                    'tracking_number' => '1921004160032',
                    'order_number' => '3',
                    'pickup_date' => \Carbon\Carbon::now()->subDays(5),
                    'collected_date' => \Carbon\Carbon::now()->subDays(1),
                    'user_id' => 3,
                    'retailer_id' => 2,
                    'uploaded_file' => '/assets/pdf/pdf_invoice_seed.pdf',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ),
        ));
    }
}
