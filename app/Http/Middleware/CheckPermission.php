<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user('admin') === null){
            return response('Insufficient permissions',401);
        }
        $actions =$request->route()->getAction();
        $roles =is_array($actions['role'])? $actions['role']:null;
        if ($roles != null){
            $state=false;
            foreach ($roles as $role){
                if($role == Auth::guard('admin')->user()->type){
                    $state=true;
                    break;
                }
                $state=false;
            }
            if ($state == false){
                return redirect()->back();
            }
        }
        $permissions =is_array($actions['permission'])?$actions['permission']:null;
        if ($request->user('admin')->hasAllPermissions($permissions) || !$permissions){
            return $next($request);
        }
        return redirect()->back();
    }
}

