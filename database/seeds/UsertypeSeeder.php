<?php

use Illuminate\Database\Seeder;

class UsertypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'فئة 1',
                'description' => '1 فئة ',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'فئة 2',
                'description' => 'فئة 2',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'فئة 3',
                'description' => 'فئة 3',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'فئة 4',
                'description' => 'فئة 4',
            ),
            
     ));
            
    }
}
