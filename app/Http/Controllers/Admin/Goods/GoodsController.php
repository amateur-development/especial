<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/25
 * Time: 16:34
 */

namespace app\Http\Controllers\Admin\Goods;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\ApiResponse;
use app\Models\Goods;
use app\Models\GoodsContent;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;
use Validator;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    use ApiResponse;

    public function lists(Request $request){
        $lists = array();
        return view('admin.goods.lists',compact('lists'));
    }

    public function edit(Request $request){
        $node = array();
        return view('admin.goods.edit',compact('node'));
    }

    public function save(Request $request){
        try {
            $validator = $this->validator($request->all());
            if ($validator->fails()) {
                return $this->error($validator->errors()->first());
            }
            $nowData = Carbon::now();
            $saveData = [
                'user_id' => Auth::guard('sys_users')->id(),
                'title' => $request['title'],
                'cateid_tree' => $request['cateid_tree'],
                'promotion' => $request['promotion'],
                'unit' => intval($request['unit']),
                'market_prince' => $request['market_prince'],
                'recent_quotation' => $request['recent_quotation'],
                'status' => Goods::STATUS_PASS,
                'remark' => $request['remark'],
                'thumb' => $request['thumb'],
                'album' => $request['album'],
                'created_at' => $nowData,
                'updated_at' => $nowData,
            ];
            if ($request->get('id')) {
                Goods::where('id',$request['id'])->update($saveData);
                GoodsContent::where('goods_id',$request['id'])->update(['content' => $request['content']]);
                return $this->successJump(route('admin.goods.lists'), '编辑成功');
            } else {
                $goodId = Goods::insertGetId($saveData);
                if (!empty($request['content'])) {
                    GoodsContent::insert(['goods_id' => $goodId, 'content' => $request['content']]);
                }
                return $this->successJump(route('admin.goods.lists'), '添加成功');
            }

            return $this->error('添加失败');
        }catch (Exception $e){
            Log::warning($e);
            return $this->error('网络异常');
        }
    }

    protected function validator(array $data){
        return Validator::make($data,[
            'title' => 'required|between:3,50',
            'unit' => 'required|integer',
            'market_price' => 'required|numeric',
            'recent_quotation' => 'nullable|numeric',
            'promotion' => 'required|between:3,50',
            'cateid_tree' => 'required|string',
            'remark' => 'nullable|between:10,300',
            'album' => 'required|array',
        ],[
            'title.required' => '必须填写标题',
            'title.between' => '标题长度必须在3~50之间',
            'unit.required' => '请填写库存数量',
            'unit.integer' => '库存数量是整数',
            'market_price.required' => '商品市场价未填写',
            'market_price.numeric' => '你填的是数字吗？',
            'recent_quotation.numeric' => '请填写数字哟',
            'promotion.required' => '写个促销语吧',
            'promotion.between' => '促销语字符长度必须在3~50之间',
            'cateid_tree.required' => '请输入商品标签',
            'cateid_tree.string' => '标签为字符串',
            'remark.between' => '简介字符长度必须在10~300之间',
            'album.required' => '商品轮播图-有图有真相啊',
            'album.array' => '你做过什么嘛？',
        ]);
    }

}