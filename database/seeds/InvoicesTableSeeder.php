<?php

use Illuminate\Database\Seeder;

class InvoicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('invoices')->delete();

        \DB::table('invoices')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'INV-001',
                    'total' => 249.90,
                    'club99_details_id' => 1,
                    'gift_card_id' => null,
                    'coupon_id' => null,
                    'store_payment_id' => null,
                    'user_id' => 3,
                    'status' => 'unpaid',
                    'due_date' => \Carbon\Carbon::now()->addDays(12),
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'INV-002',
                    'total' => 550,
                    'club99_details_id' => 1,
                    'gift_card_id' => null,
                    'coupon_id' => null,
                    'store_payment_id' => null,
                    'user_id' => 3,
                    'status' => 'unpaid',
                    'due_date' => \Carbon\Carbon::now(),
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ),
            2 =>
                array (
                    'id' => 3,
                    'name' => 'INV-003',
                    'total' => 199.90,
                    'club99_details_id' => 1,
                    'gift_card_id' => null,
                    'coupon_id' => null,
                    'store_payment_id' => null,
                    'user_id' => 3,
                    'status' => 'paid',
                    'due_date' => \Carbon\Carbon::now()->subDays(12),
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ),
        ));
    }
}
