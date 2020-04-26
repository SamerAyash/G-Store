<?php
use \Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Admin;
use App\address;
use App\Model_has_permission;
use App\Permission;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $faker =\Faker\Factory::create();
            $admin=Admin::create(
                [
                    'name' =>'Samer Ayash',
                    'id_number'=>$faker->randomNumber,
                    'email' => 'sam@gmail.com',
                    'password' => Hash::make('12345678'), // password
                    'phone'=>$faker->randomNumber,
                    'address_id'=> address::inRandomOrder()->first()->id,
                    'birthDate'=>$faker->date(),
                    'type'=>'superAdmin',
                    'remember_token' => \Illuminate\Support\Str::random(10),
                ]
            );
        $permissions=['manage orders','manage customers','manage products'
            ,'manage coupons','manage offers'];
        foreach ($permissions as $permission){
            $per =Permission::where('name',$permission)->get()->first();
            Model_has_permission::create([
                'admin_id'=>$admin->id,
                'permission_id'=>$per->id
            ]);
        }

        for ($i=0; $i< 25 ;$i++){
            $faker =\Faker\Factory::create();
            $supervisor=Admin::create(
                [
                    'name' => $faker->name,
                    'id_number'=>$faker->randomNumber,
                    'email' => $faker->unique()->safeEmail,
                    'password' => Hash::make('12345678'), // password
                    'phone'=>$faker->randomNumber,
                    'address_id'=> address::inRandomOrder()->first()->id,
                    'birthDate'=>$faker->date(),
                    'type'=>'supervisor',
                    'remember_token' => \Illuminate\Support\Str::random(10),
                ]
            );
            $permissions=['manage orders','manage customers'
                ,'manage offers','manage products'];
            foreach ($permissions as $permission){
                $per =Permission::where('name',$permission)->get()->first();
                Model_has_permission::create([
                    'admin_id'=>$supervisor->id,
                    'permission_id'=>$per->id
                ]);
            }
        }

        for ($i=0; $i< 20 ;$i++){
            $faker =\Faker\Factory::create();
            $delivery=Admin::create(
                [
                    'name' => $faker->name,
                    'id_number'=>$faker->randomNumber,
                    'email' => $faker->unique()->safeEmail,
                    'password' => Hash::make('12345678'), // password
                    'phone'=>$faker->randomNumber,
                    'address_id'=> address::inRandomOrder()->first()->id,
                    'birthDate'=>$faker->date(),
                    'type'=>'delivery',
                    'remember_token' => \Illuminate\Support\Str::random(10),
                ]
            );
            $per =Permission::where('name','active')->get()->first();
            Model_has_permission::create([
                'admin_id'=>$delivery->id,
                'permission_id'=>$per->id
            ]);
        }
    }
}
