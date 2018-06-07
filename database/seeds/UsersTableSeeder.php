<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'firstname' => 'Admin',
                'lastname' => 'Test 1',
                'email' => 'admin1@laraship.com',
                'password' => '$2y$10$OK5VFN1FkFSn6WFhE9U0J.CIoZEQ5JM86wsrAWTOjjyJUsxWpBAey',
                'role_id' => 1,
                'subscription_id' => 0,
                'avatar' => 'profile.svg',
                'remember_token' => NULL,
                'stripe_id' => NULL,
                'card_brand' => NULL,
                'card_last_four' => NULL,
                'trial_ends_at' => NULL,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ),
            1 => 
            array (
                'id' => 2,
                'firstname' => 'Member',
                'lastname' => 'Test 1',
                'email' => 'member1@laraship.com',
                'password' => '$2y$10$kP6Xd7DXACYVFRrBXXNgN.eRTO2jRCEL45jcIw0FQLICqNI6kTG1K',
                'role_id' => 2,
                'subscription_id' => 2,
                'avatar' => 'profile.svg',
                'remember_token' => NULL,
                'stripe_id' => NULL,
                'card_brand' => NULL,
                'card_last_four' => NULL,
                'trial_ends_at' => NULL,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ),
            2 =>
                array (
                    'id' => 3,
                    'firstname' => 'Member',
                    'lastname' => 'Test 2',
                    'email' => 'member2@laraship.com',
                    'password' => '$2y$10$kP6Xd7DXACYVFRrBXXNgN.eRTO2jRCEL45jcIw0FQLICqNI6kTG1K',
                    'role_id' => 2,
                    'subscription_id' => 1,
                    'avatar' => 'profile.svg',
                    'remember_token' => NULL,
                    'stripe_id' => NULL,
                    'card_brand' => NULL,
                    'card_last_four' => NULL,
                    'trial_ends_at' => NULL,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ),
        ));
    }
}
