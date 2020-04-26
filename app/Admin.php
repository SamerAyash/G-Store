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
        return $this->belongsToMany('App\Permission','model_has_permissions','admin_id','permission_id')->addSelect('name','permission_id');
    }
    public function hasAllPermissions($permissions){
        if (is_array($permissions)){
            $state=false;
            foreach ($permissions as $permission){
                if ($this->hasPermission($permission)){
                    $state=true;
                    break;
                }
                $state=false;
            }
            if ($state == true){
                return true;
            }
        }
        else{
            if ($this->hasPermission($permissions)){
                return true;
            }
        }
        return false;
    }
    public function hasPermission($permission){
        if ($this->permissions()->where('name',$permission)->first()){
            return true;
        }
        return false;
    }

}
