<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellerCategory extends Model
{
    public function seller(){
        return $this->hasMany('App\User');
    }
    public function category(){
        return $this->hasMany('App\Category');
    }
}
