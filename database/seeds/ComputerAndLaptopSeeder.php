<?php

use Illuminate\Database\Seeder;
use App\SubCategory;
use App\User;
use App\Product;
use App\ProductImages;
use App\Products\ComputerAndLaptop;
class ComputerAndLaptopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subCategory_id = SubCategory::where('name','Computers & Laptops')->first()->id;
        for($i=0;$i<10;$i++){
            $seller_id = User::where('type', 'seller')->inRandomOrder()->first()->id;
            $product=factory(Product::class)->create([
                'subCategory_id'=>$subCategory_id,
                'seller_id'=>$seller_id
            ]);
            User::whereId($seller_id)->increment('productsCount');
            factory(ProductImages::class)->create([
                'product_id'=>$product->id
            ]);
            factory(ComputerAndLaptop::class)->create([
                'product_id'=>$product->id
            ]);
        }
    }
}
