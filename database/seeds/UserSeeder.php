<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i< 30 ;$i++){
            $faker =\Faker\Factory::create();
            factory(App\User::class)->create(
                [
                    'name' => $faker->name,
                    'id_number'=>$faker->randomDigit,
                    'email' => $faker->unique()->safeEmail,
                    'password' => Hash::make('12345678'), // password
                    'phone'=>strval($faker->randomDigit),
                    'address_id'=> \App\address::inRandomOrder()->first()->id,
                    'birthDate'=>$faker->date(),
                    'shopName'=>$faker->colorName,
                    'type'=>$faker->randomElement(['seller','buyer']),
                    'remember_token' => \Illuminate\Support\Str::random(10),
                ]
            );
        }    }
}
