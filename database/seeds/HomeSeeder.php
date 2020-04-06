<?php

use Illuminate\Database\Seeder;
use \App\SubCategory;
use \App\User;
use \App\Product;
use \App\ProductImages;
use \App\Products\Home;
class HomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<15;$i++){
            $array =['Kitchen & Dining','Equipment and tools','Furniture and Decoration','Cleaning materials'];
            $index=array_rand($array);
            $subCategory_id =SubCategory::where('name',$array[$index])->first()->id;
            $seller_id =User::where('type','seller')->inRandomOrder()->first()->id;
            if ($array[$index] == 'Kitchen & Dining'){
                $product=factory(Product::class)->create([
                    'subCategory_id'=>$subCategory_id,
                    'seller_id'=>$seller_id
                ]);
                User::whereId($seller_id)->increment('productsCount');
                factory(ProductImages::class)->create([
                    'product_id'=>$product->id
                ]);
                factory(Home::class)->create([
                    'type'=>'kitchen',
                    'product_id'=>$product->id
                ]);
            }
            if ($array[$index] == 'Equipment and tools'){
                $product=factory(Product::class)->create([
                    'subCategory_id'=>$subCategory_id,
                    'seller_id'=>$seller_id
                ]);
                User::whereId($seller_id)->increment('productsCount');
                factory(ProductImages::class)->create([
                    'product_id'=>$product->id
                ]);
                factory(Home::class)->create([
                    'type'=>'tool',
                    'product_id'=>$product->id
                ]);
            }
            if ($array[$index] == 'Furniture and Decoration'){
                $product=factory(Product::class)->create([
                    'subCategory_id'=>$subCategory_id,
                    'seller_id'=>$seller_id
                ]);
                User::whereId($seller_id)->increment('productsCount');
                factory(ProductImages::class)->create([
                    'product_id'=>$product->id
                ]);
                factory(Home::class)->create([
                    'type'=>'furniture',
                    'product_id'=>$product->id
                ]);
            }
            if ($array[$index] == 'Cleaning materials'){
                $product=factory(Product::class)->create([
                    'subCategory_id'=>$subCategory_id,
                    'seller_id'=>$seller_id
                ]);
                User::whereId($seller_id)->increment('productsCount');
                factory(ProductImages::class)->create([
                    'product_id'=>$product->id
                ]);
                factory(Home::class)->create([
                    'type'=>'cleaning',
                    'product_id'=>$product->id
                ]);
            }
        }
    }
}
