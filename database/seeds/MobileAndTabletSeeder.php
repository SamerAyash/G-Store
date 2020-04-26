<?php

use Illuminate\Database\Seeder;
use \App\SubCategory;
use \App\User;
use \App\Product;
use \App\ProductImages;
use \App\Products\MobileAndTablet;
class MobileAndTabletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for($i=0;$i<30;$i++){
            $array =['Mobiles','Tablets','Accessories'];
            $index=array_rand($array);
            $subCategory_id =SubCategory::where('name',$array[$index])->first()->id;
            $seller_id =User::where('type','seller')->inRandomOrder()->first()->id;

            if($array[$index] == 'Accessories'){
                $product=factory(\App\Product::class)->create([
                    'subCategory_id'=>$subCategory_id,
                    'seller_id'=>$seller_id
                ]);
                User::whereId($seller_id)->increment('productsCount');
                factory(\App\ProductImages::class)->create([
                    'product_id'=>$product->id
                ]);
            }
            else{
                if ($array[$index] == 'Mobiles'){
                    $product=factory(Product::class)->create([
                        'subCategory_id'=>$subCategory_id,
                        'seller_id'=>$seller_id
                    ]);
                    User::whereId($seller_id)->increment('productsCount');
                    factory(ProductImages::class)->create([
                        'product_id'=>$product->id
                    ]);
                    factory(MobileAndTablet::class)->create([
                        'type'=>'mobile',
                        'product_id'=>$product->id
                    ]);
                }
                else{
                    $product=factory(Product::class)->create([
                        'subCategory_id'=>$subCategory_id,
                        'seller_id'=>$seller_id
                    ]);
                    User::whereId($seller_id)->increment('productsCount');
                    factory(ProductImages::class)->create([
                        'product_id'=>$product->id
                    ]);
                    factory(MobileAndTablet::class)->create([
                        'type'=>'tablet',
                        'product_id'=>$product->id
                    ]);
                }
            }
        }
    }
}
