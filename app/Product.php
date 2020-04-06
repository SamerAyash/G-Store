<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function seller(){
        $this->belongsTo('App\User');
    }
    public function images(){
        return $this->hasMany('App\ProductImages');
    }
    public function subCategory(){
        return $this->belongsTo('App\SubCategory');
    }
    public function cart(){
        return $this->hasMany('App\Cart');
    }
    public function offer(){
        return $this->hasMany('App\Offer');
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
}
