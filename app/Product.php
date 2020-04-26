<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function seller(){
        return $this->belongsTo('App\User');
    }
    public function images(){
        return $this->hasMany('App\ProductImages');
    }
    public function subCategory(){
        return $this->belongsTo('App\SubCategory','subCategory_id','id');
    }
    public function cart(){
        return $this->hasMany('App\Cart');
    }
    public function offer(){
        return $this->hasone('App\Offer');
    }
    public function order(){
        return $this->hasMany('App\Order');
    }
    public function beautyAndHelth(){
        return $this->hasOne('App\Products\BeautyAndHelth');
    }
    public function camera(){
        return $this->hasOne('App\Products\Camera');
    }
    public function computerAndLaptop(){
        return $this->hasOne('App\Products\ComputerAndLaptop');
    }
    public function home(){
        return $this->hasOne('App\Products\Home');
    }
    public function houseHoldDevice(){
        return $this->hasOne('App\Products\HouseHoldDevice');
    }
    public function mobileAndTablet(){
        return $this->hasOne('App\Products\MobileAndTablet');
    }
    public function screenAndAudio(){
        return $this->hasOne('App\Products\ScreenAndAudio');
    }
    public function sportAndGames(){
        return $this->hasOne('App\Products\SportAndGames');
    }

    public function checkSubClass($subcategory){
        if($subcategory == 'Perfumes'||
            $subcategory =='Make-up'||
            $subcategory =='Body care devices'||
            $subcategory =='Creams'){
            return 'beautyAndHelth';
        }
        if($subcategory == 'Cameras'){
            return'camera';
        }
        if($subcategory == 'Computers & Laptops'){
            return'computerAndLaptop';
        }
        if($subcategory == 'Kitchen & Dining'||
            $subcategory =='Equipment and tools'||
            $subcategory =='Furniture and Decoration'||
            $subcategory =='Cleaning materials'){
            return'home';
        }
        if($subcategory == 'Household Devices'){
            return'houseHoldDevice';
        }
        if($subcategory == 'Mobiles'||$subcategory == 'Tablets'){
            return'mobileAndTablet';
        }
        if($subcategory == 'Screens & Audio'){
            return'screenAndAudio';
        }
        if($subcategory == 'Sport & Games'){
            return'sportAndGames';
        }
    }
}
