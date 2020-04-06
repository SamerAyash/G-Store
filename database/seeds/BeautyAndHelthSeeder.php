<?php

use Illuminate\Database\Seeder;
use \App\SubCategory;
use \App\User;
use \App\Product;
use \App\ProductImages;
use \App\Products\BeautyAndHelth;
class BeautyAndHelthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<15;$i++){
            $array =['Perfumes','Make-up','Body care devices','Creams'];
            $index=array_rand($array);
            $subCategory_id =SubCategory::where('name',$array[$index])->first()->id;
            $seller_id =User::where('type','seller')->inRandomOrder()->first()->id;
            if ($array[$index] == 'Perfumes'){
                $product=factory(Product::class)->create([
                    'subCategory_id'=>$subCategory_id,
                    'seller_id'=>$seller_id
                ]);
                User::whereId($seller_id)->increment('productsCount');
                factory(ProductImages::class)->create([
                    'product_id'=>$product->id
                ]);
                factory(BeautyAndHelth::class)->create([
                    'type'=>'perfume',
                    'product_id'=>$product->id
                ]);
            }
            if ($array[$index] == 'Make-up'){
                $product=factory(Product::class)->create([
                    'subCategory_id'=>$subCategory_id,
                    'seller_id'=>$seller_id
                ]);
                User::whereId($seller_id)->increment('productsCount');
                factory(ProductImages::class)->create([
                    'product_id'=>$product->id
                ]);
                factory(BeautyAndHelth::class)->create([
                    'type'=>'make-up',
                    'product_id'=>$product->id
                ]);
            }
            if ($array[$index] == 'Body care devices'){
                $product=factory(Product::class)->create([
                    'subCategory_id'=>$subCategory_id,
                    'seller_id'=>$seller_id
                ]);
                User::whereId($seller_id)->increment('productsCount');
                factory(ProductImages::class)->create([
                    'product_id'=>$product->id
                ]);
                factory(BeautyAndHelth::class)->create([
                    'type'=>'body care device',
                    'product_id'=>$product->id
                ]);
            }
            if ($array[$index] == 'Creams'){
                $product=factory(Product::class)->create([
                    'subCategory_id'=>$subCategory_id,
                    'seller_id'=>$seller_id
                ]);
                User::whereId($seller_id)->increment('productsCount');
                factory(ProductImages::class)->create([
                    'product_id'=>$product->id
                ]);
                factory(BeautyAndHelth::class)->create([
                    'type'=>'cream',
                    'product_id'=>$product->id
                ]);
            }
        }
    }

}
