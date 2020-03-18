<?php

use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0;$i<20 ;$i++){
            $faker =\Faker\Factory::create();
            App\address::create(
                [
                    'city'=>$faker->country,
                    'area'=>$faker->city,
                    'street'=>$faker->streetName,
                    'buildingNumber'=>$faker->buildingNumber
                ]
            );
        }
    }
}
