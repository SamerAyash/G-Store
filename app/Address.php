<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class address extends Model
{
    public function user(){
        return $this->hasOne('App/User');
    }

    public function admin(){
        return $this->hasOne('App/Admin');
    }
}
