<?php

use Illuminate\Database\Seeder;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
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
                'name' => 'subcat 1',                
                'category_id' => 4,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'subcat 2',                   
                'category_id' => 4,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'subcat 3',                    
                'category_id' => 4,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'subcat 4',                    
                'category_id' => 4,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'subcat 5',                    
                'category_id' => 4,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'subcat 6',                    
                'category_id' => 4,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'subcat 7',                 
                'category_id' => 4,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'subcat 8',                 
                'category_id' => 4,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'subcat 9',                 
                'category_id' => 4,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'subcat 9',                 
                'category_id' => 3,
            ),
        ));
    }
}
