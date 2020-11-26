<?php

use Illuminate\Database\Seeder;

class PurchasesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

//        \DB::table('purchases')->delete();
        
        \DB::table('purchases')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 391,
                'purchaser' => NULL,
                'delivery_address' => '42 albahar ',
                'billing_address' => '42 giza ',
                'receptor_mobile' => '22',
                'buyer_mobile' => '22',
                'receptor_name' => 'shereen',
                'price' => 610.0,
                'method' => NULL,
                'purchase_status' => 'delivered',
                'note' => NULL,
                'bill_id' => '782919243',
                'created_at' => '2019-11-10 16:33:29',
                'updated_at' => '2019-11-10 16:35:42',
                'deleted_at' => NULL,
                'shipment' => 10,
                'payment_method_id' => '1',
                'is_payed' => 0,
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 391,
                'purchaser' => NULL,
                'delivery_address' => '42 albahar ',
                'billing_address' => '42 giza ',
                'receptor_mobile' => '22222222',
                'buyer_mobile' => '22222222',
                'receptor_name' => 'shereen m',
                'price' => 410.0,
                'method' => NULL,
                'purchase_status' => 'pending',
                'note' => NULL,
                'bill_id' => '1965931705',
                'created_at' => '2019-11-11 10:49:04',
                'updated_at' => '2019-11-11 10:57:07',
                'deleted_at' => NULL,
                'shipment' => 10,
                'payment_method_id' => '2',
                'is_payed' => 0,
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 391,
                'purchaser' => NULL,
                'delivery_address' => '42 albahar ',
                'billing_address' => '42 giza ',
                'receptor_mobile' => '111',
                'buyer_mobile' => '111',
                'receptor_name' => 'shereen',
                'price' => 110.0,
                'method' => NULL,
                'purchase_status' => 'in progress',
                'note' => NULL,
                'bill_id' => '1019771502',
                'created_at' => '2019-11-11 11:03:39',
                'updated_at' => '2019-11-11 13:45:02',
                'deleted_at' => NULL,
                'shipment' => 10,
                'payment_method_id' => '3',
                'is_payed' => 0,
            ),
            3 => 
            array (
                'id' => 5,
                'user_id' => 391,
                'purchaser' => NULL,
                'delivery_address' => '42 albahar ',
                'billing_address' => '42 giza ',
                'receptor_mobile' => '111',
                'buyer_mobile' => '111',
                'receptor_name' => 'shereen',
                'price' => 210.0,
                'method' => NULL,
                'purchase_status' => 'pending',
                'note' => NULL,
                'bill_id' => '1513506525',
                'created_at' => '2019-11-11 11:20:23',
                'updated_at' => '2019-11-11 11:20:42',
                'deleted_at' => NULL,
                'shipment' => 10,
                'payment_method_id' => '2',
                'is_payed' => 0,
            ),
            4 => 
            array (
                'id' => 6,
                'user_id' => 391,
                'purchaser' => NULL,
                'delivery_address' => '42 albahar ',
                'billing_address' => '42 giza ',
                'receptor_mobile' => '11111111122222222',
                'buyer_mobile' => '111111111111',
                'receptor_name' => 'shereen',
                'price' => 110.0,
                'method' => NULL,
                'purchase_status' => 'in progress',
                'note' => NULL,
                'bill_id' => '133989506',
                'created_at' => '2019-11-11 11:32:19',
                'updated_at' => '2019-11-11 11:32:53',
                'deleted_at' => NULL,
                'shipment' => 10,
                'payment_method_id' => '1',
                'is_payed' => 0,
            ),
            5 => 
            array (
                'id' => 7,
                'user_id' => 391,
                'purchaser' => NULL,
                'delivery_address' => '42 albahar ',
                'billing_address' => '42 giza ',
                'receptor_mobile' => '111',
                'buyer_mobile' => '111',
                'receptor_name' => 'shereen m',
                'price' => 210.0,
                'method' => NULL,
                'purchase_status' => 'in progress',
                'note' => NULL,
                'bill_id' => '1090594590',
                'created_at' => '2019-11-11 13:14:09',
                'updated_at' => '2019-11-11 13:19:31',
                'deleted_at' => NULL,
                'shipment' => 10,
                'payment_method_id' => '1',
                'is_payed' => 0,
            ),
        ));
        
        
    }
}
