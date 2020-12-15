<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

       // \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 3,
                'name' => 'example',
                'slug' => NULL,
                'email' => 'example@gmail.com',
                'password' => '$2y$10$dkWlOEd7vhQpEQFsZuhyNOx2S01/Mf4200hV0QlPXcHfqvTgWALTO',
                'remember_token' => 'Vn3uKBPIW11PqJApQ6ZrJ6fOEVsyZGi6qHGRYQ9F26pKHH2WTVuTYfvVHcwy',
                'api_token' => NULL,
                'role' => 'owner',
                'status' => 1,
                'code' => NULL,
                'points' => 1000,
                'country_id' => 62,
                'usertype_id' => 1,
                'prev_privillige' => NULL,
                'city' => NULL,
                'address' => NULL,
                'phone' => NULL,
                'new_email' => NULL,
                'new_name' => NULL,
                'payee_name' => NULL,
                'bank_account' => NULL,
                'language' => NULL,
                'hoppy' => NULL,
                'sex' => NULL,
                'job' => NULL,
                'birthdate' => NULL,
                'facebook_id' => NULL,
                'customerOrNot' => 1,
                'deleted_at' => NULL,
                'created_at' => '2016-11-13 06:17:44',
                'updated_at' => '2019-01-24 12:45:24',
            ),
        ));
        
        
    }
}