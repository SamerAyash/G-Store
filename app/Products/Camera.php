<?php

namespace App\Products;

use Illuminate\Database\Eloquent\Model;

class Camera extends Model
{
    public function product(){
        $this->belongsTo('App\product');
    }
}
