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
                    <div class="col-md-12">
                        <div class="card">
                            <form action="{{route('admin.register.action')}}" method="post" enctype="multipart/form-data" class="form-horizontal ajax-form" onsubmit="return false">
                                <div class="card-header">
                                    <strong>用户</strong> 添加/修改
                                </div>
                                <div class="card-block">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">账号：</label>
                                        <div class="col-md-6">
                                            <input type="text" name="username" class="form-control" placeholder="请设置登录账号并妥善保存" value="{{$user['username'] ?? ''}}" @if(0) disabled="disabled" @endif>
                                            <input type="hidden" name="id" value="{{$user['id'] ?? ''}}">
                                            <span class="help-block">账户名称长度3~20字符以内且是唯一的</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">密码：</label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <input type="password" id="password" name="password" class="form-control" placeholder="请第一次输入密码" value="{{$user['plaintext_key'] ?? ''}}">
                                                <span class="input-group-addon" onclick="hideShowPd('password','eye-pd')"><i class="fa fa-eye" id="eye-pd"></i></span>
                                            </div>
                                            <span class="help-block">输入有一定难度让人难以猜测的密码，密码长度15~30字符以内</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">确认密码：</label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <input type="password" id="password-confirmation" name="password_confirmation" class="form-control" placeholder="第二次输入密码并与第一次相同" value="{{$user['plaintext_key'] ?? ''}}">
                                                <span class="input-group-addon" onclick="hideShowPd('password-confirmation','eye-pds')"><i class="fa fa-eye" id="eye-pds"></i></span>
                                            </div>
                                            <span class="help-block">保持与第一次密码相同</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">账号：</label>
                                        <div class="col-md-6">
                                            <input type="text" name="realname" class="form-control" placeholder="请设置真实姓名" value="{{$user['realname'] ?? ''}}">
                                            <span class="help-block">真实姓名长度2~20字符（据可靠消息最长姓名达19字）</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">联系电话：</label>
                                        <div class="col-md-6">
                                            <input type="text" id="text-input" name="mobile" class="form-control" placeholder="易于联系到你的号码" value="{{$user['mobile'] ?? ''}}">
                                            <span class="help-block">只能输入11位的手机号码</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">状态</label>
                                        <div class="col-md-6">
                                            <label class="radio-inline">
                                                <input type="radio" id="inline-radio1" name="status" @if($user['status']=='1' || empty($user)) checked @endif value="1">正常
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" id="inline-radio2" name="status" @if($user['status']=='2') checked @endif value="2">禁用
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    {{--<button type="reset" class="btn btn-danger"><i class="fa fa-ban"></i> 返回</button>--}}
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-dot-circle-o"></i> 提交</button>
                                </div>
                            </form>
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
        function hideShowPd(pd,eye) {
            //var eye = document.getElementById(eye);
            var pd = document.getElementById(pd);
            if(pd.type == 'password'){
                pd.type = "text";
                $("#"+eye).addClass('fa-eye-slash');
                $("#"+eye).removeClass('fa-eye');
            }else{
                pd.type = "password";
                $("#"+eye).addClass('fa-eye');
                $("#"+eye).removeClass('fa-eye-slash');
            }

        }
    </script>
@endsection
