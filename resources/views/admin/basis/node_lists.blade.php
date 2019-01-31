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
                                <div class="form-group col-sm-6">
                                    <div class="card-block">
                                        <ul id="node-tree"></ul>
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
    <script>
        layui.use(['tree','layer'], function(){
            $.post("{{route('admin.node.api')}}",function(data) {
                layui.tree({
                    elem: '#node-tree', //传入元素选择器
                    skin: 'shihuang',
                    nodes: data
                    , click: function (node) {
                        window.location.href = "{{route('admin.node.edit')}}?id=" + node['id'];
                        console.log(node); //node即为当前点击的节点数据
                    }
                });
            });
        });
    </script>
@endsection