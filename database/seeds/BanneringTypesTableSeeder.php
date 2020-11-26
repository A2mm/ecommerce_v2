<?php

use Illuminate\Database\Seeder;

class BanneringTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      App\BanneringType::truncate();

      App\BanneringType::create([
      'name' => 'rectangle',
    ]);
    App\BanneringType::create([
      'name' => 'squared',
    ]);
    App\BanneringType::create([
      'name' => 'hot_offer',
    ]);
    /* App\BanneringType::create([
      'name' => 'upper',
    ]);
    App\BanneringType::create([
      'name' => 'bottom',
    ]);
    App\BanneringType::create([
      'name' => 'hot',
    ]);
    App\BanneringType::create([
      'name' => 'flash',
    ]);
    App\BanneringType::create([
      'name' => 'main',
    ]);
    App\BanneringType::create([
      'name' => 'side',
    ]);
    App\BanneringType::create([
      'name' => 'google_footer',
    ]);
    App\BanneringType::create([
      'name' => 'google_square',
    ]);
    App\BanneringType::create([
      'name' => 'default',
    ]); */
  }
}
