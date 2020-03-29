<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable
{
    use Notifiable,SoftDeletes;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function address(){
        return $this->belongsTo('App\Address');
    }
    public function product(){
        return $this->hasMany('App\Product');
    }
    public function cart(){
        return $this->hasMany('App\Cart');
    }
    public function offer(){
        return $this->hasMany('App\Offer');
    }
    public function category(){
        return $this->belongsToMany('App\Category','seller_categories');
    }
    public function permissions(){
        return $this->belongsToMany('App\Permission','model_has_permissions','user_id','permission_id');
    }
    public function order(){
        return $this->hasMany('App\Order');
    }
}
