<?php

use Illuminate\Database\Seeder;

class ProductStoreQuantitiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

//        \DB::table('product_store_quantities')->delete();
        
        \DB::table('product_store_quantities')->insert(array (
            0 => 
            array (
                'id' => 1,
                'product_id' => 1,
                'store_id' => 7,
                'purchase_id' => NULL,
                'quantity' => 100,
                'reason' => 'بداية المدة',
                'type' => '+',
                'created_at' => '2019-11-10 16:31:59',
                'updated_at' => '2019-11-10 16:31:59',
            ),
            1 => 
            array (
                'id' => 2,
                'product_id' => 1,
                'store_id' => 7,
                'purchase_id' => NULL,
                'quantity' => -2,
                'reason' => 'ay 7aga',
                'type' => '-',
                'created_at' => '2019-11-10 16:32:40',
                'updated_at' => '2019-11-10 16:32:40',
            ),
            2 => 
            array (
                'id' => 3,
                'product_id' => 1,
                'store_id' => 7,
                'purchase_id' => 1,
                'quantity' => -3,
                'reason' => 'عملية بيع',
                'type' => '-',
                'created_at' => '2019-11-10 16:35:36',
                'updated_at' => '2019-11-10 16:35:36',
            ),
            3 => 
            array (
                'id' => 4,
                'product_id' => 1,
                'store_id' => 7,
                'purchase_id' => NULL,
                'quantity' => -1,
                'reason' => 'ay 7aga',
                'type' => '-',
                'created_at' => '2019-11-10 16:40:27',
                'updated_at' => '2019-11-10 16:40:27',
            ),
            4 => 
            array (
                'id' => 5,
                'product_id' => 1,
                'store_id' => 7,
                'purchase_id' => NULL,
                'quantity' => 6,
                'reason' => 'كميات مضافة',
                'type' => '+',
                'created_at' => '2019-11-11 10:07:14',
                'updated_at' => '2019-11-11 10:07:14',
            ),
            5 => 
            array (
                'id' => 6,
                'product_id' => 1,
                'store_id' => 7,
                'purchase_id' => NULL,
                'quantity' => -6,
                'reason' => 'ay 7aga',
                'type' => '-',
                'created_at' => '2019-11-11 10:07:42',
                'updated_at' => '2019-11-11 10:07:42',
            ),
            6 => 
            array (
                'id' => 7,
                'product_id' => 2,
                'store_id' => 5,
                'purchase_id' => NULL,
                'quantity' => 100,
                'reason' => 'بداية المدة',
                'type' => '+',
                'created_at' => '2019-11-11 10:14:54',
                'updated_at' => '2019-11-11 10:14:54',
            ),
            7 => 
            array (
                'id' => 8,
                'product_id' => 3,
                'store_id' => 7,
                'purchase_id' => NULL,
                'quantity' => 20,
                'reason' => 'بداية المدة',
                'type' => '+',
                'created_at' => '2019-11-11 10:18:24',
                'updated_at' => '2019-11-11 10:18:24',
            ),
            8 => 
            array (
                'id' => 9,
                'product_id' => 1,
                'store_id' => 7,
                'purchase_id' => NULL,
                'quantity' => 106,
                'reason' => 'كميات مضافة',
                'type' => '+',
                'created_at' => '2019-11-11 10:46:48',
                'updated_at' => '2019-11-11 10:46:48',
            ),
            9 => 
            array (
                'id' => 10,
                'product_id' => 2,
                'store_id' => 5,
                'purchase_id' => 6,
                'quantity' => -1,
                'reason' => 'عملية بيع',
                'type' => '-',
                'created_at' => '2019-11-11 11:32:53',
                'updated_at' => '2019-11-11 11:32:53',
            ),
            10 => 
            array (
                'id' => 11,
                'product_id' => 4,
                'store_id' => 5,
                'purchase_id' => NULL,
                'quantity' => 299,
                'reason' => 'بداية المدة',
                'type' => '+',
                'created_at' => '2019-11-11 12:04:30',
                'updated_at' => '2019-11-11 12:04:30',
            ),
            11 => 
            array (
                'id' => 12,
                'product_id' => 3,
                'store_id' => 7,
                'purchase_id' => 7,
                'quantity' => -1,
                'reason' => 'عملية بيع',
                'type' => '-',
                'created_at' => '2019-11-11 13:19:31',
                'updated_at' => '2019-11-11 13:19:31',
            ),
            12 => 
            array (
                'id' => 13,
                'product_id' => 2,
                'store_id' => 5,
                'purchase_id' => NULL,
                'quantity' => 1,
                'reason' => 'مرتجع',
                'type' => '+',
                'created_at' => '2019-11-11 13:28:43',
                'updated_at' => '2019-11-11 13:28:43',
            ),
            13 => 
            array (
                'id' => 14,
                'product_id' => 2,
                'store_id' => 5,
                'purchase_id' => 3,
                'quantity' => -1,
                'reason' => 'عملية بيع',
                'type' => '-',
                'created_at' => '2019-11-11 13:45:02',
                'updated_at' => '2019-11-11 13:45:02',
            ),
            14 => 
            array (
                'id' => 15,
                'product_id' => 5,
                'store_id' => 5,
                'purchase_id' => NULL,
                'quantity' => 100,
                'reason' => 'بداية المدة',
                'type' => '+',
                'created_at' => '2019-11-11 13:47:39',
                'updated_at' => '2019-11-11 13:47:39',
            ),
            15 => 
            array (
                'id' => 16,
                'product_id' => 6,
                'store_id' => 5,
                'purchase_id' => NULL,
                'quantity' => 100,
                'reason' => 'بداية المدة',
                'type' => '+',
                'created_at' => '2019-11-12 09:44:54',
                'updated_at' => '2019-11-12 09:44:54',
            ),
        ));
        
        
    }
}
