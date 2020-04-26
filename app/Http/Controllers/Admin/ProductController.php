<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Offer;
use App\Product;
use App\ProductImages;
use App\Products\MobileAndTablet;
use App\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;
use phpDocumentor\Reflection\Types\Object_;

class ProductController extends Controller
{
    public function productsTable()
    {
        return view('admin.productsTable');
    }
    public function outProducts(){
        $outProducts =Product::join('sub_categories','sub_categories.id','=','products.subCategory_id')
            ->join('users','users.id','=','products.seller_id')
            ->join('categories','sub_categories.category_id','=','categories.id')
            ->where('isAccept',false)
            ->select('products.id','mainImage','title','price','rate','products.updated_at',
                'sub_categories.name as subCategory','categories.name as category',
                'users.name as seller','users.shopName as shopName')
            ->paginate(15);
        return response($outProducts,200);
    }

    public function getProduct($id){
        $product =Product::with(['subCategory'=>function($q){
                $q->with('category');
            }])
            ->with(['seller'=>function($q){
                $q->addSelect('id','name','shopName');
            }])
            ->with('images')
            ->find($id);
        $subClass=$product->checkSubClass($product->subCategory->name);
        $product->$subClass;
        return response($product,200);
    }
    public function updateProduct($id,Request $request){
        if ($request['status']== 'allow'){
            Product::whereId($id)->update([
                'note'=>$request['note'],
/*                'adminName'=>admin()->name,*/
                'isAccept'=>true
            ]);
            return response(null,200);
        }
        elseif ($request['status']== 'deny'){
            Product::whereId($id)->update([
                'note'=>$request['note'],
/*                'adminName'=>admin()->name*/
            ]);
            return response(null,200);
        }
        return response(null,200);
    }
    public function deleteProduct($id,Request $request)
    {
        $product=Object_::class;
        try {

            $product =Product::whereId($id)->first();

        } catch (\Exception $e) {

            return $e->getMessage();
        }
        $product->delete();
        User::where('id',$request['seller_id'])->decrement('productsCount',1);
        return response(null,200);
    }
    public function offers(Request $request){
        $offers=Object_::class;
        if ($request['condition'] === 'All'){
        $offers =Offer::with(['product'=>function($q){
                $q->addSelect('price','id');
            }])->paginate(20);
        }
        elseif($request['condition'] === 'Accepted products'){
            $offers =Offer::with('product')->whereHas('product',function(Builder $q){
                $q->where('isAccept','=',1)->addSelect('price','id','isAccept');
            })->paginate(20);
        }
        elseif($request['condition'] === 'Unacceptable products'){
            $offers =Offer::with('product')->whereHas('product',function(Builder $q){
                $q->where('isAccept','=',0)->addSelect('price','id','isAccept');
            })->paginate(20);
        }
        return response($offers,200);
    }

    public function deleteOffer($id){
        try {
            Offer::destroy($id);
        }
        catch (\Exception $e) {

            return response($e->getMessage(),404);
        }
        return response(null,200);
    }

    public function updateOffer(Request $request,$id){
        $this->validate($request,[
           'duration'=>'min:1|max:30|numeric|required' ,
            'discount'=>'min:1|max:100|numeric|required'
        ]);
        try {
            $offer=Offer::whereId($id)->update([
                'discount'=>$request['discount'],
                'duration'=>$request['duration']
            ]);
        }
        catch (\Exception $e) {
            return response($e->getMessage(),404);
        }
        return response($request,200);
    }


}
