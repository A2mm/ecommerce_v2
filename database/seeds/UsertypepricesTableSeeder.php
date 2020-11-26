<?php

use Illuminate\Database\Seeder;

class UsertypepricesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('usertypeprices')->delete();
        
        \DB::table('usertypeprices')->insert(array (
            0 => 
            array (
                'id' => 1,
                'usertype_id' => 1,
                'product_id' => 73,
                'price' => 31.0,
                'created_at' => '2020-01-04 12:22:40',
                'updated_at' => '2020-01-04 16:35:38',
            ),
            1 => 
            array (
                'id' => 2,
                'usertype_id' => 2,
                'product_id' => 73,
                'price' => 26.0,
                'created_at' => '2020-01-04 12:22:40',
                'updated_at' => '2020-01-04 16:35:38',
            ),
            2 => 
            array (
                'id' => 3,
                'usertype_id' => 3,
                'product_id' => 73,
                'price' => 25.0,
                'created_at' => '2020-01-04 12:22:40',
                'updated_at' => '2020-01-04 16:35:38',
            ),
            3 => 
            array (
                'id' => 4,
                'usertype_id' => 1,
                'product_id' => 37,
                'price' => 80.0,
                'created_at' => '2020-01-04 13:15:09',
                'updated_at' => '2020-01-04 15:44:03',
            ),
            4 => 
            array (
                'id' => 5,
                'usertype_id' => 2,
                'product_id' => 37,
                'price' => 75.0,
                'created_at' => '2020-01-04 13:15:09',
                'updated_at' => '2020-01-04 15:44:03',
            ),
            5 => 
            array (
                'id' => 6,
                'usertype_id' => 3,
                'product_id' => 37,
                'price' => 73.0,
                'created_at' => '2020-01-04 13:15:09',
                'updated_at' => '2020-01-04 15:44:03',
            ),
            6 => 
            array (
                'id' => 7,
                'usertype_id' => 1,
                'product_id' => 64,
                'price' => 15.0,
                'created_at' => '2020-01-04 14:14:46',
                'updated_at' => '2020-01-04 16:57:33',
            ),
            7 => 
            array (
                'id' => 8,
                'usertype_id' => 2,
                'product_id' => 64,
                'price' => 12.5,
                'created_at' => '2020-01-04 14:14:46',
                'updated_at' => '2020-01-04 16:02:00',
            ),
            8 => 
            array (
                'id' => 9,
                'usertype_id' => 3,
                'product_id' => 64,
                'price' => 10.0,
                'created_at' => '2020-01-04 14:14:46',
                'updated_at' => '2020-01-04 16:02:00',
            ),
            9 => 
            array (
                'id' => 10,
                'usertype_id' => 1,
                'product_id' => 60,
                'price' => 15.0,
                'created_at' => '2020-01-04 14:15:07',
                'updated_at' => '2020-01-04 16:00:41',
            ),
            10 => 
            array (
                'id' => 11,
                'usertype_id' => 2,
                'product_id' => 60,
                'price' => 12.5,
                'created_at' => '2020-01-04 14:15:07',
                'updated_at' => '2020-01-04 16:00:41',
            ),
            11 => 
            array (
                'id' => 12,
                'usertype_id' => 3,
                'product_id' => 60,
                'price' => 10.0,
                'created_at' => '2020-01-04 14:15:07',
                'updated_at' => '2020-01-04 16:00:41',
            ),
            12 => 
            array (
                'id' => 13,
                'usertype_id' => 4,
                'product_id' => 60,
                'price' => 10.0,
                'created_at' => '2020-01-04 14:31:28',
                'updated_at' => '2020-01-04 16:00:41',
            ),
            13 => 
            array (
                'id' => 14,
                'usertype_id' => 5,
                'product_id' => 60,
                'price' => 10.0,
                'created_at' => '2020-01-04 14:31:28',
                'updated_at' => '2020-01-04 16:00:41',
            ),
            14 => 
            array (
                'id' => 15,
                'usertype_id' => 1,
                'product_id' => 31,
                'price' => 70.0,
                'created_at' => '2020-01-04 14:46:59',
                'updated_at' => '2020-01-04 14:47:40',
            ),
            15 => 
            array (
                'id' => 16,
                'usertype_id' => 2,
                'product_id' => 31,
                'price' => 65.0,
                'created_at' => '2020-01-04 14:46:59',
                'updated_at' => '2020-01-04 14:47:40',
            ),
            16 => 
            array (
                'id' => 17,
                'usertype_id' => 3,
                'product_id' => 31,
                'price' => 63.0,
                'created_at' => '2020-01-04 14:46:59',
                'updated_at' => '2020-01-04 14:47:40',
            ),
            17 => 
            array (
                'id' => 18,
                'usertype_id' => 4,
                'product_id' => 31,
                'price' => 62.0,
                'created_at' => '2020-01-04 14:46:59',
                'updated_at' => '2020-01-04 14:47:40',
            ),
            18 => 
            array (
                'id' => 19,
                'usertype_id' => 5,
                'product_id' => 31,
                'price' => 61.0,
                'created_at' => '2020-01-04 14:46:59',
                'updated_at' => '2020-01-04 14:47:40',
            ),
            19 => 
            array (
                'id' => 20,
                'usertype_id' => 1,
                'product_id' => 1,
                'price' => 60.0,
                'created_at' => '2020-01-04 14:50:55',
                'updated_at' => '2020-01-04 14:50:55',
            ),
            20 => 
            array (
                'id' => 21,
                'usertype_id' => 2,
                'product_id' => 1,
                'price' => 53.0,
                'created_at' => '2020-01-04 14:50:55',
                'updated_at' => '2020-01-04 14:50:55',
            ),
            21 => 
            array (
                'id' => 22,
                'usertype_id' => 3,
                'product_id' => 1,
                'price' => 51.0,
                'created_at' => '2020-01-04 14:50:55',
                'updated_at' => '2020-01-04 14:50:55',
            ),
            22 => 
            array (
                'id' => 23,
                'usertype_id' => 4,
                'product_id' => 1,
                'price' => 50.0,
                'created_at' => '2020-01-04 14:50:55',
                'updated_at' => '2020-01-04 14:50:55',
            ),
            23 => 
            array (
                'id' => 24,
                'usertype_id' => 5,
                'product_id' => 1,
                'price' => 48.0,
                'created_at' => '2020-01-04 14:50:55',
                'updated_at' => '2020-01-04 14:50:55',
            ),
            24 => 
            array (
                'id' => 25,
                'usertype_id' => 1,
                'product_id' => 2,
                'price' => 31.0,
                'created_at' => '2020-01-04 14:51:14',
                'updated_at' => '2020-01-04 14:51:14',
            ),
            25 => 
            array (
                'id' => 26,
                'usertype_id' => 2,
                'product_id' => 2,
                'price' => 26.5,
                'created_at' => '2020-01-04 14:51:14',
                'updated_at' => '2020-01-04 14:51:14',
            ),
            26 => 
            array (
                'id' => 27,
                'usertype_id' => 3,
                'product_id' => 2,
                'price' => 25.5,
                'created_at' => '2020-01-04 14:51:14',
                'updated_at' => '2020-01-04 14:51:14',
            ),
            27 => 
            array (
                'id' => 28,
                'usertype_id' => 4,
                'product_id' => 2,
                'price' => 25.0,
                'created_at' => '2020-01-04 14:51:14',
                'updated_at' => '2020-01-04 14:51:14',
            ),
            28 => 
            array (
                'id' => 29,
                'usertype_id' => 5,
                'product_id' => 2,
                'price' => 24.0,
                'created_at' => '2020-01-04 14:51:14',
                'updated_at' => '2020-01-04 14:51:14',
            ),
            29 => 
            array (
                'id' => 30,
                'usertype_id' => 1,
                'product_id' => 3,
                'price' => 15.5,
                'created_at' => '2020-01-04 14:51:46',
                'updated_at' => '2020-01-04 14:51:46',
            ),
            30 => 
            array (
                'id' => 31,
                'usertype_id' => 2,
                'product_id' => 3,
                'price' => 13.5,
                'created_at' => '2020-01-04 14:51:46',
                'updated_at' => '2020-01-04 14:51:46',
            ),
            31 => 
            array (
                'id' => 32,
                'usertype_id' => 3,
                'product_id' => 3,
                'price' => 13.0,
                'created_at' => '2020-01-04 14:51:46',
                'updated_at' => '2020-01-04 14:51:46',
            ),
            32 => 
            array (
                'id' => 33,
                'usertype_id' => 4,
                'product_id' => 3,
                'price' => 12.75,
                'created_at' => '2020-01-04 14:51:46',
                'updated_at' => '2020-01-04 14:51:46',
            ),
            33 => 
            array (
                'id' => 34,
                'usertype_id' => 5,
                'product_id' => 3,
                'price' => 12.5,
                'created_at' => '2020-01-04 14:51:46',
                'updated_at' => '2020-01-04 14:51:46',
            ),
            34 => 
            array (
                'id' => 35,
                'usertype_id' => 1,
                'product_id' => 4,
                'price' => 75.0,
                'created_at' => '2020-01-04 14:52:13',
                'updated_at' => '2020-01-04 14:52:13',
            ),
            35 => 
            array (
                'id' => 36,
                'usertype_id' => 2,
                'product_id' => 4,
                'price' => 70.0,
                'created_at' => '2020-01-04 14:52:13',
                'updated_at' => '2020-01-04 14:52:13',
            ),
            36 => 
            array (
                'id' => 37,
                'usertype_id' => 3,
                'product_id' => 4,
                'price' => 68.0,
                'created_at' => '2020-01-04 14:52:13',
                'updated_at' => '2020-01-04 14:52:13',
            ),
            37 => 
            array (
                'id' => 38,
                'usertype_id' => 4,
                'product_id' => 4,
                'price' => 67.0,
                'created_at' => '2020-01-04 14:52:13',
                'updated_at' => '2020-01-04 14:52:13',
            ),
            38 => 
            array (
                'id' => 39,
                'usertype_id' => 5,
                'product_id' => 4,
                'price' => 66.0,
                'created_at' => '2020-01-04 14:52:13',
                'updated_at' => '2020-01-04 14:52:13',
            ),
            39 => 
            array (
                'id' => 40,
                'usertype_id' => 1,
                'product_id' => 5,
                'price' => 38.0,
                'created_at' => '2020-01-04 14:52:47',
                'updated_at' => '2020-01-04 14:52:47',
            ),
            40 => 
            array (
                'id' => 41,
                'usertype_id' => 2,
                'product_id' => 5,
                'price' => 35.0,
                'created_at' => '2020-01-04 14:52:47',
                'updated_at' => '2020-01-04 14:52:47',
            ),
            41 => 
            array (
                'id' => 42,
                'usertype_id' => 3,
                'product_id' => 5,
                'price' => 34.0,
                'created_at' => '2020-01-04 14:52:47',
                'updated_at' => '2020-01-04 14:52:47',
            ),
            42 => 
            array (
                'id' => 43,
                'usertype_id' => 4,
                'product_id' => 5,
                'price' => 33.5,
                'created_at' => '2020-01-04 14:52:47',
                'updated_at' => '2020-01-04 14:52:47',
            ),
            43 => 
            array (
                'id' => 44,
                'usertype_id' => 5,
                'product_id' => 5,
                'price' => 33.0,
                'created_at' => '2020-01-04 14:52:47',
                'updated_at' => '2020-01-04 14:52:47',
            ),
            44 => 
            array (
                'id' => 45,
                'usertype_id' => 1,
                'product_id' => 6,
                'price' => 68.0,
                'created_at' => '2020-01-04 14:53:17',
                'updated_at' => '2020-01-04 14:53:17',
            ),
            45 => 
            array (
                'id' => 46,
                'usertype_id' => 2,
                'product_id' => 6,
                'price' => 63.0,
                'created_at' => '2020-01-04 14:53:17',
                'updated_at' => '2020-01-04 14:53:17',
            ),
            46 => 
            array (
                'id' => 47,
                'usertype_id' => 3,
                'product_id' => 6,
                'price' => 61.0,
                'created_at' => '2020-01-04 14:53:17',
                'updated_at' => '2020-01-04 14:53:17',
            ),
            47 => 
            array (
                'id' => 48,
                'usertype_id' => 4,
                'product_id' => 6,
                'price' => 60.0,
                'created_at' => '2020-01-04 14:53:17',
                'updated_at' => '2020-01-04 14:53:17',
            ),
            48 => 
            array (
                'id' => 49,
                'usertype_id' => 5,
                'product_id' => 6,
                'price' => 59.0,
                'created_at' => '2020-01-04 14:53:17',
                'updated_at' => '2020-01-04 14:53:17',
            ),
            49 => 
            array (
                'id' => 50,
                'usertype_id' => 1,
                'product_id' => 7,
                'price' => 35.0,
                'created_at' => '2020-01-04 14:53:48',
                'updated_at' => '2020-01-04 14:53:48',
            ),
            50 => 
            array (
                'id' => 51,
                'usertype_id' => 2,
                'product_id' => 7,
                'price' => 31.5,
                'created_at' => '2020-01-04 14:53:49',
                'updated_at' => '2020-01-04 14:53:49',
            ),
            51 => 
            array (
                'id' => 52,
                'usertype_id' => 3,
                'product_id' => 7,
                'price' => 30.5,
                'created_at' => '2020-01-04 14:53:49',
                'updated_at' => '2020-01-04 14:53:49',
            ),
            52 => 
            array (
                'id' => 53,
                'usertype_id' => 4,
                'product_id' => 7,
                'price' => 30.0,
                'created_at' => '2020-01-04 14:53:49',
                'updated_at' => '2020-01-04 14:53:49',
            ),
            53 => 
            array (
                'id' => 54,
                'usertype_id' => 5,
                'product_id' => 7,
                'price' => 29.5,
                'created_at' => '2020-01-04 14:53:49',
                'updated_at' => '2020-01-04 14:53:49',
            ),
            54 => 
            array (
                'id' => 55,
                'usertype_id' => 1,
                'product_id' => 8,
                'price' => 18.0,
                'created_at' => '2020-01-04 14:54:18',
                'updated_at' => '2020-01-04 14:54:18',
            ),
            55 => 
            array (
                'id' => 56,
                'usertype_id' => 2,
                'product_id' => 8,
                'price' => 16.25,
                'created_at' => '2020-01-04 14:54:18',
                'updated_at' => '2020-01-04 14:54:18',
            ),
            56 => 
            array (
                'id' => 57,
                'usertype_id' => 3,
                'product_id' => 8,
                'price' => 15.75,
                'created_at' => '2020-01-04 14:54:18',
                'updated_at' => '2020-01-04 14:54:18',
            ),
            57 => 
            array (
                'id' => 58,
                'usertype_id' => 4,
                'product_id' => 8,
                'price' => 15.5,
                'created_at' => '2020-01-04 14:54:18',
                'updated_at' => '2020-01-04 14:54:18',
            ),
            58 => 
            array (
                'id' => 59,
                'usertype_id' => 5,
                'product_id' => 8,
                'price' => 15.25,
                'created_at' => '2020-01-04 14:54:18',
                'updated_at' => '2020-01-04 14:54:18',
            ),
            59 => 
            array (
                'id' => 60,
                'usertype_id' => 1,
                'product_id' => 9,
                'price' => 45.0,
                'created_at' => '2020-01-04 14:55:50',
                'updated_at' => '2020-01-04 18:19:37',
            ),
            60 => 
            array (
                'id' => 61,
                'usertype_id' => 2,
                'product_id' => 9,
                'price' => 60.0,
                'created_at' => '2020-01-04 14:55:51',
                'updated_at' => '2020-01-04 14:55:51',
            ),
            61 => 
            array (
                'id' => 62,
                'usertype_id' => 3,
                'product_id' => 9,
                'price' => 58.0,
                'created_at' => '2020-01-04 14:55:51',
                'updated_at' => '2020-01-04 14:55:51',
            ),
            62 => 
            array (
                'id' => 63,
                'usertype_id' => 4,
                'product_id' => 9,
                'price' => 57.0,
                'created_at' => '2020-01-04 14:55:51',
                'updated_at' => '2020-01-04 14:55:51',
            ),
            63 => 
            array (
                'id' => 64,
                'usertype_id' => 5,
                'product_id' => 9,
                'price' => 56.0,
                'created_at' => '2020-01-04 14:55:51',
                'updated_at' => '2020-01-04 14:55:51',
            ),
            64 => 
            array (
                'id' => 65,
                'usertype_id' => 1,
                'product_id' => 10,
                'price' => 33.0,
                'created_at' => '2020-01-04 14:56:19',
                'updated_at' => '2020-01-04 14:56:19',
            ),
            65 => 
            array (
                'id' => 66,
                'usertype_id' => 2,
                'product_id' => 10,
                'price' => 30.0,
                'created_at' => '2020-01-04 14:56:19',
                'updated_at' => '2020-01-04 14:56:19',
            ),
            66 => 
            array (
                'id' => 67,
                'usertype_id' => 3,
                'product_id' => 10,
                'price' => 29.0,
                'created_at' => '2020-01-04 14:56:19',
                'updated_at' => '2020-01-04 14:56:19',
            ),
            67 => 
            array (
                'id' => 68,
                'usertype_id' => 4,
                'product_id' => 10,
                'price' => 28.5,
                'created_at' => '2020-01-04 14:56:19',
                'updated_at' => '2020-01-04 14:56:19',
            ),
            68 => 
            array (
                'id' => 69,
                'usertype_id' => 5,
                'product_id' => 10,
                'price' => 28.0,
                'created_at' => '2020-01-04 14:56:19',
                'updated_at' => '2020-01-04 14:56:19',
            ),
            69 => 
            array (
                'id' => 70,
                'usertype_id' => 1,
                'product_id' => 11,
                'price' => 17.0,
                'created_at' => '2020-01-04 14:56:59',
                'updated_at' => '2020-01-04 14:56:59',
            ),
            70 => 
            array (
                'id' => 71,
                'usertype_id' => 2,
                'product_id' => 11,
                'price' => 15.5,
                'created_at' => '2020-01-04 14:56:59',
                'updated_at' => '2020-01-04 14:56:59',
            ),
            71 => 
            array (
                'id' => 72,
                'usertype_id' => 3,
                'product_id' => 11,
                'price' => 15.0,
                'created_at' => '2020-01-04 14:56:59',
                'updated_at' => '2020-01-04 14:56:59',
            ),
            72 => 
            array (
                'id' => 73,
                'usertype_id' => 4,
                'product_id' => 11,
                'price' => 14.75,
                'created_at' => '2020-01-04 14:56:59',
                'updated_at' => '2020-01-04 14:56:59',
            ),
            73 => 
            array (
                'id' => 74,
                'usertype_id' => 5,
                'product_id' => 11,
                'price' => 14.5,
                'created_at' => '2020-01-04 14:56:59',
                'updated_at' => '2020-01-04 14:56:59',
            ),
            74 => 
            array (
                'id' => 75,
                'usertype_id' => 1,
                'product_id' => 12,
                'price' => 63.0,
                'created_at' => '2020-01-04 14:57:19',
                'updated_at' => '2020-01-04 14:57:19',
            ),
            75 => 
            array (
                'id' => 76,
                'usertype_id' => 2,
                'product_id' => 12,
                'price' => 58.0,
                'created_at' => '2020-01-04 14:57:19',
                'updated_at' => '2020-01-04 14:57:19',
            ),
            76 => 
            array (
                'id' => 77,
                'usertype_id' => 3,
                'product_id' => 12,
                'price' => 56.0,
                'created_at' => '2020-01-04 14:57:19',
                'updated_at' => '2020-01-04 14:57:19',
            ),
            77 => 
            array (
                'id' => 78,
                'usertype_id' => 4,
                'product_id' => 12,
                'price' => 55.0,
                'created_at' => '2020-01-04 14:57:19',
                'updated_at' => '2020-01-04 14:57:19',
            ),
            78 => 
            array (
                'id' => 79,
                'usertype_id' => 5,
                'product_id' => 12,
                'price' => 54.0,
                'created_at' => '2020-01-04 14:57:19',
                'updated_at' => '2020-01-04 14:57:19',
            ),
            79 => 
            array (
                'id' => 80,
                'usertype_id' => 1,
                'product_id' => 13,
                'price' => 32.0,
                'created_at' => '2020-01-04 14:57:40',
                'updated_at' => '2020-01-04 14:57:40',
            ),
            80 => 
            array (
                'id' => 81,
                'usertype_id' => 2,
                'product_id' => 13,
                'price' => 29.0,
                'created_at' => '2020-01-04 14:57:40',
                'updated_at' => '2020-01-04 14:57:40',
            ),
            81 => 
            array (
                'id' => 82,
                'usertype_id' => 3,
                'product_id' => 13,
                'price' => 28.0,
                'created_at' => '2020-01-04 14:57:40',
                'updated_at' => '2020-01-04 14:57:40',
            ),
            82 => 
            array (
                'id' => 83,
                'usertype_id' => 4,
                'product_id' => 13,
                'price' => 27.5,
                'created_at' => '2020-01-04 14:57:40',
                'updated_at' => '2020-01-04 14:57:40',
            ),
            83 => 
            array (
                'id' => 84,
                'usertype_id' => 5,
                'product_id' => 13,
                'price' => 27.0,
                'created_at' => '2020-01-04 14:57:40',
                'updated_at' => '2020-01-04 14:57:40',
            ),
            84 => 
            array (
                'id' => 85,
                'usertype_id' => 1,
                'product_id' => 14,
                'price' => 16.5,
                'created_at' => '2020-01-04 14:58:08',
                'updated_at' => '2020-01-04 14:58:08',
            ),
            85 => 
            array (
                'id' => 86,
                'usertype_id' => 2,
                'product_id' => 14,
                'price' => 14.75,
                'created_at' => '2020-01-04 14:58:08',
                'updated_at' => '2020-01-04 14:58:08',
            ),
            86 => 
            array (
                'id' => 87,
                'usertype_id' => 3,
                'product_id' => 14,
                'price' => 14.25,
                'created_at' => '2020-01-04 14:58:08',
                'updated_at' => '2020-01-04 14:58:08',
            ),
            87 => 
            array (
                'id' => 88,
                'usertype_id' => 4,
                'product_id' => 14,
                'price' => 14.0,
                'created_at' => '2020-01-04 14:58:08',
                'updated_at' => '2020-01-04 14:58:08',
            ),
            88 => 
            array (
                'id' => 89,
                'usertype_id' => 5,
                'product_id' => 14,
                'price' => 13.75,
                'created_at' => '2020-01-04 14:58:08',
                'updated_at' => '2020-01-04 14:58:08',
            ),
            89 => 
            array (
                'id' => 90,
                'usertype_id' => 1,
                'product_id' => 15,
                'price' => 70.0,
                'created_at' => '2020-01-04 14:58:59',
                'updated_at' => '2020-01-04 14:58:59',
            ),
            90 => 
            array (
                'id' => 91,
                'usertype_id' => 2,
                'product_id' => 15,
                'price' => 65.0,
                'created_at' => '2020-01-04 14:58:59',
                'updated_at' => '2020-01-04 14:58:59',
            ),
            91 => 
            array (
                'id' => 92,
                'usertype_id' => 3,
                'product_id' => 15,
                'price' => 63.0,
                'created_at' => '2020-01-04 14:58:59',
                'updated_at' => '2020-01-04 14:58:59',
            ),
            92 => 
            array (
                'id' => 93,
                'usertype_id' => 4,
                'product_id' => 15,
                'price' => 62.0,
                'created_at' => '2020-01-04 14:58:59',
                'updated_at' => '2020-01-04 14:58:59',
            ),
            93 => 
            array (
                'id' => 94,
                'usertype_id' => 5,
                'product_id' => 15,
                'price' => 61.0,
                'created_at' => '2020-01-04 14:58:59',
                'updated_at' => '2020-01-04 14:58:59',
            ),
            94 => 
            array (
                'id' => 95,
                'usertype_id' => 1,
                'product_id' => 16,
                'price' => 36.0,
                'created_at' => '2020-01-04 14:59:28',
                'updated_at' => '2020-01-04 14:59:28',
            ),
            95 => 
            array (
                'id' => 96,
                'usertype_id' => 2,
                'product_id' => 16,
                'price' => 32.5,
                'created_at' => '2020-01-04 14:59:28',
                'updated_at' => '2020-01-04 14:59:28',
            ),
            96 => 
            array (
                'id' => 97,
                'usertype_id' => 3,
                'product_id' => 16,
                'price' => 31.5,
                'created_at' => '2020-01-04 14:59:28',
                'updated_at' => '2020-01-04 14:59:28',
            ),
            97 => 
            array (
                'id' => 98,
                'usertype_id' => 4,
                'product_id' => 16,
                'price' => 31.0,
                'created_at' => '2020-01-04 14:59:28',
                'updated_at' => '2020-01-04 14:59:28',
            ),
            98 => 
            array (
                'id' => 99,
                'usertype_id' => 5,
                'product_id' => 16,
                'price' => 30.5,
                'created_at' => '2020-01-04 14:59:28',
                'updated_at' => '2020-01-04 14:59:28',
            ),
            99 => 
            array (
                'id' => 100,
                'usertype_id' => 1,
                'product_id' => 17,
                'price' => 240.0,
                'created_at' => '2020-01-04 15:00:05',
                'updated_at' => '2020-01-04 15:00:05',
            ),
            100 => 
            array (
                'id' => 101,
                'usertype_id' => 2,
                'product_id' => 17,
                'price' => 220.0,
                'created_at' => '2020-01-04 15:00:05',
                'updated_at' => '2020-01-04 15:00:05',
            ),
            101 => 
            array (
                'id' => 102,
                'usertype_id' => 3,
                'product_id' => 17,
                'price' => 210.0,
                'created_at' => '2020-01-04 15:00:05',
                'updated_at' => '2020-01-04 15:00:05',
            ),
            102 => 
            array (
                'id' => 103,
                'usertype_id' => 4,
                'product_id' => 17,
                'price' => 200.0,
                'created_at' => '2020-01-04 15:00:05',
                'updated_at' => '2020-01-04 15:00:05',
            ),
            103 => 
            array (
                'id' => 104,
                'usertype_id' => 5,
                'product_id' => 17,
                'price' => 200.0,
                'created_at' => '2020-01-04 15:00:05',
                'updated_at' => '2020-01-04 15:00:05',
            ),
            104 => 
            array (
                'id' => 105,
                'usertype_id' => 1,
                'product_id' => 18,
                'price' => 125.0,
                'created_at' => '2020-01-04 15:00:38',
                'updated_at' => '2020-01-04 15:00:38',
            ),
            105 => 
            array (
                'id' => 106,
                'usertype_id' => 2,
                'product_id' => 18,
                'price' => 115.0,
                'created_at' => '2020-01-04 15:00:38',
                'updated_at' => '2020-01-04 15:00:38',
            ),
            106 => 
            array (
                'id' => 107,
                'usertype_id' => 3,
                'product_id' => 18,
                'price' => 110.0,
                'created_at' => '2020-01-04 15:00:38',
                'updated_at' => '2020-01-04 15:00:38',
            ),
            107 => 
            array (
                'id' => 108,
                'usertype_id' => 4,
                'product_id' => 18,
                'price' => 105.0,
                'created_at' => '2020-01-04 15:00:38',
                'updated_at' => '2020-01-04 15:00:38',
            ),
            108 => 
            array (
                'id' => 109,
                'usertype_id' => 5,
                'product_id' => 18,
                'price' => 105.0,
                'created_at' => '2020-01-04 15:00:38',
                'updated_at' => '2020-01-04 15:00:38',
            ),
            109 => 
            array (
                'id' => 110,
                'usertype_id' => 1,
                'product_id' => 19,
                'price' => 180.0,
                'created_at' => '2020-01-04 15:01:21',
                'updated_at' => '2020-01-04 15:01:21',
            ),
            110 => 
            array (
                'id' => 111,
                'usertype_id' => 2,
                'product_id' => 19,
                'price' => 160.0,
                'created_at' => '2020-01-04 15:01:21',
                'updated_at' => '2020-01-04 15:01:21',
            ),
            111 => 
            array (
                'id' => 112,
                'usertype_id' => 3,
                'product_id' => 19,
                'price' => 150.0,
                'created_at' => '2020-01-04 15:01:22',
                'updated_at' => '2020-01-04 15:01:22',
            ),
            112 => 
            array (
                'id' => 113,
                'usertype_id' => 4,
                'product_id' => 19,
                'price' => 150.0,
                'created_at' => '2020-01-04 15:01:22',
                'updated_at' => '2020-01-04 15:01:22',
            ),
            113 => 
            array (
                'id' => 114,
                'usertype_id' => 5,
                'product_id' => 19,
                'price' => 150.0,
                'created_at' => '2020-01-04 15:01:22',
                'updated_at' => '2020-01-04 15:01:22',
            ),
            114 => 
            array (
                'id' => 115,
                'usertype_id' => 1,
                'product_id' => 20,
                'price' => 95.0,
                'created_at' => '2020-01-04 15:01:55',
                'updated_at' => '2020-01-04 15:01:55',
            ),
            115 => 
            array (
                'id' => 116,
                'usertype_id' => 2,
                'product_id' => 20,
                'price' => 85.0,
                'created_at' => '2020-01-04 15:01:55',
                'updated_at' => '2020-01-04 15:01:55',
            ),
            116 => 
            array (
                'id' => 117,
                'usertype_id' => 3,
                'product_id' => 20,
                'price' => 80.0,
                'created_at' => '2020-01-04 15:01:55',
                'updated_at' => '2020-01-04 15:01:55',
            ),
            117 => 
            array (
                'id' => 118,
                'usertype_id' => 4,
                'product_id' => 20,
                'price' => 80.0,
                'created_at' => '2020-01-04 15:01:55',
                'updated_at' => '2020-01-04 15:01:55',
            ),
            118 => 
            array (
                'id' => 119,
                'usertype_id' => 5,
                'product_id' => 20,
                'price' => 80.0,
                'created_at' => '2020-01-04 15:01:55',
                'updated_at' => '2020-01-04 15:01:55',
            ),
            119 => 
            array (
                'id' => 120,
                'usertype_id' => 1,
                'product_id' => 21,
                'price' => 250.0,
                'created_at' => '2020-01-04 15:02:36',
                'updated_at' => '2020-01-04 15:02:36',
            ),
            120 => 
            array (
                'id' => 121,
                'usertype_id' => 2,
                'product_id' => 21,
                'price' => 230.0,
                'created_at' => '2020-01-04 15:02:36',
                'updated_at' => '2020-01-04 15:02:36',
            ),
            121 => 
            array (
                'id' => 122,
                'usertype_id' => 3,
                'product_id' => 21,
                'price' => 225.0,
                'created_at' => '2020-01-04 15:02:36',
                'updated_at' => '2020-01-04 15:02:36',
            ),
            122 => 
            array (
                'id' => 123,
                'usertype_id' => 4,
                'product_id' => 21,
                'price' => 220.0,
                'created_at' => '2020-01-04 15:02:36',
                'updated_at' => '2020-01-04 15:02:36',
            ),
            123 => 
            array (
                'id' => 124,
                'usertype_id' => 5,
                'product_id' => 21,
                'price' => 220.0,
                'created_at' => '2020-01-04 15:02:36',
                'updated_at' => '2020-01-04 15:02:36',
            ),
            124 => 
            array (
                'id' => 125,
                'usertype_id' => 1,
                'product_id' => 22,
                'price' => 130.0,
                'created_at' => '2020-01-04 15:03:20',
                'updated_at' => '2020-01-04 15:03:20',
            ),
            125 => 
            array (
                'id' => 126,
                'usertype_id' => 2,
                'product_id' => 22,
                'price' => 120.0,
                'created_at' => '2020-01-04 15:03:20',
                'updated_at' => '2020-01-04 15:03:20',
            ),
            126 => 
            array (
                'id' => 127,
                'usertype_id' => 3,
                'product_id' => 22,
                'price' => 117.5,
                'created_at' => '2020-01-04 15:03:20',
                'updated_at' => '2020-01-04 15:03:20',
            ),
            127 => 
            array (
                'id' => 128,
                'usertype_id' => 4,
                'product_id' => 22,
                'price' => 115.0,
                'created_at' => '2020-01-04 15:03:20',
                'updated_at' => '2020-01-04 15:03:20',
            ),
            128 => 
            array (
                'id' => 129,
                'usertype_id' => 5,
                'product_id' => 22,
                'price' => 115.0,
                'created_at' => '2020-01-04 15:03:20',
                'updated_at' => '2020-01-04 15:03:20',
            ),
            129 => 
            array (
                'id' => 130,
                'usertype_id' => 1,
                'product_id' => 23,
                'price' => 130.0,
                'created_at' => '2020-01-04 15:04:01',
                'updated_at' => '2020-01-04 15:04:01',
            ),
            130 => 
            array (
                'id' => 131,
                'usertype_id' => 2,
                'product_id' => 23,
                'price' => 120.0,
                'created_at' => '2020-01-04 15:04:01',
                'updated_at' => '2020-01-04 15:04:01',
            ),
            131 => 
            array (
                'id' => 132,
                'usertype_id' => 3,
                'product_id' => 23,
                'price' => 120.0,
                'created_at' => '2020-01-04 15:04:01',
                'updated_at' => '2020-01-04 15:04:01',
            ),
            132 => 
            array (
                'id' => 133,
                'usertype_id' => 4,
                'product_id' => 23,
                'price' => 120.0,
                'created_at' => '2020-01-04 15:04:01',
                'updated_at' => '2020-01-04 15:04:01',
            ),
            133 => 
            array (
                'id' => 134,
                'usertype_id' => 5,
                'product_id' => 23,
                'price' => 120.0,
                'created_at' => '2020-01-04 15:04:01',
                'updated_at' => '2020-01-04 15:04:01',
            ),
            134 => 
            array (
                'id' => 135,
                'usertype_id' => 1,
                'product_id' => 24,
                'price' => 70.0,
                'created_at' => '2020-01-04 15:12:24',
                'updated_at' => '2020-01-04 15:12:24',
            ),
            135 => 
            array (
                'id' => 136,
                'usertype_id' => 2,
                'product_id' => 24,
                'price' => 65.0,
                'created_at' => '2020-01-04 15:12:24',
                'updated_at' => '2020-01-04 15:12:24',
            ),
            136 => 
            array (
                'id' => 137,
                'usertype_id' => 3,
                'product_id' => 24,
                'price' => 65.0,
                'created_at' => '2020-01-04 15:12:24',
                'updated_at' => '2020-01-04 15:12:24',
            ),
            137 => 
            array (
                'id' => 138,
                'usertype_id' => 4,
                'product_id' => 24,
                'price' => 65.0,
                'created_at' => '2020-01-04 15:12:24',
                'updated_at' => '2020-01-04 15:12:24',
            ),
            138 => 
            array (
                'id' => 139,
                'usertype_id' => 5,
                'product_id' => 24,
                'price' => 65.0,
                'created_at' => '2020-01-04 15:12:24',
                'updated_at' => '2020-01-04 15:12:24',
            ),
            139 => 
            array (
                'id' => 140,
                'usertype_id' => 1,
                'product_id' => 25,
                'price' => 170.0,
                'created_at' => '2020-01-04 15:13:25',
                'updated_at' => '2020-01-04 15:13:25',
            ),
            140 => 
            array (
                'id' => 141,
                'usertype_id' => 2,
                'product_id' => 25,
                'price' => 150.0,
                'created_at' => '2020-01-04 15:13:25',
                'updated_at' => '2020-01-04 15:13:25',
            ),
            141 => 
            array (
                'id' => 142,
                'usertype_id' => 3,
                'product_id' => 25,
                'price' => 150.0,
                'created_at' => '2020-01-04 15:13:25',
                'updated_at' => '2020-01-04 15:13:25',
            ),
            142 => 
            array (
                'id' => 143,
                'usertype_id' => 4,
                'product_id' => 25,
                'price' => 150.0,
                'created_at' => '2020-01-04 15:13:25',
                'updated_at' => '2020-01-04 15:13:25',
            ),
            143 => 
            array (
                'id' => 144,
                'usertype_id' => 5,
                'product_id' => 25,
                'price' => 150.0,
                'created_at' => '2020-01-04 15:13:25',
                'updated_at' => '2020-01-04 15:13:25',
            ),
            144 => 
            array (
                'id' => 145,
                'usertype_id' => 1,
                'product_id' => 26,
                'price' => 85.0,
                'created_at' => '2020-01-04 15:13:51',
                'updated_at' => '2020-01-04 15:13:51',
            ),
            145 => 
            array (
                'id' => 146,
                'usertype_id' => 2,
                'product_id' => 26,
                'price' => 75.0,
                'created_at' => '2020-01-04 15:13:51',
                'updated_at' => '2020-01-04 15:13:51',
            ),
            146 => 
            array (
                'id' => 147,
                'usertype_id' => 3,
                'product_id' => 26,
                'price' => 75.0,
                'created_at' => '2020-01-04 15:13:51',
                'updated_at' => '2020-01-04 15:13:51',
            ),
            147 => 
            array (
                'id' => 148,
                'usertype_id' => 4,
                'product_id' => 26,
                'price' => 75.0,
                'created_at' => '2020-01-04 15:13:51',
                'updated_at' => '2020-01-04 15:13:51',
            ),
            148 => 
            array (
                'id' => 149,
                'usertype_id' => 5,
                'product_id' => 26,
                'price' => 75.0,
                'created_at' => '2020-01-04 15:13:51',
                'updated_at' => '2020-01-04 15:13:51',
            ),
            149 => 
            array (
                'id' => 150,
                'usertype_id' => 1,
                'product_id' => 27,
                'price' => 45.0,
                'created_at' => '2020-01-04 15:14:05',
                'updated_at' => '2020-01-04 15:14:05',
            ),
            150 => 
            array (
                'id' => 151,
                'usertype_id' => 2,
                'product_id' => 27,
                'price' => 40.0,
                'created_at' => '2020-01-04 15:14:05',
                'updated_at' => '2020-01-04 15:14:05',
            ),
            151 => 
            array (
                'id' => 152,
                'usertype_id' => 3,
                'product_id' => 27,
                'price' => 40.0,
                'created_at' => '2020-01-04 15:14:05',
                'updated_at' => '2020-01-04 15:14:05',
            ),
            152 => 
            array (
                'id' => 153,
                'usertype_id' => 4,
                'product_id' => 27,
                'price' => 40.0,
                'created_at' => '2020-01-04 15:14:05',
                'updated_at' => '2020-01-04 15:14:05',
            ),
            153 => 
            array (
                'id' => 154,
                'usertype_id' => 5,
                'product_id' => 27,
                'price' => 40.0,
                'created_at' => '2020-01-04 15:14:05',
                'updated_at' => '2020-01-04 15:14:05',
            ),
            154 => 
            array (
                'id' => 155,
                'usertype_id' => 1,
                'product_id' => 28,
                'price' => 210.0,
                'created_at' => '2020-01-04 15:14:30',
                'updated_at' => '2020-01-04 15:14:30',
            ),
            155 => 
            array (
                'id' => 156,
                'usertype_id' => 2,
                'product_id' => 28,
                'price' => 190.0,
                'created_at' => '2020-01-04 15:14:30',
                'updated_at' => '2020-01-04 15:14:30',
            ),
            156 => 
            array (
                'id' => 157,
                'usertype_id' => 3,
                'product_id' => 28,
                'price' => 180.0,
                'created_at' => '2020-01-04 15:14:30',
                'updated_at' => '2020-01-04 15:14:30',
            ),
            157 => 
            array (
                'id' => 158,
                'usertype_id' => 4,
                'product_id' => 28,
                'price' => 180.0,
                'created_at' => '2020-01-04 15:14:30',
                'updated_at' => '2020-01-04 15:14:30',
            ),
            158 => 
            array (
                'id' => 159,
                'usertype_id' => 5,
                'product_id' => 28,
                'price' => 180.0,
                'created_at' => '2020-01-04 15:14:30',
                'updated_at' => '2020-01-04 15:14:30',
            ),
            159 => 
            array (
                'id' => 160,
                'usertype_id' => 1,
                'product_id' => 29,
                'price' => 105.0,
                'created_at' => '2020-01-04 15:36:26',
                'updated_at' => '2020-01-04 15:36:26',
            ),
            160 => 
            array (
                'id' => 161,
                'usertype_id' => 2,
                'product_id' => 29,
                'price' => 95.0,
                'created_at' => '2020-01-04 15:36:26',
                'updated_at' => '2020-01-04 15:36:26',
            ),
            161 => 
            array (
                'id' => 162,
                'usertype_id' => 3,
                'product_id' => 29,
                'price' => 90.0,
                'created_at' => '2020-01-04 15:36:26',
                'updated_at' => '2020-01-04 15:36:26',
            ),
            162 => 
            array (
                'id' => 163,
                'usertype_id' => 4,
                'product_id' => 29,
                'price' => 90.0,
                'created_at' => '2020-01-04 15:36:26',
                'updated_at' => '2020-01-04 15:36:26',
            ),
            163 => 
            array (
                'id' => 164,
                'usertype_id' => 5,
                'product_id' => 29,
                'price' => 90.0,
                'created_at' => '2020-01-04 15:36:26',
                'updated_at' => '2020-01-04 15:36:26',
            ),
            164 => 
            array (
                'id' => 165,
                'usertype_id' => 1,
                'product_id' => 30,
                'price' => 55.0,
                'created_at' => '2020-01-04 15:37:04',
                'updated_at' => '2020-01-04 15:37:04',
            ),
            165 => 
            array (
                'id' => 166,
                'usertype_id' => 2,
                'product_id' => 30,
                'price' => 50.0,
                'created_at' => '2020-01-04 15:37:04',
                'updated_at' => '2020-01-04 15:37:04',
            ),
            166 => 
            array (
                'id' => 167,
                'usertype_id' => 3,
                'product_id' => 30,
                'price' => 48.0,
                'created_at' => '2020-01-04 15:37:04',
                'updated_at' => '2020-01-04 15:37:04',
            ),
            167 => 
            array (
                'id' => 168,
                'usertype_id' => 4,
                'product_id' => 30,
                'price' => 48.0,
                'created_at' => '2020-01-04 15:37:04',
                'updated_at' => '2020-01-04 15:37:04',
            ),
            168 => 
            array (
                'id' => 169,
                'usertype_id' => 5,
                'product_id' => 30,
                'price' => 48.0,
                'created_at' => '2020-01-04 15:37:04',
                'updated_at' => '2020-01-04 15:37:04',
            ),
            169 => 
            array (
                'id' => 170,
                'usertype_id' => 1,
                'product_id' => 32,
                'price' => 36.0,
                'created_at' => '2020-01-04 15:41:55',
                'updated_at' => '2020-01-04 15:41:55',
            ),
            170 => 
            array (
                'id' => 171,
                'usertype_id' => 2,
                'product_id' => 32,
                'price' => 32.5,
                'created_at' => '2020-01-04 15:41:55',
                'updated_at' => '2020-01-04 15:41:55',
            ),
            171 => 
            array (
                'id' => 172,
                'usertype_id' => 3,
                'product_id' => 32,
                'price' => 31.5,
                'created_at' => '2020-01-04 15:41:55',
                'updated_at' => '2020-01-04 15:41:55',
            ),
            172 => 
            array (
                'id' => 173,
                'usertype_id' => 4,
                'product_id' => 32,
                'price' => 31.0,
                'created_at' => '2020-01-04 15:41:55',
                'updated_at' => '2020-01-04 15:41:55',
            ),
            173 => 
            array (
                'id' => 174,
                'usertype_id' => 5,
                'product_id' => 32,
                'price' => 30.5,
                'created_at' => '2020-01-04 15:41:55',
                'updated_at' => '2020-01-04 15:41:55',
            ),
            174 => 
            array (
                'id' => 175,
                'usertype_id' => 1,
                'product_id' => 33,
                'price' => 73.0,
                'created_at' => '2020-01-04 15:42:14',
                'updated_at' => '2020-01-04 15:42:14',
            ),
            175 => 
            array (
                'id' => 176,
                'usertype_id' => 2,
                'product_id' => 33,
                'price' => 68.0,
                'created_at' => '2020-01-04 15:42:14',
                'updated_at' => '2020-01-04 15:42:14',
            ),
            176 => 
            array (
                'id' => 177,
                'usertype_id' => 3,
                'product_id' => 33,
                'price' => 66.0,
                'created_at' => '2020-01-04 15:42:14',
                'updated_at' => '2020-01-04 15:42:14',
            ),
            177 => 
            array (
                'id' => 178,
                'usertype_id' => 4,
                'product_id' => 33,
                'price' => 65.0,
                'created_at' => '2020-01-04 15:42:14',
                'updated_at' => '2020-01-04 15:42:14',
            ),
            178 => 
            array (
                'id' => 179,
                'usertype_id' => 5,
                'product_id' => 33,
                'price' => 64.0,
                'created_at' => '2020-01-04 15:42:14',
                'updated_at' => '2020-01-04 15:42:14',
            ),
            179 => 
            array (
                'id' => 180,
                'usertype_id' => 1,
                'product_id' => 34,
                'price' => 37.0,
                'created_at' => '2020-01-04 15:42:36',
                'updated_at' => '2020-01-04 15:42:36',
            ),
            180 => 
            array (
                'id' => 181,
                'usertype_id' => 2,
                'product_id' => 34,
                'price' => 34.0,
                'created_at' => '2020-01-04 15:42:36',
                'updated_at' => '2020-01-04 15:42:36',
            ),
            181 => 
            array (
                'id' => 182,
                'usertype_id' => 3,
                'product_id' => 34,
                'price' => 33.0,
                'created_at' => '2020-01-04 15:42:36',
                'updated_at' => '2020-01-04 15:42:36',
            ),
            182 => 
            array (
                'id' => 183,
                'usertype_id' => 4,
                'product_id' => 34,
                'price' => 32.5,
                'created_at' => '2020-01-04 15:42:37',
                'updated_at' => '2020-01-04 15:42:37',
            ),
            183 => 
            array (
                'id' => 184,
                'usertype_id' => 5,
                'product_id' => 34,
                'price' => 32.0,
                'created_at' => '2020-01-04 15:42:37',
                'updated_at' => '2020-01-04 15:42:37',
            ),
            184 => 
            array (
                'id' => 185,
                'usertype_id' => 1,
                'product_id' => 35,
                'price' => 75.0,
                'created_at' => '2020-01-04 15:43:09',
                'updated_at' => '2020-01-04 15:43:09',
            ),
            185 => 
            array (
                'id' => 186,
                'usertype_id' => 2,
                'product_id' => 35,
                'price' => 69.0,
                'created_at' => '2020-01-04 15:43:09',
                'updated_at' => '2020-01-04 15:43:09',
            ),
            186 => 
            array (
                'id' => 187,
                'usertype_id' => 3,
                'product_id' => 35,
                'price' => 67.0,
                'created_at' => '2020-01-04 15:43:09',
                'updated_at' => '2020-01-04 15:43:09',
            ),
            187 => 
            array (
                'id' => 188,
                'usertype_id' => 4,
                'product_id' => 35,
                'price' => 66.0,
                'created_at' => '2020-01-04 15:43:09',
                'updated_at' => '2020-01-04 15:43:09',
            ),
            188 => 
            array (
                'id' => 189,
                'usertype_id' => 5,
                'product_id' => 35,
                'price' => 65.0,
                'created_at' => '2020-01-04 15:43:09',
                'updated_at' => '2020-01-04 15:43:09',
            ),
            189 => 
            array (
                'id' => 190,
                'usertype_id' => 1,
                'product_id' => 36,
                'price' => 38.0,
                'created_at' => '2020-01-04 15:43:40',
                'updated_at' => '2020-01-04 15:43:40',
            ),
            190 => 
            array (
                'id' => 191,
                'usertype_id' => 2,
                'product_id' => 36,
                'price' => 34.5,
                'created_at' => '2020-01-04 15:43:40',
                'updated_at' => '2020-01-04 15:43:40',
            ),
            191 => 
            array (
                'id' => 192,
                'usertype_id' => 3,
                'product_id' => 36,
                'price' => 33.5,
                'created_at' => '2020-01-04 15:43:40',
                'updated_at' => '2020-01-04 15:43:40',
            ),
            192 => 
            array (
                'id' => 193,
                'usertype_id' => 4,
                'product_id' => 36,
                'price' => 33.0,
                'created_at' => '2020-01-04 15:43:40',
                'updated_at' => '2020-01-04 15:43:40',
            ),
            193 => 
            array (
                'id' => 194,
                'usertype_id' => 5,
                'product_id' => 36,
                'price' => 32.5,
                'created_at' => '2020-01-04 15:43:40',
                'updated_at' => '2020-01-04 15:43:40',
            ),
            194 => 
            array (
                'id' => 195,
                'usertype_id' => 4,
                'product_id' => 37,
                'price' => 72.0,
                'created_at' => '2020-01-04 15:44:03',
                'updated_at' => '2020-01-04 15:44:03',
            ),
            195 => 
            array (
                'id' => 196,
                'usertype_id' => 5,
                'product_id' => 37,
                'price' => 72.0,
                'created_at' => '2020-01-04 15:44:03',
                'updated_at' => '2020-01-04 15:44:03',
            ),
            196 => 
            array (
                'id' => 197,
                'usertype_id' => 1,
                'product_id' => 38,
                'price' => 41.0,
                'created_at' => '2020-01-04 15:44:34',
                'updated_at' => '2020-01-04 15:44:34',
            ),
            197 => 
            array (
                'id' => 198,
                'usertype_id' => 2,
                'product_id' => 38,
                'price' => 37.5,
                'created_at' => '2020-01-04 15:44:34',
                'updated_at' => '2020-01-04 15:44:34',
            ),
            198 => 
            array (
                'id' => 199,
                'usertype_id' => 3,
                'product_id' => 38,
                'price' => 36.5,
                'created_at' => '2020-01-04 15:44:34',
                'updated_at' => '2020-01-04 15:44:34',
            ),
            199 => 
            array (
                'id' => 200,
                'usertype_id' => 4,
                'product_id' => 38,
                'price' => 36.0,
                'created_at' => '2020-01-04 15:44:34',
                'updated_at' => '2020-01-04 15:44:34',
            ),
            200 => 
            array (
                'id' => 201,
                'usertype_id' => 5,
                'product_id' => 38,
                'price' => 36.0,
                'created_at' => '2020-01-04 15:44:34',
                'updated_at' => '2020-01-04 15:44:34',
            ),
            201 => 
            array (
                'id' => 202,
                'usertype_id' => 1,
                'product_id' => 39,
                'price' => 85.0,
                'created_at' => '2020-01-04 15:45:35',
                'updated_at' => '2020-01-04 15:45:35',
            ),
            202 => 
            array (
                'id' => 203,
                'usertype_id' => 2,
                'product_id' => 39,
                'price' => 80.0,
                'created_at' => '2020-01-04 15:45:35',
                'updated_at' => '2020-01-04 15:45:35',
            ),
            203 => 
            array (
                'id' => 204,
                'usertype_id' => 3,
                'product_id' => 39,
                'price' => 89.0,
                'created_at' => '2020-01-04 15:45:35',
                'updated_at' => '2020-01-04 15:45:35',
            ),
            204 => 
            array (
                'id' => 205,
                'usertype_id' => 4,
                'product_id' => 39,
                'price' => 77.0,
                'created_at' => '2020-01-04 15:45:35',
                'updated_at' => '2020-01-04 15:45:35',
            ),
            205 => 
            array (
                'id' => 206,
                'usertype_id' => 5,
                'product_id' => 39,
                'price' => 77.0,
                'created_at' => '2020-01-04 15:45:35',
                'updated_at' => '2020-01-04 15:45:35',
            ),
            206 => 
            array (
                'id' => 207,
                'usertype_id' => 1,
                'product_id' => 40,
                'price' => 43.0,
                'created_at' => '2020-01-04 15:46:17',
                'updated_at' => '2020-01-04 15:46:17',
            ),
            207 => 
            array (
                'id' => 208,
                'usertype_id' => 2,
                'product_id' => 40,
                'price' => 40.0,
                'created_at' => '2020-01-04 15:46:17',
                'updated_at' => '2020-01-04 15:46:17',
            ),
            208 => 
            array (
                'id' => 209,
                'usertype_id' => 3,
                'product_id' => 40,
                'price' => 39.0,
                'created_at' => '2020-01-04 15:46:17',
                'updated_at' => '2020-01-04 15:46:17',
            ),
            209 => 
            array (
                'id' => 210,
                'usertype_id' => 4,
                'product_id' => 40,
                'price' => 38.5,
                'created_at' => '2020-01-04 15:46:17',
                'updated_at' => '2020-01-04 15:46:17',
            ),
            210 => 
            array (
                'id' => 211,
                'usertype_id' => 5,
                'product_id' => 40,
                'price' => 38.5,
                'created_at' => '2020-01-04 15:46:17',
                'updated_at' => '2020-01-04 15:46:17',
            ),
            211 => 
            array (
                'id' => 212,
                'usertype_id' => 1,
                'product_id' => 41,
                'price' => 78.0,
                'created_at' => '2020-01-04 15:46:37',
                'updated_at' => '2020-01-04 15:46:37',
            ),
            212 => 
            array (
                'id' => 213,
                'usertype_id' => 2,
                'product_id' => 41,
                'price' => 73.0,
                'created_at' => '2020-01-04 15:46:37',
                'updated_at' => '2020-01-04 15:46:37',
            ),
            213 => 
            array (
                'id' => 214,
                'usertype_id' => 3,
                'product_id' => 41,
                'price' => 71.0,
                'created_at' => '2020-01-04 15:46:37',
                'updated_at' => '2020-01-04 15:46:37',
            ),
            214 => 
            array (
                'id' => 215,
                'usertype_id' => 4,
                'product_id' => 41,
                'price' => 70.0,
                'created_at' => '2020-01-04 15:46:37',
                'updated_at' => '2020-01-04 15:46:37',
            ),
            215 => 
            array (
                'id' => 216,
                'usertype_id' => 5,
                'product_id' => 41,
                'price' => 69.0,
                'created_at' => '2020-01-04 15:46:37',
                'updated_at' => '2020-01-04 15:46:37',
            ),
            216 => 
            array (
                'id' => 217,
                'usertype_id' => 1,
                'product_id' => 42,
                'price' => 40.0,
                'created_at' => '2020-01-04 15:49:25',
                'updated_at' => '2020-01-04 15:49:25',
            ),
            217 => 
            array (
                'id' => 218,
                'usertype_id' => 2,
                'product_id' => 42,
                'price' => 36.5,
                'created_at' => '2020-01-04 15:49:25',
                'updated_at' => '2020-01-04 15:49:25',
            ),
            218 => 
            array (
                'id' => 219,
                'usertype_id' => 3,
                'product_id' => 42,
                'price' => 35.5,
                'created_at' => '2020-01-04 15:49:25',
                'updated_at' => '2020-01-04 15:49:25',
            ),
            219 => 
            array (
                'id' => 220,
                'usertype_id' => 4,
                'product_id' => 42,
                'price' => 35.0,
                'created_at' => '2020-01-04 15:49:25',
                'updated_at' => '2020-01-04 15:49:25',
            ),
            220 => 
            array (
                'id' => 221,
                'usertype_id' => 5,
                'product_id' => 42,
                'price' => 34.5,
                'created_at' => '2020-01-04 15:49:25',
                'updated_at' => '2020-01-04 15:49:25',
            ),
            221 => 
            array (
                'id' => 222,
                'usertype_id' => 1,
                'product_id' => 43,
                'price' => 75.0,
                'created_at' => '2020-01-04 15:49:52',
                'updated_at' => '2020-01-04 15:49:52',
            ),
            222 => 
            array (
                'id' => 223,
                'usertype_id' => 2,
                'product_id' => 43,
                'price' => 69.0,
                'created_at' => '2020-01-04 15:49:52',
                'updated_at' => '2020-01-04 15:49:52',
            ),
            223 => 
            array (
                'id' => 224,
                'usertype_id' => 3,
                'product_id' => 43,
                'price' => 67.0,
                'created_at' => '2020-01-04 15:49:52',
                'updated_at' => '2020-01-04 15:49:52',
            ),
            224 => 
            array (
                'id' => 225,
                'usertype_id' => 4,
                'product_id' => 43,
                'price' => 66.0,
                'created_at' => '2020-01-04 15:49:52',
                'updated_at' => '2020-01-04 15:49:52',
            ),
            225 => 
            array (
                'id' => 226,
                'usertype_id' => 5,
                'product_id' => 43,
                'price' => 65.0,
                'created_at' => '2020-01-04 15:49:52',
                'updated_at' => '2020-01-04 15:49:52',
            ),
            226 => 
            array (
                'id' => 227,
                'usertype_id' => 1,
                'product_id' => 44,
                'price' => 38.0,
                'created_at' => '2020-01-04 15:50:24',
                'updated_at' => '2020-01-04 15:50:24',
            ),
            227 => 
            array (
                'id' => 228,
                'usertype_id' => 2,
                'product_id' => 44,
                'price' => 34.5,
                'created_at' => '2020-01-04 15:50:24',
                'updated_at' => '2020-01-04 15:50:24',
            ),
            228 => 
            array (
                'id' => 229,
                'usertype_id' => 3,
                'product_id' => 44,
                'price' => 33.5,
                'created_at' => '2020-01-04 15:50:24',
                'updated_at' => '2020-01-04 15:50:24',
            ),
            229 => 
            array (
                'id' => 230,
                'usertype_id' => 4,
                'product_id' => 44,
                'price' => 33.0,
                'created_at' => '2020-01-04 15:50:24',
                'updated_at' => '2020-01-04 15:50:24',
            ),
            230 => 
            array (
                'id' => 231,
                'usertype_id' => 5,
                'product_id' => 44,
                'price' => 32.5,
                'created_at' => '2020-01-04 15:50:24',
                'updated_at' => '2020-01-04 15:50:24',
            ),
            231 => 
            array (
                'id' => 232,
                'usertype_id' => 1,
                'product_id' => 45,
                'price' => 85.0,
                'created_at' => '2020-01-04 15:50:40',
                'updated_at' => '2020-01-04 15:50:40',
            ),
            232 => 
            array (
                'id' => 233,
                'usertype_id' => 2,
                'product_id' => 45,
                'price' => 81.0,
                'created_at' => '2020-01-04 15:50:40',
                'updated_at' => '2020-01-04 15:50:40',
            ),
            233 => 
            array (
                'id' => 234,
                'usertype_id' => 3,
                'product_id' => 45,
                'price' => 80.0,
                'created_at' => '2020-01-04 15:50:40',
                'updated_at' => '2020-01-04 15:50:40',
            ),
            234 => 
            array (
                'id' => 235,
                'usertype_id' => 4,
                'product_id' => 45,
                'price' => 80.0,
                'created_at' => '2020-01-04 15:50:40',
                'updated_at' => '2020-01-04 15:50:40',
            ),
            235 => 
            array (
                'id' => 236,
                'usertype_id' => 5,
                'product_id' => 45,
                'price' => 80.0,
                'created_at' => '2020-01-04 15:50:40',
                'updated_at' => '2020-01-04 15:50:40',
            ),
            236 => 
            array (
                'id' => 237,
                'usertype_id' => 1,
                'product_id' => 46,
                'price' => 45.0,
                'created_at' => '2020-01-04 15:51:14',
                'updated_at' => '2020-01-04 15:51:14',
            ),
            237 => 
            array (
                'id' => 238,
                'usertype_id' => 2,
                'product_id' => 46,
                'price' => 40.5,
                'created_at' => '2020-01-04 15:51:14',
                'updated_at' => '2020-01-04 15:51:14',
            ),
            238 => 
            array (
                'id' => 239,
                'usertype_id' => 3,
                'product_id' => 46,
                'price' => 40.0,
                'created_at' => '2020-01-04 15:51:15',
                'updated_at' => '2020-01-04 15:51:15',
            ),
            239 => 
            array (
                'id' => 240,
                'usertype_id' => 4,
                'product_id' => 46,
                'price' => 40.0,
                'created_at' => '2020-01-04 15:51:15',
                'updated_at' => '2020-01-04 15:51:15',
            ),
            240 => 
            array (
                'id' => 241,
                'usertype_id' => 5,
                'product_id' => 46,
                'price' => 40.0,
                'created_at' => '2020-01-04 15:51:15',
                'updated_at' => '2020-01-04 15:51:15',
            ),
            241 => 
            array (
                'id' => 242,
                'usertype_id' => 1,
                'product_id' => 47,
                'price' => 60.0,
                'created_at' => '2020-01-04 15:51:45',
                'updated_at' => '2020-01-04 15:51:45',
            ),
            242 => 
            array (
                'id' => 243,
                'usertype_id' => 2,
                'product_id' => 47,
                'price' => 56.0,
                'created_at' => '2020-01-04 15:51:45',
                'updated_at' => '2020-01-04 15:51:45',
            ),
            243 => 
            array (
                'id' => 244,
                'usertype_id' => 3,
                'product_id' => 47,
                'price' => 55.0,
                'created_at' => '2020-01-04 15:51:45',
                'updated_at' => '2020-01-04 15:51:45',
            ),
            244 => 
            array (
                'id' => 245,
                'usertype_id' => 4,
                'product_id' => 47,
                'price' => 55.0,
                'created_at' => '2020-01-04 15:51:45',
                'updated_at' => '2020-01-04 15:51:45',
            ),
            245 => 
            array (
                'id' => 246,
                'usertype_id' => 5,
                'product_id' => 47,
                'price' => 55.0,
                'created_at' => '2020-01-04 15:51:45',
                'updated_at' => '2020-01-04 15:51:45',
            ),
            246 => 
            array (
                'id' => 247,
                'usertype_id' => 1,
                'product_id' => 48,
                'price' => 31.0,
                'created_at' => '2020-01-04 15:52:01',
                'updated_at' => '2020-01-04 15:52:01',
            ),
            247 => 
            array (
                'id' => 248,
                'usertype_id' => 2,
                'product_id' => 48,
                'price' => 28.0,
                'created_at' => '2020-01-04 15:52:02',
                'updated_at' => '2020-01-04 15:52:02',
            ),
            248 => 
            array (
                'id' => 249,
                'usertype_id' => 3,
                'product_id' => 48,
                'price' => 27.5,
                'created_at' => '2020-01-04 15:52:02',
                'updated_at' => '2020-01-04 15:52:02',
            ),
            249 => 
            array (
                'id' => 250,
                'usertype_id' => 4,
                'product_id' => 48,
                'price' => 27.5,
                'created_at' => '2020-01-04 15:52:02',
                'updated_at' => '2020-01-04 15:52:02',
            ),
            250 => 
            array (
                'id' => 251,
                'usertype_id' => 5,
                'product_id' => 48,
                'price' => 27.5,
                'created_at' => '2020-01-04 15:52:02',
                'updated_at' => '2020-01-04 15:52:02',
            ),
            251 => 
            array (
                'id' => 252,
                'usertype_id' => 1,
                'product_id' => 49,
                'price' => 30.0,
                'created_at' => '2020-01-04 15:52:21',
                'updated_at' => '2020-01-04 15:52:21',
            ),
            252 => 
            array (
                'id' => 253,
                'usertype_id' => 2,
                'product_id' => 49,
                'price' => 25.0,
                'created_at' => '2020-01-04 15:52:21',
                'updated_at' => '2020-01-04 15:52:21',
            ),
            253 => 
            array (
                'id' => 254,
                'usertype_id' => 3,
                'product_id' => 49,
                'price' => 25.0,
                'created_at' => '2020-01-04 15:52:21',
                'updated_at' => '2020-01-04 15:52:21',
            ),
            254 => 
            array (
                'id' => 255,
                'usertype_id' => 4,
                'product_id' => 49,
                'price' => 25.0,
                'created_at' => '2020-01-04 15:52:21',
                'updated_at' => '2020-01-04 15:52:21',
            ),
            255 => 
            array (
                'id' => 256,
                'usertype_id' => 5,
                'product_id' => 49,
                'price' => 25.0,
                'created_at' => '2020-01-04 15:52:21',
                'updated_at' => '2020-01-04 15:52:21',
            ),
            256 => 
            array (
                'id' => 257,
                'usertype_id' => 1,
                'product_id' => 50,
                'price' => 85.0,
                'created_at' => '2020-01-04 15:52:44',
                'updated_at' => '2020-01-04 15:52:44',
            ),
            257 => 
            array (
                'id' => 258,
                'usertype_id' => 2,
                'product_id' => 50,
                'price' => 81.0,
                'created_at' => '2020-01-04 15:52:44',
                'updated_at' => '2020-01-04 15:52:44',
            ),
            258 => 
            array (
                'id' => 259,
                'usertype_id' => 3,
                'product_id' => 50,
                'price' => 80.0,
                'created_at' => '2020-01-04 15:52:44',
                'updated_at' => '2020-01-04 15:52:44',
            ),
            259 => 
            array (
                'id' => 260,
                'usertype_id' => 4,
                'product_id' => 50,
                'price' => 80.0,
                'created_at' => '2020-01-04 15:52:44',
                'updated_at' => '2020-01-04 15:52:44',
            ),
            260 => 
            array (
                'id' => 261,
                'usertype_id' => 5,
                'product_id' => 50,
                'price' => 80.0,
                'created_at' => '2020-01-04 15:52:44',
                'updated_at' => '2020-01-04 15:52:44',
            ),
            261 => 
            array (
                'id' => 262,
                'usertype_id' => 1,
                'product_id' => 51,
                'price' => 45.0,
                'created_at' => '2020-01-04 15:53:08',
                'updated_at' => '2020-01-04 15:53:08',
            ),
            262 => 
            array (
                'id' => 263,
                'usertype_id' => 2,
                'product_id' => 51,
                'price' => 40.5,
                'created_at' => '2020-01-04 15:53:08',
                'updated_at' => '2020-01-04 15:53:08',
            ),
            263 => 
            array (
                'id' => 264,
                'usertype_id' => 3,
                'product_id' => 51,
                'price' => 40.0,
                'created_at' => '2020-01-04 15:53:08',
                'updated_at' => '2020-01-04 15:53:08',
            ),
            264 => 
            array (
                'id' => 265,
                'usertype_id' => 4,
                'product_id' => 51,
                'price' => 40.0,
                'created_at' => '2020-01-04 15:53:08',
                'updated_at' => '2020-01-04 15:53:08',
            ),
            265 => 
            array (
                'id' => 266,
                'usertype_id' => 5,
                'product_id' => 51,
                'price' => 40.0,
                'created_at' => '2020-01-04 15:53:08',
                'updated_at' => '2020-01-04 15:53:08',
            ),
            266 => 
            array (
                'id' => 267,
                'usertype_id' => 1,
                'product_id' => 52,
                'price' => 350.0,
                'created_at' => '2020-01-04 15:54:35',
                'updated_at' => '2020-01-04 15:54:35',
            ),
            267 => 
            array (
                'id' => 268,
                'usertype_id' => 2,
                'product_id' => 52,
                'price' => 330.0,
                'created_at' => '2020-01-04 15:54:35',
                'updated_at' => '2020-01-04 15:54:35',
            ),
            268 => 
            array (
                'id' => 269,
                'usertype_id' => 3,
                'product_id' => 52,
                'price' => 330.0,
                'created_at' => '2020-01-04 15:54:35',
                'updated_at' => '2020-01-04 15:54:35',
            ),
            269 => 
            array (
                'id' => 270,
                'usertype_id' => 4,
                'product_id' => 52,
                'price' => 330.0,
                'created_at' => '2020-01-04 15:54:35',
                'updated_at' => '2020-01-04 15:54:35',
            ),
            270 => 
            array (
                'id' => 271,
                'usertype_id' => 5,
                'product_id' => 52,
                'price' => 300.0,
                'created_at' => '2020-01-04 15:54:35',
                'updated_at' => '2020-01-04 15:54:35',
            ),
            271 => 
            array (
                'id' => 272,
                'usertype_id' => 1,
                'product_id' => 53,
                'price' => 70.0,
                'created_at' => '2020-01-04 15:57:16',
                'updated_at' => '2020-01-04 15:57:16',
            ),
            272 => 
            array (
                'id' => 273,
                'usertype_id' => 2,
                'product_id' => 53,
                'price' => 65.0,
                'created_at' => '2020-01-04 15:57:16',
                'updated_at' => '2020-01-04 15:57:16',
            ),
            273 => 
            array (
                'id' => 274,
                'usertype_id' => 3,
                'product_id' => 53,
                'price' => 65.0,
                'created_at' => '2020-01-04 15:57:16',
                'updated_at' => '2020-01-04 15:57:16',
            ),
            274 => 
            array (
                'id' => 275,
                'usertype_id' => 4,
                'product_id' => 53,
                'price' => 65.0,
                'created_at' => '2020-01-04 15:57:16',
                'updated_at' => '2020-01-04 15:57:16',
            ),
            275 => 
            array (
                'id' => 276,
                'usertype_id' => 5,
                'product_id' => 53,
                'price' => 65.0,
                'created_at' => '2020-01-04 15:57:16',
                'updated_at' => '2020-01-04 15:57:16',
            ),
            276 => 
            array (
                'id' => 277,
                'usertype_id' => 1,
                'product_id' => 54,
                'price' => 30.0,
                'created_at' => '2020-01-04 15:57:32',
                'updated_at' => '2020-01-04 15:57:32',
            ),
            277 => 
            array (
                'id' => 278,
                'usertype_id' => 2,
                'product_id' => 54,
                'price' => 25.0,
                'created_at' => '2020-01-04 15:57:32',
                'updated_at' => '2020-01-04 15:57:32',
            ),
            278 => 
            array (
                'id' => 279,
                'usertype_id' => 3,
                'product_id' => 54,
                'price' => 25.0,
                'created_at' => '2020-01-04 15:57:32',
                'updated_at' => '2020-01-04 15:57:32',
            ),
            279 => 
            array (
                'id' => 280,
                'usertype_id' => 4,
                'product_id' => 54,
                'price' => 25.0,
                'created_at' => '2020-01-04 15:57:32',
                'updated_at' => '2020-01-04 15:57:32',
            ),
            280 => 
            array (
                'id' => 281,
                'usertype_id' => 5,
                'product_id' => 54,
                'price' => 25.0,
                'created_at' => '2020-01-04 15:57:32',
                'updated_at' => '2020-01-04 15:57:32',
            ),
            281 => 
            array (
                'id' => 282,
                'usertype_id' => 1,
                'product_id' => 55,
                'price' => 25.0,
                'created_at' => '2020-01-04 15:57:46',
                'updated_at' => '2020-01-04 15:57:46',
            ),
            282 => 
            array (
                'id' => 283,
                'usertype_id' => 2,
                'product_id' => 55,
                'price' => 20.0,
                'created_at' => '2020-01-04 15:57:46',
                'updated_at' => '2020-01-04 15:57:46',
            ),
            283 => 
            array (
                'id' => 284,
                'usertype_id' => 3,
                'product_id' => 55,
                'price' => 20.0,
                'created_at' => '2020-01-04 15:57:46',
                'updated_at' => '2020-01-04 15:57:46',
            ),
            284 => 
            array (
                'id' => 285,
                'usertype_id' => 4,
                'product_id' => 55,
                'price' => 20.0,
                'created_at' => '2020-01-04 15:57:46',
                'updated_at' => '2020-01-04 15:57:46',
            ),
            285 => 
            array (
                'id' => 286,
                'usertype_id' => 5,
                'product_id' => 55,
                'price' => 20.0,
                'created_at' => '2020-01-04 15:57:46',
                'updated_at' => '2020-01-04 15:57:46',
            ),
            286 => 
            array (
                'id' => 287,
                'usertype_id' => 1,
                'product_id' => 56,
                'price' => 400.0,
                'created_at' => '2020-01-04 15:58:48',
                'updated_at' => '2020-01-04 15:58:48',
            ),
            287 => 
            array (
                'id' => 288,
                'usertype_id' => 2,
                'product_id' => 56,
                'price' => 400.0,
                'created_at' => '2020-01-04 15:58:48',
                'updated_at' => '2020-01-04 15:58:48',
            ),
            288 => 
            array (
                'id' => 289,
                'usertype_id' => 3,
                'product_id' => 56,
                'price' => 400.0,
                'created_at' => '2020-01-04 15:58:48',
                'updated_at' => '2020-01-04 15:58:48',
            ),
            289 => 
            array (
                'id' => 290,
                'usertype_id' => 4,
                'product_id' => 56,
                'price' => 400.0,
                'created_at' => '2020-01-04 15:58:48',
                'updated_at' => '2020-01-04 15:58:48',
            ),
            290 => 
            array (
                'id' => 291,
                'usertype_id' => 5,
                'product_id' => 56,
                'price' => 400.0,
                'created_at' => '2020-01-04 15:58:48',
                'updated_at' => '2020-01-04 15:58:48',
            ),
            291 => 
            array (
                'id' => 292,
                'usertype_id' => 1,
                'product_id' => 57,
                'price' => 365.0,
                'created_at' => '2020-01-04 15:59:12',
                'updated_at' => '2020-01-04 15:59:12',
            ),
            292 => 
            array (
                'id' => 293,
                'usertype_id' => 2,
                'product_id' => 57,
                'price' => 365.0,
                'created_at' => '2020-01-04 15:59:12',
                'updated_at' => '2020-01-04 15:59:12',
            ),
            293 => 
            array (
                'id' => 294,
                'usertype_id' => 3,
                'product_id' => 57,
                'price' => 365.0,
                'created_at' => '2020-01-04 15:59:12',
                'updated_at' => '2020-01-04 15:59:12',
            ),
            294 => 
            array (
                'id' => 295,
                'usertype_id' => 4,
                'product_id' => 57,
                'price' => 365.0,
                'created_at' => '2020-01-04 15:59:12',
                'updated_at' => '2020-01-04 15:59:12',
            ),
            295 => 
            array (
                'id' => 296,
                'usertype_id' => 5,
                'product_id' => 57,
                'price' => 365.0,
                'created_at' => '2020-01-04 15:59:12',
                'updated_at' => '2020-01-04 15:59:12',
            ),
            296 => 
            array (
                'id' => 297,
                'usertype_id' => 1,
                'product_id' => 58,
                'price' => 20.0,
                'created_at' => '2020-01-04 15:59:46',
                'updated_at' => '2020-01-04 15:59:46',
            ),
            297 => 
            array (
                'id' => 298,
                'usertype_id' => 2,
                'product_id' => 58,
                'price' => 15.0,
                'created_at' => '2020-01-04 15:59:46',
                'updated_at' => '2020-01-04 15:59:46',
            ),
            298 => 
            array (
                'id' => 299,
                'usertype_id' => 3,
                'product_id' => 58,
                'price' => 12.5,
                'created_at' => '2020-01-04 15:59:46',
                'updated_at' => '2020-01-04 15:59:46',
            ),
            299 => 
            array (
                'id' => 300,
                'usertype_id' => 4,
                'product_id' => 58,
                'price' => 12.5,
                'created_at' => '2020-01-04 15:59:46',
                'updated_at' => '2020-01-04 15:59:46',
            ),
            300 => 
            array (
                'id' => 301,
                'usertype_id' => 5,
                'product_id' => 58,
                'price' => 12.5,
                'created_at' => '2020-01-04 15:59:46',
                'updated_at' => '2020-01-04 15:59:46',
            ),
            301 => 
            array (
                'id' => 302,
                'usertype_id' => 1,
                'product_id' => 59,
                'price' => 55.0,
                'created_at' => '2020-01-04 16:00:13',
                'updated_at' => '2020-01-04 16:00:13',
            ),
            302 => 
            array (
                'id' => 303,
                'usertype_id' => 2,
                'product_id' => 59,
                'price' => 50.0,
                'created_at' => '2020-01-04 16:00:13',
                'updated_at' => '2020-01-04 16:00:13',
            ),
            303 => 
            array (
                'id' => 304,
                'usertype_id' => 3,
                'product_id' => 59,
                'price' => 50.0,
                'created_at' => '2020-01-04 16:00:13',
                'updated_at' => '2020-01-04 16:00:13',
            ),
            304 => 
            array (
                'id' => 305,
                'usertype_id' => 4,
                'product_id' => 59,
                'price' => 50.0,
                'created_at' => '2020-01-04 16:00:13',
                'updated_at' => '2020-01-04 16:00:13',
            ),
            305 => 
            array (
                'id' => 306,
                'usertype_id' => 5,
                'product_id' => 59,
                'price' => 50.0,
                'created_at' => '2020-01-04 16:00:13',
                'updated_at' => '2020-01-04 16:00:13',
            ),
            306 => 
            array (
                'id' => 307,
                'usertype_id' => 1,
                'product_id' => 61,
                'price' => 15.0,
                'created_at' => '2020-01-04 16:00:58',
                'updated_at' => '2020-01-04 16:00:58',
            ),
            307 => 
            array (
                'id' => 308,
                'usertype_id' => 2,
                'product_id' => 61,
                'price' => 12.5,
                'created_at' => '2020-01-04 16:00:58',
                'updated_at' => '2020-01-04 16:00:58',
            ),
            308 => 
            array (
                'id' => 309,
                'usertype_id' => 3,
                'product_id' => 61,
                'price' => 10.0,
                'created_at' => '2020-01-04 16:00:58',
                'updated_at' => '2020-01-04 16:00:58',
            ),
            309 => 
            array (
                'id' => 310,
                'usertype_id' => 4,
                'product_id' => 61,
                'price' => 10.0,
                'created_at' => '2020-01-04 16:00:58',
                'updated_at' => '2020-01-04 16:00:58',
            ),
            310 => 
            array (
                'id' => 311,
                'usertype_id' => 5,
                'product_id' => 61,
                'price' => 10.0,
                'created_at' => '2020-01-04 16:00:58',
                'updated_at' => '2020-01-04 16:00:58',
            ),
            311 => 
            array (
                'id' => 312,
                'usertype_id' => 1,
                'product_id' => 62,
                'price' => 15.0,
                'created_at' => '2020-01-04 16:01:14',
                'updated_at' => '2020-01-04 16:01:14',
            ),
            312 => 
            array (
                'id' => 313,
                'usertype_id' => 2,
                'product_id' => 62,
                'price' => 12.5,
                'created_at' => '2020-01-04 16:01:14',
                'updated_at' => '2020-01-04 16:01:14',
            ),
            313 => 
            array (
                'id' => 314,
                'usertype_id' => 3,
                'product_id' => 62,
                'price' => 10.0,
                'created_at' => '2020-01-04 16:01:14',
                'updated_at' => '2020-01-04 16:01:14',
            ),
            314 => 
            array (
                'id' => 315,
                'usertype_id' => 4,
                'product_id' => 62,
                'price' => 10.0,
                'created_at' => '2020-01-04 16:01:14',
                'updated_at' => '2020-01-04 16:01:14',
            ),
            315 => 
            array (
                'id' => 316,
                'usertype_id' => 5,
                'product_id' => 62,
                'price' => 10.0,
                'created_at' => '2020-01-04 16:01:14',
                'updated_at' => '2020-01-04 16:01:14',
            ),
            316 => 
            array (
                'id' => 317,
                'usertype_id' => 1,
                'product_id' => 63,
                'price' => 15.0,
                'created_at' => '2020-01-04 16:01:36',
                'updated_at' => '2020-01-04 16:01:36',
            ),
            317 => 
            array (
                'id' => 318,
                'usertype_id' => 2,
                'product_id' => 63,
                'price' => 12.5,
                'created_at' => '2020-01-04 16:01:36',
                'updated_at' => '2020-01-04 16:01:36',
            ),
            318 => 
            array (
                'id' => 319,
                'usertype_id' => 3,
                'product_id' => 63,
                'price' => 10.0,
                'created_at' => '2020-01-04 16:01:36',
                'updated_at' => '2020-01-04 16:01:36',
            ),
            319 => 
            array (
                'id' => 320,
                'usertype_id' => 4,
                'product_id' => 63,
                'price' => 10.0,
                'created_at' => '2020-01-04 16:01:36',
                'updated_at' => '2020-01-04 16:01:36',
            ),
            320 => 
            array (
                'id' => 321,
                'usertype_id' => 5,
                'product_id' => 63,
                'price' => 10.0,
                'created_at' => '2020-01-04 16:01:36',
                'updated_at' => '2020-01-04 16:01:36',
            ),
            321 => 
            array (
                'id' => 322,
                'usertype_id' => 4,
                'product_id' => 64,
                'price' => 10.0,
                'created_at' => '2020-01-04 16:02:00',
                'updated_at' => '2020-01-04 16:02:00',
            ),
            322 => 
            array (
                'id' => 323,
                'usertype_id' => 5,
                'product_id' => 64,
                'price' => 10.0,
                'created_at' => '2020-01-04 16:02:00',
                'updated_at' => '2020-01-04 16:02:00',
            ),
            323 => 
            array (
                'id' => 324,
                'usertype_id' => 1,
                'product_id' => 65,
                'price' => 30.0,
                'created_at' => '2020-01-04 16:03:03',
                'updated_at' => '2020-01-04 16:03:03',
            ),
            324 => 
            array (
                'id' => 325,
                'usertype_id' => 2,
                'product_id' => 65,
                'price' => 25.0,
                'created_at' => '2020-01-04 16:03:03',
                'updated_at' => '2020-01-04 16:03:03',
            ),
            325 => 
            array (
                'id' => 326,
                'usertype_id' => 3,
                'product_id' => 65,
                'price' => 25.0,
                'created_at' => '2020-01-04 16:03:03',
                'updated_at' => '2020-01-04 16:03:03',
            ),
            326 => 
            array (
                'id' => 327,
                'usertype_id' => 4,
                'product_id' => 65,
                'price' => 25.0,
                'created_at' => '2020-01-04 16:03:03',
                'updated_at' => '2020-01-04 16:03:03',
            ),
            327 => 
            array (
                'id' => 328,
                'usertype_id' => 5,
                'product_id' => 65,
                'price' => 25.0,
                'created_at' => '2020-01-04 16:03:03',
                'updated_at' => '2020-01-04 16:03:03',
            ),
            328 => 
            array (
                'id' => 329,
                'usertype_id' => 1,
                'product_id' => 66,
                'price' => 40.0,
                'created_at' => '2020-01-04 16:03:45',
                'updated_at' => '2020-01-04 16:03:45',
            ),
            329 => 
            array (
                'id' => 330,
                'usertype_id' => 2,
                'product_id' => 66,
                'price' => 35.0,
                'created_at' => '2020-01-04 16:03:45',
                'updated_at' => '2020-01-04 16:03:45',
            ),
            330 => 
            array (
                'id' => 331,
                'usertype_id' => 3,
                'product_id' => 66,
                'price' => 35.0,
                'created_at' => '2020-01-04 16:03:45',
                'updated_at' => '2020-01-04 16:03:45',
            ),
            331 => 
            array (
                'id' => 332,
                'usertype_id' => 4,
                'product_id' => 66,
                'price' => 35.0,
                'created_at' => '2020-01-04 16:03:45',
                'updated_at' => '2020-01-04 16:03:45',
            ),
            332 => 
            array (
                'id' => 333,
                'usertype_id' => 5,
                'product_id' => 66,
                'price' => 35.0,
                'created_at' => '2020-01-04 16:03:45',
                'updated_at' => '2020-01-04 16:03:45',
            ),
            333 => 
            array (
                'id' => 334,
                'usertype_id' => 1,
                'product_id' => 67,
                'price' => 40.0,
                'created_at' => '2020-01-04 16:04:08',
                'updated_at' => '2020-01-04 16:04:08',
            ),
            334 => 
            array (
                'id' => 335,
                'usertype_id' => 2,
                'product_id' => 67,
                'price' => 35.0,
                'created_at' => '2020-01-04 16:04:08',
                'updated_at' => '2020-01-04 16:04:08',
            ),
            335 => 
            array (
                'id' => 336,
                'usertype_id' => 3,
                'product_id' => 67,
                'price' => 35.0,
                'created_at' => '2020-01-04 16:04:08',
                'updated_at' => '2020-01-04 16:04:08',
            ),
            336 => 
            array (
                'id' => 337,
                'usertype_id' => 4,
                'product_id' => 67,
                'price' => 35.0,
                'created_at' => '2020-01-04 16:04:08',
                'updated_at' => '2020-01-04 16:04:08',
            ),
            337 => 
            array (
                'id' => 338,
                'usertype_id' => 5,
                'product_id' => 67,
                'price' => 35.0,
                'created_at' => '2020-01-04 16:04:08',
                'updated_at' => '2020-01-04 16:04:08',
            ),
            338 => 
            array (
                'id' => 339,
                'usertype_id' => 1,
                'product_id' => 68,
                'price' => 20.0,
                'created_at' => '2020-01-04 16:05:08',
                'updated_at' => '2020-01-04 16:05:08',
            ),
            339 => 
            array (
                'id' => 340,
                'usertype_id' => 2,
                'product_id' => 68,
                'price' => 15.0,
                'created_at' => '2020-01-04 16:05:08',
                'updated_at' => '2020-01-04 16:05:08',
            ),
            340 => 
            array (
                'id' => 341,
                'usertype_id' => 3,
                'product_id' => 68,
                'price' => 15.0,
                'created_at' => '2020-01-04 16:05:09',
                'updated_at' => '2020-01-04 16:05:09',
            ),
            341 => 
            array (
                'id' => 342,
                'usertype_id' => 4,
                'product_id' => 68,
                'price' => 15.0,
                'created_at' => '2020-01-04 16:05:09',
                'updated_at' => '2020-01-04 16:05:09',
            ),
            342 => 
            array (
                'id' => 343,
                'usertype_id' => 5,
                'product_id' => 68,
                'price' => 15.0,
                'created_at' => '2020-01-04 16:05:09',
                'updated_at' => '2020-01-04 16:05:09',
            ),
            343 => 
            array (
                'id' => 344,
                'usertype_id' => 1,
                'product_id' => 69,
                'price' => 55.0,
                'created_at' => '2020-01-04 16:32:09',
                'updated_at' => '2020-01-04 16:32:09',
            ),
            344 => 
            array (
                'id' => 345,
                'usertype_id' => 2,
                'product_id' => 69,
                'price' => 50.0,
                'created_at' => '2020-01-04 16:32:09',
                'updated_at' => '2020-01-04 16:32:09',
            ),
            345 => 
            array (
                'id' => 346,
                'usertype_id' => 3,
                'product_id' => 69,
                'price' => 50.0,
                'created_at' => '2020-01-04 16:32:09',
                'updated_at' => '2020-01-04 16:32:09',
            ),
            346 => 
            array (
                'id' => 347,
                'usertype_id' => 4,
                'product_id' => 69,
                'price' => 50.0,
                'created_at' => '2020-01-04 16:32:09',
                'updated_at' => '2020-01-04 16:32:09',
            ),
            347 => 
            array (
                'id' => 348,
                'usertype_id' => 5,
                'product_id' => 69,
                'price' => 50.0,
                'created_at' => '2020-01-04 16:32:09',
                'updated_at' => '2020-01-04 16:32:09',
            ),
            348 => 
            array (
                'id' => 349,
                'usertype_id' => 1,
                'product_id' => 70,
                'price' => 45.0,
                'created_at' => '2020-01-04 16:34:09',
                'updated_at' => '2020-01-04 16:34:09',
            ),
            349 => 
            array (
                'id' => 350,
                'usertype_id' => 2,
                'product_id' => 70,
                'price' => 41.0,
                'created_at' => '2020-01-04 16:34:09',
                'updated_at' => '2020-01-04 16:34:09',
            ),
            350 => 
            array (
                'id' => 351,
                'usertype_id' => 3,
                'product_id' => 70,
                'price' => 40.0,
                'created_at' => '2020-01-04 16:34:09',
                'updated_at' => '2020-01-04 16:34:09',
            ),
            351 => 
            array (
                'id' => 352,
                'usertype_id' => 4,
                'product_id' => 70,
                'price' => 40.0,
                'created_at' => '2020-01-04 16:34:09',
                'updated_at' => '2020-01-04 16:34:09',
            ),
            352 => 
            array (
                'id' => 353,
                'usertype_id' => 5,
                'product_id' => 70,
                'price' => 40.0,
                'created_at' => '2020-01-04 16:34:09',
                'updated_at' => '2020-01-04 16:34:09',
            ),
            353 => 
            array (
                'id' => 354,
                'usertype_id' => 1,
                'product_id' => 71,
                'price' => 340.0,
                'created_at' => '2020-01-04 16:34:33',
                'updated_at' => '2020-01-04 16:34:33',
            ),
            354 => 
            array (
                'id' => 355,
                'usertype_id' => 2,
                'product_id' => 71,
                'price' => 340.0,
                'created_at' => '2020-01-04 16:34:33',
                'updated_at' => '2020-01-04 16:34:33',
            ),
            355 => 
            array (
                'id' => 356,
                'usertype_id' => 3,
                'product_id' => 71,
                'price' => 340.0,
                'created_at' => '2020-01-04 16:34:33',
                'updated_at' => '2020-01-04 16:34:33',
            ),
            356 => 
            array (
                'id' => 357,
                'usertype_id' => 4,
                'product_id' => 71,
                'price' => 340.0,
                'created_at' => '2020-01-04 16:34:33',
                'updated_at' => '2020-01-04 16:34:33',
            ),
            357 => 
            array (
                'id' => 358,
                'usertype_id' => 5,
                'product_id' => 71,
                'price' => 340.0,
                'created_at' => '2020-01-04 16:34:33',
                'updated_at' => '2020-01-04 16:34:33',
            ),
            358 => 
            array (
                'id' => 359,
                'usertype_id' => 1,
                'product_id' => 72,
                'price' => 60.0,
                'created_at' => '2020-01-04 16:35:21',
                'updated_at' => '2020-01-04 16:35:21',
            ),
            359 => 
            array (
                'id' => 360,
                'usertype_id' => 2,
                'product_id' => 72,
                'price' => 52.0,
                'created_at' => '2020-01-04 16:35:21',
                'updated_at' => '2020-01-04 16:35:21',
            ),
            360 => 
            array (
                'id' => 361,
                'usertype_id' => 3,
                'product_id' => 72,
                'price' => 50.0,
                'created_at' => '2020-01-04 16:35:21',
                'updated_at' => '2020-01-04 16:35:21',
            ),
            361 => 
            array (
                'id' => 362,
                'usertype_id' => 4,
                'product_id' => 72,
                'price' => 49.0,
                'created_at' => '2020-01-04 16:35:21',
                'updated_at' => '2020-01-04 16:35:21',
            ),
            362 => 
            array (
                'id' => 363,
                'usertype_id' => 5,
                'product_id' => 72,
                'price' => 47.0,
                'created_at' => '2020-01-04 16:35:21',
                'updated_at' => '2020-01-04 16:35:21',
            ),
            363 => 
            array (
                'id' => 364,
                'usertype_id' => 4,
                'product_id' => 73,
                'price' => 24.5,
                'created_at' => '2020-01-04 16:35:38',
                'updated_at' => '2020-01-04 16:35:38',
            ),
            364 => 
            array (
                'id' => 365,
                'usertype_id' => 5,
                'product_id' => 73,
                'price' => 23.5,
                'created_at' => '2020-01-04 16:35:38',
                'updated_at' => '2020-01-04 16:35:38',
            ),
            365 => 
            array (
                'id' => 366,
                'usertype_id' => 1,
                'product_id' => 74,
                'price' => 15.5,
                'created_at' => '2020-01-04 16:36:03',
                'updated_at' => '2020-01-04 16:36:03',
            ),
            366 => 
            array (
                'id' => 367,
                'usertype_id' => 2,
                'product_id' => 74,
                'price' => 13.25,
                'created_at' => '2020-01-04 16:36:03',
                'updated_at' => '2020-01-04 16:36:03',
            ),
            367 => 
            array (
                'id' => 368,
                'usertype_id' => 3,
                'product_id' => 74,
                'price' => 12.75,
                'created_at' => '2020-01-04 16:36:03',
                'updated_at' => '2020-01-04 16:36:03',
            ),
            368 => 
            array (
                'id' => 369,
                'usertype_id' => 4,
                'product_id' => 74,
                'price' => 12.5,
                'created_at' => '2020-01-04 16:36:03',
                'updated_at' => '2020-01-04 16:36:03',
            ),
            369 => 
            array (
                'id' => 370,
                'usertype_id' => 5,
                'product_id' => 74,
                'price' => 12.25,
                'created_at' => '2020-01-04 16:36:03',
                'updated_at' => '2020-01-04 16:36:03',
            ),
            370 => 
            array (
                'id' => 371,
                'usertype_id' => 1,
                'product_id' => 75,
                'price' => 75.0,
                'created_at' => '2020-01-04 16:36:32',
                'updated_at' => '2020-01-04 16:36:32',
            ),
            371 => 
            array (
                'id' => 372,
                'usertype_id' => 2,
                'product_id' => 75,
                'price' => 69.0,
                'created_at' => '2020-01-04 16:36:32',
                'updated_at' => '2020-01-04 16:36:32',
            ),
            372 => 
            array (
                'id' => 373,
                'usertype_id' => 3,
                'product_id' => 75,
                'price' => 67.0,
                'created_at' => '2020-01-04 16:36:32',
                'updated_at' => '2020-01-04 16:36:32',
            ),
            373 => 
            array (
                'id' => 374,
                'usertype_id' => 4,
                'product_id' => 75,
                'price' => 65.0,
                'created_at' => '2020-01-04 16:36:32',
                'updated_at' => '2020-01-04 16:36:32',
            ),
            374 => 
            array (
                'id' => 375,
                'usertype_id' => 5,
                'product_id' => 75,
                'price' => 65.0,
                'created_at' => '2020-01-04 16:36:32',
                'updated_at' => '2020-01-04 16:36:32',
            ),
            375 => 
            array (
                'id' => 376,
                'usertype_id' => 1,
                'product_id' => 76,
                'price' => 38.0,
                'created_at' => '2020-01-04 16:36:52',
                'updated_at' => '2020-01-04 16:36:52',
            ),
            376 => 
            array (
                'id' => 377,
                'usertype_id' => 2,
                'product_id' => 76,
                'price' => 34.5,
                'created_at' => '2020-01-04 16:36:52',
                'updated_at' => '2020-01-04 16:36:52',
            ),
            377 => 
            array (
                'id' => 378,
                'usertype_id' => 3,
                'product_id' => 76,
                'price' => 33.5,
                'created_at' => '2020-01-04 16:36:52',
                'updated_at' => '2020-01-04 16:36:52',
            ),
            378 => 
            array (
                'id' => 379,
                'usertype_id' => 4,
                'product_id' => 76,
                'price' => 33.0,
                'created_at' => '2020-01-04 16:36:52',
                'updated_at' => '2020-01-04 16:36:52',
            ),
            379 => 
            array (
                'id' => 380,
                'usertype_id' => 5,
                'product_id' => 76,
                'price' => 32.5,
                'created_at' => '2020-01-04 16:36:52',
                'updated_at' => '2020-01-04 16:36:52',
            ),
            380 => 
            array (
                'id' => 381,
                'usertype_id' => 1,
                'product_id' => 77,
                'price' => 68.0,
                'created_at' => '2020-01-04 16:37:49',
                'updated_at' => '2020-01-04 16:37:49',
            ),
            381 => 
            array (
                'id' => 382,
                'usertype_id' => 2,
                'product_id' => 77,
                'price' => 62.0,
                'created_at' => '2020-01-04 16:37:49',
                'updated_at' => '2020-01-04 16:37:49',
            ),
            382 => 
            array (
                'id' => 383,
                'usertype_id' => 3,
                'product_id' => 77,
                'price' => 60.0,
                'created_at' => '2020-01-04 16:37:49',
                'updated_at' => '2020-01-04 16:37:49',
            ),
            383 => 
            array (
                'id' => 384,
                'usertype_id' => 4,
                'product_id' => 77,
                'price' => 59.0,
                'created_at' => '2020-01-04 16:37:49',
                'updated_at' => '2020-01-04 16:37:49',
            ),
            384 => 
            array (
                'id' => 385,
                'usertype_id' => 5,
                'product_id' => 77,
                'price' => 58.0,
                'created_at' => '2020-01-04 16:37:49',
                'updated_at' => '2020-01-04 16:37:49',
            ),
            385 => 
            array (
                'id' => 386,
                'usertype_id' => 1,
                'product_id' => 78,
                'price' => 35.0,
                'created_at' => '2020-01-04 16:38:22',
                'updated_at' => '2020-01-04 16:38:22',
            ),
            386 => 
            array (
                'id' => 387,
                'usertype_id' => 2,
                'product_id' => 78,
                'price' => 31.0,
                'created_at' => '2020-01-04 16:38:22',
                'updated_at' => '2020-01-04 16:38:22',
            ),
            387 => 
            array (
                'id' => 388,
                'usertype_id' => 3,
                'product_id' => 78,
                'price' => 30.0,
                'created_at' => '2020-01-04 16:38:22',
                'updated_at' => '2020-01-04 16:38:22',
            ),
            388 => 
            array (
                'id' => 389,
                'usertype_id' => 4,
                'product_id' => 78,
                'price' => 29.5,
                'created_at' => '2020-01-04 16:38:22',
                'updated_at' => '2020-01-04 16:38:22',
            ),
            389 => 
            array (
                'id' => 390,
                'usertype_id' => 5,
                'product_id' => 78,
                'price' => 29.0,
                'created_at' => '2020-01-04 16:38:22',
                'updated_at' => '2020-01-04 16:38:22',
            ),
            390 => 
            array (
                'id' => 391,
                'usertype_id' => 1,
                'product_id' => 79,
                'price' => 65.0,
                'created_at' => '2020-01-04 16:38:36',
                'updated_at' => '2020-01-04 16:38:36',
            ),
            391 => 
            array (
                'id' => 392,
                'usertype_id' => 2,
                'product_id' => 79,
                'price' => 59.0,
                'created_at' => '2020-01-04 16:38:36',
                'updated_at' => '2020-01-04 16:38:36',
            ),
            392 => 
            array (
                'id' => 393,
                'usertype_id' => 3,
                'product_id' => 79,
                'price' => 57.0,
                'created_at' => '2020-01-04 16:38:36',
                'updated_at' => '2020-01-04 16:38:36',
            ),
            393 => 
            array (
                'id' => 394,
                'usertype_id' => 4,
                'product_id' => 79,
                'price' => 56.0,
                'created_at' => '2020-01-04 16:38:36',
                'updated_at' => '2020-01-04 16:38:36',
            ),
            394 => 
            array (
                'id' => 395,
                'usertype_id' => 5,
                'product_id' => 79,
                'price' => 55.0,
                'created_at' => '2020-01-04 16:38:36',
                'updated_at' => '2020-01-04 16:38:36',
            ),
            395 => 
            array (
                'id' => 396,
                'usertype_id' => 1,
                'product_id' => 80,
                'price' => 33.0,
                'created_at' => '2020-01-04 16:39:02',
                'updated_at' => '2020-01-04 16:39:02',
            ),
            396 => 
            array (
                'id' => 397,
                'usertype_id' => 2,
                'product_id' => 80,
                'price' => 29.5,
                'created_at' => '2020-01-04 16:39:02',
                'updated_at' => '2020-01-04 16:39:02',
            ),
            397 => 
            array (
                'id' => 398,
                'usertype_id' => 3,
                'product_id' => 80,
                'price' => 28.5,
                'created_at' => '2020-01-04 16:39:02',
                'updated_at' => '2020-01-04 16:39:02',
            ),
            398 => 
            array (
                'id' => 399,
                'usertype_id' => 4,
                'product_id' => 80,
                'price' => 28.0,
                'created_at' => '2020-01-04 16:39:02',
                'updated_at' => '2020-01-04 16:39:02',
            ),
            399 => 
            array (
                'id' => 400,
                'usertype_id' => 5,
                'product_id' => 80,
                'price' => 27.5,
                'created_at' => '2020-01-04 16:39:02',
                'updated_at' => '2020-01-04 16:39:02',
            ),
            400 => 
            array (
                'id' => 401,
                'usertype_id' => 1,
                'product_id' => 81,
                'price' => 63.0,
                'created_at' => '2020-01-04 16:39:26',
                'updated_at' => '2020-01-04 16:39:26',
            ),
            401 => 
            array (
                'id' => 402,
                'usertype_id' => 2,
                'product_id' => 81,
                'price' => 57.0,
                'created_at' => '2020-01-04 16:39:26',
                'updated_at' => '2020-01-04 16:39:26',
            ),
            402 => 
            array (
                'id' => 403,
                'usertype_id' => 3,
                'product_id' => 81,
                'price' => 55.0,
                'created_at' => '2020-01-04 16:39:26',
                'updated_at' => '2020-01-04 16:39:26',
            ),
            403 => 
            array (
                'id' => 404,
                'usertype_id' => 4,
                'product_id' => 81,
                'price' => 54.0,
                'created_at' => '2020-01-04 16:39:26',
                'updated_at' => '2020-01-04 16:39:26',
            ),
            404 => 
            array (
                'id' => 405,
                'usertype_id' => 5,
                'product_id' => 81,
                'price' => 53.0,
                'created_at' => '2020-01-04 16:39:26',
                'updated_at' => '2020-01-04 16:39:26',
            ),
            405 => 
            array (
                'id' => 406,
                'usertype_id' => 1,
                'product_id' => 82,
                'price' => 32.0,
                'created_at' => '2020-01-04 16:39:44',
                'updated_at' => '2020-01-04 16:39:44',
            ),
            406 => 
            array (
                'id' => 407,
                'usertype_id' => 2,
                'product_id' => 82,
                'price' => 28.5,
                'created_at' => '2020-01-04 16:39:44',
                'updated_at' => '2020-01-04 16:39:44',
            ),
            407 => 
            array (
                'id' => 408,
                'usertype_id' => 3,
                'product_id' => 82,
                'price' => 27.5,
                'created_at' => '2020-01-04 16:39:44',
                'updated_at' => '2020-01-04 16:39:44',
            ),
            408 => 
            array (
                'id' => 409,
                'usertype_id' => 4,
                'product_id' => 82,
                'price' => 27.0,
                'created_at' => '2020-01-04 16:39:44',
                'updated_at' => '2020-01-04 16:39:44',
            ),
            409 => 
            array (
                'id' => 410,
                'usertype_id' => 5,
                'product_id' => 82,
                'price' => 26.5,
                'created_at' => '2020-01-04 16:39:44',
                'updated_at' => '2020-01-04 16:39:44',
            ),
            410 => 
            array (
                'id' => 411,
                'usertype_id' => 1,
                'product_id' => 83,
                'price' => 70.0,
                'created_at' => '2020-01-04 16:40:32',
                'updated_at' => '2020-01-04 16:40:32',
            ),
            411 => 
            array (
                'id' => 412,
                'usertype_id' => 2,
                'product_id' => 83,
                'price' => 64.0,
                'created_at' => '2020-01-04 16:40:32',
                'updated_at' => '2020-01-04 16:40:32',
            ),
            412 => 
            array (
                'id' => 413,
                'usertype_id' => 3,
                'product_id' => 83,
                'price' => 62.0,
                'created_at' => '2020-01-04 16:40:33',
                'updated_at' => '2020-01-04 16:40:33',
            ),
            413 => 
            array (
                'id' => 414,
                'usertype_id' => 4,
                'product_id' => 83,
                'price' => 61.0,
                'created_at' => '2020-01-04 16:40:33',
                'updated_at' => '2020-01-04 16:40:33',
            ),
            414 => 
            array (
                'id' => 415,
                'usertype_id' => 5,
                'product_id' => 83,
                'price' => 60.0,
                'created_at' => '2020-01-04 16:40:33',
                'updated_at' => '2020-01-04 16:40:33',
            ),
            415 => 
            array (
                'id' => 416,
                'usertype_id' => 1,
                'product_id' => 84,
                'price' => 36.0,
                'created_at' => '2020-01-04 16:41:31',
                'updated_at' => '2020-01-04 16:41:31',
            ),
            416 => 
            array (
                'id' => 417,
                'usertype_id' => 2,
                'product_id' => 84,
                'price' => 32.0,
                'created_at' => '2020-01-04 16:41:31',
                'updated_at' => '2020-01-04 16:41:31',
            ),
            417 => 
            array (
                'id' => 418,
                'usertype_id' => 3,
                'product_id' => 84,
                'price' => 31.0,
                'created_at' => '2020-01-04 16:41:31',
                'updated_at' => '2020-01-04 16:41:31',
            ),
            418 => 
            array (
                'id' => 419,
                'usertype_id' => 4,
                'product_id' => 84,
                'price' => 30.5,
                'created_at' => '2020-01-04 16:41:31',
                'updated_at' => '2020-01-04 16:41:31',
            ),
            419 => 
            array (
                'id' => 420,
                'usertype_id' => 5,
                'product_id' => 84,
                'price' => 30.0,
                'created_at' => '2020-01-04 16:41:31',
                'updated_at' => '2020-01-04 16:41:31',
            ),
            420 => 
            array (
                'id' => 421,
                'usertype_id' => 1,
                'product_id' => 85,
                'price' => 80.0,
                'created_at' => '2020-01-04 16:42:00',
                'updated_at' => '2020-01-04 16:42:00',
            ),
            421 => 
            array (
                'id' => 422,
                'usertype_id' => 2,
                'product_id' => 85,
                'price' => 78.0,
                'created_at' => '2020-01-04 16:42:00',
                'updated_at' => '2020-01-04 16:42:00',
            ),
            422 => 
            array (
                'id' => 423,
                'usertype_id' => 3,
                'product_id' => 85,
                'price' => 76.0,
                'created_at' => '2020-01-04 16:42:00',
                'updated_at' => '2020-01-04 16:42:00',
            ),
            423 => 
            array (
                'id' => 424,
                'usertype_id' => 4,
                'product_id' => 85,
                'price' => 75.0,
                'created_at' => '2020-01-04 16:42:00',
                'updated_at' => '2020-01-04 16:42:07',
            ),
            424 => 
            array (
                'id' => 425,
                'usertype_id' => 5,
                'product_id' => 85,
                'price' => 74.0,
                'created_at' => '2020-01-04 16:42:00',
                'updated_at' => '2020-01-04 16:42:00',
            ),
            425 => 
            array (
                'id' => 426,
                'usertype_id' => 1,
                'product_id' => 86,
                'price' => 41.0,
                'created_at' => '2020-01-04 16:42:26',
                'updated_at' => '2020-01-04 16:42:26',
            ),
            426 => 
            array (
                'id' => 427,
                'usertype_id' => 2,
                'product_id' => 86,
                'price' => 39.0,
                'created_at' => '2020-01-04 16:42:26',
                'updated_at' => '2020-01-04 16:42:26',
            ),
            427 => 
            array (
                'id' => 428,
                'usertype_id' => 3,
                'product_id' => 86,
                'price' => 38.0,
                'created_at' => '2020-01-04 16:42:26',
                'updated_at' => '2020-01-04 16:42:26',
            ),
            428 => 
            array (
                'id' => 429,
                'usertype_id' => 4,
                'product_id' => 86,
                'price' => 37.5,
                'created_at' => '2020-01-04 16:42:26',
                'updated_at' => '2020-01-04 16:42:26',
            ),
            429 => 
            array (
                'id' => 430,
                'usertype_id' => 5,
                'product_id' => 86,
                'price' => 37.0,
                'created_at' => '2020-01-04 16:42:26',
                'updated_at' => '2020-01-04 16:42:26',
            ),
            430 => 
            array (
                'id' => 431,
                'usertype_id' => 1,
                'product_id' => 87,
                'price' => 325.0,
                'created_at' => '2020-01-04 16:42:47',
                'updated_at' => '2020-01-04 16:42:47',
            ),
            431 => 
            array (
                'id' => 432,
                'usertype_id' => 2,
                'product_id' => 87,
                'price' => 325.0,
                'created_at' => '2020-01-04 16:42:47',
                'updated_at' => '2020-01-04 16:42:47',
            ),
            432 => 
            array (
                'id' => 433,
                'usertype_id' => 3,
                'product_id' => 87,
                'price' => 325.0,
                'created_at' => '2020-01-04 16:42:47',
                'updated_at' => '2020-01-04 16:42:47',
            ),
            433 => 
            array (
                'id' => 434,
                'usertype_id' => 4,
                'product_id' => 87,
                'price' => 325.0,
                'created_at' => '2020-01-04 16:42:47',
                'updated_at' => '2020-01-04 16:42:47',
            ),
            434 => 
            array (
                'id' => 435,
                'usertype_id' => 5,
                'product_id' => 87,
                'price' => 325.0,
                'created_at' => '2020-01-04 16:42:47',
                'updated_at' => '2020-01-04 16:42:47',
            ),
            435 => 
            array (
                'id' => 436,
                'usertype_id' => 1,
                'product_id' => 88,
                'price' => 550.0,
                'created_at' => '2020-01-04 16:43:16',
                'updated_at' => '2020-01-04 16:43:16',
            ),
            436 => 
            array (
                'id' => 437,
                'usertype_id' => 2,
                'product_id' => 88,
                'price' => 510.0,
                'created_at' => '2020-01-04 16:43:16',
                'updated_at' => '2020-01-04 16:43:16',
            ),
            437 => 
            array (
                'id' => 438,
                'usertype_id' => 3,
                'product_id' => 88,
                'price' => 500.0,
                'created_at' => '2020-01-04 16:43:16',
                'updated_at' => '2020-01-04 16:43:16',
            ),
            438 => 
            array (
                'id' => 439,
                'usertype_id' => 4,
                'product_id' => 88,
                'price' => 500.0,
                'created_at' => '2020-01-04 16:43:16',
                'updated_at' => '2020-01-04 16:43:16',
            ),
            439 => 
            array (
                'id' => 440,
                'usertype_id' => 5,
                'product_id' => 88,
                'price' => 500.0,
                'created_at' => '2020-01-04 16:43:16',
                'updated_at' => '2020-01-04 16:43:16',
            ),
            440 => 
            array (
                'id' => 441,
                'usertype_id' => 1,
                'product_id' => 89,
                'price' => 285.0,
                'created_at' => '2020-01-04 16:45:07',
                'updated_at' => '2020-01-04 16:45:07',
            ),
            441 => 
            array (
                'id' => 442,
                'usertype_id' => 2,
                'product_id' => 89,
                'price' => 235.0,
                'created_at' => '2020-01-04 16:45:07',
                'updated_at' => '2020-01-04 16:45:07',
            ),
            442 => 
            array (
                'id' => 443,
                'usertype_id' => 3,
                'product_id' => 89,
                'price' => 230.0,
                'created_at' => '2020-01-04 16:45:07',
                'updated_at' => '2020-01-04 16:45:07',
            ),
            443 => 
            array (
                'id' => 444,
                'usertype_id' => 4,
                'product_id' => 89,
                'price' => 230.0,
                'created_at' => '2020-01-04 16:45:07',
                'updated_at' => '2020-01-04 16:45:07',
            ),
            444 => 
            array (
                'id' => 445,
                'usertype_id' => 5,
                'product_id' => 89,
                'price' => 230.0,
                'created_at' => '2020-01-04 16:45:07',
                'updated_at' => '2020-01-04 16:45:07',
            ),
            445 => 
            array (
                'id' => 446,
                'usertype_id' => 1,
                'product_id' => 90,
                'price' => 700.0,
                'created_at' => '2020-01-04 16:45:37',
                'updated_at' => '2020-01-04 16:45:37',
            ),
            446 => 
            array (
                'id' => 447,
                'usertype_id' => 2,
                'product_id' => 90,
                'price' => 660.0,
                'created_at' => '2020-01-04 16:45:37',
                'updated_at' => '2020-01-04 16:45:37',
            ),
            447 => 
            array (
                'id' => 448,
                'usertype_id' => 3,
                'product_id' => 90,
                'price' => 650.0,
                'created_at' => '2020-01-04 16:45:37',
                'updated_at' => '2020-01-04 16:45:37',
            ),
            448 => 
            array (
                'id' => 449,
                'usertype_id' => 4,
                'product_id' => 90,
                'price' => 650.0,
                'created_at' => '2020-01-04 16:45:37',
                'updated_at' => '2020-01-04 16:45:37',
            ),
            449 => 
            array (
                'id' => 450,
                'usertype_id' => 5,
                'product_id' => 90,
                'price' => 650.0,
                'created_at' => '2020-01-04 16:45:37',
                'updated_at' => '2020-01-04 16:45:37',
            ),
            450 => 
            array (
                'id' => 451,
                'usertype_id' => 1,
                'product_id' => 91,
                'price' => 360.0,
                'created_at' => '2020-01-04 16:46:03',
                'updated_at' => '2020-01-04 16:46:03',
            ),
            451 => 
            array (
                'id' => 452,
                'usertype_id' => 2,
                'product_id' => 91,
                'price' => 335.0,
                'created_at' => '2020-01-04 16:46:03',
                'updated_at' => '2020-01-04 16:46:03',
            ),
            452 => 
            array (
                'id' => 453,
                'usertype_id' => 3,
                'product_id' => 91,
                'price' => 330.0,
                'created_at' => '2020-01-04 16:46:03',
                'updated_at' => '2020-01-04 16:46:03',
            ),
            453 => 
            array (
                'id' => 454,
                'usertype_id' => 4,
                'product_id' => 91,
                'price' => 330.0,
                'created_at' => '2020-01-04 16:46:03',
                'updated_at' => '2020-01-04 16:46:03',
            ),
            454 => 
            array (
                'id' => 455,
                'usertype_id' => 5,
                'product_id' => 91,
                'price' => 330.0,
                'created_at' => '2020-01-04 16:46:03',
                'updated_at' => '2020-01-04 16:46:03',
            ),
            455 => 
            array (
                'id' => 456,
                'usertype_id' => 1,
                'product_id' => 92,
                'price' => 40.0,
                'created_at' => '2020-01-04 16:46:22',
                'updated_at' => '2020-01-04 16:46:22',
            ),
            456 => 
            array (
                'id' => 457,
                'usertype_id' => 2,
                'product_id' => 92,
                'price' => 35.0,
                'created_at' => '2020-01-04 16:46:22',
                'updated_at' => '2020-01-04 16:46:22',
            ),
            457 => 
            array (
                'id' => 458,
                'usertype_id' => 3,
                'product_id' => 92,
                'price' => 35.0,
                'created_at' => '2020-01-04 16:46:22',
                'updated_at' => '2020-01-04 16:46:22',
            ),
            458 => 
            array (
                'id' => 459,
                'usertype_id' => 4,
                'product_id' => 92,
                'price' => 35.0,
                'created_at' => '2020-01-04 16:46:22',
                'updated_at' => '2020-01-04 16:46:22',
            ),
            459 => 
            array (
                'id' => 460,
                'usertype_id' => 5,
                'product_id' => 92,
                'price' => 35.0,
                'created_at' => '2020-01-04 16:46:22',
                'updated_at' => '2020-01-04 16:46:22',
            ),
            460 => 
            array (
                'id' => 461,
                'usertype_id' => 1,
                'product_id' => 93,
                'price' => 25.0,
                'created_at' => '2020-01-04 16:48:00',
                'updated_at' => '2020-01-04 16:48:00',
            ),
            461 => 
            array (
                'id' => 462,
                'usertype_id' => 2,
                'product_id' => 93,
                'price' => 22.5,
                'created_at' => '2020-01-04 16:48:00',
                'updated_at' => '2020-01-04 16:48:00',
            ),
            462 => 
            array (
                'id' => 463,
                'usertype_id' => 3,
                'product_id' => 93,
                'price' => 20.0,
                'created_at' => '2020-01-04 16:48:00',
                'updated_at' => '2020-01-04 16:48:00',
            ),
            463 => 
            array (
                'id' => 464,
                'usertype_id' => 4,
                'product_id' => 93,
                'price' => 20.0,
                'created_at' => '2020-01-04 16:48:00',
                'updated_at' => '2020-01-04 16:48:00',
            ),
            464 => 
            array (
                'id' => 465,
                'usertype_id' => 5,
                'product_id' => 93,
                'price' => 20.0,
                'created_at' => '2020-01-04 16:48:00',
                'updated_at' => '2020-01-04 16:48:00',
            ),
            465 => 
            array (
                'id' => 466,
                'usertype_id' => 1,
                'product_id' => 94,
                'price' => 35.0,
                'created_at' => '2020-01-04 16:48:16',
                'updated_at' => '2020-01-04 16:48:16',
            ),
            466 => 
            array (
                'id' => 467,
                'usertype_id' => 2,
                'product_id' => 94,
                'price' => 30.0,
                'created_at' => '2020-01-04 16:48:16',
                'updated_at' => '2020-01-04 16:48:16',
            ),
            467 => 
            array (
                'id' => 468,
                'usertype_id' => 3,
                'product_id' => 94,
                'price' => 30.0,
                'created_at' => '2020-01-04 16:48:16',
                'updated_at' => '2020-01-04 16:48:16',
            ),
            468 => 
            array (
                'id' => 469,
                'usertype_id' => 4,
                'product_id' => 94,
                'price' => 30.0,
                'created_at' => '2020-01-04 16:48:16',
                'updated_at' => '2020-01-04 16:48:16',
            ),
            469 => 
            array (
                'id' => 470,
                'usertype_id' => 5,
                'product_id' => 94,
                'price' => 30.0,
                'created_at' => '2020-01-04 16:48:16',
                'updated_at' => '2020-01-04 16:48:16',
            ),
            470 => 
            array (
                'id' => 471,
                'usertype_id' => 1,
                'product_id' => 95,
                'price' => 45.0,
                'created_at' => '2020-01-04 16:48:32',
                'updated_at' => '2020-01-04 16:48:32',
            ),
            471 => 
            array (
                'id' => 472,
                'usertype_id' => 2,
                'product_id' => 95,
                'price' => 40.0,
                'created_at' => '2020-01-04 16:48:32',
                'updated_at' => '2020-01-04 16:48:32',
            ),
            472 => 
            array (
                'id' => 473,
                'usertype_id' => 3,
                'product_id' => 95,
                'price' => 40.0,
                'created_at' => '2020-01-04 16:48:32',
                'updated_at' => '2020-01-04 16:48:32',
            ),
            473 => 
            array (
                'id' => 474,
                'usertype_id' => 4,
                'product_id' => 95,
                'price' => 40.0,
                'created_at' => '2020-01-04 16:48:32',
                'updated_at' => '2020-01-04 16:48:32',
            ),
            474 => 
            array (
                'id' => 475,
                'usertype_id' => 5,
                'product_id' => 95,
                'price' => 40.0,
                'created_at' => '2020-01-04 16:48:32',
                'updated_at' => '2020-01-04 16:48:32',
            ),
            475 => 
            array (
                'id' => 476,
                'usertype_id' => 1,
                'product_id' => 96,
                'price' => 40.0,
                'created_at' => '2020-01-04 16:49:09',
                'updated_at' => '2020-01-04 16:49:09',
            ),
            476 => 
            array (
                'id' => 477,
                'usertype_id' => 2,
                'product_id' => 96,
                'price' => 35.0,
                'created_at' => '2020-01-04 16:49:09',
                'updated_at' => '2020-01-04 16:49:09',
            ),
            477 => 
            array (
                'id' => 478,
                'usertype_id' => 3,
                'product_id' => 96,
                'price' => 35.0,
                'created_at' => '2020-01-04 16:49:09',
                'updated_at' => '2020-01-04 16:49:09',
            ),
            478 => 
            array (
                'id' => 479,
                'usertype_id' => 4,
                'product_id' => 96,
                'price' => 35.0,
                'created_at' => '2020-01-04 16:49:09',
                'updated_at' => '2020-01-04 16:49:09',
            ),
            479 => 
            array (
                'id' => 480,
                'usertype_id' => 5,
                'product_id' => 96,
                'price' => 35.0,
                'created_at' => '2020-01-04 16:49:09',
                'updated_at' => '2020-01-04 16:49:09',
            ),
            480 => 
            array (
                'id' => 481,
                'usertype_id' => 1,
                'product_id' => 97,
                'price' => 0.080000000000000002,
                'created_at' => '2020-01-04 16:50:38',
                'updated_at' => '2020-01-04 16:50:38',
            ),
            481 => 
            array (
                'id' => 482,
                'usertype_id' => 2,
                'product_id' => 97,
                'price' => 0.074999999999999997,
                'created_at' => '2020-01-04 16:50:38',
                'updated_at' => '2020-01-04 16:50:38',
            ),
            482 => 
            array (
                'id' => 483,
                'usertype_id' => 3,
                'product_id' => 97,
                'price' => 0.074999999999999997,
                'created_at' => '2020-01-04 16:50:38',
                'updated_at' => '2020-01-04 16:50:38',
            ),
            483 => 
            array (
                'id' => 484,
                'usertype_id' => 4,
                'product_id' => 97,
                'price' => 0.074999999999999997,
                'created_at' => '2020-01-04 16:50:38',
                'updated_at' => '2020-01-04 16:50:38',
            ),
            484 => 
            array (
                'id' => 485,
                'usertype_id' => 5,
                'product_id' => 97,
                'price' => 0.074999999999999997,
                'created_at' => '2020-01-04 16:50:38',
                'updated_at' => '2020-01-04 16:50:38',
            ),
            485 => 
            array (
                'id' => 486,
                'usertype_id' => 1,
                'product_id' => 98,
                'price' => 1400.0,
                'created_at' => '2020-01-04 16:52:46',
                'updated_at' => '2020-01-04 16:52:46',
            ),
            486 => 
            array (
                'id' => 487,
                'usertype_id' => 2,
                'product_id' => 98,
                'price' => 1275.0,
                'created_at' => '2020-01-04 16:52:46',
                'updated_at' => '2020-01-04 16:52:46',
            ),
            487 => 
            array (
                'id' => 488,
                'usertype_id' => 3,
                'product_id' => 98,
                'price' => 1225.0,
                'created_at' => '2020-01-04 16:52:46',
                'updated_at' => '2020-01-04 16:52:46',
            ),
            488 => 
            array (
                'id' => 489,
                'usertype_id' => 4,
                'product_id' => 98,
                'price' => 1200.0,
                'created_at' => '2020-01-04 16:52:46',
                'updated_at' => '2020-01-04 16:52:46',
            ),
            489 => 
            array (
                'id' => 490,
                'usertype_id' => 5,
                'product_id' => 98,
                'price' => 1175.0,
                'created_at' => '2020-01-04 16:52:46',
                'updated_at' => '2020-01-04 16:52:46',
            ),
            490 => 
            array (
                'id' => 491,
                'usertype_id' => 1,
                'product_id' => 99,
                'price' => 1750.0,
                'created_at' => '2020-01-04 16:53:13',
                'updated_at' => '2020-01-04 16:53:13',
            ),
            491 => 
            array (
                'id' => 492,
                'usertype_id' => 2,
                'product_id' => 99,
                'price' => 1675.0,
                'created_at' => '2020-01-04 16:53:13',
                'updated_at' => '2020-01-04 16:53:13',
            ),
            492 => 
            array (
                'id' => 493,
                'usertype_id' => 3,
                'product_id' => 99,
                'price' => 1625.0,
                'created_at' => '2020-01-04 16:53:13',
                'updated_at' => '2020-01-04 16:53:13',
            ),
            493 => 
            array (
                'id' => 494,
                'usertype_id' => 4,
                'product_id' => 99,
                'price' => 1600.0,
                'created_at' => '2020-01-04 16:53:13',
                'updated_at' => '2020-01-04 16:53:13',
            ),
            494 => 
            array (
                'id' => 495,
                'usertype_id' => 5,
                'product_id' => 99,
                'price' => 1575.0,
                'created_at' => '2020-01-04 16:53:13',
                'updated_at' => '2020-01-04 16:53:13',
            ),
            495 => 
            array (
                'id' => 496,
                'usertype_id' => 1,
                'product_id' => 100,
                'price' => 1600.0,
                'created_at' => '2020-01-04 16:53:31',
                'updated_at' => '2020-01-04 16:53:31',
            ),
            496 => 
            array (
                'id' => 497,
                'usertype_id' => 2,
                'product_id' => 100,
                'price' => 1600.0,
                'created_at' => '2020-01-04 16:53:31',
                'updated_at' => '2020-01-04 16:53:31',
            ),
            497 => 
            array (
                'id' => 498,
                'usertype_id' => 3,
                'product_id' => 100,
                'price' => 1550.0,
                'created_at' => '2020-01-04 16:53:31',
                'updated_at' => '2020-01-04 16:53:31',
            ),
            498 => 
            array (
                'id' => 499,
                'usertype_id' => 4,
                'product_id' => 100,
                'price' => 1525.0,
                'created_at' => '2020-01-04 16:53:31',
                'updated_at' => '2020-01-04 16:53:31',
            ),
            499 => 
            array (
                'id' => 500,
                'usertype_id' => 5,
                'product_id' => 100,
                'price' => 1500.0,
                'created_at' => '2020-01-04 16:53:31',
                'updated_at' => '2020-01-04 16:53:31',
            ),
        ));
        \DB::table('usertypeprices')->insert(array (
            0 => 
            array (
                'id' => 501,
                'usertype_id' => 1,
                'product_id' => 101,
                'price' => 50.0,
                'created_at' => '2020-01-04 16:53:48',
                'updated_at' => '2020-01-04 16:53:48',
            ),
            1 => 
            array (
                'id' => 502,
                'usertype_id' => 2,
                'product_id' => 101,
                'price' => 45.0,
                'created_at' => '2020-01-04 16:53:48',
                'updated_at' => '2020-01-04 16:53:48',
            ),
            2 => 
            array (
                'id' => 503,
                'usertype_id' => 3,
                'product_id' => 101,
                'price' => 45.0,
                'created_at' => '2020-01-04 16:53:48',
                'updated_at' => '2020-01-04 16:53:48',
            ),
            3 => 
            array (
                'id' => 504,
                'usertype_id' => 4,
                'product_id' => 101,
                'price' => 45.0,
                'created_at' => '2020-01-04 16:53:48',
                'updated_at' => '2020-01-04 16:53:48',
            ),
            4 => 
            array (
                'id' => 505,
                'usertype_id' => 5,
                'product_id' => 101,
                'price' => 45.0,
                'created_at' => '2020-01-04 16:53:48',
                'updated_at' => '2020-01-04 16:53:48',
            ),
            5 => 
            array (
                'id' => 506,
                'usertype_id' => 1,
                'product_id' => 102,
                'price' => 60.0,
                'created_at' => '2020-01-04 16:54:10',
                'updated_at' => '2020-01-04 16:54:10',
            ),
            6 => 
            array (
                'id' => 507,
                'usertype_id' => 2,
                'product_id' => 102,
                'price' => 55.0,
                'created_at' => '2020-01-04 16:54:10',
                'updated_at' => '2020-01-04 16:54:10',
            ),
            7 => 
            array (
                'id' => 508,
                'usertype_id' => 3,
                'product_id' => 102,
                'price' => 55.0,
                'created_at' => '2020-01-04 16:54:10',
                'updated_at' => '2020-01-04 16:54:10',
            ),
            8 => 
            array (
                'id' => 509,
                'usertype_id' => 4,
                'product_id' => 102,
                'price' => 55.0,
                'created_at' => '2020-01-04 16:54:10',
                'updated_at' => '2020-01-04 16:54:10',
            ),
            9 => 
            array (
                'id' => 510,
                'usertype_id' => 5,
                'product_id' => 102,
                'price' => 55.0,
                'created_at' => '2020-01-04 16:54:10',
                'updated_at' => '2020-01-04 16:54:10',
            ),
            10 => 
            array (
                'id' => 511,
                'usertype_id' => 1,
                'product_id' => 103,
                'price' => 60.0,
                'created_at' => '2020-01-04 16:54:24',
                'updated_at' => '2020-01-04 16:54:24',
            ),
            11 => 
            array (
                'id' => 512,
                'usertype_id' => 2,
                'product_id' => 103,
                'price' => 55.0,
                'created_at' => '2020-01-04 16:54:24',
                'updated_at' => '2020-01-04 16:54:24',
            ),
            12 => 
            array (
                'id' => 513,
                'usertype_id' => 3,
                'product_id' => 103,
                'price' => 55.0,
                'created_at' => '2020-01-04 16:54:24',
                'updated_at' => '2020-01-04 16:54:24',
            ),
            13 => 
            array (
                'id' => 514,
                'usertype_id' => 4,
                'product_id' => 103,
                'price' => 55.0,
                'created_at' => '2020-01-04 16:54:24',
                'updated_at' => '2020-01-04 16:54:24',
            ),
            14 => 
            array (
                'id' => 515,
                'usertype_id' => 5,
                'product_id' => 103,
                'price' => 55.0,
                'created_at' => '2020-01-04 16:54:24',
                'updated_at' => '2020-01-04 16:54:24',
            ),
            15 => 
            array (
                'id' => 516,
                'usertype_id' => 1,
                'product_id' => 104,
                'price' => 60.0,
                'created_at' => '2020-01-04 16:56:26',
                'updated_at' => '2020-01-04 16:56:26',
            ),
            16 => 
            array (
                'id' => 517,
                'usertype_id' => 2,
                'product_id' => 104,
                'price' => 55.0,
                'created_at' => '2020-01-04 16:56:26',
                'updated_at' => '2020-01-04 16:56:26',
            ),
            17 => 
            array (
                'id' => 518,
                'usertype_id' => 3,
                'product_id' => 104,
                'price' => 55.0,
                'created_at' => '2020-01-04 16:56:26',
                'updated_at' => '2020-01-04 16:56:26',
            ),
            18 => 
            array (
                'id' => 519,
                'usertype_id' => 4,
                'product_id' => 104,
                'price' => 55.0,
                'created_at' => '2020-01-04 16:56:26',
                'updated_at' => '2020-01-04 16:56:26',
            ),
            19 => 
            array (
                'id' => 520,
                'usertype_id' => 5,
                'product_id' => 104,
                'price' => 55.0,
                'created_at' => '2020-01-04 16:56:26',
                'updated_at' => '2020-01-04 16:56:26',
            ),
            20 => 
            array (
                'id' => 521,
                'usertype_id' => 1,
                'product_id' => 105,
                'price' => 35.0,
                'created_at' => '2020-01-04 16:56:41',
                'updated_at' => '2020-01-04 16:56:41',
            ),
            21 => 
            array (
                'id' => 522,
                'usertype_id' => 2,
                'product_id' => 105,
                'price' => 30.0,
                'created_at' => '2020-01-04 16:56:41',
                'updated_at' => '2020-01-04 16:56:41',
            ),
            22 => 
            array (
                'id' => 523,
                'usertype_id' => 3,
                'product_id' => 105,
                'price' => 30.0,
                'created_at' => '2020-01-04 16:56:41',
                'updated_at' => '2020-01-04 16:56:41',
            ),
            23 => 
            array (
                'id' => 524,
                'usertype_id' => 4,
                'product_id' => 105,
                'price' => 30.0,
                'created_at' => '2020-01-04 16:56:41',
                'updated_at' => '2020-01-04 16:56:41',
            ),
            24 => 
            array (
                'id' => 525,
                'usertype_id' => 5,
                'product_id' => 105,
                'price' => 30.0,
                'created_at' => '2020-01-04 16:56:41',
                'updated_at' => '2020-01-04 16:56:41',
            ),
            25 => 
            array (
                'id' => 526,
                'usertype_id' => 1,
                'product_id' => 106,
                'price' => 15.0,
                'created_at' => '2020-01-04 16:56:56',
                'updated_at' => '2020-01-04 16:56:56',
            ),
            26 => 
            array (
                'id' => 527,
                'usertype_id' => 2,
                'product_id' => 106,
                'price' => 10.0,
                'created_at' => '2020-01-04 16:56:56',
                'updated_at' => '2020-01-04 16:56:56',
            ),
            27 => 
            array (
                'id' => 528,
                'usertype_id' => 3,
                'product_id' => 106,
                'price' => 10.0,
                'created_at' => '2020-01-04 16:56:56',
                'updated_at' => '2020-01-04 16:56:56',
            ),
            28 => 
            array (
                'id' => 529,
                'usertype_id' => 4,
                'product_id' => 106,
                'price' => 10.0,
                'created_at' => '2020-01-04 16:56:56',
                'updated_at' => '2020-01-04 16:56:56',
            ),
            29 => 
            array (
                'id' => 530,
                'usertype_id' => 5,
                'product_id' => 106,
                'price' => 10.0,
                'created_at' => '2020-01-04 16:56:56',
                'updated_at' => '2020-01-04 16:56:56',
            ),
        ));
        
        
    }
}