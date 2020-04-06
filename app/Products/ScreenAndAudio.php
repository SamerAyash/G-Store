<?php

namespace App\Products;

use Illuminate\Database\Eloquent\Model;

class ScreenAndAudio extends Model
{
    public function product(){
        $this->belongsTo('App\product');
    }
}
