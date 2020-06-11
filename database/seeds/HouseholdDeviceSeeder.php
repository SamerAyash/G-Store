<?php

use Illuminate\Database\Seeder;
use App\SubCategory;
use App\User;
use App\Product;
use App\ProductImages;
use App\Products\HouseholdDevice;
class HouseholdDeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subCategory_id = SubCategory::where('name','Household Devices')->first()->id;
        for($i=0;$i<40;$i++){
            $seller_id = User::where('type', 'seller')->inRandomOrder()->first()->id;
            $product=factory(Product::class)->create([
                'subCategory_id'=>$subCategory_id,
                'seller_id'=>$seller_id
            ]);
            User::whereId($seller_id)->increment('productsCount');
            factory(ProductImages::class,5)->create([
                'product_id'=>$product->id
            ]);
            factory(HouseholdDevice::class)->create([
                'product_id'=>$product->id
            ]);
        }
    }
}
