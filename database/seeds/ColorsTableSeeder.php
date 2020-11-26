<?php

use Illuminate\Database\Seeder;

class ColorsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('colors')->delete();
        
        \DB::table('colors')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'black',
                'code' => '#040707',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'white',
                'code' => '#FFFFFF',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'yellow',
                'code' => '#F9DA07',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'orange',
                'code' => '#ED6923',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'red',
                'code' => '#CB2127',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'burgundy',
                'code' => '#7B1315',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'light_pink',
                'code' => '#F293BD',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'fuchsia_pink',
                'code' => '#EF4A76',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'green',
                'code' => '#38B553',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'dark_green',
                'code' => '#13653F',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'turquoise',
                'code' => '#1AA39C',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'light_blue',
                'code' => '#6AC5E0',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'blue',
                'code' => '#4D7ABD',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'royal_blue',
                'code' => '#222464',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'violet',
                'code' => '#673695',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'dark_brown',
                'code' => '#31180E',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'light_brown',
                'code' => '#934B21',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'grey',
                'code' => '#CBD0D2',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'dark_grey',
                'code' => '#687478',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'ivory_beige',
                'code' => '#F0E1C7',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'silver_metallic',
                'code' => '#A9B4B0',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'gold_metallic',
                'code' => '#A69461',
            ),
        ));
        
        
    }
}