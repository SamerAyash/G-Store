<?php

namespace App\Http\Controllers\Admin;

use App\address;
use App\Admin;
use App\Http\Controllers\Controller;
//use App\DataTables\AdminDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\HttpCache\HttpCache;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  /*  public function index(AdminDataTable $admins)
    {
        return $admins->render('admin.adminViews.index');
    }*/
    public function index()
    {
        return view('admin.acountsTable');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSupervisors()
    {
        $supervisors =Admin::where('type','=','supervisor')
            ->join('addresses','admins.address_id','=','addresses.id')
            ->select(['admins.id','name','email','id_number','phone','image','addresses.city','addresses.area',
                'addresses.street','addresses.buildingNumber','birthDate','notes','admins.created_at','admins.updated_at'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return response($supervisors);
    }

    public function storeSupervisor(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8|confirmed:password_confirmation',
            'id_number'=>'required|numeric|digits:10',
            'phone'=>'required|numeric|digits:10|regex:/(05[96])[0-9]/|unique:users,phone',
            'city'=>'required',
            'area'=>'required',
            'street'=>'required',
            'buildingNumber'=>'required|numeric',
            'birthDate'=>'required|nullable|date',
        ]);

        $address=new address();
        $address->city=$request->input('city');
        $address->area=$request->input('area');
        $address->street=$request->input('street');
        $address->buildingNumber=$request->input('buildingNumber');
        $address->save();

        $admin=new Admin();
        $admin->name=$request->input('name');
        $admin->email=$request->input('email');
        $admin->password=Hash::make($request->input('password'));
        $admin->phone=$request->input('phone');
        $admin->address_id=$address->id;
        $admin->id_number=$request->input('id_number');
        $admin->birthDate=$request->input('birthDate');
        $admin->type='supervisor';
        $admin->notes=$request->input('notes');
        $admin->save();
        return response(null,200);
    }
    public function updateSupervisor(Request $request, $id)
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
        ]);

        $supervisor = Admin::findOrFail($id);
        address::whereId($supervisor->address_id)->update([
            'city'=>$request->input('city'),
            'area'=>$request->input('area'),
            'street'=>$request->input('street'),
            'buildingNumber'=>$request->input('buildingNumber'),
        ]);
        $supervisor->name=$request->input('name');
        $supervisor->email=$request->input('email');
        $supervisor->phone=$request->input('phone');
        $supervisor->id_number=$request->input('id_number');
        $supervisor->birthDate=$request->input('birthDate');
        $supervisor->notes=$request->input('notes');
        $supervisor->save();
        return response(null,200);
    }

    public function getDelivery()
    {
        $supervisors =Admin::where('type','=','delivery')
            ->join('addresses','admins.address_id','=','addresses.id')
            ->select(['admins.id','name','email','id_number','phone','image','addresses.city','addresses.area',
                'addresses.street','addresses.buildingNumber','birthDate','notes','admins.created_at','admins.updated_at'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return response($supervisors);
    }

    public function storeDelivery(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8|confirmed:password_confirmation',
            'id_number'=>'required|numeric|digits:10',
            'phone'=>'required|numeric|digits:10|regex:/(05[96])[0-9]/|unique:users,phone',
            'city'=>'required',
            'area'=>'required',
            'street'=>'required',
            'buildingNumber'=>'required|numeric',
            'birthDate'=>'required|nullable|date',
        ]);

        $address=new address();
        $address->city=$request->input('city');
        $address->area=$request->input('area');
        $address->street=$request->input('street');
        $address->buildingNumber=$request->input('buildingNumber');
        $address->save();

        $delivery=new Admin();
        $delivery->name=$request->input('name');
        $delivery->email=$request->input('email');
        $delivery->password=Hash::make($request->input('password'));
        $delivery->phone=$request->input('phone');
        $delivery->address_id=$address->id;
        $delivery->id_number=$request->input('id_number');
        $delivery->birthDate=$request->input('birthDate');
        $delivery->type='delivery';
        $delivery->notes=$request->input('notes');
        $delivery->save();
        return response(null,200);
    }
    public function updateDelivery(Request $request, $id)
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
        ]);

        $delivery = Admin::findOrFail($id);
        address::whereId($delivery->address_id)->update([
            'city'=>$request->input('city'),
            'area'=>$request->input('area'),
            'street'=>$request->input('street'),
            'buildingNumber'=>$request->input('buildingNumber'),
        ]);
        $delivery->name=$request->input('name');
        $delivery->email=$request->input('email');
        $delivery->phone=$request->input('phone');
        $delivery->id_number=$request->input('id_number');
        $delivery->birthDate=$request->input('birthDate');
        $delivery->notes=$request->input('notes');
        $delivery->save();
        return response(null,200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Admin::destroy($id);
       return response(null);
    }
}