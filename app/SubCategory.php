<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $hidden = [
        'created_at', 'updated_at',
    ];
    public function product(){
        return $this->hasMany('App\Product','subCategory_id');
    }
    public function category(){
        return $this->belongsTo('App\Category');
    }

}
