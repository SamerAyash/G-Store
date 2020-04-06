<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function buyer(){
        return $this->belongsTo('App\User');
    }
    public function delivery(){
        return $this->belongsTo('App\Admin');
    }
    public function product(){
        return $this->belongsTo('App\Product');
    }
}
