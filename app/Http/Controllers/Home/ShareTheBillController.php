<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/23
 * Time: 14:00
 */

namespace app\Http\Controllers\Home;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//拼单
class ShareTheBillController extends Controller
{
    public function lists(Request $request){
        return view('home.pindan.lists');
    }

    public function orderDetail(Request $request){
        return view('home.pindan.detail');
    }

}