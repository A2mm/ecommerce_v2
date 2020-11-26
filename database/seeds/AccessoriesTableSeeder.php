<?php

use Illuminate\Database\Seeder;

class AccessoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('accessories')->delete();
        
        \DB::table('accessories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Ring',
                'arabic_name' => 'خاتم',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Necklace',
                'arabic_name' => 'عقد',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Earrings',
                'arabic_name' => 'حلقان',
                'created_at' => NULL,
                'updated_at' => '2019-02-10 13:32:38',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Keychain',
                'arabic_name' => 'ميدالية',
                'created_at' => NULL,
                'updated_at' => '2019-01-02 13:28:02',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Pendant',
                'arabic_name' => 'دلاية',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Rosary',
                'arabic_name' => 'سبحة',
                'created_at' => NULL,
                'updated_at' => '2019-01-02 13:26:54',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Bracelet',
                'arabic_name' => 'سوار',
                'created_at' => NULL,
                'updated_at' => '2019-01-02 13:25:31',
            ),
            7 => 
            array (
                'id' => 12,
                'name' => 'Piercing',
                'arabic_name' => 'حلق فردي',
                'created_at' => '2018-09-27 15:21:33',
                'updated_at' => '2018-09-27 15:21:33',
            ),
            8 => 
            array (
                'id' => 13,
                'name' => 'Anklet',
                'arabic_name' => 'خلخال',
                'created_at' => '2019-02-04 12:36:13',
                'updated_at' => '2019-02-04 12:36:13',
            ),
            9 => 
            array (
                'id' => 15,
                'name' => 'Pandora',
                'arabic_name' => 'باندورا',
                'created_at' => '2019-02-12 10:47:16',
                'updated_at' => '2019-02-12 10:47:16',
            ),
        ));
        
        
    }
}