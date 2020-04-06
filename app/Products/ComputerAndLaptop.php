<?php

namespace App\Products;

use Illuminate\Database\Eloquent\Model;

class ComputerAndLaptop extends Model
{
    public function product(){
        $this->belongsTo('App\product');
    }
}
