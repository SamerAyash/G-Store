<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function seller(){
        $this->belongsTo('App/User');
    }
    public function images(){
        return $this->hasMany('App/ProductImages');
    }
    public function subCategory(){
        return $this->belongsTo('App/SubCategory');
    }
    public function cart(){
        return $this->hasMany('App/Cart');
    }
    public function offer(){
        return $this->hasMany('App/Offer');
    }
    public function order(){
        return $this->hasMany('App/Order');
    }

}
