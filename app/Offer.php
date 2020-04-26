<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable=[
      'discount','duration'
    ];
    protected $hidden=[
        'seller_id',
    ];
    public function seller()
    {
        return $this->belongsTo('App\User','seller_id');
    }
    public function product()
    {
        return $this->belongsTo('App\Product','product_id');
    }

}
