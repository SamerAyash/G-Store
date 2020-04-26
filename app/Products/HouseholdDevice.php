<?php

namespace App\Products;

use Illuminate\Database\Eloquent\Model;

class HouseholdDevice extends Model
{
    protected $hidden=[
        'product_id','created_at','updated_at'
    ];
    public function product(){
        $this->belongsTo('App\product');
    }
}
