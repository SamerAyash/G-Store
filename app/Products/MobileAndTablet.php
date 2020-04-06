<?php

namespace App\Products;

use Illuminate\Database\Eloquent\Model;

class MobileAndTablet extends Model
{
    public function product(){
        $this->belongsTo('App\product');
    }
}
