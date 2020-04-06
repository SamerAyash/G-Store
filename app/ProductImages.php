<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    public function product(){
        return $this->belongsTo('App\Product');
    }
}
