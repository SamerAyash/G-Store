<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    public function buyer()
    {
        return $this->belongsTo('App/User');
    }
    public function product(){
        $this->belongsTo('App/Product');
    }

}
