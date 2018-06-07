<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('menus')->delete();
        
        \DB::table('menus')->insert(array (
            0 => 
            array (
                'id' => 5,
                'title' => 'Blog',
                'location' => 'HEADER',
                'url' => '/blog',
                'status' => 1,
                'item_order' => 5,
                'created_at' => '2016-04-17 09:06:32',
                'updated_at' => '2016-04-17 09:06:32',
            ),
        ));
        
        
    }
}
