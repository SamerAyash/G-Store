<?php

use Illuminate\Database\Seeder;
use App\Permission;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions=['manage orders','manage customers','manage products'
            ,'manage coupons','manage offers','active'];
        foreach ($permissions as $permission){
            Permission::create([
                'name'=>$permission
            ]);
        }
    }
}
