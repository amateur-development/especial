@extends('admin.layouts.base')

@section('styles')
@endsection

@section('content')
    <main class="main">

        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item"><a href="#">Admin</a>
            </li>
            <li class="breadcrumb-item active">Dashboard</li>

            <!-- Breadcrumb Menu-->
            <li class="breadcrumb-menu hidden-md-down">
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    <a class="btn btn-secondary" href="#"><i class="icon-speech"></i></a>
                    <a class="btn btn-secondary" href="./"><i class="icon-graph"></i> &nbsp;Dashboard</a>
                    <a class="btn btn-secondary" href="#"><i class="icon-settings"></i> &nbsp;Settings</a>
                </div>
            </li>
        </ol>


        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-align-justify"></i> 商品列表 <a class="btn btn-sm btn-primary" style="color: white" href="{{route('admin.goods.edit')}}"> 新增顶级分类</a>
                            </div>
                            <div class="card-block">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>账号</th>
                                        <th>真实姓名</th>
                                        <th>联系电话</th>
                                        <th>账号状态</th>
                                        <th>创建时间</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($lists as $list)
                                        <tr data-id="{{$list['id']}}">
                                            <td>{{$list['username'] ?? ''}}</td>
                                            <td>{{$list['realname'] ?? ''}}</td>
                                            <td>{{$list['mobile'] ?? ''}}</td>
                                            <td>
                                                <span class="badge {{\App\Models\Admin\SuperUser::BADGE[$list['status']]}}">{{['1'=>'正常','2'=>'禁用'][$list['status']]}}</span>
                                            </td>
                                            <td>{{$list['created_at'] ?? ''}}</td>
                                            <td>
                                                @if(in_array(auth()->user()->username,['admin']))
                                                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="window.location.href='{{route('admin.node.bind',['id'=>$list['id']])}}'">权限编辑</button>
                                                @endif
                                                <button type="button" class="btn btn-outline-warning btn-sm" onclick="window.location.href='{{route('admin.register.form',['id'=>$list['id']])}}'">修改</button>
                                                <button type="button" id="disable" class="btn btn-outline-secondary btn-sm">禁用</button>
                                                <button type="button" id="delete" class="btn btn-outline-danger btn-sm">删除</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{--{{ $lists->links() }}--}}
                            </div>
                        </div>
                    </div>
                    <!--/.col-->
                </div>
                <!--/.row-->
            </div>

        </div>
        <!-- /.conainer-fluid -->
    </main>
@endsection

@section('scripts')
    <script type="text/javascript">
        $("#disable").click(function () {
            var _this = $(this);
            var method = 'post';
            var action = "{{route('admin.user.disable')}}";
            var data = {id:_this.parents('tr').attr('data-id'),_token:"{!! csrf_token() !!}"};
            ajaxRequest(method,action,data);
            return false;
        });
        $("#delete").click(function () {
            var _this = $(this);
            var method = 'post';
            var action = "{{route('admin.user.delete')}}";
            var data = {id:_this.parents('tr').attr('data-id'),_token:"{!! csrf_token() !!}"};
            ajaxRequest(method,action,data);
            return false;
        });

        var ajaxRequest = function (method,action,data) {
            $.ajax({
                type:method,
                url:action,
                data:data,
                dataType:"json",
                success:function(resp){
                    if(resp.status === 1){
                        if(resp.data.hasOwnProperty('jump_url')){
                            layui.use(['layer', 'form'], function() {
                                var layer = layui.layer;
                                layer.msg(resp.msg || 'success', {icon: 1});
                            });
                            setTimeout(function(){
                                window.location.href = resp.data.jump_url;
                            },3000);
                        }else{
                            location.reload();
                        }
                    }else{
                        layui.use(['layer', 'form'], function() {
                            var layer = layui.layer;
                            layer.alert(resp.msg || "操作失败", {icon: 2}, function () {
                                setTimeout(function () {
                                    location.reload();
                                }, 3000);
                            });
                        });
                    }
                },
                error:function(resp){
                    layui.use(['layer', 'form'], function() {
                        var layer = layui.layer;
                        layer.alert('操作异常,请稍后再试', {icon: 2});
                    });
                }
            });
        }
    </script>
@endsection