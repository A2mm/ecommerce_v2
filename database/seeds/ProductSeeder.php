<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('products')->delete();
        
        \DB::table('products')->insert(array (
            0 => 
            array (
                'unique_id' => '400008400018801',
                'name' => 'product 1',
                'subcategory_id' => 9,
                'discount' => NULL,
                'local_discount' => NULL,
                'status' => 1,
                'slug' => 'product-1',
                'category_id' => 2,
                'quantity' => 10,
                'num_of_orders' => 16,
                'created_at' => '2018-05-03 18:59:43',
                'updated_at' => '2018-11-26 18:24:46',
                'deleted_at' => NULL,
                'archive' => 0,
            ),
            1 => 
            array (
                'unique_id' => '400008400018801',
                'name' => 'product 2',
                'subcategory_id' => 9,
                'discount' => NULL,
                'local_discount' => NULL,
                'status' => 1,
                'slug' => 'product-2',
                'category_id' => 2,
                'quantity' => 10,
                'num_of_orders' => 16,
                'created_at' => '2018-05-03 18:59:43',
                'updated_at' => '2018-11-26 18:24:46',
                'deleted_at' => NULL,
                'archive' => 0,
            ),
            2 => 
            array (
                'unique_id' => '400008400018801',
                'name' => 'product 3',
                'subcategory_id' => 9,
                'discount' => NULL,
                'local_discount' => NULL,
                'status' => 1,
                'slug' => 'product-3',
                'category_id' => 2,
                'quantity' => 10,
                'num_of_orders' => 16,
                'created_at' => '2018-05-03 18:59:43',
                'updated_at' => '2018-11-26 18:24:46',
                'deleted_at' => NULL,
                'archive' => 0,
            ),
            3 => 
            array (
                'unique_id' => '400008400018801',
                'name' => 'product 4',
                'subcategory_id' => 9,
                'discount' => NULL,
                'local_discount' => NULL,
                'status' => 1,
                'slug' => 'product-4',
                'category_id' => 2,
                'quantity' => 10,
                'num_of_orders' => 16,
                'created_at' => '2018-05-03 18:59:43',
                'updated_at' => '2018-11-26 18:24:46',
                'deleted_at' => NULL,
                'archive' => 0,
            ),
            4 => 
            array (
                'unique_id' => '400008400018801',
                'name' => 'product 5',
                'subcategory_id' => 9,
                'discount' => NULL,
                'local_discount' => NULL,
                'status' => 1,
                'slug' => 'product-5',
                'category_id' => 2,
                'quantity' => 10,
                'num_of_orders' => 16,
                'created_at' => '2018-05-03 18:59:43',
                'updated_at' => '2018-11-26 18:24:46',
                'deleted_at' => NULL,
                'archive' => 0,
            ),
            
        ));
    }
}
