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
        $permissions=['manage orders','manage customers','manage products',
            'product reviews','offer reviews','manage coupons','manage offers','active'];
        foreach ($permissions as $permission){
            Permission::create([
                'name'=>$permission
            ]);
        }
    }
}
