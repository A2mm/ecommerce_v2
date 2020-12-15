<?php
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
        // $this->call(CategoriesTableSeeder::class);
        // $this->call(SubcategorySeeder::class);
        // $this->call(StoresTableSeeder::class);
        // $this->call(PaymentMethodsTableSeeder::class);
        // $this->call(BanneringTypesTableSeeder::class);
        // $this->call(UsertypepricesTableSeeder::class);
        // $this->call(UsertypesTableSeeder::class);
        // $this->call(ShipmentTableSeeder::class); 
        
       // $this->call(ProductStoreQuantitiesTableSeeder::class);
        

        // $this->call(CountriesTableSeeder::class);
         // $this->call(CurrenciesTableSeeder::class);
        //$this->call(ProductSeeder::class);
    }
}
