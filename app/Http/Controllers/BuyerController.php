<?php

namespace App\Http\Controllers;

use App\Category;
use App\Cart;
use App\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class BuyerController extends Controller
{
    public function cart(){
        if (auth()->check() && auth('web')->user()->type == 'buyer'){
            $categories = Category::with('subCategory')->select('id','name')->get();

            $carts =$this->carts();
            return view('buyer.cart',compact(['categories','carts']));
        }
        else{
            return redirect(route('login'));
        }

    }
    public function addToCart($id,Request $request){
        $buyer_id=auth('web')->id();
        $cart=Cart::where('buyer_id',$buyer_id)->where('product_id',$id)->first();
        if (!isset($cart)){
            Cart::create([
                'buyer_id'=>$buyer_id,
                'product_id'=>$id,
                'count'=>$request->input('quantity')
            ]);
            return response()->json();
        }
        else{
            $cart->count = $cart->count + $request->input('quantity');
            $cart->update();
            return response()->json();
        }
        return response()->json('error');
    }
    public function checkout(Request $request){
        $carts=$this->carts();
        if (isset($carts)){
            foreach ($carts as $cart){
                $seller_code = Str::random(6);
                $buyer_code = Str::random(6);
                $order =new Order();
                $order->seller_code=$seller_code;
                $order->buyer_code=$buyer_code;
                $order->status='create';
                $order->payment_type='cash';
                $order->costs=$cart->count * $cart->product->price;
                $order->quantity=$cart->count;
                $order->product_id =$cart->product->id;
                $order->buyer_id =auth()->id();
                $order->save();
                $cart->delete();

        }
            return response()->json();
        }
        return response()->json($this->carts());
    }
    public function deleteFromCart($id){
        Cart::destroy($id);
        $carts = $this->carts();
        return response()->json($carts);
    }
    /////////////////////////////////////////////////////////////////
    public function getOrders(){
        if (auth()->check() && auth('web')->user()->type == 'buyer'){
            $categories = Category::with('subCategory')->select('id','name')->get();

            $orders =$this->orders();
            return view('buyer.order',compact(['categories','orders']));
        }
        else{
            return redirect(route('login'));
        }
    }
    public function deleteOrder($id){
        Order::destroy($id);
        $orders = $this->orders();
        return response()->json($orders);
    }
    ////////////////////////////////////////////////////////////////

    protected function carts(){
        $carts = Cart::with(['product'=>function($q){
            $q->addSelect('id','mainImage','price','title','amount')
                ->where('isAccept','=',1)
                ->where('isHidden','=',0)
                ->with(['offer'=>function ($j){
                    $j->select('discount','product_id');
                }]);

        }])
            ->where('buyer_id',auth('web')->id())
            ->select('id','count','product_id','created_at')
            ->orderBy('updated_at','desc')
            ->get();
        return $carts;
    }
    protected function orders(){
        $orders=Order::with(['product'=>function($q){
            $q->addSelect('id','mainImage','price','title','amount')
                ->where('isAccept','=',1)
                ->where('isHidden','=',0)
                ->with(['offer'=>function ($j){
                    $j->select('discount','product_id');
                }]);

        }])
            ->where('buyer_id',auth('web')->id())
            ->select('id','buyer_code','status','product_id','payment_type','costs','quantity','paid_price','created_at')
            ->orderBy('updated_at','desc')
            ->get();
        return $orders;
    }
}
