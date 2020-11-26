<?php

use Illuminate\Database\Seeder;

class UsertypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('usertypes')->delete();
        
        \DB::table('usertypes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'قطاعي',
                'description' => 'العميل القطاعي',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'فئة 1',
                'description' => '1 فئة ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'فئة 2',
                'description' => 'فئة 2',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'فئة 3',
                'description' => 'فئة 3',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'فئة 4',
                'description' => 'فئة 4',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}