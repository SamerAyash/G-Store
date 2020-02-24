<?php
use \Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i< 10 ;$i++){
            $faker =\Faker\Factory::create();
            factory(App\Admin::class)->create(
                [
                    'userName' => $faker->userName,
                    'firstName' => $faker->firstName,
                    'lastName' => $faker->lastName,
                    'id_number'=>$faker->randomDigit,
                    'email' => $faker->unique()->safeEmail,
                    'password' => Hash::make('12345678'), // password
                    'phone'=>strval($faker->randomDigit),
                    'address_id'=> \App\address::inRandomOrder()->first()->id,
                    'birthDate'=>$faker->date(),
                    'type'=>$faker->randomElement(['superAdmin','supervisor','delivery']),
                    'remember_token' => \Illuminate\Support\Str::random(10),
                ]
            );
        }
    }
}
