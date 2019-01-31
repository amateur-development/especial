<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/11
 * Time: 10:17
 */

namespace App\Http\Controllers\Admin\Dashboard;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request){
        return view('admin.dashboard.index');
    }

}