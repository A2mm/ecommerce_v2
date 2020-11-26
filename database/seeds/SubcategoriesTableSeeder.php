<?php

use Illuminate\Database\Seeder;

class SubcategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('subcategories')->delete();
        
        \DB::table('subcategories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'العسل',
                'created_at' => '2019-12-29 14:44:46',
                'updated_at' => '2019-12-29 14:44:46',
                'deleted_at' => NULL,
                'category_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'الإضافات',
                'created_at' => '2019-12-29 14:44:53',
                'updated_at' => '2019-12-29 14:44:53',
                'deleted_at' => NULL,
                'category_id' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'اخرى',
                'created_at' => '2019-12-29 14:45:02',
                'updated_at' => '2019-12-29 14:45:02',
                'deleted_at' => NULL,
                'category_id' => 2,
            ),
        ));
        
        
    }
}