<?php

namespace App\Http\Controllers\Admin;

use App\address;
use App\Http\Controllers\Controller;
use App\Permission;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getBuyers()
    {
        $buyers=User::with('permissions')->where('type', '=', 'buyer')
            ->join('addresses','users.address_id','=','addresses.id')
            ->select(['users.id','name','email','image','id_number','phone','addresses.city','addresses.area',
                'addresses.street','addresses.buildingNumber','birthDate','totalAmount','notes','users.created_at','users.updated_at'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return response($buyers);
    }
    public function getSellers(){
       $sellers=User::with('permissions')->where('type', '=', 'seller')
            ->join('addresses','users.address_id','=','addresses.id')
            ->select(['users.id','name','email','image','id_number','phone','addresses.city','addresses.area',
                'addresses.street','addresses.buildingNumber','birthDate',
                'totalAmount','productsCount','shopName','notes','users.created_at','users.updated_at'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return response($sellers);
    }

    public function updateSeller(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email|unique:users,email,'.$id. ',id',
            'id_number'=>'required|numeric|digits:10',
            'phone'=>'required|numeric|digits:10|regex:/(05[96])[0-9]/|unique:users,phone,'.$id.',id',
            'city'=>'required',
            'area'=>'required',
            'street'=>'required',
            'productsCount'=>'required|numeric',
            'shopName'=>'required',
            'buildingNumber'=>'required|numeric',
            'birthDate'=>'required|nullable|date',
            'totalAmount'=>'required|numeric',
        ]);

        $seller = User::findOrFail($id);
        address::whereId($seller->address_id)->update([
            'city'=>$request->input('city'),
            'area'=>$request->input('area'),
            'street'=>$request->input('street'),
            'buildingNumber'=>$request->input('buildingNumber'),
        ]);
        $seller->name=$request->input('name');
        $seller->productsCount=$request->input('productsCount');
        $seller->shopName=$request->input('shopName');
        $seller->email=$request->input('email');
        $seller->phone=$request->input('phone');
        $seller->id_number=$request->input('id_number');
        $seller->birthDate=$request->input('birthDate');
        $seller->totalAmount=$request->input('totalAmount');
        $seller->notes=$request->input('notes');
        $seller->save();
        return response(null);
    }
    public function updateBuyer(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email|unique:users,email,'.$id. ',id',
            'id_number'=>'required|numeric|digits:10',
            'phone'=>'required|numeric|digits:10|regex:/(05[96])[0-9]/|unique:users,phone,'.$id.',id',
            'city'=>'required',
            'area'=>'required',
            'street'=>'required',
            'buildingNumber'=>'required|numeric',
            'birthDate'=>'required|nullable|date',
            'totalAmount'=>'required|numeric',
        ]);

        $buyer = User::findOrFail($id);
        address::whereId($buyer->address_id)->update([
            'city'=>$request->input('city'),
            'area'=>$request->input('area'),
            'street'=>$request->input('street'),
            'buildingNumber'=>$request->input('buildingNumber'),
        ]);
        $buyer->name=$request->input('name');
        $buyer->email=$request->input('email');
        $buyer->phone=$request->input('phone');
        $buyer->id_number=$request->input('id_number');
        $buyer->birthDate=$request->input('birthDate');
        $buyer->totalAmount=$request->input('totalAmount');
        $buyer->notes=$request->input('notes');
        $buyer->save();
        $buyer->permissions()->detach();
        if ($request['active'] =='active'){
            $buyer->permissions()->attach(Permission::where('name','active')->first());
        }
        return response(null);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return response(null);
    }
}
