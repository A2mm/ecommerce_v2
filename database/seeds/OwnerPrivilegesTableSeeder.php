<?php

use Illuminate\Database\Seeder;

class OwnerPrivilegesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('owner_privileges')->delete();
        
        \DB::table('owner_privileges')->insert(array (
            0 => 
            array (
                'id' => 7,
                'user_id' => 3,
                'name' => 'Mohammed Roshdy',
                'email' => 'le.roshdy@gmail.com',
                'privilege' => 'general',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 8,
                'user_id' => 273,
                'name' => 'test',
                'email' => 'test10@test.com',
                'privilege' => 'general',
                'created_at' => '2018-07-11 14:19:38',
                'updated_at' => '2018-07-11 14:19:38',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 9,
                'user_id' => 274,
                'name' => 'test',
                'email' => 'test91@test.com',
                'privilege' => 'subcategories',
                'created_at' => '2018-07-11 16:42:45',
                'updated_at' => '2018-07-11 16:42:45',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 10,
                'user_id' => 274,
                'name' => 'test',
                'email' => 'test91@test.com',
                'privilege' => 'products',
                'created_at' => '2018-07-11 16:42:45',
                'updated_at' => '2018-07-11 16:42:45',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 11,
                'user_id' => 274,
                'name' => 'test',
                'email' => 'test91@test.com',
                'privilege' => 'orders',
                'created_at' => '2018-07-11 16:42:45',
                'updated_at' => '2018-07-11 16:42:45',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 12,
                'user_id' => 274,
                'name' => 'test',
                'email' => 'test91@test.com',
                'privilege' => 'coupons',
                'created_at' => '2018-07-11 16:42:45',
                'updated_at' => '2018-07-11 16:42:45',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 13,
                'user_id' => 274,
                'name' => 'test',
                'email' => 'test91@test.com',
                'privilege' => 'entire_shop',
                'created_at' => '2018-07-11 16:42:45',
                'updated_at' => '2018-07-11 16:42:45',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 14,
                'user_id' => 274,
                'name' => 'test',
                'email' => 'test91@test.com',
                'privilege' => 'customer',
                'created_at' => '2018-07-11 16:42:45',
                'updated_at' => '2018-07-11 16:42:45',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 15,
                'user_id' => 274,
                'name' => 'test',
                'email' => 'test91@test.com',
                'privilege' => 'affiliate',
                'created_at' => '2018-07-11 16:42:45',
                'updated_at' => '2018-07-11 16:42:45',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 16,
                'user_id' => 274,
                'name' => 'test',
                'email' => 'test91@test.com',
                'privilege' => 'link',
                'created_at' => '2018-07-11 16:42:45',
                'updated_at' => '2018-07-11 16:42:45',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 17,
                'user_id' => 274,
                'name' => 'test',
                'email' => 'test91@test.com',
                'privilege' => 'vendor',
                'created_at' => '2018-07-11 16:42:45',
                'updated_at' => '2018-07-11 16:42:45',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 18,
                'user_id' => 274,
                'name' => 'test',
                'email' => 'test91@test.com',
                'privilege' => 'admin',
                'created_at' => '2018-07-11 16:42:45',
                'updated_at' => '2018-07-11 16:42:45',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 19,
                'user_id' => 274,
                'name' => 'test',
                'email' => 'test91@test.com',
                'privilege' => 'quantity',
                'created_at' => '2018-07-11 16:42:45',
                'updated_at' => '2018-07-11 16:42:45',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 20,
                'user_id' => 274,
                'name' => 'test',
                'email' => 'test91@test.com',
                'privilege' => 'owner',
                'created_at' => '2018-07-11 16:42:45',
                'updated_at' => '2018-07-11 16:42:45',
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 21,
                'user_id' => 274,
                'name' => 'test',
                'email' => 'test91@test.com',
                'privilege' => 'video',
                'created_at' => '2018-07-11 16:42:45',
                'updated_at' => '2018-07-11 16:42:45',
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 22,
                'user_id' => 274,
                'name' => 'test',
                'email' => 'test91@test.com',
                'privilege' => 'csv',
                'created_at' => '2018-07-11 16:42:45',
                'updated_at' => '2018-07-11 16:42:45',
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 23,
                'user_id' => 275,
                'name' => 'test',
                'email' => 'test95@test.com',
                'privilege' => 'subcategories',
                'created_at' => '2018-07-11 16:46:59',
                'updated_at' => '2018-07-11 16:46:59',
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 24,
                'user_id' => 275,
                'name' => 'test',
                'email' => 'test95@test.com',
                'privilege' => 'products',
                'created_at' => '2018-07-11 16:46:59',
                'updated_at' => '2018-07-11 16:46:59',
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 25,
                'user_id' => 275,
                'name' => 'test',
                'email' => 'test95@test.com',
                'privilege' => 'orders',
                'created_at' => '2018-07-11 16:46:59',
                'updated_at' => '2018-07-11 16:46:59',
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 26,
                'user_id' => 275,
                'name' => 'test',
                'email' => 'test95@test.com',
                'privilege' => 'coupons',
                'created_at' => '2018-07-11 16:46:59',
                'updated_at' => '2018-07-11 16:46:59',
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => 27,
                'user_id' => 275,
                'name' => 'test',
                'email' => 'test95@test.com',
                'privilege' => 'entire_shop',
                'created_at' => '2018-07-11 16:46:59',
                'updated_at' => '2018-07-11 16:46:59',
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'id' => 28,
                'user_id' => 275,
                'name' => 'test',
                'email' => 'test95@test.com',
                'privilege' => 'customer',
                'created_at' => '2018-07-11 16:46:59',
                'updated_at' => '2018-07-11 16:46:59',
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'id' => 29,
                'user_id' => 275,
                'name' => 'test',
                'email' => 'test95@test.com',
                'privilege' => 'affiliate',
                'created_at' => '2018-07-11 16:46:59',
                'updated_at' => '2018-07-11 16:46:59',
                'deleted_at' => NULL,
            ),
            23 => 
            array (
                'id' => 30,
                'user_id' => 275,
                'name' => 'test',
                'email' => 'test95@test.com',
                'privilege' => 'link',
                'created_at' => '2018-07-11 16:46:59',
                'updated_at' => '2018-07-11 16:46:59',
                'deleted_at' => NULL,
            ),
            24 => 
            array (
                'id' => 31,
                'user_id' => 275,
                'name' => 'test',
                'email' => 'test95@test.com',
                'privilege' => 'vendor',
                'created_at' => '2018-07-11 16:46:59',
                'updated_at' => '2018-07-11 16:46:59',
                'deleted_at' => NULL,
            ),
            25 => 
            array (
                'id' => 32,
                'user_id' => 275,
                'name' => 'test',
                'email' => 'test95@test.com',
                'privilege' => 'admin',
                'created_at' => '2018-07-11 16:46:59',
                'updated_at' => '2018-07-11 16:46:59',
                'deleted_at' => NULL,
            ),
            26 => 
            array (
                'id' => 33,
                'user_id' => 275,
                'name' => 'test',
                'email' => 'test95@test.com',
                'privilege' => 'owner',
                'created_at' => '2018-07-11 16:46:59',
                'updated_at' => '2018-07-11 16:46:59',
                'deleted_at' => NULL,
            ),
            27 => 
            array (
                'id' => 34,
                'user_id' => 275,
                'name' => 'test',
                'email' => 'test95@test.com',
                'privilege' => 'video',
                'created_at' => '2018-07-11 16:46:59',
                'updated_at' => '2018-07-11 16:46:59',
                'deleted_at' => NULL,
            ),
            28 => 
            array (
                'id' => 35,
                'user_id' => 275,
                'name' => 'test',
                'email' => 'test95@test.com',
                'privilege' => 'csv',
                'created_at' => '2018-07-11 16:46:59',
                'updated_at' => '2018-07-11 16:46:59',
                'deleted_at' => NULL,
            ),
            29 => 
            array (
                'id' => 36,
                'user_id' => 276,
                'name' => 'test',
                'email' => 'test_95@test.com',
                'privilege' => 'subcategories',
                'created_at' => '2018-07-11 16:51:49',
                'updated_at' => '2018-07-11 16:51:49',
                'deleted_at' => NULL,
            ),
            30 => 
            array (
                'id' => 37,
                'user_id' => 276,
                'name' => 'test',
                'email' => 'test_95@test.com',
                'privilege' => 'products',
                'created_at' => '2018-07-11 16:51:49',
                'updated_at' => '2018-07-11 16:51:49',
                'deleted_at' => NULL,
            ),
            31 => 
            array (
                'id' => 38,
                'user_id' => 276,
                'name' => 'test',
                'email' => 'test_95@test.com',
                'privilege' => 'orders',
                'created_at' => '2018-07-11 16:51:49',
                'updated_at' => '2018-07-11 16:51:49',
                'deleted_at' => NULL,
            ),
            32 => 
            array (
                'id' => 39,
                'user_id' => 276,
                'name' => 'test',
                'email' => 'test_95@test.com',
                'privilege' => 'coupons',
                'created_at' => '2018-07-11 16:51:49',
                'updated_at' => '2018-07-11 16:51:49',
                'deleted_at' => NULL,
            ),
            33 => 
            array (
                'id' => 40,
                'user_id' => 276,
                'name' => 'test',
                'email' => 'test_95@test.com',
                'privilege' => 'entire_shop',
                'created_at' => '2018-07-11 16:51:49',
                'updated_at' => '2018-07-11 16:51:49',
                'deleted_at' => NULL,
            ),
            34 => 
            array (
                'id' => 41,
                'user_id' => 277,
                'name' => 'test',
                'email' => '1@test.com',
                'privilege' => 'customer',
                'created_at' => '2018-07-12 10:40:58',
                'updated_at' => '2018-07-12 10:40:58',
                'deleted_at' => NULL,
            ),
            35 => 
            array (
                'id' => 42,
                'user_id' => 277,
                'name' => 'test',
                'email' => '1@test.com',
                'privilege' => 'affiliate',
                'created_at' => '2018-07-12 10:40:58',
                'updated_at' => '2018-07-12 10:40:58',
                'deleted_at' => NULL,
            ),
            36 => 
            array (
                'id' => 43,
                'user_id' => 277,
                'name' => 'test',
                'email' => '1@test.com',
                'privilege' => 'link',
                'created_at' => '2018-07-12 10:40:58',
                'updated_at' => '2018-07-12 10:40:58',
                'deleted_at' => NULL,
            ),
            37 => 
            array (
                'id' => 44,
                'user_id' => 277,
                'name' => 'test',
                'email' => '1@test.com',
                'privilege' => 'vendor',
                'created_at' => '2018-07-12 10:40:58',
                'updated_at' => '2018-07-12 10:40:58',
                'deleted_at' => NULL,
            ),
            38 => 
            array (
                'id' => 45,
                'user_id' => 277,
                'name' => 'test',
                'email' => '1@test.com',
                'privilege' => 'admin',
                'created_at' => '2018-07-12 10:40:58',
                'updated_at' => '2018-07-12 10:40:58',
                'deleted_at' => NULL,
            ),
            39 => 
            array (
                'id' => 46,
                'user_id' => 277,
                'name' => 'test',
                'email' => '1@test.com',
                'privilege' => 'quantity',
                'created_at' => '2018-07-12 10:40:58',
                'updated_at' => '2018-07-12 10:40:58',
                'deleted_at' => NULL,
            ),
            40 => 
            array (
                'id' => 47,
                'user_id' => 277,
                'name' => 'test',
                'email' => '1@test.com',
                'privilege' => 'owner',
                'created_at' => '2018-07-12 10:40:58',
                'updated_at' => '2018-07-12 10:40:58',
                'deleted_at' => NULL,
            ),
            41 => 
            array (
                'id' => 48,
                'user_id' => 277,
                'name' => 'test',
                'email' => '1@test.com',
                'privilege' => 'video',
                'created_at' => '2018-07-12 10:40:58',
                'updated_at' => '2018-07-12 10:40:58',
                'deleted_at' => NULL,
            ),
            42 => 
            array (
                'id' => 49,
                'user_id' => 277,
                'name' => 'test',
                'email' => '1@test.com',
                'privilege' => 'csv',
                'created_at' => '2018-07-12 10:40:58',
                'updated_at' => '2018-07-12 10:40:58',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}