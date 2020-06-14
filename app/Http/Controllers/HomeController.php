<?php

namespace App\Http\Controllers;

use App\address;
use App\Category;
use App\Offer;
use App\Product;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::with('subCategory')->select('id','name')->get();
        ////////////////////////////////////////////////////////////
        $bestSales = Product::with(['offer'=>function($q){
                $q->addSelect('discount','product_id');
                }])
            ->orderByDesc('ratingCount')
            ->where('isAccept','=',1)
            ->where('isHidden','=',0)
            ->select('id','title','price','mainImage')
            ->take('100');
        $bestSales = $bestSales->inRandomOrder()->distinct()->take(12)->get();
        ////////////////////////////////////////////////////////////
        $recommended =Product::with(['offer'=>function($q){
            $q->addSelect('discount','product_id');
        }])
            ->where('isAccept','=',1)
            ->where('isHidden','=',0)
            ->inRandomOrder()->distinct()
            ->select('id','title','price','mainImage')
            ->take('18')->get();
        ////////////////////////////////////////////////////////////
        $favoritePros = Product::orderByDesc('rate')
            ->orderByDesc('ratingCount')
            ->where('isAccept','=',1)
            ->where('isHidden','=',0)
            ->select('id','title','mainImage')
            ->take('6')
            ->get();
        ////////////////////////////////////////////////////////////
        $foodMarket = Product::with(['offer'=>function($q){
            $q->addSelect('discount','product_id');
        }])
            ->whereHas('subCategory',function ( $q){
                $q->with('category')
                    ->whereHas('category',function ( $q){
                        $q->where('name','Food Market');
                    });
            })
            ->where('isAccept','=',1)
            ->where('isHidden','=',0)
            ->take(12)->get();
        ////////////////////////////////////////////////////////////
        $mobiles  = Product::with(['offer'=>function($q){
            $q->addSelect('discount','product_id');
        }])
            ->whereHas('subCategory',function ( $q){
                $q->with('category')
                    ->whereHas('category',function ( $q){
                        $q->where('name','Mobiles & Tablets');
                    });
            })
            ->where('isAccept','=',1)
            ->where('isHidden','=',0)
            ->take(12)->get();
        ////////////////////////////////////////////////////////////
        $electronics  = Product::with(['offer'=>function($q){
            $q->addSelect('discount','product_id');
        }])
            ->whereHas('subCategory',function ( $q){
                $q->with('category')
                    ->whereHas('category',function ( $q){
                        $q->where('name','Electronics');
                    });
            })
            ->where('isAccept','=',1)
            ->where('isHidden','=',0)
            ->take(12)->get();
        ////////////////////////////////////////////////////////////
        $beauty  = Product::with(['offer'=>function($q){
            $q->addSelect('discount','product_id');
        }])
            ->whereHas('subCategory',function ( $q){
                $q->with('category')
                    ->whereHas('category',function ( $q){
                        $q->where('name','Beauty & Health');
                    });
            })
            ->where('isAccept','=',1)
            ->where('isHidden','=',0)
            ->take(12)->get();
        ////////////////////////////////////////////////////////////
        $sport  = Product::with(['offer'=>function($q){
            $q->addSelect('discount','product_id');
        }])
            ->whereHas('subCategory',function ( $q){
                $q->with('category')
                    ->whereHas('category',function ( $q){
                        $q->where('name','Sport & Games');
                    });
            })
            ->where('isAccept','=',1)
            ->where('isHidden','=',0)
            ->take(12)->get();
        ////////////////////////////////////////////////////////////
        $home  = Product::with(['offer'=>function($q){
            $q->addSelect('discount','product_id');
        }])
            ->whereHas('subCategory',function ( $q){
                $q->with('category')
                    ->whereHas('category',function ( $q){
                        $q->where('name','Home');
                    });
            })
            ->where('isAccept','=',1)
            ->where('isHidden','=',0)
            ->take(12)->get();
        ////////////////////////////////////////////////////////////
        $offers =Offer::with('product')
            ->whereHas('product',function($q){
                $q->where('isAccept','=',1)
                    ->where('isHidden','=',0)
                    ->select('id','title','price','mainImage');
            })
            ->where('duration','1')
            ->select('discount','product_id')
            ->inRandomOrder()
            ->distinct()
            ->take(12)
            ->get();
        ////////////////////////////////////////////////////////////

        return view('index',compact(['categories','bestSales','recommended',
            'favoritePros','foodMarket','offers','mobiles','electronics','beauty','sport','home']));
    }

    public function getProduct($id){

            $product =Product::with(['offer'=>function($q){
                $q->addSelect('duration','discount','product_id');
            }])
            ->with(['subCategory'=>function($q){
                $q->with('category');
            }])
                ->with(['seller'=>function($q){
                    $q->addSelect('id','name','shopName','address_id')
                        ->with(['address'=>function($q){
                            $q->addSelect('id','area','buildingNumber','street','city');
                        }]);
                }])
                ->with('images')
                ->select('id','title','description','mainImage','amount','price',
                    'rate','ratingCount','brand','seller_id','subCategory_id')
                ->where('isAccept','=',1)
                ->where('isHidden','=',0)
                ->find($id);
            if (!isset($product)){
                return redirect()->back();
            }
            $subClass=$product->checkSubClass($product->subCategory->name);
            $product->$subClass;
            ////////////////////////////////////////////////////
            $seller_id= $product->seller_id;
            $category= $product->subCategory->category->name;
            ////////////////////////////////////////////////////
            $sellerProducts =Product::with(['offer'=>function($q){
                $q->addSelect('discount','product_id');
            }])
                ->whereHas('subCategory',function ( $q) use ($category){
                    $q->with('category')
                        ->whereHas('category',function ( $q) use ($category){
                            $q->where('name',$category);
                        });
                })
                ->where('seller_id',$seller_id)
                ->where('id','!=',$product->id)
                ->where('isAccept','=',1)
                ->where('isHidden','=',0)
                ->inRandomOrder()
                ->take(12)->get();
            ////////////////////////////////////////////////////
            $similarProducts =Product::with(['offer'=>function($q){
                $q->addSelect('discount','product_id');
            }])
                ->whereHas('subCategory',function ( $q) use ($category){
                    $q->with('category')
                        ->whereHas('category',function ( $q) use ($category){
                            $q->where('name',$category);
                        });
                })
                ->where('seller_id','!=',$seller_id)
                ->where('id','!=',$product->id)
                ->where('isAccept','=',1)
                ->where('isHidden','=',0)
                ->inRandomOrder()
                ->take(12)->get();

        return view('product',compact(['product','sellerProducts','similarProducts']));
    }
    public function login(){
        if (auth()->check()){
            return redirect(route('home'));
        }
        return view('login');
    }
    public function register(){
        if (auth()->check()){
            return redirect(route('home'));
        }
        return view('register');
    }
    public function dologin(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|max:255|email',
            'password' => 'required|string',
        ]);
        if (auth('web')->attempt(['email' => request('email'), 'password' => request('password')], 1)) {
            if (auth()->user()->type == 'buyer') {
                return route('home');
            }
            if (auth()->user()->type == 'seller') {
                return route('home');
            }

        } else {
            $error= trans('admin.inccorrect_information_login');
            return response()->json(['error'=>$error]);
        }
    }
    public function doRegister(Request $request){
        if ($request->input('is_seller')){
            $this->validate($request,[
                'first_name'=>'required|string',
                'last_name'=>'required|string',
                'email'=>'required|email|unique:users',
                'password'=>'required|string',
                'id_number'=>'required|numeric|digits:10',
                'phone'=>'required|numeric|digits:10|regex:/(05[96])[0-9]/|unique:users',
                'city'=>'required|string|in:gaza,dair al balah,maghazi,zuwaida,nuseirat,khan younes,rafah',
                'area'=>'required|string',
                'street'=>'required|string',
                'building_number'=>'required|numeric',
                'birth_date'=>'required|date',
                'gender'=>'required|string|in:male,female',
                'shop_name'=>'required|string|unique:users,shopName',
            ]);
            $address=address::create([
                'city'=>$request->input('city'),
                'area'=>$request->input('area'),
                'street'=>$request->input('street'),
                'buildingNumber'=>$request->input('building_number'),
            ]);
            $seller=new User();
                $seller->name=$request->input('first_name').' '.$request->input('last_name');
                $seller->shopName=$request->input('shop_name');
                $seller->email=$request->input('email');
                $seller->password=Hash::make($request->input('password'));
                $seller->phone=$request->input('phone');
                $seller->id_number=$request->input('id_number');
                $seller->birthDate=$request->input('birth_date');
                $seller->gender=$request->input('gender');
                $seller->address_id=$address->id;
                $seller->type='seller';
            $seller->save();
            \auth('web')->attempt(['email' => $request->email, 'password' => $request->password]);
            return response()->json(route('home'));
        }
        else if (!$request->input('is_seller')){
            $this->validate($request,[
                'first_name'=>'required|string',
                'last_name'=>'required|string',
                'email'=>'required|email|unique:users',
                'password'=>'required|string',
                'id_number'=>'required|numeric|digits:10',
                'phone'=>'required|numeric|digits:10|regex:/(05[96])[0-9]/|unique:users',
                'city'=>'required|string|in:gaza,dair al balah,maghazi,zuwaida,nuseirat,khan younes,rafah',
                'area'=>'required|string',
                'street'=>'required|string',
                'building_number'=>'required|numeric',
                'birth_date'=>'required|date',
                'gender'=>'required|string|in:male,female',
            ]);
            $address=address::create([
                'city'=>$request->input('city'),
                'area'=>$request->input('area'),
                'street'=>$request->input('street'),
                'buildingNumber'=>$request->input('building_number'),
            ]);
            $buyer=new User();
            $buyer->name=$request->input('first_name').' '.$request->input('last_name');
            $buyer->shopName=$request->input('shop_name');
            $buyer->email=$request->input('email');
            $buyer->password=Hash::make($request->input('password'));
            $buyer->phone=$request->input('phone');
            $buyer->id_number=$request->input('id_number');
            $buyer->birthDate=$request->input('birth_date');
            $buyer->gender=$request->input('gender');
            $buyer->address_id=$address->id;
            $buyer->type='buyer';
            $buyer->save();
            \auth('web')->attempt(['email' => $request->email, 'password' => $request->password]);
            return response()->json(route('home'));

        }
        return response()->json();
    }
    public function logout(){
        Auth::logout();
        return redirect(route('home'));
    }

}
