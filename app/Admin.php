<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable,SoftDeletes;
    protected $table ='admins';
    protected $with='address';
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
        return $this->belongsTo( 'App\Address');
    }
    public function order(){
        return $this->hasMany('App\Order');
    }
    public function permissions(){
        return $this->belongsToMany('App/Permission','model_has_permissions','admin_id','permission_id');
    }

}
