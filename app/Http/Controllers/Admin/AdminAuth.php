<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Mail\AdminResetPassword;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminAuth extends Controller
{

    public function login() {
        return view('admin.login');
    }
    public function index()
    {
        return view('admin.Home');
    }
    public function dologin() {
        $rememberme = request('rememberme') == 1?true:false;
        if (admin()->attempt(['email' => request('email'), 'password' => request('password')], $rememberme)) {
            return redirect(aroute('home'));
        } else {
            session()->flash('error', trans('admin.inccorrect_information_login'));
            return redirect(aroute('login'));
        }
    }

    public function logout() {
        auth()->guard('admin')->logout();
        return redirect(aroute('login'));
    }

    public function forgetPassword(){
        return view('admin.forgetPassword');
    }
    public function resetPassword(Request $request){
        $admin = Admin::where('email',$request->input('email'))->first();
        if (!empty($admin)){
            $token = app('auth.password.broker')->createToken($admin);
            DB::table('password_resets')->insert(
                [
                    'email'=>$admin->email,
                    'token'=>$token,
                    'created_at'=>Carbon::now()
                ]);
            Mail::to($admin->email)->send(new AdminResetPassword(['admin'=>$admin,'token'=>$token]));

            return back()->with(['success'=>'Reset link was sent ']);
        }
        return back();
    }

    public function resetPasswordWithToken($token){
        $check_token = DB::table('password_resets')
            ->where('token', $token)
            ->where('created_at', '>', Carbon::now()->subHours(2))
            ->first();
        if (!empty($check_token)) {
            return view('admin.resetPassword', ['data' => $check_token]);
        } else {
            return redirect(aroute('forgotPassword'));
        }
    }

    public function updatePassword($token){
        $this->validate(request(),[
            'password'=>'required|confirmed',
            'password_confirmation' => 'required',
        ]);
        $check_token = DB::table('password_resets')->where('token',$token)
            ->where('created_at','>',Carbon::now()->subHour(2))->first();
        if (!empty($check_token)) {
            $admin = Admin::where('email', $check_token->email)->update([
                'password' => bcrypt(request('password'))
            ]);
            DB::table('password_resets')->where('email',$check_token->email)->delete();
            admin()->attempt(['email' => $check_token->email, 'password' => request('password')]);
                return redirect(aroute('home'));
        } else {
            return redirect(aroute('forgotPassword'));
        }
    }
}
