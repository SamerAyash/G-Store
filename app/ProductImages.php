<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    protected $hidden = [
        'created_at', 'updated_at','product_id'
    ];
    public function product(){
        return $this->belongsTo('App\Product');
    }
}
