<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('roles')->delete();
        DB::table('roles')->insert([
            ['id' => 1, 'name' => 'Admin', 'created_at' => \Carbon::now()],
            ['id' => 2, 'name' => 'Member', 'created_at' => \Carbon::now()],
            ['id' => 3, 'name' => 'Sub Admin', 'created_at' => \Carbon::now()]
        ]);
    }

}
