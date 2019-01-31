<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/15
 * Time: 17:16
 */

namespace app\Http\Controllers\Admin\Basis;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\ApiResponse;
use App\Models\Admin\AdminNode;
use App\Models\Admin\Node;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NodeController extends Controller
{
    use ApiResponse;

    public function treeLists(Request $request){
        return view('admin.basis.node_lists');
    }

    public function treeApi(Request $request){
        $nodes = Node::all()->toArray();
        $new = array();
        foreach ($nodes as $a){
            $new[$a['parent_id']][] = ['name'=>$a['title'],'parent_id'=>$a['parent_id'],'id'=>$a['id']];
        }
        $tree = createTree($new, $new[0]);
        return $tree;
    }

    public function edit(Request $request){
        if($request['id']){
            $node = Node::where('id',$request['id'])->first();
        }else{
            $node['id'] = '0';
            $node['title'] = '顶级分类';
            $node['is_show'] = $node['is_dir'] = '';
        }
        return view('admin.basis.node_edit',compact('node'));
    }

    public function save(Request $request){
        $nowTime = \Carbon\Carbon::now()->toDateTimeString();
        if ($request['id']){
            $node = Node::find($request['id']);
            $node['title'] = $request['title'];
            $node['icon'] = $request['icon'];
            $node['sort'] = $request['sort'];
            $node['route'] = $request['route'];
            $node['is_show'] = $request['is_show'];
            $node['is_dir'] = $request['is_dir'];
            $node['updated_at'] = $nowTime;
            if ($node->save()){
                return $this->successJump(route('admin.node.lists'),'编辑成功');
            }
        }else{
            if (empty($request['parent_id'])){
                $parentNode['id'] = '0';
                $parentNode['tree'] = ',';
            }else{
                $parentNode = Node::where('id',$request['parent_id'])->first(['id','tree']);
            }
            $node = new Node();
            $node['title'] = $request['title'];
            $node['icon'] = $request['icon'];
            $node['sort'] = $request['sort'];
            $node['route'] = $request['route'];
            $node['is_show'] = $request['is_show'];
            $node['is_dir'] = $request['is_dir'];
            $node['parent_id'] = $request['parent_id'];
            $node['updated_at'] = $nowTime;
            $node['created_at'] = $nowTime;

            $node->save();
            $node['tree'] = $parentNode['tree'].$node['id'].',';
            AdminNode::insert(['node_id' => $node['id'],
                'admin_id' => $request['admin_id'],
                'created_at' => $nowTime,
                'updated_at' => $nowTime,]);
            if ($node->save()){
                return $this->successJump(route('admin.node.lists'),'保存成功');
            }
        }
        return $this->error('操作失败！');
    }

    public function bind(Request $request){
        if (empty($request['id'])){
            return abort(404,'请选择管理员');
        }
        $hasNodes = AdminNode::where('admin_id',$request->get('id'))->pluck('node_id');
        $nodes = Node::all();
        return view('admin.basis.node_bind',compact('hasNodes','nodes'));
    }

    public function bindSave(Request $request){
        $nodes = $request->get('node');
        if (empty($nodes)){
            return $this->error('请勾选权限');
        }
        $batchDate = array();
        $nowTime = \Carbon\Carbon::now()->toDateTimeString();
        foreach ($nodes as $node){
            $batchDate[] = [
                'node_id' => $node,
                'admin_id' => $request['admin_id'],
                'created_at' => $nowTime,
                'updated_at' => $nowTime,
            ];
        }
        DB::beginTransaction();
        AdminNode::where('admin_id',$request['admin_id'])->delete();
        AdminNode::insert($batchDate);
        DB::commit();

        return $this->successJump(route('admin.users.lists'),'保存成功');
    }

}