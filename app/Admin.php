<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table ='admins';

    public function address(){
        return $this->belongsTo('App/Address');
    }
    public function order(){
        return $this->hasMany('App/Order');
    }


}
