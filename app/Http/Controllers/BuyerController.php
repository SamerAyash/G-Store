<?php

namespace App\Http\Controllers;

use App\Category;
use App\Cart;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    public function cart(){
        if (auth()->check() && auth('web')->user()->type == 'buyer'){
            $categories = Category::with('subCategory')->select('id','name')->get();

            $carts = Cart::with(['product'=>function($q){
                $q->addSelect('id','mainImage','price','title','amount')
                    ->where('isAccept','=',1)
                    ->where('isHidden','=',0)
                    ->with(['offer'=>function ($j){
                        $j->select('discount','product_id');
                    }]);

            }])
                ->where('buyer_id',auth('web')->id())
                ->select('id','count','product_id','created_at')->get();

            return view('buyer.cart',compact(['categories','carts']));
        }
        else{
            return redirect(route('login'));
        }

    }
}
