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
                    <div class="col-md-6 mb-2">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#home3" role="tab" aria-controls="home"><i class="icon-note"></i> 新增</a>
                            </li>
                            @if(!empty($node['id']))
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile"><i class="icon-pencil"></i> 修改</a>
                            </li>
                            @endif
                            {{--<li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#messages3" role="tab" aria-controls="messages"><i class="icon-pie-chart"></i> Charts</a>
                            </li>--}}
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="home3" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-block">
                                            <form action="{{route('admin.node.save')}}" method="post" enctype="multipart/form-data" class="form-horizontal ajax-form" onsubmit="return false">
                                                <div class="form-group row">
                                                    <label class="col-md-3 form-control-label">上级类目</label>
                                                    <div class="col-md-9">
                                                        <p class="form-control-static">{{$node['title'] ?? ''}}</p>
                                                        <input type="hidden" name="parent_id" class="form-control" value="{{$node['id'] ?? '0'}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 form-control-label">类目名称</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="title" class="form-control" placeholder="请输入目录名称">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 form-control-label">图标</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="icon" class="form-control" placeholder="<域名/template/icons-simple-line-icons.html>选择图标">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 form-control-label">链接地址</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="route" class="form-control" placeholder="路由别名:“public.home.index”">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 form-control-label">排序</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="sort" class="form-control" placeholder="越大越靠前int(10)">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 form-control-label" for="select">是否展示</label>
                                                    <div class="col-md-9">
                                                        <select id="select" name="is_show" class="form-control">
                                                            <option value="1">显示</option>
                                                            <option value="0">隐藏</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 form-control-label">是否为目录</label>
                                                    <div class="col-md-9">
                                                        <label class="radio-inline" for="inline-radio1">
                                                            <input type="radio" id="inline-radio1" name="is_dir" value="1">是
                                                        </label>
                                                        <label class="radio-inline" for="inline-radio2">
                                                            <input type="radio" id="inline-radio2" name="is_dir" value="0">链接
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group form-actions">
                                                    <button type="submit" class="btn btn-primary"> 确定新增</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!--/.col-->
                                </div>
                                <!--/.row-->
                            </div>
                            @if($node['id'])
                            <div class="tab-pane" id="profile3" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-block">
                                            <form action="{{route('admin.node.save')}}" method="post" enctype="multipart/form-data" class="form-horizontal ajax-form" onsubmit="return false">
                                                <input type="hidden" name="id" value="{{$node['id'] ?? ''}}">
                                                <div class="form-group row">
                                                    <label class="col-md-3 form-control-label">类目名称</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="title" class="form-control" placeholder="请输入目录名称" value="{{$node['title'] ?? ''}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 form-control-label">图标</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="icon" class="form-control" placeholder="<域名/template/icons-simple-line-icons.html>选择图标" value="{{$node['icon'] ?? ''}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 form-control-label">链接地址</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="route" class="form-control" placeholder="路由别名:“public.home.index”" value="{{$node['route'] ?? ''}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 form-control-label">排序</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="sort" class="form-control" placeholder="越大越靠前int(10)" value="{{$node['sort'] ?? ''}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 form-control-label" for="select">是否展示</label>
                                                    <div class="col-md-9">
                                                        <select id="select" name="is_show" class="form-control">
                                                            <option value="0" @if($node['is_show'] == 0) selected="selected" @endif>隐藏</option>
                                                            <option value="1" @if($node['is_show'] == 1) selected="selected" @endif>显示</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 form-control-label">是否为目录</label>
                                                    <div class="col-md-9">
                                                        <label class="radio-inline" for="inline-radio1">
                                                            <input type="radio" id="inline-radio1" name="is_dir" value="1" @if($node['is_dir'] == 1) checked="checked" @endif>是
                                                        </label>
                                                        <label class="radio-inline" for="inline-radio2">
                                                            <input type="radio" id="inline-radio2" name="is_dir" value="0" @if($node['is_dir'] == 0) checked="checked" @endif>链接
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group form-actions">
                                                    <button type="submit" class="btn btn-primary"> 确定修改</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!--/.col-->
                                </div>
                            </div>
                            @endif
                            {{--<div class="tab-pane" id="messages3" role="tabpanel">
                                3. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                                dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </div>--}}
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
@endsection



