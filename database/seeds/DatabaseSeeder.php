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
        //$this->call(AccessoriesTableSeeder::class);
        
        $this->call(CategoriesTableSeeder::class);
        $this->call(SubcategoriesTableSeeder::class);
        $this->call(StoresTableSeeder::class);
        
       // $this->call(PurchasesTableSeeder::class);
       // $this->call(ProductStoreQuantitiesTableSeeder::class);
       // $this->call(BarcodesTableSeeder::class);
        //$this->call(BarcodeMovementsTableSeeder::class);
        // $this->call(AttributeProductsTableSeeder::class);

       // $this->call(UserSeeder::class);
        //$this->call(UsertypeSeeder::class);

        //$this->call(AdsTableSeeder::class);

        //$this->call(ColorsTableSeeder::class);
        // $this->call(CountriesTableSeeder::class);
         // $this->call(CurrenciesTableSeeder::class);
        //$this->call(LanguagesTableSeeder::class);
        /*
        $this->call(OwnerPrivilegesTableSeeder::class);
        */
        //$this->call(PrivilegesTableSeeder::class);
        //$this->call(ProductColorTableSeeder::class);
        //$this->call(ShapesTableSeeder::class);

    //    $this->call(VendorsTableSeeder::class);
    //    $this->call(VideosTableSeeder::class);
        //$this->call(ProductSeeder::class);

 //       $this->call(IconsTableSeeder::class);
        // ahmed
       // $this->call(BannerTypesTableSeeder::class);
        $this->call(PaymentMethodsTableSeeder::class);
        $this->call(BanneringTypesTableSeeder::class);
       
        $this->call(UsersTableSeeder::class); 
        $this->call(ProductsTableSeeder::class);
        $this->call(UsertypepricesTableSeeder::class);
        $this->call(UsertypesTableSeeder::class);
        $this->call(ShipmentTableSeeder::class); 
    }
}
