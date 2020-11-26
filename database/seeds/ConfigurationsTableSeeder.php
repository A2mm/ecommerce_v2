<?php

use Illuminate\Database\Seeder;

class ConfigurationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {


         \DB::table('configurations')->delete();

         \DB::table('configurations')->insert(array (
             0 =>
             array (
                 'id' => 1,
                 'name' => 'first_login',
                 'value' => '0',
                 'is_visible' => '0',
                 'input_type' => 'boolean',
             ),
             array (
                 'id' => 2,
                 'name' => 'main_currency',
                 'value' => '11',
                 'is_visible' => '1',
                 'input_type' => 'select',
             ),
             array (
                 'id' => 3,
                 'name' => 'main_country',
                 'value' => '244',
                 'is_visible' => '1',
                 'input_type' => 'select',
             ),
             array (
                 'id' => 4,
                 'name' => 'account_name',
                 'value' => 'Mint Gateway for Electronic Payment Services LLC',
                 'is_visible' => '1',
                 'input_type' => 'text',
             ),
             array (
                 'id' => 5,
                 'name' => 'bank_name',
                 'value' => 'Noor Bank PJSC',
                 'is_visible' => '1',
                 'input_type' => 'text',
             ),
             array (
                 'id' => 6,
                 'name' => 'swift_code',
                 'value' => 'NISLAEAD',
                 'is_visible' => '1',
                 'input_type' => 'text',
             ),
             array (
                 'id' => 7,
                 'name' => 'IBAN',
                 'value' => 'AE180520000110763110015',
                 'is_visible' => '1',
                 'input_type' => 'text',
             ),
             array (
                 'id' => 8,
                 'name' => 'affiliate_allowance',
                 'value' => '24',
                 'is_visible' => '1',
                 'input_type' => 'number',
             ),
             array (
                 'id' => 9,
                 'name' => 'cart_time_allowance',
                 'value' => '60',
                 'is_visible' => '1',
                 'input_type' => 'number',
             ),

         ));


     }
}
