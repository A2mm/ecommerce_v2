<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class ShipmentTableSeeder extends Seeder
{
    public function run()
    {
        // TestDummy::times(20)->create('App\Post');
        $areas = ['giza' , 'fisal' , 'maadi' , 'zamalek' , 'nasr'];
        $prices = [10 , 5 , 8 , 7 , 12 ] ;

        foreach ($areas as $key => $area) {
          \App\Shipment::create([
            'area' => $area ,
            'price' => $prices[$key],
          ]);
        }
    }
}
