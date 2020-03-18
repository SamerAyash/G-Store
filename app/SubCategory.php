<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    public function product(){
        return $this->hasMany('App/Product');
    }
    public function category(){
        return $this->belongsTo('App/Category');
    }

}
