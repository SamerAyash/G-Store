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
        $this->call(CategoriesAndSubcategories::class);
        $this->call(AddressSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RequestsAndComplaints::class);
        $this->call(FoodMarketSeeder::class);
        $this->call(MobileAndTabletSeeder::class);
        $this->call(ElectronicsSeeder::class);
        $this->call(BeautyAndHelthSeeder::class);
        $this->call(HomeSeeder::class);
        $this->call(SportAndGamesSeeder::class);
        $this->call(OfferSeeder::class);
    }
}
