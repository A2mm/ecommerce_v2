<?php

use Illuminate\Database\Seeder;

class PaymentMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      App\PaymentMethod::truncate();
      App\PaymentMethod::create([
        'name' => 'Cash On Delivery',
      ]);
      App\PaymentMethod::create([
        'name' => 'paypal',
      ]);
      App\PaymentMethod::create([
        'name' => 'Wire Transfer',
      ]);
    }
}
