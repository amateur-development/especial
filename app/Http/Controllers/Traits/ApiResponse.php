<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/11
 * Time: 16:00
 */

namespace App\Http\Controllers\Traits;

/**
 * ajax 返回结构体
 * Trait ApiResponse
 * @package app\Http\Controllers\Traits
 */

trait ApiResponse
{
    public function success($data=[],$msg=''){
        return $this->apiResponse(1,$data,$msg);
    }

    public function error($msg='',$data=[],$status=0){
        return $this->apiResponse($status,$data,$msg);
    }

    public function successJump($jumpUrl = '',$msg=''){
        return $this->apiResponse(1,['jump_url'=>$jumpUrl],$msg);
    }

    public function errorJump($jumpUrl = '',$msg=''){
        return $this->apiResponse(0,['jump_url'=>$jumpUrl],$msg);
    }

    public function apiResponse($status,$data=[],$msg=''){
        return request()->expectsJson()
            ? response()->json(['status'=>$status,'msg'=>$msg,'data'=>$data])
            : abort(202);
    }

}