<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('settings')->delete();

        \DB::table('settings')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'key_cd' => 'SITE_TITLE',
                    'type' => 'TEXT',
                    'display_value' => 'Site Title',
                    'value' => 'Club99',
                    'created_at' => '2016-03-31 07:04:15',
                    'updated_at' => '2016-03-31 12:18:21',
                ),
            1 =>
                array(
                    'id' => 2,
                    'key_cd' => 'SHORT_SITE_TITLE',
                    'type' => 'TEXT',
                    'display_value' => 'Short Site Title',
                    'value' => 'Club99',
                    'created_at' => '2016-03-31 07:04:15',
                    'updated_at' => NULL,
                ),

            2 =>
                array(
                    'id' => 3,
                    'key_cd' => 'US_ADDRESS',
                    'type' => 'TEXT',
                    'display_value' => 'US Address',
                    'value' => '100 MAIN ST, PO BOX 1022<br/>SEATTLE WA 98104, USA',
                    'created_at' => '2016-03-31 11:17:23',
                    'updated_at' => '2016-03-31 11:17:23',
                ),
            3 =>
                array(
                    'id' => 4,
                    'key_cd' => 'MEMBER_SIGNUP_EMAIL',
                    'type' => 'EMAIL',
                    'display_value' => 'Member Sign Up Email',
                    'value' => '<div>Text Here</div>',
                    'created_at' => '2016-03-31 11:17:23',
                    'updated_at' => '2016-03-31 11:17:23',
                ),
            4 =>
                array(
                    'id' => 5,
                    'key_cd' => 'SHIPMENT_CREATED_EMAIL',
                    'type' => 'EMAIL',
                    'display_value' => 'Shipment Created Email',
                    'value' => '<div>Text Here</div>',
                    'created_at' => '2016-03-31 11:17:23',
                    'updated_at' => '2016-03-31 11:17:23',
                ),
            5 =>
                array(
                    'id' => 6,
                    'key_cd' => 'NEW_INVOICE_EMAIL',
                    'type' => 'EMAIL',
                    'display_value' => 'New Invoice Email',
                    'value' => '<div>Text Here</div>',
                    'created_at' => '2016-03-31 11:17:23',
                    'updated_at' => '2016-03-31 11:17:23',
                ),
            6 =>
                array(
                    'id' => 7,
                    'key_cd' => 'INVOICE_PAYMENT_EMAIL',
                    'type' => 'EMAIL',
                    'display_value' => 'Invoice Payment Email',
                    'value' => '<div>Text Here</div>',
                    'created_at' => '2016-03-31 11:17:23',
                    'updated_at' => '2016-03-31 11:17:23',
                ),
            7 =>
                array(
                    'id' => 8,
                    'key_cd' => 'NEW_MEMBER_EMAIL',
                    'type' => 'EMAIL',
                    'display_value' => 'Admin New Member Email',
                    'value' => '<div>Text Here</div>',
                    'created_at' => '2016-03-31 11:17:23',
                    'updated_at' => '2016-03-31 11:17:23',
                ),
            8 =>
                array(
                    'id' => 9,
                    'key_cd' => 'NEW_SHIPMENT_CREATED_EMAIL',
                    'type' => 'EMAIL',
                    'display_value' => 'New Shipment Created Email',
                    'value' => '<div>Text Here</div>',
                    'created_at' => '2016-03-31 11:17:23',
                    'updated_at' => '2016-03-31 11:17:23',
                ),
            9 =>
                array(
                    'id' => 10,
                    'key_cd' => 'ADMIN_INVOICE_PAYMENT_EMAIL',
                    'type' => 'EMAIL',
                    'display_value' => 'Invoice Payment Email',
                    'value' => '<div>Text Here</div>',
                    'created_at' => '2016-03-31 11:17:23',
                    'updated_at' => '2016-03-31 11:17:23',
                ),
            10 =>
                array(
                    'id' => 11,
                    'key_cd' => 'ACTIVATION_EMAIL',
                    'type' => 'EMAIL',
                    'display_value' => 'Activation Email',
                    'value' => '<div>Text Here</div>',
                    'created_at' => '2016-03-31 11:17:23',
                    'updated_at' => '2016-03-31 11:17:23',
                ),
            11 =>
                array(
                    'id' => 12,
                    'key_cd' => 'VAT_TAX',
                    'type' => 'TEXT',
                    'display_value' => 'VAT Tax',
                    'value' => '7.5',
                    'created_at' => '2016-03-31 11:17:23',
                    'updated_at' => '2016-03-31 11:17:23',
                ),
            12 =>
                array(
                    'id' => 13,
                    'key_cd' => 'COUNTRIES',
                    'type' => 'TEXT',
                    'display_value' => 'Countries',
                    'value' => '[]',
                    'created_at' => '2016-03-31 11:17:23',
                    'updated_at' => '2016-03-31 11:17:23',
                ),

        ));


    }
}
