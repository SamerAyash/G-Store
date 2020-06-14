<?php

use Illuminate\Database\Seeder;
use App\Cart;
use App\User;
use App\Product;
class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0;$i < 500;$i++){
            $buyer_id =User::where('type','buyer')->inRandomOrder()->first()->id;
            $product_id =Product::where('isHidden',0)->where('isAccept',1)->inRandomOrder()->first()->id;
            factory(Cart::class)->create([
                'buyer_id'=>$buyer_id,
                'product_id'=>$product_id
            ]);
        }
    }
}
