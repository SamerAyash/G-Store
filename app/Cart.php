<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable=['buyer_id','product_id','count'];
    public function product(){
        return $this->belongsTo('App\Product');
    }
    public function buyer(){
        return $this->belongsTo('App\User');
    }

}
