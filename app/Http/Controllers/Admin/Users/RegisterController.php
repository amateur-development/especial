<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/11
 * Time: 17:14
 */

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Traits\ApiResponse;
use App\Models\Admin\SuperUser;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use ApiResponse;

    public function userLists(Request $request){
        $lists = SuperUser::orderBy('created_at','desc')->paginate(1);
        return view('admin.users.lists',compact('lists'));
    }

    public function showRegisterForm(Request $request){
        $user = array(
            'status' => '',
        );
        if ($request->get('id')){
            $user = SuperUser::where('id',$request->get('id'))->first(['username','password','plaintext_key','realname','mobile','status']);
        }
        return view('admin.users.register',compact('user'));
    }

    public function register(Request $request){
        $validator = $this->validator($request->all());
        if ($validator->fails()){
            return $this->error($validator->errors()->first());
        }
        if ($request->get('id')){
            if ($this->update($request->all())){
                return $this->successJump(route('admin.users.lists'),'用户信息更新成功');
            }
            $msg = '用户信息更新失败';
        }else{
            if ($this->create($request->all())){
                return $this->successJump(route('admin.users.lists'),'新增用户成功');
            }
            $msg = '添加用户失败';
        }
        return $this->error($msg);
    }

    protected function validator(array $data){
        return Validator::make($data,[
            'username' => 'required|unique:sys_users|between:3,20',
            'password' => 'required|between:15,30|confirmed',
            'password_confirmation' => 'required',
            'realname' => 'required|between:2,20',
            'mobile' => 'required|min:11|max:11',
        ]/*,[
            'username.required' => '账户名称不能为空',
            'username.unique' => '账户名称已存在（请重新填写）',
            'username.between' => '账户名称长度3~20字符以内',
            'password.required' => '密码不能为空请设置',
            'password.between' => '密码长度15~30字符以内',
            'password.confirmed' => '两次密码输入不一致',
            'password_confirmation' => '两次密码输入不一致',
            'mobile' => '请输入正确电话号码',
        ]*/);
    }

    protected function create(array $data){
        return SuperUser::create([
            'username' => $data['username'],
            'password' =>Hash::make($data['password']),
            'plaintext_key' => $data['password'],
            'realname' => $data['realname'],
            'mobile' => $data['mobile'],
            'status' => SuperUser::STATUS_NORMAL,
            'created_at' => date('Y-m-d H:i:s',time()),
            'updated_at' => date('Y-m-d H:i:s',time()),
        ]);
    }

    protected function update(array $data){
        return SuperUser::where('id',$data['id'])->update([
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'plaintext_key' => $data['password'],
            'realname' => $data['realname'],
            'mobile' => $data['mobile'],
            'status' => $data['status'] ?? SuperUser::STATUS_NORMAL,
            'updated_at' =>date('Y-m-d H:i:s',time()),
        ]);
    }

    public function disable(Request $request){
        if (SuperUser::where('id',$request->get('id'))->first()){print_r($request->all());die;
            SuperUser::where('id',$request->get('id'))->update(['status'=>SuperUser::STATUS_DISABLED]);
            return $this->success('','success');
        }
        return $this->error('信息异常刷新再试');
    }

    public function delete(Request $request){
        if (SuperUser::where('id',$request->get('id'))->first()){print_r($request->all());die;
            SuperUser::where('id',$request->get('id'))->delete();
            return true;
        }
        return $this->error('信息异常刷新再试');
    }
}