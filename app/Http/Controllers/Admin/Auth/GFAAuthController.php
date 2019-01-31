<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/10
 * Time: 10:18
 */

namespace App\Http\Controllers\Admin\Auth;


use App\Http\Controllers\Controller;

/*身份认证系统*/
class GFAAuthController extends Controller
{
    public function showLoginForm(){
        return view('admin.auth.login');
    }

}