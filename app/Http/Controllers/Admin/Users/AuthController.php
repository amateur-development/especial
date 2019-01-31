<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/10
 * Time: 16:53
 */

namespace App\Http\Controllers\Admin\Users;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\ApiResponse;
use App\Models\Admin\SuperUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ApiResponse;

    public function showLoginForm(){
        return view('admin.users.login');
    }

    public function login(Request $request){
        $credentials = $request->only('username','password');
        $credentials['status'] = SuperUser::STATUS_NORMAL;
        if (Auth::guard('sys_users')->attempt($credentials)){
            return $this->successJump('dashboard','登录成功');
        }
        return $this->error('帐号或密码错误');
    }

    public function logout(){
        Auth::guard('sys_users')->logout();
        return redirect()->intended('admin/login');
    }

}