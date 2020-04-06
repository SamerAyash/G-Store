<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function users(){
        return $this->hasMany('App\User','user_id');
    }
    public function admins(){
        return $this->hasMany('App\Admin','admin_id');
    }
}
