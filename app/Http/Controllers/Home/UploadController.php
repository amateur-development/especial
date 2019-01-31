<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/28
 * Time: 10:05
 */

namespace app\Http\Controllers\Home;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\ApiResponse;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Validator;
use Exception;

class UploadController extends Controller
{
    use ApiResponse;

    public function image(Request $request){
        $validator = Validator::make([
            'file' => $request->file,
            'extension' => strtolower($request->file->getClientOriginalExtension())
        ],[
            'file' => 'required',
            'extension' => 'required|in:jpeg,jpg,png,gif,bmp',
        ],[
            'file.*' => '请上传文件',
            'extension.*' => '图片类型不允许',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 0, 'msg' => $validator->errors()->first()]);
        }

        if (!$request->hasFile('file')) {
            return response()->json(['status' => 0, 'msg' => '请上传图片']);
        }

        $fileName = uniqid(true) . '.' . $request->file->getClientOriginalExtension();

        // 请求时携带category 字段，表明来自前台不同的业务逻辑，可做一些相应的操作，默认为空不处理
        if ($request['category'] == 'admin_league_logo') {
            if ($request->file->getSize() > 1024 * 1024 * 3) {
                return response()->json(['status' => -1, 'msg' => '图片大小不能超过3M']);
            }
            // 后台加盟商logo
            try {
                $image = Image::make($request->file->getRealPath());
                if ($image->getWidth() < 400 || $image->getHeight() < 400 || $image->getHeight() != $image->getWidth()) {
                    return response()->json(['status' => -1, 'msg' => '图片尺寸不能低于400*400且保持1:1比例']);
                }

            } catch (Exception $e) {
                return response()->json(['status' => -1, 'msg' => '系统错误']);
            }

        }
        if ($request['category'] == 'admin_league_image') {
            // 后台加盟商企业形象图
            if ($request->file->getSize() > 1024 * 1024 * 3) {
                return response()->json(['status' => -1, 'msg' => '图片大小不能超过3M']);
            }
            try {
                $image = Image::make($request->file->getRealPath());
                if ($image->getWidth() < 1000 || $image->getHeight() < 750 || round($image->getHeight() / 750, 3) != round($image->getWidth() / 1000, 3)) {
                    return response()->json(['status' => -1, 'msg' => '图片尺寸不能低于1000*750且保持4：3比例']);
                }
            } catch (Exception $e) {
                return response()->json(['status' => -1, 'msg' => '系统错误']);
            }
        }

        //(new \Illuminate\Http\UploadedFile)->getRealPath();
        //echo get_class($request->file);die;
        //if ($request->file->getSize() > 1024 * 1024 * 3) { // 超过3M压缩下.
            $image = Image::make($request->file->getRealPath());
            if ($image->getWidth() > 1000) {
                $width = 1000;
                $height = null;
            } else if ($image->getHeight() > 1000) {
                $width = null;
                $height = 1000;
            } else {
                $width = $image->getWidth() / 2;
                $height = $image->getHeight() / 2;
            }
            $image->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            $baseDir = storage_path('app/public/upload/' . date('Ymd') . '/');
            if (!is_dir($baseDir)) {
                mkdir($baseDir,0777,true);//创建目录
                //mkdir($baseDir);
            }
            $image->save($baseDir . $fileName);
            $baseUrl = asset('storage/upload/' . date('Ymd') . '/' . $fileName);
        //} else {
        //    $baseUrl = $request->file('file')->storePubliclyAs('upload/' . date('Ymd'), $fileName, ['disk' => 'public']);
        //}
        $request->file('file')->isValid();
        return response()->json(['status' => 1, 'data' => ['url' => $baseUrl],'location' => $baseUrl]);
    }

}