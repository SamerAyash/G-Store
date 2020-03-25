<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\Hash;
use App\User;
use App\address;
use App\Model_has_permission;
use App\Permission;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i< 40 ;$i++){
            $faker =\Faker\Factory::create();
            $seller=User::create(
                [
                    'name' => $faker->name,
                    'id_number'=>$faker->randomNumber,
                    'email' => $faker->unique()->safeEmail,
                    'password' => Hash::make('12345678'), // password
                    'phone'=>strval($faker->randomNumber),
                    'address_id'=> address::inRandomOrder()->first()->id,
                    'birthDate'=>$faker->date(),
                    'shopName'=>$faker->company,
                    'type'=>'seller',
                    'remember_token' => \Illuminate\Support\Str::random(10),
                ]
            );
            $permissions=['manage offers','manage products'];
            foreach ($permissions as $permission){
                $per =Permission::where('name',$permission)->get()->first();
                Model_has_permission::create([
                    'user_id'=>$seller->id,
                    'permission_id'=>$per->id
                ]);
            }
        }
        for ($i=0; $i< 40 ;$i++){
            $faker =\Faker\Factory::create();
            $buyer=User::create(
                [
                    'name' => $faker->name,
                    'id_number'=>$faker->randomNumber,
                    'email' => $faker->unique()->safeEmail,
                    'password' => Hash::make('12345678'), // password
                    'phone'=>$faker->randomNumber,
                    'address_id'=> address::inRandomOrder()->first()->id,
                    'birthDate'=>$faker->date(),
                    'shopName'=>$faker->company,
                    'type'=>'buyer',
                    'remember_token' => \Illuminate\Support\Str::random(10),
                ]
            );
            $per =Permission::where('name','active')->get()->first();
            Model_has_permission::create([
                'user_id'=>$buyer->id,
                'permission_id'=>$per->id
            ]);
        }
    }
}
