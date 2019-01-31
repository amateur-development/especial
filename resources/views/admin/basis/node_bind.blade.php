@extends('admin.layouts.base')

@section('styles')
    <style>
        body .layui-tree-skin-shihuang .layui-tree-branch{color: #EDCA50;}
    </style>
@endsection

@section('content')
    <!-- Main content -->
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
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>菜单节点</strong>
                                <a class="btn btn-sm btn-primary" style="color: white" href="{{route('admin.node.edit')}}"> 新增顶级分类</a>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <div class="card-block">
                                        <div class="layui-row layui-col-space15">
                                            <form class="layui-form ajax-form"  method="post" action="{{route('admin.node.bind_save')}}" onsubmit="return false">
                                                <input type="hidden" name="admin_id" value="{{request('id')}}">
                                                <div class="layui-col-md12">
                                                    @foreach($nodes->where('parent_id',0) as $node)
                                                        <div class="layui-card panel">
                                                            <div class="layui-card-header"><input type="checkbox" class="parent-node" name="node[]" lay-skin="primary" title="{{$node->title}}" lay-filter="parent-node" value="{{$node->id}}" @if($hasNodes->contains($node->id)) checked @endif></div>
                                                            <div class="layui-card-body">
                                                                <div class="layui-input-block">
                                                                    @foreach($nodes->where('parent_id',$node->id) as $children)
                                                                        <input type="checkbox" class="sub-node" name="node[]" lay-skin="primary" title="{{$children->title}}" lay-filter="sub-node" value="{{$children->id}}" @if($hasNodes->contains($children->id)) checked @endif>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="layui-form-item">
                                                    <button type="submit" class="layui-btn" lay-submit="" lay-filter="demo2">提交</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
        layui.use(['layer', 'form','element','jquery','layer'], function () {
            var layer = layui.layer
                ,form = layui.form
                ,element = layui.element
                ,$= layui.$
                ,layer=layui.layer;

            form.on('checkbox(parent-node)', function(data){
                var a = data.elem.checked;
                if(a == true){
                    $(this).closest(".panel").find(".sub-node").prop("checked", true);
                    form.render('checkbox');
                }else{
                    $(this).closest(".panel").find(".sub-node").prop("checked", false);
                    form.render('checkbox');
                }

            });
            form.on('checkbox(sub-node)', function(data){
                var a = data.elem.checked;
                if($(this).closest(".panel").find(".sub-node:checked").length == 0){
                    $(this).closest(".panel").find(".parent-node").prop("checked", false);
                    form.render('checkbox');
                }else{
                    $(this).closest(".panel").find(".parent-node").prop("checked", true);
                    form.render('checkbox');
                }

            });
        });
    </script>
@endsection



