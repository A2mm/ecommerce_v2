<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'cat 1',
                'created_at' => '2019-12-29 14:44:20',
                'updated_at' => '2019-12-29 14:44:20',
                'deleted_at' => NULL,
                'icon' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'cat 2',
                'created_at' => '2019-12-29 14:44:31',
                'updated_at' => '2019-12-29 14:44:31',
                'deleted_at' => NULL,
                'icon' => NULL,
            ),
        ));
        
        
    }
}